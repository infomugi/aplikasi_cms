<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Category extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    if ($this->session->userdata('logged')<>1) {
      redirect(site_url('auth'));
    }        
    $this->load->model('Category_model');
    $this->load->model('User_model');
    $this->load->library('form_validation');
  }

  public function index()
  {
    $q = urldecode($this->input->get('q', TRUE));
    $start = intval($this->input->get('start'));

    if ($q <> '') {
      $config['base_url'] = base_url() . 'category?q=' . urlencode($q);
      $config['first_url'] = base_url() . 'category?q=' . urlencode($q);
    } else {
      $config['base_url'] = base_url() . 'category/';
      $config['first_url'] = base_url() . 'category/';
    }

    $config['per_page'] = 10;
    $config['page_query_string'] = TRUE;
    $config['total_rows'] = $this->Category_model->total_rows($q);
    $category = $this->Category_model->get_limit_data($config['per_page'], $start, $q);

    $this->load->library('pagination');
    $this->pagination->initialize($config);

    $data = array(
      'category_data' => $category,
      'q' => $q,
      'pagination' => $this->pagination->create_links(),
      'total_rows' => $config['total_rows'],
      'start' => $start,
      'pageTitle' => 'Manage Category',
      );
    $this->load->view('theme/tpl_header',$data);
    $this->load->view('category/category_list', $data);
    $this->load->view('theme/tpl_footer');          
  }

  public function read($id) 
  {
    $row = $this->Category_model->get_by_id($id);
    if ($row) {
      $data = array(
        'id_category' => $row->id_category,
        'name' => $row->name,
        'icon' => $row->icon,
        'image' => $row->image,
        'url' => $row->url,
        'status' => $this->User_model->status($row->status),
        );
      $data['pageTitle'] = 'Detail';
      $this->load->view('theme/tpl_header',$data);
      $this->load->view('category/category_read', $data);
      $this->load->view('theme/tpl_footer');            
    } else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('category'));
    }
  }

  public function create() 
  {
    $data = array(
      'pageTitle' => 'Add Category',
      'button' => 'Submit',
      'action' => site_url('category/create_action'),
      'id_category' => set_value('id_category'),
      'name' => set_value('name'),
      'icon' => set_value('icon'),
      'image' => set_value('image'),
      'url' => set_value('url'),
      'status' => set_value('status'),
      );
    $this->load->view('theme/tpl_header',$data);
    $this->load->view('category/category_form', $data);
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
        'icon' => $this->input->post('icon',TRUE),
        'image' => $this->input->post('image',TRUE),
        'url' => $this->input->post('url',TRUE),
        'status' => $this->input->post('status',TRUE),
        );

      $this->Category_model->insert($data);
      $this->session->set_flashdata('message', 'Create Record Success');
      redirect(site_url('category'));
    }
  }
  
  public function update($id) 
  {
    $row = $this->Category_model->get_by_id($id);

    if ($row) {
      $data = array(
        'pageTitle' => 'Edit Category',
        'button' => 'Update',
        'action' => site_url('category/update_action'),
        'id_category' => set_value('id_category', $row->id_category),
        'name' => set_value('name', $row->name),
        'icon' => set_value('icon', $row->icon),
        'image' => set_value('image', $row->image),
        'url' => set_value('url', $row->url),
        'status' => set_value('status', $row->status),
        );

      $this->load->view('theme/tpl_header',$data);
      $this->load->view('category/category_form', $data);
      $this->load->view('theme/tpl_footer');  
    } else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('category'));
    }
  }
  
  public function update_action() 
  {
    $this->_rules();

    if ($this->form_validation->run() == FALSE) {
      $this->update($this->input->post('id_category', TRUE));
    } else {
      $data = array(
        'name' => $this->input->post('name',TRUE),
        'icon' => $this->input->post('icon',TRUE),
        'image' => $this->input->post('image',TRUE),
        'url' => $this->input->post('url',TRUE),
        'status' => $this->input->post('status',TRUE),
        );

      $this->Category_model->update($this->input->post('id_category', TRUE), $data);
      $this->session->set_flashdata('message', 'Update Record Success');
      redirect(site_url('category'));
    }
  }
  
  public function delete($id) 
  {
    $row = $this->Category_model->get_by_id($id);

    if ($row) {
      $this->Category_model->delete($id);
      $this->session->set_flashdata('message', 'Delete Record Success');
      redirect(site_url('category'));
    } else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('category'));
    }
  }

  public function _rules() 
  {
   $this->form_validation->set_rules('name', 'name', 'trim|required');
   $this->form_validation->set_rules('icon', 'icon', 'trim|required');
     // $this->form_validation->set_rules('image', 'image', 'trim|required');
   $this->form_validation->set_rules('url', 'url', 'trim|required');
   $this->form_validation->set_rules('status', 'status', 'trim|required');

   $this->form_validation->set_rules('id_category', 'id_category', 'trim');
   $this->form_validation->set_error_delimiters('<span class="label label-danger">', '</span>');
 }

 public function excel()
 {
  $this->load->helper('exportexcel');
  $namaFile = "category.xls";
  $judul = "category";
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
  xlsWriteLabel($tablehead, $kolomhead++, "Icon");
  xlsWriteLabel($tablehead, $kolomhead++, "Image");
  xlsWriteLabel($tablehead, $kolomhead++, "Url");
  xlsWriteLabel($tablehead, $kolomhead++, "Status");

  foreach ($this->Category_model->get_all() as $data) {
    $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
    xlsWriteNumber($tablebody, $kolombody++, $nourut);
    xlsWriteLabel($tablebody, $kolombody++, $data->name);
    xlsWriteLabel($tablebody, $kolombody++, $data->icon);
    xlsWriteLabel($tablebody, $kolombody++, $data->image);
    xlsWriteLabel($tablebody, $kolombody++, $data->url);
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
  header("Content-Disposition: attachment;Filename=category.doc");

  $data = array(
    'category_data' => $this->Category_model->get_all(),
    'start' => 0
    );
  
  $this->load->view('category/category_doc',$data);
}

public function image($id) 
{
  $row = $this->Category_model->get_by_id($id);

  if ($row) {
    $data = array(
      'pageTitle' => 'Edit Image',
      'button' => 'Edit Image',
      'action' => site_url('category/image_action/'.$row->id_category),
      'id_category' => set_value('id_category', $row->id_category),
      'image' => set_value('image', $row->image),
      );

    $this->load->view('theme/tpl_header',$data);
    $this->load->view('category/category_form_image', $data);
    $this->load->view('theme/tpl_footer');  

  } else {

    $this->session->set_flashdata('message', 'Record Not Found');
    redirect(site_url('category/image'));

  }
}

function image_action($id)  
{  
  if(isset($_FILES["image"]["name"]))  
  {  
    $config['upload_path'] = './assets/uploads/category/big/'; 
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
     $config['source_image'] = './assets/uploads/category/big/'.$data["file_name"];  
     $config['create_thumb'] = FALSE;  
     $config['maintain_ratio'] = FALSE;  
     $config['quality'] = '40%';  
     $config['width'] = 200;  
     $config['height'] = 200;  
     $config['new_image'] = './assets/uploads/category/middle/'.$data["file_name"];  
     $this->load->library('image_lib', $config);  
     $this->image_lib->overwrite = true;
     $this->image_lib->resize();  


     $update = array(
      'image' => $data["file_name"],
      );

     $this->Category_model->update($id, $update);

     echo '<img src="'.base_url().'./assets/uploads/category/middle/'.$data["file_name"].'" class="img-thumbnail" />';  
   }  
 }  



}  

}

