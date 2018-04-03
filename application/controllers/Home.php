<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
		//$this->controller = 'home';
		$this->load->theme('frontend');
		$this->load->model('Common_methods', 'Common');
	}
	public function index()
	{
		$this->load->view('home/index');
	}

	

	/////////////////contact us//////////////
	public function contactus()
	{
		if($this->input->server('REQUEST_METHOD')==='POST')
		{
			$this->load->library('form_validation');
			$this->load->helper('security');
			$this->form_validation->set_rules('fname','First Name','trim|required');
			$this->form_validation->set_rules('lname','First Name','trim|required');
			$this->form_validation->set_rules('email','Email Id','trim|required|valid_email');
			$this->form_validation->set_rules('contact_no','Mobile','trim|required|min_length[10]|max_length[10]');
			$this->form_validation->set_rules('message','message','trim|required');
			if($this->form_validation->run()!= FALSE)///////if form input fields are valid////////
			{
				$first_name=$this->input->post('fname', true);
				$last_name=$this->input->post('lname', true);
				$email=$this->input->post('email', true);
				$phone=$this->input->post('contact_no', true);
				$message=$this->input->post('message', true);
				////Inserting contact data//////////
				$data=array(
					'first_name'=>$first_name,
					'last_name'=>$last_name,
					'email'=>$email,
					'phone'=>$phone,
					'message'=>$message,
					'created_at'=>date('Y-m-d H:i:s')
				);


				$this->Common->insertRecord('contact_us', $data);
				$this->session->set_flashdata('success_msg', "Thank you for contact with us");
				
				//send mail to user///
				$admin_mail = 'sales@paymentpoint.in';
				$admin_name="PaymentPoint";
				
				$subject="Contact Us";
				$user_message='Hi,<br><br>Thank You for contacting us, We will reply to you shortly<br><br>Regards<br>PaymentPoint Team';
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
				
				//send mail to admin//////
				$subject="Contact Us";
				$admin_message='Hi,<br><br>A user has contact to PaymentPoint from the mailid '.$email.'<br>'.$message.'<br>Regards<br>PaymentPoint Team';
				$this->email->initialize($config);
				//To send the mail with CI mail lib:
				$this->email->from($email);
				$this->email->to(trim($admin_mail)); 
				$this->email->subject($subject);
				$this->email->message($admin_message);
				$sendmail=$this->email->send();
				
				// if($this->email->send()){

					
				// }
				// else{

				// 	$this->session->set_flashdata('error_msg', "Error in sending mail");
				// }

				redirect('/#contact');
				
			}
		}
		$this->load->view('home/index');
	}
}
