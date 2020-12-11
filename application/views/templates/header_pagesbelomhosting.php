<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet"  href="<?=base_url('assets2/') ?>css/bootstrap.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
  <link rel="stylesheet" href="<?=base_url('assets2/') ?>css/owl.carousel.min.css">
  <link  rel="stylesheet" href="<?=base_url('assets2/') ?>css/gs/style.css"> 
  <link  rel="stylesheet" href="<?=base_url('assets2/') ?>css/style.css"> 
  <title>Graphich Supplement</title>


    <style>


   .pagination a{
    color: white !important;
    background: none !important;
    border: none !important;
    border-radius: 0 !important;

    margin-top: -4px !important;


   }

  .prev {
    background: #FF0000 !important;
    height: 22.44px !important;
    font-size: 12px;
    width: 50.98px;
    color: white;
  }

  .next {
    background: #FF0000 !important;
    height: 22.44px !important;
    font-size: 12px;
    width: 50.98px;
    color: white;
  }




  .pagination .active {
    height: 22.44px !important;
    font-size: 12px;
  width: 22.63px !important;
    color: white !important;
    border: 0px !important;
    background-color:  #A2A0A0 !important;
  }





.isi {
    height: 22.44px !important;
    font-size: 12px;
    width: 22.63px !important;
    color: white !important;
    background-color:  #CCCCCC !important;
    margin-left: 1px !important;
    margin-right: 1px !important;


}

.isi a{

    margin-left: -4px !important; 
}

.pagination .active a {

    margin-left: -4px !important; 

}


.first { display:none; }
.last { display:none; }
</style>
  
</head>
<body class="" >
  <!-- Navbar -->
  <nav class="navbar navbar-expand navbar-top d-none d-sm-block ">
    <?php if ($this->session->userdata('email')): ?>
    <a href="<?= base_url('profile') ?>" class="d-inline-block float-right people" style="color: #FF0000;font-size: 15px;margin-right:96px;"><img class="rounded-circle" src="<?= base_url('').$user['lokasi'].$user['image'] ?>" style="width: 27.76px;height:27.76px"> <?= $user['name'] ?></a>
    <a href="" class="d-inline-block float-right mr-4 cart" style="color: #FF0000;font-size: 15px;"><img src="<?= base_url('assets2/') ?>img/logo/cart.svg" > Cr.<?= $user['saldo'] ?></a>
  <?php endif ?>
  </nav>

  <!-- Navbar top mobile -->
  <?php if ($this->session->userdata('email')): ?>
  <nav class="navbar navbar-expand navbar-top d-block d-sm-none" style="height:37px;">
   
    <div class="row justify-content-center">
      <div class="col-6">
        <a href="<?= base_url('products') ?>" class="d-block text-right people-mobile" style="color: #FF0000;font-size: 15px;"><img  src="<?= base_url('assets2/') ?>img/logo/cart.svg" > Cr.<?= $user['saldo'] ?></a>
      </div>
      <div class="col-6">
        <a href="<?= base_url('profile') ?>" class="d-inline-block ml-2 cart-mobile" style="color: #FF0000;font-size: 15px;"><img class="rounded-circle" src="<?= base_url('').$user['lokasi'].$user['image'] ?>" style="width: 23.68px;height:23.68px"> <?= $user['name'] ?></a>
      </div>
    </div>
    <!-- <a href="" class="d-inline-block float-right" style="color: #FF0000;font-size: 15px;margin-right:200px;"><img src="<?= base_url('assets2/') ?>img/logo/img.svg" > Stephanie</a>
    <a href="" class="d-inline-block float-right mr-4" style="color: #FF0000;font-size: 15px;"><img src="<?= base_url('assets2/') ?>img/logo/cart.svg" > Cr.150</a> -->
    
  </nav>
<?php endif ?>

  <nav class="navbar navbar-expand navbar-dark navbar-down sticky-top">    
  <a href="<?= base_url() ?>"><img src="<?= base_url('assets2/') ?>img/logo/gs-red-mobile.svg" alt="Graphich Supplment" class="d-block mobile d-sm-none"></a>

    <div class="container">
      <a class="navbar-brand" href="<?= base_url() ?>" >
        <?php if (!$this->session->userdata('email')): ?>
        <img src="<?= base_url('assets2/') ?>img/logo/gs-black.svg" alt="Graphich Supplment" class="d-none d-sm-block">
        <?php else: ?>
        <img src="<?= base_url('assets2/') ?>img/logo/gs-red.svg" alt="Graphich Supplment" class="d-none d-sm-block">
        <?php endif ?>
      </a>

      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav text-uppercase">
          <!-- <li class="nav-item active">
            <a class="nav-link" href="#">Home</a>
          </li> -->
          <li class="nav-item  menu ">
            <a class="nav-link" href="<?= base_url() ?>">HOME</a>
          </li>
          <li class="nav-item  menu">
            <a class="nav-link" href="<?= base_url('product/fonts') ?>">FONTS</a>
          </li>
          
          <?php if (count($this->db->get_where('product',['jenis' => 'Graphic'])->result_array()) != 0): ?>
            <li class="nav-item  menu">
              <a class="nav-link" href="<?= base_url('product/graphics') ?>">GRAPHICS</a>
            </li>
          <?php endif ?>
          
          <?php if (count($this->db->get_where('product',['jenis' => 'Photo'])->result_array()) != 0): ?>
            <li class="nav-item  menu photos">
              <a class="nav-link" href="<?= base_url('product/photos') ?>">PHOTOS</a>
            </li>
          <?php endif ?>
        </ul>
        
        <?php if ($this->session->userdata('email')): ?>
        <a id="logout" class="nav-link logout text-white ml-auto" ><span style="color:#FF0000;cursor: pointer;">LOGOUT</span></a>
        <?php else: ?>
        <a  class="nav-link auth text-white ml-auto" style="cursor: pointer;"><span class="registermenu" data-dismiss="modal" data-toggle="modal" data-target="#registerModal">Register |</span> <span data-toggle="modal" data-target="#loginModal">Login</span></a>
        <?php endif ?>
      </div>
    </div>
  </nav>
  <!-- Akhir Navbar -->




