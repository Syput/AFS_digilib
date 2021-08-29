  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url('assets') ?>/image/mardira/logo_mardira.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $this->session->userdata('nama') ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>

        <li class="treeview">
          <a href="<?php echo base_url('index.php/pustakawan/dashboard') ?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
		   <li class="treeview">
          <a href="<?php echo base_url('index.php/pustakawan/buku') ?>">
            <i class="fa fa-book"></i> <span>Buku</span>
          </a>
        </li>
           <li class="treeview">
          <a href="<?php echo base_url('index.php/pustakawan/penelitian') ?>">
            <i class="fa fa-graduation-cap"></i> <span>KP / TA / Skripsi</span>
          </a>
        </li>
		<?php if($this->session->userdata('level')=='Pustakawan') { ?>
        <li class="treeview">
          <a href="<?php echo base_url('index.php/pustakawan/transaksi') ?>">
            <i class="fa fa-recycle"></i> <span>Transaksi</span>
          </a>
        </li>
		<li class="treeview">
          <a href="<?php echo base_url('index.php/pustakawan/buku/pending_buku') ?>">
				<i class="fa fa-warning">&nbsp;</i> Information<span data-toggle="collapse" href="#sub-item-1" class="icon pull-right">
				<span class="pull-right-container">
					<span class="label label-danger pull-right">
						<?php
						  $pending_buku = $this->db->query("SELECT status FROM tb_buku where status='Not Approved' ")->num_rows();
						  $t_pending= $pending_buku;
						  echo $t_pending . " Pending";
						?>
					</span>
				</span>
		</a>  
        </li>

        <li class="treeview">
          <a href="<?php echo base_url('index.php/pustakawan/user') ?>">
            <i class="fa fa-group"></i> <span>Manajemen User</span>
          </a>
        </li>
		<li class="parent ">
			<a data-toggle="collapse" href="#sub-item-1">
				<em class="fa fa-television">&nbsp;</em> Statistik<span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-plus"></em></span>
			</a>
			
			<ul class="children collapse" id="sub-item-1">
				  <li class="treeview">
					  <a href="<?php echo base_url('index.php/pustakawan/statistik/visitor') ?>">
							<i class="fa fa-chart-line"></i> <span>Statistik Pengunjung</span>
					  </a>
				  </li>
				  <li class="treeview">
					  <a href="<?php echo base_url('index.php/pustakawan/statistik/bacaan') ?>">
							<i class="fa fa-chart-line"></i> <span>Statistik Bacaan</span>
					  </a>
				  </li>
				   <li class="treeview">
					  <a href="<?php echo base_url('index.php/pustakawan/statistik/pembaca') ?>">
							<i class="fa fa-chart-line"></i> <span>Statistik Pembaca</span>
					  </a>
				  </li>
				
			</ul>
		</li>
		<?php } ?>
        <li class="treeview">
          <a href="<?php echo base_url('index.php/welcome/logout') ?>" class="tombol-yakin" data-isiData="Ingin keluar dari sistem ini!">
            <i class="fa fa-sign-out"></i> <span>Logout</span>
          </a>
        </li>

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
  
