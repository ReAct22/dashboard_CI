<?php

class Produk_model extends CI_Model
{
    function CekBarang($kode = "")
    {
        return $this->db->query("SELECT * FROM tblmst_product WHERE kode = '" . $kode . "' ")->result();
    }

    function DataBarang($kode = "")
    {
        return $this->db->query("SELECT * FROM tblmst_product WHERE kode = '" . $kode . "' ")->result();
    }

    function SaveData($data = "")
    {
        return $this->db->insert('tblmst_product', $data);
    }

    function UpdateData($data = "", $kode = "")
    {
        $this->db->where('kode', $kode);
        return $this->db->update('tblmst_product', $data);
    }

}
