<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller 
{
	public function __construct()
	{
            parent::__construct();
            $this->load->model('admin/user_model', 'User');
            $this->load->model('common_methods', 'common_methods');
            $this->load->model('admin/adminmodel');
            $this->load->theme('admintheme');
            $this->load->helper('auth');
            $this->load->library('form_validation');
            $this->load->library('image_lib');
	}
	
	//////function to login to Admin/backend////////////////
	public function index()
	{
            if(isAdminLoggedIn())///////if not loggedin then will redirect to login page///////////
            {
                redirect("admin/dashboard");
            }
            if ($this->input->server('REQUEST_METHOD') === 'POST')
            {
                $username = $this->input->post('username');
                $password = $this->input->post('password');
                ///////If valid username/password then can login to the site//////
                $data=$this->User->checkAdminExist($username,$password);
                if($data)
                {
//                    $role_access= $this->User->getUserRoleDetails($data["role_id"]);
//                    $controller=array();
//                    $method=array();
//                    if($role_access && !empty($role_access))
//                    {
//                        foreach($role_access as $row)
//                        {
//                            $controller[]=strtolower($row['controller']);
//                            $method[]=strtolower($row['method']);
//                        }
//                    }
                    $this->session->set_userdata('admin_id', $data["id"]);
                    $this->session->set_userdata('admin_name', $data["username"]);
                    $this->session->set_userdata('role_id', $data["role_id"]);
                    $this->session->set_userdata('profile_image', $data["profile_image"]);
                    $this->session->set_userdata('role_name', $role_access[0]["role_name"]);
                    //$this->session->set_userdata('access_controller', $controller);
                    //$this->session->set_userdata('access_method', $method);
                    redirect("admin/dashboard");
                }
                else /////////otherwise will redirect to login page//////////
                {
                    $this->session->set_userdata('error_msg', 'Incorrect username or password!');
                    redirect("admin/login");
                }
            }

            $data['site_title'] = 'Admin Login';
            $this->load->view('login/index', $data);
	}
}
?>
