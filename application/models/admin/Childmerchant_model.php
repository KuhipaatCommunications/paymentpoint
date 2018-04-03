<?php
if (! defined('BASEPATH')) exit('No direct script access');

class Childmerchant_model extends CI_Model
{
	function __construct()
	{
        parent::__construct();
		$this->load->database();

	}

	function countAllCmerchant($keyword="")
	{

		$count=0;

		$this->db->select('cm.id');
        $this->db->from('child_merchant cm');


		if($keyword && $keyword!="")
        {
            $this->db->like('cm.pp_customer_id', $keyword);
            $this->db->or_like('cm.bd_merchant_id', $keyword);

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


	function getAllCmerchant($keyword="", $limit,$offset)
	{
		$data=array();

		//$this->db->limit($limit,$offset);
		$this->db->select('cm.id,cm.cm_name,cm.cm_email,cm.mobile_no_1,cm.cm_created_on');
        $this->db->from('child_merchant cm');
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

		$this->db->order_by("cm.id", "desc");
        //$this->db->group_by("u.id");
		$query = $this->db->get();
        //echo $this->db->last_query();
        if($query->num_rows()>0)
		    $data = $query->result_array();

		return $data;
	}


}
