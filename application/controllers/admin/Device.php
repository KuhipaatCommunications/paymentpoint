<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Device extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		//$this->controller = 'mpos';
		$this->load->model('admin/device_model','device');
		$this->load->model('common_methods', 'Common');
		$this->load->theme('admintheme');
		$this->load->helper('auth');
		$this->load->library('form_validation');
		$this->load->library('image_lib');
		//$this->user_image_path = './uploads/user_image/';

	}

    //////////function to load Device list////////////

    public function index()
	{
        if(!isAdminLoggedIn())
        {
            redirect("admin/login");
        }
        $keyword = $this->input->get('search_keyword');
        $data["site_title"] = 'Device  Management';
        $data["menu_title"] = 'Device Management';

        if ($this->uri->segment(4) === FALSE)
        {
            $offset = 0;
        }
        else
        {
            $offset = $this->uri->segment(4);
        }

        $limit=ADMIN_PER_PAGE;

        $config['total_rows'] = $this->device->countAllDevice($keyword);
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


        $data["device"] = $this->device->getAllDevice($keyword,$limit,$offset);



        $this->load->view('device/index', $data);

	}

    /////////add Device////////////
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

            if($this->input->post('company_name')== "others")
                $this->form_validation->set_rules('other_company_name','Other Company Name','trim|required');

            if($this->input->post('device_type')== "others")
                $this->form_validation->set_rules('other_device_type','Other Device Type','trim|required');

            $this->form_validation->set_rules('company_name','Select Company ','trim|required');
            $this->form_validation->set_rules('device_type','Select Device Type','trim|required');
            $this->form_validation->set_rules('device_no','Select Device No','trim|required');




            if($this->form_validation->run()!= FALSE)///////if form input fields are valid////////
			{

                $this->load->helper('common');
                $device_no=$this->input->post('device_no', true);
               // $user_type=$this->input->post('user_type', true);
                $isIdExist=$this->Common->isExistRecord('device_details', array('device_no'=>$device_no));
                //echo $isBdIdExist;exit;
                if($isIdExist) //if id doesn't exist
                {
                    $this->session->set_flashdata('error_msg', 'Sorry! Device Number already exist!');
                    //echo $user_message;die();
                    redirect("admin/device/add");
                }
                else
                {


                    if($this->input->post('company_name') == "others")
                        $company_name = $this->input->post('other_company_name',true);
                    else
                        $company_name = $this->input->post('company_name',true);

                    if($this->input->post('device_type') == "others")
                        $device_type = $this->input->post('other_device_type',true);
                    else
                        $device_type = $this->input->post('device_type',true);


                    $device_no = $this->input->post('device_no', true);
                    $device_name = $this->input->post('device_name',true);
                    $admin_id = $this->session->userdata('admin_id');



                    $data = array(

                        'device_no' => $device_no,
                        'company_name' => $company_name,
                        'device_type' =>$device_type,
                        'device_name' =>$device_name,
                        'status' => 0, //  0 => device not used by any mpos merchant.
                        'created_on' => date('Y-m-d H:i:s'),
                        'created_by' => $admin_id,
                        'modified_on' => NULL,
                        'modified_by' => NULL,

                    );


                    $last_insert_id = $this->Common->getandinsertRecord('device_details',$data);
                    $this->session->set_flashdata('success_msg', 'Device Details added successfully.');
                    //echo $user_message;die();
                    redirect("admin/device/add");
                }

            }

        }


        $data['companies'] = $this->device->getAllCompanyName();

        $data["company_name"] = $this->input->post('company_name');
        $data["device_type"] = $this->input->post('device_type');
        $data["site_title"] = 'Add Device';
        $data["menu_title"] = 'Add Device';


        $this->load->view('device/add', $data);
	}



	///////////function to update User data/////////////
	public function edit($device_id)
	{
		if(!isAdminLoggedIn())
		{
			redirect("admin/login");
		}

		if ($this->input->server('REQUEST_METHOD') === 'POST')
        {


            $this->load->library('form_validation');
            $this->load->helper('security');

            // $this->form_validation->set_rules('company_name','Select Company ','trim|required');
            // $this->form_validation->set_rules('device_type','Select Device Type','trim|required');
            $this->form_validation->set_rules('device_no',' Enter Device No','trim|required');



            if($this->form_validation->run()!= FALSE)///////if form input fields are valid////////
			{


                    $device_no = $this->input->post('device_no', true);
                    // $company_name = $this->input->post('company_name',true);
                    // $device_type = $this->input->post('device_type',true);
                    // $device_name = $this->input->post('device_name',true);
                     $admin_id = $this->session->userdata('admin_id');


                    $data = array(

                        'device_no' => $device_no,
                        'status' => 0, //  0 => device not used by any mpos merchant.
                        'modified_on' => date('Y-m-d H:i:s'),
                        'modified_by' => $admin_id,


                    );

                $this->Common->updateRecords("device_details", array('id'=>$device_id), $data);
                $this->session->set_flashdata('success_msg', 'Device Details updated successfully.');
                redirect("admin/device/edit/$device_id");
            }
        }

        $device_id = $this->uri->segment(4);

       // $data['companies'] = $this->device->getAllCompanyName();




        $data["device_id"] = $device_id;
        $data["site_title"] = 'Edit Device Details';
        $data["menu_title"] = 'Edit Device';

        $data["device"] = $this->Common->getSingle("device_details m",'m.id, m.device_no, m.company_name, m.device_type, m.status', array('id'=>$device_id));

        // $data["device_type"] = $this->Common->getAllFields("device_details", "device_type", array('company_name' => $data["device"]["company_name"]));


         $data["mpos_merchant"] = $this->Common->getAllFields("users m",'m.first_name', array('is_mpos'=>'1'));

         //print_r($data); exit();

		$this->load->view('device/edit', $data);

    }


    //This function is for view the user details///
    public function view($device_id)
    {
        if(!isAdminLoggedIn()) ///////if not logged in then will redirect to login page///////////
        {
            redirect("admin/login");
        }

        else
        {
            $data['device'] = $this->Common->getSingle("device_details", "", array('id'=>$device_id));

            $data["merchant_name"] = $this->device->getMerchantName($device_id);



            $data['device_id']=$device_id;
            $data["site_title"] = 'Device details';
            $data["menu_title"] = 'Device Details';

            // echo "<pre>";
            // print_r($data);
            // echo "</pre>";
            // exit();

            $this->load->view('device/view', $data);
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
            $user = $this->Common->getSingle("device_details", "", array('id'=>$id));
            // if(isset($user['profile_image']) && $user['profile_image']!="" && file_exists($this->user_image_path.'/'.$user['profile_image']))
            // {
            //     unlink($this->user_image_path.'/'.$user['profile_image']);
            //     $image=explode('.', $user['profile_image']);
            //     unlink($this->user_image_path.'/resize/'.$image[0].IMG_SIZE_VERY_SMALL.'.'.$image[1]);
            //     unlink($this->user_image_path.'/resize/'.$image[0].IMG_SIZE_SMALL.'.'.$image[1]);
            //     unlink($this->user_image_path.'/resize/'.$image[0].IMG_SIZE_MEDIUM.'.'.$image[1]);
            //     unlink($this->user_image_path.'/resize/'.$image[0].IMG_SIZE_STANDARD.'.'.$image[1]);
            // }
            $this->Common->deleteSingleRecord($id, 'device_details');

            $this->session->set_flashdata('success_msg', 'Device deleted successfully.');
            redirect("admin/device/index");
		}
	}



} // exit of ci
