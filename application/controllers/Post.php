<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Post extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    if ($this->session->userdata('logged')<>1) {
      redirect(site_url('auth'));
    }        
    $this->load->model('Post_model');
    $this->load->model('User_model');
    $this->load->model('Category_model');
    $this->load->model('Tag_model');
    $this->load->library('form_validation');
  }

  public function index()
  {
    $q = urldecode($this->input->get('q', TRUE));
    $start = intval($this->input->get('start'));

    if ($q <> '') {
      $config['base_url'] = base_url() . 'post/index.html?q=' . urlencode($q);
      $config['first_url'] = base_url() . 'post/index.html?q=' . urlencode($q);
    } else {
      $config['base_url'] = base_url() . 'post/index.html';
      $config['first_url'] = base_url() . 'post/index.html';
    }

    $config['per_page'] = 10;
    $config['page_query_string'] = TRUE;
    $config['total_rows'] = $this->Post_model->total_rows($q);
    $post = $this->Post_model->get_limit_data($config['per_page'], $start, $q);

    $this->load->library('pagination');
    $this->pagination->initialize($config);

    $data = array(
      'post_data' => $post,
      'q' => $q,
      'pagination' => $this->pagination->create_links(),
      'total_rows' => $config['total_rows'],
      'start' => $start,
      'pageTitle' => 'Manage Post',
      );
    $this->load->view('theme/tpl_header',$data);
    $this->load->view('post/post_list', $data);
    $this->load->view('theme/tpl_footer');          
  }

  public function read($id) 
  {
    $row = $this->Post_model->get_by_id($id);
    if ($row) {
      $data = array(
        'id_post' => $row->id_post,
        'created_date' => $row->created_date,
        'title' => $row->title,
        'description' => $row->description,
        'image' => $row->image,
        'status' => $row->status,
        'tags' => $row->tags,
        'keyword' => $row->keyword,
        'url' => $row->url,
        'views' => $row->views,
        'likes' => $row->likes,
        'id_user' => $this->User_model->get_fullname($row->id_user),
        'id_category' => $this->Category_model->get_name($row->id_category),
        'id_tag' => $this->Tag_model->get_name($row->id_tag),
        );
      $data['pageTitle'] = 'Detail';
      $this->load->view('theme/tpl_header',$data);
      $this->load->view('post/post_read', $data);
      $this->load->view('theme/tpl_footer');            
    } else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('post'));
    }
  }

  public function create() 
  {

    $data = array(
      'pageTitle' => 'New Post',
      'button' => 'Terbitkan',
      'list_category' => $this->Post_model->get_category(),
      'list_tag' => $this->Post_model->get_tag(),
      'action' => site_url('post/create_action'),
      'id_post' => set_value('id_post'),
      'created_date' => set_value('created_date'),
      'title' => set_value('title'),
      'description' => set_value('description'),
      'image' => set_value('image'),
      'status' => set_value('status'),
      'tags' => set_value('tags'),
      'keyword' => set_value('keyword'),
      'url' => set_value('url'),
      'views' => set_value('views'),
      'likes' => set_value('likes'),
      'id_user' => $this->session->userdata('id'),
      'id_category' => set_value('id_category'),
      'id_tag' => set_value('id_tag'),
      );
    $this->load->view('theme/tpl_header',$data);
    $this->load->view('post/post_form', $data);
    $this->load->view('theme/tpl_footer');          
  }

  public function create_action() 
  {
    $this->_rules();       

    if ($this->form_validation->run() == FALSE) {
      $this->create();
    } else {

      $data = array(
        'created_date' => date('Y-m-d h:i:s'),
        'title' => $this->input->post('title',TRUE),
        'description' => $this->input->post('description',TRUE),
        'image' => "post.jpg",
        'status' => 0,
        'tags' => $this->input->post('tags',TRUE),
        'keyword' => $this->input->post('keyword',TRUE),
        'url' => $this->input->post('url',TRUE),
        'views' => 0,
        'likes' => 0,
        'id_user' => $this->session->userdata('id'),
        'id_category' => $this->input->post('id_category',TRUE),
        'id_tag' => $this->input->post('id_tag',TRUE),
        );

      $this->Post_model->insert($data);
      $this->session->set_flashdata('message', 'Create Record Success');
      redirect(site_url('post'));
    }
  }

  public function update($id) 
  {
    $row = $this->Post_model->get_by_id($id);

    if ($row) {
      $data = array(
        'pageTitle' => 'Edit Post',
        'button' => 'Update',
        'list_category' => $this->Post_model->get_category(),
        'list_tag' => $this->Post_model->get_tag(),        
        'action' => site_url('post/update_action'),
        'id_post' => set_value('id_post', $row->id_post),
        'created_date' => set_value('created_date', $row->created_date),
        'title' => set_value('title', $row->title),
        'description' => set_value('description', $row->description),
        'status' => set_value('status', $row->status),
        'tags' => set_value('tags', $row->tags),
        'keyword' => set_value('keyword', $row->keyword),
        'url' => set_value('url', $row->url),
        'views' => set_value('views', $row->views),
        'likes' => set_value('likes', $row->likes),
        'id_user' => set_value('id_user', $row->id_user),
        'id_category' => set_value('id_category', $row->id_category),
        'id_tag' => set_value('id_tag', $row->id_tag),
        );

      $this->load->view('theme/tpl_header',$data);
      $this->load->view('post/post_form', $data);
      $this->load->view('theme/tpl_footer');  
    } else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('post'));
    }
  }

  public function update_action() 
  {
    $this->_rules();

    if ($this->form_validation->run() == FALSE) {
      $this->update($this->input->post('id_post', TRUE));
    } else {
      $data = array(
        'created_date' => date('Y-m-d h:i:s'),
        'title' => $this->input->post('title',TRUE),
        'description' => $this->input->post('description',TRUE),
        'status' => $this->input->post('status',TRUE),
        'tags' => $this->input->post('tags',TRUE),
        'keyword' => $this->input->post('keyword',TRUE),
        'url' => $this->input->post('url',TRUE),
        'views' => $this->input->post('views',TRUE),
        'likes' => $this->input->post('likes',TRUE),
        'id_user' => $this->input->post('id_user',TRUE),
        'id_category' => $this->input->post('id_category',TRUE),
        'id_tag' => $this->input->post('id_tag',TRUE),
        );

      $this->Post_model->update($this->input->post('id_post', TRUE), $data);
      $this->session->set_flashdata('message', 'Update Record Success');
      redirect(site_url('post'));
    }
  }

  public function delete($id) 
  {
    $row = $this->Post_model->get_by_id($id);

    if ($row) {
      $this->Post_model->delete($id);
      $this->session->set_flashdata('message', 'Delete Record Success');
      redirect(site_url('post'));
    } else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('post'));
    }
  }

  public function _rules() 
  {
     // $this->form_validation->set_rules('created_date', 'created date', 'trim|required');
   $this->form_validation->set_rules('title', 'title', 'trim|required');
   $this->form_validation->set_rules('description', 'description', 'trim|required');
     // $this->form_validation->set_rules('image', 'image', 'trim|required');
     // $this->form_validation->set_rules('status', 'status', 'trim|required');
     // $this->form_validation->set_rules('tags', 'tags', 'trim|required');
     // $this->form_validation->set_rules('keyword', 'keyword', 'trim|required');
     // $this->form_validation->set_rules('url', 'url', 'trim|required');
     // $this->form_validation->set_rules('views', 'views', 'trim|required');
     // $this->form_validation->set_rules('likes', 'likes', 'trim|required');
     // $this->form_validation->set_rules('id_user', 'id user', 'trim|required');
   $this->form_validation->set_rules('id_category', 'id category', 'trim|required');
   $this->form_validation->set_rules('id_tag', 'id tag', 'trim|required');

   $this->form_validation->set_rules('id_post', 'id_post', 'trim');
   $this->form_validation->set_error_delimiters('<span class="label label-danger">', '</span>');
 }

 public function excel()
 {
  $this->load->helper('exportexcel');
  $namaFile = "post.xls";
  $judul = "post";
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
  xlsWriteLabel($tablehead, $kolomhead++, "Created Date");
  xlsWriteLabel($tablehead, $kolomhead++, "Title");
  xlsWriteLabel($tablehead, $kolomhead++, "Description");
  xlsWriteLabel($tablehead, $kolomhead++, "Image");
  xlsWriteLabel($tablehead, $kolomhead++, "Status");
  xlsWriteLabel($tablehead, $kolomhead++, "Tags");
  xlsWriteLabel($tablehead, $kolomhead++, "Keyword");
  xlsWriteLabel($tablehead, $kolomhead++, "Url");
  xlsWriteLabel($tablehead, $kolomhead++, "Views");
  xlsWriteLabel($tablehead, $kolomhead++, "Likes");
  xlsWriteLabel($tablehead, $kolomhead++, "Id User");
  xlsWriteLabel($tablehead, $kolomhead++, "Id Category");
  xlsWriteLabel($tablehead, $kolomhead++, "Id Tag");

  foreach ($this->Post_model->get_all() as $data) {
    $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
    xlsWriteNumber($tablebody, $kolombody++, $nourut);
    xlsWriteLabel($tablebody, $kolombody++, $data->created_date);
    xlsWriteLabel($tablebody, $kolombody++, $data->title);
    xlsWriteLabel($tablebody, $kolombody++, $data->description);
    xlsWriteLabel($tablebody, $kolombody++, $data->image);
    xlsWriteNumber($tablebody, $kolombody++, $data->status);
    xlsWriteLabel($tablebody, $kolombody++, $data->tags);
    xlsWriteLabel($tablebody, $kolombody++, $data->keyword);
    xlsWriteLabel($tablebody, $kolombody++, $data->url);
    xlsWriteNumber($tablebody, $kolombody++, $data->views);
    xlsWriteNumber($tablebody, $kolombody++, $data->likes);
    xlsWriteNumber($tablebody, $kolombody++, $data->id_user);
    xlsWriteNumber($tablebody, $kolombody++, $data->id_category);
    xlsWriteNumber($tablebody, $kolombody++, $data->id_tag);

    $tablebody++;
    $nourut++;
  }

  xlsEOF();
  exit();
}

