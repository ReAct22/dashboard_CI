<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Coa extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('masterdata/Coa_model');
        $this->load->model('Caridataaktif_model');
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    function CariDataCoa()
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
                        $sub_array[] = '<button class="btn btn-dark searchcoa" data-dismiss="modal" style="margin: 0px;" data-id="' . $msearch . '"><i class="far fa-check-circle"></i></button>';
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

    function DataCoa()
    {
        $result = $this->Coa_model->DataCoa($this->input->post('nomor'));
        echo json_encode($result);
    }

    function Save()
    {
        $pemakai = "VSP";

        $nomor = $this->input->post('nomor');
        $ceknoaccount = $this->Coa_model->CekNoaccount($nomor);

        if (empty($ceknoaccount)) {
            
            $data = [
                'kode' => $nomor,
                'nama' => $this->input->post('namaaccount'),
                'jenis' => $this->input->post('jenisacc'),
                'users' => $pemakai,
                'create_at' => date('Y-m-d H:i:s'),
                'update_at' => date('Y-m-d H:i:s'),
                'users_update' => $pemakai,
            ];

            $this->Coa_model->SaveData($data);

            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                $resultjson = array(
                    'nomor' => "",
                    // 'kelurahan' => "",
                    'message' => "Data gagal disimpan, Nomor '<b style='color: red'>" . $nomor . "</b>'  sudah pernah digunakan."
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
        } else {
            $this->db->trans_complete();
            $resultjson = array(
                'nomor' => "",
                'message' => "Data gagal disimpan, Nomor '<b style='color: red'>" . $nomor . "</b>' sudah pernah digunakan."
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

        $nomor = $this->input->post('nomor');

        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(FALSE);

		$data = [
			'kode' => $this->input->post('nomor'),
			// 'norekening' => $this->input->post('norek'),
			'nama' => $this->input->post('namaaccount'),
			// 'kodeprefix' => $this->input->post('jenisacc'),
			'jenis' => $this->input->post('jenisacc'),
			'update_at' => date('Y-m-d H:i:s'),
            'users_update' => $pemakai,
			// 'kode_cabang' => $kodecabang,
			'status' => $this->input->post('aktif'),
			// 'kodecabang' => $kodecabang,
		];

        $this->Coa_model->UpdateData($data, $nomor);

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
                'noaccount' => $nomor,
                'message' => "Data berhasil diperbarui."
            );
            # Everything is Perfect. 
            # Committing data to the database.
            $this->db->trans_commit();
        }
        echo json_encode($resultjson);
    }
}
