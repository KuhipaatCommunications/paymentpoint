<?php
if (! defined('BASEPATH')) exit('No direct script access');

class Role_model extends CI_Model 
{
	function __construct()
	{
            parent::__construct();
            $this->load->database();
            //$this->profile_image_path = './uploads/profile_image/';
	}
	
	//////////////count all Merchant  //////////////////
	function countAllRole($keyword="")
	{
            $count=0;
            $this->db->select('r.id');
            $this->db->from('user_roles r');
                
            if($keyword && $keyword!="")
            {
                $this->db->like('r.role', $keyword);
            }
            //$this->db->group_by("u.id");
            $query = $this->db->get();
            //echo $this->db->last_query();
            if($query->num_rows()>0)
                $count=$query->num_rows();
            return $count;
        }

        //////////////get all Merchant  //////////////////
        function getAllRole($keyword="", $limit,$offset)
        {
            $data=array();
            //$this->db->limit($limit,$offset);
            $this->db->from('user_roles r');

            if($keyword && $keyword!="")
            {
                $this->db->like('r.role', $keyword);
            }

            $this->db->order_by("r.id");
            $query = $this->db->get();
            //echo $this->db->last_query();
            if($query->num_rows()>0)
                $data = $query->result_array();
            return $data;
	}
	public function getAllControllerMethod()
        {
            $data=array();
            //$this->db->limit($limit,$offset);
            $this->db->from('controller_methods cm');
            $query = $this->db->get();
            //echo $this->db->last_query();
            if($query->num_rows()>0)
                $data = $query->result_array();
            return $data;
        }
        public function getAccessByRoleId($role_id)
        {
            $data=array();
            //$this->db->limit($limit,$offset);
            $this->db->from('role_access a');
            $this->db->where('role_id', $role_id);
            $query = $this->db->get();
            //echo $this->db->last_query();
            if($query->num_rows()>0)
                $data = $query->result_array();
            return $data;
        }
}
