<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Slide extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('logged')<>1) {
            redirect(site_url('auth'));
        }        
        $this->load->model('Slide_model');
        $this->load->model('User_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'slide/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'slide/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'slide/index.html';
            $config['first_url'] = base_url() . 'slide/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Slide_model->total_rows($q);
        $slide = $this->Slide_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'slide_data' => $slide,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'pageTitle' => 'Manage Slide',
            );
        $this->load->view('theme/tpl_header',$data);
        $this->load->view('slide/setting_slide_list', $data);
        $this->load->view('theme/tpl_footer');          
    }

    public function read($id) 
    {
        $row = $this->Slide_model->get_by_id($id);
        if ($row) {
            $data = array(
              'id_setting_slide' => $row->id_setting_slide,
              'name' => $row->name,
              'description' => $row->description,
              'image' => $row->image,
              'status' => $this->User_model->status($row->status),
              );
            $data['pageTitle'] = 'Detail';
            $this->load->view('theme/tpl_header',$data);
            $this->load->view('slide/setting_slide_read', $data);
            $this->load->view('theme/tpl_footer');            
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('slide'));
        }
    }

    public function create() 
    {
        $data = array(
            'pageTitle' => 'Add Slide',
            'button' => 'Submit',
            'action' => site_url('slide/create_action'),
            'id_setting_slide' => set_value('id_setting_slide'),
            'name' => set_value('name'),
            'description' => set_value('description'),
            'status' => 1,
            );
        $this->load->view('theme/tpl_header',$data);
        $this->load->view('slide/setting_slide_form', $data);
        $this->load->view('theme/tpl_footer');          
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
              'name' => $this->input->post('name',TRUE),
              'description' => $this->input->post('description',TRUE),
              'status' => $this->input->post('status',TRUE),
              );

            $this->Slide_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('slide'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Slide_model->get_by_id($id);

        if ($row) {
            $data = array(
                'pageTitle' => 'Edit Slide',
                'button' => 'Update',
                'action' => site_url('slide/update_action'),
                'id_setting_slide' => set_value('id_setting_slide', $row->id_setting_slide),
                'name' => set_value('name', $row->name),
                'description' => set_value('description', $row->description),
                'image' => set_value('image', $row->image),
                'status' => 1,
                );

            $this->load->view('theme/tpl_header',$data);
            $this->load->view('slide/setting_slide_form', $data);
            $this->load->view('theme/tpl_footer');  
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('slide'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_setting_slide', TRUE));
        } else {
            $data = array(
              'name' => $this->input->post('name',TRUE),
              'description' => $this->input->post('description',TRUE),
              'image' => $this->input->post('image',TRUE),
              'status' => $this->input->post('status',TRUE),
              );

            $this->Slide_model->update($this->input->post('id_setting_slide', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('slide'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Slide_model->get_by_id($id);

        if ($row) {
            $this->Slide_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('slide'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('slide'));
        }
    }

    public function _rules() 
    {
       $this->form_validation->set_rules('name', 'name', 'trim|required');
       $this->form_validation->set_rules('description', 'description', 'trim|required');
     // $this->form_validation->set_rules('image', 'image', 'trim|required');
       $this->form_validation->set_rules('status', 'status', 'trim|required');

       $this->form_validation->set_rules('id_setting_slide', 'id_setting_slide', 'trim');
       $this->form_validation->set_error_delimiters('<span class="label label-danger">', '</span>');
   }

   public function excel()
   {
    $this->load->helper('exportexcel');
    $namaFile = "setting_slide.xls";
    $judul = "setting_slide";
    $tablehead = 0;
    $tablebody = 1;
    $nourut = 1;
        //penulisan header
    header("Pragma: public");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
    header("Content-Type: application/force-download");
    header("Content-Type: application/octet-stream");
    header("Content-Type: application/download");
    header("Content-Disposition: attachment;filename=" . $namaFile . "");
    header("Content-Transfer-Encoding: binary ");

    xlsBOF();

    $kolomhead = 0;
    xlsWriteLabel($tablehead, $kolomhead++, "No");
    xlsWriteLabel($tablehead, $kolomhead++, "Name");
    xlsWriteLabel($tablehead, $kolomhead++, "Description");
    xlsWriteLabel($tablehead, $kolomhead++, "Image");
    xlsWriteLabel($tablehead, $kolomhead++, "Status");

    foreach ($this->Slide_model->get_all() as $data) {
        $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
        xlsWriteNumber($tablebody, $kolombody++, $nourut);
        xlsWriteLabel($tablebody, $kolombody++, $data->name);
        xlsWriteLabel($tablebody, $kolombody++, $data->description);
        xlsWriteLabel($tablebody, $kolombody++, $data->image);
        xlsWriteNumber($tablebody, $kolombody++, $data->status);

        $tablebody++;
        $nourut++;
    }

    xlsEOF();
    exit();
}

public function word()
{
    header("Content-type: application/vnd.ms-word");
    header("Content-Disposition: attachment;Filename=setting_slide.doc");

    $data = array(
        'setting_slide_data' => $this->Slide_model->get_all(),
        'start' => 0
        );

    $this->load->view('slide/setting_slide_doc',$data);
}

public function image($id) 
{
  $row = $this->Slide_model->get_by_id($id);

  if ($row) {
    $data = array(
      'pageTitle' => 'Edit Image',
      'button' => 'Edit Image',
      'action' => site_url('slide/image_action/'.$row->id_setting_slide),
      'id_setting_slide' => set_value('id_setting_slide', $row->id_setting_slide),
      'image' => set_value('image', $row->image),
      );

    $this->load->view('theme/tpl_header',$data);
    $this->load->view('slide/setting_slide_form_image', $data);
    $this->load->view('theme/tpl_footer');  

} else {

    $this->session->set_flashdata('message', 'Record Not Found');
    redirect(site_url('slide/image'));

}
}

function image_action($id)  
{  
  if(isset($_FILES["image"]["name"]))  
  {  
    $config['upload_path'] = './assets/uploads/slide/big/'; 
    $config['allowed_types'] = 'jpg|jpeg|png|gif';  
    $config['max_size'] = '262144';

    $new_name = $id;
    $config['file_name'] = $new_name;   
    $this->load->library('upload', $config);  
    $this->upload->overwrite = true;

    if(!$this->upload->do_upload('image'))  
    {  
       echo $this->upload->display_errors();  
   }  
   else  
   {  
       $data = $this->upload->data();  

       $config['image_library'] = 'gd2';  
       $config['source_image'] = './assets/uploads/slide/big/'.$data["file_name"];  
       $config['create_thumb'] = FALSE;  
       $config['maintain_ratio'] = FALSE;  
       $config['quality'] = '40%';  
       $config['width'] = 200;  
       $config['height'] = 200;  
       $config['new_image'] = './assets/uploads/slide/middle/'.$data["file_name"];  
       $this->load->library('image_lib', $config);  
       $this->image_lib->overwrite = true;
       $this->image_lib->resize();  

       $update = array(
          'image' => $data["file_name"],
          );

       $this->Slide_model->update($id, $update);

       echo '<img src="'.base_url().'./assets/uploads/slide/middle/'.$data["file_name"].'" class="img-thumbnail" />';  
   }  
}      

}


}

