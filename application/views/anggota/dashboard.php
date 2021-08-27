  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Dashboard</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="row">
        <div class="col-md-8">
          <div class="row">
            <div class="col-lg-4 col-xs-6">
              <div class="small-box bg-green">
                <div class="inner">
                  <h3 style="text-shadow: 3px 3px 8px black;"><?php echo $jumlahBuku; ?></h3>
                  <p style="text-shadow: 3px 3px 8px black;"><b>Judul Buku</b></p>
                </div>
                <div class="icon">
                  <i class="fa fa-book"></i>
                </div>
                <a href="<?php echo base_url('index.php/anggota/buku') ?>" class="small-box-footer" style="text-shadow: 3px 3px 8px black;"><b>Selengkapnya</b> <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
			 <div class="col-lg-4 col-xs-6">
              <div class="small-box bg-red">
                <div class="inner">
                  <h3 style="text-shadow: 3px 3px 8px black;"><?php echo $jumlahPenelitian; ?></h3>
                  <p style="text-shadow: 3px 3px 8px black;"><b>Judul KP-TA-Skripsi</b></p>
                </div>
                <div class="icon">
                  <i class="fa fa-graduation-cap"></i>
                </div>
                <a href="<?php echo base_url('index.php/anggota/penelitian') ?>" class="small-box-footer" style="text-shadow: 3px 3px 8px black;"><b>Selengkapnya</b><i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <div class="col-lg-4 col-xs-6">
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3 style="text-shadow: 3px 3px 8px black;"><?php echo $jumlahPengguna; ?></h3>
                  <p style="text-shadow: 3px 3px 8px black;"><b>Total Anggota</b></p>
                </div>
                <div class="icon">
                  <i class="fa fa-group"></i>
                </div>
                <a href="#" class="small-box-footer" style="text-shadow: 3px 3px 8px black;">_</a>
              </div>
            </div>
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