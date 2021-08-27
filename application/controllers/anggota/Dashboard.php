<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('nim_nidn')){
            redirect('index.php/welcome');
        } else {
            if($this->session->userdata('level') != 'Anggota'){
                redirect('index.php/pustakawan/dashboard');
            }
        }
    }

    public function index()
    {
		
		$ip    = $this->input->ip_address(); // Mendapatkan IP user
		$date  = date("Y-m-d"); // Mendapatkan tanggal sekarang
		$waktu = time(); //
		$timeinsert = date("Y-m-d H:i:s");
		  
		// Cek berdasarkan IP, apakah user sudah pernah mengakses hari ini
		$s = $this->db->query("SELECT * FROM tb_visitor WHERE ip='".$ip."' AND date='".$date."'")->num_rows();
		$ss = isset($s)?($s):0;
		 
		// Kalau belum ada, simpan data user tersebut ke database
		if($ss == 0){
		$this->db->query("INSERT INTO tb_visitor(ip, date, hits, online, time) VALUES('".$ip."','".$date."','1','".$waktu."','".$timeinsert."')");
		}
		 
		// Jika sudah ada, update
		else{
		$this->db->query("UPDATE tb_visitor SET hits=hits+1, online='".$waktu."' WHERE ip='".$ip."' AND date='".$date."'");
		}
		 
		
		//Data untuk dashboard
		
        $data['title'] = 'Dashboard';
		$data['jumlahBuku'] = $this->m_model->get('tb_buku','kode_buku')->num_rows();
        $data['jumlahPenelitian'] = $this->m_model->get('tb_penelitian','kode_penelitian')->num_rows();
		$data['jumlahPengguna'] = $this->m_model->get('tb_user','nim_nidn')->num_rows();		
		
        $this->load->view('anggota/templates/header', $data);
        $this->load->view('anggota/templates/sidebar');
        $this->load->view('anggota/dashboard', $data);
        $this->load->view('anggota/templates/footer');
    }
}