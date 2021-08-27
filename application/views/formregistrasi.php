<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

 <div class="modal fade" id="modalregistrasi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
				<h4 class="modal-title" id="myModalLabel"><div class="fa fa-users"></div> Registrasi</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                
                </div>
                <form class="formregistrasi">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
							<div class="form-group">
									<label>NIM</label>
									<input type="text" class="form-control" name="nim_nidn" id="nim_nidn" required>
							 </div>
							 <div class="form-group">
									<label>Nama Lengkap</label>
									<input type="text" class="form-control" name="nama" id="nama" required>
							 </div>
                        </div>					
                        <div class="col-md-6">
						  <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" id="email" required>
                            </div>
                            <div class="form-group">
                                <label>Kontak</label>
                                <input type="text" class="form-control" name="kontak" id="kontak" required>
                            </div>
                        </div>	
                    </div>
					<div class="form-group">
						<label>Alamat</label>
						<textarea type="text" class="form-control" name="alamat" id="alamat" required></textarea>
					</div>
                   <div class="form-group">
                          <label>Pasword</label>
                          <input type="password" class="form-control" name="pass" id="pass" required>
                   </div>
				   <div class="form-group">
						  <label>Konfirmasi Password</label>
                          <input type="password" class="form-control" name="cpass" id="cpass" required>
                   </div>
                    <div class="form-group">
                        <label>Note</label>
						<pre> Pastikan data sudah terisi dengan benar !</pre>
                    </div>
                </div>
                <div class="modal-footer">
					<button type="reset" class="btn btn-danger"><div class="fa fa-trash"></div> Reset</button>
					<button type='button' class='btn btn-primary' onclick="registrasi()"><div class='fa fa-save'></div>Registrasi</button>
                </div>
                </form>
            </div>
        </div>
    </div>
	
	
<script type="text/javascript">
 function registrasi(){
	   var nim_nidn = $('#nim_nidn').val();
	   var nama 	= $('#nama').val();
	   var email 	= $('#email').val();
	   var kontak 	= $('#kontak').val();
	   var alamat 	= $('#alamat').val();
       var pass		= $('#pass').val();
	   var cpass	=$('#cpass').val();
	   
	 
	 if(nim_nidn !='' && nama !='' && email!='' && kontak !='' && alamat !='' && pass !=''){
		  if(pass==cpass){
		  
				   $.ajax({
					   type :   'POST',
					   url  :   '<?php echo base_url()."index.php/welcome/registrasi"?>',
					   data :   {
									
									nim_nidn : nim_nidn,
									nama 	: nama,
									email 	: email,
									kontak 	: kontak,
									alamat 	: alamat,
									pass	: pass
								 },
					  // datatype: "json",
					   success: function(result){
						   var objResult = JSON.parse(result);
						   
						   if(objResult.hasil=='ada'){
							   swal("Registrasi Gagal!", "NIM atau NIDN anda sudah terdaftar sebagai "+objResult.sudah_ada, "error");
						   }else{
							   swal("Registrasi Berhasil!", " Halo " +objResult.sukses + " ! segera lakukan pembayaran, untuk menikmati seluruh layanan perpustakaan ini!", "success");
						   }
					
					   }
						   
					  
				   });
		  }else{	  
			swal("Registrasi Gagal!", "Periksa kembali kecocokan password yang anda isi!", "error");
		  }
	 }else{
		 swal("Peringatan!","Harap isi semua field!", "error");
	 }
          
 }
        
   
</script>