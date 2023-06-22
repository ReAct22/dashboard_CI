<?php

class Leveldiskon_model extends CI_Model
{
	function CekKode($kode = "")
	{
		return $this->db->query("SELECT *FROM tblmst_leveldiskon WHERE kode = '" . $kode . "'")->result();
	}
	public function GetMaxNomor($nomor= "")
    {
        $this->db->select_max('kode');
        $this->db->where("left(kode,7)",$nomor);
        return $this->db->get("tblmst_leveldiskon")->row();
    }
	function DataDiskon($kode = "")
	{
		return $this->db->query("SELECT *FROM tblmst_leveldiskon WHERE kode = '" . $kode . "'")->result();
	}
	function SaveData($data = "")
	{
		return $this->db->insert("tblmst_leveldiskon", $data);
	}
	function UpdateData($kode = "", $data = "")
	{
		$this->db->where('kode', $kode);
		return $this->db->update("tblmst_leveldiskon", $data);
	}
}
