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
          <a href="<?php echo base_url('index.php/dosen/dashboard') ?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
		   <li class="treeview">
          <a href="<?php echo base_url('index.php/dosen/buku') ?>">
            <i class="fa fa-book"></i> <span>Buku</span>
          </a>
        </li>
           <li class="treeview">
          <a href="<?php echo base_url('index.php/dosen/penelitian') ?>">
            <i class="fa fa-graduation-cap"></i> <span>KP / TA / Skripsi</span>
          </a>
        </li>
		 <li class="treeview">
          <a href="<?php echo base_url('index.php/dosen/transaksi') ?>">
            <i class="fa fa-history"></i> <span>Riwayat Transaksi</span>
          </a>
        </li>
        <li class="treeview">
          <a href="<?php echo base_url('index.php/dosen/buku/pending_buku') ?>">
				<i class="fa fa-warning">&nbsp;</i> Information<span data-toggle="collapse" href="#sub-item-1" class="icon pull-right">
				<span class="pull-right-container">
					<span class="label label-danger pull-right">
						<?php
						 $nim_nidn=$this->session->userdata('nim_nidn');
						  $pending_buku = $this->db->query("SELECT status FROM tb_buku where status='Not Approved' AND ket_input='".$nim_nidn."'")->num_rows();
						  $t_pending= $pending_buku;
						  echo $t_pending . " Pending";
						?>
					</span>
				</span>
		</a>  
        </li>	
        <li class="treeview">
          <a href="<?php echo base_url('index.php/welcome/logout') ?>" class="tombol-yakin" data-isiData="Ingin keluar dari sistem ini!">
            <i class="fa fa-sign-out"></i> <span>Logout</span>
          </a>
        </li>

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
  
