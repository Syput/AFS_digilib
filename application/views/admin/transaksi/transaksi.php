  <!-- Content Wrapper. Contains page content -->
<script src="<?php echo base_url('assets') ?>/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="<?php echo base_url('assets/sweetalert') ?>/sweetalert.min.js"></script>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      
              <div class="small-box bg-red">
                <div class="inner">
                    <font size=90 style="text-shadow: 3px 3px 8px black;">'Transaksi </font>
                  
                </div>
                <div class="icon">
                  <i class="fa fa-recycle"></i>
                </div>
                  <a href="#" class="small-box-footer"><i>Alphabetical Filing System</i></a>
              </div>
            
      
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Alert -->
        <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('pesan') ?>"></div>

        
        <div type="button" class="btn btn-primary"  id="tombolreport" onclick="report()">
            <div class="fa fa-print"> Cetak Data</div> 
        </div>

  
        <!-- Tabel Data -->
        <div class="box box-danger" style="margin-top: 15px">
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped" id="databuku">
                        <thead>
                            <tr>
                                <th width="5px">No</th>
                                <th>Kode</th>
                                <th>Peminjam</th>
                                <th>Pustaka</th>
                                <th>Jenis</th>
                                <th>Jumlah</th>
                                <th>Pinjam</th>
                                <th>Kembali</th>
                                <th>Jumlah Hari</th>
                                <th>Denda</th>
                                <th>Action</th> 
                                
                            </tr>
                        </thead >
                            
                        <tbody id="target_buku">
                          
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
      
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<!-- view modal tambah-->
<div class='viewmodal' style='display:none;'></div>


  

 
<script type="text/javascript">
 $(document).ready(function(){
     
     tampil();
    
 });
    

//----------menampilkan datatable    
function tampil(){
    
     table = $('#databuku').DataTable({
        responsive: true,
        "destroy": true,
        "processing": true,
        "serverSide": true,
        "order": [],
 
        "ajax": {
            "url": '<?php echo base_url()."index.php/pustakawan/transaksi/ambilData"?>',
            "type": "POST"
        },
 
 
        "columnDefs": [{
            "targets": [0],
            "orderable": false,
            "width": 5
        }],
 
    });
}
 

	function transaksi(kode,pustaka){
		swal({
              title: "Anda yakin?",
              text: "Pastikan koleksi perpustakaan yang dikembalikan dalam kondisi baik!",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) {
                  $.ajax({
                    type:'POST',
                    url: '<?php echo base_url()."index.php/pustakawan/transaksi/transaksi_kembali"?>',
                    data: {
							kode_t:kode, 
							pustaka : pustaka
						  },
                    dataType:'json',
                    success:function(){
                                swal("Koleksi perpustakaan dikembalikan!", {
                                      icon: "success",
                                    });
                        }
                    });
             swal("Koleksi perpustakaan dikembalikan!", {icon: "success", });
             tampil();
                
              } else {
                swal("Batal!");
              }
		});
		
	}
	
		function transaksi_b(kode,pustaka){
		swal({
              title: "Anda yakin?",
              text: "Pastikan koleksi perpustakaan yang dikembalikan dalam kondisi baik!",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) {
                  $.ajax({
                    type:'POST',
                    url: '<?php echo base_url()."index.php/pustakawan/transaksi/transaksi_kembali_b"?>',
                    data: {
							kode_t:kode, 
							pustaka : pustaka
						  },
                    dataType:'json',
                    success:function(){
                                swal("Koleksi perpustakaan dikembalikan!", {
                                      icon: "success",
                                    });
                        }
                    });
             swal("Koleksi perpustakaan dikembalikan!", {icon: "success", });
             tampil();
                
              } else {
                swal("Batal!");
              }
		});
		
	}
	
	function report(){
        $.ajax({
            url: '<?php echo base_url()."index.php/pustakawan/transaksi/formreport"?>',
            dataType: 'json',
            success : function(response){
                if(response.sukses){
                    $('.viewmodal').html(response.sukses).show();
                    $('#modalreport').modal('show');
               
                }
         
            }
                              
            });                                                  
}
	
	
        
    
</script>

