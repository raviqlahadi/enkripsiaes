<section   class="u-h-100vh u-flex-center" style="background-color: #0F81FD;background-size:cover; background-position: top center;">
  <div class="container">

    <div class="row">
    	<div class="col-lg-8 m-auto text-center">
			 <div class="card box-shadow-v2 bg-white u-of-hidden">
			 	<h2 class="bg-primary m-0 py-3 text-white">REGISTER</h2>
			 		<div class="p-4 p-md-5">
            <?php if (isset($status)): ?>
              <p><?php echo $status ?></p>
            <?php endif; ?>
					<form action="<?php echo site_url('auth/regis_user') ?>" method="POST">
            <div class="row">
              <div class="col-lg-6">
                <div class="input-group u-rounded-50 border u-of-hidden u-mb-20">
    							<div class="input-group-addon bg-white border-0 pl-4 pr-0">
    								<span class="icon icon-User text-primary"></span>
    							</div>
    							<input type="text" name="user_name" class="form-control border-0 p-3" placeholder="Your fullname">
    						</div>

    						<div class="input-group u-rounded-50 border u-of-hidden u-mb-20">
    							<div class="input-group-addon bg-white border-0 pl-4 pr-0">
    								<span class="icon icon-Mail text-primary"></span>
    							</div>
    							<input type="email" name="user_email" class="form-control border-0 p-3" placeholder="Your email">
    						</div>

              </div>
              <div class="col-lg-6">
                <div class="input-group u-rounded-50 border u-of-hidden u-mb-20">
    							<div class="input-group-addon bg-white border-0 pl-4 pr-0">
    								<span class="icon icon-Phone  text-primary"></span>
    							</div>
    							<input type="text" name="user_phone" class="form-control border-0 p-3" placeholder="Telepon">
    						</div>
                <div class="input-group u-rounded-50 border u-of-hidden u-mb-20">
    							<div class="input-group-addon bg-white border-0 pl-4 pr-0">
    								<span class="icon icon-ClosedLock  text-primary"></span>
    							</div>
    							<input type="password" name="user_password" class="form-control border-0 p-3" placeholder="Password">
    						</div>
              </div>
            </div>
            <div class="text-center">
              <label class="custom-control custom-checkbox text-center">
                <input type="checkbox" class="custom-control-input">
                <span class="custom-control-indicator mt-1"></span>
                <span class="custom-control-description">I agree to the <a class="text-primary" href="terms-and-privacy-policy.html" target="_blank">terms</a> and conditions.</span>
              </label>
            </div>
                <button class="btn btn-primary btn-rounded u-mt-20 u-w-170">
  								Register Now
  							</button>

					</form>

					<p>
						Sudah punya akun? <a href="<?php echo site_url('auth/login') ?>" class="text-primary">Login</a>
					</p>
			 		</div> <!-- END p-4 p-md-5-->
			 </div>  <!-- END card-->
     </div> <!-- END col-lg-5-->
    </div> <!-- END row-->
  </div> <!-- END container-->

</section> <!-- END intro-hero-->
