<?php
if (! defined('BASEPATH')) exit('No direct script access');

class Device_model extends CI_Model
{
	function __construct()
	{
        parent::__construct();
		$this->load->database();

	}

	function countAllDevice($keyword="")
	{

		$count=0;

		$this->db->select('device.id');
        $this->db->from('device_details device');


		if($keyword && $keyword!="")
        {

            $this->db->like('device.id', $keyword);

        }

        //$this->db->group_by("u.id");
		$query = $this->db->get();
        //echo $this->db->last_query();
        if($query->num_rows()>0)
            $count=$query->num_rows();

		return $count;

	}


	function getAllDevice($keyword="", $limit,$offset)
	{
		$data=array();

		//$this->db->limit($limit,$offset);
		$this->db->select('device.id,device.company_name,device.device_type,device.device_no,device.status');
        $this->db->from('device_details device');

		if($keyword && $keyword!="")
        {
            $this->db->like('(device.company_name', $keyword);
            $this->db->or_like('device.device_type', $keyword);
            // $this->db->or_like('device.last_name', $keyword);
            // $this->db->or_like('device.phone', $keyword);
            // $this->db->bracket('close','like');
        }

		$this->db->order_by("device.id", "desc");
        //$this->db->group_by("u.id");
		$query = $this->db->get();
        //echo $this->db->last_query();
        if($query->num_rows()>0)
		    $data = $query->result_array();

		return $data;
	}

	function getAllCompanyName()
    {

        $data=array();

        //$this->db->limit($limit,$offset);
        $this->db->select('company_name');
        $this->db->from('device_details');

        $this->db->group_by('company_name');

        $query = $this->db->get();
        //echo $this->db->last_query();
        if($query->num_rows()>0)
            $data = $query->result_array();

        return $data;
    }


    function getMerchantName($device_no)
    {

        $data=array();

        $this->db->select('first_name,middle_name,last_name');
        $this->db->from('users u');
        $this->db->join('merchant_device m','u.id = m.user_id');
        $this->db->where('m.device_id',$device_no);

        $query = $this->db->get();
        //echo $this->db->last_query();
        if($query->num_rows()>0)
            $data = $query->row_array();

        return $data;
    }



}
