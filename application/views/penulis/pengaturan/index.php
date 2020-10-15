<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?= $title; ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Blank Page</li>
            </ol>
          </div>
        </div>
        <div class="row">
          <div class="col-md">
              <div class="row">
                <div class="col-md-6 offset-md-3">
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
                    <li class="nav-item" role="presentation">
                      <a class="nav-link" id="data-diri-tab" data-toggle="tab" href="#data-diri" role="tab" aria-controls="data-diri" aria-selected="false">Data Diri</a>
                    </li>
                  </ul>
                  <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                      <div class="card mb-3" style="max-width: 540px;">
                        <div class="row no-gutters">
                          <div class="col-md-4 text-center ml-1 mt-1">
                              <img src="<?= base_url('assets/theme_admin/img/penulis/') . $profile['foto_penulis']; ?>" class="card-img img-thumbnail" alt="<?= $profile['foto_penulis']; ?>">
                          <h5 class="text-center text-muted"><?= $user['username']; ?></h5>
                          <button type="button" class="btn btn-primary text-center btn-block btn-sm" data-toggle="modal" data-target="#formModalGantiFoto">Ganti Foto</button>
                          </div>
                          <div class="col-md-6 py-5">
                            <div class="card-body">
                              <h5 class="card-title">Penulis : <?= $profile['nama_penulis']; ?></h5>
                              <p class="card-text"><?= $profile['desk_penulis'] ;?></p>
                              <?php $tgl = date_create($profile['tgl_daftar']); ?>
                              <p class="card-text"><small class="text-muted"><?= date_format($tgl, 'd F Y'); ?></small></p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="data-diri" role="tabpanel" aria-labelledby="data-diri-tab">
                      <?= form_open('user/penulis/ubahDataDiriPenulis'); ?>
                      <input type="hidden" name="id_penulis" value="<?= $profile['id_penulis']; ?>">
                      <h4 class="text-muted mt-3">Ubah Data Diri</h4>
                      <div class="form-group">
                        <label for="nama">Nama Penulis</label>
                        <input type="text" name="nama" id="nama" class="form-control" value="<?= $profile['nama_penulis']; ?>">
                        <small class="muted text-danger"><?= form_error('nama'); ?></small>
                      </div>
                      <div class="form-group">
                        <label for="passwordBaru1">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" class="form-control"><?= $profile['desk_penulis']; ?></textarea>
                        <small class="muted text-danger"><?= form_error('passwordBaru1'); ?></small>
                      </div>
                      <div class="form-group">
                        <button type="submit" class="btn btn-primary">Ubah</button>
                      </div>
                      <?= form_close(); ?>
                    </div>
                    <div class="tab-pane fade" id="setting" role="tabpanel" aria-labelledby="setting-tab">
                      <?= form_open('user/penulis/pegaturan'); ?>
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
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>


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
        <?= form_open_multipart('user/penulis/gantiFoto'); ?>
        <div class="form-group">
          <label for="fotoPenulis">Foto</label>
          <input type="file" name="fotoPenulis" class="form-control-file">
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