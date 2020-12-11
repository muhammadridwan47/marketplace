

    <div class="modal fade  " id="loginModal" >
      <div class="modal-dialog  modal-lg " >
        <div class="modal-content" style="height: 0px;border:0px;background-color: transparent;">

          <div class="modal-body " >

			
		 <div class="row" >
		 	<div class="col-12">
		 		<div class="row" id="loginbuat">
		 		<div class="col-md-6 " style="background-image: url('<?= base_url('assets2/img/bg auth/semua.svg'); ?>');background-size: cover;background-position: 0px -2px;background-repeat: no-repeat;background-color: #808181">	

						
		 			
		 		</div>
		 		<div class="col-md-6" style="background-color: #F4F4F4"  >
		 			<button   class="close exit-btn text-danger" data-toggle="modal"   data-dismiss="modal">&times;</button>
		 			<h4 class="text-center mb-5 pt-5 lead">Sign Into Your Account</h4>
					<div class="alert text-center" role="alert" id="notification"></div>

		            <form method="POST" id="form" class="pt-2">
		              <div class="form-group col-md-11 ml-md-3">
		               
		                <input type="text" placeholder=" Username" name="username"  class="form-control" style="background-color: white" >
		                <span id="username_error" class="text-danger"></span>

		              </div>
		              <div class="form-group col-md-11 ml-md-3">
		               
		                <input type="password" placeholder=" Password" name="password" id class="form-control" style="background-color: white"> <span data-toggle="modal" data-target="#forgot" style="position: relative;float: right;color: #F39B9D;bottom: 30px;cursor: pointer;" data-dismiss="modal">Forgot? &nbsp;</span>
		                <span id="error_password" class="text-danger"></span>
		              </div>

						
					 <div class="form-group col-md-11 ml-md-3 mb-2 ">
		              <button type="button" class="btn sign-in col-12 text-white  ml-0" style="background-color: #F39B9D">Sign In</button>
		              
                    </div>

		            </form>
					

		            <p class="text-center pt-3 register "  data-dismiss="modal" data-toggle="modal" data-target="#registerModal" >Do not have an account? <span style="color: #F39B9D">Create Here!</span></p>
		 		</div>
		 		</div>
		 	</div>
		 </div>

          </div>
        </div>
      </div>
    </div>



    <div class="modal fade" id="registerModal">
      <div class="modal-dialog  modal-lg">
        <div class="modal-content" style="height: 0px;background-color: transparent;border: 0px;">

          <div class="modal-body " >

			
		 <div class="row" style="background-color: #F4F4F4">
		 	<div class="col-12">
		 		<div class="row">

		 		<div class="col-md-6 " style="background-image: url('<?= base_url('assets2/img/bg auth/semua.svg'); ?>');background-size: cover;background-position: 0px -3px;background-repeat: no-repeat;background-color: #808181">
		 			
		 		</div>
		 		<div class="col-md-6" >
		 			<button   class="close exit-create text-danger" data-toggle="modal"   data-dismiss="modal">&times;</button>
		 			<h4 class="text-center mb-5 mt-4 lead">Create an Account</h4>

		 			<div class="alert text-center" role="alert" id="notification_create"></div>
		            <form  method="POST" id="form-registration">
		              <div class="form-group col-md-11 ml-md-3">
		               
		                <input type="text" placeholder=" Full Name" class="form-control" name="name" style="background-color: white" >
		                <span id="name_error" class="text-danger"></span>
		              </div>

		              <div class="form-group col-md-11 ml-md-3">
		               
		                <input type="text" placeholder=" Email Address" class="form-control" name="email" style="background-color: white" >
		                <span id="email_error" class="text-danger"></span>
		              </div>
		              <div class="form-group col-md-11 ml-md-3">
		               
		                <input type="text" placeholder=" Username" class="form-control" name="username" style="background-color: white" >
		                <span id="username_create_error" class="text-danger"></span>
		              </div>
		              <div class="form-group col-md-11 ml-md-3">
		               
		                <input type="password" placeholder=" Password" class="form-control" name="password" style="background-color: white" >
		                <span id="password_error" class="text-danger"></span>
		              </div>

						
					 <div class="form-group col-md-11 ml-md-3 ">
		              <button type="button" class="btn col-12 create-account text-white  " style="background-color: #F39B9D">Create Account</button>
		              
                    </div>
                    </form>
                    <small class="text-center ">By creating an account, you agree to our <span style="color:#F39B9D">terms</span> and <span style="color:#F39B9D">privacy policy</span></small>
		            
		            <p class="text-center mb-2 mt-4" data-toggle="modal" data-target="#loginModal" data-dismiss="modal">Already have an account? <span style="color:#F39B9D">Sign in</span></p>
		 		</div>
		 		</div>
		 	</div>
		 </div>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="forgot">
      <div class="modal-dialog  modal-lg">
        <div class="modal-content" style="height: 0px;background-color: transparent;border: 0px">
  
          <div class="modal-body " >

				 <div class="row" >
				 	<div class="col-12">
				 		<div class="row" id="loginbuat">
				 		<div class="col-md-6" style="background-image: url('<?= base_url('assets2/img/bg auth/semua.svg'); ?>');background-size: cover;background-repeat: no-repeat;">

				 		</div>
				 		<div class="col-md-6" style="background-color: #F4F4F4">
				 			<button   class="close exit-btn text-danger" data-toggle="modal"   data-dismiss="modal">&times;</button>
				 			<h4 class="text-center mb-15 mt-70 lead" >Reset Your Password</h4>
				            <form class="mt-120 " method="POST" id="forgot-password">
							<div class="alert" role="alert" id="notification_forgot"></div>
							  <div class="form-group col-md-11 ml-md-3 mb-10">
				               
				                <input type="text" placeholder=" Email Address" class="form-control" name="email" style="background-color: white" >
				                <span id="email_forgot_error" class="text-danger"></span>
				              </div>

								
							 <div class="form-group col-md-11 ml-md-3">
				              <button type="button" class="btn  text-white forgot-password col-12" style="background-color: #F39B9D">Send</button>
				              
		                  
				            </form>
							

				          
				 		</div>
				 		</div>
				 	</div>
				 </div>

          </div>
        </div>
      </div>
    </div>
</div>






 <div>
  <div class="row footer nabvar" style="background-color: #37363C;">
    <div class="col-md-2 col-sm-6 text-center">
      <img src="<?= base_url('assets2/') ?>img/logo/logo-dekstop.svg" class="d-none d-sm-inline">
      <img src="<?= base_url('assets2/') ?>img/logo/gs-mobile.svg" class="d-sm-none d-inline mt-3">

    </div>
    <div class="col-md-4 col-sm-6">


      <div class="row justify-content-center mt-4 text-center text-md-left information-footer">
        <div class="col-12 col-md-3 col-sm-4  ">
          <a href="" class="d-block text-white">About</a>
          <a href="" class="d-block text-white">Terms</a>
          <a href="" class="d-block text-white">Cookies</a>
          <a href="" class="d-block text-white">Privacy</a>
          <a href="" class="d-block text-white">FAQ</a>
        </div>
        <div class="col-12 col-md-6 col-sm-4 ">
          <a href="" class="d-block text-white">Licence</a>
          <a href="" class="d-block text-white">Deals</a>
          <a href="" class="d-block text-white">Sell Your Product</a>
          <a href="" class="d-block text-white">Share & Earn</a>
          <a href="" class="d-block text-white">Purchase Credit</a>
        </div>
      </div>
	<input type="hidden"  id="ncr" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
    </div>
    <div class="col-md-6  my-auto d-none d-sm-inline" style="border-left: 0.40px dashed #DDD5D5;height: 116px;">


      <div class="row justify-content-center  " style="height: 117px;">

	   <?php if ($this->session->userdata('email')) : ?>

              <?php if ($user['role_id'] < 4): ?>
              <?php if ($user['role_id'] != 3): ?>
		        <div class="col-3 my-auto">
		            <a style="cursor: pointer;" <?php if ($this->session->userdata('email')): ?> href="<?=base_url('designer/registration') ?>"  <?php else: ?> data-toggle="modal" data-target="#loginModal"<?php endif ?>><img src="<?= base_url('assets2/') ?>img/logo/open-shop.svg" alt="" class="img-fluid"></a>

		        </div>              
              <?php endif ?>


               <?php if ($user['role_id'] != 2 && $user['referal'] != ''): ?>
		         <div class="col-3 my-auto ">
		           <a style="cursor: pointer;" <?php if ($this->session->userdata('email')): ?> href="<?=base_url('affiliation/registration') ?>"  <?php else: ?> data-toggle="modal" data-target="#loginModal"<?php endif ?>><img src="<?= base_url('assets2/') ?>img/logo/share-earn.svg" alt="" class="img-fluid"></a>

		        </div>                     
                <?php endif ?> 
         
              <?php endif ?>


		        <div class="col-3 my-auto ">
		           <a style="cursor: pointer;" <?php if ($this->session->userdata('email')): ?> href="<?=base_url('products') ?>"  <?php else: ?> data-toggle="modal" data-target="#loginModal"<?php endif ?>><img src="<?= base_url('assets2/') ?>img/logo/purchase-creadit.svg" alt="" class="img-fluid"></a>

		        </div>

	   <?php else: ?>
        <div class="col-3 my-auto">
            <a style="cursor: pointer;" <?php if ($this->session->userdata('email')): ?> href="<?=base_url('designer/registration') ?>"  <?php else: ?> data-toggle="modal" data-target="#loginModal"<?php endif ?>><img src="<?= base_url('assets2/') ?>img/logo/open-shop.svg" alt="" class="img-fluid"></a>

        </div>
        <div class="col-3 my-auto ">
           <a style="cursor: pointer;" <?php if ($this->session->userdata('email')): ?> href="<?=base_url('affiliation/registration') ?>"  <?php else: ?> data-toggle="modal" data-target="#loginModal"<?php endif ?>><img src="<?= base_url('assets2/') ?>img/logo/share-earn.svg" alt="" class="img-fluid"></a>

        </div>
        <div class="col-3 my-auto ">
           <a style="cursor: pointer;" <?php if ($this->session->userdata('email')): ?> href="<?=base_url('products') ?>"  <?php else: ?> data-toggle="modal" data-target="#loginModal"<?php endif ?>><img src="<?= base_url('assets2/') ?>img/logo/purchase-creadit.svg" alt="" class="img-fluid"></a>

        </div>
	   <?php endif ?>


      

      </div>


    </div>


  </div>
</div>

    


    <script src="<?= base_url('assets2/')?>js/jquery-3.2.1.min.js"></script>
	<script src="<?= base_url('assets2/')?>js/bootstrap.js"></script>
	<script src="<?= base_url('assets2/')?>js/auth.js"></script>
<?php if ($this->session->userdata('email')): ?>
	
	<script>


	  $('.like-product').on('click',function(){
        
          
          const like = $(this).data('like');
          $.ajax({
              url: '<?= base_url('product/thumb/') ?>'+like,
              method: 'get',
              dataType: 'json',
              success : function(data){
              	console.log(data.success);
              	
              	alert(data.success);

              }
          });
         

       });

	  $('.love-product').on('click',function(){
        
          
          const love = $(this).data('love');
          $.ajax({
              url: '<?= base_url('product/love/') ?>'+love,
              method: 'get',
              dataType: 'json',
              success : function(data){
              	// console.log(data.success);
              	alert(data.success);
	              	// if (data.login) {
	              		// $('#loginModal').addClass('show');
	              	// 	$('#loginModal').css("display","block");
	              	// }
              }
          });
         

       });


	</script>
<?php endif ?>


</body>

</html>





