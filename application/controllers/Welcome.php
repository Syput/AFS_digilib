<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{	
		if($this->session->userdata('nim_nidn') != '' ){
			if($this->session->userdata('level') == 'Pustakawan' ){
				redirect('index.php/pustakawan/dashboard');
			} else {
				redirect('index.php/anggota/dashboard');
			}
		} else {
			$this->load->view('login');
		}
	}

	public function login()
	{
		$nim_nidn = $_POST['nim_nidn'];
		$password = $_POST['password'];

		$where = array(
			'nim_nidn' => $nim_nidn,
			'password' => md5($password)
		);

		$cek = $this->m_model->get_where($where, 'tb_user')->num_rows();
		if($cek > 0){
			$data = $this->m_model->get_where($where, 'tb_user')->result();
			foreach ($data as $dt) {
				$datauser = array(
					'nim_nidn' 		=> $dt->nim_nidn,
					'nama' 			=> $dt->nama,
					'password' 		=> $dt->password,
					'level' 		=> $dt->level,
					'status'		=> $dt->status,
					'createDate' 	=> $dt->createDate
				);
			}

			$this->session->set_userdata($datauser);
			if($this->session->userdata('level') == 'Pustakawan'){
				redirect('index.php/pustakawan/dashboard');
			} else {
				redirect('index.php/anggota/dashboard');
			}
		} else {
			$this->session->set_flashdata('pesan', 'NIM / NIDN atau Password anda salah!');
			redirect('index.php/welcome');
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('index.php/welcome');
	}
	
	  public function formregistrasi(){
        if($this->input->is_ajax_request()== true){
            $msg =[
                'sukses' => $this->load->view('formregistrasi','',true)
            ];
            
            echo json_encode($msg);
            
        }
    }
	
	    public function registrasi(){
        
            $nim_nidn    = $this->input->post('nim_nidn',true);
            $nama      	= $this->input->post('nama',true);
            $email    	= $this->input->post('email',true);
            $kontak     = $this->input->post('kontak',true);
            $alamat     = $this->input->post('alamat',true);  
			$pass  		= $this->input->post('pass',true);
			$level   	= "Anggota";
			$status 	= "Belum Aktif";
            $createDate = date('Y-m-d H:i:s');

             $data = array(
                'nim_nidn'     => $nim_nidn,
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
			
			$result['hasil']='ada';
			$result['sudah_ada']=$sudah_ada['nama'];
			
			echo json_encode($result);
		
			}
			else{
			$this->m_model->insert($data, 'tb_user');
			$result['sukses']=$nama;
			echo json_encode($result);
			}
			 
        
        
    }
}
