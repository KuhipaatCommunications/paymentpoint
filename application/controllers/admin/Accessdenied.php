<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Accessdenied extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->controller = 'Accessdenied';
        $this->load->theme('admintheme');
        $this->load->helper('auth');
    }
    //////////function to load user list////////////
    public function index()
    {
//        if(!isAdminLoggedIn())
//        {
//            redirect("admin/login");
//        }

        $this->load->view('accessdenied');
    }
} // exit of ci
