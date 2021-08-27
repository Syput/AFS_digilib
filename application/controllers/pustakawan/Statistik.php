<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Statistik extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('nim_nidn')){
            redirect('index.php/welcome');
        } else {
            if($this->session->userdata('level') != 'Pustakawan'){
                redirect('index.php/anggota/dashboard');
            }
        }
    }
	
	public function visitor(){
		$date  = date("Y-m-d"); // Mendapatkan tanggal sekarang
		$waktu = time(); //
		$timeinsert = date("Y-m-d H:i:s");
		
		$pengunjunghariini  = $this->db->query("SELECT * FROM tb_visitor WHERE date='".$date."' GROUP BY ip")->num_rows(); // Hitung jumlah pengunjung
		 
		$dbpengunjung = $this->db->query("SELECT COUNT(hits) as hits FROM tb_visitor")->row(); 
		 
		$totalpengunjung = isset($dbpengunjung->hits)?($dbpengunjung->hits):0; // hitung total pengunjung
		 
		$bataswaktu = time() - 300;
		 
		$pengunjungonline  = $this->db->query("SELECT * FROM tb_visitor WHERE online > '".$bataswaktu."'")->num_rows(); // hitung pengunjung online
		  
		$data['title'] = 'Statistik Pengunjung'; 
		$data['pengunjunghariini']=$pengunjunghariini;
		$data['totalpengunjung']=$totalpengunjung;
		$data['pengunjungonline']=$pengunjungonline;
		
		$this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar');
        $this->load->view('admin/statistik_pengunjung', $data);
        $this->load->view('admin/templates/footer');	
	}
	
	public function pembaca(){
		$data['title']='Statistik Pembaca';
		$data['pembaca'] = $this->m_model->getMaxPembaca()->result();
		$this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar');
        $this->load->view('admin/statistik_pembaca', $data);
        $this->load->view('admin/templates/footer');	
		
	}
	
	public function bacaan(){
		$data['title']='Statistik Bacaan';
		$data['pembaca'] = $this->m_model->getMaxBacaan()->result();
		$this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar');
        $this->load->view('admin/statistik_bacaan', $data);
        $this->load->view('admin/templates/footer');	
		
	}
	
	
	
	
}
