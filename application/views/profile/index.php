<?php $this->load->view('templates/header_pages') ?>

<section class="my-profile mt-5 mb-5">

<div class="container ">

  <div class="row justify-content-end ">
    <div class="col-md-11">
      <div class="menu-profile">
        <button class="btn rounded-0 text-white" style="background: #CACBCB" >My Profile</button>
        <a href="<?= base_url('auth/reset') ?>"><button class="btn rounded-0 text-white" >Password</button></a>
        <?php if ($user['role_id'] == 2): ?>
           <a class="d-none d-md-inline" href="<?= base_url('profile/affiliation') ?>"><button class="btn rounded-0 text-white sale"  >Sale & Payout</button></a>
        <?php else: ?>
          <?php if ($user['role_id'] >= 3): ?>
           <a href="<?= base_url('profile/myshop') ?>"><button class="btn rounded-0 text-white" >My Shop</button></a>
           <a class="d-none d-md-inline" href="<?= base_url('profile/sale') ?>"><button class="btn rounded-0 text-white sale"  >Sale & Payout</button></a>
          <?php endif ?>
        <?php endif ?>

        <?php if ($user['role_id'] >= 3): ?>
            <a class="d-none d-md-inline" href="<?= base_url('profile/product') ?>"><button class="btn rounded-0 text-white sale"  >My Products</button></a>
            <a class="d-none d-md-inline" href="<?= base_url('upload') ?>"><button class="btn rounded-0 text-white sale"  >Add Product</button></a>
        <?php endif ?>

     </div>
     

     <div class="row">
       <div class="col-lg-4 col-md-12">
        <div class="form-profile mt-4">
          <h5 class="avatar">Avatar:</h5>
          

          <!-- <?= form_open_multipart(''); ?> -->
       <form action="" method="post" enctype="multipart/form-data">
      <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

          <img class="rounded-circle" src="<?= base_url('').$user['lokasi'].$user['image'] ?>" style="width:33.67px;height:33.67px">
          <button class="btn rounded-0 text-white avatar-small" style="position:relative" >
             <input type="file" name="image-profile" style="opacity: 0;position:absolute;cursor: pointer;top:0;left:0"> 
              Update Image</button>
          <span class="information-avatar-small" >JPG or PNG 60x60 px</span>


          <div class="image-profile text-center " style="position: relative;background-image:url('<?= base_url('').$user['lokasi'].$user['background'] ?>');background-size:cover" >
          <input type="file" name="image-background" style="opacity: 0;position:absolute;cursor: pointer;top:0;left:0;width:100%;height:100%"> 
            <button class="btn text-white rounded-0 mt-4" >
              Update Image
            </button>
            <h5 class="mt-1" style="color:#B2B3B3;font-size:14px;">JPG or PNG 1366X350 px</h5>

          </div>
          <?= form_error('username','<small class="text-danger">','</small>') ?>
          
            <div class="mt-1 name" >
               <!-- <div class="d-inline float-right">
                <label class="mb-0" for="first-name" >First Name</label>
                <input type="text" class="form-control rounded-0" id="first-name"  >
               </div>
                <div class="d-inline" >
                  <label class="mb-0" for="last-name" >Last Name</label>
                  <input type="text" class="form-control rounded-0" id="last-name"  >
                 </div> -->
                 <!-- <div class="form-group mb-0 "> -->
                  <label class="mb-0" >Full Name</label>
                  <input type="text" class="form-control rounded-0 <?php if (form_error('name')): ?>is-invalid<?php endif ?>"  name="name" value="<?= $profile['name'] ?>"  >
                <!-- </div> -->
            </div>
            <div class="input-name">
            <div class="form-group mb-0 username">
              <label class="mb-0"  >Username</label>
              <input type="text" class="form-control rounded-0"  value="<?= $profile['username'] ?>" readonly  >
            </div>
            <div class="form-group mb-0">
              <label class="mb-0" for="email" >Email</label>
              <input type="email" class="form-control rounded-0" id="email" value="<?= $profile['email'] ?>" readonly >
            </div>
            <div class="form-group mb-0">
              <label class="mb-0" for="url" >Website or Social Network URL</label>
              <input type="text" class="form-control rounded-0" id="url" name="url" value="<?= $profile['url'] ?>" >
            </div>

          </div>


       </div>

       </div>
       <div class="col-lg-7 col-md-12 ">
         <div class="row justify-content-lg-center address " >
            <div class="bio form-group mr-2">
              <label for="bio">Bio</label>
              <textarea class="form-control rounded-0" name="bio" id="bio"><?= $profile['tentang'] ?></textarea>
            </div>


 

            <section class="" >
              <h5 style="font-size: 18px; color: #3B4145;">Address</h5>
              <div class="d-inline float-sm-right city">
                 <input type="text" class="form-control rounded-0" name="city" <?php if ($profile['role_id'] > 1): ?> required <?php endif ?> placeholder="City" value="<?= $profile['city'] ?>" >
              </div>
              <div class="d-inline street" >
                <input type="text" class="form-control rounded-0" name="street" <?php if ($profile['role_id'] > 1): ?> required <?php endif ?> placeholder="Street" value="<?= $profile['street'] ?>" >
              </div>
            </section>
            <section class="mt-3" >
              
              <div class="d-inline float-sm-right country">
                <input type="text" class="form-control rounded-0" name="country" <?php if ($profile['role_id'] > 1): ?> required <?php endif ?> placeholder="Country" value="<?= $profile['country'] ?>" >
              </div>
              <div class="d-inline province" >
                <input type="text" class="form-control rounded-0" name="province"<?php if ($profile['role_id'] > 1): ?> required <?php endif ?> placeholder="Province"  value="<?= $profile['province'] ?>">
                </div>
            </section>
            <section class="mt-3" >
              
              <div class="d-inline float-sm-right zip-code">
                <input type="text" class="form-control rounded-0" name="zip_code"  <?php if ($profile['role_id'] > 1): ?> required <?php endif ?> placeholder="Zip Code" value="<?= $profile['zip_code'] ?>" >
              </div>
              <div class="d-inline phone-number " >
                <input type="number" class="form-control rounded-0" name="phone_number" <?php if ($profile['role_id'] > 1): ?> required <?php endif ?> placeholder="Phone Number" value="<?= $profile['phone_number'] ?>" >
              </div>
                <!-- <center> -->
              <div class="text-center text-sm-right">
                <button class="btn rounded-0 text-white mt-3 float-sm-right" style="width: 100.23px;height: 27.55px;background: #6DAA31;padding: 0px;" type="submit">Update</button>
              </div>
              <!-- </center> -->
            </section>


      </form>
         </div>
       </div>  

     </div>




     
    </div>
  </div>

</div>

</section>

<?php $this->load->view('templates/footer_pages') ?>