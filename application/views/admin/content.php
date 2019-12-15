<div class="main-panel">
      <!-- Navbar -->
      <?php $this->load->view('user/header') ?>
      <!-- End Navbar -->
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-warning card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">people</i>
                  </div>
                  <p class="card-category">User</p>
                  <h3 class="card-title"><?php echo $user; ?>

                  </h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <!-- <i class="material-icons text-danger">warning</i>
                    <a href="#pablo">Get More Space...</a> -->
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-success card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">content_copy</i>
                  </div>
                  <p class="card-category">File</p>
                  <h3 class="card-title"><?php echo $file_local ?></h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <!-- <i class="material-icons">date_range</i> Last 24 Hours -->
                  </div>
                </div>
              </div>
            </div>

          </div>

        </div>
      </div>
  <?php $this->load->view('user/footer'); ?>
    </div>
