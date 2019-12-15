<div class="container-fluid" style="background-color:#0abde3;color:#fff">
  <div class="row no-gutter">
    <div class="col-md-6 col-lg-6 bg-image" style="text-align:center;padding-top:150px">
      <img src="<?php echo base_url('assets/img/login-img.png') ?>" alt="">
    </div>
    <div class="col-md-6 col-lg-6">
      <div class="login d-flex align-items-center py-5">
        <div class="container">
          <div class="row">
            <div class="col-md-9 col-lg-8 mx-auto">
              <?php if (isset($status)): ?>
                <p style="color:#1981FB"><?php echo $status ?></p>
              <?php endif; ?>
              <h3 class="login-heading mb-4">Selamat Datang!</h3>
              <p>Di Sistem Keamanan File Menggunakan RSA</p>
              <form action="<?php echo site_url('auth/cek_user') ?>" method="POST">
                <div class="form-label-group">
                  <input type="email" id="inputEmail" name="user_email" class="form-control" placeholder="Your Email" required autofocus>
                  <label for="inputEmail">Email address</label>
                </div>

                <div class="form-label-group">
                  <input type="password" id="inputPassword" name="user_password" class="form-control" placeholder="Your Password" required>
                  <label for="inputPassword">Password</label>
                </div>
                <button class="btn btn-lg btn-primary btn-block btn-login text-uppercase font-weight-bold mb-2" type="submit">Sign in</button>
                <div class="text-center">
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
