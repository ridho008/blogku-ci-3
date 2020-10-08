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
           <div class="card">
             <div class="card-header text-center">Ubah Artikel</div>
             <div class="card-body">
              <?= form_open_multipart('admin/artikel/ubahArtikel/' . $artikel['id_artikel']); ?>
                <div class="form-group">
                  <label for="judul">Judul Artikel</label>
                  <input type="text" name="judul" id="judul" value="<?= $artikel['judul']; ?>" class="form-control" placeholder="Judul Artikel">
                  <small class="muted text-danger"><?= form_error('judul'); ?></small>
                </div>
                <div class="form-group">
                  <label for="slug">Slug Artikel</label>
                  <input type="text" name="slug" id="slug" value="<?= $artikel['slug']; ?>" class="form-control" placeholder="Slug Artikel">
                  <small class="muted text-danger"><?= form_error('slug'); ?></small>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="kategori">kategori Artikel</label>
                      <select name="kategori" id="kategori" value="<?= set_value('kategori'); ?>" class="form-control">
                        <option value="">-- Pilih Kategori --</option>
                        <?php foreach($kategori as $k) : ?>
                          <?php if($artikel['id_kategori'] == $k['id_kategori']) : ?>
                        <option value="<?= $k['id_kategori']; ?>" selected><?= $k['nama_kategori']; ?></option>
                        <?php else : ?>
                          <option value="<?= $k['id_kategori']; ?>"><?= $k['nama_kategori']; ?></option>
                        <?php endif; ?>
                        <?php endforeach; ?>
                      </select>
                      <small class="muted text-danger"><?= form_error('kategori'); ?></small>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="tag">Tag</label>
                      <input type="text" name="tag" value="<?= $artikel['tag']; ?>" id="tag" class="form-control" placeholder="Tag">
                      <small class="muted text-danger"><?= form_error('tag'); ?></small>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <img src="<?= base_url('assets/theme_admin/img/artikel/') . $artikel['gambar_artikel']; ?>" class="img-thumbnail">
                  </div>
                  <div class="col-md-3 mt-5">
                    <div class="form-group">
                      <label for="foto_artikel">Thumbnail</label><br>
                      <input type="file" name="foto_artikel" id="foto_artikel" class="form-control-file">
                      <input type="hidden" value="<?= $artikel['gambar_artikel']; ?>" name="fotoLamaArtikel" id="fotoLamaArtikel" class="form-control">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <textarea name="isi" value="<?= set_value('isi'); ?>" id="editor1" cols="10" rows="80"><?= $artikel['isi_artikel']; ?></textarea>
                  <small class="muted text-danger"><?= form_error('isi'); ?></small>
                </div>
                <div class="row justify-content-center">
                  <div class="col-md-3">
                    <div class="form-group">
                      <input type="reset" class="btn btn-outline-danger btn-block" value="Reset Artikel">
                    </div>
                  </div>
                    <?php if($artikel['status'] == 0) : ?>
                  <div class="col-md-3">
                    <div class="form-group">
                      <button type="submit" name="1" class="btn btn-outline-primary btn-block">Publish</button>
                    </div>
                  </div>
                    <?php else : ?>
                  <div class="col-md-3">
                    <div class="form-group">
                      <button type="submit" name="0" class="btn btn-outline-secondary btn-block">Draft</button>
                    </div>
                  </div>
                    <?php endif; ?>
                  <div class="col-md-3">
                    <div class="form-group">
                      <button type="submit" class="btn btn-outline-success btn-block">Ubah</button>
                    </div>
                  </div>
                </div>
              <?= form_close(); ?>
             </div>
           </div> 
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
