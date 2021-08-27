<!-- Modal Tambah Data -->

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
						<label>Kode Buku</label>
						<input type="text" class="form-control" name="kode" placeholder="Kode Buku" value="<?php echo $kode; ?>" readonly>
					</div>
					<div class="form-group">
						<label>Indeks Kata Tangkap</label>
						<input type="text" class="form-control" name="huruf" placeholder="" value="<?php echo $abjad ;?>" required>
					</div>
					<div class="form-group">
						<label>Judul</label>
						<input type="text" class="form-control" name="judul" placeholder="Judul Buku" value="<?php echo $judul; ?>" required>
					</div>
					<div class="form-group">
						<label>File Buku</label>
						<input type="hidden" name="file_ex" value="<?php echo $src; ?>">
						<input type="file" class="form-control" name="userfile">
					</div>	
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Penulis</label>
						<input type="text" class="form-control" name="penulis" placeholder="Penulis" value="<?php echo $penulis; ?>" required>
					</div>
					<div class="form-group">
						<label>Penerbit</label>
						<input type="text" class="form-control" name="penerbit" placeholder="Penerbit" value="<?php echo $penerbit; ?>" required>
					</div>
					<div class="form-group">
						<label>Tahun</label>
						<input type="text" class="form-control" name="tahun" placeholder="Tahun" value="<?php echo $tahun; ?>" required>
					</div>
					<div class="form-group">
						<label>Stok</label>
						<input type="number" class="form-control" name="stok" placeholder="Stok" value="<?php echo $stok; ?>" required>
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
               url  :   '<?php echo base_url()."index.php/pustakawan/buku/edit_data"?>',
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