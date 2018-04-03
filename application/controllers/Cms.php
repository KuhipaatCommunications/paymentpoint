<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cms extends MY_Controller 
{
	//protected $controller;
	public function __construct()
	{
		parent::__construct();
		$this->controller = 'Cms';
		$this->load->model('Common_methods', 'Common');
		$this->load->theme('frontend');
		$this->load->helper('auth');
		$this->load->helper('text');
		// $this->load->helper('cookie');
        // $this->load->library('session');
		//$this->load->library('form_validation');
		//$this->load->library('image_lib');
	}
	
	// public function index()
	// {
	// 	$this->view_data["cms"] = $this->Cmsmodel->cmsInfo();
	// 	$this->load->view('index', $this->view_data);
	// }

	public function content($slug)
	{
		if($this->Common->count_rows('cms', array('slug'=>$slug)) > 0){
			// it means page is there...
			$this->view_data["cms"] = $this->Common->getSingle('cms', "", array('slug'=>$slug, 'status'=>1));
			// $this->view_data["pagetitle"]=$this->view_data["cms"]["page_title"];
			// $this->view_data["pageheader"]=$this->view_data["cms"]["page_header"];
			// $this->view_data["meta_keyword"] = $this->view_data["cms"]["meta_keyword"];
			// $this->view_data["meta_description"] = $this->view_data["cms"]["meta_description"];
			$this->view_data["slug"]=$slug;
			$this->load->view('cms/content', $this->view_data);
		}else{
			// it means either page is not there or slug url is modified..
			// in this case we will display pahe 404 error message..
			$this->load->view('cms/page_not_found', $this->view_data);
		}
	}
}
?>
