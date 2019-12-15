<header class="header header-shrink header-inverse fixed-top">
  <div class="container">
  <nav class="navbar navbar-expand-lg">

    <a class="navbar-brand" href="<?php echo base_url()?>">
      <span class="logo-default">
        <img src="<?php echo base_url()?>assets/img/logo_default.png" alt="">
      </span>
      <span class="logo-inverse">
        <img src="<?php echo base_url()?>assets/img/logo_inverse.png" alt="">
      </span>
    </a>

    <button class="navbar-toggler p-0" data-toggle="collapse" data-target="#navbarNav">
      <div class="hamburger hamburger--spin js-hamburger">
            <div class="hamburger-box">
              <div class="hamburger-inner"></div>
            </div>
        </div>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <?php if ($this->session->userdata('user_level')==null): ?>
        <li class="nav-item">
          <a class="nav-link btn btn-md btn-rounded btn-white px-md-5" href="<?php echo site_url('auth/login')?>">Login</a>
        </li>
        <?php else: ?>

        <li class="nav-item">
          <a class="nav-link" href="<?php echo site_url('auth/logout')?>">Keluar</a>
        </li>
        <?php endif; ?>
      </ul>
    </div>

  </nav>
</div> <!-- END container-->
</header>
