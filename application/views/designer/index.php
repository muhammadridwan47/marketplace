
  <?php $this->load->view('templates/header_pages') ?>  


  <div class="profile " style="position: relative;"  >
        
        <!-- <img src="<?= base_url('assets2/img/profile.jpg') ?>" class="img-fluid float-left"> -->
        <?php if ($profile['background']): ?>
          <img src="<?= base_url() .$profile['lokasi'].$profile['background'] ?>" class="w-100 h-100">
        <?php else: ?>
        <img src="<?= base_url('gambar profile/default/default.jpg')?>" class="w-100 h-100"> 
        <?php endif ?>
          

        <div class="container tulisan " >
          <div class="col-12" >
        <div class="row justify-content-end mt-2" >
          <div class="col-md-6">

          <?php if ($user['role_id'] >= 3 && $user['email'] == $profile['email']  ): ?>
            <input type="checkbox" class="ganti d-none d-lg-inline  " id="remember" style="position:absolute;top:7px;" <?php if ($profile['color_name'] == '#ffffff'): ?> data-c="#454A4D"  <?php else: ?> checked data-c="#ffffff"  <?php endif ?> data-m="name">
          <?php endif ?>
          
            <h2 style="color:<?= $profile['color_name'] ?> ;" class=" text-lg-left"><?= $profile['username'] ?></h2>
          <?php if ($user['role_id'] >= 3 && $user['email'] == $profile['email']): ?>
            <input type="checkbox" class="ganti d-none d-lg-inline " id="remember" style="position:absolute;top:44px;"  <?php if ($profile['color_about'] == '#ffffff'): ?> data-c="#454A4D"  <?php else: ?> checked data-c="#ffffff"  <?php endif ?> data-m="about">
          <?php endif ?>    
            <p style="color: <?= $profile['color_about'] ?>;" class=" text-lg-left"><?= $profile['tentang'] ?></p>
          </div>
        </div>            
          </div>
        </div>



</div>


  </div>
  







  <nav class="navbar navbar-expand navbar-dark justify-content-center search " >
    <form  method="POST" action="<?= base_url('designer/profile/').str_replace(' ','_', $profile['name']) ?>">
      <div>
        <div class="input-group">
          <div class="input-group-prepend">
           <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
            <button class="btn" type="submit" name="submit" value="submit">
              <img  src="<?= base_url('assets2/') ?>img/logo/search.svg"  class="align-text-bottom d-none d-sm-inline">
              <img  src="<?= base_url('assets2/') ?>img/logo/search-mobile.svg"  class="align-text-bottom d-inline d-sm-none">
            </button>
          </div>
          <input class="form-control form-control-sm" type="text" name="keyword" placeholder=" Search Supplement">
        </div>
      </div>
    </form>
  </nav>




<div class="container mt-4">


  
      


        <div class="text-center">
          <h1 class="mt-5 mb-0 " style="font-size: 27px;color: #37363C;">PRODUCTS by THIS DESIGNER</h1>
        </div>

      <div class="row justify-content-center">


      <?php $this->load->view('card/index'); ?>

          
      </div> 


 </div>




    	<div class="col-12 mt-5" style="background: #FAFAFA;height: 67.12px">
    		<section class="">
          <br>
    			<?= $this->pagination->create_links(); ?>
    		</section>
    	</div>



<script src="<?= base_url('assets2/')?>js/jquery-3.5.1.min.js"></script>
<script>

$('.ganti').on('change',function(e){

  let m = $(this).attr('data-m');
  let c = $(this).attr('data-c');

		    	$.ajax({
                url  : "<?= base_url('designer/color') ?>",
                type : "GET",
                data :{c:c,m:m} ,
                dataType : "JSON",
                success: function(data){
                  location.reload();

                  // if(data.success)
                  // {
                    location.reload();
                  // }                =
              }

            });

	});



</script>


	<?php $this->load->view('templates/footer_pages') ?>




