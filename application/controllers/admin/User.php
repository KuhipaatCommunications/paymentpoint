<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller
{
	public function __construct()
	{
            parent::__construct();
            $this->controller = 'User';
            $this->load->model('admin/user_model', 'User');
            $this->load->model('common_methods', 'Common');
            $this->load->theme('admintheme');
            $this->load->helper('auth');
            $this->load->library('form_validation');
            $this->load->library('image_lib');
            $this->user_image_path = './uploads/user_image/';
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
        $data["site_title"] = 'User Management';
        $data["menu_title"] = 'User Management';

        if ($this->uri->segment(4) === FALSE)
        {
            $offset = 0;
        }
        else
        {
            $offset = $this->uri->segment(4);
        }
        $limit=ADMIN_PER_PAGE;

        $config['total_rows'] = $this->User->countAllUser($keyword);
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

        $data["user"] = $this->User->getAllUser($keyword,$limit,$offset);
        $this->load->view('user/index', $data);
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
            $this->form_validation->set_rules('user_type','User Type','trim|required');
						$this->form_validation->set_rules('first_name','First Name','trim|required');
						$this->form_validation->set_rules('last_name','Last Name','trim|required');
						$this->form_validation->set_rules('email','Email Id','trim|required|valid_email');
						$this->form_validation->set_rules('mobile_no','Mobile','trim|required|min_length[10]|max_length[10]');
            if($this->form_validation->run()!= FALSE)///////if form input fields are valid////////
            {
                $this->load->helper('common');
                $email=$this->input->post('email', true);
                $user_type=$this->input->post('user_type', true);
                $isEmailExist=$this->Common->isExistRecord('users', array('email'=>$email, 'user_type'=>$user_type));
                if($isEmailExist=="")
                {
                    $first_name = $this->input->post('first_name', true);
                    $middle_name = $this->input->post('middle_name', true);
                    $last_name = $this->input->post('last_name', true);
                    $mobile_no = $this->input->post('mobile_no', true);
                    $description = $this->input->post('description', true);
                    $address1 = $this->input->post('address', true);
                    $city = $this->input->post('city', true);
                    $state = $this->input->post('state', true);
                    $zipcode = $this->input->post('zipcode', true);
                    $country = $this->input->post('country', true);
                    $slg = create_unique_slug($first_name.' '.$last_name, 'users');
                    //$userIp = $this->input->post('IP');
                    $password=random_password();
                    //$activation_key=getGUID();
                    //print_r($_POST); exit;
                    $data = array(
                        'slug' => $slg,
                        'first_name' => $first_name,
                        'middle_name' => $middle_name,
                        'last_name' => $last_name,
                        'email'=> $email,
                        'mobile_no'=> $mobile_no,
                        'password' => md5($password),
                        'description' => $description,
                        'address1' => $address1,
                        'city' => $city,
                        'state' => $state,
                        'zipcode' => $zipcode,
                        'country' => $country,
                        //'IP' =>$userIp,
                        'created_on' => date('Y-m-d H:i:s'),
                        'status'=>1
                        //'activation_key' => $activation_key
                    );
                            //For image upload
                    if(isset($_FILES['profile_image']['name']) && $_FILES['profile_image']['name']!='')
                    {
                        $this->load->library('image_lib');
                        $config = array(
                            'allowed_types' => 'jpg|jpeg|gif|png',
                            'upload_path' => $this->user_image_path,
                            'max_size' => 0
                        );
                        $this->load->library('upload', $config);
                        if ( ! $this->upload->do_upload('profile_image'))
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

                        if($image_data['image_width']<280)
                        {
                            $this->session->set_flashdata('error_msg','Image width should be greater than 280 pixels');
                            redirect("admin/user");
                        }elseif($image_data['image_height']<280){
                            $this->session->set_flashdata('error_msg','Image height should be greater than 280 pixels');
                            redirect("admin/user");
                        }

                        $config = array(
                                'source_image' => $this->user_image_path . '/' .$image_data['file_name'],
                                'new_image' => $this->user_image_path . '/resize/' .$image_data['raw_name']. IMG_SIZE_VERY_SMALL . $image_data['file_ext'],
                                'maintain_ratio' => false,
                                'width' => 30,
                                'height' => 30
                        );
                        $this->image_lib->initialize($config);
                        $this->image_lib->resize();
                        $config = array(
                                'source_image' => $this->user_image_path . '/' .$image_data['file_name'],
                                'new_image' => $this->user_image_path . '/resize/' .$image_data['raw_name']. IMG_SIZE_SMALL . $image_data['file_ext'],
                                'maintain_ratio' => false,
                                'width' => 50,
                                'height' => 50
                        );
                        $this->image_lib->initialize($config);
                        $this->image_lib->resize();

                        $config = array(
                                'source_image' => $this->user_image_path . '/' .$image_data['file_name'],
                                'new_image' => $this->user_image_path . '/resize/' .$image_data['raw_name']. IMG_SIZE_MEDIUM . $image_data['file_ext'],
                                'maintain_ratio' => false,
                                'width' => 100,
                                'height' => 100
                        );
                        $this->image_lib->initialize($config);
                        $this->image_lib->resize();

                        $config = array(
                                'source_image' => $this->user_image_path . '/' .$image_data['file_name'],
                                'new_image' => $this->user_image_path . '/resize/' .$image_data['raw_name']. IMG_SIZE_STANDARD . $image_data['file_ext'],
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
                        $data['image_link']=  base_url().'uploads/user_image/'.$profile_image;
                    }
                    //end
                    $last_insert_id = $this->Common->getandinsertRecord('users',$data);
                    if($user_type=='m')
                        $pre='ppm';
                    elseif($user_type=='c')
                        $pre='ppc';
                    $pp_id=get_unique_session_id($pre, $last_insert_id);
                    $r_pp_id = array(
                        'pp_id' =>$pp_id
                    );

                    $this->Common->updateRecords("users", array('id'=>$last_insert_id), $r_pp_id);

                    ///////////////send mail///////////
                    $admin_mail = 'noreply@paymentpoint.com';
                    $admin_name="Payment Point";

                    /*if($abc[$i]==2)
                        $code='REGISTRATION_SS';
                    elseif($abc[$i]==3)
                        $code='REGISTRATION_SP';
                    //echo $code;
                    $emaildet=$this->Common->getSingleObj('email_templates', 'title,subject,content', array('code'=>$code));///////get email content for registration////////

                    $subject=$emaildet->subject;*/
                    $subject="Payment Point Registration";
                    //print_r($emaildet); exit;
                    ///////////get mail template from mandrill///
                    /*$content=mandril_template_info($emaildet->title);
                    if(isset($content['code']) && $content['code']!="")
                        $content_code=$content['code'];
                    else
                        $content_code="";
                    /////////////////////////////////////////////
                    $replace=array('[user]','[link]', '[content]');
                    $replaceby=array($last_name.",<br><br>Following are your login credential:<br><br>Email:$email<br>Password:$password",base_url().'home/index/activation/'.$activation_key.'/'.$abc[$i], $content_code);
                    $user_message = str_replace($replace,$replaceby,$emaildet->content);*/
                    $user_message = "Hi,<br><br>Admin added you in Payment Point.<br>Following are your login credential:<br><br>Email:$email<br>Password:$password<br>Thanks<br>PaymentPoint Team";
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
                    redirect("admin/user");
                }
                else
                {
                    $this->session->set_flashdata('error_msg', 'Sorry! Emailid already exist!');
                    //echo $user_message;die();
                    redirect("admin/user/add");
                }
            }

        }

        $data["site_title"] = 'Add User';
        $data["menu_title"] = 'Add User';
        $this->load->view('user/add', $data);
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
            //$this->form_validation->set_rules('user_type','User Type','trim|required');
			$this->form_validation->set_rules('first_name','First Name','trim|required');
			$this->form_validation->set_rules('last_name','Last Name','trim|required');
			//$this->form_validation->set_rules('email','Email Id','trim|required|valid_email');
			$this->form_validation->set_rules('mobile_no','Mobile','trim|required|min_length[10]|max_length[10]');
            if($this->form_validation->run()!= FALSE)///////if form input fields are valid////////
			{
                $this->load->helper('common');
                //$email=$this->input->post('email', true);
                $user_type=$this->input->post('user_type', true);
                $user_id=$this->input->post('user_id', true);
                $first_name = $this->input->post('first_name', true);
                $middle_name = $this->input->post('middle_name', true);
                $last_name = $this->input->post('last_name', true);
                $mobile_no = $this->input->post('mobile_no', true);
                $description = $this->input->post('description', true);
                $address1 = $this->input->post('address', true);
                $city = $this->input->post('city', true);
                $state = $this->input->post('state', true);
                $zipcode = $this->input->post('zipcode', true);
                $country = $this->input->post('country', true);
                $slg = create_unique_slug($first_name.' '.$last_name, 'users');
                //$userIp = $this->input->post('IP');
                //$password=random_password();
                //$activation_key=getGUID();
                //print_r($_POST); exit;
                $data = array(
                    'slug' => $slg,
                    'first_name' => $first_name,
                    'middle_name' => $middle_name,
                    'last_name' => $last_name,
                    'mobile_no'=> $mobile_no,
                    //'password' => md5($password),
                    'description' => $description,
                    'address1' => $address1,
                    'city' => $city,
                    'state' => $state,
                    'zipcode' => $zipcode,
                    'country' => $country,
                    //'IP' =>$userIp,
                    'modified_on' => date('Y-m-d H:i:s'),
                    'status'=>1
                    //'activation_key' => $activation_key
                );
                        //For image upload
                if(isset($_FILES['profile_image']['name']) && $_FILES['profile_image']['name']!='')
                {
                    $this->load->library('image_lib');
                    $config = array(
                        'allowed_types' => 'jpg|jpeg|gif|png',
                        'upload_path' => $this->user_image_path,
                        'max_size' => 0
                    );
                    $this->load->library('upload', $config);
                    if ( ! $this->upload->do_upload('profile_image'))
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

                    if($image_data['image_width']<280)
                    {
                        $this->session->set_flashdata('error_msg','Image width should be greater than 280 pixels');
                        redirect("admin/user");
                    }elseif($image_data['image_height']<280){
                        $this->session->set_flashdata('error_msg','Image height should be greater than 280 pixels');
                        redirect("admin/user");
                    }

                    $config = array(
                            'source_image' => $this->user_image_path . '/' .$image_data['file_name'],
                            'new_image' => $this->user_image_path . '/resize/' .$image_data['raw_name']. IMG_SIZE_VERY_SMALL . $image_data['file_ext'],
                            'maintain_ratio' => false,
                            'width' => 30,
                            'height' => 30
                    );
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                    $config = array(
                            'source_image' => $this->user_image_path . '/' .$image_data['file_name'],
                            'new_image' => $this->user_image_path . '/resize/' .$image_data['raw_name']. IMG_SIZE_SMALL . $image_data['file_ext'],
                            'maintain_ratio' => false,
                            'width' => 50,
                            'height' => 50
                    );
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();

                    $config = array(
                            'source_image' => $this->user_image_path . '/' .$image_data['file_name'],
                            'new_image' => $this->user_image_path . '/resize/' .$image_data['raw_name']. IMG_SIZE_MEDIUM . $image_data['file_ext'],
                            'maintain_ratio' => false,
                            'width' => 100,
                            'height' => 100
                    );
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();

                    $config = array(
                            'source_image' => $this->user_image_path . '/' .$image_data['file_name'],
                            'new_image' => $this->user_image_path . '/resize/' .$image_data['raw_name']. IMG_SIZE_STANDARD . $image_data['file_ext'],
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
                    $data['image_link']=  base_url().'uploads/user_image/'.$profile_image;
                }
                //end

                $this->Common->updateRecords("users", array('id'=>$user_id), $data);
                $this->session->set_flashdata('success_msg', 'User updated successfully.');
                redirect("admin/user");
            }
        }
        $user_id = $this->uri->segment(4);

        $data["user_id"] = $user_id;
        $data["site_title"] = 'Edit User';
        $data["menu_title"] = 'Edit User';

        $data["user"] = $this->Common->getSingle("users m", 'm.id, m.first_name, m.middle_name, m.last_name, m.profile_image, m.email, m.mobile_no, m.description, m.address1, m.city, m.state, m.country, m.zipcode, m.created_on', array('id'=>$user_id));

		$this->load->view('user/edit', $data);
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
            $data['user'] = $this->Common->getSingle("users", "", array('id'=>$user_id));

            $data['user_id']=$user_id;
            $data["site_title"] = 'User details';
            $data["menu_title"] = 'User Details';
            $this->load->view('user/view', $data);
        }
    }

	//////function to delete single question///////////  */
	public function delete($id)
	{
		if(!isAdminLoggedIn())
		{
			redirect("admin/login");
		}
		else
		{
            $user = $this->Common->getSingle("users", "profile_image", array('id'=>$id));
            if(isset($user['profile_image']) && $user['profile_image']!="" && file_exists($this->user_image_path.'/'.$user['profile_image']))
            {
                unlink($this->user_image_path.'/'.$user['profile_image']);
                $image=explode('.', $user['profile_image']);
                unlink($this->user_image_path.'/resize/'.$image[0].IMG_SIZE_VERY_SMALL.'.'.$image[1]);
                unlink($this->user_image_path.'/resize/'.$image[0].IMG_SIZE_SMALL.'.'.$image[1]);
                unlink($this->user_image_path.'/resize/'.$image[0].IMG_SIZE_MEDIUM.'.'.$image[1]);
                unlink($this->user_image_path.'/resize/'.$image[0].IMG_SIZE_STANDARD.'.'.$image[1]);
            }
            $this->Common->deleteSingleRecord($id, 'users');

            $this->session->set_flashdata('success_msg', 'User deleted successfully.');
            redirect("admin/user");
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
			redirect("login");
		}

		if($this->input->server('REQUEST_METHOD') === 'POST')
		{

			$uid = $this->input->post('check_ids');
			$status = $this->input->post('status');
			//echo $typ_id;
			$data = array(
			   'status' => $status,
			);

			$this->Common->updateDataCondition('user_types',$data, 'user_id = '.$uid.' and user_type_id = '.$typ_id);
			//echo $this->db->last_query(); //die;
			$this->session->set_flashdata('success_msg', 'User status changed successfully.');
			//$this->
			redirect("user");
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
