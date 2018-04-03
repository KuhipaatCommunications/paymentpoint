<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/user_model', 'User');
		$this->load->model('admin/adminmodel');
		$this->load->theme('admintheme');
		$this->load->helper('auth');
	}
	//////////function to load home/dashboard page////////////
	public function index()
	{
            //echo '<pre>';print_r($this->controllerlist->getControllers());exit;
		if(!isAdminLoggedIn())///////if not loggedin then will redirect to login page///////////
		{
			redirect("admin/login");
		}
		
		$data["site_title"] = 'Admin dashboard';
                $total_user=$this->User->countUsers();
                $data['total_member'] = $total_user;
                $total_act=$this->User->countActiveuser();
                $total_inact=$this->User->countInactiveuser();
		$data['lnd_member'] = $total_act;
		$data['tnt_member'] = $total_inact;
		//$data['suspended_member'] = 10;
                $date2=date('Y-m', strtotime(date('Y-m-d').'-2 month'));
                $data['total_member12']=$this->User->countUsers($date2);
		//$data['free_member'] = $this->User->countAllfreeUsers($date2);
		$data['paid_member'] = $this->User->countActiveuser($date2);
                $data['ins_member'] = $this->User->countInactiveuser($date2);
                $date1=date('Y-m', strtotime(date('Y-m-d').'-1 month'));
                $data['total_member1']=$this->User->countUsers($date1);
		//$data['free_member1'] = $this->User->countAllfreeUsers($date1);
		$data['paid_member1'] = $this->User->countActiveuser($date1);
                $data['ins_member1'] = $this->User->countInactiveuser($date1);
                $date=date('Y-m');
                $data['total_member2']=$this->User->countUsers($date);
		//$data['free_member2'] = $this->User->countAllfreeUsers($date);
		$data['paid_member2'] = $this->User->countActiveuser($date);
                $data['ins_member2'] = $this->User->countInactiveuser($date);
		// $data['silver_member'] = 5;
		// $data['gold_member'] = 5;
		// $data['platinum_member'] = 10;
		// $data['total_registration_2']=100;
		// $data['paid_registration_2']=0;
		// $data['free_registration_2']=100;
		// $data['total_registration_1']=0;
		// $data['paid_registration_1']=0;
		// $data['free_registration_1']=0;
		// $data['total_registration_current']=100;
		// $data['paid_registration_current']=0;
		// $data['free_registration_current']=100;
		$freeuser=$total_user-$data['paid_member'];
		$data['all_free']=$freeuser;
		$this->load->view('dashboard/index', $data);
	}
}
?>
