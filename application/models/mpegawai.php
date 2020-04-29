<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Mpegawai extends CI_Model {

	
	public function __construct() 
	{
		
		parent::__construct();
	}

	function get_pegawai_old() 
	{
		$q = $this->db->query("SELECT * from pegawai");
		return $q->result();
	}

	function get_pegawai($offset, $limit, $sort, $order, $search = "", $filtering = null) {
    	$offset = empty($offset) || !is_numeric($offset) ? 0: $offset;
    	$limit = empty($limit) || !is_numeric($limit) ? 10: $limit;
    	$sort = empty($sort) ? "id": $sort;
    	$order = empty($order) ? "asc": $order;

    	$this->db->select("*")
    			 ->limit($limit, $offset)
    			 ->order_by($sort, $order);
        $where = "1=1";
        if ( !empty($filtering) ) {
            if ( is_array($filtering) ) {
                foreach ($filtering as $key => $value) {
                    if ( $key == "es1" && $value == $this->config->item('empty_unor') )
                        $where .= " AND A.es1 IS NULL";
                    else if ( !empty($value) ) 
                        $where .= in_array($key, array('es1', 'tingkat_resiko', 'status_responden', 'nip', 'no_ktp')) ? " AND A.$key = '".$this->db->escape_str($value)."'": " AND $key LIKE '%".$this->db->escape_like_str($value)."%'";
                }
            } else {
                $where .= " AND $filtering";
            }
        }
    	if ( !empty($search) ) {
            $where .= " AND (
                        nama LIKE '%".$this->db->escape_like_str($search)."%'
                        OR nama LIKE '%".$this->db->escape_like_str($search)."%'
                        OR no_ktp LIKE '%".$this->db->escape_like_str($search)."%'
                        )";
    	}
        $this->db->where($where);
    	$query = $this->db->get("pegawai");
    	if ( $query ) {
    		return $query->result();
    	}
    	return array();
    }

    function get_count_summary($search = "", $filtering = null) {
    	$where = "1=1";
        if ( !empty($filtering) ) {
            if ( is_array($filtering) ) {
                foreach ($filtering as $key => $value) {
                    if ( $key == "es1" && $value == $this->config->item('empty_unor') )
                        $where .= " AND es1 IS NULL";
                    else if ( !empty($value) ) 
                        $where .= in_array($key, array('es1', 'tingkat_resiko', 'status_responden')) ? " AND $key = '".$this->db->escape_str($value)."'": " AND $key LIKE '%".$this->db->escape_like_str($value)."%'";
                }
            } else {
                $where .= " AND $filtering";
            }
        }
        if ( !empty($search) ) {
            $where .= " AND (
                        nama LIKE '%".$this->db->escape_like_str($search)."%'
                        )";
        }
        $this->db->where($where);
    	$count = $this->db->count_all_results("pegawai");
    	return $count;
    }


	function get_pegawai_id($id)
	{
		$this->db->where('No',$id);
		$q = $this->db->get('pegawai');

		return $q->row();
	}
	     

	function get_total_pegawai()
	{
		$q = $this->db->get('pegawai','No');
    	return $q->num_rows();
	}

	function id_incr()
	{
		$this->db->select("No");
		$this->db->order_by('No','DESC');
		$this->db->limit(1);
		$q = $this->db->get('pegawai');
		$old_id = $q->row()->id;

		$new_id = $old_id + 1;
		return $new_id;
	}  

	function insert($data)
    {
    	$data['No'] = $this->id_incr();
    	$q = $this->db->insert('pegawai', $data);
    	return $q;

    }

    function edit($data, $id)
    {
    	$this->db->where('No', $id);
    	$q = $this->db->update('pegawai', $data);
    	return $q;
    }

    function delete($id)
    {
    	$this->db->where('No', $id);
    	$q = $this->db->delete('pegawai');
    	if($q) {
    		return TRUE;
    	}
    } 
}
?>