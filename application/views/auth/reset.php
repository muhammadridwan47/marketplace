


<div class="container">

  <div class="row  h-100 justify-content-center" style="height: 100vh !important;display: flex;" >


              <div class="my-auto">

                      <div class="row " style="background: transparent;">
                      <div class="col-12">
                        <div class="row" id="loginbuat" style="background-color: #F4F4F4;">
                        <div class="col-lg-6 bglogin"  style="background-image: url('<?= base_url('assets2/img/bg auth/bg.svg'); ?>');"></div>
                        <div class="col-lg-6" style="background-color: #F4F4F4"  >
                          <a href="<?= base_url('profile') ?>"><button   class="close exit-btn text-danger" data-toggle="modal"   data-dismiss="modal">&times;</button></a>
                          <h4 class="text-center lead h4-forgot">Reset your password</h4>
                            <div class="alert text-center" role="alert" id="notification"></div>
                                <form method="POST" id="forgot-password">
                                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                                  <div class="form-group col-md-11 ml-md-3">
                                    <input autocomplete="off" type="text"placeholder=" Email Address" class="form-control forgot-email<?php if (form_error('email')): ?> is-invalid <?php endif ?>" name="email" >
                                    <span id="email_forgot_error" class="text-danger"></span>

                                  </div>
                            
           


                                  <div class="form-group col-md-11 ml-md-3 text-center">
                                  
                                    <button type="submit" class="btn forgot-password col-12 text-white" >Send Me Recovery Email</button>
                                    <br>
                                    <br> 
                                    <?= form_error('email','<span class="text-danger">','</span>') ?>
                                    <!-- <span class="text-danger">Catok</span> -->
                                    <!-- <?= $this->session->flashdata('message'); ?> -->
                                  </div>
                                </form>

                            
                          
                        </div>
                        </div>
                      </div>
                    </div>


              </div>

  </div>

</div>


