  <!-- Content Wrapper. Contains page content -->
<script src="<?php echo base_url('assets') ?>/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="<?php echo base_url('assets/sweetalert') ?>/sweetalert.min.js"></script>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      
              <div class="small-box bg-red">
                <div class="inner">
                    <font size=90 style="text-shadow: 3px 3px 8px black;">'<?php echo $this->session->userdata('abjad');?></font>
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

	<?php if($this->session->userdata('level')=='Pustakawan') { ?>
        <!-- Tombol Tambah Data -->
        <div type="button" class="btn btn-danger"  id="tomboltambah" onclick="tambah()">
            <div class="fa fa-plus"></div> Tambah Data
        </div>

        <!-- Tombol Cetak Data -->
        <a href="<?php echo base_url('index.php/pustakawan/penelitian/printKoleksiKPTaSkripsi') ?>" class="btn btn-primary">
            <div class="fa fa-print"></div> Cetak Data
        </a>
		
	<?php } ?>

        <!-- Tabel Data -->
        <div class="box box-danger" style="margin-top: 15px">
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped" id="databuku">
                        <thead>
                            <tr>
                                <th width="5px">No</th>
                                <th>Kode Penelitian</th>
                                <th>Judul</th>
                                <th>Penulis</th>
                                <th>Penerbit</th>
                                <th>Tahun</th>
								<th>Sitasi</th>
								<th>Stok</th>
                                <th>Keterangan</th>
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
            "url": '<?php echo base_url()."index.php/anggota/penelitian/ambilData"?>',
            "type": "POST"
        },
 
 
        "columnDefs": [{
            "targets": [0],
            "orderable": false,
            "width": 5
        }],
 
    });
 }

  function read_pustaka(judul,kode){
       // alert(judul);
        var x = window.open('<?php echo base_url()."index.php/anggota/penelitian/baca/";?>' + judul + '/' + kode,'_blank');
        x.focus();
     
    }	
	
  function cite(kode){
	  swal({
              title: "Anda yakin akan mengutip?",
              text: "Pengutipan bertujuan untuk menghargai sumber karya ilmiah ini",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) {
                  $.ajax({
                    type:'POST',
                    url: '<?php echo base_url()."index.php/anggota/penelitian/tambah_sitasi"?>',
                    data: {kode_s:kode},
                    dataType:'json',
                    success:function(){
                                swal("Anda berhasil menambah kutipan pada karya ilmiah ini!", {
                                      icon: "success",
                                    });
                        }
                    });
             swal("Anda berhasil menambah kutipan pada karya ilmiah ini!", {icon: "success", });
             tampil();
                
              } else {
                swal("Batal mengutip!");
              }
		});
	  
  }
  
    
</script>

