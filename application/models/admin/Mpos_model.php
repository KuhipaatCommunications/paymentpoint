<?php
if (! defined('BASEPATH')) exit('No direct script access');

class Mpos_model extends CI_Model 
{
	function __construct()
	{
        parent::__construct();
		$this->load->database();
	
	}

	function countAllMposMerchant($keyword="")
	{

		$count=0;
		
		$this->db->select('mpos.id');
        $this->db->from('users mpos');

                
		if($keyword && $keyword!="")
        {
            
            $this->db->like('mpos.pp_id', $keyword);
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


	function getAllMopsMerchant($keyword="", $limit,$offset)
	{
		$data=array();

		//$this->db->limit($limit,$offset);
		$this->db->select('mpos.id,mpos.first_name,mpos.middle_name,mpos.last_name,mpos.mobile_no,mpos.created_on');
        $this->db->from('users mpos');
        $this->db->where('is_mpos',1);
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
            $this->db->like('(mpos.first_name', $keyword);
            $this->db->or_like('mpos.midle_name', $keyword);
            $this->db->or_like('mpos.last_name', $keyword);
            $this->db->or_like('mpos.phone', $keyword);
            $this->db->bracket('close','like');
        }

		$this->db->order_by("mpos.id", "desc");
        //$this->db->group_by("u.id");
		$query = $this->db->get();
        //echo $this->db->last_query();
        if($query->num_rows()>0)
		    $data = $query->result_array();

		return $data;
	}


    


	
}
