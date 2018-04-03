<?php
if (! defined('BASEPATH')) exit('No direct script access');

class Lead_model extends CI_Model 
{
	function __construct()
	{
        parent::__construct();
		$this->load->database();
	
	}

	function countAllLeads($keyword="")
	{

		$count=0;
		
		$this->db->select('lead.id');
        $this->db->from('leads lead');

                
		if($keyword && $keyword!="")
        {
            
            $this->db->like('lead.id', $keyword);
            //$this->db->or_like('mpos.bd_merchant_id', $keyword);

            // $this->db->or_like('m.last_name', $keyword);
            // $this->db->or_like('m.phone', $keyword);
            // //$this->db->bracket('close','like');
        }
        //$this->db->group_by("u.id");
		$query = $this->db->get();
        //echo $this->db->last_query();
        if($query->num_rows()>0)
            $count=$query->num_rows();
		
		return $count;

	}


	function getAllLeads($keyword="", $limit,$offset)
	{
		$data=array();

		//$this->db->limit($limit,$offset);
		$this->db->select('lead.id,lead.first_name,lead.last_name,lead.email,lead.mobile_no,lead.lead_type,lead.created_on');
        $this->db->from('leads lead');
        //$this->db->where('is_mpos',1);
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
            $this->db->like('(lead.first_name', $keyword);
            $this->db->or_like('lead.last_name', $keyword);
            $this->db->or_like('lead.mobile_no', $keyword);
            $this->db->bracket('close','like');
        }

		$this->db->order_by("lead.id", "desc");
        //$this->db->group_by("u.id");
		$query = $this->db->get();
        //echo $this->db->last_query();
        if($query->num_rows()>0)
		    $data = $query->result_array();

		return $data;
	}

	
}