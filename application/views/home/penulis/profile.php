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
              <?php if($profile['foto_penulis'] == null) : ?>
  				      <?php if($profile['jk_tamu'] == 'L') : ?>
  				      <img src="<?= base_url('assets/img/profile/male.jpg'); ?>" class="card-img" alt="...">
  				      <?php elseif($profile['jk_tamu'] == 'L') : ?>
  	              <img src="<?= base_url('assets/img/profile/female.jpg'); ?>" class="card-img" alt="...">
  				      <?php endif; ?>
                <?php else : ?>
                  <img src="<?= base_url('assets/theme_admin/img/penulis/') . $profile['foto_penulis']; ?>" class="card-img img-thumbnail" alt="<?= $profile['foto_penulis']; ?>">
              <?php endif; ?>
  				    <h5 class="text-center text-muted"><?= $user['username']; ?></h5>
              <a href="<?= base_url('user/penulis'); ?>" class="btn btn-primary text-center btn-block btn-sm font-weight-bold">Dashboard</a>
  				    </div>
  				    <div class="col-md-7 py-5">
  				      <div class="card-body">
                  <table class="table">
                    <tr>
                      <th>Penulis</th>
                      <td><h5 class="card-title"><?= $profile['nama_penulis']; ?></h5></td>
                    </tr>
                    <tr>
                      <th>Profesi</th>
                      <td><p class="card-text"><?= $profile['desk_penulis']; ?></p></td>
                    </tr>
                    <tr>
                      <?php $tglDaftar = date_create($profile['tgl_daftar']); ?>
                      <td colspan="2"><p class="text-muted"><?= date_format($tglDaftar, 'd F Y'); ?></p></td>
                    </tr>
                  </table>
  				      </div>
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

