  <!-- Content Wrapper. Contains page content -->
<script src="<?php echo base_url('assets') ?>/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="<?php echo base_url('assets/sweetalert') ?>/sweetalert.min.js"></script>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      
              <div class="small-box bg-red">
                <div class="inner">
                    <font size=90 style="text-shadow: 3px 3px 8px black;"> ' Status Pending</font>
                  <p style="text-shadow: 3px 3px 8px black;"><i>Archive Folder</i></p>
                </div>
                <div class="icon">
                  <i class="fa fa-folder"></i>
                </div>
                  <a href="#" class="small-box-footer"><i>Alphabetical Filing System</i></a>
              </div>
            
      
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Alert -->
        <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('pesan') ?>"></div>
	
        <!-- Tabel Data -->
        <div class="box box-danger" style="margin-top: 15px">
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped" id="databuku">
                        <thead>
                            <tr>
                                <th width="5px">No</th>
                                <th>Kode Buku</th>
                                <th>Judul</th>
                                <th>Penulis</th>
                                <th>Penerbit</th>
                                <th>Tahun</th>
                                <th>Stok</th>
                               
                                
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
            "url": '<?php echo base_url()."index.php/dosen/buku/tampil_pending"?>',
            "type": "POST"
        },
 
 
        "columnDefs": [{
            "targets": [0],
            "orderable": false,
            "width": 5
        }],
 
    });
}
    
    
</script>

