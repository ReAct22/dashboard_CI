<?php

class Supplier_model extends CI_Model{

    public function GetMaxNomor($nomor= "")
    {
        $this->db->select_max('kode');
        $this->db->where("left(kode,1)",$nomor);
        return $this->db->get("tblmst_supplier")->row();
    }

    function DataSupplier($nomor = "")
    {
        return $this->db->query("SELECT * FROM tblmst_supplier WHERE kode = '".$nomor."' ")->result();
    }

    function SaveData($data = "")
    {
        return $this->db->insert('tblmst_supplier', $data);
    }

    function UpdateData($data ="",$nomor = "")
    {
		$this->db->where('kode', $nomor);
        return $this->db->update('tblmst_supplier', $data);
	}

}
