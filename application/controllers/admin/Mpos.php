<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mpos extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		//$this->controller = 'mpos';
		$this->load->model('admin/Mpos_model','mpos');
		$this->load->model('common_methods', 'Common');
		$this->load->theme('admintheme');
		$this->load->helper('auth');
		$this->load->library('form_validation');
		$this->load->library('image_lib');
		//$this->user_image_path = './uploads/user_image/';

	}

    //////////function to load user list////////////

    public function index()
	{
        if(!isAdminLoggedIn())
        {
            redirect("admin/login");
        }
        $keyword = $this->input->get('search_keyword');
        $data["site_title"] = 'MPos Merchant Management';
        $data["menu_title"] = 'MPos Merchant Management';

        if ($this->uri->segment(4) === FALSE)
        {
            $offset = 0;
        }
        else
        {
            $offset = $this->uri->segment(4);
        }

        $limit=ADMIN_PER_PAGE;

        $config['total_rows'] = $this->mpos->countAllMposMerchant($keyword);
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

        $data["mpos_merchant"] = $this->mpos->getAllMopsMerchant($keyword,$limit,$offset);

        $this->load->view('mpos/index', $data);
	}
    /////////add Child Merchant////////////
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
            $this->form_validation->set_rules('middle_name','Middle Name','trim');
            $this->form_validation->set_rules('last_name','Last Name','trim|required');

		    		$this->form_validation->set_rules('email','Email Id','trim|valid_email');
						$this->form_validation->set_rules('mobile_no_1','Mobile','trim|required|min_length[10]|max_length[10]');
            $this->form_validation->set_rules('mobile_no_2','Alternate Mobile','trim|min_length[10]|max_length[10]');


            $this->form_validation->set_rules('address_1','Address 1','trim|required|min_length[4]|max_length[150]');
            $this->form_validation->set_rules('address_2','Address 2','trim|min_length[4]|max_length[150]');



            $this->form_validation->set_rules('city','City/village/Town','trim|required|min_length[4]|max_length[100]');
            $this->form_validation->set_rules('pincode','Pincode','trim|required|min_length[6]|max_length[6]');
            $this->form_validation->set_rules('district','District','trim|required|min_length[4]|max_length[100]');
            $this->form_validation->set_rules('state','State','trim|required|required|min_length[4]|max_length[100]');
            $this->form_validation->set_rules('country','Country','trim|required|min_length[4]|max_length[100]');

            if($this->form_validation->run()!= FALSE)///////if form input fields are valid////////
						{

                $this->load->helper('common');
                $pp_id=$this->input->post('pp_id', true);
               // $user_type=$this->input->post('user_type', true);
                $isIdExist=$this->Common->isExistRecord('users', array('pp_id'=>$pp_id));
                //echo $isBdIdExist;exit;
                if($isIdExist) //if id doesn't exist
                {
                    $this->session->set_flashdata('error_msg', 'Sorry! Merchant Id already exist!');
                    //echo $user_message;die();
                    redirect("admin/mpos/add");
                }
                else
                {

                    $first_name = $this->input->post('first_name', true);
                    $middle_name = $this->input->post('middle_name', true);
                    $last_name = $this->input->post('last_name', true);
                    $email = $this->input->post('email', true);
                    $mobile_no_1 = $this->input->post('mobile_no_1', true);
                    $mobile_no_2 = $this->input->post('mobile_no_2', true);
                    $address_1  =  $this->input->post('address_1',true);
                    $address_2 = $this->input->post('address_2',true);
                    $city = $this->input->post('city',true);
                    $pincode = $this->input->post('pincode',true);
                    $district = $this->input->post('district',true);
                    $state = $this->input->post('state',true);
                    $country = $this->input->post('country',true);
                    $user_type = $this->input->post('user_type',true);
                    $slug = create_unique_slug($first_name.' '.$last_name, 'users');
                    $admin_id = $this->session->userdata('admin_id');


                    $data = array(

                        'user_type' => $user_type,
                        'first_name' => $first_name,
                        'middle_name' => $middle_name,
                        'last_name' => $last_name,
                        'email' => $email,
                        'mobile_no' => $mobile_no_1,
                        'alt_mobile_no' => $mobile_no_2,
                        'address1' => $address_1,
                        'address2' => $address_2,
                        'city'=> $city,
                        'zipcode'=>$pincode,
                        'district' =>$district,
                        'state'=> $state,
                        'country'=>$country,
                        'slug' => $slug,
                        'created_on' => date('Y-m-d H:i:s'),
                        'created_by' => $admin_id,
                        'is_verified' => 0,
                        'is_mpos' =>1,
                        'status' => 0,
                        'modified_on' => NULL,
                        'modified_by' => NULL,


                    );

                    $last_insert_id = $this->Common->getandinsertRecord('users',$data);

                    if($user_type == 'm')
                        $pre='ppm';

                    $pp_id=get_unique_session_id($pre, $last_insert_id);

                    $r_pp_id = array(
                        'pp_id' =>$pp_id
                    );

                    $this->Common->updateRecords("users", array('id'=>$last_insert_id), $r_pp_id);

                    $this->session->set_flashdata('success_msg', 'Mpos Merchant added successfully.');
                    //echo $user_message;die();
                    redirect("admin/mpos/add");
                }

            }

        }

        $data["site_title"] = 'Add Mpos Merchant';
        $data["menu_title"] = 'Add Mpos Merchant';
        $this->load->view('mpos/add', $data);
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


             //   $this->form_validation->set_rules('user_type','User Type','trim|required');
            $this->form_validation->set_rules('first_name','First Name','trim|required');
            $this->form_validation->set_rules('middle_name','Middle Name','trim');
            $this->form_validation->set_rules('last_name','Last Name','trim|required');

            $this->form_validation->set_rules('email','Email Id','trim|valid_email');
            $this->form_validation->set_rules('mobile_no_1','Mobile','trim|required|min_length[10]|max_length[10]');
            $this->form_validation->set_rules('mobile_no_2','Alternate Mobile','trim|min_length[10]|max_length[10]');

            // $this->form_validation->set_rules('land_line_1','Land Line','trim|min_length[10]|max_length[10]');
            // $this->form_validation->set_rules('land_line_2','Alternate Land Line','trim|min_length[10]|max_length[10]');

            $this->form_validation->set_rules('address_1','Address 1','trim|required|min_length[4]|max_length[150]');
            $this->form_validation->set_rules('address_2','Address 2','trim|min_length[4]|max_length[150]');

            //$this->form_validation->set_rules('cm_location','Location','trim|min_length[4]|max_length[100]');

            $this->form_validation->set_rules('city','City/village/Town','trim|required|min_length[4]|max_length[100]');
            $this->form_validation->set_rules('district','District','trim|required|min_length[4]|max_length[100]');
            $this->form_validation->set_rules('state','State','trim|required|required|min_length[4]|max_length[100]');
            $this->form_validation->set_rules('country','Country','trim|required|min_length[4]|max_length[100]');


            if($this->form_validation->run()!= FALSE)///////if form input fields are valid////////
			{

                    $this->load->helper('common');

                    $first_name = $this->input->post('first_name', true);
                    $middle_name = $this->input->post('middle_name', true);
                    $last_name = $this->input->post('last_name', true);
                    $email = $this->input->post('email', true);
                    $mobile_no_1 = $this->input->post('mobile_no_1', true);
                    $mobile_no_2 = $this->input->post('mobile_no_2', true);
                    $address_1  =  $this->input->post('address_1',true);
                    $address_2 = $this->input->post('address_2',true);
                    $city = $this->input->post('city',true);
                    $pincode = $this->input->post('pincode',true);
                    $district = $this->input->post('district',true);
                    $state = $this->input->post('state',true);
                    $country = $this->input->post('country',true);
                    $user_type = $this->input->post('user_type',true);
                    $slug = create_unique_slug($first_name.' '.$last_name, 'users');
                    $admin_id = $this->session->userdata('admin_id');
                    $user_id = $this->input->post('user_id',true);

                    $data = array(

                        'first_name' => $first_name,
                        'middle_name' => $middle_name,
                        'last_name' => $last_name,
                        'email' => $email,
                        'mobile_no' => $mobile_no_1,
                        'alt_mobile_no' => $mobile_no_2,
                        'address1' => $address_1,
                        'address2' => $address_2,
                        'city'=> $city,
                        'zipcode'=>$pincode,
                        'district' =>$district,
                        'state'=> $state,
                        'country'=>$country,
                        'slug' => $slug,
                        'is_verified' => 0,
                        'is_mpos' =>1,
                        'status' => 0,
                        'modified_on' => date('Y-m-d H:i:s'),
                        'modified_by' => $admin_id,


                    );
                        //For image upload
               /* if(isset($_FILES['profile_image']['name']) && $_FILES['profile_image']['name']!='')
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
                //end*/

                $this->Common->updateRecords("users", array('id'=>$user_id), $data);
                $this->session->set_flashdata('success_msg', 'User updated successfully.');
                redirect("admin/mpos/edit/$user_id");
            }
        }
        $user_id = $this->uri->segment(4);

        $data["user_id"] = $user_id;
        $data["site_title"] = 'Edit Mpos Merchant';
        $data["menu_title"] = 'Edit Mpos Merchant';

        $data["mpos_merchant"] = $this->Common->getSingle("users m",'m.id, m.first_name, m.middle_name, m.last_name, m.email, m.mobile_no, m.alt_mobile_no, m.address1,m.address2, m.city,m.district, m.state, m.country, m.zipcode', array('id'=>$user_id));

		$this->load->view('mpos/edit', $data);
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

		//author:Lakhyadeep Chutia
		//created on:27/03/2018
		//last modified on:

		//-----function to load not-assign pos device -------//
    public function assign_pos($user_id)
    {

        if(!isAdminLoggedIn())///////if not logged in then will redirect to login page///////////
        {
            redirect("login");
        }


        if($this->input->server('REQUEST_METHOD') === 'POST')

        {

            $this->load->library('form_validation');
            $this->load->helper('security');

            $this->form_validation->set_rules('device_no','Device Number','trim|required');
						$this->form_validation->set_rules('plan_name','Plan Name','trim|required');
						$this->form_validation->set_rules('plan_amount','Amount Name','trim|required');


            if($this->form_validation->run()!= FALSE)///////if form input fields are valid////////
            {

                    $device_no = $this->input->post('device_no', true);

                    $device_id = $this->Common->getSingle("device_details", "id", array('status'=>'0',"device_no"=>$device_no));

                    $user_id =  $this->input->post('user_id', true);

										$plan_name = $this->input->post('plan_name', true);
										$plan_amount = $this->input->post('plan_amount', true);
										$admin_id = $this->session->userdata('admin_id');

                    if($device_id!="" && count($device_id)>0)

                    {

                       foreach ($device_id as $key => $value) {
                                                    # code.
                        $data = array(

                                'user_id' =>$user_id,
                                'device_id'=>$value,
                                'created_on'=>date('Y-m-d H:i:s')

                               );

												$plan_data = array(

																'mpos_merchant_id' => $user_id,
																'plan_name' => $plan_name,
																'plan_amount' => $plan_amount,
																'created_on' => date('Y-m-d H:i:s'),
																'created_by' => $admin_id,
																'modified_on' => NULL,
																'modified_by' => NULL,
													);
                        }

                         $this->Common->insertRecord('merchant_device', $data);

												 //$this->Common->insertRecord('merchant_plan', $plan_data);
												 $last_insert_id = $this->Common->getandinsertRecord('merchant_plan',$plan_data);

                         $this->session->set_flashdata('success_msg', "Device Assign successfully!");

												 //update the merchant_business plan_id
												 $this->Common->updateRecords("merchant_business", array('mpos_merchant_id'=>$user_id), array('plan_id'=>$last_insert_id));

												 //update when device is allocated to merchant
												 $this->Common->updateRecords("device_details", array('id'=>$value), array('status'=>'1'));


                    }
                    else{

                         $this->session->set_flashdata('error_msg', "Device Not Found or Alread Allocated!!!");
                    }

            }

        }

        $data["user_id"] = $user_id;

				$data["unassign_pos"] = $this->Common->getAllFields("device_details",'device_no', array('status'=>'0'));

        $this->load->view("mpos/assign_pos",$data);

    }



		// public function add_business($user_id)
		// {
		// 	# code...
		// 	if(!isAdminLoggedIn())
		// 	{
		// 		redirect("admin/login");
		//
		// 	}
		//
		// 			if ($this->input->server('REQUEST_METHOD') === 'POST')
		// 			{
		//
		//
		// 					$this->load->library('form_validation');
		// 					$this->load->helper('security');
		//
		// 					//$this->form_validation->set_rules('user_id','user Id','trim|required');
		// 					$this->form_validation->set_rules('business_type','Business Type','trim|required');
		// 					$this->form_validation->set_rules('marketing_name','Marketing Name','trim|required');
		//
		// 					$this->form_validation->set_rules('email','Email Id','trim|valid_email');
		// 					$this->form_validation->set_rules('mobile_no_1','Mobile No','trim|required|min_length[10]|max_length[10]');
		// 					$this->form_validation->set_rules('alt_mobile_no','Alternate Mobile No','trim|min_length[10]|max_length[10]');
		//
		//
		// 					$this->form_validation->set_rules('address_1','Address 1','trim|required|min_length[4]|max_length[150]');
		// 					$this->form_validation->set_rules('address_2','Address 2','trim|min_length[4]|max_length[150]');
		//
		//
		//
		// 					$this->form_validation->set_rules('city','City/village/Town','trim|required|min_length[4]|max_length[100]');
		// 					//$this->form_validation->set_rules('pincode','Pincode','trim|required|min_length[6]|max_length[6]');
		// 					$this->form_validation->set_rules('district','District','trim|required|min_length[4]|max_length[100]');
		// 					// $this->form_validation->set_rules('state','State','trim|required|required|min_length[4]|max_length[100]');
		// 					// $this->form_validation->set_rules('country','Country','trim|required|min_length[4]|max_length[100]');
		//
		//
		// 					if($this->form_validation->run()!= FALSE)///////if form input fields are valid////////
		// 					{
		//
		// 									$user_id = $this->input->post('user_id', true);
		// 									$business_type = $this->input->post('business_type', true);
		// 									$marketing_name = $this->input->post('marketing_name', true);
		// 									$email = $this->input->post('email', true);
		// 									$mobile_no_1 = $this->input->post('mobile_no_1', true);
		// 									$alt_mobile_no = $this->input->post('alt_mobile_no', true);
		// 									$address_1  =  $this->input->post('address_1',true);
		// 									$address_2 = $this->input->post('address_2',true);
		// 									$city = $this->input->post('city',true);
		// 								//	$pincode = $this->input->post('pincode',true);
		// 									$district = $this->input->post('district',true);
		// 									//$state = $this->input->post('state',true);
		// 									//$country = $this->input->post('country',true);
		// 									//$user_type = $this->input->post('user_type',true);
		// 									//$slug = create_unique_slug($first_name.' '.$last_name, 'users');
		// 									$admin_id = $this->session->userdata('admin_id');
		//
		//
		// 									$data = array(
		//
		// 											'mpos_merchant_id' => $user_id,
		// 											'plan_id' =>NULL,
		// 											'business_type' => $business_type,
		// 											'marketing_name' => $marketing_name,
		// 											'email' => $email,
		// 											'mobile_no_1' => $mobile_no_1,
		// 											'alt_mobile_no' => $alt_mobile_no,
		// 											'address_1' => $address_1,
		// 											'address_2' => $address_2,
		// 											'city'=> $city,
		// 											'district' =>$district,
		// 											'created_on' => date('Y-m-d H:i:s'),
		// 											'created_by' => $admin_id,
		// 											'modified_on' => NULL,
		// 											'modified_by' => NULL,
		// 									);
		//
		// 									//print_r($data);exit();
		// 									$this->Common->insertRecord("merchant_business", $data);
		//
		// 									$this->session->set_flashdata('success_msg', 'Merchant Business Address added  successfully.');
		// 									//echo $user_message;die();
		// 									//redirect("admin/mpos/add_business");
		// 							}
		// 						}
		//
		// 				//retrive data from model to  passing to the view.
		//
		// 				$user_id = $this->uri->segment(4);
		//
		// 			 	$data["user_id"]= $user_id;
		// 			 	$data["site_title"] = 'Add Merchant Business';
		// 			 	$data["menu_title"] = 'Add Merchant Business';
		//
		// 				//print_r($data);exit();
		// 				$this->load->view('mpos/add_business',$data);
		//
		// }








} // exit of ci
