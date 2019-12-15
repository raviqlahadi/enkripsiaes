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
										<h4 class="card-title ">Tabel User</h4>
										<p class="card-category">Tekan tombol Tambah untuk menambahkan data baru</p>
									</div>
									<div class="col-md-4" style="text-align:right">
										<a href="<?php echo site_url('admin/user/create') ?>"><button type="button" class="btn btn-warning float-right" name="button">Tambah User</button></a>
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
												<th>Nama</th>
												<th>Email</th>
												<th>Alamat</th>
												<th>JK</th>
												<th>Telepon</th>
												<th>Aksi</th>

											</tr>
										</thead>
										<tbody>
											<?php if ($data==null): ?>
												<h1>Data Tidak Di Temukan</h1>
											<?php else: ?>


											<?php foreach ($data as $key => $value): ?>
												<tr>
														<td><?php echo $value->user_name ?></td>
														<td><?php echo $value->user_email ?></td>
														<td><?php echo $value->user_address ?></td>
														<td><?php echo $value->user_sex ?></td>
														<td><?php echo $value->user_phone ?></td>
														<td>
															<a href="<?php echo site_url('admin/user/detail?id='.$value->user_id)?>" class="btn btn-sm btn-secondary"><i class="fa fa-list"></i> </a>
															<a href="<?php echo site_url('admin/user/edit?id='.$value->user_id)?>" class="btn btn-sm btn-secondary"><i class="fa fa-edit"></i> </a>
															<a href="<?php echo site_url('admin/user/delete?id='.$value->user_id)?>" onclick="return confirm('Anda Yakin Akan Menghapus  ini?')" class="btn btn-sm btn-secondary"><i class="fa fa-trash"></i> </a>

														</td>
												</tr>
											<?php endforeach; ?>
											<?php endif; ?>
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
