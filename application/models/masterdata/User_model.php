<?php

class User_model extends CI_Model
{

    function CekUsername($username = "")
    {
        return $this->db->query("SELECT * FROM stpm_login WHERE username = '" . $username . "'")->result();
    }

    function DataUser($username = "")
    {
        return $this->db->query("SELECT * FROM stpm_login WHERE username = '" . $username . "'")->result();
    }

    function DataGroup($kode = "")
    {
        return $this->db->query("SELECT * FROM stpm_grup WHERE kode = '" . $kode . "'")->result();
    }

    function DataCabang($kode = "")
    {
        return $this->db->query("SELECT * FROM glbm_cabang WHERE kode = '" . $kode . "'")->result();
    }

    function DataGudang($kode = "")
    {
        return $this->db->query("SELECT * FROM glbm_gudang WHERE kode = '" . $kode . "'")->result();
    }

    function SaveData($data = "")
    {
        return $this->db->insert("stpm_login", $data);
    }

    function UpdateData($username = "", $data = "")
    {
        $this->db->where('username', $username);
        return $this->db->update("stpm_login", $data);
    }
}
