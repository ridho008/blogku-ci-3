<div class="container py-4">
	<div class="col-md-6">
		<div class="card">
			<div class="card-body">
				<h4><i class="fas fa-search"></i> Pencarian <strong><?= $this->input->get('keyword'); ?></strong></h4>
				<ul class="list-unstyled">
					<?php foreach($cari as $a) : ?>
				  <li class="media">
				    <img src="<?= base_url('assets/theme_admin/img/artikel/') . $a['gambar_artikel']; ?>" class="mr-3 img-thumbnail" width="200">
				    <div class="media-body">
				      <a href="<?= base_url('artikel/') . strtolower($a['slug']); ?>" class="text-dark"><h5 class="mt-0 mb-1"><?= $a['judul']; ?></h5></a>
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
				      <?= word_limiter($a['isi_artikel'], 14); ?>
				      <div class="row">
				      	<div class="col-md-2 mt-1">
				      		<a href="<?= base_url('artikel/') . strtolower($a['slug']); ?>" class="btn btn-secondary btn-sm">Baca</a>
				      	</div>
				      </div>
				    </div>
				  </li>
				  <?php endforeach; ?>
				</ul>
			</div>
		</div>
	</div>
</div>