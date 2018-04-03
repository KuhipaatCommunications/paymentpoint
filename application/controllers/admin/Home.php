<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		//$this->load->model('admin/user_model', 'User');
		$this->load->model('admin/adminmodel');
		$this->load->theme('admintheme');
		$this->load->helper('auth');
		$this->load->library('form_validation');
		$this->load->library('image_lib');
		$this->admin_user_image_path = './uploads/admin_user_image/';
	}
	
	//////////function to logout from admin/backend section/////////
	public function logout()
	{
		$this->session->unset_userdata('admin_id');
		$this->session->unset_userdata('admin_name');
		$this->session->set_userdata('success_msg', 'You have logged out!');
		redirect("admin/login");
	}
	/////////////////////Update Admin profile//////////////////
	public function admin_profile_edit()
	{	
		if(!isAdminLoggedIn())///////if not loggedin then will redirect to login page///////////
		{
			redirect("admin/login");
		}
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
			$this->form_validation->set_rules('username','User Name','trim|required|min_length[4]|max_length[15]');
			$this->form_validation->set_rules('first_name','First Name','trim|required|max_length[15]');
			$this->form_validation->set_rules('last_name','Last Name','trim|required|max_length[15]');
			if($this->form_validation->run()!= FALSE)///////if form input fields are valid////////
			{
				$data = array(
					'username' => $this->input->post('username'),
					'first_name' => $this->input->post('first_name'),
					'last_name' => $this->input->post('last_name')		
				);
							
			}
			//For image upload
            if(ISSET($_FILES['company_image']['name']) && $_FILES['company_image']['name']!='')
            { 
            	
                    $config = array(
                            'allowed_types' => 'jpg|jpeg|gif|png',
                            'upload_path' => $this->admin_user_image_path,
                            'max_size' => 0
                    );
                    $this->load->library('upload', $config);
                    if ( ! $this->upload->do_upload('company_image'))
                    {
                            //echo $this->upload->display_errors('','');die();
                            $this->session->set_flashdata('error_msg',$this->upload->display_errors());
                            redirect("admin/user");
                    }	
                    else
                    {	
                            $image_data = $this->upload->data("");
                            //$this->session->set_flashdata('message','image successfully uploaded');
                    }
                    // check EXIF and autorotate if needed
                    $this->load->library('image_autorotate', array('filepath' => $image_data['full_path'])); 

                    if($image_data['image_width']<50)
                    {
                        $this->session->set_flashdata('error_msg','Image width should be greater than 280 pixels');
                        redirect("admin/user");
                    }elseif($image_data['image_height']<50){
                        $this->session->set_flashdata('error_msg','Image height should be greater than 280 pixels');
                        redirect("admin/user");
                    }

                    $config = array(
                            'source_image' => $this->admin_user_image_path . '/' .$image_data['file_name'],
                            'new_image' => $this->admin_user_image_path . '/resize/' .$image_data['raw_name']. IMG_SIZE_VERY_SMALL . $image_data['file_ext'],
                            'maintain_ratio' => false,
                            'width' => 30,
                            'height' => 30
                    );
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                    $config = array(
                            'source_image' => $this->admin_user_image_path . '/' .$image_data['file_name'],
                            'new_image' => $this->admin_user_image_path . '/resize/' .$image_data['raw_name']. IMG_SIZE_SMALL . $image_data['file_ext'],
                            'maintain_ratio' => false,                  
                            'width' => 50,
                            'height' => 50
                    );
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();

                    $config = array(
                            'source_image' => $this->admin_user_image_path . '/' .$image_data['file_name'],
                            'new_image' => $this->admin_user_image_path . '/resize/' .$image_data['raw_name']. IMG_SIZE_MEDIUM . $image_data['file_ext'],
                            'maintain_ratio' => false,                    
                            'width' => 100,
                            'height' => 100
                    );
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();

                    $config = array(
                            'source_image' => $this->admin_user_image_path . '/' .$image_data['file_name'],
                            'new_image' => $this->admin_user_image_path . '/resize/' .$image_data['raw_name']. IMG_SIZE_STANDARD . $image_data['file_ext'],
                            'maintain_ratio' => false,                    
                            'width' => 278,
                            'height' => 278
                    );
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();


                    $company_image=$image_data['file_name'];
                    $raw_name = $image_data['raw_name'];
                    $file_ext = $image_data['file_ext'];
                    $data['profile_image']=$company_image;
                    $data['raw_name']=$raw_name;
                    $data['file_ext']=$file_ext;
                    $this->load->model('common_methods', 'Common');
                    $profileimg = $this->Common->getSingle("admin", "profile_image", array('id'=>$this->session->userdata('admin_id')));
                    if(isset($profileimg['profile_image']) && $profileimg['profile_image']!="" && file_exists($this->admin_user_image_path.'/'.$profileimg['profile_image']))
                    {
                        unlink($this->admin_user_image_path.'/'.$profileimg['profile_image']);
                        $image=explode('.', $profileimg['profile_image']);
                        unlink($this->admin_user_image_path.'/resize/'.$image[0].IMG_SIZE_VERY_SMALL.'.'.$image[1]);
                        unlink($this->admin_user_image_path.'/resize/'.$image[0].IMG_SIZE_SMALL.'.'.$image[1]);
                        unlink($this->admin_user_image_path.'/resize/'.$image[0].IMG_SIZE_MEDIUM.'.'.$image[1]);
                        unlink($this->admin_user_image_path.'/resize/'.$image[0].IMG_SIZE_STANDARD.'.'.$image[1]);
                    }
            }
            $this->adminmodel->edit_profile($data);/////call the function in model to update admin profile/////////
			$this->session->set_userdata('success_msg', 'Profile updated successfully.');
			redirect("admin/home/admin_profile_edit");		
				//end
		}
		$data["admin_info"] = $this->adminmodel->adminprofileinfo(); //////get admin profile details/////////
		//print_r($data["admin_info"]);
		$data['site_title'] = 'Edit Profile';
		$this->load->view('home/admin_profile_edit', $data);
	}
	/////////////////////End Update Admin profile////////////////////
	
	///////change admin password/////////
	public function change_pass()
	{
		if(!isAdminLoggedIn())///////if not loggedin then will redirect to login page///////////
		{
			redirect("admin/login");
		}
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
			$this->form_validation->set_rules('old_password','Old Password','trim|required');
			$this->form_validation->set_rules('new_password','New Password','trim|required|min_length[5]|md5');
			$this->form_validation->set_rules('c_new_password','Confirm New Password','trim|required|min_length[5]|matches[new_password]|md5');
			if($this->form_validation->run()!= FALSE)///////if form input fields are valid////////
			{
				$count = $this->adminmodel->checkPasswordExist(); //////return if old password exist into the system////////
				if($count==0)//////if old password not exist///////////
				{
					$this->session->set_flashdata('error_msg', 'Old password not found in database.');
					redirect("admin/home/change_pass");				
				}
				else ////////////if old password exist/////
				{
					$data_pass = array(
						'password' => $this->input->post('new_password'),
						//'rem_password' => $this->input->post('new_password')
					);	
					$this->adminmodel->changePassword($data_pass);//////call the model function to change th password//////////////
					$this->session->set_userdata('success_msg', 'Password changed successfully.');
					redirect("admin/home/change_pass");					
				}
			}
		}
		$data['site_title'] = 'Admin Change Password';
		$this->load->view('home/change_pass', $data);
	}
	
	///////////function to set site settings///////////
	public function settings()
	{
            if(!isAdminLoggedIn())///////if not loggedin then will redirect to login page///////////
            {
                redirect("admin/login");
            }
            if(isAccessPermit())
            {
                if ($this->input->server('REQUEST_METHOD') === 'POST')
                {
                    $settings=$this->input->post('settings');
                    $this->adminmodel->editSettings($settings);///////call adminmodel to change admin site settings///////
                    $this->session->set_flashdata('success_msg', 'Settings updated successfully.');
                    redirect("admin/home/settings");					
                }

                $data["settings"] = $this->adminmodel->getSettings();/////call the model function to update site settings///////////
                //print_r($data["admin_info"]);
                $data['site_title'] = 'Site Settings';
                $this->load->view('home/settings', $data);
            }
	}
//        public function addControllerMethods()
//        {
//            //echo $this->router->fetch_method();exit;
//            $this->load->model('common_methods', 'Common');
//            $this->load->library('controllerlist');
//            $controllrs=$this->controllerlist->getControllers(); 
//            foreach($controllrs as $key=>$val)
//            {
//                $controller=$key;
//                foreach($val as $key=>$v)
//                {
//                    $method=$v;
//                    if($method!='addControllerMethods'){
//                        $data=array('controller'=>$controller, 'method'=>$method);
//                        $this->Common->insertRecord('controller_methods', $data);
//                    }
//                }
//            }
//        }
}
?>
