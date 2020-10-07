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
             <div class="card-header text-center">Tambah Artikel</div>
             <div class="card-body">
              <?= form_open_multipart('admin/artikel/tambahArtikel'); ?>
                <div class="form-group">
                  <label for="judul">Judul Artikel</label>
                  <input type="text" name="judul" id="judul" value="<?= set_value('judul'); ?>" class="form-control" placeholder="Judul Artikel">
                  <small class="muted text-danger"><?= form_error('judul'); ?></small>
                </div>
                <div class="form-group">
                  <label for="slug">Slug Artikel</label>
                  <input type="text" name="slug" id="slug" value="<?= set_value('slug'); ?>" class="form-control" placeholder="Slug Artikel">
                  <small class="muted text-danger"><?= form_error('slug'); ?></small>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="kategori">kategori Artikel</label>
                      <select name="kategori" id="kategori" value="<?= set_value('kategori'); ?>" class="form-control">
                        <option value="">-- Pilih Kategori --</option>
                        <?php foreach($kategori as $k) : ?>
                        <option value="<?= $k['id_kategori']; ?>"><?= $k['nama_kategori']; ?></option>
                        <?php endforeach; ?>
                      </select>
                      <small class="muted text-danger"><?= form_error('kategori'); ?></small>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="tag">Tag</label>
                      <input type="text" name="tag" value="<?= set_value('tag'); ?>" id="tag" class="form-control" placeholder="Tag">
                      <small class="muted text-danger"><?= form_error('tag'); ?></small>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="foto_artikel">Thumbnail</label>
                      <input type="file" name="foto_artikel" id="foto_artikel" class="form-control-file">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <textarea name="isi" value="<?= set_value('isi'); ?>" id="editor1" cols="10" rows="80"></textarea>
                  <small class="muted text-danger"><?= form_error('isi'); ?></small>
                </div>
                <div class="row justify-content-center">
                  <div class="col-md-3">
                    <div class="form-group">
                      <button type="reset" class="btn btn-outline-danger btn-block">Reset Artikel</button>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <button type="submit" name="0" class="btn btn-outline-secondary btn-block">Draft</button>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <button type="submit" name="1" class="btn btn-outline-primary btn-block">Publish</button>
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
