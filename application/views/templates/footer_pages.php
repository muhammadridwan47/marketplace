

<?php $this->load->view('auth/index') ?>

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
          <a style="cursor: pointer;" class="d-block text-white" <?php if ($this->session->userdata('email')): ?> href="<?=base_url('auth/designer') ?>"  <?php else: ?> data-toggle="modal" data-target="#loginModal"<?php endif ?>>Sell Your Product</a>
          <a  class="d-block text-white" style="cursor: pointer;" <?php if ($this->session->userdata('email')): ?> href="<?=base_url('auth/affiliation') ?>"  <?php else: ?> data-toggle="modal" data-target="#loginModal"<?php endif ?>>Share & Earn</a>
          <a class="d-block text-white" style="cursor: pointer;" <?php if ($this->session->userdata('email')): ?> href="<?=base_url('credit') ?>"  <?php else: ?> data-toggle="modal" data-target="#loginModal"<?php endif ?> >Purchase Credit</a>
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
                    <a style="cursor: pointer;" <?php if ($this->session->userdata('email')): ?> href="<?=base_url('auth/designer') ?>"  <?php else: ?> data-toggle="modal" data-target="#loginModal"<?php endif ?>><img src="<?= base_url('assets2/') ?>img/logo/open-shop.svg" alt="" class="img-fluid"></a>

                </div>              
              <?php endif ?>


               <?php if ($user['role_id'] != 2 && $user['referal'] = ' '): ?>
                  <div class="col-3 my-auto ">
                    <a style="cursor: pointer;" <?php if ($this->session->userdata('email')): ?> href="<?=base_url('auth/affiliation') ?>"  <?php else: ?> data-toggle="modal" data-target="#loginModal"<?php endif ?>><img src="<?= base_url('assets2/') ?>img/logo/share-earn.svg" alt="" class="img-fluid"></a>

                  </div>                     
                <?php endif ?> 
         
              <?php endif ?>


		        <div class="col-3 my-auto ">
		           <a style="cursor: pointer;" <?php if ($this->session->userdata('email')): ?> href="<?=base_url('credit') ?>"  <?php else: ?> data-toggle="modal" data-target="#loginModal"<?php endif ?>><img src="<?= base_url('assets2/') ?>img/logo/purchase-creadit.svg" alt="" class="img-fluid"></a>

		        </div>

	   <?php else: ?>
        <div class="col-3 my-auto">
            <a style="cursor: pointer;" <?php if ($this->session->userdata('email')): ?> href="<?=base_url('auth/designer') ?>"  <?php else: ?> data-toggle="modal" data-target="#loginModal"<?php endif ?>><img src="<?= base_url('assets2/') ?>img/logo/open-shop.svg" alt="" class="img-fluid"></a>

        </div>
        <div class="col-3 my-auto ">
           <a style="cursor: pointer;" <?php if ($this->session->userdata('email')): ?> href="<?=base_url('auth/affiliation') ?>"  <?php else: ?> data-toggle="modal" data-target="#loginModal"<?php endif ?>><img src="<?= base_url('assets2/') ?>img/logo/share-earn.svg" alt="" class="img-fluid"></a>

        </div>
        <div class="col-3 my-auto ">
           <a style="cursor: pointer;" <?php if ($this->session->userdata('email')): ?> href="<?=base_url('credit') ?>"  <?php else: ?> data-toggle="modal" data-target="#loginModal"<?php endif ?>><img src="<?= base_url('assets2/') ?>img/logo/purchase-creadit.svg" alt="" class="img-fluid"></a>

        </div>
	   <?php endif ?>


      

      </div>


    </div>


  </div>
</div>

    


<script src="<?= base_url('assets2/')?>js/jquery-3.2.1.min.js"></script>
<script src="<?= base_url('assets2/')?>js/bootstrap.min.js"></script>
<script src="<?= base_url('assets2/')?>js/sweet/sweetalert2.all.min.js"></script>
<script src="<?= base_url('assets2/')?>js/countdown.min.js"></script>
<script src="<?= base_url('assets2/')?>js/auth.js"></script>
<script src="<?= base_url('assets2/')?>js/clipboard.min.js"></script>
<script>
  var clipboard = new ClipboardJS('.copy');
    clipboard.on('success', function(e) {

          const Toast = Swal.mixin({
          toast: true,
          position: 'top-center',
          showConfirmButton: false,
          timer: 1500,

        });

        Toast.fire({
          type: 'success',
          title: 'Copied'
        });
                 
    });
    
</script>



</body>

</html>





