<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet"  href="<?=base_url('assets2/') ?>css/bootstrap.min.css">
  <link  rel="stylesheet" href="<?=base_url('assets2/') ?>css/style.css">
  <title><?= $title ?></title>
</head>
<body >



<div class="container">

  <div class="row  h-100 justify-content-center" style="height: 100vh !important;display: flex;" >


              <div class="my-auto">

                      <div class="row " style="background: transparent;">
                      <div class="col-12">
                        <div class="row" id="loginbuat" style="background-color: #F4F4F4;">
                        <div class="col-md-6 bglogin"  style="background-image: url('<?= base_url('assets2/img/bg auth/bg.svg'); ?>');"></div>
                        <div class="col-md-6 my-auto" style="background-color: #F4F4F4"  >
                          <!-- <button   class="close exit-btn text-danger" data-toggle="modal"   data-dismiss="modal">&times;</button> -->
                          <p class="text-center mt-5" style="font-size: 20px;">Reset Password</p>
                            <!-- <div class="alert text-center" role="alert" id="notification"></div> -->
                                <form action="<?= base_url('auth/changePassword') ?>" method="POST" >
                                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                                  <div class="form-group col-md-11 ml-md-3">
                                    <input autocomplete="off" type="password" placeholder="Type Your New Password" class="form-control text-center rounded-0 mt-4 forgot-email<?php if (form_error('password1')): ?> is-invalid <?php endif ?>" name="password1" >

                                    <input autocomplete="off" type="password" placeholder="Confirm Your New Password" class="form-control text-center rounded-0 mt-3 forgot-email<?php if (form_error('password2')): ?> is-invalid <?php endif ?>" name="password2" >
                                   
                                    <span id="email_forgot_error" class="text-danger"></span>

                                  </div>
                            
                                  <div class="form-group col-md-11 ml-md-3 ">
                                  
                                    <button type="submit" class="btn forgot-password col-12 text-white mt-2 mb-4 mb-sm-0" >SUBMIT</button>
                                    <!-- <small class="information-register text-left">By submit a shop, you agree to our <span>terms</span> and <span>privacy policy</span></small> -->
                
                                    <?= form_error('password2','<div class="text-danger text-center mt-1">','</div>') ?>
                                    <?= $this->session->flashdata('message'); ?>
                                  </div>
                                </form>

                            
                          
                        </div>
                        </div>
                      </div>
                    </div>


              </div>

  </div>

</div>



<script src="<?= base_url('assets2/')?>js/jquery-3.2.1.min.js"></script>
<script src="<?= base_url('assets2/')?>js/bootstrap.min.js"></script>
</body>

</html>