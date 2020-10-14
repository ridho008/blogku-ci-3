<div class="container py-5">
	<div class="row">
		<div class="col-md-6">
			<h4>Kategori : <?= ucfirst($hasilKategori); ?></h4>
			<?php foreach($kategorilist as $k) : ?>
				<div class="card" style="width: 18rem;">
				  <img src="<?= base_url('assets/theme_admin/img/artikel/') . $k['gambar_artikel']; ?>" class="card-img-top" alt="...">
				  <div class="card-body">
				    <h5 class="card-title"><?= $k['judul']; ?></h5>
			      <small>
          		<i class="fas fa-user"></i> <?= $k['nama_penulis']; ?>
          		<?php $tgl = date_create($k['tanggal']); ?>
          		<i class="fas fa-calendar pr-1"></i> <?= date_format($tgl, 'd F Y'); ?>
          		<i class="fas fa-tag"></i> <?= $k['nama_kategori']; ?>
			      </small>
				    <p class="card-text"><?= word_limiter($k['isi_artikel'], 70) ?></p>
				    <a href="#" class="btn btn-primary">Go somewhere</a>
				  </div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</div>