<div class="container py-5">
	<!-- Slide Berita Populer -->
	<div class="row">
		<div class="col-md">
			<div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
			  <ol class="carousel-indicators">
			    <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
			    <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
			    <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
			  </ol>
			  <div class="carousel-inner">
			  	<?php $no = 0; foreach($populer as $p) : ?>
			  	<?php if($no === 0) : ?>
            <?php $active = 'active'; ?>
            <?php else : ?>
            	<?php $active = ''; ?>
			  	<?php endif; ?>
			  	<?php $no++; ?>
			    <div class="carousel-item <?= $active; ?>">
			      <img src="<?= base_url('assets/theme_admin/img/artikel/') . $p['gambar_artikel']; ?>" class="d-block w-100" alt="<?= $p['gambar_artikel']; ?>">
			      <div class="carousel-caption d-none d-md-block" style="text-shadow: 0px 4px 10px #000; font-weight: bold;">
			        <h5><?= $p['judul']; ?></h5>
			        <p><?= $p['tag']; ?></p>
			      </div>
			    </div>
			    <?php endforeach; ?>
			  </div>
			  <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
			    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
			    <span class="sr-only">Previous</span>
			  </a>
			  <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
			    <span class="carousel-control-next-icon" aria-hidden="true"></span>
			    <span class="sr-only">Next</span>
			  </a>
			</div>
		</div>
	</div>
	<!-- End Slide Berita Populer -->
	<div class="row py-4">
		<div class="col-md-8">
			<div class="card">
				<div class="card-body">
					<h4><i class="fas fa-newspaper"></i> Artikel Terbaru</h4>
					<ul class="list-unstyled">
						<?php foreach($artikel as $a) : ?>
					  <li class="media">
					    <img src="<?= base_url('assets/theme_admin/img/artikel/') . $a['gambar_artikel']; ?>" class="mr-3 img-thumbnail" width="200">
					    <div class="media-body">
					      <h5 class="mt-0 mb-1"><?= $a['judul']; ?></h5>
					      <small>
	                <div class="form-inline">
	                	<div class="form-group">
	                		<i class="fas fa-user pr-1"></i> <?= $a['nama_penulis']; ?>
	                	</div>
	                	<div class="form-group pl-2">
	                		<?php $tgl = date_create($a['tanggal']); ?>
	                		<i class="fas fa-calendar pr-1"></i> <?= date_format($tgl, 'd F Y'); ?>
	                	</div>
	                	<div class="form-group pl-2">
	                		<i class="fas fa-tag pr-1"></i> <?= $a['nama_kategori']; ?>
	                	</div>
	                </div>
					      </small>
					      <?= word_limiter($a['isi_artikel'], 100); ?>
					      <div class="row">
					      	<div class="col-md-2 mt-1">
					      		<a href="<?= base_url('artikel/') . $a['slug']; ?>" class="btn btn-secondary btn-sm">Baca</a>
					      	</div>
					      </div>
					    </div>
					  </li>
					  <?php endforeach; ?>
					</ul>
				</div>
			</div>
		</div>
		<!-- Sidebar Right -->
		<div class="col-md-4">
			<div class="card">
				<div class="card-header">
					<h4>Kategori Teknologi</h4>
				</div>
				<div class="card-body">
					<div class="list-group">
						<?php foreach($artikelKategori as $aKat) : ?>
					  <a href="<?= base_url('artikel/') . $aKat['slug']; ?>" class="list-group-item list-group-item-action">
					    <div class="d-flex w-100 justify-content-between">
					      <h5 class="mb-1"><?= $aKat['judul']; ?></h5>
					      <small>3 days ago</small>
					    </div>
					    <p class="mb-1"><?= word_limiter($aKat['isi_artikel'], 9); ?></p>
					    <small><i class="fas fa-user"></i> <?= $aKat['nama_penulis']; ?> | <i class="fas fa-tag"></i> <?= $aKat['nama_kategori']; ?></small>
					  </a>
				 	  <?php endforeach; ?>
					</div>
				</div>
			</div>

			<!-- Semua Kategori -->
			<div class="card">
				<div class="card-header">
					<h4>Kategori</h4>
				</div>
				<div class="card-body">
					<div class="form-inline">
						<?php foreach($kategori as $k) : ?>
						<?php
            $warna = ['primary', 'success', 'warning', 'dark', 'info', 'light'];
            $acakWarna = $warna[array_rand($warna)];
						?>
						<a href="<?= base_url('kategori/') . strtolower($k['nama_kategori']); ?>">
					  <span class="badge badge-<?= $acakWarna; ?> mr-2"><?= $k['nama_kategori']; ?></span>
					  </a>
					  <?php endforeach; ?>
					</div>
				</div>
			</div>
			<!-- End Semua Kategori -->
		</div>
		<!-- End Sidebar Right -->
	</div>
</div>