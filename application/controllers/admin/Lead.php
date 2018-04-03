<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lead extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
		//$this->controller = 'home';
		$this->load->theme('frontend');
		$this->load->model('Common_methods', 'Common');
		$this->load->model('admin/Lead_model', 'lead');
	}

	public function index()
	{
		
		// if(!isAdminLoggedIn())
  //       { 
  //           redirect("admin/login");

  //       }
        
        $keyword = $this->input->get('search_keyword');
        $data["site_title"] = 'Lead Management';
        $data["menu_title"] = 'Lead Management';

        if ($this->uri->segment(4) === FALSE)
        {
            $offset = 0;
        }
        else
        {
            $offset = $this->uri->segment(4);
        }
        
        $limit=ADMIN_PER_PAGE;

        $config['total_rows'] = $this->lead->countAllLeads($keyword);
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
            
        $data["leads"] = $this->lead->getAllLeads($keyword,$limit,$offset);

       $this->load->view('lead/view_leads',$data);
       //$this->load->view('lead/view_leads');



	}

	

	/////////////////Channel Partner //////////////
	public function channelpartner()
	{

		if($this->input->server('REQUEST_METHOD')==='POST')
		{
			$this->load->library('form_validation');
			$this->load->helper('security');
			$this->form_validation->set_rules('fname','First Name','trim|required');
			$this->form_validation->set_rules('lname','Last Name','trim');
			$this->form_validation->set_rules('email','Email Id','trim|required|valid_email');
			$this->form_validation->set_rules('contact_no','Mobile No','trim|required|min_length[10]|max_length[10]');
			$this->form_validation->set_rules('otype','trim|max_length[50]');
			$this->form_validation->set_rules('city','trim|max_length[50]');
			$this->form_validation->set_rules('pin','trim|min_length[6]|max_length[6]');
			$this->form_validation->set_rules('district','trim|max_length[50]');
			$this->form_validation->set_rules('state','trim|max_length[50]');

			if($this->form_validation->run()!= FALSE)///////if form input fields are valid////////
			{
				$first_name=$this->input->post('fname', true);
				$last_name=$this->input->post('lname', true);
				$email=$this->input->post('email', true);
				$contact_no=$this->input->post('contact_no', true);
				$otype=$this->input->post('otype', true);
				$city= $this->input->post('city',true);
				$pin=$this->input->post('pin',true);
				$district=$this->input->post('district',true);
				$state=$this->input->post('state',true);
				$form_type=$this->input->post('form_type',true);


				////Inserting contact data//////////
				$data=array(
					
					'first_name'=>$first_name,
					'last_name'=>$last_name,
					'email'=>$email,
					'mobile_no'=>$contact_no,
					'occupation_type'=>$otype,
					'city'=>$city,
					'district'=>$district,
					'pin'=>$pin,
					'state'=>$state,
					'lead_type'=>$form_type,
					'is_email_verified'=>0,//not verified
					'email_otp'=>NULL,
					'is_mobile_verified'=>0,
					'mobile_otp'=>NULL,
					'ipaddress'=>0,
					'created_on'=>date('Y-m-d H:i:s'),
					'modified_on'=>NULL,
					'modified_by'=>NuLL
				);

				//insert records
				$this->Common->insertRecord('leads', $data);
				$this->session->set_flashdata('success_msg', "Thank you for contact with us");


				$admin_mail="sales@paymentpoint.in";
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
				//////////////////////////

				if($this->input->post("mobile_form"))
					$this->session->set_userdata('m_form', 1);
				redirect('lead/channelpartner');
				
			}
		}

		$this->load->view('lead/channel_partner');
	}




	/////////////////merchant //////////////
	public function merchant()
	{

		if($this->input->server('REQUEST_METHOD')==='POST')
		{
			$this->load->library('form_validation');
			$this->load->helper('security');
			$this->form_validation->set_rules('fname','First Name','trim|required');
			$this->form_validation->set_rules('lname','Last Name','trim');
			$this->form_validation->set_rules('email','Email Id','trim|required|valid_email');
			$this->form_validation->set_rules('contact_no','Mobile No','trim|required|min_length[10]|max_length[10]');
			$this->form_validation->set_rules('otype','trim|max_length[50]');
			$this->form_validation->set_rules('city','trim|max_length[50]');
			$this->form_validation->set_rules('pin','trim|min_length[6]|max_length[6]');
			$this->form_validation->set_rules('district','trim|max_length[50]');
			$this->form_validation->set_rules('state','trim|max_length[50]');

			if($this->form_validation->run()!= FALSE)///////if form input fields are valid////////
			{
				$first_name=$this->input->post('fname', true);
				$last_name=$this->input->post('lname', true);
				$email=$this->input->post('email', true);
				$contact_no=$this->input->post('contact_no', true);
				$otype=$this->input->post('otype', true);
				$city= $this->input->post('city',true);
				$pin=$this->input->post('pin',true);
				$district=$this->input->post('district',true);
				$state=$this->input->post('state',true);
				$form_type=$this->input->post('form_type',true);


				////Inserting contact data//////////
				$data=array(
					
					'first_name'=>$first_name,
					'last_name'=>$last_name,
					'email'=>$email,
					'mobile_no'=>$contact_no,
					'occupation_type'=>$otype,
					'city'=>$city,
					'district'=>$district,
					'pin'=>$pin,
					'state'=>$state,
					'lead_type'=>$form_type,
					'is_email_verified'=>0,//not verified
					'email_otp'=>NULL,
					'is_mobile_verified'=>0,
					'mobile_otp'=>NULL,
					'ipaddress'=>0,
					'created_on'=>date('Y-m-d H:i:s'),
					'modified_on'=>NULL,
					'modified_by'=>NuLL
				);

				$this->Common->insertRecord('leads', $data);
				$this->session->set_flashdata('success_msg', "Thank you for contact with us");

				//$admin_mail="info@paymentpoint.in";
				$admin_mail="sales@paymentpoint.in";
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
				//////////////////////////
	
				if($this->input->post("mobile_form"))
					$this->session->set_userdata('m_form', 1);
				redirect('lead/merchant');
				
			}
		}

		$this->load->view('lead/merchant');
	}

}

