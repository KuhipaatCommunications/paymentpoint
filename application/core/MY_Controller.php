<?php
class MY_Controller extends CI_Controller
{
    protected $controller, $view_data;
    public function __construct() {
        parent::__construct();
        // $this->load->helper('user');
        // $this->load->library('encrypt');
        // $this->load->model('user_model','userModel');
		// $this->load->model('common_methods','commonMethods');
        // $id=$this->session->userdata(CURRENT_USER_ID);
        // if($id){
        //     $this->commonMethods->updateSingleById($this->session->userdata(CURRENT_USER_ID), 'users', array('last_activity' => time()));
        //     $user_info = $this->userModel->getuserById($id);
        //     $this->view_data['current_user']=$user_info;
        //     $this->view_data['selected_user'] = $user_info;
		// }
    }
}
