<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Konfigurasi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('masterdata/Konfigurasi_model');
        $this->load->model('Caridataaktif_model');
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    function CariDataKonfigurasi()
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
                        $sub_array[] = '<button class="btn btn-dark searchkonfigurasi" data-dismiss="modal" style="margin: 0px;" data-id="' . $msearch . '"><i class="far fa-check-circle"></i></button>';
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

    function DataKonfigurasi()
    {
        $result = $this->Konfigurasi_model->DataKonfigurasi($this->input->post('kode'));
        echo json_encode($result);
    }
	function CekDataKonfigurasi()
    {
        $result = $this->Konfigurasi_model->CekDataKonfigurasi();
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
        $kode = $this->input->post('kode');
        $cekkode = $this->Konfigurasi_model->CekKonfigurasi($kode);

        if (empty($cekkode)) {
            $this->db->trans_start(); # Starting Transaction
            $this->db->trans_strict(FALSE);

            $data = [
                'kode' => $this->input->post('kode'),
                'namaperusahaan' => $this->input->post('namaperusahaan'),
                'alamatperusahaan' => $this->input->post('alamat'),
                'pkp' => $this->input->post('statuspkp'),
                'npwp' => $this->input->post('npwp'),
                'namanpwp' => $this->input->post('namanpwp'),
                'alamatnpwp' => $this->input->post('alamatnpwp'),
                'ppn' => $this->ClearPercent($this->input->post('ppn')),
                'disccash' => $this->ClearPercent($this->input->post('disccash')),
                'disccod' => $this->ClearPercent($this->input->post('disccod')),
                'nourut' => $this->input->post('nourut'),
                'backdate' => $this->input->post('backdate')
            ];
            $this->Konfigurasi_model->SaveData($data);

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
        $kode = $this->input->post('kode');
        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(FALSE);

        $data = [
            'kode' => $this->input->post('kode'),
            'namaperusahaan' => $this->input->post('namaperusahaan'),
            'alamatperusahaan' => $this->input->post('alamat'),
            'pkp' => $this->input->post('statuspkp'),
            'npwp' => $this->input->post('npwp'),
            'namanpwp' => $this->input->post('namanpwp'),
            'alamatnpwp' => $this->input->post('alamatnpwp'),
            'ppn' => $this->ClearPercent($this->input->post('ppn')),
            'disccash' => $this->ClearPercent($this->input->post('disccash')),
            'disccod' => $this->ClearPercent($this->input->post('disccod')),
            'nourut' => $this->input->post('nourut'),
            'backdate' => $this->input->post('backdate')
        ];

        $this->Konfigurasi_model->UpdateData($data, $kode);

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
