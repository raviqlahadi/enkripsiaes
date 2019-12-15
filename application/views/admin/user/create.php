
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
											<h4 class="card-title ">Tambah Data User</h4>
											<p class="card-category">Masukan data user dan tekan tombol simpan untuk mennyimpan data</p>
										</div>
										<div class="col-md-4" style="text-align:right">
											<a href="<?php echo site_url($this->session->user_level.'/user') ?>"><button type="button" class="btn btn-warning float-right" name="button">Kembali</button></a>
										</div>
									</div>

								</div>

              <div class="card-body">
								<?php if(isset($status)):?>
                <div class="alert alert-<?php echo $status['type']?> alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <?php echo $status['message']?>
                </div>
                <?php endif;?>
								<?php echo form_open('admin/user/insert')?>
								<div class="form-group" style="margin-top:50px">
										<label>Nama User</label>
										<input type="text" name="user_name" class="form-control form-control-line" autofocus> </div>
								<div class="form-group">
										<label for="example-email">Email </label>
										<input type="email" id="example-email2" name="user_email" class="form-control" placeholder="contoh  : example@gmail.com"> </div>
								<div class="form-group">
										<label>Password</label>
										<input type="password" name="user_password" class="form-control"  placeholder="Minimal 6 character"> </div>
								<div class="form-group">
										<label>Telepon</label>
										<input type="text" name="user_phone" class="form-control form-control-line" placeholder="contoh +62822xxxx"> </div>
								<div class="form-group">
										<label>Tempat Lahir</label>
										<input type="text" name="user_birthplace" class="form-control form-control-line"> </div>
								<div class="form-group">
										<label>Tanggal Lahir</label>
										<input type="date" name="user_birthdate" class="form-control form-control-line"> </div>

								<div class="form-group">
										<label>Alamat</label>
										<textarea name="user_address"class="form-control" rows="5"></textarea>
								</div>
								<div class="form-group">
									<label>Jenis Kelamin</label>
									<br>
									<input name="user_sex" type="radio" id="radio_7" value="Laki-Laki" class="radio-col-blue" checked="checked">
									<label for="radio_7">Laki-Laki</label>
									<input name="user_sex" type="radio" id="radio_8" value="Perempuan" class="radio-col-pink">
									<label for="radio_8">Perempuan</label>

								</div>
								<div class="form-group">
										<label>User Level</label>
										<select name="user_level" class="form-control">
												<option value="admin">Admin</option>
												<option value="user">User</option>
										</select>
								</div>


								<div class="form-group">
									<button type="submit" class="btn btn-primary" name="button">Simpan</button>
									<button type="reset" class="btn btn-warning" name="button">Reset</button>
								</div>

								<?php echo form_close()?>
              </div>
            </div>

          </div>

        </div>
      </div>
  <?php $this->load->view('template/footer'); ?>
    </div>
