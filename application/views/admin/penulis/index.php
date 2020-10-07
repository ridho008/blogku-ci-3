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
        			<div class="col-md-6">
        				<button type="button" class="btn btn-primary mb-3 tombolTambahPenulis" data-toggle="modal" data-target="#formModalPenulis">
        				  <i class="fas fa-plus"></i> Tambah Data Penulis
        				</button>
                <?php if(validation_errors()) : ?>
                  <div class="alert alert-danger" role="alert"><i class="fas fa-info"></i> <?= validation_errors(); ?></div>
                <?php endif; ?>
        		    <?= $this->session->flashdata('pesan'); ?>
        			</div>
        		</div>
        		<div class="card">
              <div class="card-header">
                <h3 class="card-title">Semua Penulis</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>                  
                    <tr>
                      <th>No</th>
                      <th>Foto</th>
                      <th>Penulis</th>
                      <th>Deskripsi</th>
                      <th>Tanggal Daftar</th>
                      <th><i class="fas fa-cogs"></i></th>
                    </tr>
                  </thead>
                  <tbody>
                  	<?php $no = 1; foreach($penulis as $p) : ?>
                    <tr>
                    	<td><?= $no++; ?></td>
                    	<td>
                       <img src="<?= base_url('assets/theme_admin/img/penulis/') . $p['foto_penulis']; ?>" width="100"> 
                      </td>
                      <td><?= $p['nama_penulis']; ?></td>
                      <td><?= $p['desk_penulis']; ?></td>
                      <td><?= $p['tgl_daftar']; ?></td>
                    	<td>
                    		<button type="button" class="btn btn-primary tombolUbahPenulis" data-id="<?= $p['id_penulis']; ?>" data-toggle="modal" data-target="#formModalPenulis">
                    		  <i class="fas fa-edit"></i>
                    		</button>
                    		<a href="<?= base_url('admin/penulis/hapus/') . $p['id_penulis']; ?>" onclick="return confirm('Yakin ?')" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                    	</td>
                    </tr>
                  	<?php endforeach; ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
        	</div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>

<!-- Modal -->
<div class="modal fade" id="formModalPenulis" tabindex="-1" aria-labelledby="formModalPenulisLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="formModalPenulisLabel">Tambah Penulis</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="alert alert-warning" role="alert"><i class="fas fa-info-circle"></i> Untuk menambahkan penulis, tambahkan user penulis terlebih dahulu sebelum mengisi <strong>data penulis</strong></div>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item" role="presentation">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Data Penulis</a>
          </li>
          <li class="nav-item" role="presentation">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Tambah Penulis</a>
          </li>
        </ul>
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <?= form_open_multipart('admin/penulis'); ?>
            <input type="hidden" name="id_penulis" id="id_penulis">
            <div class="form-group">
              <label for="user">Penulis</label>
              <select name="user" id="user" class="form-control">
                <option value="">-- Pilih Penulis --</option>
                <?php foreach($users as $u) : ?>
                  <option value="<?= $u['id_user']; ?>"><?= $u['username']; ?></option>
                <?php endforeach; ?>
              </select>
              <small class="muted text-danger"><?= form_error('user'); ?></small>
            </div>
            <div class="form-group">
              <label for="nama">Nama Penulis</label>
              <input type="text" name="nama" id="nama" class="form-control">
              <small class="muted text-danger"><?= form_error('nama'); ?></small>
            </div>
            <div class="form-group">
              <label for="desk_penulis">Deskripsi Singkat</label>
              <textarea name="desk_penulis" id="desk_penulis" class="form-control"></textarea>
              <small class="muted text-danger"><?= form_error('desk_penulis'); ?></small>
            </div>
            <div class="form-group">
              <label for="foto_penulis">Foto</label><br>
              <img src="" id="tampilFotoPenulis" width="100">
              <input type="file" name="foto_penulis" id="foto_penulis" class="form-control-file">
              <input type="hidden" name="fotoPenulisLama" id="fotoPenulisLama" class="form-control-file">
            </div>
            <div class="modal-footer modal-penulis">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
            <?= form_close(); ?>
          </div>
          <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <?= form_open('admin/penulis/tambahPenulis'); ?>
            <div class="form-group">
              <label for="username">Username</label>
              <input type="text" name="username" id="username" class="form-control">
              <small class="muted text-danger"><?= form_error('username'); ?></small>
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" name="password1" id="password1" class="form-control">
              <small class="muted text-danger"><?= form_error('password1'); ?></small>
            </div>
            <div class="form-group">
              <label for="password">Konfirmasi Password</label>
              <input type="password" name="password2" id="password2" class="form-control">
              <small class="muted text-danger"><?= form_error('password2'); ?></small>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
            <?= form_close(); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>