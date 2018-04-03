<?php
if (! defined('BASEPATH')) exit('No direct script access');

class Adminmodel extends CI_Model 
{
	function __construct()
	{
        parent::__construct();
		$this->load->database();
	}
	/////////////////////Update Admin profile//////////////////
	function edit_profile($data)
	{		
		$this->db->where('id', $this->session->userdata('admin_id'));
		$this->db->update('admin', $data);
		return true;
	}
	/////////////////////End Update Admin profile////////////////////
	////////////////////get admin profile info//////////////
	function adminprofileinfo()
	{
		$this->db->select('A.id,A.username,A.first_name,profile_image,A.last_name,A.email_id,A.last_login');
		$this->db->from('admin as A');
		$this->db->where('A.id', $this->session->userdata('admin_id'));
		$query = $this->db->get();
		//echo $this->db->last_query();
		$data = $query->row_array();
		$count = $query->num_rows();
		
		if($count>0)
			return $data;
		else
			return 0;
	}
	////////////end get admin profile info///////////////////
	////////////////////get site settings info//////////////
	function siteinfo()
	{
		$data=array();
		$this->db->select('id,key,value,status');
		$this->db->from('site_settings');
		$query = $this->db->get();
		//echo $this->db->last_query();
		$count = $query->num_rows();
		
		if($count>0)
			$data = $query->result_array();
		return $data;
	}
	////////////////////end get site settings info//////////////
	////////////checking is password exist in database or not////////////
	function checkPasswordExist()
	{		
		$this->db->select('id,username,first_name,last_name,email_id,last_login');
		$this->db->from('admin');
		$this->db->where('password', md5($this->input->post('old_password')));
		$this->db->where('id', $this->session->userdata('admin_id'));

		$query = $this->db->get();
		
		//echo $this->db->last_query();exit;
		$count = $query->num_rows();
		return $count;
	}
	
	///////////function to change password/////////
	function changepassword($data)
	{
		$this->db->where('id', $this->session->userdata('admin_id'));
		$this->db->update('admin', $data);
		
		return true;		
	}
        
        /**
         * **************** Get all settings*****************
         */
        
    function getSettings($where=  array())
	{
		if(!empty($where))
			$this->db->where($where);
		$this->db->where('status', 1);
		$this->db->select('id, title, key, value, type, default');
		$this->db->from('site_settings');
		$query = $this->db->get();
		//echo $this->db->last_query();
		return $query->result();
	}
        
	
	////////////////////change settings/////////////////////////
	function editSettings($settings_data = array())
	{
//            print_r($settings_data);die();
		$this->db->update_batch('site_settings', $settings_data, 'key'); 		
		return true;		
	}
	/////////////end change settings//////////////////////////
	////////////////////get site settings info by id//////////////
	function getSiteinfoById($id)
	{
		$data=array();
		$this->db->where('id',$id);
		$this->db->select('id,key,value,status');
		$this->db->from('site_settings');
		$query = $this->db->get();
		//echo $this->db->last_query();
		$count = $query->num_rows();
		
		if($count>0)
			$data = $query->row_array();
		return $data;
	}
	////////////////////end get site settings info by id//////////////
	
}
?>
