<?php

class Cabang_model extends CI_Model
{
	public function GetNewNomor($nomor = '')
	{
		$this->db->select_max('kode');
		$this->db->where('left(kode,1)', $nomor);
		return $this->db->get('tblmst_cabang')->row();
	}

	public function GetKode($nomor){
		return $this->db->query("SELECT *FROM tblmst_cabang WHERE kode = '".$nomor."'")->result();
	}

	public function GetData($nomor){
		return $this->db->query("SELECT *FROM tblmst_cabang WHERE kode = '".$nomor."'")->result();
	}

	public function SaveData($data = ""){
		return $this->db->insert("tblmst_cabang", $data);
	}

	public function UpdateData($data = "", $nomor = ""){
		$this->db->where('kode', $nomor);
		return $this->db->update('tblmst_cabang', $data);
	}
}
