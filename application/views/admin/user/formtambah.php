<!-- Modal Tambah Data -->

  <div class="modal fade" id="modaltambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel"><div class="fa fa-plus"></div> Tambah Data</h4>
        </div>
       
          <form  class="formtambah" >
          <div class="pesan" style="display:none"></div>
          <div class="modal-body">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>Nim / Nidn</label>
						<input type="text" class="form-control" name="nim_nidn" placeholder="Nim / Nidn" required>
					</div>
					<div class="form-group">
						<label>Nama</label>
						<input type="text" class="form-control" name="nama" placeholder="Nama" required>
					</div>
					 <div class="form-group">
						<label>Alamat</label>
						  <textarea class="form-control" name="alamat" placeholder="alamat" required></textarea>
					</div>		
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>e-mail</label>
						<input type="text" class="form-control" name="email" placeholder="E-mail" required>
					</div>
					<div class="form-group">
						<label>Kontak</label>
						<input type="text" class="form-control" name="kontak" placeholder="Kontak" required>
					</div>
					<div class="form-group">
						<label>Password</label>
						<input type="password" class="form-control" name="password" placeholder="Password" required>
					</div>				
				</div>
			</div>       
            <div class="form-group">
                <label>Level</label>
                <select class="form-control" name="level">
                    <option value="Pustakawan">Pustakawan</option>
                    <option value="Anggota">Anggota</option>
                </select>
            </div>              
          </div>
          <div class="modal-footer">
            <button type="reset" class="btn btn-danger"><div class="fa fa-trash"></div> Reset</button>
            <button type="submit" class="btn btn-primary"><div class="fa fa-save"></div> Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>

<script type="text/javascript">
    $(document).ready(function(){
       $('.formtambah').submit(function(e){
          // e.preventDefault();
           $.ajax({
               
               type :   'POST',
               url  :   '<?php echo base_url()."index.php/pustakawan/user/tambah_data"?>',
               data :   new FormData(this),
               processData:false,
		       contentType:false,
		       cache:false,
		       async:false,
               success: function(data){
                 
                console.log(data);
               },
			   error: function(data){
				    swal("Gagal menambah data!","Data dengan NIM / NIDN tersebut sudah ada", "error");
			   }
			   
              
           });
          
       });
        
    });
</script>