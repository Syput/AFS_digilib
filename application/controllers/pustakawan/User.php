<?php

Class User extends CI_Controller{
 
    public function __construct()
    {
        parent::__construct();
		$this->load->library('pdf');
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
        $this->load->view('admin/user/user', $data);
        $this->load->view('admin/templates/footer');
        
    }
    
    public function ambilData(){
     
        if ($this->input->is_ajax_request() == true) {
            $this->load->model('M_digi_u', 'digi');
            $list = $this->digi->get_datatables();
            $data = array();
            $no = $_POST['start'];
            foreach ($list as $field) {
            
            $btn_aktif="<button type=\"button\" class=\"btn btn-info\" style=\"margin:1px;\" onclick=\"aktivasi('".$field->nim_nidn."')\"><div class=\"fa fa-check\"></div></button>";
                
            $btn_kta="<a href=".base_url('index.php/pustakawan/user/print_kartu/').$field->nim_nidn." type=\"button\" class=\"btn btn-success\"> <div class=\"fa fa-print\" style=\"margin:1px\"></div> </a>";
                
                
            $btn_update="<button type=\"button\" class=\"btn btn-warning\" style=\"margin:1px;\" onclick=\"edit('".$field->nim_nidn."')\"><div class=\"fa fa-edit\"></div></button>";  
                
            $btn_delete="<button type=\"button\" class=\"btn btn-danger\" style=\"margin:1px;\" onclick=\"hapus('".$field->nim_nidn."')\"> <div class=\"fa fa-trash\"></div></button>";
            
            if($field->status == "Aktif"){
                $label="<span class=\"label label-info pull-center\">".$field->status."</span>";
            }
            else{
                $label="<span class=\"label label-danger pull-center\">".$field->status."</span>";
                }
                
                $no++;
                $row = array();
               
                $row[] = $no;
                $row[] =$field->nim_nidn;
                $row[] =$field->nama;
                $row[] =$field->email;
                $row[] =$field->kontak;
                $row[] =$field->alamat;
                $row[] =$field->level;
                $row[] =$label;
                $row[] =$btn_aktif.' '.$btn_kta.' '.$btn_update.' '.$btn_delete;
                
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
                'sukses' => $this->load->view('admin/user/formtambah','',true)
            ];
            
            echo json_encode($msg);
            
        }
    }
    
    public function tambah_data(){
			date_default_timezone_set('Asia/Jakarta');
            $nim_nidn    = $this->input->post('nim_nidn',true);
            $nama      	= $this->input->post('nama',true);
            $email    	= $this->input->post('email',true);
            $kontak     = $this->input->post('kontak',true);
            $alamat     = $this->input->post('alamat',true);  
            $pass  		= $this->input->post('password',true);
			$level   	= $this->input->post('level',true);
			$status 	= "Belum Aktif";
            $createDate = date('Y-m-d H:i:s');

             $data = array(
                'nim_nidn'    => $nim_nidn,
                'nama'        => $nama,
                'email'       => $email,
                'kontak'      => $kontak,
                'alamat'      => $alamat,
				'password'    => md5($pass),
				'level'       => $level,
				'status'      => $status,
                'createDate'  => $createDate       
            );
			$sudah_ada=$this->m_model->get_where(array('nim_nidn' => $nim_nidn),'tb_user')->row_array();
			$cek_nim_nidn= $this->m_model->get_where(array('nim_nidn' => $nim_nidn),'tb_user')->num_rows();
		
		if($cek_nim_nidn > 0){
				$this->session->set_flashdata('pesan', 'Nim / Nidn ini sudah sudah terdaftar sebagai '.$sudah_ada['nama']);
			}else{

				$this->m_model->insert($data, 'tb_user');
				$this->session->set_flashdata('pesan', 'Data berhasil ditambahkan!');
			}
         
        
        
    }
	
	public function formupdate(){
        if($this->input->is_ajax_request()== true){
            $kode = $this->input->post('kode_u',true);
            $ambildata = $this->m_model->get_where(array('nim_nidn' => $kode),'tb_user');
            
            
            $row = $ambildata->row_array();
           
            $data=array(   
            "nim_nidn" => $row['nim_nidn'],
            "nama" => $row['nama'],
            "email" => $row['email'],
            "kontak" => $row['kontak'],
            "alamat" => $row['alamat'],
			"password" => md5($row['password']),
			"level" => $row['level'],
			"status" => $row['status'],
            );
            
            
            $msg =[
                'sukses' => $this->load->view('admin/user/formupdate',$data,true)
            ];
            
            echo json_encode($msg);
            
        }
    }
	
	public function edit_data(){
        date_default_timezone_set('Asia/Jakarta');
        $updateDate = date('Y-m-d H:i:s');
        $nim_nidn  = $this->input->post('nim_nidn');
        $nama       = $this->input->post('nama');
        $email      = $this->input->post('email');
        $kontak     = $this->input->post('kontak');
        $alamat     = $this->input->post('alamat');  
		$pass 		=  $this->input->post('n_password');
		$level		=  $this->input->post('level');
		$status 	=  $this->input->post('status');
		

		if(!empty($pass)){
			$data = array(
				'nim_nidn'  => $nim_nidn,
				'nama'     => $nama,
				'email'    => $email,
				'kontak'   => $kontak,
				'alamat'   => $alamat,
				'password' => md5($pass),
				'level'	   => $level,
				'status'   => $status,
				'updateDate' => $updateDate            
			);
		}else{
			$data = array(
				'nim_nidn'  => $nim_nidn,
				'nama'     => $nama,
				'email'    => $email,
				'kontak'   => $kontak,
				'alamat'   => $alamat,
				'level'	   => $level,
				'status'   => $status,
				'updateDate' => $updateDate            
			);
		}

        $where = array('nim_nidn' => $nim_nidn);
        $this->m_model->update($where, $data, 'tb_user');
        $this->session->set_flashdata('pesan', 'Data berhasil diubah!');
       
    }
	
	public function delete_data(){
        $kode= $this->input->post('kode_u',true);
        $this->m_model->delete(array('nim_nidn' => $kode ), 'tb_user');
        $this->session->set_flashdata('pesan', 'Data berhasil dihapus!');       
    }
	
	 public function aktivasi_akun(){
        $kode= $this->input->post('kode_a',true);
        $status="Aktif";
        $this->m_model->update(array('nim_nidn' =>$kode),array('status' => $status), 'tb_user');
       
          
    }
    
	 public function printAnggota()
    { 
	   $where = array('level' => "Anggota"); 
       $data['anggota'] = $this->m_model->get_where($where,'tb_user')->result();
       $data['title'] = 'Cetak Koleksi Penelitian';
       $this->load->view('admin/user/laporan_All', $data);
    }
			
	function print_kartu(){
        $pdf = new FPDF('l','mm',array(100,60));
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial','B',12);
        // mencetak string
        $pdf->Cell(0,0,'Kartu Anggota Perpustakaan',0,1,'C');
        $pdf->Line(1,13,98,13);
		$pdf->Line(1,13,98,13);
        // Memberikan space kebawah agar tidak terlalu rapat
	   $nim_nidn= $this->uri->segment(4);
	   $where = array('nim_nidn' => $nim_nidn); 
       $AG=$this->m_model->get_where($where,'tb_user')->row_array();   
		
       $image=base_url('assets/image/logo.jpg');
	   $abstrak=base_url('assets/image/abm.jpg');
		
		$pdf->image($abstrak,0,14,-530,'jpg'); 
		$pdf->image($image,0,1.5,-400,'jpg'); 
        
        $pdf->ln(6.5);
        $pdf->SetFont('Arial','B',9);
        $pdf->Cell(1);
        $pdf->Cell(40,5,'NIM',0,0);
		
        $pdf->Cell(0,3,':  '.$AG['nim_nidn'],0,1);
        $pdf->ln(2);
        $pdf->Cell(1);
        $pdf->Cell(40,5,'NAMA LENGKAP',0,0);
        $pdf->Cell(40,5,':  '.$AG['nama'],0,1);
        $pdf->ln(2);
        $pdf->Cell(1);
        $pdf->Cell(40,3,'TANGGAL DIBUAT',0,0);
        $pdf->Cell(0,3,':  '.$AG['createDate'],0,1);
		$pdf->ln(8);
		 $pdf->SetFont('Arial','',8);
        $pdf->Cell(0,0,'Kepala Perpustakaan',0,0,'R');
       $pdf->ln(8);
	    $pdf->Line(92,53,60,53);
		$pdf->Line(1,57,98,57);
        $pdf->Output();
   
    }
	
	public function info(){
		$nim_nidn=$this->uri->segment(4);
		$data['info']=$this->m_model->get_where(array('nim_nidn' => $nim_nidn),'tb_user')->row_array();
		$data['title'] = 'Informasi';
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar');
        $this->load->view('admin/user/info', $data);
        $this->load->view('admin/templates/footer');
	}
    

}
?>