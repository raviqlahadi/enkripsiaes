<div class="content-wrapper">
	<div class="container">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				File Managemen
				<small></small>
			</h1>

		</section>

		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-lg-12 col-xs-12">
          <div class="box box-default">
            <div class="box-header with-border">
              <div class="col-md-8">
                <h3 class="box-title">Tambah File</h3>
              </div>
              <div class="col-md-4" style="text-align:right">
                <a href="<?php echo site_url('admin/file') ?>"><button type="button" class="btn btn-warning float-right" name="button">Kembali</button></a>
              </div>
            </div>
            <div class="box-body">
              <div class="row">
                <?php if($status):?>
                <div class="alert alert-<?php echo $status['type']?> alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <?php echo $status['message']?>
                </div>
                <?php endif;?>
              </div>
              <div class="row">
                <div class="col-lg-12">
                  <div class="demo-box">
                    <?php if($status):?>
                    <div class="alert alert-<?php echo $status['type']?> alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <?php echo $status['message']?>
                    </div>
                    <?php endif;?>
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
                        <input type="file" name="userfile" class="filestyle" data-buttonname="btn-secondary">
                      </div>
                      <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary" name="button">Upload File</button>
                      </div>

                    <?php echo form_close()?>
                  </div>
                </div>



              </div> <!-- end row -->
            </div>
            <!-- /.box-body -->
          </div>
				</div>

			</div>
		</section>
		<!-- /.content -->
	</div>
	<!-- /.container -->
</div>
