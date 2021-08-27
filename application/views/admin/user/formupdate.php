
  <div class="modal fade" id="modalupdate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel"><div class="fa fa-edit"></div> Update Data</h4>
        </div>
       
          <form  class="formupdate" >
          <div class="pesan" style="display:none"></div>
          <div class="modal-body">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>Nim / Nidn</label>
						<input type="text" class="form-control" name="nim_nidn" placeholder="Nim / Nidn" value="<?php echo $nim_nidn ;?>" readonly required>
					</div>
					<div class="form-group">
						<label>Nama</label>
						<input type="text" class="form-control" name="nama" placeholder="Nama" value="<?php echo $nama; ?>" required>
					</div>
					<div class="form-group">
						<label>Alamat</label>
						<textarea class="form-control" name="alamat" placeholder="Alamat" required><?php echo $alamat; ?></textarea>
					</div>
					<div class="form-group">
						<label>Email</label>
						<input type="text" class="form-control" name="email" placeholder="Email" value="<?php echo $email; ?>" required>
					</div>				
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Kontak</label>
						<input type="text" class="form-control" name="kontak" placeholder="Kontak" value="<?php echo $kontak; ?>" required>
					</div>	
					<div class="form-group">
					<label>New Password</label>
						<input type="password" class="form-control" name="n_password" placeholder="Kosongkan saja bila tidak akan diubah !">
					</div>
					 <div class="form-group">
						<label>Level</label>
						<select name="level" class="form-control">
							<option value="<?php echo $level;?>"><?php echo $level;?></option>
							<option value="Pustakawan">Pustakawan</option>
							<option value="Anggota">Anggota</option>
						</select>
					</div>
					<div class="form-group">
						<label>Status</label>
						<select name="status" class="form-control">
							<option value="<?php echo $status;?>"><?php echo $status;?></option>
							<option value="Aktif">Aktif</option>
							<option value="Belum">Belum Aktif</option>
						</select>
					</div>
				</div>
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
       $('.formupdate').submit(function(e){
          // e.preventDefault();
           $.ajax({
               
               type :   'POST',
               url  :   '<?php echo base_url()."index.php/pustakawan/user/edit_data"?>',
               data :   new FormData(this),
               processData:false,
		       contentType:false,
		       cache:false,
		       async:false,
               success: function(data){
                 
                console.log(data);
               }
              
           });
          
       });
        
    });
</script>
