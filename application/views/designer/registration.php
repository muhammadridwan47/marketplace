
<div class="container">

  <div class="row  h-100 justify-content-center" style="height: 100vh !important;display: flex;" >


              <div class="my-auto">

                      <div class="row " style="background: transparent;">
                      <div class="col-12">
                        <div class="row" id="loginbuat" style="background-color: #F4F4F4;">
                        <div class="col-lg-6 bglogin"  style="background-image: url('<?= base_url('assets2/img/bg auth/bg.svg'); ?>');"></div>
                        <div class="col-lg-6" style="background-color: #F4F4F4"  >
                          <a href="<?= base_url() ?><?php if(isset($_GET['n']))echo base64_decode(urldecode($_GET['n'])); ?>"><button   class="close exit-btn text-danger" data-toggle="modal"   data-dismiss="modal">&times;</button></a>
                          <p class="text-center mt-2 " style="font-size: 20px;">OPEN A SHOP</p>
                            <!-- <div class="alert text-center" role="alert" id="notification"></div> -->
                                <form action="<?= base_url('auth/designer') ?>" method="POST" >
                                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                                  <div class="form-group col-md-11 ml-md-3">
                                    <input autocomplete="off" type="text" required placeholder=" Shop Name" class="form-control rounded-0 forgot-email<?php if (form_error('shopname')): ?> is-invalid <?php endif ?>" name="shopname" >

                                    <input autocomplete="off" type="url" required placeholder=" Your Portfilio Website" class="form-control rounded-0 mt-3 forgot-email<?php if (form_error('url')): ?> is-invalid <?php endif ?>" name="url" >
                                      <textarea class="form-control mt-3 rounded-0 <?php if (form_error('reason')): ?> is-invalid <?php endif ?>"  placeholder="Reason Selling With Us(Max. 500 Chars)" required  rows="5" style="resize: none;" name="reason"></textarea>
                                    <!-- <span id="email_forgot_error" class="text-danger"></span> -->

                                  </div>
                            
           


                                  <div class="form-group col-md-11 ml-md-3">
                                  
                                    <button type="submit" class="btn forgot-password col-12 text-white" >SUBMIT</button>
                                    <?php if (!$this->session->flashdata('message')): ?>
                                    <small class="information-register text-left">By submit a shop, you agree to our <span>terms</span> and <span>privacy policy</span></small>
                                    <?php endif ?>
                                    </form>
                                    <!-- <div class="text-success text-center" role="alert">Your Request Has Been Received.</div> -->
                                    <?= $this->session->flashdata('message'); ?>

                                    <?= form_error('reason') ?>
                                  </div>
                                

                            
                          
                        </div>
                        </div>
                      </div>
                    </div>


              </div>

  </div>

</div>



