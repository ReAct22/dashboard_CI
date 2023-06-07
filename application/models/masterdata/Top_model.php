<?php

class Top_model extends CI_Model
{
    function CekKode($kode = "")
    {
        return $this->db->query("SELECT * FROM tblmst_top WHERE kode = '" . $kode . "' ")->result();
    }
	public function GetMaxNomor($kode= "")
    {
        $this->db->select_max('kode');
        $this->db->where("left(kode,3)",$kode);
        return $this->db->get("tblmst_top")->row();
    }
    function DataTop($kode = "")
    {
        return $this->db->query("SELECT * FROM tblmst_top WHERE kode = '" . $kode . "' ")->result();
    }

    function SaveData($data = "")
    {
        return $this->db->insert('tblmst_top', $data);
    }

    function UpdateData($data = "", $kode = "")
    {
        $this->db->where('kode', $kode);
        return $this->db->update('tblmst_top', $data);
    }
}
