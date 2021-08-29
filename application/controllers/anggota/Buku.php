<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buku extends CI_Controller {

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
    
    
     public function index(){	
        $data['title'] = 'Alphabetical Filing System Method';
        $this->load->view('anggota/templates/header', $data);
        $this->load->view('anggota/templates/sidebar');
        $this->load->view('anggota/buku/list_buku', $data);
        $this->load->view('anggota/templates/footer');
        
    }
	
     public function kelola_buku()
    {
        $data['title'] = 'Alphabetical Filing System Method';
        $abjad = $this->uri->segment(4);
        $this->session->set_userdata('abjad', $abjad); // membuat session abjad
        //$data['riwayat'] = $this->m_model->get('tb_riwayat')->result();    
        $this->load->view('anggota/templates/header', $data);
        $this->load->view('anggota/templates/sidebar');
        $this->load->view('anggota/buku/buku');
        $this->load->view('anggota/templates/footer');
    }
    
    public function ambilData(){
		$this->load->model('m_model');
		$dariDB = $this->m_model->CekKodeBuku();
        // contoh JRD0004, angka 3 adalah awal pengambilan angka, dan 4 jumlah angka yang diambil
        $huruf="BK";
		$tgl_db = substr($dariDB, 3, 4);
        $tgl_n	= date("ym");
				
		if($tgl_db == $tgl_n){
			$nourut = substr($dariDB, 10, 4);
			$nourut = $nourut + 1;
			$nourut = sprintf("%04s",$nourut);
			$kodeb  =$huruf."-".$tgl_db."-MI".$nourut;
		}else{
			$nourut = 1;
			$nourut = sprintf("%04s",$nourut);
			$kodeb  = $huruf."-".$tgl_n."-MI".$nourut;
		}
		
		$this->session->set_userdata('kodeb', $kodeb);
		
		
		
		$this->load->model('m_model');
		$dariDB = $this->m_model->CekKodeTransaksi();
        // contoh JRD0004, angka 3 adalah awal pengambilan angka, dan 4 jumlah angka yang diambil
        $huruf="TRS";
		$tgl_db = substr($dariDB, 4, 4);
        $tgl_n	= date("ym");
				
		if($tgl_db == $tgl_n){
			$nourut = substr($dariDB, 11, 4);
			$nourut = $nourut + 1;
			$nourut = sprintf("%04s",$nourut);
			$kodes  =$huruf."-".$tgl_db."-MI".$nourut;
		}else{
			$nourut = 1;
			$nourut = sprintf("%04s",$nourut);
			$kodes  = $huruf."-".$tgl_n."-MI".$nourut;
		}
		
		$this->session->set_userdata('kodes', $kodes);
		
     
        if ($this->input->is_ajax_request() == true) {
            $this->load->model('M_digi_b', 'digi');
            $list = $this->digi->get_datatables();
            $data = array();
            $no = $_POST['start'];
            foreach ($list as $field) {
            
            $btn_read="<button type=\"button\" class=\"btn btn-primary\"  target=\"_blank\" rel=\"nofollow\" style=\"margin:1px;\"> <div class=\"fa fa-book\" onclick=\"read_pustaka('".$field->src."','".$field->kode_buku."')\"></div></button>";
                
            $btn_cite="<button type=\"button\" class=\"btn btn-info\"> <div class=\"fa fa-quote-right\" style=\"margin:1px\"  onclick=\"cite('".$field->kode_buku."')\"></div> </button>";
                
            $btn_transaksi="<button type=\"button\" class=\"btn btn-success\"> <div class=\"fa fa-recycle\" style=\"margin:1px\" onclick=\"transaksi('".$field->kode_buku."')\"></div></button>";
                
            $btn_update="<button type=\"button\" class=\"btn btn-warning\" style=\"margin:1px;\" onclick=\"edit('".$field->kode_buku."')\"> <div class=\"fa fa-edit\"></div></button>";  
                
            $btn_delete="<button type=\"button\" class=\"btn btn-danger\" style=\"margin:1px;\" onclick=\"hapus('".$field->kode_buku."')\"> <div class=\"fa fa-trash\"></div></button>";
            
			if($this->session->userdata('level')=='Pustakawan'){
				//$tombol=$btn_transaksi.' '.$btn_update.' '.$btn_delete;
				$tombol=$btn_transaksi.' '.$btn_update.' '.$btn_delete.' '.$btn_read.' '.$btn_cite;
			}else{
				$tombol=$btn_read.' '.$btn_cite;
			}
			
                $no++;
                $row = array();
               
                $row[] = $no;
                $row[] =$field->kode_buku;
                $row[] =$field->judul;
                $row[] =$field->penulis;
                $row[] =$field->penerbit;
                $row[] =$field->tahun;
                $row[] = "Dirujuk ".$field->sitasi." kali";
                $row[] =$field->stok;
				
				if($this->session->userdata('status') != 'Aktif'){
					$row[] ='-';
				}else{
					$row[]=$tombol;
				}
                
                $data[] = $row;
            }

            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->digi->count_all(),
                "recordsFiltered" => $this->digi->count_filtered(),
                "data" => $data,
            );
            //output dalam format JSON
            echo json_encode($output);
        } else {
            exit('Maaf data tidak bisa ditampilkan');
        }

    
    }
    
	public function baca($judul,$kode){
            
			date_default_timezone_set('Asia/Jakarta');
			$tgl_baca = date('Y-m-d');
			
			$this->load->model('m_model');
			$dariDB = $this->m_model->IdBacaan();
			// contoh JRD0004, angka 3 adalah awal pengambilan angka, dan 4 jumlah angka yang diambil
			$huruf="IDB";
			$tgl_db = substr($dariDB, 4, 4);
			$tgl_n	= date("ym");
					
			if($tgl_db == $tgl_n){
				$nourut = substr($dariDB, 11, 4);
				$nourut = $nourut + 1;
				$nourut = sprintf("%04s",$nourut);
				$idb  =$huruf."-".$tgl_db."-MI".$nourut;
			}else{
				$nourut = 1;
				$nourut = sprintf("%04s",$nourut);
				$idb  = $huruf."-".$tgl_n."-MI".$nourut;
			}
			
			$data=array(
			'id_bacaan' => $idb,
			'pembaca' 	=> $this->session->userdata('nim_nidn'),
			'pustaka' 	=> $kode,
			'tanggal'	=> $tgl_baca
			);
			$this->m_model->insert($data, 'tb_pembaca');
		
		
			$data['judul']=$judul;
			$data['abjad']= $this->session->userdata('abjad');
			$data['pustaka']= "buku";
            $this->load->view('pdf_viewer',$data);
			
    }
	
	 public function tambah_sitasi(){
        $kode= $this->input->post('kode_s',true);
        $abjad= $this->session->userdata('abjad');
        $r=$this->m_model->get_where(array('kode_buku' => $kode ),'tb_buku')->row_array();
        $sitasi=$r['sitasi'];
		$s_tambah=$sitasi + 1;
		
        $this->m_model->update(array('kode_buku' =>$kode),array('sitasi' => $s_tambah), 'tb_buku');      
    }
	
    
    public function info(){
		$nim_nidn=$this->uri->segment(4);
		$data['info']=$this->m_model->get_where(array('kode_buku' => $nim_nidn),'tb_buku')->row_array();
		$data['title'] = 'Informasi';
        $this->load->view('anggota/templates/header', $data);
        $this->load->view('anggota/templates/sidebar');
        $this->load->view('anggota/buku/info', $data);
        $this->load->view('anggota/templates/footer');
	}
  
 
	

    
    
    
    
}