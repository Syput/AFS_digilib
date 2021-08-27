  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Statistik
        <small>Bacaan</small><hr>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-book"></i> Statistik</a></li>
        <li class="active">Statistik Bacaan</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content" style="background:#ffffff;">
    <div class="row">
        <div class="col-md-8">
		<table class="table" style="margin-top: 10px;background:#ffffff;border-radius:20px">
            <thead class="thead-dark">
                <tr>
                    <th width="5px">No</th>
					<!--<th>Pembaca</th>-->
					<th>Pustaka</th>
                    <th>Jumlah</th>                
                </tr>
            </thead>
            <tbody>
                <?php
                    $no = 1;
                    foreach ($pembaca as $b) {
                ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <!--<td><a href='#<?= $b->pembaca; ?>'><?= $b->pembaca; ?></a></td>-->
					<?php
						$huruf= substr($b->pustaka,0,3);
						
						if($huruf=='RSC') { ?>
							<td><a href="<?= base_url().'index.php/pustakawan/penelitian/info/'.$b->pustaka; ?>"><?= $b->pustaka; ?></a></td>
						<?php }else { ?>	
							<td><a href="<?= base_url().'index.php/pustakawan/buku/info/'.$b->pustaka; ?>"><?= $b->pustaka; ?></a></td>
						<?php } ?>
                        
						<td><?php echo "Dibaca sebanyak ".$b->jumlah." kali"; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

		
   
   
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