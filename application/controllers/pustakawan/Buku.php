<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buku extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
		$this->load->model('m_model');
        if(!$this->session->userdata('nim_nidn')){
            redirect('index.php/welcome');
        } else {
            if($this->session->userdata('level') != 'Pustakawan'){
                redirect('index.php/anggota/dashboard');
            }
        }
    }
    
    
    public function index(){	
        $data['title'] = 'Alphabetical Filing System Method';
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar');
        $this->load->view('admin/buku/list_buku', $data);
        $this->load->view('admin/templates/footer');
        
    }
	
     public function kelola_buku()
    {
        $data['title'] = 'Alphabetical Filing System Method';
        $abjad = $this->uri->segment(4);
        $this->session->set_userdata('abjad', $abjad); // membuat session abjad
        //$data['riwayat'] = $this->m_model->get('tb_riwayat')->result();    
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar');
        $this->load->view('admin/buku/buku');
        $this->load->view('admin/templates/footer');
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
				$tombol=$btn_transaksi.' '.$btn_update.' '.$btn_delete;
				//$tombol=$btn_transaksi.' '.$btn_update.' '.$btn_delete.' '.$btn_read.' '.$btn_cite;
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
                $row[] =$tombol;
                
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
    
    public function formtambah(){
        if($this->input->is_ajax_request()== true){
            $msg =[
                'sukses' => $this->load->view('admin/buku/formtambah','',true)
            ];
            
            echo json_encode($msg);
            
        }
    }
	
	public function tambah_data(){
        
            date_default_timezone_set('Asia/Jakarta');
            $kode       = $this->input->post('kode',true);
            $judul      = $this->input->post('judul',true);
            $abjad      = $this->input->post('huruf',true);      
            $penulis    = $this->input->post('penulis',true);
            $penerbit   = $this->input->post('penerbit',true);
            $tahun      = $this->input->post('tahun',true);  
            $stok       = $this->input->post('stok',true);
            $createDate = date('Y-m-d H:i:s');


            $cek_kode= $this->m_model->get_where(array('kode_buku'=>$kode),'tb_buku')->num_rows();
            if($cek_kode > 0){
             echo "<script>alert('Data buku dengan kode tersebut sudah ada !')</script>";   

            }
            else{

                
               $path="./uploads/buku/".$abjad."/";
                //upload file
                    $config['upload_path']          = $path;
                    $config['allowed_types']        = 'pdf';
                    $config['max_size']             = 0;
                    //$config['max_width']            = 1024;
                    //$config['max_height']           = 768;

                    $this->load->library('upload', $config);

                    if ($this->upload->do_upload('userfile'))
                    {
                            $upload_data = $this->upload->data();
                    }
                  
			if(!empty($upload_data['file_name'])){
             $data = array(
                'kode_buku'     => $kode,
                'judul'         => $judul,
                'abjad'         => $abjad,
                'penulis'       => $penulis,
                'penerbit'      => $penerbit,
                'tahun'         => $tahun,
                'createDate'    => $createDate,
                'src'           => $upload_data['file_name'],
                'stok'          => $stok
            );  
			}else{
				 $data = array(
                'kode_buku'     => $kode,
                'judul'         => $judul,
                'abjad'         => $abjad,
                'penulis'       => $penulis,
                'penerbit'      => $penerbit,
                'tahun'         => $tahun,
                'createDate'    => $createDate,
                'src'           => '-',
                'stok'          => $stok
            );  
			}


            $this->m_model->insert($data, 'tb_buku');
            $this->session->set_flashdata('pesan', 'Data berhasil ditambahkan!');
         
        }
        
    }
	
    public function formupdate(){
        if($this->input->is_ajax_request()== true){
             
            $kode = $this->input->post('kode_b',true);
            $ambildata = $this->m_model->get_where(array('kode_buku' => $kode),'tb_buku');
            
          
            $row = $ambildata->row_array();
           
            $data=array(
            "kode" => $row['kode_buku'],    
            "abjad" => $row['abjad'],
            "judul" => $row['judul'],
            "penulis" => $row['penulis'],
            "penerbit" => $row['penerbit'],
            "tahun" => $row['tahun'],
            "stok" => $row['stok'],
            "src" => $row['src'],
            );
            
            
            $msg =[
                'sukses' => $this->load->view('admin/buku/formupdate',$data,true)
            ];
            
            echo json_encode($msg);
            
        }
    }
	
	public function edit_data(){
        date_default_timezone_set('Asia/Jakarta');
        $updateDate = date('Y-m-d H:i:s');
        $kode       = $this->input->post('kode');
        $abjad      = $this->input->post('huruf');
        $judul      = $this->input->post('judul');
        $penulis    = $this->input->post('penulis');
        $penerbit   = $this->input->post('penerbit');
        $tahun      = $this->input->post('tahun');  
        $stok       = $this->input->post('stok');
        $src        = $this->input->post('file_ex');
        $nama='./uploads/buku/'.$abjad."/".$src;
        
        $path="./uploads/buku/".$abjad."/";
                //upload file
                    $config['upload_path']          = $path;
                    $config['allowed_types']        = 'pdf';
                    $config['max_size']             = 0;
                    //$config['max_width']            = 1024;
                    //$config['max_height']           = 768;

                    $this->load->library('upload', $config);

                    if ($this->upload->do_upload('userfile'))
                    {
                            $upload_data = $this->upload->data();
                    }
        
        
		if(!empty($upload_data['file_name']) && $src=='-'){
			$data = array(
            'kode_buku' => $kode,
            'abjad'     => $abjad,
            'judul'     => $judul,
            'penulis'   => $penulis,
            'penerbit'  => $penerbit,
            'tahun'     => $tahun,
            'stok'      => $stok,
            'updateDate' => $updateDate,
            'src'       => $upload_data['file_name']
			);
			
		}
		else if(!empty($upload_data['file_name']) && is_readable($nama) && unlink($nama)){

        $data = array(
            'kode_buku' => $kode,
            'abjad'     => $abjad,
            'judul'     => $judul,
            'penulis'   => $penulis,
            'penerbit'  => $penerbit,
            'tahun'     => $tahun,
            'stok'      => $stok,
            'updateDate' => $updateDate,
            'src'       => $upload_data['file_name']
        );
            }
        
           else{
         $data = array(
            'kode_buku' => $kode,
            'abjad'     => $abjad,
            'judul'     => $judul,
            'penulis'   => $penulis,
            'penerbit'  => $penerbit,
            'tahun'     => $tahun,
            'stok'      => $stok,
            'updateDate' => $updateDate,
            'src'       => $src
        );
           }

        $where = array('kode_buku' => $kode);
        $this->m_model->update($where, $data, 'tb_buku');
        $this->session->set_flashdata('pesan', 'Data berhasil diubah!');
       
    }
    
    public function delete_data(){
        $kode= $this->input->post('kode_b',true);
        $abjad= $this->session->userdata('abjad');
        $r=$this->m_model->get_where(array('kode_buku' => $kode ),'tb_buku')->row_array();
        $nama='./uploads/buku/'.$abjad."/".$r['src'];
       
        
        if(is_readable($nama) && unlink($nama)){
            //hapus
        $this->m_model->delete(array('kode_buku' => $kode ), 'tb_buku');
        
        $this->session->set_flashdata('pesan', 'Data berhasil dihapus!');

        }else{
        echo "gagal".$r['src'];
        $this->m_model->delete(array('kode_buku' => $kode ), 'tb_buku');
        $this->session->set_flashdata('pesan', 'Data berhasil dihapus!');
        }
        
          
    }
	
	public function formtransaksi(){
        if($this->input->is_ajax_request()== true){
             
            $kode = $this->input->post('kode_b',true);
            $ambildata = $this->m_model->get_where(array('kode_buku' => $kode),'tb_buku');
            
          
            $row = $ambildata->row_array();
           
            $data=array(
            "kode" => $row['kode_buku'],    
            "abjad" => $row['abjad'],
            "judul" => $row['judul'],
            "penulis" => $row['penulis'],
            "penerbit" => $row['penerbit'],
            "tahun" => $row['tahun'],
            "stok" => $row['stok'],
            "src" => $row['src'],
            );
            
            
            $msg =[
                'sukses' => $this->load->view('admin/buku/formtransaksi',$data,true)
            ];
            
            echo json_encode($msg);
            
        }
    }
	
	public function tambah_transaksi(){
		  date_default_timezone_set('Asia/Jakarta');
			$kode		   = $this->input->post('kode',true);
            $pustaka       = $this->input->post('pustaka',true);
            $peminjam      = $this->input->post('peminjam',true);
			$jumlah		   = 1;
			$tgl_peminjaman = date('Y-m-d');
			
			$data=array(
			'kode_transaksi'  => $kode,
			'peminjam' 	 => $peminjam,
			'pustaka'	 => $pustaka,
			'jumlah' 	 => $jumlah,
			'jenis'		 => 'Buku',
			'tgl_pinjam' => $tgl_peminjaman
			);
			
			$r=$this->m_model->get_where(array('kode_buku' => $pustaka ),'tb_buku')->row_array();
			$stok=$r['stok'];
			$s=$stok - 1;
			
			$cek_nim_nidn= $this->m_model->get_where(array('nim_nidn' => $peminjam),'tb_user')->num_rows();
			if($cek_nim_nidn == 0){
				$this->session->set_flashdata('pesan', 'Gagal! NIM / NIDN tersebut tidak terdaftar');
				
			}else{
				$this->m_model->update(array('kode_buku' =>$pustaka),array('stok' => $s), 'tb_buku');
				$this->m_model->insert($data, 'tb_transaksi');
				$this->session->set_flashdata('pesan', 'Data berhasil ditambahkan!');
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
	
    public function printKoleksiBuku()
    {
	   $abjad = $this->session->userdata('abjad'); 
	   $where = array('abjad' => $abjad); 
       $data['buku'] = $this->m_model->get_where($where,'tb_buku')->result();
       $data['title'] = 'Cetak Koleksi Buku';

       $this->load->view('admin/buku/laporan_All', $data);
    }
	
		public function info(){
		$nim_nidn=$this->uri->segment(4);
		$data['info']=$this->m_model->get_where(array('kode_buku' => $nim_nidn),'tb_buku')->row_array();
		$data['title'] = 'Informasi';
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar');
        $this->load->view('admin/buku/info', $data);
        $this->load->view('admin/templates/footer');
	}

    
  
 
	

    
    
    
    
}