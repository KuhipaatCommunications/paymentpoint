<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cms extends CI_Controller 
{
    private $controller;
    public function __construct()
    {
        parent::__construct();
        $this->controller = 'Cms';
        //$this->load->model('cms_model', 'Cms');
        $this->load->model('Common_methods', 'Common');
        $this->load->theme('admintheme');
        $this->load->library('form_validation');
        $this->load->helper('auth');
        $this->load->helper('text');
        $this->page_image_path = './uploads/page_image/';
        isAccessPermit();
    }
	
	public function index()
	{
            if(!isAdminLoggedIn())///////if not logged in then will redirect to login page///////////
            {
                    redirect("login");
            }		
            $data["site_title"] = 'Content Management System';
            $data["menu_title"] = 'Content Management System: Pages';
            ///////get all pages and content/////////
            $data['pages'] = $this->Common->getAllFields('cms');
            $this->load->view('cms/index', $data);
	}
	function uploadImage($image_path)
	{
		$image_data=[];
		if($_FILES['page_image']['name']!='')
		{
			$config = array(
	
				'allowed_types' => 'jpg|jpeg|gif|png',
	
				'upload_path' => $image_path,
	
				'max_size' => 0
	
			);

			$this->load->library('upload', $config);
	
			if ( ! $this->upload->do_upload('page_image'))
			{
				echo $this->upload->display_errors('','');die();
				$this->session->set_flashdata('error',$this->upload->display_errors('',''));
				//redirect(base_url().'challenge/add/','refresh');
			}	
			else
			{	
				$image_data = $this->upload->data("");
				//$this->session->set_flashdata('message','image successfully uploaded');
			}
	
			if($image_data['image_width']>=360 || $image_data['image_height']>=400)
			{
				$image_width=360;
				$image_height=400;
				if($image_data['image_width']<360)
					$image_width=$image_data['image_width'];
				if($image_data['image_height']<400)
					$image_height=$image_data['image_height'];
						
				$config = array(
		
					'source_image' => $image_data['full_path'],
		
					'new_image' => $image_path . '/medium',
		
					'maintain_ration' => true,
		
					'width' => $image_width,
		
					'height' => $image_height
		
				);
				
				$this->load->library('image_lib', $config);
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
			}
			else
				copy($image_path.'/'.$image_data['file_name'],$image_path.'/medium/'.$image_data['file_name']);
			if($image_data['image_width']>=150 || $image_data['image_height']>=180)
			{
				$image_width=150;
				$image_height=180;
				if($image_data['image_width']<150)
					$image_width=$image_data['image_width'];
				if($image_data['image_height']<180)
					$image_height=$image_data['image_height'];
						
				$config = array(
		
					'source_image' => $image_data['full_path'],
		
					'new_image' => $image_path . '/thumbs',
		
					'maintain_ration' => true,
		
					'width' => $image_width,
		
					'height' => $image_height
		
				);
				
				$this->load->library('image_lib', $config);
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
			}
			else
				copy($image_path.'/'.$image_data['file_name'],$image_path.'/thumbs/'.$image_data['file_name']);
			
		}
		return $image_data;
	}
	///////////function to update page data/////////////
	public function update( $id = NULL)
	{
		if(!isAdminLoggedIn())///////if not logged in then will redirect to login page///////////
		{
			redirect("admin/login");
		}
                
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
			$this->load->helper('security');
			$this->load->helper('common');
			if(!$id){
				$id = $this->input->post('id', true);
			}
			/////start form validation////////
			$this->form_validation->set_rules('title','Title','trim|required');
			//$this->form_validation->set_error_delimiters('<span class="error">', '</span>');
			if($this->form_validation->run()!= FALSE)///////if form input fields are valid////////
			{
				$data = array(
					'page_title' => $this->input->post('page_title', true),
					'page_header' => $this->input->post('page_header', true),
					'title' => $this->input->post('title', true),
					'slug' => create_unique_slug($this->input->post('title', true), 'cms'),
					'meta_keyword' => $this->input->post('meta_keyword', true),
					'meta_description' => $this->input->post('meta_description', true),
					'content' => $this->input->post('content', true),
					'created_at' => date('Y-m-d'),
					'status' => 1
				);
				$imagedata=$this->uploadImage($this->page_image_path);
				if($imagedata && !empty($imagedata))
				{
					$data['page_image']=$imagedata['file_name'];
				}
				if($id){
					$this->Common->updateRecords('cms', array('id'=>$id), $data);//////update page data////
					$this->session->set_flashdata('success_msg', 'Page edited successfully.');
					redirect('/admin/cms');
				}else{
					$this->Common->insertRecord('cms', $data);//////update page data////
					$this->session->set_flashdata('success_msg', 'Page added successfully.');
					redirect('/admin/cms');
				}
			}
		}
		if($id){
			$data["site_title"] = 'Edit page';
			$data["page_title"] = 'Edit page';
		}else{
			$data["site_title"] = 'Add page';
			$data["page_title"] = 'Add page';
		}
		$data['id'] = $id;
		$data["page_details"] = $this->Common->getSingle('cms', "", array('id'=>$id));/////get page details by id////////												
		$this->load->view('cms/edit', $data);
	}
	///////////function to change page block status/////////////	
	public function change_status()
	{
		if(!isAdminLoggedIn())///////if not logged in then will redirect to login page///////////
		{
			redirect("admin/login");
		}

		if($this->input->server('REQUEST_METHOD') === 'POST')
		{
			$check_ids = $this->input->post('check_ids', true);
			$status = $this->input->post('status', true);
		
			$data = array(
				'status' => $status,
			);
			$this->Common->updateRecords('cms', array('id'=>$check_ids), $data);;///////call the model Cms to change the page block status////////
			$this->session->set_flashdata('success_msg', 'page status changed successfully.');
			redirect('admin/'.$this->controller);
		}
	}
	///////////function to change multi page block status/////////////	
	// public function change_status_multiple()
	// {
	// 	if(!isAdminLoggedIn())///////if not logged in then will redirect to login page///////////
	// 	{
	// 		admin_redirect("login");
	// 	}
		
	// 	if ($this->input->server('REQUEST_METHOD') === 'POST')
	// 	{
	// 		$check_ids = $this->input->post('check_ids');
	// 		$check_ids = explode('^', $check_ids);
	// 		$status = $this->input->post('status');
	// 		$data = array(
	// 		   'status' => $status,
	// 		);
	// 		$this->CommonMethods->changeMultiStatus($check_ids, $data, 'cms'); //////call the model Cms to change multi page block status////////									
	// 		$this->session->set_flashdata('success_msg', 'page status changed successfully.');
	// 		admin_redirect($this->controller);
	// 	}
	// }
	//////function to delete single page///////////
	public function delete($id)
	{
		if(!isAdminLoggedIn()) ///////if not logged in then will redirect to login page///////////
		{
			admin_redirect("login");
		}
		else
		{
			$page=$this->Common->getSingle('cms', 'page_image', array('id'=>$id));
			if(isset($page['page_image']) && $page['page_image']!="" && file_exists($this->page_image_path.'/'.$page['page_image'])) /////if image exists then, unlink previous uploaded images/////////
			{
				unlink($this->page_image_path.'/'.$page['page_image']);
				unlink($this->page_image_path.'/medium/'.$page['page_image']);
				unlink($this->page_image_path.'/thumbs/'.$page['page_image']);
			}
                        
			$this->Common->deleteSingleRecord($id, 'cms');	// Deleting page 
			$this->session->set_flashdata('success_msg', 'page deleted successfully.');
			redirect('admin/'.$this->controller);
		}
	}		
	
}

?>
