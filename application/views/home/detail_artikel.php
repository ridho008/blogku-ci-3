<div class="container py-4">
	<div class="row">
		<div class="col-md-8">
			<div class="card">
				<div class="card-body">
					<img src="<?= base_url('assets/theme_admin/img/artikel/') . $isi['gambar_artikel']; ?>" alt="<?= $isi['gambar_artikel']; ?>" class="img-thumbnail">
					<div class="form-inline mt-1">
						<div class="form-group mr-4">
							<small><i class="fas fa-user"></i> Penulis <?= $isi['nama_penulis']; ?></small>
						</div>
						<div class="form-group mr-4">
							<?php $tgl = date_create($isi['tanggal']); ?>
							<small><i class="fas fa-calendar"></i> Tanggal <?= date_format($tgl, 'd F Y'); ?></small>
						</div>
						<div class="form-group mr-4">
							<small><i class="fas fa-tag"></i> Tags <?= $isi['tag']; ?></small>
						</div>
						<div class="form-group mr-1">
							<small><i class="fas fa-thumbs-up"></i> <?= $isi['suka']; ?></small>
						</div>
						<div class="form-group mr-4">
							<small><i class="fas fa-thumbs-down"></i> <?= $isi['dislike']; ?></small>
						</div>
						<div class="form-group">
							<small><i class="fas fa-eye"></i> <?= $isi['dilihat']; ?></small>
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
						<?php if($this->session->userdata('status') == true) : ?>
							<!-- Like -->
							<input type="text" id="clip" value="<?= base_url(uri_string()); ?>" class="form-control mt-2">
							<small onclick="copyClipboard()" class="text-muted">Copy Clipboard</small>
							<div class="form-inline py-3">
								<?php if($cekLike === 1) : ?>
								<button type="button" disabled class="btn btn-primary mr-1"><i class="fas fa-thumbs-up"></i> Like</button>
								<?php else : ?>
									<a href="<?= base_url('like/') . $isi['id_artikel'] . '/' . strtolower($isi['slug']); ?>" class="btn btn-primary mr-1"><i class="fas fa-thumbs-up"></i> Like</a>
								<?php endif; ?>
								<?php if($dislike > 0) : ?>
								<button type="button" disabled class="btn btn-dark mr-1"><i class="fas fa-thumbs-down"></i> Dislike</button>
								<?php else : ?>
									<a href="<?= base_url('dislike/') . $isi['id_artikel'] . '/' . strtolower($isi['slug']); ?>" class="btn btn-dark mr-1"><i class="fas fa-thumbs-down"></i> Dislike</a>
								<?php endif; ?>
								<button onclick="copyClipboard()" class="btn btn-success"><i class="fas fa-share"></i> Social Media</button>
							</div>
							<!-- End Like -->
							<?php else : ?>
							<div class="form-inline py-5">
								<a href="<?= base_url('auth'); ?>" class="btn btn-primary mr-1"><i class="fas fa-thumbs-up"></i> Like</a>
								<a href="<?= base_url('auth'); ?>" class="btn btn-dark mr-1"><i class="fas fa-thumbs-down"></i> Dislike</a>
								<a href="<?= base_url('auth'); ?>" class="btn btn-success"><i class="fas fa-share"></i> Social Media</a>
							</div>
						<?php endif; ?>
						</div>
					</div>
					<!-- End Profile Penulis -->

					<!-- Kolom Komentar -->
					<?php if($this->session->userdata('status') == true) : ?>
					<?= $this->session->flashdata('komentar'); ?>
					<div class="row">
						<div class="col-md-3">
							<?php 
                            if($this->session->userdata('jk_tamu') == 'L') : // Jika laki
                              $img = base_url('assets/img/profile/male.jpg');
                            elseif ($this->session->userdata('jk_tamu') == 'P'):
                              $img = base_url('assets/img/profile/female.jpg');
                            endif;
							?>
							<img src="<?= $img ?>" width="50%" class="img-thumbnail">
						</div>
						<div class="col-md-8">
							<?= form_open(''); ?>
							<input type="hidden" name="id_artikel" value="<?= $isi['id_artikel']; ?>">
                            <div class="form-group">
                        		<label for="username">Username</label>
                        		<input type="text" name="username" id="username" value="<?= $this->session->userdata('username'); ?>" readonly class="form-control">
                        	</div>
                        	<div class="form-group">
                        		<label for="komentar">Komentar</label>
                        		<textarea name="komentar" id="komentar" class="form-control"></textarea>
                        		<small class="muted text-danger"><?= form_error('komentar'); ?></small>
                        	</div>
                        	<div class="form-check mb-2">
                        	  <input class="form-check-input" type="checkbox" id="defaultCheck1">
                        	  <label class="form-check-label" for="defaultCheck1">
                        	    Saya setuju dengan aturan yang berlaku diblogku.
                        	  </label>
                        	</div>
                        	<div class="form-group">
                        		<button type="submit" class="btn btn-primary">Kirim</button>
                        	</div>
							<?= form_close(); ?>
						</div>
					</div>
					<?php endif; ?>
					<!-- End Kolom Komentar -->

					<!-- Menampilkan Komentar -->
					<div class="row">
						<div class="col-md">
							<?php foreach($komentar as $k) : ?>
							<div class="media table-hover">
								<?php if($k['foto_tamu'] == null) : ?>
								<?php 
								if($k['jk_tamu'] == 'L') : // Jika laki
								  $img = base_url('assets/img/profile/male.jpg');
								elseif ($k['jk_tamu'] == 'P'):
								  $img = base_url('assets/img/profile/female.jpg');
								else :
								  $img = base_url('assets/img/profile/female.jpg');
								endif;
								?>
								<?php else : ?>
									<?php $img = base_url('assets/img/profile/' . $k['foto_tamu']); ?>
								<?php endif; ?>
							    <img src="<?= $img; ?>" class="mr-3" width="90px">
							    <div class="media-body">
							        <h5 class="mt-0"><?= $k['nama_tamu'] ?></h5>
								    <?php $tglKomen = date_create($k['tgl_komen']); ?>
								    <small><?= date_format($tglKomen, 'd F Y'); ?></small><br>
								    <?= $k['isi'] ?>
							    </div>
							</div>
						    <?php endforeach; ?>
						</div>
					</div>
					<!-- /Menampilkan Komentar -->
				</div>
			</div>
		</div>
	</div>
</div>