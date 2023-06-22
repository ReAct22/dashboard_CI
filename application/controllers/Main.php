<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main extends CI_Controller

{
	function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->library('form_validation');
		$this->load->library('session');
	}

	public function index()
	{
		redirect('main/dashboard');
	}

	public function dashboard()
	{
		$data['title'] = "Dashboard";
		$data['icons'] = "<i class='fal fa-chart-pie fa-lg' style='font-size: 22px;'></i>";
		$data['script'] = "menu/dashboard/js";
		$data['css'] = "menu/dashboard/css";
		$this->template->view('menu/dashboard/index_dashboard', $data);
	}

	/** Master Data Function */
	public function kategori()
	{
		$data['title'] = "Kategori";
		$data['icons'] = "<i class='links_icon fa fa-list' style='font-size: 22px;'></i>";
		$data['script'] = "menu/masterdata/kategori/js";
		$this->template->view('menu/masterdata/kategori/index_kategori', $data);
	}

	public function satuan()
	{
		$data['title'] = "Satuan";
		$data['icons'] = "<i class='links_icon fa fa-list' style='font-size: 22px;'></i>";
		$data['script'] = "menu/masterdata/satuan/js";
		$this->template->view('menu/masterdata/satuan/index_satuan', $data);
	}

	public function merk()
	{
		$data['title'] = "Merk";
		$data['icons'] = "<i class='links_icon fa fa-list' style='font-size: 22px;'></i>";
		$data['script'] = "menu/masterdata/merk/js";
		$this->template->view('menu/masterdata/merk/index_merk', $data);
	}

	public function cabang()
	{
		$data['title'] = "Cabang";
		$data['icons'] = "<i class='links_icon fa fa-list' style='font-size: 22px;'></i>";
		$data['script'] = "menu/masterdata/cabang/js";
		$this->template->view('menu/masterdata/cabang/index_cabang', $data);
	}

	public function top()
	{
		$data['title'] = "TOP";
		$data['icons'] = "<i class='links_icon fa fa-list' style='font-size: 22px;'></i>";
		$data['script'] = "menu/masterdata/top/js";
		$this->template->view('menu/masterdata/top/index_top', $data);
	}

	public function supplier()
	{
		$data['title'] = "Supplier";
		$data['icons'] = "<i class='links_icon fa fa-list' style='font-size: 22px;'></i>";
		$data['script'] = "menu/masterdata/supplier/js";
		$this->template->view('menu/masterdata/supplier/index_supplier', $data);
	}

	public function supervisor()
	{
		$data['title'] = "Supervisor";
		$data['icons'] = "<i class='links_icon fa fa-list' style='font-size: 22px;'></i>";
		$data['script'] = "menu/masterdata/supervisor/js";
		$this->template->view('menu/masterdata/supervisor/index_supervisor', $data);
	}

	public function coa()
	{
		$data['title'] = "Coa";
		$data['icons'] = "<i class='links_icon fa fa-list' style='font-size: 22px;'></i>";
		$data['script'] = "menu/masterdata/coa/js";
		$this->template->view('menu/masterdata/coa/index_coa', $data);
	}

	public function kodepos()
	{
		$data['title'] = "Kode Pos";
		$data['icons'] = "<i class='links_icon fa fa-list' style='font-size: 22px;'></i>";
		$data['script'] = "menu/masterdata/kodepos/js";
		$this->template->view('menu/masterdata/kodepos/index_kodepos', $data);
	}

	public function salesman()
	{
		$data['title'] = "Salesman";
		$data['icons'] = "<i class='links_icon fa fa-list' style='font-size: 22px;'></i>";
		$data['script'] = "menu/masterdata/salesman/js";
		$this->template->view('menu/masterdata/salesman/index_salesman', $data);
	}

	public function gudang()
	{
		$data['title'] = "Gudang";
		$data['icons'] = "<i class='links_icon fa fa-list' style='font-size: 22px;'></i>";
		$data['script'] = "menu/masterdata/gudang/js";
		$this->template->view('menu/masterdata/gudang/index_gudang', $data);
	}

	public function level_diskon()
	{
		$data['title'] = "Level Diskon";
		$data['icons'] = "<i class='links_icon fa fa-list' style='font-size: 22px;'></i>";
		$data['script'] = "menu/masterdata/level_diskon/js";
		$this->template->view('menu/masterdata/level_diskon/index_level_diskon', $data);
	}

	public function users()
	{
		$data['title'] = "Users";
		$data['icons'] = "<i class='links_icon fa fa-list' style='font-size: 22px;'></i>";
		$data['script'] = "menu/masterdata/users/js";
		$this->template->view('menu/masterdata/users/index_users', $data);
	}

	

	public function diskonkategori()
	{
		$data['title'] = "Diskon Kategori Produk";
		$data['icons'] = "<i class='links_icon fa fa-list' style='font-size: 22px;'></i>";
		$data['script'] = "menu/masterdata/diskon_kategori_produk/js";
		$this->template->view('menu/masterdata/diskon_kategori_produk/index_diskon_kategori_produk', $data);
	}



	/** Produk Function */
	public function Barang()
	{
		$data['title'] = "Barang";
		$data['icons'] = "<i class='links_icon fa fa-list' style='font-size: 22px;'></i>";
		$data['script'] = "menu/produk/barang/js";
		$this->template->view('menu/produk/barang/index_barang', $data);
	}

	/** Setting Function */
	public function konfig()
	{
		$data['title'] = "Konfigurasi";
		$data['icons'] = "<i class='links_icon fa fa-list' style='font-size: 22px;'></i>";
		$data['script'] = "menu/masterdata/konfigurasi/js";
		$this->template->view('menu/masterdata/konfigurasi/index_konfig', $data);
	}
}
