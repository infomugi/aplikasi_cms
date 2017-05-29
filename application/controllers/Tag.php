<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tag extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('logged')<>1) {
            redirect(site_url('auth'));
        }        
        $this->load->model('User_model');
        $this->load->model('Category_model');
        $this->load->model('Tag_model');
        $this->load->model('Post_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'tag/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'tag/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'tag/index.html';
            $config['first_url'] = base_url() . 'tag/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Tag_model->total_rows($q);
        $tag = $this->Tag_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'tag_data' => $tag,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'pageTitle' => 'Manage Tag',
            );
        $this->load->view('theme/tpl_header',$data);
        $this->load->view('tag/category_sub_list', $data);
        $this->load->view('theme/tpl_footer');          
    }

    public function read($id) 
    {
        $row = $this->Tag_model->get_by_id($id);
        if ($row) {
            $data = array(
              'id_category_sub' => $row->id_category_sub,
              'category_id' => $row->category_id,
              'name' => $row->name,
              'image' => $row->image,
              'url' => $row->url,
              'status' => $this->User_model->status($row->status),
              );
            $data['pageTitle'] = 'Detail';
            $this->load->view('theme/tpl_header',$data);
            $this->load->view('tag/category_sub_read', $data);
            $this->load->view('theme/tpl_footer');            
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tag'));
        }
    }

    public function create() 
    {
        $data = array(
            'pageTitle' => 'Add Tag',
            'button' => 'Submit',
            'action' => site_url('tag/create_action'),
            'list_category' => $this->Post_model->get_category(),
            'id_category_sub' => set_value('id_category_sub'),
            'category_id' => set_value('category_id'),
            'name' => set_value('name'),
            'image' => set_value('image'),
            'url' => set_value('url'),
            'status' => set_value('status'),
            );
        $this->load->view('theme/tpl_header',$data);
        $this->load->view('tag/category_sub_form', $data);
        $this->load->view('theme/tpl_footer');          
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
              'category_id' => $this->input->post('category_id',TRUE),
              'list_category' => $this->Post_model->get_category(),
              'name' => $this->input->post('name',TRUE),
              'image' => $this->input->post('image',TRUE),
              'url' => $this->input->post('url',TRUE),
              'status' => $this->input->post('status',TRUE),
              );

            $this->Tag_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('tag'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Tag_model->get_by_id($id);

        if ($row) {
            $data = array(
                'pageTitle' => 'Edit Tag',
                'button' => 'Update',
                'action' => site_url('tag/update_action'),
                'id_category_sub' => set_value('id_category_sub', $row->id_category_sub),
                'category_id' => set_value('category_id', $row->category_id),
                'name' => set_value('name', $row->name),
                'image' => set_value('image', $row->image),
                'url' => set_value('url', $row->url),
                'status' => set_value('status', $row->status),
                );

            $this->load->view('theme/tpl_header',$data);
            $this->load->view('tag/category_sub_form', $data);
            $this->load->view('theme/tpl_footer');  
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tag'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_category_sub', TRUE));
        } else {
            $data = array(
              'category_id' => $this->input->post('category_id',TRUE),
              'name' => $this->input->post('name',TRUE),
              'image' => $this->input->post('image',TRUE),
              'url' => $this->input->post('url',TRUE),
              'status' => $this->input->post('status',TRUE),
              );

            $this->Tag_model->update($this->input->post('id_category_sub', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('tag'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Tag_model->get_by_id($id);

        if ($row) {
            $this->Tag_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('tag'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tag'));
        }
    }

    public function _rules() 
    {
       $this->form_validation->set_rules('category_id', 'category id', 'trim|required');
       $this->form_validation->set_rules('name', 'name', 'trim|required');
       $this->form_validation->set_rules('image', 'image', 'trim|required');
       $this->form_validation->set_rules('url', 'url', 'trim|required');
       $this->form_validation->set_rules('status', 'status', 'trim|required');

       $this->form_validation->set_rules('id_category_sub', 'id_category_sub', 'trim');
       $this->form_validation->set_error_delimiters('<span class="label label-danger">', '</span>');
   }

   public function image($id) 
   {
      $row = $this->Tag_model->get_by_id($id);

      if ($row) {
        $data = array(
          'pageTitle' => 'Edit Image',
          'button' => 'Edit Image',
          'action' => site_url('tag/image_action/'.$row->id_category_sub),
          'id_category_sub' => set_value('id_category_sub', $row->id_category_sub),
          'image' => set_value('image', $row->image),
          );

        $this->load->view('theme/tpl_header',$data);
        $this->load->view('tag/category_sub_form_image', $data);
        $this->load->view('theme/tpl_footer');  

    } else {

        $this->session->set_flashdata('message', 'Record Not Found');
        redirect(site_url('tag/image'));

    }
}

function image_action($id)  
{  
  if(isset($_FILES["image"]["name"]))  
  {  
    $config['upload_path'] = './assets/uploads/tag/big/'; 
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
     $config['source_image'] = './assets/uploads/tag/big/'.$data["file_name"];  
     $config['create_thumb'] = FALSE;  
     $config['maintain_ratio'] = FALSE;  
     $config['quality'] = '40%';  
     $config['width'] = 200;  
     $config['height'] = 200;  
     $config['new_image'] = './assets/uploads/tag/middle/'.$data["file_name"];  
     $this->load->library('image_lib', $config);  
     $this->image_lib->overwrite = true;
     $this->image_lib->resize();  


     $update = array(
      'image' => $data["file_name"],
      );

     $this->Tag_model->update($id, $update);

     echo '<img src="'.base_url().'./assets/uploads/tag/middle/'.$data["file_name"].'" class="img-thumbnail" />';  
 }  
}  



}     

}

