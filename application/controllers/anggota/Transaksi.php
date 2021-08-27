<?php

Class Transaksi extends CI_Controller{
 
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
        $this->load->view('anggota/transaksi/transaksi', $data);
        $this->load->view('anggota/templates/footer');
        
    }
    
    public function ambilData(){
     
        if ($this->input->is_ajax_request() == true) {
            $this->load->model('M_digi_t', 'digi');
            $list = $this->digi->get_datatables();
            $data = array();
            $no = $_POST['start'];
            foreach ($list as $field) {
            
			if(!empty($field->denda)){
				$btn_kembali="<button type=\"button\" class=\"btn btn-info\" style=\"margin:1px;\" onclick=\"transaksi('".$field->kode_transaksi."','".$field->pustaka."')\" disabled><div class=\"fa fa-recycle\"></div></button>";
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
				
				if($this->session->userdata('level')!='Pustakawan') {
						$row[] ="-";
					}else{
						$row[] =$btn_kembali;
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

}
?>