<?php

Class Transaksi extends CI_Controller{
 
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
    
    public function index(){
        $data['title'] = 'Alphabetical Filing System Method';
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar');
        $this->load->view('admin/transaksi/transaksi', $data);
        $this->load->view('admin/templates/footer');
        
    }
    
    public function ambilData(){
     
        if ($this->input->is_ajax_request() == true) {
            $this->load->model('M_digi_t', 'digi');
            $list = $this->digi->get_datatables();
            $data = array();
            $no = $_POST['start'];
            foreach ($list as $field) {
            
			if(!empty($field->denda)){
				$btn_kembali="-";
			}else{
				if($field->jenis == "Buku"){
					$btn_kembali="<button type=\"button\" class=\"btn btn-info\" style=\"margin:1px;\" onclick=\"transaksi_b('".$field->kode_transaksi."','".$field->pustaka."')\"><div class=\"fa fa-recycle\"></div></button>";
				}else{
					$btn_kembali="<button type=\"button\" class=\"btn btn-info\" style=\"margin:1px;\" onclick=\"transaksi('".$field->kode_transaksi."','".$field->pustaka."')\"><div class=\"fa fa-recycle\"></div></button>";	
				}
			}
            //$btn_pr="<button type=\"button\" class=\"btn btn-success\"> <div class=\"fa fa-print\" style=\"margin:1px\"></div> </button>";
                
                      
            if($field->denda == "Tidak"){
                $label="<span class=\"label label-info pull-center\">".$field->denda."</span>";
            }
            else{
                $label="<span class=\"label label-danger pull-center\">".$field->denda."</span>";
                }
				
				$link_A	="<a href=".base_url()."index.php/Pustakawan/user/info/".$field->peminjam.">".$field->peminjam."</a>";
				
				$huruf= substr($field->pustaka,0,3);
				if( $huruf=='RSC'){
					$link_B	="<a href=".base_url()."index.php/Pustakawan/penelitian/info/".$field->pustaka.">".$field->pustaka."</a>";
				}else{
					$link_B	="<a href=".base_url()."index.php/Pustakawan/buku/info/".$field->pustaka.">".$field->pustaka."</a>";	
				}
				
				
                
                $no++;
                $row = array();
               
                $row[] = $no;
                $row[] =$field->kode_transaksi;
                $row[] =$link_A;
                $row[] =$link_B;
                $row[] =$field->jenis;
				$row[] =$field->jumlah;
                $row[] =$field->tgl_pinjam;
                $row[] =$field->tgl_kembali;
                $row[] =$field->jumlah_hari.' Hari';
                $row[] =$label;
                $row[] =$btn_kembali;
                
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
	
	public function transaksi_kembali_b(){
		date_default_timezone_set('Asia/Jakarta');
        $tgl_kembali = date('Y-m-d');
        $kode= $this->input->post('kode_t',true);
		$pustaka= $this->input->post('pustaka',true);
		
        $r=$this->m_model->get_where(array('kode_transaksi' => $kode ),'tb_transaksi')->row_array();
		$tgl_pinjam=$r['tgl_pinjam'];
		
		//menghitung selisih hari
		$tgl1 = new DateTime($tgl_pinjam);
		$tgl2 = new DateTime($tgl_kembali);
		$interval = $tgl1->diff($tgl2);
		$hari = $interval->format('%a');
		//denda
		if($hari > 7){
			$denda= "Ya";
		}else{
			$denda="Tidak";
		}
		
		//$jumlah_hari->days;
		$data= array(
				'tgl_kembali' => $tgl_kembali,
				'jumlah_hari' => $hari,
				'denda'	=> $denda
				);
				
		$r=$this->m_model->get_where(array('kode_buku' => $pustaka ),'tb_buku')->row_array();
		$stok=$r['stok'];
		$s=$stok + 1;
			
		$this->m_model->update(array('kode_buku' =>$pustaka),array('stok' => $s), 'tb_buku');
        $this->m_model->update(array('kode_transaksi' =>$kode),$data, 'tb_transaksi');
       
          
    }
	
	
	public function transaksi_kembali(){
		date_default_timezone_set('Asia/Jakarta');
        $tgl_kembali = date('Y-m-d');
        $kode= $this->input->post('kode_t',true);
		$pustaka= $this->input->post('pustaka',true);
		
        $r=$this->m_model->get_where(array('kode_transaksi' => $kode ),'tb_transaksi')->row_array();
		$tgl_pinjam=$r['tgl_pinjam'];
		
		//menghitung selisih hari
		$tgl1 = new DateTime($tgl_pinjam);
		$tgl2 = new DateTime($tgl_kembali);
		$interval = $tgl1->diff($tgl2);
		$hari = $interval->format('%a');
		//denda
		if($hari > 7){
			$denda= "Ya";
		}else{
			$denda="Tidak";
		}
		
		//$jumlah_hari->days;
		$data= array(
				'tgl_kembali' => $tgl_kembali,
				'jumlah_hari' => $hari,
				'denda'	=> $denda
				);
				
		$r=$this->m_model->get_where(array('kode_penelitian' => $pustaka ),'tb_penelitian')->row_array();
		$stok=$r['stok'];
		$s=$stok + 1;
			
		$this->m_model->update(array('kode_penelitian' =>$pustaka),array('stok' => $s), 'tb_penelitian');
        $this->m_model->update(array('kode_transaksi' =>$kode),$data, 'tb_transaksi');
       
          
    }
	
	  public function formreport(){
        if($this->input->is_ajax_request()== true){
            $msg =[
                'sukses' => $this->load->view('admin/transaksi/formreport','',true)
            ];
            
            echo json_encode($msg);
            
        }
    }
	
		public function report_transaksi(){
			$awal  = date($this->input->post('awal'));
			$akhir = date($this->input->post('akhir'));
			
		    
			$query_str="SELECT * FROM tb_transaksi where tgl_pinjam BETWEEN ? AND ?";
		    $result=$this->db->query($query_str,array($awal,$akhir));
			$data['transaksi'] = $result->result();
			$data['title'] = 'Cetak Transaksi';

		    $this->load->view('admin/transaksi/laporan_All', $data);
			
			
			
		}
	

    
    

}
?>