


<div class="container">

  <div class="row  h-100 justify-content-center" style="height: 100vh !important;display: flex;" >


              <div class="my-auto">

                    <div class="row " style="background: transparent;">
                      <div class="col-12">
                        <div class="row" id="loginbuat" style="background-color: #F4F4F4;">
                            <div class="col-lg-6 bglogin"  style="background-image: url('<?= base_url('assets2/img/bg auth/bg.svg'); ?>');"></div>
                            <div class="col-lg-6" style="background-color: #F4F4F4"  >
                                <a href="<?= base_url() ?><?php if(isset($_GET['n']))echo base64_decode(urldecode($_GET['n'])); ?>"><button   class="close exit-btn text-danger" data-toggle="modal"   data-dismiss="modal">&times;</button></a>
                                <p class="text-center mt-5 " style="font-size: 20px;">SHARE AND EARN</p>
                              
                                    <form method="POST" action="<?= base_url('auth/affiliation') ?>" >
                                    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" >
                                      <div class="form-group col-md-11 ml-md-3">
                                      

                                        <input autocomplete="off" type="url" placeholder=" Your Website" class="form-control rounded-0 mt-3 forgot-email<?php if (form_error('url')): ?> is-invalid <?php endif ?>" name="url" required>
                                          <textarea class="form-control mt-3 rounded-0 <?php if (form_error('reason')): ?> is-invalid <?php endif ?>" placeholder="Reason Selling With Us(Max. 500 Chars)"  rows="5" style="resize: none;" name="reason" required></textarea>
                                        <span id="email_forgot_error" class="text-danger"></span>

                                      </div>
                                

                                      <div class="form-group col-md-11 ml-md-3">
                                      
                                        <button type="submit" class="btn forgot-password col-12 text-white" >SUBMIT</button>
                                          <!-- <small class="information-register text-left">By submit a shop, you agree to our <span>terms</span> and <span>privacy policy</span></small> -->
                                        <br>
                                        <br>
                                        <!-- <div class="text-success text-center" role="alert">Your Request Has Been Approved..</div> -->
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



