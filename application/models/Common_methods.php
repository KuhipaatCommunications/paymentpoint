<?php if (! defined('BASEPATH')) exit('No direct script access');

class Common_methods extends CI_Model {
	//php 5 constructor
	function __construct() {
		parent::__construct( );
	}

	////////function to change single record status by id///////////
	function changeSingleStatus($id,$data,$table)
	{
		$this->db->where('id',$id);
		$this->db->update($table,$data);
	}
	////////function to change multiple record status by id///////////
	function changeMultiStatus($ids,$data,$table)
	{
		$this->db->where_in('id',$ids);
		$this->db->update($table,$data);
	}
	////////function to delete single record by id///////////
	function deleteSingleRecord($id,$table)
	{
		$this->db->where('id',$id);
		$this->db->delete($table);
	}

	////////function to delete multiple record by id///////////
	function deleteMultipleRecord($ids,$table)
	{
		$this->db->where_in('id',$ids);
		$this->db->delete($table);
	}
	////////function to get records by comma separated id///////////
	function getValueByCommaSeparatedId($ids,$select='*',$where,$table)
	{
		$data="";
		$ids=explode(',',$ids);
		$this->db->select($select);
		$this->db->from($table);
		$this->db->where_in($where,$ids);
		$query=$this->db->get();
		//echo $this->db->last_query();
		if($query->num_rows()>0)
		{
			$data=$query->result();
			$query->free_result();
		}
		return $data;
	}
	############################### Return single row from specific table ##################
	function getSingleObj($table,$fields="",$where_clause="",$order_by_fld="",$order_by="",$limit="",$offset="", $group_by="") {
            if($fields != '')
                    $this->db->select($fields);
            else
                    $this->db->select('*');
            if($where_clause != '')
                    $this->db->where($where_clause);
            if($order_by_fld != '')
                $this->db->order_by($order_by_fld,$order_by);
            if($group_by != '')
                $this->db->group_by($group_by);
            if($limit != '' && $offset !='')
                $this->db->limit($limit,$offset);
            //$this->db->select('*');
            $this->db->from($table);
            $query = $this->db->get();
            return $query->row();
	}
	############################### Return a array from specific table ##################
        function getSingle($table, $fields="", $where_clause="",$order_by_fld="",$order_by="",$limit="",$offset="")
        {
			if($fields != '')
				$this->db->select($fields);
            else
				$this->db->select('*');
            if($where_clause != '')
                $this->db->where($where_clause);
            if($order_by_fld != '')
                         $this->db->order_by($order_by_fld,$order_by);
            if($limit != '' && $offset !='')
                $this->db->limit($limit,$offset);
            $data=array();
            //$this->db->select('*');
            $this->db->from($table);
            $query = $this->db->get();
            if($query->num_rows()>0)
            {
				$data = $query->row_array();
				$query->free_result();
            }
            return $data;
        }
	############################### Return an array of specific fields from specific table ##################
	function getAllFields($table,$fields="",$where_clause="",$order_by_fld="",$order_by="",$limit="",$offset="") {
		if($fields != '')
			$this->db->select($fields);
		else
			$this->db->select('*');
		if($where_clause != '')
			$this->db->where($where_clause);
		if($order_by_fld != '')
			$this->db->order_by($order_by_fld,$order_by);
		if($limit != '' && $offset !='')
			$this->db->limit($limit,$offset);
		$this->db->from($table);
		$query = $this->db->get();
		//echo $this->db->last_query();
		return $query->result_array();
	}
	////////function to add/////////
	function insertRecord($table="",$data="")
	{
		$this->db->insert($table,$data);
	}
////////function to add and reply with insert id/////////
	function getandinsertRecord($table="",$data="")
	{
		$this->db->insert($table,$data);
		$insert_id = $this->db->insert_id();
		return  $insert_id;
	}

	public function updateRecords($table, $where = array(), $data = array())
	{
		if(empty($where))
			return FALSE;

		$this->db->where($where);
		$this->db->update($table, $data);
		return TRUE;
	}
	public function deleteRecords($table, $where = array())
	{
		if(empty($where))
			return FALSE;

		$this->db->where($where);
		$this->db->delete($table);
		//echo $this->db->last_query(); exit;
		return TRUE;
	}
	############################### Return true or false if data exist in table or not ##################
	function isExistRecord($table,$where="") {
                $this->db->select("'1'", false);
		if($where != '')
			$this->db->where($where);
		$query = $this->db->get($table);
		if($query->num_rows()>0)
			return TRUE;
		else
			return FALSE;
	}
	public function getSingleById($id, $table, $fields=array())
	{
            if(!empty($fields)){
                $this->db->select($fields);
            }
            $this->db->where('id', $id);
            $query = $this->db->get($table);
            return $query->row();
	}
############################### Get Value from Database for specific field ##########

	function getValue($tableName, $field_name, $param)
	{
		$this->db->select($field_name);
		$query = $this->db->get_where($tableName, $param);
		$row = $query->row_array();
		return count($row)?$row[$field_name]:"";
	}
	############################### Return number of rows ########################

	function count_rows($tableName, $param) {
		if(isset($param) && $param!="")
			$this->db->where($param);
		$query = $this->db->get($tableName);
		//echo $this->db->last_query();
		return $query->num_rows();
	}

}
