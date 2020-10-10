<div class="container">
	<div class="row">
		<?php if($profile['foto_tamu'] == null) : ?>
		<div class="col-md-6">
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
  				    <div class="col-md-4">
  				    <?php
  	                if($profile['jk_tamu'] == 'L') : ?>
  				      <img src="<?= base_url('assets/img/profile/male.jpg'); ?>" class="card-img" alt="...">
  				    <?php elseif($profile['jk_tamu'] == 'L') : ?>
  	                  <img src="<?= base_url('assets/img/profile/female.jpg'); ?>" class="card-img" alt="...">
  				    <?php endif; ?>
  				    <h5 class="text-center text-muted"><?= $user['username']; ?></h5>
  				    </div>
  				    <div class="col-md-8">
  				      <div class="card-body">
  				        <h5 class="card-title"><?= $profile['nama_tamu']; ?></h5>
  				        <p class="card-text"><?= $profile['jk_tamu'] == 'L' ? 'Laki-Laki' : 'Perempuan'; ?></p>
  				        <?php $tgl = date_create($profile['tgl_daftar']); ?>
  				        <p class="card-text"><small class="text-muted"><?= date_format($tgl, 'd F Y'); ?></small></p>
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
	    <?php endif; ?>
	</div>
</div>