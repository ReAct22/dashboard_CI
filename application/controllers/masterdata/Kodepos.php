<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Kodepos extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('masterdata/Kodepos_model');
        $this->load->model('Caridataaktif_model');
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    function CariDataKodePos()
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
                        $sub_array[] = '<button class="btn btn-dark searchkodepos" data-dismiss="modal" style="margin: 0px;" data-id="' . $msearch . '"><i class="far fa-check-circle"></i></button>';
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

    function DataKodePos()
    {
        $result = $this->Kodepos_model->DataKodePos($this->input->post('kode'));
        echo json_encode($result);
    }

    function Save()
    {
        // $kodecabang = $this->session->userdata('mycabang');
        $pemakai = $this->session->userdata('myusername');
        // $kodecabang = "BEVOS";
        // $pemakai = "VSP";

        $kode = $this->input->post('kode');
        $cekkode = $this->Kodepos_model->CekKode($kode);

        if (empty($kode)) {
            $this->db->trans_start(); # Starting Transaction
            $this->db->trans_strict(FALSE);
			$ambilnomor = "POS";
			$get["pos"] = $this->Kodepos_model->GetMaxNomor($ambilnomor);
			if (!$get["pos"]) {
				$kode = "0001";
			} else {
				$lastNomor = $get['pos']->kode;
				$lastNoUrut = substr($lastNomor, 3,6);

				// nomor urut ditambah 1
				$nextNoUrut = $lastNoUrut + 1;
				$kode = $ambilnomor . sprintf('%04s', $nextNoUrut);;
				// print_r($kode);
				// die();
			}
            if (empty($cekkode)) {
                $data = [
                    'kode' => $kode,
                    'kodepos' => $this->input->post('kodepos'),
                    'kota' => $this->input->post('kota'),
                    'kecamatan' => $this->input->post('kecamatan'),
                    'kelurahan' => $this->input->post('kelurahan'),
                    'users' => $pemakai,
                    'create_at' => date('Y-m-d H:i:s'),
                    'update_at' => date('Y-m-d H:i:s'),
                    'users_update' => $pemakai,
                    // 'kodecabang' => $kodecabang,
                ];
                // print_r($data);
                // die();
                $this->Kodepos_model->SaveData($data);
            }
        }

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            $resultjson = array(
                'kode' => "",
                'message' => "Data gagal disimpan, Kode '<b style='color: red'>" . $kode . "</b>' sudah pernah digunakan."
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
    }

    function Update()
    {
        // $kodecabang = $this->session->userdata('mycabang');
        $pemakai = $this->session->userdata('myusername');
        // $kodecabang = "BEVOS";
        // $pemakai = "VSP";

        $kode = $this->input->post('kode');

        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(FALSE);

        $data = [
            'kode' => $kode,
            'kodepos' => $this->input->post('kodepos'),
            'kota' => $this->input->post('kota'),
            'kecamatan' => $this->input->post('kecamatan'),
            'kelurahan' => $this->input->post('kelurahan'),
            'status' => $this->input->post('aktif'),
            'update_at' => date('Y-m-d H:i:s'),
            'users_update' => $pemakai,
            // 'kodecabang' => $kodecabang,
        ];

        $this->Kodepos_model->UpdateData($data, $kode);

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
