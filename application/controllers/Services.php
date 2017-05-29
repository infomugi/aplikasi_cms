<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Services extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    if ($this->session->userdata('logged')<>1) {
      redirect(site_url('auth'));
    }        
    $this->load->model('Services_model');
    $this->load->model('User_model');
    $this->load->library('form_validation');
  }

  public function index()
  {
    $q = urldecode($this->input->get('q', TRUE));
    $start = intval($this->input->get('start'));

    if ($q <> '') {
      $config['base_url'] = base_url() . 'services/index.html?q=' . urlencode($q);
      $config['first_url'] = base_url() . 'services/index.html?q=' . urlencode($q);
    } else {
      $config['base_url'] = base_url() . 'services/index.html';
      $config['first_url'] = base_url() . 'services/index.html';
    }

    $config['per_page'] = 10;
    $config['page_query_string'] = TRUE;
    $config['total_rows'] = $this->Services_model->total_rows($q);
    $services = $this->Services_model->get_limit_data($config['per_page'], $start, $q);

    $this->load->library('pagination');
    $this->pagination->initialize($config);

    $data = array(
      'services_data' => $services,
      'q' => $q,
      'pagination' => $this->pagination->create_links(),
      'total_rows' => $config['total_rows'],
      'start' => $start,
      'pageTitle' => 'Manage Services',
      );
    $this->load->view('theme/tpl_header',$data);
    $this->load->view('services/services_list', $data);
    $this->load->view('theme/tpl_footer');          
  }

  public function read($id) 
  {
    $row = $this->Services_model->get_by_id($id);
    if ($row) {
      $data = array(
        'id_services' => $row->id_services,
        'name' => $row->name,
        'image' => $row->image,
        'icon' => $row->icon,
        'description' => $row->description,
        'status' => $this->User_model->status($row->status),
        );
      $data['pageTitle'] = 'Detail';
      $this->load->view('theme/tpl_header',$data);
      $this->load->view('services/services_read', $data);
      $this->load->view('theme/tpl_footer');            
    } else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('services'));
    }
  }

  public function create() 
  {
    $data = array(
      'pageTitle' => 'Add Services',
      'button' => 'Submit',
      'action' => site_url('services/create_action'),
      'id_services' => set_value('id_services'),
      'name' => set_value('name'),
      'image' => "image.png",
      'icon' => set_value('icon'),
      'description' => set_value('description'),
      'status' => 1,
      );
    $this->load->view('theme/tpl_header',$data);
    $this->load->view('services/services_form', $data);
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
        'image' => "image.jpg",
        'icon' => $this->input->post('icon',TRUE),
        'description' => $this->input->post('description',TRUE),
        'status' => 1,
        );

      $this->Services_model->insert($data);
      $this->session->set_flashdata('message', 'Create Record Success');
      redirect(site_url('services'));
    }
  }

  public function update($id) 
  {
    $row = $this->Services_model->get_by_id($id);

    if ($row) {
      $data = array(
        'pageTitle' => 'Edit Services',
        'button' => 'Update',
        'action' => site_url('services/update_action'),
        'id_services' => set_value('id_services', $row->id_services),
        'name' => set_value('name', $row->name),
        'icon' => set_value('icon', $row->icon),
        'description' => set_value('description', $row->description),
        'status' => set_value('status', $row->status),
        );

      $this->load->view('theme/tpl_header',$data);
      $this->load->view('services/services_form', $data);
      $this->load->view('theme/tpl_footer');  
    } else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('services'));
    }
  }

  public function update_action() 
  {
    $this->_rules();

    if ($this->form_validation->run() == FALSE) {
      $this->update($this->input->post('id_services', TRUE));
    } else {
      $data = array(
        'name' => $this->input->post('name',TRUE),
        'icon' => $this->input->post('icon',TRUE),
        'description' => $this->input->post('description',TRUE),
        'status' => $this->input->post('status',TRUE),
        );

      $this->Services_model->update($this->input->post('id_services', TRUE), $data);
      $this->session->set_flashdata('message', 'Update Record Success');
      redirect(site_url('services'));
    }
  }

  public function delete($id) 
  {
    $row = $this->Services_model->get_by_id($id);

    if ($row) {
      $this->Services_model->delete($id);
      $this->session->set_flashdata('message', 'Delete Record Success');
      redirect(site_url('services'));
    } else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('services'));
    }
  }

  public function _rules() 
  {
   $this->form_validation->set_rules('name', 'name', 'trim|required');
       // $this->form_validation->set_rules('image', 'image', 'trim|required');
   $this->form_validation->set_rules('icon', 'icon', 'trim|required');
   $this->form_validation->set_rules('description', 'description', 'trim|required');
   $this->form_validation->set_rules('status', 'status', 'trim|required');

   $this->form_validation->set_rules('id_services', 'id_services', 'trim');
   $this->form_validation->set_error_delimiters('<span class="label label-danger">', '</span>');
 }

 public function excel()
 {
  $this->load->helper('exportexcel');
  $namaFile = "services.xls";
  $judul = "services";
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
  xlsWriteLabel($tablehead, $kolomhead++, "Image");
  xlsWriteLabel($tablehead, $kolomhead++, "Icon");
  xlsWriteLabel($tablehead, $kolomhead++, "Description");
  xlsWriteLabel($tablehead, $kolomhead++, "Status");

  foreach ($this->Services_model->get_all() as $data) {
    $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
    xlsWriteNumber($tablebody, $kolombody++, $nourut);
    xlsWriteLabel($tablebody, $kolombody++, $data->name);
    xlsWriteLabel($tablebody, $kolombody++, $data->image);
    xlsWriteLabel($tablebody, $kolombody++, $data->icon);
    xlsWriteLabel($tablebody, $kolombody++, $data->description);
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
  header("Content-Disposition: attachment;Filename=services.doc");

  $data = array(
    'services_data' => $this->Services_model->get_all(),
    'start' => 0
    );

  $this->load->view('services/services_doc',$data);
}

public function image($id) 
{
  $row = $this->Services_model->get_by_id($id);

  if ($row) {
    $data = array(
      'pageTitle' => 'Edit Image',
      'button' => 'Edit Image',
      'action' => site_url('services/image_action/'.$row->id_services),
      'id_services' => set_value('id_services', $row->id_services),
      'image' => set_value('image', $row->image),
      );

    $this->load->view('theme/tpl_header',$data);
    $this->load->view('services/services_form_image', $data);
    $this->load->view('theme/tpl_footer');  

  } else {

    $this->session->set_flashdata('message', 'Record Not Found');
    redirect(site_url('services/image'));

  }
}

function image_action($id)  
{  
  if(isset($_FILES["image"]["name"]))  
  {  
    $config['upload_path'] = './assets/uploads/services/big/'; 
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
     $config['source_image'] = './assets/uploads/services/big/'.$data["file_name"];  
     $config['create_thumb'] = FALSE;  
     $config['maintain_ratio'] = FALSE;  
     $config['quality'] = '40%';  
     $config['width'] = 200;  
     $config['height'] = 200;  
     $config['new_image'] = './assets/uploads/services/middle/'.$data["file_name"];  
     $this->load->library('image_lib', $config);  
     $this->image_lib->overwrite = true;
     $this->image_lib->resize();  

     $update = array(
      'image' => $data["file_name"],
      );

     $this->Services_model->update($id, $update);

     echo '<img src="'.base_url().'./assets/uploads/services/middle/'.$data["file_name"].'" class="img-thumbnail" />';  
   }  
 }      

}

}

