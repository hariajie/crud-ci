<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Crud extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("mpegawai");
	}

	public function index()
	{
		$data = array();
		//$data['pegawai'] = $this->mpegawai->get_pegawai();
		$data['content'] = "crud_pegawai";
		$this->load->view('template', $data);
	}

	function data() {
		
		$filtering = null;
		$search = $this->input->get('search');
		$sort = $this->input->get('sort');
		$order = $this->input->get('order');
		$offset = $this->input->get('offset');
		$limit = $this->input->get('limit');
		
		$active_page = 1;
		if ( is_numeric($limit) && !empty($limit) ) {
			$active_page = $offset > 0 ? ($offset/$limit)+1: 1;
		}
		//$this->session->set_userdata("last_summary_page", $active_page);

		$data_summary = $this->mpegawai->get_pegawai($offset, $limit, $sort, $order, $search, $filtering);
		$datas = array();
		$index = 0;
		//$tingkat_resiko_authorization = tingkat_resiko_athorization();
		//$current_role = $this->session->userdata('role');
		foreach ($data_summary as $rows) {
			$menu = '';
			$pk = $rows->id;
			

			$datas[] = $rows;
			$index++;
		}
		//$count_filtered_summary = $this->mpegawai->get_count_summary($search, $filtering);
		$count_summary = $this->mpegawai->get_count_summary();
		$response = array(
			"total" => $count_summary,
			"totalNotFiltered" => $count_summary,
			"rows" => $datas
		);
		$this->output
        	 ->set_content_type('application/json')
        	 ->set_output(json_encode($response));
	}
}
