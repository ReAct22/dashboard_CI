<?php

class Coa_model extends CI_Model
{
    function CekNoaccount($kode = "")
    {
        return $this->db->query("SELECT * FROM tblmst_coa WHERE kode = '" . $kode . "' ")->result();
    }
	public function GetMaxNomor($kode= "")
    {
        $this->db->select_max('kode');
        $this->db->where("left(kode,3)",$kode);
        return $this->db->get("tblmst_coa")->row();
    }
    function DataCoa($kode = "")
    {
        return $this->db->query("SELECT * FROM tblmst_coa WHERE kode = '" . $kode . "' ")->result();
    }

    function SaveData($data = "")
    {
        return $this->db->insert('tblmst_coa', $data);
    }

    function UpdateData($data = "", $kode = "")
    {
        $this->db->where('kode', $kode);
        return $this->db->update('tblmst_coa', $data);
    }
}
