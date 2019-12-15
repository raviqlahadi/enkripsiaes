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
                <h3 class="box-title">Tabel File</h3>
              </div>
              <div class="col-md-4" style="text-align:right">
                <a href="<?php echo site_url('user/file/create') ?>"><button type="button" class="btn btn-primary float-right" name="button">Upload File</button></a>
              </div>
            </div>
            <div class="box-body">

                <?php if($status!=null):?>
									<div class="row">
										<div class="col-md-12">
											<div class="alert alert-<?php echo $status['type']?> alert-dismissible">
												<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
												<h4><i class="icon fa fa-info"></i> Alert!</h4>
												<?php echo $status['message']?>
											</div>
										</div>
									</div>
                <?php endif;?>

              <div class="row">
                <div class="col-md-12">
                  <div class="table-responsive">
                      <table class="table mb-0">
                          <thead>
                              <tr>
                              <th scope="col"style="width:5%">#</th>
                              <th scope="col" style="width:70%">File</th>
                              <th scope="col">Aksi</th>
                              </tr>
                          </thead>
                          <tbody>
                          <?php
                            $no = 1;
                            foreach ($list_file as $key => $value):
                          ?>
                               <tr>
                                <th scope="row"><?php echo $no?></th>
                                <td style="max-width:300px">
                                  <h4 class="px-1"><?php echo $value->name?></h4>
                                  <p><strong>Uploader</strong> : <?php echo $value->from?> <strong>Untuk</strong> : <?php echo $value->for!=null ? $value->for : 'Semua user'?></p>
                                  <p><strong>Tipe File</strong> : <?php echo ($value->ext!='') ? $value->ext: 'chiper file';?></p>
                                  <p><strong>Ukuran</strong> : <?php echo $value->size?></p>
                                </td>
                                <td>
                                  <a href="<?php echo site_url('admin/file/decrypt/'.$value->id) ?>">
                                    <button type="button" class="btn btn-block btn-twitter waves-effect waves-light">
                                      <i class="fa fa-download m-r-5"></i> Download
                                    </button>
                                  </a>
                                  <?php if ($value->delete): ?>
                                    <a href="<?php echo site_url('admin/file/delete/'.$value->id) ?>">
                                      <button type="button" class="btn btn-block btn-danger waves-effect waves-light">
                                        <i class="fa fa-delete m-r-5"></i> Delete
                                      </button>
                                    </a>
                                  <?php endif; ?>
                                </td>
                              </tr>

                          <?php
                            $no++;
                            endforeach;
                          ?>

                          </tbody>
                          </table>
                  </div>
                </div>
              </div>
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


<?php
  function formatBytes($size, $precision = 2)
  {
      $base = log($size, 1024);
      $suffixes = array('', 'K', 'M', 'G', 'T');

      return round(pow(1024, $base - floor($base)), $precision) .' '. $suffixes[floor($base)];
  }
 ?>
