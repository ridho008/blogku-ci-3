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
           <div class="table-responsive">
             <table class="table table-striped">
               <tr>
                 <th>No</th>
                 <th>Judul</th>
                 <th>Komentar</th>
                 <th>User</th>
                 <th>Status</th>
               </tr>
               <tr>
                 <?php $no = 1; foreach($listPenulis as $lp) : ?>
                   <tr>
                     <td><?= $no++; ?></td>
                     <td><a href="<?= base_url('artikel/') . $lp['slug']; ?>" target="_blank"><?= $lp['judul']; ?></a></td>
                     <td><?= $lp['isi']; ?></td>
                     <td><?= $lp['nama_tamu']; ?></td>
                     <td>
                       <?php if($lp['statusKomentar'] == 1) : ?>
                         <span class="badge badge-primary">Tampil</span>
                         <a href="<?= base_url('user/komentar/tampilKomentar/') . $lp['id_komen']; ?>" class="btn btn-success btn-sm">Tarik Komentar</a>
                         <?php else : ?>
                          <span class="badge badge-warning">Tidak Tampil</span>
                          <a href="<?= base_url('user/komentar/hilangKomentar/') . $lp['id_komen']; ?>" class="btn btn-success btn-sm">Tampilkan</a>
                       <?php endif; ?>
                     </td>
                   </tr>
                 <?php endforeach; ?>
               </tr>
             </table>
           </div> 
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>