<?php
if (! defined('BASEPATH')) exit('No direct script access');

class Bank_model extends CI_Model
{
	function __construct()
	{
        parent::__construct();
		$this->load->database();

	}

	function countAllBank($keyword="")
	{

		$count=0;

		$this->db->select('bank.id');
        $this->db->from('user_bank_accounts bank');


		if($keyword && $keyword!="")
        {

            $this->db->like('bank.id', $keyword);

        }

        //$this->db->group_by("u.id");
		$query = $this->db->get();
        //echo $this->db->last_query();
        if($query->num_rows()>0)
            $count=$query->num_rows();

		return $count;

	}


	function getAllBank($keyword="", $limit,$offset)
	{
		$data=array();

		//$this->db->limit($limit,$offset);
		$this->db->select('bank.id,bank.user_id,bank.benificiary_name,bank.bank_name,bank.account_number,bank.ifsc_code,bank.bank_branch,bank.created_on,bank.status');
        $this->db->from('user_bank_accounts bank');

		if($keyword && $keyword!="")
        {
            $this->db->like('(bank.bank_name', $keyword);
            $this->db->or_like('bank.benificiary_name', $keyword);
            // $this->db->or_like('device.last_name', $keyword);
            // $this->db->or_like('device.phone', $keyword);
            // $this->db->bracket('close','like');
        }

		$this->db->order_by("bank.id", "desc");
        //$this->db->group_by("u.id");
		$query = $this->db->get();
        //echo $this->db->last_query();
        if($query->num_rows()>0)
		    $data = $query->result_array();

		return $data;
	}

	function getAllBankName()
		{

				$data=array();

				//$this->db->limit($limit,$offset);
				$this->db->select('id,bank_name');
				$this->db->from('bank_master');

				//$this->db->group_by('company_name');

				$query = $this->db->get();
				//echo $this->db->last_query();
				if($query->num_rows()>0)
						$data = $query->result_array();

				return $data;
		}



}
