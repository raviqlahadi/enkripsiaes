<div class="main-panel">
	<!-- Navbar -->
	<?php $this->load->view('template/header') ?>
	<!-- End Navbar -->
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12">
					<div class="col-md-12">
						<div class="card">
							<div class="card-header card-header-primary">
								<div class="row">
									<div class="col-md-8">
										<h4 class="card-title ">Tabel File</h4>
										<p class="card-category">Tekan tombol upload file untuj menambahkan data baru</p>
									</div>
									<div class="col-md-4" style="text-align:right">
										<a href="<?php echo site_url($this->session->user_level.'/file/create') ?>"><button type="button" class="btn btn-warning float-right" name="button">Upload File</button></a>
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
								
								<div class="table-responsive">
									<table class="table">
										<thead class=" text-primary">
											<tr>
												<th style="width:5%">No</th>
												<th>File</th>
												<th>Ext</th>
												<th>Size</th>
												<th>Aksi</th>

											</tr>
										</thead>
										<tbody>
											<?php
															$no = 1;
															foreach ($list_file as $key => $value):
														?>
											<tr>
												<th scope="row">
													<?php echo $no?>
												</th>
												<td style="max-width:300px">
													<h4 class="px-1">
														<?php echo $value->name?>
													</h4>
													<p><strong>Uploader</strong> :
														<?php echo $value->from?> <strong>Untuk</strong> :
														<?php echo $value->for!=null ? $value->for : 'Semua user'?>
													</p>
												</td>
												<td>	<?php echo ($value->ext!='') ? $value->ext: 'chiper file';?></td>
												<td>		<?php echo $value->size?></td>
												<td>
													<a href="<?php echo site_url($this->session->user_level.'/file/decrypt/'.$value->id) ?>">
														<button type="button" class="btn btn-twitter waves-effect waves-light">
															<i class="fa fa-download m-r-5"></i> Download
														</button>
													</a>
													<?php
													$level = $this->session->userdata('user_level');
													if ($value->delete): ?>
														<a href="<?php echo site_url($level.'/file/edit/'.$value->id) ?>">
															<button type="button" class="btn btn-success waves-effect waves-light">
																<i class="fa fa-delete m-r-5"></i> Edit
															</button>
														</a>
													<a href="<?php echo site_url($level.'/file/delete/'.$value->id) ?>">
														<button type="button" class="btn btn-danger waves-effect waves-light">
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

				</div>

			</div>

		</div>
	</div>
	<?php $this->load->view('template/footer'); ?>
</div>


<?php
  function formatBytes($size, $precision = 2)
  {
      $base = log($size, 1024);
      $suffixes = array('', 'K', 'M', 'G', 'T');

      return round(pow(1024, $base - floor($base)), $precision) .' '. $suffixes[floor($base)];
  }
 ?>