public function word()
{
  header("Content-type: application/vnd.ms-word");
  header("Content-Disposition: attachment;Filename=post.doc");

  $data = array(
    'post_data' => $this->Post_model->get_all(),
    'start' => 0
    );

  $this->load->view('post/post_doc',$data);
}

function check()  
{  
 if(!($_POST["title"]))  
 {  
  echo '<span class="text text-danger"><i class="fa fa-remove"></i> Sepertinya Judul yang anda Buat Sudah ada Sebelumnya</span></span>';  
}  
else  
{  
  $this->load->model("Post_model");  
  if($this->Post_model->unique($_POST["title"]))  
  {  
   echo '<span class="text text-danger"><i class="fa fa-remove"></i> Sepertinya Judul yang anda Buat Sudah ada Sebelumnya</span>';  
 }  
 else  
 {  
   echo '<span class="text text-success"><i class="fa fa-check"></i> Judul Postingnya Unik</span>';  
 }  
}  
}  

function ajax_upload()  
{  
 if(isset($_FILES["image_file"]["name"]))  
 {  
  $config['upload_path'] = './assets/uploads/big/'; 
  $config['allowed_types'] = 'jpg|jpeg|png|gif';  
  $new_name = time();
  $config['file_name'] = $new_name;    
  $this->load->library('upload', $config);  
  if(!$this->upload->do_upload('image_file'))  
  {  
   echo $this->upload->display_errors();  
 }  
 else  
 {  
   $data = $this->upload->data();  

   $config['image_library'] = 'gd2';  
   $config['source_image'] = './assets/uploads/big/'.$data["file_name"];  
   $config['create_thumb'] = TRUE;  
   $config['maintain_ratio'] = FALSE;  
   $config['quality'] = '40%';  
   $config['width'] = 200;  
   $config['height'] = 200;  
   $config['new_image'] = './assets/uploads/middle/'.$data["file_name"];  
   $this->load->library('image_lib', $config);  
   $this->image_lib->resize();  

   echo '<img src="'.base_url().'./assets/uploads/big/'.$data["file_name"].'" class="img-thumbnail" />';  
 }  
}  
}  

