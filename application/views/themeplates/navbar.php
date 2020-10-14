<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <a class="navbar-brand" href="<?= base_url(); ?>">BLOGKU</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
      </ul>
      <form class="form-inline my-2 my-lg-0" method="get" action="<?= base_url('pencarian'); ?>">
        <input class="form-control mr-sm-2" type="text" placeholder="cari artikel" aria-label="Search" name="keyword">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Cari</button>
      </form>
      <!-- TAMU -->
      <?php if($this->session->userdata('role') == 3) : ?>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?php 
          if($this->session->userdata('jk_tamu') == 'L') : // Jika laki
            $img = base_url('assets/img/profile/male.jpg');
          elseif ($this->session->userdata('jk_tamu') == 'P'):
            $img = base_url('assets/img/profile/female.jpg');
          else :
            $img = base_url('assets/img/profile/female.jpg');
          endif;
          if($this->session->userdata('role') == 3) :
            $where = ['id_user' => $this->session->userdata('id_user')];
            $foto = $this->db->get_where('tamu', $where)->row_array();
            $img = base_url('assets/img/profile/' . $foto['foto_tamu']);
          endif;
          ?>
          <img src="<?= $img ?>" width="40" heigth="40">
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="<?= base_url('profil/user/') . $this->session->userdata('username'); ?>">Profil</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="<?= base_url('logout'); ?>">Logout</a>
        </div>
      </li>
      <?php else : ?>
        <?php if(!$this->session->userdata('role') == 1) : ?>
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="<?= base_url('login'); ?>">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= base_url('daftar'); ?>">Daftar</a>
        </li>
      </ul> 
        <?php endif; ?>
      <?php endif; ?>
      <!-- END TAMU -->

      <!-- PENULIS -->
      <?php if($this->session->userdata('role') == 2) : ?>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?php 
          if($this->session->userdata('jk_tamu') == 'L') : // Jika laki
            $img = base_url('assets/img/profile/male.jpg');
          elseif ($this->session->userdata('jk_tamu') == 'P'):
            $img = base_url('assets/img/profile/female.jpg');
          else :
            $img = base_url('assets/img/profile/female.jpg');
          endif;
          ?>
          <img src="<?= $img ?>" width="40" heigth="40">
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="<?= base_url('profil/user/') . $this->session->userdata('username'); ?>">Profil</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="<?= base_url('logout'); ?>">Logout</a>
        </div>
      </li>
      <?php endif; ?>
      <!-- END PENULIS -->

      <!-- ADMIN -->
      <?php if($this->session->userdata('role') == 1) : ?>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?= ucfirst($user['username']); ?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="<?= base_url('admin/dashboard'); ?>">Dashboard</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="<?= base_url('auth/logout'); ?>">Logout</a>
        </div>
      </li>
      <?php endif; ?>
      <!-- END ADMIN -->
    </div>
  </div>
</nav>