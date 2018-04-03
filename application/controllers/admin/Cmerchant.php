<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Cmerchant extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->controller = 'cmerchant';
		$this->load->model('admin/Childmerchant_model','child');
		$this->load->model('common_methods', 'Common');
		$this->load->theme('admintheme');
		$this->load->helper('auth');
		$this->load->library('form_validation');
		$this->load->library('image_lib');
		$this->user_image_path = './uploads/user_image/';

	}

    //////////function to load user list////////////

    public function index()
	{
        if(!isAdminLoggedIn())
        {
            redirect("admin/login");
        }
        $keyword = $this->input->get('search_keyword');
        $data["site_title"] = 'PG Aggregator Management';
        $data["menu_title"] = 'PG Aggregator Management';

        if ($this->uri->segment(4) === FALSE)
        {
            $offset = 0;
        }
        else
        {
            $offset = $this->uri->segment(4);
        }

        $limit=ADMIN_PER_PAGE;

        $config['total_rows'] = $this->child->countAllCmerchant($keyword);
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

        $data["child_merchant"] = $this->child->getAllCmerchant($keyword,$limit,$offset);
        $this->load->view('childmerchant/index', $data);
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
            $this->form_validation->set_rules('cm_type_id','Business Type','trim|required');
						$this->form_validation->set_rules('bd_merchant_id','BD Merchant Id','trim|required');
						$this->form_validation->set_rules('cm_name','Merchant Name','trim|required');
						$this->form_validation->set_rules('cm_return_url','Return Url','trim|required');

						$this->form_validation->set_rules('cm_email','Email Id','trim|valid_email');

						$this->form_validation->set_rules('mobile_no_1','Mobile','trim|min_length[10]|max_length[10]|required');
            $this->form_validation->set_rules('mobile_no_2','Alternate Mobile','trim|min_length[10]|max_length[10]');
            $this->form_validation->set_rules('land_line_1','Land Line','trim|min_length[10]|max_length[10]');
            $this->form_validation->set_rules('land_line_2','Alternate Land Line','trim|min_length[10]|max_length[10]');

            $this->form_validation->set_rules('cm_address_1','Address 1','trim|min_length[4]|max_length[150]|required');
            $this->form_validation->set_rules('cm_address_2','Address 2','trim|min_length[4]|max_length[150]');
						$this->form_validation->set_rules('cm_pincode','Pincode','trim|min_length[6]|max_length[6]|required');

            $this->form_validation->set_rules('cm_location','Location','trim|min_length[4]|max_length[100]');
            //$this->form_validation->set_rules('cm_city','City','trim|min_length[4]|max_length[100]');
            $this->form_validation->set_rules('cm_district','District','trim|min_length[4]|max_length[100]|required');
            $this->form_validation->set_rules('cm_state','State','trim|required|min_length[4]|max_length[100]|required');
            $this->form_validation->set_rules('cm_country','Country','trim|min_length[4]|max_length[100]|required');

            if($this->form_validation->run()!= FALSE)///////if form input fields are valid////////
						{
                $this->load->helper('common');
                $bd_merchant_id=$this->input->post('bd_merchant_id', true);
               // $user_type=$this->input->post('user_type', true);
                $isBdIdExist=$this->Common->isExistRecord('child_merchant', array('bd_merchant_id'=>$bd_merchant_id));
                //echo $isBdIdExist;exit;
                if($isBdIdExist) //if id doesn't exist
                {
                    $this->session->set_flashdata('error_msg', 'Sorry! Bill Desk Id already exist!');
                    //echo $user_message;die();
                    redirect("admin/cmerchant/add");
                }
                else
                {

                    $cm_name = $this->input->post('cm_name', true);
                    $cm_email = $this->input->post('cm_email', true);
                    $mobile_no_1 = $this->input->post('mobile_no_1', true);
                    $mobile_no_2 = $this->input->post('mobile_no_2', true);
                    $land_line_1 = $this->input->post('land_line_1', true);
                    $land_line_2 = $this->input->post('land_line_2', true);
                    $cm_type_id  =  $this->input->post('cm_type_id',true);
                    $cm_address_1 = $this->input->post('cm_address_1',true);
                    $cm_address_2 = $this->input->post('cm_address_2',true);
                    $cm_pincode = $this->input->post('cm_pincode',true);
                    $cm_location = $this->input->post('cm_location',true);
                  //  $cm_city = $this->input->post('cm_city',true);
                    $cm_district = $this->input->post('cm_district',true);
                    $cm_state = $this->input->post('cm_state',true);
                    $cm_country = $this->input->post('cm_country',true);
                    $cm_return_url = $this->input->post('cm_return_url',true);
                    $admin_id = $this->session->userdata('admin_id');


                    $data = array(

                        'pp_customer_id' => NULL,
                        'bd_merchant_id' => $bd_merchant_id,
                        'cm_name' => $cm_name,
                        'cm_email' => $cm_email,
                        'mobile_no_1' => $mobile_no_1,
                        'mobile_no_2'=> $mobile_no_2,
                        'land_line_1'=> $land_line_1,
                        'land_line_2' => $land_line_2,
                        'cm_type_id' => $cm_type_id,
                        'cm_address_1' => $cm_address_1,
                        'cm_address_2'=>$cm_address_2,
                        'cm_pincode' => $cm_pincode,
                        'cm_location' => $cm_location,
                        'cm_city' => NULL,
                        'cm_district' => $cm_district,
                        'cm_state' => $cm_state,
                        'cm_country' => $cm_country,
                        'cm_return_url' => $cm_return_url,
                        'cm_status'=>0,
                        'cm_created_on' => date('Y-m-d H:i:s'),
                        'cm_modified_on' => NULL,
                        'cm_created_by' => $admin_id,
                        'approved_by' =>NULL,
                        'approved_on' => NULL


                    );

                    $last_insert_id = $this->Common->getandinsertRecord('child_merchant',$data);

                    $pre='ppcm';
                    $pp_customer_id=get_unique_session_id($pre, $last_insert_id);

                    $r_pp_id = array(
                        'pp_customer_id' =>$pp_customer_id
                    );

                    $this->Common->updateRecords("child_merchant", array('id'=>$last_insert_id), $r_pp_id);

                    $this->session->set_flashdata('success_msg', 'Child Merchant added successfully.');
                    //echo $user_message;die();
                    redirect("admin/cmerchant/add");
                }

            }

        }

        $data["site_title"] = 'Add Child Merchant';
        $data["menu_title"] = 'Add Child Merchant';
        $this->load->view('childmerchant/add', $data);
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

						$this->form_validation->set_rules('cm_type_id','Business Type','trim|required');
						$this->form_validation->set_rules('bd_merchant_id','BD Merchant Id','trim|readonly');
						$this->form_validation->set_rules('cm_name','Merchant Name','trim|required');
						$this->form_validation->set_rules('cm_return_url','Return Url','trim|required');

						$this->form_validation->set_rules('cm_email','Email Id','trim|valid_email');

						$this->form_validation->set_rules('mobile_no_1','Mobile','trim|min_length[10]|max_length[10]|required');
            $this->form_validation->set_rules('mobile_no_2','Alternate Mobile','trim|min_length[10]|max_length[10]');
            $this->form_validation->set_rules('land_line_1','Land Line','trim|min_length[10]|max_length[10]');
            $this->form_validation->set_rules('land_line_2','Alternate Land Line','trim|min_length[10]|max_length[10]');

            $this->form_validation->set_rules('cm_address_1','Address 1','trim|min_length[4]|max_length[150]|required');
            $this->form_validation->set_rules('cm_address_2','Address 2','trim|min_length[4]|max_length[150]');
						$this->form_validation->set_rules('cm_pincode','Pincode','trim|min_length[6]|max_length[6]|required');

            $this->form_validation->set_rules('cm_location','Location','trim|min_length[4]|max_length[100]');
            //$this->form_validation->set_rules('cm_city','City','trim|min_length[4]|max_length[100]');
            $this->form_validation->set_rules('cm_district','District','trim|min_length[4]|max_length[100]|required');
            $this->form_validation->set_rules('cm_state','State','trim|required|min_length[4]|max_length[100]|required');
            $this->form_validation->set_rules('cm_country','Country','trim|min_length[4]|max_length[100]|readonly');

            if($this->form_validation->run()!= FALSE)///////if form input fields are valid////////
						{
                $this->load->helper('common');
								$bd_merchant_id =$this->input->post('bd_merchant_id',true);
								$cm_name = $this->input->post('cm_name', true);
								$cm_email = $this->input->post('cm_email', true);
								$mobile_no_1 = $this->input->post('mobile_no_1', true);
								$mobile_no_2 = $this->input->post('mobile_no_2', true);
								$land_line_1 = $this->input->post('land_line_1', true);
								$land_line_2 = $this->input->post('land_line_2', true);
								$cm_type_id  =  $this->input->post('cm_type_id',true);
								$cm_address_1 = $this->input->post('cm_address_1',true);
								$cm_address_2 = $this->input->post('cm_address_2',true);
								$cm_pincode = $this->input->post('cm_pincode',true);
								$cm_location = $this->input->post('cm_location',true);
								//  $cm_city = $this->input->post('cm_city',true);
								$cm_district = $this->input->post('cm_district',true);
								$cm_state = $this->input->post('cm_state',true);
								$cm_country = $this->input->post('cm_country',true);
								$cm_return_url = $this->input->post('cm_return_url',true);
								$admin_id = $this->session->userdata('admin_id');

                $data = array(
                        'cm_name' => $cm_name,
                        'cm_email' => $cm_email,
                        'mobile_no_1' => $mobile_no_1,
                        'mobile_no_2'=> $mobile_no_2,
                        'land_line_1'=> $land_line_1,
                        'land_line_2' => $land_line_2,
                        'cm_type_id' => $cm_type_id,
                        'cm_address_1' => $cm_address_1,
                        'cm_address_2'=>$cm_address_2,
                        'cm_pincode' => $cm_pincode,
                        'cm_location' => $cm_location,
                        'cm_district' => $cm_district,
                        'cm_state' => $cm_state,
                        'cm_return_url' => $cm_return_url,
                        'cm_status'=>0,
                        'cm_modified_on' => date('Y-m-d H:i:s'),
                        'cm_modified_by' => $admin_id
                	);

							  $this->Common->updateRecords("child_merchant", array('id'=>$user_id,'bd_merchant_id'=>$bd_merchant_id), $data);
                $this->session->set_flashdata('success_msg', 'Child Merchant updated successfully.');
                redirect("admin/cmerchant/add");
            }
        }

				$user_id = $this->uri->segment(4);

        $data["user_id"] = $user_id;
        $data["site_title"] = 'Edit Child Merchant';
        $data["menu_title"] = 'Edit Child Merchant';

        $data['child_merchant'] = $this->Common->getSingle("child_merchant", "", array('id'=>$user_id));

				$this->load->view('childmerchant/edit', $data);
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
            $data['child_merchant'] = $this->Common->getSingle("child_merchant", "", array('id'=>$user_id));
						//print_r($data);exit();
            $data['user_id']=$user_id;
            $data["site_title"] = 'User details';
            $data["menu_title"] = 'User Details';
            $this->load->view('childmerchant/view', $data);
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
            $user = $this->Common->getSingle("child_merchant", "", array('id'=>$id));

            $this->Common->deleteSingleRecord($id, 'child_merchant');

            $this->session->set_flashdata('success_msg', 'Child Merchant deleted successfully.');
            redirect("admin/cmerchant/index");
		}
	}



} // exit of ci
