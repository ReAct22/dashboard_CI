<?php

class Kodepos_model extends CI_Model
{
    public function GetMaxNomor($kode = "")
    {
        $this->db->select_max('kode');
        $this->db->where("left(kode,3)", $kode);
        return $this->db->get("tblmst_pos")->row();
    }

    function CekKode($kode = "")
    {
        return $this->db->query("SELECT kode FROM tblmst_pos WHERE kode = '" . $kode . "' ")->result();
    }

    function DataKodePos($kode = "")
    {
        return $this->db->query("SELECT * FROM tblmst_pos WHERE kode = '" . $kode . "' ")->result();
    }

    function SaveData($data = "")
    {
        return $this->db->insert('tblmst_pos', $data);
    }

    function UpdateData($data = "", $kode = "")
    {
        $this->db->where('kode', $kode);
        // $this->db->where('kelurahan', $kelurahan);
        return $this->db->update('tblmst_pos', $data);
    }
}
