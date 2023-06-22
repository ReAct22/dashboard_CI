<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Gudang extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model('masterdata/Gudang_model');
		$this->load->model('Caridataaktif_model');
		$this->load->library('form_validation');
		$this->load->library('session');
	}

	function CariDataCabang()
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
						$sub_array[] = '<button class="btn btn-dark searchcabang" data-dismiss="modal" style="margin: 0px;" data-id="' . $msearch . '"><i class="far fa-check-circle"></i></button>';
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

	function DataCabang()
	{
		$result = $this->Gudang_model->DataCabang($this->input->post('kodecabang'));
		echo json_encode($result);
	}

	function CariDataGudang()
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
						$sub_array[] = '<button class="btn btn-dark searchgudang" data-dismiss="modal" style="margin: 0px;" data-id="' . $msearch . '"><i class="far fa-check-circle"></i></button>';
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

	function DataGudang()
	{
		$result = $this->Gudang_model->DataGudang($this->input->post('kode'));
		echo json_encode($result);
	}

	function Save()
	{
		$pemakai = 'Andrean';
		$kodegudang = $this->input->post('kode');
		$namagudang = $this->input->post('nama');
		$kodecabang = $this->input->post('kodecabang');
		$alamat = $this->input->post('alamat');

		$status = ($this->input->post('status') == 'true') ? true : false;

		$errorvalidasi = false;
		if (($this->input->post('status') == 'true')) {
			$where = array(
				'kodecabang' => $kodecabang,
				'status_gudang' => $status,
			);
			$cekkode  = $this->Gudang_model->CekStatusGudang('tblmst_gudang', $where);
			if (!empty($cekkode)) {
				$resultjson = array(
					'kode' => "",
					'message' => "Data gagal disimpan. Cabang Sudah Memiliki Gudang Utama"
				);
				$errorvalidasi = TRUE;
				echo json_encode($resultjson);
				return FALSE;
			}
		}
		$where = array(
			'kodecabang' => $kodecabang,
			'kode' => $kodegudang
		);
		$cekkode  = $this->Gudang_model->CekStatusGudang('tblmst_gudang', $where);
		if (!empty($cekkode)) {
			$resultjson = array(
				'kode' => "",
				'message' => "Data gagal disimpan. Cabang Sudah Terdaftar"
			);
			$errorvalidasi = TRUE;
			echo json_encode($resultjson);
			return FALSE;
		}
		if ($errorvalidasi == false) {
			$this->db->trans_start(); # Starting Transaction
			$this->db->trans_strict(FALSE);

			$data = array(
				'kode' => $kodegudang,
				'nama' => $namagudang,
				'alamat' => $alamat,
				'status_gudang' => $status,
				'kodecabang' => $kodecabang,
				'users' => $pemakai,
				'create_at' => date('Y-m-d H:i:s'),
				'update_at' => date('Y-m-d H:i:s'),
				'users_update' => $pemakai,
				// 'kodecabang' => $kodecabang,
			);


			$this->Gudang_model->SaveData($data);

			$this->db->trans_complete();

			if ($this->db->trans_status() == FALSE) {
				$resultjson = array(
					'kode' => "",
					'message' => "Data gagal disimpan, Kode '<b style='color: red'>" . $kodegudang . "</b>'  sudah pernah digunakan."
				);
				# Something went wrong
				$this->db->trans_rollback();
			} else {
				$resultjson = array(
					'kode' => $kodegudang,
					'message' => "Data berhasil disimpan."
				);
				# Everything is Perfect. 
				# Committing data to the database.
				$this->db->trans_commit();
			}
			echo json_encode($resultjson);
			return FALSE;
		}
	}



	function Update()
	{
		$pemakai = "Andrean";
		$kodegudang = $this->input->post('kode');
		$namagudang = $this->input->post('nama');
		$kodecabang = $this->input->post('kodecabang');
		$alamat = $this->input->post('alamat');

		$status = ($this->input->post('status') == 'true') ? true : false;

		$errorvalidasi = false;
		if (($this->input->post('status') == 'true')) {
			$where = array(
				'kodecabang' => $kodecabang,
				'status_gudang' => $status,
			);
			$cekkode  = $this->Gudang_model->CekStatusGudang('tblmst_gudang', $where);
			if (!empty($cekkode)) {
				$resultjson = array(
					'kode' => "",
					'message' => "Data gagal disimpan. Cabang Sudah Memiliki Gudang Utama"
				);
				$errorvalidasi = TRUE;
				echo json_encode($resultjson);
				return FALSE;
			}
		}
		if ($errorvalidasi == false) {
			$this->db->trans_start(); # Starting Transaction
			$this->db->trans_strict(FALSE);

			$data = array(
				'kode' => $kodegudang,
				'nama' => $namagudang,
				'alamat' => $alamat,
				'status_gudang' => $status,
				'kodecabang' => $kodecabang,
				'users_update' => $pemakai,
				'update_at' => date('Y-m-d H:i:s'),
				'status' => $this->input->post('aktif')
				// 'kodecabang' => $kodecabang,
			);


			$this->Gudang_model->UpdateData($data, $kodegudang);

			$this->db->trans_complete();

			if ($this->db->trans_status() == FALSE) {
				$resultjson = array(
					'kode' => "",
					'message' => "Data gagal disimpan, Kode '<b style='color: red'>" . $kodegudang . "</b>'  sudah pernah digunakan."
				);
				# Something went wrong
				$this->db->trans_rollback();
			} else {
				$resultjson = array(
					'kode' => $kodegudang,
					'message' => "Data berhasil disimpan."
				);
				# Everything is Perfect. 
				# Committing data to the database.
				$this->db->trans_commit();
			}
			echo json_encode($resultjson);
			return FALSE;
		}
	}

	function DataGdg()
	{
		$response = $this->Gudang_model->DataGdg($this->input->post('searchTerm'), $this->input->post('cabang'));
		echo json_encode($response);
	}
}
