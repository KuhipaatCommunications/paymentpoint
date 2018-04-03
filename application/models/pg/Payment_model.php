<?php
if (! defined('BASEPATH')) exit('No direct script access');

class Payment_model extends CI_Model 
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        //$this->profile_image_path = './uploads/profile_image/';
    }
    
    function getAllPendingTxn()
    {
        $data=array();
        $this->db->select('id, bd_merchant_id, pp_cm_order_id');
        $this->db->where('txn_status !=', 's');
        $this->db->from('child_merchant_transactions');
        $query=$this->db->get();
        if($query->num_rows()>0)
        {
            $data=$query->result_array();
            foreach($data as $key=>$val)
                $data[$key]['refund']=$this->getRefundDetailsByTxnId($data[$key]['id']);
        }
        return $data;
    }
    function getRefundDetailsByTxnId($txn_id)
    {
        $data=array();
        $this->db->where('txn_id', $txn_id);
        $this->db->from('cm_refund');
        $this->db->where('refund_status', 'p');
        $query=$this->db->get();
        //echo $this->db->last_query();
        if($query->num_rows()>0)
        {
            $data=$query->row_array();
        }
        return $data;
    }
}
