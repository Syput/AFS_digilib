<!-- Modal Tambah Data -->

  <div class="modal fade" id="modalreport" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel"><div class="fa fa-print"></div> Report Transaksi</h4>
        </div>
       
          <form  class="formreport" method="POST" action='<?php echo base_url()."index.php/pustakawan/transaksi/report_transaksi"?>'>
          <div class="pesan" style="display:none"></div>
          <div class="modal-body">
			<div class="row"> 	
			<div class="col-md-12">
					<div class="form-group">
						<label>Tanggal Awal</label>
						<input type="date" class="form-control" name="awal" required>
					</div>	
					
					<div class="form-group">
						<label>Tanggal Akhir</label>
						<input type="date" class="form-control" name="akhir" required>
					</div>
				</div>	
			</div>
          </div>
          <div class="modal-footer">
            <button type="reset" class="btn btn-danger"><div class="fa fa-trash"></div> Reset</button>
            <input type="submit" class="btn btn-primary"  value="Print"><div class="fa fa-save"></div>
          </div>
        </form>
      </div>
    </div>
  </div>

<script type="text/javascript">
/*    $(document).ready(function(){
       $('.formreport').submit(function(e){
          // e.preventDefault();
           $.ajax({
               
               type :   'POST',
               url  :   '<?php echo base_url()."index.php/pustakawan/transaksi/report_transaksi"?>',
               data :   new FormData(this),
               processData:false,
		       contentType:false,
		       cache:false,
		       async:false,
                success : function(response){
				if(response.sukses){
						$('.viewmodal').html(response.sukses).show();
						$('#modalupdate').modal('show');
				   
					}
         
            }
              
           });
          
       });
        
    });
	*/
</script>