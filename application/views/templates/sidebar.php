<!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url() ?>">
        <div class="sidebar-brand-icon ">
          <i class="fas fa-folder-open"></i>
          
        </div>
        <div class="sidebar-brand-text mx-3">Graphich Supplement </div>
      </a>

      <!-- Divider -->
  

      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Dashboard
      </div>
       <li class="nav-item active">
        <a class="nav-link" href="<?= base_url() ?>admin">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>
   
      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Pengajuan
      </div>
       <li class="nav-item active">
        <a class="nav-link" href="<?= base_url() ?>admin/pengajuan">
          <i class="fas fa-fw fa-user-edit"></i>
          <span>Konfirmasi</span></a>
      </li>
      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Produk
      </div>
       <li class="nav-item active">
        <a class="nav-link" href="<?= base_url() ?>admin/produk">
          <i class="fas fa-fw fa-folder"></i>
          <span>Lihat Produk</span></a>
      </li>
      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Transaksi
      </div>
       <li class="nav-item active">
        <a class="nav-link" href="<?= base_url() ?>admin/transaksi">
          <i class="fas fa-fw fa-shopping-basket"></i>
          <span>Lihat Transaksi</span></a>
      </li>


      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Pengguna
      </div>
       <li class="nav-item active">
        <a class="nav-link" href="<?= base_url() ?>admin/akun">
          <i class="fas fa-fw fa-user"></i>
          <span>Akun</span></a>
      </li>


      <!-- logout -->
       <li class="nav-item">
        <a class="nav-link" href="#" id="logout1">
          <i class="fas fa-fw fa-sign-out-alt"></i>
          <span>Logout</span></a>
       </li>
     

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar