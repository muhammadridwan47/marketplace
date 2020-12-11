
<div class="modal fade" id="loginModal" style="margin-top: 7%;">
  <div class="modal-dialog  modal-lg " >
    <div class="modal-content">

      <div class="modal-body " >

  
          <div class="row " style="background: transparent;">
            <div class="col-12">
              <div class="row" id="loginbuat" style="background-color: #F4F4F4;">
              <div class="col-lg-6 bglogin"  style="background-image: url('<?= base_url('assets2/img/bg auth/bg.svg'); ?>');"></div>
              <div class="col-lg-6" style="background-color: #F4F4F4"  >
                <button   class="close exit-btn text-danger" data-toggle="modal"   data-dismiss="modal">&times;</button>
                <h4 class="text-center mb-4 pt-5 pt-lg-0  lead h4-signin">Sign Into Your Account</h4>
                  <div class="alert text-center" role="alert" id="notification"></div>

                      <form method="POST" id="form">
                        <div class="form-group col-md-11 ml-md-3">
                          <input autocomplete="off" type="text" placeholder="Username" name="username"  class="form-control login-username" >
                          <span id="username_error" class="text-danger"></span>

                        </div>
                        <div class="form-group col-md-11 ml-md-3" >
                          <input autocomplete="off" type="password" placeholder="Password" name="password"  class="form-control login-password"> <span data-toggle="modal" class="forgot-btn" data-target="#forgot" style="" data-dismiss="modal">Forgot? &nbsp;</span>
                          <span id="error_password" class="text-danger"></span>
                        </div>

                  
                        <div class="form-group col-md-11 ml-md-3">
                        
                          <button type="submit" class="btn sign-in col-12 text-white" >
                           <span class="text-login">Sign In</span>
                          </button>

                           <a class="btn spinner spinner-login col-12 text-white rounded-0" style="display: none;">
                              <span class="spinner-grow spinner-grow-sm"  role="status" aria-hidden="true"></span>
                              <span class="spinner-grow spinner-grow-sm"  role="status" aria-hidden="true"></span>
                              <span class="spinner-grow spinner-grow-sm"  role="status" aria-hidden="true"></span>
                           </a>

                        
                        </div>
                      </form>
                

                      <p class="text-center register "  data-dismiss="modal" data-toggle="modal" data-target="#registerModal">Do not have an account? <span>Create Here!</span></p>
              </div>
              </div>
            </div>
          </div>

      </div>
    </div>
  </div>
</div>



 

<div class="modal fade " id="registerModal" style="margin-top: 7%;" >
  <div class="modal-dialog  modal-lg">
    <div class="modal-content">

      <div class="modal-body " >

  
          <div class="row " style="background: transparent;">
            <div class="col-12">
              <div class="row" id="loginbuat" style="background-color: #F4F4F4;">
              <div class="col-lg-6 bglogin"  style="background-image: url('<?= base_url('assets2/img/bg auth/bg.svg'); ?>');"></div>
              <div class="col-lg-6" style="background-color: #F4F4F4"  >
                <button   class="close exit-btn text-danger" data-toggle="modal"   data-dismiss="modal">&times;</button>
                <h4 class="text-center   pt-lg-0  lead h4-register">Create an Account</h4>
                  <div class="alert text-center" role="alert" id="notification"></div>

                      <form method="POST" id="form-registration">
                        <div class="form-group col-md-11 ml-md-3">
                 
                          <input autocomplete="off" required type="text" placeholder=" Full Name"  class="form-control register-name" name="name" style="background-color: white" >
                          <span id="name_error" class="text-danger"></span>
                        </div>
          
                        <div class="form-group col-md-11 ml-md-3">
                         
                          <input autocomplete="off" required type="email" placeholder=" Email Address" class="form-control register-email" name="email" style="background-color: white" >
                          <span id="email_error" class="text-danger"></span>
                        </div>
                        <div class="form-group col-md-11 ml-md-3">
                         
                          <input  type="text" placeholder=" Username" class="form-control register-username" name="username" autocomplete="off" required style="background-color: white" >
                          <span id="username_create_error" class="text-danger"></span>
                        </div>
                        <div class="form-group col-md-11 ml-md-3">
                         
                          <input autocomplete="off" required type="password" placeholder=" Password" class="form-control register-password" name="password" style="background-color: white" >
                          <span id="password_error" class="text-danger"></span>
                        </div>
                        <div class="form-group col-md-11 ml-md-3 ">
                          <button type="submit" class="btn col-12 create-account text-white  " style="background-color: #F39B9D">
                           Create Account
                        </button>


                        <a class="btn spinner spinner-registration col-12 text-white rounded-0" style="display: none;">
                              <span class=" spinner-grow spinner-grow-sm"   role="status" aria-hidden="true"></span>
                              <span class=" spinner-grow spinner-grow-sm"   role="status" aria-hidden="true"></span>
                              <span class=" spinner-grow spinner-grow-sm"   role="status" aria-hidden="true"></span>
                        </a>
                          
                        </div>                        
                      </form>
                      <small class="text-center information-register d-block">By creating an account, you agree to our <span style="color:#F39B9D">terms</span> and <span style="color:#F39B9D">privacy policy</span></small>
                

                      <p class="text-center ready"  data-dismiss="modal" data-toggle="modal" data-target="#loginModal">Already have an account? <span>Sign in!</span></p>
              </div>
              </div>
            </div>
          </div>

      </div>
    </div>
  </div>
</div>




<div class="modal fade" id="forgot" style="margin-top: 7%;" >
  <div class="modal-dialog  modal-lg " >
    <div class="modal-content">

      <div class="modal-body " >

  
          <div class="row " style="background: transparent;">
            <div class="col-12">
              <div class="row" id="loginbuat" style="background-color: #F4F4F4;">
              <div class="col-lg-6 bglogin"  style="background-image: url('<?= base_url('assets2/img/bg auth/bg.svg'); ?>');"></div>
              <div class="col-lg-6" style="background-color: #F4F4F4"  >
                <button   class="close exit-btn text-danger" data-toggle="modal"   data-dismiss="modal">&times;</button>
                <h4 class="text-center lead h4-forgot">Reset your password</h4>
                  <div class="alert text-center" role="alert" id="notification"></div>

                      <form method="POST" id="forgot-password">
                        <div class="form-group col-md-11 ml-md-3">
                          <input autocomplete="off"  type="text"placeholder=" Email Address" class="form-control forgot-email" name="email" >
                          <span id="email_forgot_error" class="text-danger"></span>

                        </div>
                  
                        <div class="form-group col-md-11 ml-md-3">
                        
                          <button type="submit" class="btn forgot-password col-12 text-white" >
                            <span class="text-forgot">Send Me Recovery Email</span> 
                          </button>

                          <a class="btn spinner spinner-forgot col-12 text-white rounded-0" style="display: none;">
                              <span class="spinner-grow spinner-grow-sm"  role="status" aria-hidden="true"></span>
                              <span class="spinner-grow spinner-grow-sm"  role="status" aria-hidden="true"></span>
                              <span class="spinner-grow spinner-grow-sm"  role="status" aria-hidden="true"></span>
                           </a>                       
                        </div>
                      </form>
                
              </div>
              </div>
            </div>
          </div>

      </div>
    </div>
  </div>
</div>
