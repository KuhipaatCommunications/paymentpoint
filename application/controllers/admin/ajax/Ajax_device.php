<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Ajax_device extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		//$this->controller = 'mpos';
		$this->load->model('admin/device_model','device');
		$this->load->model('common_methods', 'Common');
		//$this->load->theme('admintheme');
		//$this->load->helper('auth');
		//$this->load->library('form_validation');
		//$this->user_image_path = './uploads/user_image/';     

	}

	  ///////////function to get Company name data/////////////
    public function get_device_type_by_company_name()
    {
    	//print_r($this->input->post());
    	
    	$company_name = $this->input->post('company_name');
        $data = $this->Common->getAllFields("device_details", "device_type", array('company_name' => $company_name));
        //$data['csrf_value']=$this->security->get_csrf_hash();
		echo json_encode(array('data'=>$data, 'csrf_value'=>$this->security->get_csrf_hash()));

    }






}