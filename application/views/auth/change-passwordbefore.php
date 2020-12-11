<!DOCTYPE html>
<html class="brk-preloader" lang="en" data-brk-skin="brk-blue.css">

<head>
  <!-- <title><?= $title ?></title> -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,height=device-height,initial-scale=1,maximum-scale=1">
  <meta name="format-detection" content="telephone=no">
  <link rel="shortcut icon" href="<?= base_url('assets2/') ?>favicon.ico">
  <link rel="apple-touch-icon-precomposed" href="<?= base_url('assets2/') ?>favicon.ico">
  <meta name="theme-color" content="#2775FF">
  <meta name="keywords" content="themeforest, theme, html, template">
  <meta name="description" content="themeforest, theme, html, template">
  <link rel="stylesheet" id="brk-direction-bootstrap" href="<?= base_url('assets2/') ?>css/assets/bootstrap.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
  <link rel="stylesheet" id="brk-skin-color" href="<?= base_url('assets2/') ?>css/skins/brk-blue.css">
  <link id="brk-base-color" rel="stylesheet" href="<?= base_url('assets2/') ?>css/skins/brk-base-color.css">
  <link rel="stylesheet" id="brk-direction-offsets" href="<?= base_url('assets2/') ?>css/assets/offsets.css">
  <link id="brk-css-min" rel="stylesheet" href="<?= base_url('assets2/') ?>css/assets/styles.min.css">
</head>
<body>
<center>
<div class="main-wrapper" style="margin-left: 50px;">
  <main class="main-container">
    <section class="">
      <div class="container-fluid">
        <div class="col-12 col-lg-7 order-1 order-lg-2">
          <div class="full-screen d-flex align-items-center">
            <div class="container-fluid">
              <div class="row">
                  <div class="col-12 col-md-10">
                    <h1 class="font__family-montserrat font__weight-bold font__size-42 line__height-42 mt-0 mb-45">
                      Change your password for
                    </h1>
                    <h5 class="mb-4"><?=$this->session->userdata('reset_email'); ?></h5>
                    <?= $this->session->flashdata('message'); ?>
                    <form action="<?= base_url('auth/changepassword'); ?>" method="POST" class="brk-form brk-form-strict maxw-570" data-brk-library="component__form">
                      <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                      <input type="password" name="password1"  placeholder="Enter New Password..." >
                        <?= form_error('password1','<small class="text-danger">','</small>') ?>
                      <input type="password" name="password2" placeholder="Repeart Password...">
                       <?= form_error('password2','<small class="text-danger">','</small>') ?>
                    <div class="no-margin pl-10 pr-10 mb-30 mt-40 d-flex flex-wrap justify-content-between align-items-center">
 
                    </div>
                    <div class="d-flex flex-wrap justify-content-center">
                      <button class="btn-backgrounds btn-backgrounds btn-backgrounds_280 btn-backgrounds_white btn-backgrounds_left-icon font__family-montserrat font__weight-bold text-uppercase font__size-13 z-index-2 text-center letter-spacing-20 mt-10" data-brk-library="component__button" type="submit">
                        Change Password 
                        <span class="before">
                          <i class="fas fa-paper-plane"></i>
                        </span>
                      </button> 

                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>    
      </div>
    </section>
  </main>
</div>
</center> 
  <script src="<?= base_url('assets2/') ?>js/scripts.min.js"></script>
</body>

</html>