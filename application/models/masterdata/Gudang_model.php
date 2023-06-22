<?php

class Gudang_model extends CI_Model
{
    function CekKode($kode = "")
    {
        return $this->db->query("SELECT * FROM tblmst_gudang WHERE kode = '" . $kode . "' ")->result();
    }

	function CekCabang($kodecabang = ""){
		return $this->db->query("SELECT *FROM tblmst_gudang WHERE kodecabang = '".$kodecabang."'")->result();
	}

	function CekStatusGudang($table = "",$where=array()){
		$this->db->where($where);
		return $this->db->get($table )->result();
	}

	public function GetMaxNomor($kode= "")
    {
        $this->db->select_max('kode');
        $this->db->where("left(kode,2)",$kode);
        return $this->db->get("tblmst_gudang")->row();
    }

    function DataCabang($kode = "")
    {
        return $this->db->query("SELECT kode AS kodecabang, nama AS namacabang FROM glbm_cabang WHERE kode = '" . $kode . "' ")->result();
    }

    function DataGudang($kode = "")
    {
        return $this->db->query("SELECT * FROM tblmst_gudang WHERE kode = '" . $kode . "' ")->result();
    }

    function SaveData($data = "")
    {
        return $this->db->insert('tblmst_gudang', $data);
    }

	
    function UpdateData($data = "", $kode = "")
    {
        $this->db->where('kode', $kode);
        return $this->db->update('tblmst_gudang', $data);
    }

    function DataGdg($searchTerm = "", $cabang = "")
    {
        $this->db->select("*");
        $this->db->where("nama like '%" . $searchTerm . "%' AND aktif = true AND kodecabang = '" . $cabang . "'");
        $fetched_records = $this->db->get("tblmst_gudang");
        $datapelanggan = $fetched_records->result_array();


        $data = array();
        foreach ($datapelanggan as $val) {

            $data[] = array(
                "id" => $val['kode'],
                "text" => $val['nama']
            );
        }

        return $data;
    }
}
