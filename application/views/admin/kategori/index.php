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
        				<button type="button" class="btn btn-primary mb-3 tombolTambahKategori" data-toggle="modal" data-target="#formModalKategori">
        				  <i class="fas fa-plus"></i> Tambah Data Kategori
        				</button>
        			</div>
        		</div>
        		<?= $this->session->flashdata('pesan'); ?>
        		<div class="card">
              <div class="card-header">
                <h3 class="card-title">Semua Kategori</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>                  
                    <tr>
                      <th>No</th>
                      <th>Kategori</th>
                      <th><i class="fas fa-cogs"></i></th>
                    </tr>
                  </thead>
                  <tbody>
                  	<?php $no = 1; foreach($kategori as $k) : ?>
                    <tr>
                    	<td><?= $no++; ?></td>
                    	<td><?= $k['nama_kategori']; ?></td>
                    	<td>
                    		<button type="button" class="btn btn-primary tombolUbahKategori" data-id="<?= $k['id_kategori']; ?>" data-toggle="modal" data-target="#formModalKategori">
                    		  <i class="fas fa-edit"></i>
                    		</button>
                    		<a href="<?= base_url('admin/kategori/hapus/') . $k['id_kategori']; ?>" onclick="return confirm('Yakin ?')" class="btn btn-danger"><i class="fas fa-trash"></i></a>
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
<div class="modal fade" id="formModalKategori" tabindex="-1" aria-labelledby="formModalKategoriLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="formModalKategoriLabel">Tambah Kategori</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?= form_open('admin/kategori'); ?>
        <input type="hidden" name="id_kategori" id="id_kategori">
        <div class="form-group">
        	<label for="kategori">Nama Kategori</label>
        	<input type="text" name="kategori" id="kategori" class="form-control">
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