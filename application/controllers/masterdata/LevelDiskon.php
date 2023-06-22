<?php

defined('BASEPATH') or exit('No direct scropt access allowed');

class LevelDiskon extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model('masterdata/Leveldiskon_model');
		$this->load->model('Caridataaktif_model');
		$this->load->library('form_validation');
		$this->load->library('session');
	}

	function CariDataDiskon()
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
						$sub_array[] = '<button class="btn btn-dark searchdiskon" data-dismiss="modal" style="margin: 0px;" data-id="' . $msearch . '"><i class="far fa-check-circle"></i></button>';
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

	function DataDiskon()
	{
		$result = $this->Leveldiskon_model->DataDiskon($this->input->post('kode'));
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
		$pemakai = "Andrean";
		$kode = $this->input->post('kode');
		$CekKode = $this->Leveldiskon_model->CekKode($kode);
        $kodecabang = "J";


		if (empty($CekKode)) {
			$this->db->trans_start();
			$this->db->trans_strict(FALSE);
			$ambilnomor = "LVLDSC". $kodecabang;
			$get["leveldiskon"] = $this->Leveldiskon_model->GetMaxNomor($ambilnomor);
			if (!$get["leveldiskon"]) {
				$kode = "000001";
			} else {
				$lastNomor = $get['leveldiskon']->kode;
				$lastNoUrut = substr($lastNomor, 7,13);

				// nomor urut ditambah 1
				$nextNoUrut = (int)$lastNoUrut + 1;
				$kode = $ambilnomor . sprintf('%06s', $nextNoUrut);;
				// print_r($kode);
				// die();
			}
			$data = [
				'kode' => $kode,
				'diskon' => $this->ClearPercent($this->input->post('diskon')),
				'kondisi1' => $this->ClearChr($this->input->post('kondisi1')),
				'kondisi2' => $this->ClearChr($this->input->post('kondisi2')),
				'kodecabang' => $this->input->post('kodecabang'),
				'noreferensi' => $this->input->post('noreferensi'),
				'kodebarang' => $this->input->post('kodebarang'),
				'namabarang' => $this->input->post('namabarang'),
				'create_at' => date('Y-m-d H:m:s'),
				'update_at' => date('Y-m-d H:m:s'),
				'users' => $pemakai,
				'users_update' => $pemakai,
			];
			// print_r($data);
			// die();

			$this->Leveldiskon_model->SaveData($data);

			$this->db->trans_complete($data);

			if ($this->db->trans_status() == FALSE) {
				$resultjson = array(
					'kode' => "",
					'message' => "Data gagal disimpan, Kode '<b style='color: red'>" . $kode . "</b>' sudah pernah digunakan."
				);

				$this->db->trans_rollback();
			} else {
				$resultjson = array(
					'kode' => $kode,
					'message' => "Data berhasil disimpan."
				);

				$this->db->trans_commit();
			}
			echo json_encode($resultjson);
		} else {
			$this->db->trans_complete();
			$resultjson = array(
				'kode' => "",
				'message' => "Data gagal disimpan, Kode '<b style='color: red'>" . $kode . "</b>' sudah pernah digunakan."
			);
			$this->db->trans_rollback();
			echo json_encode($resultjson);
		}
	}

	function Update()
	{
		$pemakai = $this->session->userdata('myusername');
		$kode = $this->input->post('kode');
		$CekKode = $this->Leveldiskon_model->CekKode($kode);

		$this->db->trans_start();
		$this->db->trans_strict(FALSE);

		$data = [
			'kode' => $kode,
			'diskon' => $this->ClearPercent($this->input->post('diskon')),
			'kondisi1' => $this->ClearChr($this->input->post('kondisi1')),
			'kondisi2' => $this->ClearChr($this->input->post('kondisi2')),
			'kodecabang' => $this->input->post('kodecabang'),
			'noreferensi' => $this->input->post('noreferensi'),
			'kodebarang' => $this->input->post('kodebarang'),
			'namabarang' => $this->input->post('namabarang'),
			'update_at' => date('Y-m-d H:m:s'),
			'status' => $this->input->post('aktif'),
			'users_update' => $pemakai
		];

		$this->Leveldiskon_model->UpdateData($kode, $data);

		$this->db->trans_complete();

		if ($this->db->trans_status() == FALSE) {
			$resultjson = array(
				'kode' => "",
				'message' => "Data gagal diperbarui, Kode '<b style='color: red'>" . $kode . "</b>' sudah pernah digunakan."
			);

			$this->db->trans_rollback();
		} else {
			$resultjson = array(
				'kode' => $kode,
				'message' => "Data berhasil diperbarui."
			);

			$this->db->trans_commit();
		}
		echo json_encode($resultjson);
	}
}
