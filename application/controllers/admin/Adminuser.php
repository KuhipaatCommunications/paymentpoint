<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Adminuser extends CI_Controller
{
	public function __construct()
	{
            parent::__construct();
            $this->controller = 'Adminuser';
            $this->load->model('admin/user_model', 'User');
            $this->load->model('common_methods', 'Common');
            $this->load->theme('admintheme');
            $this->load->helper('auth');
            $this->load->library('form_validation');
            $this->load->library('image_lib'); 
            $this->admin_user_image_path = './uploads/admin_user_image/';
            isAccessPermit();
	}
	//////////function to load user list////////////
	public function index()
	{
            if(!isAdminLoggedIn())
            { 
                redirect("admin/login");
            }
            $keyword = $this->input->get('search_keyword');
            $data["site_title"] = 'Admin User Management';
            $data["menu_title"] = 'Admin User Management';

            if ($this->uri->segment(4) === FALSE)
            {
                $offset = 0;
            }
            else
            {
                $offset = $this->uri->segment(4);
            }
            $limit=ADMIN_PER_PAGE;

            $config['total_rows'] = $this->User->countAllAdminUser($keyword);
            $config['per_page'] = $limit;
            $config['num_links'] = 3;
            $config['cur_tag_open'] = '<span class="current">';
            $config['cur_tag_close'] = '</span>';
            $config['uri_segment'] = 4;
            $config['suffix'] = '';
            if($keyword)
                $config['suffix'] .= '?search_keyword=' .$keyword;
            $this->pagination->initialize($config);
            $paginator=$this->pagination->create_links();
            $data['pagination'] = $paginator;
            $data['keyword'] = $keyword;
            // $fielter_checkbox = $this->input->post('filter_by_checkbox');
            // $data['filter_field'] = $fielter_checkbox;

            $data["user"] = $this->User->getAllAdminUser($keyword,$limit,$offset);
            $this->load->view('adminuser/index', $data);
	}
    /////////add user////////////
	public function add()
	{   
            if(!isAdminLoggedIn())
            {
                redirect("admin/login");
            }
            if ($this->input->server('REQUEST_METHOD') === 'POST')
            {
                $this->load->library('form_validation');
                $this->load->helper('security');
                $this->form_validation->set_rules('role_id','role','trim|required');
                $this->form_validation->set_rules('user_name','User Name','trim|required|is_unique[admin.username]');
                $this->form_validation->set_rules('password','password','trim|required');
                $this->form_validation->set_rules('first_name','First Name','trim|required');
                $this->form_validation->set_rules('last_name','Last Name','trim|required');
                $this->form_validation->set_rules('email_id','Email Id','trim|required|valid_email|is_unique[admin.email_id]');
                $this->form_validation->set_rules('mobile_no','Mobile','trim|required|min_length[10]|max_length[10]');
                if($this->form_validation->run()!= FALSE)///////if form input fields are valid////////
                {
                    $this->load->helper('common');
                    $user_name = $this->input->post('user_name', true);
                    $first_name = $this->input->post('first_name', true);
                    $last_name = $this->input->post('last_name', true);
                    $mobile_no = $this->input->post('mobile_no', true);
                    $email_id = $this->input->post('email_id', true);
                    $role_id = $this->input->post('role_id', true);
                    //$userIp = $this->input->post('IP');
                    //$password=random_password();
                    $password=$this->input->post('password', true);
                    //$activation_key=getGUID();
                    //print_r($_POST); exit;
                    $data = array(
                        'role_id' => $role_id,
                        'username' => $user_name,
                        'first_name' => $first_name,
                        'last_name' => $last_name,
                        'email_id'=> $email_id,
                        'mobile_no'=> $mobile_no,
                        'password' => md5($password),
                        'created_at' => date('Y-m-d H:i:s'),
                        'status'=>1
                        //'activation_key' => $activation_key
                    );
                            //For image upload
                    if(isset($_FILES['profile_image']['name']) && $_FILES['profile_image']['name']!='')
                    { 
                        $this->load->library('image_lib');
                        $config = array(
                            'allowed_types' => 'jpg|jpeg|gif|png',
                            'upload_path' => $this->admin_user_image_path,
                            'max_size' => 0
                        );
                        $this->load->library('upload', $config);
                        if ( ! $this->upload->do_upload('profile_image'))
                        {
                            //echo $this->upload->display_errors('','');die();
                            $this->session->set_flashdata('error_msg',$this->upload->display_errors());
                            redirect("admin/adminuser");
                        }	
                        else
                        {	
                            $image_data = $this->upload->data("");
                            //$this->session->set_flashdata('message','image successfully uploaded');
                        }
                        // check EXIF and autorotate if needed
                        $this->load->library('image_autorotate', array('filepath' => $image_data['full_path'])); 

                        if($image_data['image_width']<280)
                        {
                            $this->session->set_flashdata('error_msg','Image width should be greater than 280 pixels');
                            redirect("admin/user");
                        }elseif($image_data['image_height']<280){
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

                        $profile_image=$image_data['file_name'];
                        $raw_name = $image_data['raw_name'];
                        $file_ext = $image_data['file_ext'];
                        $data['profile_image']=$profile_image;
                        // $data['raw_name']=$raw_name;
                        // $data['file_ext']=$file_ext;
                        //$data['image_link']=  base_url().'uploads/admin_user_image/'.$profile_image;
                    }
                    //end
                    $last_insert_id = $this->Common->getandinsertRecord('admin',$data);
                    
                    ///////////////send mail///////////
                    $admin_mail = 'noreply@paymentpoint.com';
                    $admin_name="Payment Point";

                    $subject="Payment Point Admin End Registration";
                    
                    $user_message = "Hi,<br><br>Admin added you in Payment Point.<br>Following are your login credential:<br><br>Username:$user_name<br>Password:$password<br>Thanks<br>PaymentPoint Team";
                    //$user_message=hyperlink($user_message);

                    //Load mail lib:
                    $this->load->library('email');
                    //$config['charset'] = 'iso-8859-1';
                    $config['mailtype'] = 'html';
                    $this->email->initialize($config);

                    //To send the mail with CI mail lib:
                    $this->email->from($admin_mail, $admin_name);
                    $this->email->to(trim($email)); 

                    $this->email->subject($subject);
                    $this->email->message($user_message);	

                    $this->email->send();
                    ///////////////////////////////////
                    //}

                    $this->session->set_flashdata('success_msg', 'User added successfully.');
                    //echo $user_message;die();
                    redirect("admin/adminuser");
                }
            }
            $data['roles']=$this->Common->getAllFields('user_roles', 'id, role');
            $data["site_title"] = 'Add Admin User';
            $data["menu_title"] = 'Add Admin User';
            $this->load->view('adminuser/add', $data);
	}

	///////////function to update User data/////////////
	public function edit($user_id)
	{
            if(!isAdminLoggedIn())
            {
                redirect("admin/login");
            }

            if ($this->input->server('REQUEST_METHOD') === 'POST')
            {
                $this->load->library('form_validation');
                $this->load->helper('security');
                $this->form_validation->set_rules('role_id','role','trim|required');
                //$this->form_validation->set_rules('user_name','User Name','trim|required|is_unique[admin.username]');
                $this->form_validation->set_rules('first_name','First Name','trim|required');
                $this->form_validation->set_rules('last_name','Last Name','trim|required');
                //$this->form_validation->set_rules('email_id','Email Id','trim|required|valid_email|is_unique[admin.email_id]');
                $this->form_validation->set_rules('mobile_no','Mobile','trim|required|min_length[10]|max_length[10]');
                if($this->form_validation->run()!= FALSE)///////if form input fields are valid////////
                {
                    //$user_name = $this->input->post('user_name', true);
                    $first_name = $this->input->post('first_name', true);
                    $last_name = $this->input->post('last_name', true);
                    $mobile_no = $this->input->post('mobile_no', true);
                    //$email_id = $this->input->post('email_id', true);
                    $role_id = $this->input->post('role_id', true);
                    //$userIp = $this->input->post('IP');
                    //print_r($_POST); exit;
                    $data = array(
                        'role_id' => $role_id,
                        //'username' => $user_name,
                        'first_name' => $first_name,
                        'last_name' => $last_name,
                        //'email_id'=> $email_id,
                        'mobile_no'=> $mobile_no,
                        'modified_at' => date('Y-m-d H:i:s')
                        //'activation_key' => $activation_key
                    );
                            //For image upload
                    if(isset($_FILES['profile_image']['name']) && $_FILES['profile_image']['name']!='')
                    { 
                        $this->load->library('image_lib');
                        $config = array(
                            'allowed_types' => 'jpg|jpeg|gif|png',
                            'upload_path' => $this->admin_user_image_path,
                            'max_size' => 0
                        );
                        $this->load->library('upload', $config);
                        if ( ! $this->upload->do_upload('profile_image'))
                        {
                            //echo $this->upload->display_errors('','');die();
                            $this->session->set_flashdata('error_msg',$this->upload->display_errors());
                            redirect("admin/adminuser");
                        }	
                        else
                        {	
                            $image_data = $this->upload->data("");
                            //$this->session->set_flashdata('message','image successfully uploaded');
                        }
                        // check EXIF and autorotate if needed
                        $this->load->library('image_autorotate', array('filepath' => $image_data['full_path'])); 

                        if($image_data['image_width']<280)
                        {
                            $this->session->set_flashdata('error_msg','Image width should be greater than 280 pixels');
                            redirect("admin/user");
                        }elseif($image_data['image_height']<280){
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

                        $profile_image=$image_data['file_name'];
                        $raw_name = $image_data['raw_name'];
                        $file_ext = $image_data['file_ext'];
                        $data['profile_image']=$profile_image;
                        
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
                        // $data['raw_name']=$raw_name;
                        // $data['file_ext']=$file_ext;
                        //$data['image_link']=  base_url().'uploads/admin_user_image/'.$profile_image;
                    }
                    //end
                    $this->Common->updateRecords("admin", array('id'=>$user_id), $data);
                    $this->session->set_flashdata('success_msg', 'Admin User updated successfully.');
                    redirect("admin/adminuser");
                    ///////////////send mail///////////
                    $admin_mail = 'noreply@paymentpoint.com';
                    $admin_name="Payment Point";

                    $subject="Payment Point Admin End Registration";
                    
                    $user_message = "Hi,<br><br>Admin has updated your profile in Payment Point.<br>Thanks<br>PaymentPoint Team";
                    //$user_message=hyperlink($user_message);

                    //Load mail lib:
                    $this->load->library('email');
                    //$config['charset'] = 'iso-8859-1';
                    $config['mailtype'] = 'html';
                    $this->email->initialize($config);

                    //To send the mail with CI mail lib:
                    $this->email->from($admin_mail, $admin_name);
                    $this->email->to(trim($email)); 

                    $this->email->subject($subject);
                    $this->email->message($user_message);	

                    $this->email->send();
                    ///////////////////////////////////
                    //}
                }
            }
            $user_id = $this->uri->segment(4);

            $data["user_id"] = $user_id;
            $data["site_title"] = 'Edit Admin User';
            $data["menu_title"] = 'Edit Admin User';
            $data['roles']=$this->Common->getAllFields('user_roles', 'id, role');
            $data["user"] = $this->Common->getSingle("admin m", 'm.id, m.role_id, m.first_name, m.last_name, m.profile_image, m.email_id, m.mobile_no', array('id'=>$user_id));
		
            $this->load->view('adminuser/edit', $data);
    }
    
    //This function is for view the user details///
    public function view($user_id)
    {
        if(!isAdminLoggedIn()) ///////if not logged in then will redirect to login page///////////
        {
            redirect("admin/login");
        }
        
        else
        {
            $data['user'] = $this->User->getAdminUserById($user_id);

            $data['user_id']=$user_id;	
            $data["site_title"] = 'User details';
            $data["menu_title"] = 'User Details';
            $this->load->view('adminuser/view', $data);
        }
    }

    //////function to delete single user///////////  */
    public function delete($id)
    {
        if(!isAdminLoggedIn()) 
        {
                redirect("admin/login");
        }
        else
        {
            $user = $this->Common->getSingle("admin", "profile_image", array('id'=>$id));
            if(isset($user['profile_image']) && $user['profile_image']!="" && file_exists($this->admin_user_image_path.'/'.$user['profile_image']))
            {
                unlink($this->admin_user_image_path.'/'.$user['profile_image']);
                $image=explode('.', $user['profile_image']);
                unlink($this->admin_user_image_path.'/resize/'.$image[0].IMG_SIZE_VERY_SMALL.'.'.$image[1]);
                unlink($this->admin_user_image_path.'/resize/'.$image[0].IMG_SIZE_SMALL.'.'.$image[1]);
                unlink($this->admin_user_image_path.'/resize/'.$image[0].IMG_SIZE_MEDIUM.'.'.$image[1]);
                unlink($this->admin_user_image_path.'/resize/'.$image[0].IMG_SIZE_STANDARD.'.'.$image[1]);
            }       
            $this->Common->deleteSingleRecord($id, 'admin');

            $this->session->set_flashdata('success_msg', 'User deleted successfully.');
            redirect("admin/adminuser");
        }
    }
    public function active_usr($id)
    {
        if(!isAdminLoggedIn()) 
        {
            redirect("login");
        }
        
        else
        {
            $data = array(
                    'is_verified' => 1
                    );
            $this->Common->updateData($id , "users", $data);
            $datatype = array(
                    'status' => 1
                    );

            $this->Common->updateDataCondition('user_types',$datatype, 'user_id = '.$id);
            $this->session->set_flashdata('success_msg', 'User deleted successfully.');
            redirect("user");
        }
    }

	///////////function to change User type status/////////////	
	public function change_type($typ_id = "")
	{
            if(!isAdminLoggedIn())
            {
                redirect("admin/login");
            }
            if($this->input->server('REQUEST_METHOD') === 'POST')
            {
                $uid = $this->input->post('check_ids');
                $status = $this->input->post('status');
                //echo $typ_id;	
                $data = array(
                   'status' => $status,
                );

                $this->Common->updateRecords('admin', array('id'=>$uid), $data);;///////call the model Cms to change the page block status////////
                $this->session->set_flashdata('success_msg', 'user status changed successfully.');
                redirect('admin/'.$this->controller);
            }
	}

	
    public function change_status_multi()
    {
        if(!isAdminLoggedIn())///////if not logged in then will redirect to login page///////////
        {
            redirect("login");
        }
        
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            $check_ids = $this->input->post('check_ids');
            $check_ids = explode('^', $check_ids);
            $data['is_verified'] = $this->input->post('status');
            if($this->input->post('status')==1) {
                $data['sus_request']=0;
            }
            $this->Common->changeMultiStatus($check_ids, $data, 'users');
            $dataval=array('status' => $this->input->post('status'));
            $this->Common->changeUserStatus($check_ids, $dataval, 'user_types');                                 
            $this->session->set_flashdata('success_msg', 'User Account changed successfully.');
            
            redirect("user/request");
        }
    }
    
} // exit of ci	