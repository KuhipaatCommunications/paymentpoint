<?php
if (! defined('BASEPATH')) exit('No direct script access');

class User_model extends CI_Model
{
	function __construct()
	{
            parent::__construct();
            $this->load->database();
            //$this->profile_image_path = './uploads/profile_image/';
	}

	//////////////check by username and password is admin exist in the system//////////
	function checkAdminExist($username, $password)
	{
            $data=array();
            $this->db->select('id, role_id, first_name,last_name,username,email_id, profile_image, last_login,status');
            $query = $this->db->get_where('admin', array('username' => $username, 'password' => md5($password)));
            //echo $this->db->last_query();die();

            //$data = $query->row_array();
            $count = $query->num_rows();
            if($count>0)
            {
                $data = $query->row_array();
                return $data;
            }
            else
            {
                return false;
            }
	}

	//////////////get total number of users////////////////
	function countUsers($date="")
	{
		$data=array();
		$this->db->select('id');
		$this->db->from('users');
		if($date!="")
			$this->db->like('created_on', $date);
		$query = $this->db->get();
		//echo $this->db->last_query();
		if($query->num_rows()>0)
		{
			return $query->num_rows();
			$query->free_result();
		}
		else
			return 0;
	}
        //////////////count active users////////////////
	function countActiveuser($date="")
	{
            $data=array();
            $this->db->select('id');
            $this->db->from('users');
            $this->db->where('status', 1);
            if($date!="")
                $this->db->like('created_on', $date);
            $query = $this->db->get();
            //echo $this->db->last_query();
            if($query->num_rows()>0)
            {
                return $query->num_rows();
                $query->free_result();
            }
            else
                return 0;
	}
	//////////////count Inactive users////////////////
	function countInactiveuser($date="")
	{
            $data=array();
            $this->db->select('id');
            $this->db->from('users');
            $this->db->where('status', 0);
            if($date!="")
                $this->db->like('created_on', $date);
            $query = $this->db->get();
            //echo $this->db->last_query();
            if($query->num_rows()>0)
            {
                return $query->num_rows();
                $query->free_result();
            }
            else
                return 0;
	}
	//////////////count all Merchant  //////////////////
	function countAllUser($keyword="")
	{
            $count=0;
            $this->db->select('m.id');
            $this->db->from('users m');

            // $fielter_checkbox = $this->input->post('filter_by_checkbox');
            // for($i = 0; $i < count($fielter_checkbox); $i++){
            //     $field = substr($fielter_checkbox[$i],2);
            //     $field_value = substr($fielter_checkbox[$i],0,1);
            //     if((isset($field) && $field!="") && (isset($field_value) && $field_value!="")){
            //         $this->db->or_where($field, $field_value);
            //     }
            // }

            if($keyword && $keyword!="")
            {
                $this->db->like('(m.first_name', $keyword);
                $this->db->or_like('m.midle_name', $keyword);
                $this->db->or_like('m.last_name', $keyword);
                $this->db->or_like('m.phone', $keyword);
                $this->db->bracket('close','like');
            }
            //$this->db->group_by("u.id");
            $query = $this->db->get();
            //echo $this->db->last_query();
            if($query->num_rows()>0)
                $count=$query->num_rows();
            return $count;
	}

	//////////////get all Merchant  //////////////////
	function getAllUser($keyword="", $limit,$offset)
	{
            $data=array();
            //$this->db->limit($limit,$offset);
            $this->db->select('m.id, m.user_type, m.first_name, m.middle_name, m.last_name, m.profile_image, m.mobile_no, m.created_on');
            $this->db->from('users m');
            //$this->db->join('user_types ut', 'u.id=ut.user_id', 'left');

            // $fielter_checkbox = $this->input->post('filter_by_checkbox');
            // for($i = 0; $i < count($fielter_checkbox); $i++){
            //     $field = substr($fielter_checkbox[$i],2);
            //     $field_value = substr($fielter_checkbox[$i],0,1);
            //     if((isset($field) && $field!="") && (isset($field_value) && $field_value!="")){
            //         $this->db->or_where($field, $field_value);
            //     }
            // }

            if($keyword && $keyword!="")
            {
                $this->db->like('(m.first_name', $keyword);
                $this->db->or_like('m.midle_name', $keyword);
                $this->db->or_like('m.last_name', $keyword);
                $this->db->or_like('m.phone', $keyword);
                $this->db->bracket('close','like');
            }

            $this->db->order_by("m.id", "desc");
            //$this->db->group_by("u.id");
            $query = $this->db->get();
            //echo $this->db->last_query();
            if($query->num_rows()>0)
                $data = $query->result_array();
            return $data;
	}

