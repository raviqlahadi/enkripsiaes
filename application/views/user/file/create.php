
<div class="main-panel">
      <!-- Navbar -->
      <?php $this->load->view('template/header') ?>
      <!-- End Navbar -->
      <div class="content">
        <div class="container-fluid">
          <div class="row">
						 <div class="card">
								<div class="card-header card-header-primary">
									<div class="row">
										<div class="col-md-8">
											<h4 class="card-title ">Upload File</h4>
											<p class="card-category">Pilih file dan tekan tombol simpan untuk mengupload file</p>
										</div>
										<div class="col-md-4" style="text-align:right">
											<a href="<?php echo site_url($this->session->user_level.'/file') ?>"><button type="button" class="btn btn-warning float-right" name="button">Kembali</button></a>
										</div>
									</div>

								</div>

              <div class="card-body">
								<?php echo form_open_multipart('user/file/upload')?>
								<div class="form-group">
									<p>Kirim Ke</p>
									<select class="form-control" name="user_id">
										<option value="">Semua User - No Enkripsi</option>
										<?php foreach ($user as $key => $value): ?>
											<option value="<?php echo $value->user_id ?>"><?php echo $value->user_name ?></option>
										<?php endforeach; ?>
									</select>
								</div>
									<div class="form-group">
										<p>Pilih File</p>
										<input type="file" class="form-control" name="userfile" style="opacity:1!important;z-index:10!important;position:relative!important">
									</div>
									<div class="form-group text-center">
										<button type="submit" class="btn btn-primary" name="button">Upload File</button>
									</div>

								<?php echo form_close()?>
              </div>
            </div>

          </div>

        </div>
      </div>
  <?php $this->load->view('template/footer'); ?>
    </div>
