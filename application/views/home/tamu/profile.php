<div class="container">
	<div class="row">
		<?php if($profile['foto_tamu'] == null) : ?>
		<div class="col-md-6">
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
	    <?php endif; ?>
	</div>
</div>