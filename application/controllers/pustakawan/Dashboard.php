<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

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

    public function index()
    {
		
		
        $data['title'] = 'Dashboard';
        $data['jumlahBuku'] = $this->m_model->get('tb_buku','kode_buku')->num_rows();
        $data['jumlahPenelitian'] = $this->m_model->get('tb_penelitian','kode_penelitian')->num_rows();
		$data['jumlahPengguna'] = $this->m_model->get('tb_user','nim_nidn')->num_rows();		
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar');
        $this->load->view('admin/dashboard', $data);
        $this->load->view('admin/templates/footer');
    }
}