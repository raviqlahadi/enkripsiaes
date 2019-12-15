<?php
	$level = $this->session->userdata('user_level');
	//var_dump($level);
 ?>
<div class="sidebar" data-color="purple" data-background-color="white" data-image="../assets/img/sidebar-1.jpg">
		 <!--
			 Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

			 Tip 2: you can also add an image using data-image tag
	 -->
		 <div class="logo">
			 <a href="#" class="simple-text logo-normal">
				 Enkripsi Sha1 & RSA
			 </a>
		 </div>
		 <div class="sidebar-wrapper">
			 <ul class="nav">
				 <li class="nav-item <?php if($this->uri->segment(2)=='dashboard')echo 'active'?>">
					 <a class="nav-link" href="<?php echo site_url($level.'/dashboard') ?>">
						 <i class="material-icons">dashboard</i>
						 <p>Dashboard</p>
					 </a>
				 </li>
				 <li class="nav-item <?php if($this->uri->segment(2)=='file')echo 'active'?>">
					 <a class="nav-link" href="<?php echo site_url($level.'/file') ?>">
						 <i class="material-icons">content_paste</i>
						 <p>File Management</p>
					 </a>
				 </li>
				 <?php if ($level=='admin'): ?>
					 <li class="nav-item <?php if($this->uri->segment(2)=='user')echo 'active'?>">
						<a class="nav-link" href="<?php echo site_url('admin/user') ?>">
							<i class="material-icons">person</i>
							<p>User</p>
						</a>
					</li>
				 <?php endif; ?>

				 <li class="nav-item <?php if($this->uri->segment(2)=='about')echo 'active'?>">
					 <a class="nav-link" href="<?php echo site_url($level.'/about') ?>">
						 <i class="material-icons">infomation</i>
						 <p>About</p>
					 </a>
				 </li>




			 </ul>
		 </div>
	 </div>
