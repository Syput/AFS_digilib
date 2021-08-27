 <div class="modal fade" id="modaltransaksi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><div class="fa fa-plus-square"></div> Transaksi Peminjaman</h4>
                </div>
                <form class="formtransaksi">
                <div class="modal-body">
				<div class="form-group">
                        <label>Kode Transaksi</label>
                        <input type="text" class="form-control" name="kode" value="<?php echo $this->session->userdata('kodes')?>" readonly>
                 </div>
				<div class="form-group">
                        <label>Judul</label>
                        <input type="text" class="form-control" name="judul" value="<?php echo $judul;?>"readonly>
                 </div>
				 <div class="form-group">
                        <label>Penulis</label>
                        <input type="text" class="form-control" name="penulis" value="<?php echo $penulis;?>"readonly>
                 </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Kode</label>
                                <input type="text" class="form-control" name="pustaka" value="<?php echo $kode; ?>" readonly>
								<input type="hidden" class="form-control" name="jenis" value="<?php echo $keterangan;?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Sisa Stok</label>
                                <input type="text" class="form-control" name="stok" value="<?php echo $stok ?>" readonly>
                            </div>
                        </div>
                    </div>
					<div class="form-group">
                        <label>Peminjam</label>
                        <input type="text" class="form-control" name="peminjam" placeholder="Isi NIM / NIDN Peminjam">
                   </div>
                    <div class="form-group">
                        <label>Note</label>
                       <pre> Cek kembali data sebelum melakukan transaksi peminjaman</pre>
                    </div>
                </div>
                <div class="modal-footer">
					<?php 
						if($stok==0){
							echo "<button type='submit' class='btn btn-primary' disabled><div class='fa fa-recycle'></div> Pinjam</button>"; 
							}else{
							echo "<button type='submit' class='btn btn-primary'><div class='fa fa-recycle'></div> Pinjam</button>" ;
							}
					?>
				
			
                </div>
                </form>
            </div>
        </div>
    </div>
	
<script type="text/javascript">
    $(document).ready(function(){ 
       $('.formtransaksi').submit(function(e){
          // e.preventDefault();
           $.ajax({
               
               type :   'POST',
               url  :   '<?php echo base_url()."index.php/pustakawan/penelitian/tambah_transaksi"?>',
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