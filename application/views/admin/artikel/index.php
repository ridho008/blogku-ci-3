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
                <a href="<?= base_url('admin/artikel/tambahArtikel'); ?>" class="btn btn-primary mb-3"><i class="fas fa-plus"></i> Tambah Data Artikel</a>
        			</div>
        		</div>
        		<?= $this->session->flashdata('pesan'); ?>
        		<div class="card">
              <div class="card-header">
                <h3 class="card-title">Semua Artikel</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered datatables">
                  <thead>                  
                    <tr>
                      <th>No</th>
                      <th>Thumb</th>
                      <th>Judul</th>
                      <th>Tanggal</th>
                      <th>Kategori</th>
                      <th>Dilihat</th>
                      <th><i class="fas fa-thumbs-up"></i> <i class="fas fa-thumbs-down"></i></th>
                      <th>Penulis</th>
                      <th>Status</th>
                      <th><i class="fas fa-cogs"></i></th>
                    </tr>
                  </thead>
                  <tbody>
                  	<?php $no = 1; foreach($artikel as $a) : ?>
                    <tr>
                    	<td><?= $no++; ?></td>
                      <td>
                        <img src="<?= base_url('assets/theme_admin/img/artikel/') . $a['gambar_artikel'] ?>" width="100">
                      </td>
                    	<td><?= word_limiter($a['judul'], 5); ?></td>
                      <td><?= date('d-m-Y', strtotime($a['tanggal'])); ?></td>
                      <td><?= $a['nama_kategori']; ?></td>
                      <td><?= $a['dilihat']; ?></td>
                      <td><?= $a['suka'] . ' / ' . $a['dislike']; ?></td>
                      <td><?= $a['nama_penulis']; ?></td>
                      <td>
                        <?php if($a['Status'] == 1) : ?>
                          <span class="badge badge-success">Publish</span>
                          <?php else : ?>
                          <span class="badge badge-secondary">Draft</span>
                        <?php endif; ?>
                      </td>
                    	<td>
                        <?php if($a['Status'] == 0) : ?>
                        <a href="<?= base_url('admin/artikel/publish/') . $a['id_artikel']; ?>" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Publikasikan ?" onclick="return confirm('Publikasikan ?')"><i class="fas fa-paper-plane"></i></a>
                        <?php else : ?>
                        <a href="<?= base_url('admin/artikel/draft/') . $a['id_artikel']; ?>" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Draft ?" onclick="return confirm('Draft ?')"><i class="fab fa-firstdraft"></i></a>
                        <?php endif; ?>
                        <a href="<?= base_url('admin/artikel/ubahArtikel/') . $a['id_artikel']; ?>" class="btn btn-info"><i class="fas fa-edit"></i></a>
                    		<a href="<?= base_url('admin/artikel/hapus/') . $a['id_artikel']; ?>" onclick="return confirm('Yakin ?')" class="btn btn-danger"><i class="fas fa-trash"></i></a>
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