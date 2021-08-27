  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Rak Buku
        <small>Alphabetical Filing System</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-book"></i> Buku</a></li>
        <li class="active">Rak Buku</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="row">
        <div class="col-md-8">
          <div class="row">
              <div id="list-buku">
              
                  
            
            <!-- perulangan abjad-->
              <?php
              $char = range('A', 'Z');
              $i=0;
              $warna= array('red','blue','yellow','green');
                foreach ($char as $abjad) {
                
              ?>
              
            <div class="col-lg-4 col-xs-6">
              <div class="small-box bg-<?php echo $warna[$i];?>">
                <div class="inner">
                  <h3 style="text-shadow: 3px 3px 8px black;"><?php echo $abjad; ?></h3>

                    <p style="text-shadow: 3px 3px 8px black;"><b><i>Archive Folder</i></b></p>
                </div>
                <div class="icon">
                  <i class="fa fa-book"></i>
                </div>
               <a href="<?php echo base_url('index.php/anggota/buku/kelola_buku/').$abjad ?>" class="small-box-footer" style="text-shadow: 3px 3px 8px black;">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a> 
                 
              </div>
            </div>
              <?php 
                $i++;
                if($i==4){
                  $i=0;
                }
                  
                } 
              
              
            
                  
            $angka = range(0, 9);
              $i=0;
              $warna= array('red','blue','yellow','green');
                foreach ($angka as $abjad) {
                
              ?>
              
            <div class="col-lg-4 col-xs-6">
              <div class="small-box bg-<?php echo $warna[$i];?>">
                <div class="inner">
                  <h3 style="text-shadow: 3px 3px 8px black;"><?php echo $abjad; ?></h3>

                    <p style="text-shadow: 3px 3px 8px black;"><b><i>Archive Folder</i></b></p>
                </div>
                <div class="icon">
                  <i class="fa fa-book"></i>
                </div>
               <a href="<?php echo base_url('index.php/anggota/buku/kelola_buku/').$abjad ?>" class="small-box-footer" style="text-shadow: 3px 3px 8px black;">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a> 
                 
              </div>
            </div>
              <?php 
                $i++;
                if($i==4){
                  $i=0;
                }
                  
                } 
              
              ?>
  
            
          </div>
              <!-- akhir perulangan-->
        </div>
            </div>
      
        <div class="col-md-4">
            <div class="box box-widget widget-user-2">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header bg-red">
                <div class="widget-user-image">
                  <img class="img-circle" src="<?php echo base_url('assets') ?>/dist/img/avatar4.png" alt="User Avatar">
                </div>
                <!-- /.widget-user-image -->
                <h3 class="widget-user-username"><?php echo $this->session->userdata('nama'); ?></h3>
                <h5 class="widget-user-desc">Terdaftar Pada <?php echo date('d-M-Y H:i:s', strtotime($this->session->userdata('createDate'))); ?></h5>
              </div>
              <div class="box-footer no-padding">
                <ul class="nav nav-stacked">
                  <li><a>Nama Lengkap <span class="pull-right badge bg-red"><?php echo $this->session->userdata('nama'); ?></span></a></li>
                  <li><a>NIM / NIDN <span class="pull-right badge bg-red"><?php echo $this->session->userdata('nim_nidn'); ?></span></a></li>
                  <li><a>Password <span class="pull-right badge bg-red">Disembunyikan</span></a></li>
                  <li><a>Level <span class="pull-right badge bg-red"><?php echo $this->session->userdata('level'); ?></span></a></li>
                  <li><a>Terdaftar Pada <span class="pull-right badge bg-red"><?php echo date('d-M-Y H:i:s', strtotime($this->session->userdata('createDate'))); ?></span></a></li>
                </ul>
              </div>
            </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->