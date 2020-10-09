<div class="container py-4">
	<div class="row">
		<div class="col-md-8">
			<div class="card">
				<div class="card-body">
					<img src="<?= base_url('assets/theme_admin/img/artikel/') . $isi['gambar_artikel']; ?>" alt="<?= $isi['gambar_artikel']; ?>" class="img-thumbnail">
					<div class="form-inline mt-1">
						<div class="form-group mr-2">
							<small><i class="fas fa-user"></i> Penulis <?= $isi['nama_penulis']; ?></small>
						</div>
						<div class="form-group mr-2">
							<?php $tgl = date_create($isi['tanggal']); ?>
							<small><i class="fas fa-calendar"></i> Tanggal <?= date_format($tgl, 'd F Y'); ?></small>
						</div>
						<div class="form-group mr-2">
							<small><i class="fas fa-tag"></i> Tags <?= $isi['tag']; ?></small>
						</div>
						<div class="form-group mr-1">
							<small><i class="fas fa-thumbs-up"></i> <?= $isi['suka']; ?></small>
						</div>
						<div class="form-group">
							<small><i class="fas fa-thumbs-down"></i> <?= $isi['dislike']; ?></small>
						</div>
					</div>
					<h3 class="mt-2"><?= $isi['judul']; ?></h3>
					<!-- Content -->
					<p class="text-justify"><?= $isi['isi_artikel']; ?></p>
					<!-- End Content -->
					<!-- Profile Penulis -->
					<div class="row">
						<div class="col-md-6">
							<div class="card mb-3" style="max-width: 540px;">
							  <div class="row no-gutters">
							    <div class="col-md-4">
							      <img src="<?= base_url('assets/theme_admin/img/penulis/') . $isi['foto_penulis']; ?>" class="card-img" alt="...">
							    </div>
							    <div class="col-md-8">
							      <div class="card-body">
							        <h5 class="card-title"><?= $isi['nama_penulis']; ?></h5>
							        <p class="card-text"><?= $isi['desk_penulis']; ?></p>
							        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
							      </div>
							    </div>
							  </div>
							</div>
						</div>
						<div class="col-md-6">
							<!-- Like -->
							<div class="form-inline py-5">
								<button class="btn btn-primary mr-1"><i class="fas fa-thumbs-up"></i> Like</button>
								<button class="btn btn-dark mr-1"><i class="fas fa-thumbs-down"></i> Dislike</button>
								<button class="btn btn-success"><i class="fas fa-share"></i> Social Media</button>
							</div>
							<!-- End Like -->
						</div>
					</div>
					<!-- End Profile Penulis -->
				</div>
			</div>
		</div>
	</div>
</div>