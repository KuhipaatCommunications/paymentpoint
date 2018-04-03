<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

//Author:Lakhyadeep Chutia
//Created on: 29 march 2018
//Last modified:
// Manage Bank Details of all the  users.

class Bank extends CI_Controller
{

  public function __construct()
  {
      parent::__construct();

      $this->load->model('admin/bank_model','bank');
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
            $this->form_validation->set_rules('user_id','user Id','trim|required');
            $this->form_validation->set_rules('benificiary_name','Benificary Name','trim|required');
            $this->form_validation->set_rules('bank_name','Bank Name','trim|required');
            $this->form_validation->set_rules('description','Description Name','trim');
            $this->form_validation->set_rules('account_number','Account Number','trim|required|integer');
            $this->form_validation->set_rules('ifsc_code','IFSC Code','trim|required');
            $this->form_validation->set_rules('bank_branch','Branch Name','trim|required');

            if($this->form_validation->run()!= FALSE)
            {
                $user_id = $this->input->post('user_id',true);
                $is_child_merchant=$this->input->post('is_child_merchant',true);

                $benificiary_name=$this->input->post('benificiary_name',true);
                $bank_name = $this->input->post('bank_name',true);
                $description=$this->input->post('description',true);
                $account_number=$this->input->post('account_number',true);
                $ifsc_code=$this->input->post('ifsc_code',true);
                $bank_branch=$this->input->post('bank_branch',true);
                $admin_id = $this->session->userdata('admin_id');



                //echo $is_child_merchant;exit();

                $isAccountNoExist=$this->Common->isExistRecord('user_bank_accounts',array('account_number'=>$account_number));

                if($isAccountNoExist){

                  $this->session->set_flashdata('error_msg', 'Sorry! Account Number already exist!');
                  //echo $user_message;die();
                  redirect("admin/cmerchant/add");

                }

                else
                {

                    $data= array(

                      'user_id'=>$user_id,
                      'benificiary_name'=>$benificiary_name,
                      'bank_name'=>$bank_name,
                      'description'=>$description,
                      'account_number'=>$account_number,
                      'ifsc_code'=>$ifsc_code,
                      'bank_branch'=>$bank_branch,
                      'created_on'=>date('Y-m-d H:i:s'),
                      'created_by'=>$admin_id,
                      'modified_on'=>NULL,
                      'modified_by'=>NULL,
                      'status'=>1,
                      'is_child_merchant'=>$is_child_merchant

                    );

                  //print_r($data);exit();
                  $this->Common->insertRecord('user_bank_accounts',$data);
                  $this->session->set_flashdata('success_msg', 'Bank added successfully.');
                  //redirect("admin/bank/add");
                }
          }


        }

        $user_id = $this->uri->segment(4);
        $data['is_child_merchant']= 0;
        if($this->input->get('is_child_merchant'))
          $data['is_child_merchant']= $this->input->get('is_child_merchant');
        //print_r($data);exit();

        $data["user_id"]=$user_id;
        $this->load->view('bank/add',$data);


  }


































}
