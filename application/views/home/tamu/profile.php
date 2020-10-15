<div class="container">
	<div class="row">
		<div class="col-md-6 offset-md-3 py-4">
			<?= $this->session->flashdata('pesan'); ?>
			<?php if(validation_errors()) : ?>
			<div class="alert alert-danger mt-2">
               <?= validation_errors(); ?>
            </div>
			<?php endif; ?>
			<ul class="nav nav-tabs" id="myTab" role="tablist">
			  <li class="nav-item" role="presentation">
			    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Profile</a>
			  </li>
			  <li class="nav-item" role="presentation">
			    <a class="nav-link" id="setting-tab" data-toggle="tab" href="#setting" role="tab" aria-controls="setting" aria-selected="false">Setting</a>
			  </li>
			</ul>
			<div class="tab-content" id="myTabContent">
			  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
  				<div class="card mb-3" style="max-width: 540px;">
  				  <div class="row no-gutters">
  				    <div class="col-md-4 text-center ml-1 mt-1">
              <!-- jika yg login tamu -->
              <?php if($this->session->userdata('role') == 3) : ?>
              <?php if($profile['foto_tamu'] == null) : ?>
  				      <?php if($profile['jk_tamu'] == 'L') : ?>
  				      <img src="<?= base_url('assets/img/profile/male.jpg'); ?>" class="card-img" alt="...">
  				      <?php elseif($profile['jk_tamu'] == 'L') : ?>
  	              <img src="<?= base_url('assets/img/profile/female.jpg'); ?>" class="card-img" alt="...">
  				      <?php endif; ?>
                <?php else : ?>
                  <img src="<?= base_url('assets/img/profile/') . $profile['foto_tamu']; ?>" class="card-img img-thumbnail" alt="<?= $profile['foto_tamu']; ?>">
              <?php endif; ?>
              <button type="button" class="btn btn-primary text-center btn-block btn-sm" data-toggle="modal" data-target="#formModalGantiFoto">Ganti Foto</button>
  				    <h5 class="text-center text-muted"><?= $user['username']; ?></h5>
  				    </div>
  				    <div class="col-md-6 py-5">
  				      <div class="card-body">
  				        <h5 class="card-title">Nama Tamu : <?= $profile['nama_tamu']; ?></h5>
  				        <p class="card-text">Jenis Kelamin : <?= $profile['jk_tamu'] == 'L' ? 'Laki-Laki' : 'Perempuan'; ?></p>
  				        <?php $tgl = date_create($profile['tgl_daftar']); ?>
  				        <p class="card-text"><small class="text-muted"><?= date_format($tgl, 'd F Y'); ?></small></p>
  				      </div>
              <?php endif; ?>
              <!-- /jika yg login tamu -->
  				    </div>
  				  </div>
  				</div>
			  </div>
			  <div class="tab-pane fade" id="setting" role="tabpanel" aria-labelledby="setting-tab">
                <?= form_open(''); ?>
                <h4 class="text-muted mt-3">Ubah Password</h4>
                <div class="form-group">
                	<label for="passwordLama">Password Lama</label>
                	<input type="password" name="passwordLama" id="passwordLama" class="form-control">
                	<small class="muted text-danger"><?= form_error('passwordLama'); ?></small>
                </div>
                <div class="form-group">
                	<label for="passwordBaru1">Password Baru</label>
                	<input type="password" name="passwordBaru1" id="passwordBaru1" class="form-control">
                	<small class="muted text-danger"><?= form_error('passwordBaru1'); ?></small>
                </div>
                <div class="form-group">
                	<label for="passwordBaru2">Konfirmasi Password</label>
                	<input type="password" name="passwordBaru2" id="passwordBaru2" class="form-control">
                	<small class="muted text-danger"><?= form_error('passwordBaru2'); ?></small>
                </div>
                <div class="form-group">
                	<button type="submit" class="btn btn-primary">Ubah</button>
                </div>
                <?= form_close(); ?>
			  </div>
			</div>
		</div>
	    
	</div>
  <div class="card">
    <div class="card-body">
      <div class="row">
        <div class="col-md-6">
          <h4><i class="fas fa-thumbs-up"></i> Artikel Yang Disukai</h4>
          <div class="card-body">
            <li class="row">
              <div class="col-md-12">
                <ul class="list-unstyled">
                <?php foreach($sukai as $a) : ?>
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
                        <span class="form-inline">
                          <div class="form-group">
                            <i class="fas fa-eye pr-1"></i> <?= $a['dilihat']; ?>
                          </div>
                        </span>
                      </small>
                    </div>
                  </li>
                <?php endforeach; ?>
                <ul></ul>
              </div>
            </li>
          </div>
        </div>
        <div class="col-md-6">
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet sapiente qui fugiat quaerat inventore minima quae aliquam, error laborum id nemo, iure sunt molestiae ad harum dolor, nam quos asperiores.
        </div>
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="formModalGantiFoto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ganti Foto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?= form_open_multipart('home/gantiFoto'); ?>
        <div class="form-group">
          <label for="fotoTamu">Foto</label>
          <input type="file" name="fotoTamu" class="form-control-file">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Ganti</button>
        </div>
        <?= form_close(); ?>
      </div>
    </div>
  </div>
</div>