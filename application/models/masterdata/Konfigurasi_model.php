<?php

class Konfigurasi_model extends CI_Model
{
    function CekKonfigurasi($kode = "")
    {
        return $this->db->query("SELECT * FROM tblmst_konfigurasi WHERE kode = '" . $kode . "' ")->result();
    }

    function DataKonfigurasi($kode = "")
    {
        return $this->db->query("SELECT * FROM tblmst_konfigurasi WHERE kode = '" . $kode . "' ")->result();
    }
	function CekDataKonfigurasi()
    {
        return $this->db->query("SELECT * FROM tblmst_konfigurasi")->result();
    }


    function SaveData($data = "")
    {
        return $this->db->insert('tblmst_konfigurasi', $data);
    }

    function UpdateData($data = "", $kode = "")
    {
        $this->db->where('kode', $kode);
        return $this->db->update('tblmst_konfigurasi', $data);
    }
}
