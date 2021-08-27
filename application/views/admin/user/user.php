  <!-- Content Wrapper. Contains page content -->
<script src="<?php echo base_url('assets') ?>/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="<?php echo base_url('assets/sweetalert') ?>/sweetalert.min.js"></script>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      
              <div class="small-box bg-red">
                <div class="inner">
                    <font size=90 style="text-shadow: 3px 3px 8px black;">'Manajemen User </font>
                  
                </div>
                <div class="icon">
                  <i class="fa fa-users"></i>
                </div>
                  <a href="#" class="small-box-footer"><i>Alphabetical Filing System</i></a>
              </div>
            
      
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Alert -->
        <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('pesan') ?>"></div>

        <!-- Tombol Tambah Data -->
        <div type="button" class="btn btn-danger"  id="tomboltambah" onclick="insert()">
            <div class="fa fa-plus"></div> Tambah Data
        </div>

        <!-- Tombol Cetak Data -->
        <a href="<?php echo base_url('index.php/pustakawan/user/printAnggota') ?>" class="btn btn-primary">
            <div class="fa fa-print"></div> Cetak Data
        </a>

        <!-- Tabel Data -->
        <div class="box box-danger" style="margin-top: 15px">
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped" id="databuku">
                        <thead>
                            <tr>
                                <th width="5px">No</th>
                                <th>Nim / Nidn</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Kontak</th>
                                <th>Alamat</th>
                                <th>Level</th>
                                <th>Status</th>
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
            "url": '<?php echo base_url()."index.php/pustakawan/user/ambilData"?>',
            "type": "POST"
        },
 
 
        "columnDefs": [{
            "targets": [0],
            "orderable": false,
            "width": 5
        }],
 
    });
}
    
//------modal tambah data
function insert(){
        $.ajax({
            url: '<?php echo base_url()."index.php/pustakawan/user/formtambah"?>',
            dataType: 'json',
            success : function(response){
                if(response.sukses){
                    $('.viewmodal').html(response.sukses).show();
                    $('#modaltambah').modal('show');
               
                }
         
            }
                              
            });                                                  
}

//-----modal update data
     function edit(nim_nidn){
          $.ajax({
            type:'POST',
            url: '<?php echo base_url()."index.php/pustakawan/user/formupdate"?>',
            data: {kode_u : nim_nidn},
            dataType: 'json',
            success : function(response){
                if(response.sukses){
                    $('.viewmodal').html(response.sukses).show();
                    $('#modalupdate').modal('show');
               
                }
         
            }
                              
            }); 
     }
//----function delete
    function hapus(nim_nidn){
      swal({
              title: "Anda yakin ingin menghapus data?",
              text: "Data yang sudah dihapus tidak dapat dikembalikan!",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) {
                  $.ajax({
                    type:'POST',
                    url: '<?php echo base_url()."index.php/pustakawan/user/delete_data"?>',
                    data: {kode_u:nim_nidn},
                    dataType:'json',
                    success:function(){
                                swal("Data berhasil dihapus!", {
                                      icon: "success",
                                    });
                        }
                    });
             swal("Data berhasil dihapus!", {icon: "success", });
             tampil();
                
              } else {
                swal("Data batal dihapus!");
              }
		});
    }

//----function aktivasi
	function aktivasi(nim_nidn){
		swal({
              title: "Anda yakin akan aktivasi?",
              text: "Pastikan calon anggota sudah melakukan pembayaran biaya registrasi!",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) {
                  $.ajax({
                    type:'POST',
                    url: '<?php echo base_url()."index.php/pustakawan/user/aktivasi_akun"?>',
                    data: {kode_a:nim_nidn},
                    dataType:'json',
                    success:function(){
                                swal("Akun ini sekarang aktif!", {
                                      icon: "success",
                                    });
                        }
                    });
             swal("Akun ini sekarang aktif!", {icon: "success", });
             tampil();
                
              } else {
                swal("Aktivasi Batal!");
              }
		});
		
	}
        
    
</script>

