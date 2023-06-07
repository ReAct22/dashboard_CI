<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Top extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('masterdata/Top_model');
        $this->load->model('Caridataaktif_model');
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    function CariDataTop()
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
                        $sub_array[] = '<button class="btn btn-dark searchtop" data-dismiss="modal" style="margin: 0px;" data-id="' . $msearch . '"><i class="far fa-check-circle"></i></button>';
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

    function DataTop()
    {
        $result = $this->Top_model->DataTop($this->input->post('kode'));
        echo json_encode($result);
    }

    function Save()
    {
        // $kodecabang = $this->session->userdata('mycabang');
        // $pemakai = $this->session->userdata('myusername');
        // $kodecabang = "BEVOS";
        $pemakai = "VSP";

        $kode = $this->input->post('kode');
        $cekkode = $this->Top_model->CekKode($kode);

        if (empty($cekkode)) {
            $this->db->trans_start(); # Starting Transaction
            $this->db->trans_strict(FALSE);
			
			$ambilnomor = "TOP";
			$get["top"] = $this->Top_model->GetMaxNomor($ambilnomor);
			if (!$get["top"]) {
				$kode = "0001";
			} else {
				$lastNomor = $get['top']->kode;
				$lastNoUrut = substr($lastNomor, 3,6);

				// nomor urut ditambah 1
				$nextNoUrut = $lastNoUrut + 1;
				$kode = $ambilnomor . sprintf('%04s', $nextNoUrut);;
				// print_r($kode);
				// die();
			}
            $data = [
                'kode' => $kode,
                'keterangan' => $this->input->post('keterangan'),
                'hari' => $this->input->post('jumlah'),
                'kota' => $this->input->post('kota'),
                'users' => $pemakai,
                'create_at' => date('Y-m-d H:i:s'),
                'update_at' => date('Y-m-d H:i:s'),
                // 'kodecabang' => $kodecabang,
                'users_update' => $pemakai,
            ];

            $this->Top_model->SaveData($data);

            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                $resultjson = array(
                    'kode' => "",
                    'message' => "Data gagal disimpan, Kode '<b style='color: red'>" . $kode . "</b>'  sudah pernah digunakan."
                );
                # Something went wrong.
                $this->db->trans_rollback();
            } else {
                $resultjson = array(
                    'kode' => $kode,
                    'message' => "Data berhasil disimpan."
                );
                # Everything is Perfect. 
                # Committing data to the database.
                $this->db->trans_commit();
            }
            echo json_encode($resultjson);
        } else {
            $this->db->trans_complete();
            $resultjson = array(
                'kode' => "",
                'message' => "Data gagal disimpan, Kode '<b style='color: red'>" . $kode . "</b>' sudah pernah digunakan."
            );
            # Something went wrong.
            $this->db->trans_rollback();
            echo json_encode($resultjson);
        }
    }

    function Update()
    {
        // $kodecabang = $this->session->userdata('mycabang');
        // $pemakai = $this->session->userdata('myusername');
        // $kodecabang = "BEVOS";
        $pemakai = "VSP";

        $kode = $this->input->post('kode');

        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(FALSE);

        $data = [
			'kode' => $kode,
			'keterangan' => $this->input->post('keterangan'),
			'hari' => $this->input->post('jumlah'),
			'kota' => $this->input->post('kota'),
			'update_at' => date('Y-m-d H:i:s'),
			// 'kodecabang' => $kodecabang,
			'users_update' => $pemakai,
			'status' => $this->input->post('aktif'),
		];

        $this->Top_model->UpdateData($data, $kode);

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            $resultjson = array(
                'kode' => "",
                'message' => "Data gagal diperbarui, Kode '<b style='color: red'>" . $kode . "</b>' sudah pernah digunakan."
            );
            # Something went wrong.
            $this->db->trans_rollback();
        } else {
            $resultjson = array(
                'kode' => $kode,
                'message' => "Data berhasil diperbarui."
            );
            # Everything is Perfect. 
            # Committing data to the database.
            $this->db->trans_commit();
        }
        echo json_encode($resultjson);
    }
}
