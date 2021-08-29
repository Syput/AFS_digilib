<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_model extends CI_Model {

    public function get_where($where, $table)
    {
        return $this->db->get_where($table, $where);
    }

    public function insert($data, $table)
    {
        $this->db->insert($table, $data);
    }

    public function get($table,$ord)
    {
        $this->db->ORDER_BY($ord, 'DESC');
        return $this->db->get($table);
    }

    public function delete($where, $table)
    {
        $this->db->delete($table, $where);
    }

    public function update($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
    
    function get_buku($abjad){
        $query_str = "SELECT * FROM tb_buku WHERE judul LIKE ? ";
        $result=$this->db->query($query_str,array($abjad));
        return $result;
    }
	
	public function CekKodeBuku()
    {
        $query = $this->db->query("SELECT MAX(kode_buku) as kodeb from tb_buku");
        $hasil = $query->row();
        return $hasil->kodeb;
    }
	
	public function CekKodePenelitian()
    {
        $query = $this->db->query("SELECT MAX(kode_penelitian) as kodep from tb_penelitian");
        $hasil = $query->row();
        return $hasil->kodep;
    }
	
	public function CekKodeTransaksi()
    {
        $query = $this->db->query("SELECT MAX(kode_transaksi) as kodes from tb_transaksi");
        $hasil = $query->row();
        return $hasil->kodes;
    }
	
	public function IdBacaan()
    {
        $query = $this->db->query("SELECT MAX(id_bacaan) as id_bacaan from tb_pembaca");
        $hasil = $query->row();
        return $hasil->id_bacaan;
    }
	
	public function getMaxPembaca()
    {
        $query = $this->db->query("SELECT pembaca,pustaka,COUNT(pembaca) as jumlah from tb_pembaca GROUP BY pembaca ORDER BY jumlah DESC LIMIT 20");
        return $query;
    }
	
	public function getMaxBacaan()
    {
        $query = $this->db->query("SELECT pembaca,pustaka,COUNT(pustaka) as jumlah from tb_pembaca GROUP BY pustaka ORDER BY jumlah DESC LIMIT 20");
        return $query;
    }

    
}