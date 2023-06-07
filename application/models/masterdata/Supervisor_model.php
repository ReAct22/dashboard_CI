<?php

class Supervisor_model extends CI_Model
{
    function CekKode($kode = "")
    {
        return $this->db->query("SELECT * FROM glbm_supervisor WHERE kode = '" . $kode . "' ")->result();
    }

	// function GetMaxNomor($kode = ""){
	// 	$this->db->select_max('kode');
	// 	$this->db->where("left(kode,3)", $kode);
	// 	return $this->db->get('glbm_supervisor')->row();
	// }

	public function GetMaxNomor($kode= "")
    {
        $this->db->select_max('kode');
        $this->db->where("left(kode,3)",$kode);
        return $this->db->get("glbm_supervisor")->row();
    }

    function DataSupervisor($kode = "")
    {
        return $this->db->query("SELECT * FROM glbm_supervisor WHERE kode = '" . $kode . "' ")->result();
    }

    function SaveData($data = "")
    {
        return $this->db->insert('glbm_supervisor', $data);
    }

    function UpdateData($data = "", $kode = "")
    {
        $this->db->where('kode', $kode);
        return $this->db->update('glbm_supervisor', $data);
    }
}
