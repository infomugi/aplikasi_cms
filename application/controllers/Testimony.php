<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Testimony extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('logged')<>1) {
            redirect(site_url('auth'));
        }        
        $this->load->model('Testimony_model');
        $this->load->library('form_validation');
    }

    public function index()
        {
            $q = urldecode($this->input->get('q', TRUE));
            $start = intval($this->input->get('start'));

            if ($q <> '') {
                $config['base_url'] = base_url() . 'testimony/index.html?q=' . urlencode($q);
                $config['first_url'] = base_url() . 'testimony/index.html?q=' . urlencode($q);
            } else {
                $config['base_url'] = base_url() . 'testimony/index.html';
                $config['first_url'] = base_url() . 'testimony/index.html';
            }

            $config['per_page'] = 10;
            $config['page_query_string'] = TRUE;
            $config['total_rows'] = $this->Testimony_model->total_rows($q);
            $testimony = $this->Testimony_model->get_limit_data($config['per_page'], $start, $q);

            $this->load->library('pagination');
            $this->pagination->initialize($config);

            $data = array(
            'testimony_data' => $testimony,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'pageTitle' => 'Manage Testimony',
            );
            $this->load->view('theme/tpl_header',$data);
            $this->load->view('testimony/testimony_list', $data);
            $this->load->view('theme/tpl_footer');          
        }

    public function read($id) 
    {
        $row = $this->Testimony_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_testimony' => $row->id_testimony,
		'name' => $row->name,
		'job' => $row->job,
		'company' => $row->company,
		'description' => $row->description,
		'status' => $row->status,
	    );
            $data['pageTitle'] = 'Detail';
            $this->load->view('theme/tpl_header',$data);
            $this->load->view('testimony/testimony_read', $data);
            $this->load->view('theme/tpl_footer');            
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('testimony'));
        }
    }

    public function create() 
    {
        $data = array(
        'pageTitle' => 'Add Testimony',
        'button' => 'Submit',
        'action' => site_url('testimony/create_action'),
	    'id_testimony' => set_value('id_testimony'),
	    'name' => set_value('name'),
	    'job' => set_value('job'),
	    'company' => set_value('company'),
	    'description' => set_value('description'),
	    'status' => set_value('status'),
	);
        $this->load->view('theme/tpl_header',$data);
        $this->load->view('testimony/testimony_form', $data);
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
		'job' => $this->input->post('job',TRUE),
		'company' => $this->input->post('company',TRUE),
		'description' => $this->input->post('description',TRUE),
		'status' => $this->input->post('status',TRUE),
	    );

            $this->Testimony_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('testimony'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Testimony_model->get_by_id($id);

        if ($row) {
            $data = array(
            'pageTitle' => 'Edit Testimony',
            'button' => 'Update',
            'action' => site_url('testimony/update_action'),
		'id_testimony' => set_value('id_testimony', $row->id_testimony),
		'name' => set_value('name', $row->name),
		'job' => set_value('job', $row->job),
		'company' => set_value('company', $row->company),
		'description' => set_value('description', $row->description),
		'status' => set_value('status', $row->status),
	    );

            $this->load->view('theme/tpl_header',$data);
            $this->load->view('testimony/testimony_form', $data);
            $this->load->view('theme/tpl_footer');  
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('testimony'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_testimony', TRUE));
        } else {
            $data = array(
		'name' => $this->input->post('name',TRUE),
		'job' => $this->input->post('job',TRUE),
		'company' => $this->input->post('company',TRUE),
		'description' => $this->input->post('description',TRUE),
		'status' => $this->input->post('status',TRUE),
	    );

            $this->Testimony_model->update($this->input->post('id_testimony', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('testimony'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Testimony_model->get_by_id($id);

        if ($row) {
            $this->Testimony_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('testimony'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('testimony'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('name', 'name', 'trim|required');
	$this->form_validation->set_rules('job', 'job', 'trim|required');
	$this->form_validation->set_rules('company', 'company', 'trim|required');
	$this->form_validation->set_rules('description', 'description', 'trim|required');
	$this->form_validation->set_rules('status', 'status', 'trim|required');

	$this->form_validation->set_rules('id_testimony', 'id_testimony', 'trim');
	$this->form_validation->set_error_delimiters('<span class="label label-danger">', '</span>');
}

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "testimony.xls";
        $judul = "testimony";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Job");
	xlsWriteLabel($tablehead, $kolomhead++, "Company");
	xlsWriteLabel($tablehead, $kolomhead++, "Description");
	xlsWriteLabel($tablehead, $kolomhead++, "Status");

	foreach ($this->Testimony_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->name);
	    xlsWriteLabel($tablebody, $kolombody++, $data->job);
	    xlsWriteLabel($tablebody, $kolombody++, $data->company);
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
        header("Content-Disposition: attachment;Filename=testimony.doc");

        $data = array(
        'testimony_data' => $this->Testimony_model->get_all(),
        'start' => 0
        );
        
        $this->load->view('testimony/testimony_doc',$data);
    }

}

