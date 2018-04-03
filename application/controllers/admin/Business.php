<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Business extends CI_Controller
{

  public function __construct()
  {
      parent::__construct();

      //$this->load->model('admin/bank_model','bank');
      $this->load->model('common_methods', 'Common');
      $this->load->theme('admintheme');
      $this->load->helper('auth');
      $this->load->library('form_validation');
      $this->load->helper('security');

  }

  public function add($user_id)
  {
    # code...
    if(!isAdminLoggedIn())
    {
      redirect("admin/login");

    }

        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {


            $this->load->library('form_validation');
            $this->load->helper('security');

            //$this->form_validation->set_rules('user_id','user Id','trim|required');
            $this->form_validation->set_rules('business_type','Business Type','trim|required');
            $this->form_validation->set_rules('marketing_name','Marketing Name','trim|required');

            $this->form_validation->set_rules('email','Email Id','trim|valid_email');
            $this->form_validation->set_rules('mobile_no_1','Mobile No','trim|required|min_length[10]|max_length[10]');
            $this->form_validation->set_rules('alt_mobile_no','Alternate Mobile No','trim|min_length[10]|max_length[10]');


            $this->form_validation->set_rules('address_1','Address 1','trim|required|min_length[4]|max_length[150]');
            $this->form_validation->set_rules('address_2','Address 2','trim|min_length[4]|max_length[150]');



            $this->form_validation->set_rules('city','City/village/Town','trim|required|min_length[4]|max_length[100]');
            //$this->form_validation->set_rules('pincode','Pincode','trim|required|min_length[6]|max_length[6]');
            $this->form_validation->set_rules('district','District','trim|required|min_length[4]|max_length[100]');
            // $this->form_validation->set_rules('state','State','trim|required|required|min_length[4]|max_length[100]');
            // $this->form_validation->set_rules('country','Country','trim|required|min_length[4]|max_length[100]');


            if($this->form_validation->run()!= FALSE)///////if form input fields are valid////////
            {

                    $user_id = $this->input->post('user_id', true);
                    $business_type = $this->input->post('business_type', true);
                    $marketing_name = $this->input->post('marketing_name', true);
                    $email = $this->input->post('email', true);
                    $mobile_no_1 = $this->input->post('mobile_no_1', true);
                    $alt_mobile_no = $this->input->post('alt_mobile_no', true);
                    $address_1  =  $this->input->post('address_1',true);
                    $address_2 = $this->input->post('address_2',true);
                    $city = $this->input->post('city',true);
                  //	$pincode = $this->input->post('pincode',true);
                    $district = $this->input->post('district',true);
                    //$state = $this->input->post('state',true);
                    //$country = $this->input->post('country',true);
                    //$user_type = $this->input->post('user_type',true);
                    //$slug = create_unique_slug($first_name.' '.$last_name, 'users');
                    $admin_id = $this->session->userdata('admin_id');


                    $data = array(

                        'mpos_merchant_id' => $user_id,
                        'plan_id' =>NULL,
                        'business_type' => $business_type,
                        'marketing_name' => $marketing_name,
                        'email' => $email,
                        'mobile_no_1' => $mobile_no_1,
                        'alt_mobile_no' => $alt_mobile_no,
                        'address_1' => $address_1,
                        'address_2' => $address_2,
                        'city'=> $city,
                        'district' =>$district,
                        'created_on' => date('Y-m-d H:i:s'),
                        'created_by' => $admin_id,
                        'modified_on' => NULL,
                        'modified_by' => NULL,
                    );

                    //print_r($data);exit();Bank
                    $this->Common->insertRecord("merchant_business", $data);

                    $this->session->set_flashdata('success_msg', 'Merchant Business Address added  successfully.');
                    //echo $user_message;die();
                    redirect("admin/business/add");
                }
              }

          //retrive data from model to  passing to the view.

          $user_id = $this->uri->segment(4);

          $data["user_id"]= $user_id;
          $data["site_title"] = 'Add Business Details';
          $data["menu_title"] = 'Add Business Details';

          //print_r($data);exit();
          $this->load->view('business/add',$data);


  }

  }
