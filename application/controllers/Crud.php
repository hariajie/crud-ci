<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Crud extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("mpegawai");
		$this->load->library(array("indodate","form_validation"));
	}

	public function index()
	{
		$data = array();
		//$data['pegawai'] = $this->mpegawai->get_pegawai();
		$data['judul'] = "List Data Pegawai";
		$data['desc'] = "Data Pegawai menggunakan Bootstrap-Table.";
		$data['content'] = "template/content/crud_pegawai";
		$last_summary_page = $this->session->userdata('last_summary_page');
		$data['last_summary_page'] = empty($last_summary_page) || !is_numeric($last_summary_page) ? 1: $last_summary_page;
		$this->load->view('template/template', $data);
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
		$this->session->set_userdata("last_summary_page", $active_page);

		$data_summary = $this->mpegawai->get_pegawai($offset, $limit, $sort, $order, $search, $filtering);
		$datas = array();
		$index = 0;

		//$tingkat_resiko_authorization = tingkat_resiko_athorization();
		//$current_role = $this->session->userdata('role');
		foreach ($data_summary as $rows) {
			$action = '';
			$pk = $rows->id;
			$rows->tanggal_lahir = $this->indodate->tanggal_indo($rows->tanggal_lahir);
			$action .= '<a href="'.base_url().'crud/edit/'.$rows->id.'" title="Edit Data" class="btn btn-warning btn-circle btn-sm"><i class="fa fa-edit"></i></a>';
			$action .= '&nbsp;<a href="'.base_url().'crud/delete/'.$rows->id.'" title="Hapus Data" class="btn btn-danger btn-circle btn-sm" onclick="return confirm(\'Apa anda yakin menghapus data ini?\')"><i class="fa fa-trash"></i></a>';
			$rows->action = $action;
			

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

	function tambah() 
	{
			$data = array();
			$data['judul'] = "Tambah Pegawai";
			$data['desc'] = "Form Tambah Data Pegawai.";
			$data['content'] = "template/content/tambah_pegawai";
			
			$this->load->view("template/template", $data);
	}

	function ubah($id) 
	{
			$data = array();
			$data['pegawai'] = $this->mpegawai->get_pegawai_id($id);
			$data['judul'] = "Ubah Pegawai";
			$data['desc'] = "Form Ubah Data Pegawai.";
			$data['content'] = "template/content/ubah_pegawai";
			
			$this->load->view("template/template", $data);
	}

	function add() 
	{
		$config = array(
			array(
				"field" => "nama",
				"label" => "Nama Pegawai",
				"rules" => "required"
				),
			array(
				"field" => "tempat_lahir",
				"label" => "Tempat Lahir",
				"rules" => "required"
				),
			array(
				"field" => "tanggal_lahir",
				"label" => "Tanggal Lahir",
				"rules" => "required"
				),
			array(
				"field" => "alamat",
				"label" => "Alamat",
				"rules" => "required"
				),
			array(
				"field" => "telepon",
				"label" => "Nomor Telepon",
				"rules" => "required|numeric"
				),
			array(
				"field" => "email",
				"label" => "Email",
				"rules" => "required|valid_email"
				)
		);
		$this->form_validation->set_rules($config);
		$this->form_validation->set_message('required','{field} harus diisi.');
		$this->form_validation->set_message('numeric','{field} hanya boleh diisi dengan angka.');
		$this->form_validation->set_message('valid_email', 'Format email salah. (contoh : abc@mail.com)');
		//$this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');

		if($this->form_validation->run()==FALSE) {
			$this->tambah();
		}
		else {
			$dt = array();
			$dt['nama'] = $this->input->post("nama");
			$dt['tempat_lahir'] = $this->input->post("tempat_lahir");
			$dt['tanggal_lahir'] = $this->input->post("tanggal_lahir");
			$dt['alamat'] = $this->input->post("alamat");
			$dt['telepon'] = $this->input->post("telepon");
			$dt['email'] = $this->input->post("email");
			

			$insert = $this->mpegawai->insert($dt);
			if($insert) {
				$this->session->set_flashdata('msg_success', 'Data berhasil disimpan');
				redirect('crud');
			}
		}
	}

	function edit($id) 
	{
		$config = array(
			array(
				"field" => "nama",
				"label" => "Nama Pegawai",
				"rules" => "required"
				),
			array(
				"field" => "tempat_lahir",
				"label" => "Tempat Lahir",
				"rules" => "required"
				),
			array(
				"field" => "tanggal_lahir",
				"label" => "Tanggal Lahir",
				"rules" => "required"
				),
			array(
				"field" => "alamat",
				"label" => "Alamat",
				"rules" => "required"
				),
			array(
				"field" => "telepon",
				"label" => "Nomor Telepon",
				"rules" => "required|numeric"
				),
			array(
				"field" => "email",
				"label" => "Email",
				"rules" => "required|valid_email"
				)
		);
		$this->form_validation->set_rules($config);
		$this->form_validation->set_message('required','{field} harus diisi.');
		$this->form_validation->set_message('numeric','{field} hanya boleh diisi dengan angka.');
		$this->form_validation->set_message('valid_email', 'Format email salah. (contoh : abc@mail.com)');
		//$this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');

		if($this->form_validation->run()==FALSE) {
			$this->ubah();
		}
		else {
			$dt = array();
			$dt['nama'] = $this->input->post("nama");
			$dt['tempat_lahir'] = $this->input->post("tempat_lahir");
			$dt['tanggal_lahir'] = $this->input->post("tanggal_lahir");
			$dt['alamat'] = $this->input->post("alamat");
			$dt['telepon'] = $this->input->post("telepon");
			$dt['email'] = $this->input->post("email");
			

			$insert = $this->mpegawai->edit($dt, $id);
			if($insert) {
				$this->session->set_flashdata('msg_success', 'Data berhasil diubah');
				redirect(base_url().'crud');
			}
		}
	}

	function delete($id) {
		$hapus = $this->mpegawai->delete($id);
		if($hapus) {
			$this->session->set_flashdata('msg_hapus', 'Data berhasil dihapus');
			redirect(base_url().'crud');
		}
		else {
			show_errors();
		}
	}
}