public function image($id) 
{
  $row = $this->Post_model->get_by_id($id);

  if ($row) {
    $data = array(
      'pageTitle' => 'Edit Image',
      'button' => 'Edit Image',
      'action' => site_url('post/image_action/'.$row->url),
      'id_post' => set_value('id_post', $row->id_post),
      'image' => set_value('image', $row->image),
      );

    $this->load->view('theme/tpl_header',$data);
    $this->load->view('post/post_form_image', $data);
    $this->load->view('theme/tpl_footer');  

  } else {

    $this->session->set_flashdata('message', 'Record Not Found');
    redirect(site_url('post/image'));

  }
}

function image_action($id)  
{  
  if(isset($_FILES["image"]["name"]))  
  {  
    $config['upload_path'] = './assets/uploads/post/big/'; 
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
     $config['source_image'] = './assets/uploads/post/big/'.$data["file_name"];  
     $config['create_thumb'] = FALSE;  
     $config['maintain_ratio'] = FALSE;  
     $config['quality'] = '40%';  
     $config['width'] = 200;  
     $config['height'] = 200;  
     $config['new_image'] = './assets/uploads/post/middle/'.$data["file_name"];  
     $this->load->library('image_lib', $config);  
     $this->image_lib->overwrite = true;
     $this->image_lib->resize();  


     $update = array(
      'image' => $data["file_name"],
      );

     $this->Post_model->update($id, $update);

     echo '<img src="'.base_url().'./assets/uploads/post/middle/'.$data["file_name"].'" class="img-thumbnail" />';  
   }  
 }  



}  

}