	////////////delete single user at a time and also, unlink previous stored member image////////////
	function delsingleuser($id)
	{
            //print_r($del); exit;
            $user=$this->getuserById($id);
            $this->db->where('id', $id);
            $this->db->delete('users');

            if(file_exists($this->profile_image_path.'/'.$user['profile_image']))
            {
                unlink($this->profile_image_path.'/'.$user['profile_image']);
                unlink($this->profile_image_path.'/medium/'.$user['profile_image']);
                unlink($this->profile_image_path.'/thumbs/'.$user['profile_image']);
            }
	}
	////////////delete multiple user at a time and also, unlink previous stored member image////////////
	function deluser()
	{
		$check_ids = $this->input->post('check_ids');
                $check_ids = explode('^', $check_ids);
		foreach($check_ids as $row){
			$this->delsingleuser($row);
		}
	}

	//////update admin login time to the site///////////
	function updatelogin_time($id)
 	{
            $data = array(
               'last_login' => date('Y-m-d H:i:s')
            );
            $this->db->where('id', $id);
            $this->db->update('users', $data);
	}
        //////////////get user role details//////////
	function getUserRoleDetails($role_id)
	{
            $data=array();
            $this->db->select('r.role as role_name, a.controller, a.method');
            $this->db->from('user_roles r');
            $this->db->join('role_access a', 'r.id=a.role_id');
            $this->db->where('r.id', $role_id);
            $query = $this->db->get();
            //echo $this->db->last_query();die();
            $count = $query->num_rows();
            if($count>0)
            {
                $data = $query->result_array();
            }
            return $data;
	}
        //////////////count all Admin user //////////////////
	function countAllAdminUser($keyword="")
	{
            $count=0;
            $this->db->select('m.id');
            $this->db->from('admin m');

            if($keyword && $keyword!="")
            {
                $this->db->like('(m.first_name', $keyword);
                $this->db->or_like('m.last_name', $keyword);
                $this->db->or_like('m.email_id', $keyword);
                $this->db->or_like('m.mobile_no', $keyword);
                $this->db->bracket('close','like');
            }
            //$this->db->group_by("u.id");
            $query = $this->db->get();
            //echo $this->db->last_query();
            if($query->num_rows()>0)
                $count=$query->num_rows();
            return $count;
	}

	//////////////get all Admin user  //////////////////
	function getAllAdminUser($keyword="", $limit,$offset)
	{
            $data=array();
            //$this->db->limit($limit,$offset);
            $this->db->select('m.id, m.role_id, m.first_name, m.last_name, m.profile_image, m.email_id, m.mobile_no, m.created_at, m.status, r.role');
            $this->db->from('admin m');
            $this->db->join('user_roles r', 'm.role_id=r.id');
            if($keyword && $keyword!="")
            {
                $this->db->like('(m.first_name', $keyword);
                $this->db->or_like('m.last_name', $keyword);
                $this->db->or_like('m.email_id', $keyword);
                $this->db->or_like('m.mobile_no', $keyword);
                $this->db->bracket('close','like');
            }

            //$this->db->order_by("m.id", "desc");
            //$this->db->group_by("u.id");
            $query = $this->db->get();
            //echo $this->db->last_query();
            if($query->num_rows()>0)
                $data = $query->result_array();
            return $data;
	}
        //////////////get all Admin user  //////////////////
	function getAdminUserById($user_id)
	{
            $data=array();
            //$this->db->limit($limit,$offset);
            $this->db->select('m.id, m.role_id, m.first_name, m.last_name, m.profile_image, m.email_id, m.mobile_no, m.created_at, r.role');
            $this->db->from('admin m');
            $this->db->join('user_roles r', 'm.role_id=r.id');
            $this->db->where('m.id', $user_id);
            //$this->db->order_by("m.id", "desc");
            //$this->db->group_by("u.id");
            $query = $this->db->get();
            //echo $this->db->last_query();
            if($query->num_rows()>0)
                $data = $query->row_array();
            return $data;
	}
}
