<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Produk extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model('produk/Produk_model');
		$this->load->model('Caridataaktif_model');
		$this->load->library('form_validation');
		$this->load->library('session');
	}

	function CariDataBarang()
	{
		$fetch_data = $this->Caridataaktif_model->make_datatables($this->input->post('field'), $this->input->post('nmtb'), $this->input->post('sort'), $this->input->post('where'), $this->input->post('value'));
		$data = array();
		foreach ($fetch_data as $row) {
			$sub_array = array();
			$i = 1;
			$count = count($this->input->post('field'));
			foreach ($this->input->post('field') as $key => $value) {
				if ($i <= $count) {
					if ($i == 1) {
						$msearch = $row->$value;
						$sub_array[] = '<button class="btn btn-dark searchbarang" data-dismiss="modal" style="margin: 0px;" data-id="' . $msearch . '"><i class="far fa-check-circle"></i></button>';
						$sub_array[] = $row->$value;
					} else {
						if ($i == $count) {
							$sub_array[] = $row->$value;
						} else {
							$sub_array[] = $row->$value;
						}
					}
					// $sub_array[] = $row->$value;
				}
				$i++;
			}
			$data[] = $sub_array;
		}
		$output = array(
			"draw"                    =>     intval($_POST["draw"]),
			"recordsTotal"          =>      $this->Caridataaktif_model->get_all_data($this->input->post('nmtb')),
			"recordsFiltered"     =>     $this->Caridataaktif_model->get_filtered_data($this->input->post('field'), $this->input->post('nmtb'), $this->input->post('sort'), $this->input->post('where'), $this->input->post('value')),
			"data"                    =>     $data
		);
		echo json_encode($output);
	}

	function DataBarang()
	{
		$result = $this->Produk_model->DataBarang($this->input->post('kode'));
		echo json_encode($result);
	}

	public function ClearChr($param)
	{
		return $result = str_replace(array('\'', '"', ',', ';', '<', '>', '_', '-', ' ', '.', '!', '?', '/', '=', '+', ']', '[', '{', '}', '@', '#', '$', '%', '^', '&', "*", '(', ')'), '', $param);
	}

	public function ClearPercent($param)
    {
        return $result = str_replace(array('%'), '', $param);
    }

	function Save()
	{
		// $kodecabang = $this->session->userdata('mycabang');
		// $pemakai = $this->session->userdata('myusername');

		$kodebarang = $this->input->post('kode');
		$user = "VSP";

		$this->db->trans_start(); # Starting Transaction
		$this->db->trans_strict(FALSE);

		if (empty($cekkode)) {

			$data = [
				'kode' => $kodebarang,
				'nama' => $this->input->post('nama'),
				'kodesatuan' => $this->input->post('kodesatuan'),
				'kodekategori' => $this->input->post('kodekategori'),
				'kodemerk' => $this->input->post('kodemerk'),
				// 'komisi' => $this->ClearPercent($this->input->post('komisi')),
				'users' => $user,
				'create_at' => date('Y-m-d H:i:s'),
				'update_at' => date('Y-m-d H:i:s'),
				'users_update' => $user,
				
			];
			$this->Produk_model->SaveData($data);
		}

		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			$resultjson = array(
				'kode' => "",
				'kodegudang' => "",
				'message' => "Data gagal disimpan, Kode '<b style='color: red'>" . $kodebarang . "</b>' sudah pernah digunakan."
			);
			# Something went wrong.
			$this->db->trans_rollback();
		} else {
			$resultjson = array(
				'kode' => $kodebarang,
				'message' => "Data berhasil disimpan."
			);
			# Everything is Perfect. 
			# Committing data to the database.
			$this->db->trans_commit();
		}
		echo json_encode($resultjson);
	}

	function Update()
	{
		
		$user = 'ANDREAN';
		// $kodecabang = "BEVOS";

		$kodebarang = $this->input->post('kode');
		$kodegudang = $this->input->post('kodegudang');
		// $kodecabang = "CBGKDL001";
		$periode = date("Y") . date("m");
		// $pemakai = "VSP";

		$this->db->trans_start(); # Starting Transaction
		$this->db->trans_strict(FALSE);
		$data = [
			'kode' => $kodebarang,
			'nama' => $this->input->post('nama'),
			'kodesatuan' => $this->input->post('kodesatuan'),
			'kodekategori' => $this->input->post('kodekategori'),
			'kodemerk' => $this->input->post('kodemerk'),
			'update_at' => date('Y-m-d H:i:s'),
			'users_update' => $user,
			'status' => $this->input->post('aktif')
			
		];
		// print_r($data);
		// die();
		$this->Produk_model->UpdateData($data, $kodebarang);

		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			$resultjson = array(
				'kode' => "",
				'message' => "Data gagal diperbarui, Kode '<b style='color: red'>" . $kodebarang . "</b>' sudah pernah digunakan."
			);
			# Something went wrong.
			$this->db->trans_rollback();
		} else {
			$resultjson = array(
				'kode' => $kodebarang,
				'message' => "Data berhasil diperbarui."
			);
			# Everything is Perfect. 
			# Committing data to the database.
			$this->db->trans_commit();
		}
		echo json_encode($resultjson);
	}
}
