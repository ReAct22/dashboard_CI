<?php

class Cabang extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model('masterdata/Cabang_model');
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
		$result = $this->Cabang_model->GetData($this->input->post('kode'));
		echo json_encode($result);
	}



	function Save()
	{
		$user = 'Andrean';
		$kode = $this->input->post('kode');
		$cekkode = $this->Cabang_model->GetKode($kode);

		if (empty($cekkode)) {
			$this->db->trans_start();
			$this->db->trans_strict(FALSE);

			$data = [
				'kode' => $this->input->post('kode'),
				'nama' => $this->input->post('nama'),
				'users' => $user,
				'create_at' => date('Y-m-d H:i:s'),
				'update_at' => date('Y-m-d H:i:s'),
				'users_update' => $user
			];
			// print($data);
			$this->Cabang_model->SaveData($data);
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
		$user = 'Andrean';
		$kode = $this->input->post('kode');
		$cekkode = $this->Cabang_model->GetKode($kode);

		$this->db->trans_start();
		$this->db->trans_strict(FALSE);

		$data = [
			'kode' => $this->input->post('kode'),
			'nama' => $this->input->post('nama'),
			'update_at' => date('Y-m-d H:i:s'),
			'users_update' => $user,
			'status' => $this->input->post('aktif'),
		];
		// print($data);
		$this->Cabang_model->UpdateData($data, $kode);
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
	}
}
