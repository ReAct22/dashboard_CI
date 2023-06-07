<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Supplier extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model('masterdata/Supplier_model');
		$this->load->model('caridataaktif_model');
		$this->load->library('form_validation');
		$this->load->library('session');
	}

	function CariDataSupplier()
	{
		$fetch_data = $this->caridataaktif_model->make_datatables($this->input->post('field'), $this->input->post('nmtb'), $this->input->post('sort'), $this->input->post('where'), $this->input->post('value'));
		$data = array();
		foreach ($fetch_data as $row) {
			$sub_array = array();
			$i = 1;
			$count = count($this->input->post('field'));
			foreach ($this->input->post('field') as $key => $value) {
				if ($i <= $count) {
					if ($i == 1) {
						$msearch = $row->$value;
						$sub_array[] = '<button class="btn btn-dark searchsupplier" data-dismiss="modal" style="margin: 0px;" data-id="' . $msearch . '"><i class="far fa-check-circle"></i></button>';
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
			"recordsTotal"          =>      $this->caridataaktif_model->get_all_data($this->input->post('nmtb')),
			"recordsFiltered"     =>     $this->caridataaktif_model->get_filtered_data($this->input->post('field'), $this->input->post('nmtb'), $this->input->post('sort'), $this->input->post('where'), $this->input->post('value')),
			"data"                    =>     $data
		);
		echo json_encode($output);
	}

	function DataSupplier()
	{
		$result =  $this->Supplier_model->DataSupplier($this->input->post('nomor'));
		echo json_encode($result);
	}

	function Save()
	{
		$kodecabang = 'J';
		$pemakai = 'Andrean';


		$nomor = $this->input->post('nomor');

		if (empty($nomor)) {
			$this->db->trans_start(); # Starting Transaction
			$this->db->trans_strict(FALSE);

			$get["supplier"] = $this->Supplier_model->GetMaxNomor("S");

			if (!$get["supplier"]) {
				$nomor = "S000000001";
			} else {
				$lastNomor = $get["supplier"]->kode;
				$lastNoUrut = substr($lastNomor, 2, 9);

				// nomor urut ditambah 1
				$nextNoUrut = $lastNoUrut + 1;
				$nomor = "S" . sprintf('%09s', $nextNoUrut);
			}

			// print_r($nomor);
			$data = array(
				'kode' => $nomor,
				'nama' => $this->input->post('nama'),
				'alamat' => $this->input->post('alamat'),
				'no_telp' => $this->input->post('notlp'),
				'status_pkp' => $this->input->post('statuspkp'),
				'npwp' => $this->input->post('npwp'),
				'alamat_npwp' => $this->input->post('alamatnpwp'),
				'create_at' => date("Y-m-d H:i:s"),
				'update_at' => date("Y-m-d H:i:s"),
				'users' => $pemakai,
				'users_update' => $pemakai,
				'kodecabang' => $kodecabang
			);
			$this->Supplier_model->SaveData($data);
		}

		// die();
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			$resultjson = array(
				'nomor' => "",
				'message' => "Data gagal disimpan, Nomor '<b style='color: red'>" . $nomor . "</b>' sudah pernah digunakan."
			);
			# Something went wrong.
			$this->db->trans_rollback();
		} else {
			$resultjson = array(
				'nomor' => $nomor,
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
		$kodecabang = $this->session->userdata('mycabang');
		$pemakai = $this->session->userdata('myusername');

		$nomor = $this->input->post('nomor');

		$this->db->trans_start(); # Starting Transaction
		$this->db->trans_strict(FALSE);

		$data = array(
			'kode' => $nomor,
			'nama' => $this->input->post('nama'),
			'alamat' => $this->input->post('alamat'),
			'no_telp' => $this->input->post('notlp'),
			'status_pkp' => $this->input->post('statuspkp'),
			'npwp' => $this->input->post('npwp'),
			'alamat_npwp' => $this->input->post('alamatnpwp'),
			'create_at' => date("Y-m-d H:i:s"),
			'update_at' => date("Y-m-d H:i:s"),
			'users' => $pemakai,
			'users_update' => $pemakai,
			'kodecabang' => $kodecabang,
			'status' => $this->input->post('aktif')
		);

		$this->Supplier_model->UpdateData($data, $nomor);

		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			$resultjson = array(
				'nomor' => "",
				'message' => "Data gagal diperbarui, Nomor '<b style='color: red'>" . $nomor . "</b>' sudah pernah digunakan."
			);
			# Something went wrong.
			$this->db->trans_rollback();
		} else {
			$resultjson = array(
				'nomor' => $nomor,
				'message' => "Data berhasil diperbarui."
			);
			# Everything is Perfect. 
			# Committing data to the database.
			$this->db->trans_commit();
		}
		echo json_encode($resultjson);
	}
}
