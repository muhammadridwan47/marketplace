
  <?php $this->load->view('templates/header_pages') ?>

	
<form  method="POST" id="upload" enctype="multipart/form-data">
<input type="hidden" id="token" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
<input type="hidden" name="jx" class="jx" value="<?= $barang['id_barang'] ?>">
 <section class="bg-white" >
   <div class="container">
     <div class="row">
       <div class="col-11">
         <div class="row justify-content-between">
         <div class="col-12 mt-5 mb-5">
<button class="btn  float-right text-white rounded-0 go-live"  style="background:#77C874;width:161.58px"><?php if ($barang['status'] == '0'): ?>Go Live <?php else: ?> Update <?php endif ?> </button>
            </div>

         </div>
       </div>
     </div>
   </div>
 </section>

  <div class="mt-4 mb-4" style="z-index: 9999 !important">
    
    <div class="container ">
      <div class="row justify-content-end">
        <div class="col-md-11">

            <div class="row">
              <div class="col-lg-8 bg-">
			          <div class="product-name">
			            <div class="row  mt-4 mb-1 justify-content-between">
			            	 
				              <div class="col-md-6 rounded-0">

                        <input class="form-control productName rounded-0" type="text" placeholder="Product Name" name="namaproduk" required style="border: 0.55px solid #F39B9D" value="<?= $barang['nama_barang'] ?>">

                      </div>
                      <div class="col-md-4 text-left">
                        <!-- <label for="tagline" class="col-sm-1 col-form-label">PRICE</label> -->

                        <!-- <input class="form-control text-right"  type="number" placeholder="$." name="price" required style="border: 0.55px solid #F39B9D"> -->
                        
                         <div class="form-group row  justify-content-end">
                            <label for="tagline" class="col-lg-3 col-form-label">PRICE</label>
                            <div class="col-lg-6">
                              
                              <input class="form-control label-price text-right rounded-0"  type="number" placeholder="000" name="price"  required style="border: 0.55px solid #F39B9D" value="<?php 
                        
                        if ($barang['jenis'] == 'Font') {
                            echo $barang['harga_dekstop'];
                        }else{
                          echo $barang['harga_premium'];
                        }
                        
                        ?>">
                              <span class="mt-1 ml-2" style="position:absolute;top:0;font-size:20px">$.</span>
                            </div>
                          </div>



                       </div>
				        
                 </div>
                 
                 <div class="row mt-2 mb-3">
                   <div class="col">
                     <!-- <span>By <?= $user['name'] ?> in:</span>               -->
                           <select class="custom-select d-inline col-sm-2 select jenis rounded-0" name="jenis" required style="border: 0.55px solid #F39B9D">
                              <option selected disabled value="">Category</option>
                              <option value="Font" <?php if ($barang['jenis'] == 'Font'): ?>selected<?php endif ?>>Font</option>
                              <option value="Graphic" <?php if ($barang['jenis'] == 'Graphic'): ?>selected<?php endif ?>>Graphic</option>
                              <option  value="Photo" <?php if ($barang['jenis'] == 'Photo'): ?>selected<?php endif ?>>Photo</option>
                            </select>

                           <select class="custom-select d-inline col-sm-3 sub rounded-0" name="kategori"   required style="border: 0.55px solid #F39B9D">
                              <option selected disabled value="null">Sub Categories</option>
                             
                                <?php if ($barang['jenis'] == 'Font'): ?>
                                
                                  <option class="sub-font" value="Display" <?php if ($barang['kategori'] == 'Display'): ?>selected<?php endif ?>>Display</option>
                                  <option class="sub-font" value="Sans Serif" <?php if ($barang['kategori'] == 'Sans Serif'): ?>selected<?php endif ?>>Sans Serif</option>
                                  <option class="sub-font" value="Serif" <?php if ($barang['kategori'] == 'Serif'): ?>selected<?php endif ?>>Serif</option>
                                  <option class="sub-font" value="Script" <?php if ($barang['kategori'] == 'Script'): ?>selected<?php endif ?>>Script</option>
                               <?php elseif ($barang['jenis'] == 'Graphic'): ?>
                                  <option class="sub-font" value="Icons" <?php if ($barang['kategori'] == 'Icons'): ?>selected<?php endif ?>>Icons</option>
                                  <option class="sub-font" value="Illustrations" <?php if ($barang['kategori'] == 'Illustrations'): ?>selected<?php endif ?>>Illustrations</option>
                                  <option class="sub-font" value="Web Elements" <?php if ($barang['kategori'] == 'Web Elements'): ?>selected<?php endif ?>>Web Elements</option>
                                  <option class="sub-font" value="Objects" <?php if ($barang['kategori'] == 'Objects'): ?>selected<?php endif ?>>Objects</option>
                                  <option class="sub-font" value="Patterns" <?php if ($barang['kategori'] == 'Patterns'): ?>selected<?php endif ?>>Patterns</option>
                                  <option class="sub-font" value="Textures" <?php if ($barang['kategori'] == 'Textures'): ?>selected<?php endif ?>>Textures</option>
                               <?php elseif ($barang['jenis'] == 'Photo'): ?>
                                <option class="sub-font" value="Abstract" <?php if ($barang['kategori'] == 'Abstract'): ?>selected<?php endif ?>>Abstract</option>
                                <option class="sub-font" value="Animals" <?php if ($barang['kategori'] == 'Animals'): ?>selected<?php endif ?>>Animals</option>
                                <option class="sub-font" value="Architecture" <?php if ($barang['kategori'] == 'Architecture'): ?>selected<?php endif ?>>Architecture</option>
                                <option class="sub-font" value="Arts & Entertainment" <?php if ($barang['kategori'] == 'Arts & Entertainment'): ?>selected<?php endif ?>>Arts & Entertainment</option>
                                <option class="sub-font" value="Beauty & Fashion" <?php if ($barang['kategori'] == 'Beauty & Fashion'): ?>selected<?php endif ?>>Beauty & Fashion</option>
                                <option class="sub-font" value="Business" <?php if ($barang['kategori'] == 'Business'): ?>selected<?php endif ?>>Business</option>
                                <option class="sub-font" value="Education" <?php if ($barang['kategori'] == 'Education'): ?>selected<?php endif ?>>Education</option>
                                <option class="sub-font" value="Food & Drink" <?php if ($barang['kategori'] == 'Food & Drink'): ?>selected<?php endif ?>>Food & Drink</option>
                                <option class="sub-font" value="Health" <?php if ($barang['kategori'] == 'Health'): ?>selected<?php endif ?>>Health</option>
                                <option class="sub-font" value="Holidays" <?php if ($barang['kategori'] == 'Holidays'): ?>selected<?php endif ?>>Holidays</option>
                                <option class="sub-font" value="Industrial" <?php if ($barang['kategori'] == 'Industrial'): ?>selected<?php endif ?>>Industrial</option>
                                <option class="sub-font" value="Nature" <?php if ($barang['kategori'] == 'Nature'): ?>selected<?php endif ?>>Nature</option>
                                <option class="sub-font" value="People" <?php if ($barang['kategori'] == 'People'): ?>selected<?php endif ?>>People</option>
                                <option class="sub-font" value="Sports" <?php if ($barang['kategori'] == 'Sports'): ?>selected<?php endif ?>>Sports</option>
                                <option class="sub-font" value="Technology" <?php if ($barang['kategori'] == 'Technology'): ?>selected<?php endif ?>>Technology</option>
                                <option class="sub-font" value="Transportation" <?php if ($barang['kategori'] == 'Transportation'): ?>selected<?php endif ?>>Transportation</option>
                                <?php endif ?>




                            </select>

                    </div>
                 </div>


                 
				        </div>

                  <div class="image-produk">
                    <img src="<?php if ($barang['gambar1']): ?> <?= base_url('').$barang['lokasi_gambar'].$barang['gambar1'] ?>  <?php else : ?><?= base_url('assets2/') ?>img/produk/new-image-upload.svg<?php endif ?>" class="img-fluid image1" id="image-product">
                  </div>
                  <div class="owl-carousel owl-theme image-small mt-sm-2 upload" >
                    <div class="item" data-item="1" >
                    <?php if ($barang['gambar1']): ?>
                      <button  type="button"  class="close close-1 btn close-image text-danger" style="position:absolute;right:0;" data-item="1">&times;</button>
                      <input type="file" class="gambar1"  name="gambar1" style="display: none;">
                    <?php else : ?>
                      <button  type="button"  class="close close-1 btn close-image text-danger" style="position:absolute;right:0;display:none" data-item="1">&times;</button>
                      <input type="file" class="gambar1"  name="gambar1">
                    <?php endif ?>
                    <img src=" <?php if ($barang['image1thumbnail']): ?> <?= base_url('').$barang['lokasi_gambar'].$barang['gambar1'] ?>  <?php else : ?><?= base_url('assets2/') ?>img/produk/new-thumbnail-upload.svg<?php endif ?>" class="img-fluid imagethumbnail1" data-thumbnail="<?php if ($barang['gambar1']): ?> <?= base_url('').$barang['lokasi_gambar'].$barang['gambar1'] ?>  <?php endif; ?>" >
                    </div>
                    <div class="item" data-item="2">
                    <?php if ($barang['gambar2']): ?>
                      <button  type="button"  class="close close-2 btn close-image text-danger" style="position:absolute;right:0;" data-item="2">&times;</button>
                      <input type="file"  name="gambar2" class="gambar2" style="display: none;">
                    <?php else : ?>
                      <button  type="button"  class="close close-2 btn close-image text-danger" style="position:absolute;right:0;display:none" data-item="2">&times;</button>
                      <input type="file"  name="gambar2" class="gambar2">
                    <?php endif ?>
                    <img src="<?php if ($barang['image2thumbnail']): ?> <?= base_url('').$barang['lokasi_gambar'].$barang['gambar2'] ?>  <?php else : ?><?= base_url('assets2/') ?>img/produk/new-thumbnail-upload.svg<?php endif ?>" class="img-fluid imagethumbnail2" data-thumbnail="<?php if ($barang['gambar2']): ?> <?= base_url('').$barang['lokasi_gambar'].$barang['gambar2'] ?>  <?php endif; ?>" >
                    </div>
                    <div class="item" data-item="3">
                    <?php if ($barang['gambar3']): ?>
                     <button  type="button"  class="close close-3 btn close-image text-danger" style="position:absolute;right:0;" data-item="3">&times;</button>
                     <input type="file"  name="gambar3" class="gambar3" style="display: none;">
                    <?php else : ?>
                      <button  type="button"  class="close close-3 btn close-image text-danger" style="position:absolute;right:0;display:none" data-item="3">&times;</button>
                      <input type="file"  name="gambar3" class="gambar3">
                    <?php endif ?>
                      <img src="<?php if ($barang['image3thumbnail']): ?> <?= base_url('').$barang['lokasi_gambar'].$barang['gambar3'] ?>  <?php else : ?><?= base_url('assets2/') ?>img/produk/new-thumbnail-upload.svg<?php endif ?>" class="img-fluid imagethumbnail3" data-thumbnail="<?php if ($barang['gambar3']): ?> <?= base_url('').$barang['lokasi_gambar'].$barang['gambar3'] ?>  <?php endif; ?>" >
                    </div>
                    <div class="item" data-item="4" class="gambar4">
                    <?php if ($barang['gambar4']): ?>
                     <button  type="button"  class="close close-4 btn close-image text-danger" style="position:absolute;right:0;" data-item="4">&times;</button>
                     <input type="file"  name="gambar4" class="gambar4" style="display: none;">
                   <?php else : ?>
                     <button  type="button"  class="close close-4 btn close-image text-danger" style="position:absolute;right:0;display:none" data-item="4">&times;</button>
                     <input type="file"  name="gambar4" class="gambar4">
                   <?php endif ?>
                      <img src="<?php if ($barang['image4thumbnail']): ?> <?= base_url('').$barang['lokasi_gambar'].$barang['gambar4'] ?>  <?php else : ?><?= base_url('assets2/') ?>img/produk/new-thumbnail-upload.svg<?php endif ?>" class="img-fluid imagethumbnail4" data-thumbnail="<?php if ($barang['gambar4']): ?> <?= base_url('').$barang['lokasi_gambar'].$barang['gambar4'] ?>  <?php endif; ?>" >
                    </div>
                    <div class="item" data-item="5" >
                    <?php if ($barang['gambar5']): ?>
                     <button  type="button"  class="close close-5 btn close-image text-danger" style="position:absolute;right:0;" data-item="5">&times;</button>
                     <input type="file"  name="gambar5" class="gambar5" style="display:none;">
                    <?php else : ?>
                      <button  type="button"  class="close close-5 btn close-image text-danger" style="position:absolute;right:0;display:none" data-item="5">&times;</button>
                      <input type="file"  name="gambar5" class="gambar5">
                    <?php endif ?>
                      <img src="<?php if ($barang['image5thumbnail']): ?> <?= base_url('').$barang['lokasi_gambar'].$barang['gambar5'] ?>  <?php else : ?><?= base_url('assets2/') ?>img/produk/new-thumbnail-upload.svg<?php endif ?>" class="img-fluid imagethumbnail5" data-thumbnail="<?php if ($barang['gambar5']): ?> <?= base_url('').$barang['lokasi_gambar'].$barang['gambar5'] ?>  <?php endif; ?>" >
                    </div>
                  </div>
              </div>

              <div class="col-lg-3 payment-upload d-none d-sm-block"  id="2">
                     
              <?php if ($barang['jenis'] == 'Font'): ?>
                
                <div class="row justify-content-center web-upload-payment " >
                    <p class="col-9 text-center">Upload Only File for Sale 256 MB Max Zip File</p>
                    <div class="free-version col-12 position-relative">

                    
                    <?php if ($barang['file_gratis']): ?>
                          <button type="button" class="btn col-12 text-white  btn-free" style="display: none;">
                          FREE VERSION FILE
                          <input type="file" required name="file" id="file" style="position: absolute;opacity: 0;cursor: pointer;width:100%;height:100%;right:0px;top:0" class="mt-1">

                        </button>

                        <button class="btn text-white free-progress" type="button" style="background-color: #77C874;width:100%" >
                          Successfully
                          <button  type="button"  class="btn close-free close-product close text-danger" data-product="free" style="position:absolute;right:0;background:transparent;right:17px;bottom:10px;;">&times;</button>
                        </button>

                    <?php else : ?>
                        <button type="button" class="btn col-12 text-white  btn-free" >
                          FREE VERSION FILE
                          <input type="file" required name="file" id="file" style="position: absolute;opacity: 0;cursor: pointer;width:100%;height:100%;right:0px;top:0" class="mt-1">

                        </button>

                        <button class="btn text-white free-progress" type="button" style="background-color: #77C874;display:none" >
                          0%
                          <button  type="button"  class="btn close-free close-product close text-danger" data-product="free" style="position:absolute;right:0;background:transparent;right:17px;bottom:10px;display:none;">&times;</button>
                        </button>
                    <?php endif ?>



                    </div>
                    
                    <div class="desktop-version mt-3 col-12">
                    <?php if ($barang['file_dekstop']): ?>
                       <button type="button" class="btn col-12  text-white btn-desktop" style="display: none;">
                         DESKTOP FILE
                         <input type="file" required id="desktop" name="desktop" style="position: absolute;opacity: 0;cursor: pointer;width:100%;height:100%;right:0px;top:0;" class="mt-1">
                         
                       </button>
                       <button class="btn text-white desktop-progress" type="button" style="background-color: #77C874;width:100%" >
                         Successfully
                       <button  type="button"  class="btn close-desktop close-product close text-danger" data-product="desktop" style="position:absolute;right:0;background:transparent;right:17px;bottom:10px;">&times;</button>

                       </button>

                    <?php else : ?>

                      <button type="button" class="btn col-12  text-white btn-desktop">
                         DESKTOP FILE
                         <input type="file" required id="desktop" name="desktop" style="position: absolute;opacity: 0;cursor: pointer;width:100%;height:100%;right:0px;top:0;" class="mt-1">
                         
                       </button>
                       <button class="btn text-white desktop-progress" type="button" style="background-color: #77C874;display:none" >
                          0%
                       <button  type="button"  class="btn close-desktop close-product close text-danger" data-product="desktop" style="position:absolute;right:0;background:transparent;right:17px;bottom:10px;display:none;">&times;</button>

                       </button>

                    <?php endif ?>
                    
                    </div>
                    <div class="app-version mt-3 col-12">
                     <?php if ($barang['file_app']): ?>

                       <button type="button" class="btn btn-app  col-12 text-white" style="display: none;" >
                         APP FILE
                         <input type="file" required id="app" name="app" style="position: absolute;opacity: 0;cursor: pointer;width:100%;height:100%;right:0px;top:0;" class="mt-1">
                       </button>
                       <button class="btn text-white app-progress" type="button" style="background-color: #77C874;width:100%" >
                          Successfully
                          <button  type="button"  class="btn close-app close-product close text-danger" data-product="app" style="position:absolute;right:0;background:transparent;right:17px;bottom:10px;">&times;</button>
                       </button>

                     <?php else : ?>
                      <button type="button" class="btn btn-app  col-12 text-white" >
                         APP FILE
                         <input type="file" required id="app" name="app" style="position: absolute;opacity: 0;cursor: pointer;width:100%;height:100%;right:0px;top:0;" class="mt-1">
                       </button>
                       <button class="btn text-white app-progress" type="button" style="background-color: #77C874;display:none" >
                          0%
                          <button  type="button"  class="btn close-app close-product close text-danger" data-product="app" style="position:absolute;right:0;background:transparent;right:17px;bottom:10px;display:none;">&times;</button>
                       </button>
                     <?php endif ?>

                      
                    </div>
                    <div class="web-version mt-3  mb-4 col-12">

                    <?php if ($barang['file_web']): ?>

                       <button type="button" class="btn btn-web  col-12 text-white" style="display: none;">
                         WEB FILE
                         <input type="file" required id="web" name="web" style="position: absolute;opacity: 0;cursor: pointer;width:100%;height:100%;right:0px;top:0;" class="mt-1">
                       </button>
                       <button class="btn text-white web-progress" type="button" style="background-color: #77C874;width:100%" >
                          Successfully
                          <button  type="button"  class="btn close-web close-product close text-danger" data-product="web" style="position:absolute;right:0;background:transparent;right:17px;bottom:10px;">&times;</button>
                       </button>

                    <?php else : ?>

                      <button type="button" class="btn btn-web  col-12 text-white" >
                         WEB FILE
                         <input type="file" required id="web" name="web" style="position: absolute;opacity: 0;cursor: pointer;width:100%;height:100%;right:0px;top:0;" class="mt-1">
                       </button>
                       <button class="btn text-white web-progress" type="button" style="background-color: #77C874;display:none" >
                          0%
                          <button  type="button"  class="btn close-web close-product close text-danger" data-product="web" style="position:absolute;right:0;background:transparent;right:17px;bottom:10px;display:none;">&times;</button>
                       </button>

                    <?php endif ?>


                    </div>
                </div>
                

              <?php else : ?>

                <div class="row justify-content-center web-upload-payment " >
                    <p class="col-9 text-center">Upload Only File for Sale 256 MB Max Zip File</p>
                    <div class="free-version col-12 position-relative">



                        <?php if ($barang['file_gratis']): ?>
                          <button type="button" class="btn col-12 text-white  btn-free" style="display: none;">
                          FREE VERSION FILE
                          <input type="file" required name="file" id="file" style="position: absolute;opacity: 0;cursor: pointer;width:100%;height:100%;right:0px;top:0" class="mt-1">

                        </button>

                        <button class="btn text-white free-progress" type="button" style="background-color: #77C874;width:100%" >
                          Successfully
                          <button  type="button"  class="btn close-free close-product close text-danger" data-product="free" style="position:absolute;right:0;background:transparent;right:17px;bottom:10px;;">&times;</button>
                        </button>

                        <?php else : ?>
                        <button type="button" class="btn col-12 text-white  btn-free" >
                          FREE VERSION FILE
                          <input type="file" required name="file" id="file" style="position: absolute;opacity: 0;cursor: pointer;width:100%;height:100%;right:0px;top:0" class="mt-1">

                        </button>

                        <button class="btn text-white free-progress" type="button" style="background-color: #77C874;display:none" >
                          0%
                          <button  type="button"  class="btn close-free close-product close text-danger" data-product="free" style="position:absolute;right:0;background:transparent;right:17px;bottom:10px;display:none;">&times;</button>
                        </button>
                        <?php endif ?>



                    </div>
                    <div class="premium-version mt-3 col-12">
                    <?php if ($barang['file_premium']): ?>
                       <button type="button" class="btn col-12  text-white btn-premium" style="display: none;">
                         PREMIUM FILE
                         <input type="file" required id="premium" name="premium" style="position: absolute;opacity: 0;cursor: pointer;width:100%;height:100%;right:0px;top:0;" class="mt-1">
                       </button>
                       <button class="btn text-white premium-progress" type="button" style="background-color: #77C874;width:100%" >
                          Successfully
                          <button  type="button"  class="btn close-premium close-product close text-danger" data-product="premium" style="position:absolute;right:0;background:transparent;right:17px;bottom:10px;">&times;</button>
                       </button>



                       <?php else : ?>
                        <button type="button" class="btn col-12  text-white btn-premium">
                         PREMIUM FILE
                         <input type="file" required id="premium" name="premium" style="position: absolute;opacity: 0;cursor: pointer;width:100%;height:100%;right:0px;top:0;" class="mt-1">
                       </button>
                       <button class="btn text-white premium-progress" type="button" style="background-color: #77C874;display:none" >
                          0%
                          <button  type="button"  class="btn close-premium close-product close text-danger" data-product="premium" style="position:absolute;right:0;background:transparent;right:17px;bottom:10px;display:none;">&times;</button>
                       </button>

                     <?php endif ?>
                    </div>
                    


                </div>
                
              <?php endif ?>
                          
              </div>

            </div>


        </div>
      </div>
    </div>
    

  </div>


  <nav class="navbar note-file-upload" >
   
      <div class="container justify-content-center">
            
              <div class="col-8 col-sm-7 ">
                <p class="text-white " >Files Included: <span class="format-file text-uppercase"> <?= $barang['format_file'] ?></span></p>
              </div>

              <!-- <div class="col-4 col-sm-3 preview-font-upload" style="opacity: 0;">
                  <img src="<?= base_url('assets2/') ?>img/logo/pt.svg" class="float-right" >
                  <input type="text" class="float-right text-right"  placeholder="24 " readonly style="cursor:pointer"> 
              </div> -->
             
              <div class="col-4 col-sm-3 preview-font-upload" <?php if ($barang['jenis'] != 'Font'): ?> style="opacity: 0;" <?php endif ?> >
                  <img src="<?= base_url('assets2/') ?>img/logo/pt.svg" class="float-right" >
                  <input type="text" class="float-right text-right"  placeholder="24 " readonly style="cursor:pointer"> 
              </div>
            
      </div>

     
          <div class="col-8 col-sm-7 d-sm-none" >
            <p class="text-white" >Files Included: <span class="format-file text-uppercase"></span></p>
          </div>

          <div class="col-4 col-sm-3 preview-font-upload d-sm-none" style="opacity: 0;">
              <img src="<?= base_url('assets2/') ?>img/logo/pt.svg" class="float-right" >
              <input type="text" class="float-right text-right"  placeholder="24 " readonly style="cursor:pointer"> 
          </div>
  </nav>


 



  <section class="" style="background-color: #EFEFEF;" >
  
  <div class="container mt-4 mb-4 render-font" style="display: none;">
      <div class="row justify-content-end">
        <div class="col-sm-11 ">

        <div class="row">
          <div class="col-sm-8">
              <input type="text" id="tulis" class="rounded-2"  placeholder=" TYPE TO TRY" style="width: 100%;height: 33.42px;border: 0.22px solid #F39B9D;" autocomplete="off">
              <input type="hidden" name="code" id="code">
            <div class="font-example mt-3 font" style="overflow-x: hidden;" >
             
            </div>
            
            
          </div>
        </div>
       
        </div>
      </div>
    </div>



    <div class="container ">
      <div class="row justify-content-end">
        <div class="col-sm-11 ">

          <p class="mt-3 mb-1" style="font-size: 16px !important;color: #161514;">Descriptions:</p>
          <div class="row">
            <div class="col-sm-10">


              <textarea class="form-control deskripsi rounded-0" placeholder="Type your product description here"  rows="5" name="deskripsi" required style="border: 0.55px solid #F39B9D;font-size:15px !important" ><?= $barang['deskripsi'] ?></textarea>

              <div class="form-group row mt-2">
                <label for="tagline" class="col-sm-2 col-md-1 col-form-label">Tagline</label>
                <div class="col-sm-6">
                  
                  <input type="text" class="form-control form-control-md tagline rounded-0" name="tagline" placeholder="Type and enter"  required style="border: 0.55px solid #F39B9D;font-size:15px !important" id="tagline" value="<?= $barang['tagline'] ?>">
                </div>
 
              </div>
          </div>

       
        </div>

        
      </div>




    </div>

      
    
  </section>




  <!-- <div class="container ">


  <section class="payment-mobile-upload d-block d-sm-none  mb-5 " id="1">

    <div class=" payment-upload " >
      <div class="row justify-content-center web-upload-payment-mobile " >

      </div>




    </div>

  </section>


</div> -->

</form>








	<?php $this->load->view('templates/footer_pages') ?>

	<script src="<?= base_url('assets2/')?>js/jquery-3.5.1.min.js"></script>
	<script src="<?= base_url('assets2/')?>js/auth.js"></script>
  <script src="<?= base_url('assets2/')?>js/owl.carousel.min.js"></script>
  <script>





    $(document).ready(function() {
      $('body').css('background','#EFEFEF');
      var owl = $('.owl-carousel');
      owl.owlCarousel({
        nav: true,
        // loop: false,
        responsive: {
          0: {
            items: 5,
            margin: 5
          },
          600: {
            items: 5,
            margin: 8
          },
          1000: {
            items: 5,
            margin: 8
          }
        }
      })
    });


$('.select').on('change',function(){

        $('.web-upload-payment').remove();
        // $('.upload-premium').remove();
        // $('.upload-font-mobile').remove();
        // $('.upload-premium-mobile').remove();
  
    
        if ($('.select').val() == 'Font') {

          $('.sub').removeAttr('disabled');
          $('.sub-font').remove();
          $('.preview-font-upload').css('opacity','1');
          var arrFont = ['Display','Sans Serif','Serif','Script'];
          $.each(arrFont,function(index,obj)
          {
              var sub = `<option class="sub-font" value="${obj}">${obj}</option>`;
                $('.sub').append(sub);
          });


          let upload = `<div class="row justify-content-center web-upload-payment " >
                    <p class="col-9 text-center">Upload Only File for Sale 256 MB Max Zip File</p>
                    <div class="free-version col-12 position-relative">
                       <button type="button" class="btn col-12 text-white  btn-free" >
                         FREE VERSION FILE
                       <input type="file" required name="file" id="file" style="position: absolute;opacity: 0;cursor: pointer;width:100%;height:100%;right:0px;top:0" class="mt-1">

                        </button>
                        <button class="btn text-white free-progress" type="button" style="background-color: #77C874;display:none" >
                          0%
                          <button  type="button"  class="btn close-free close-product close text-danger" data-product="free" style="position:absolute;right:0;background:transparent;right:17px;bottom:10px;display:none;">&times;</button>
                        </button>

                    </div>
                    
                    <div class="desktop-version mt-3 col-12">
                       <button type="button" class="btn col-12  text-white btn-desktop">
                         DESKTOP FILE
                         <input type="file" required id="desktop" name="desktop" style="position: absolute;opacity: 0;cursor: pointer;width:100%;height:100%;right:0px;top:0;" class="mt-1">
                         
                       </button>
                       <button class="btn text-white desktop-progress" type="button" style="background-color: #77C874;display:none" >
                          0%
                       <button  type="button"  class="btn close-desktop close-product close text-danger" data-product="desktop" style="position:absolute;right:0;background:transparent;right:17px;bottom:10px;display:none;">&times;</button>

                       </button>
                    </div>
                    <div class="app-version mt-3 col-12">
                       <button type="button" class="btn btn-app  col-12 text-white" >
                         APP FILE
                         <input type="file" required id="app" name="app" style="position: absolute;opacity: 0;cursor: pointer;width:100%;height:100%;right:0px;top:0;" class="mt-1">
                       </button>
                       <button class="btn text-white app-progress" type="button" style="background-color: #77C874;display:none" >
                          0%
                          <button  type="button"  class="btn close-app close-product close text-danger" data-product="app" style="position:absolute;right:0;background:transparent;right:17px;bottom:10px;display:none;">&times;</button>
                       </button>
                    </div>
                    <div class="web-version mt-3  mb-4 col-12">
                       <button type="button" class="btn btn-web  col-12 text-white" >
                         WEB FILE
                         <input type="file" required id="web" name="web" style="position: absolute;opacity: 0;cursor: pointer;width:100%;height:100%;right:0px;top:0;" class="mt-1">
                       </button>
                       <button class="btn text-white web-progress" type="button" style="background-color: #77C874;display:none" >
                          0%
                          <button  type="button"  class="btn close-web close-product close text-danger" data-product="web" style="position:absolute;right:0;background:transparent;right:17px;bottom:10px;display:none;">&times;</button>
                       </button>
                    </div>

          

                </div>`;




          $('.payment-upload').append(upload);
          
        }else{
          $('.preview-font-upload').css('opacity','0');
          $(".render-font").css('display','none');
          // $(".font-example img").remove();

          let upload = `<div class="row justify-content-center web-upload-payment " >
                    <p class="col-9 text-center">Upload Only File for Sale 256 MB Max Zip File</p>
                    <div class="free-version col-12 position-relative">
                       <button type="button" class="btn col-12 text-white  btn-free" >
                         FREE VERSION FILE
                       <input type="file" required name="file" id="file" style="position: absolute;opacity: 0;cursor: pointer;width:100%;height:100%;right:0px;top:0" class="mt-1">

                        </button>
                        <button class="btn text-white free-progress" type="button" style="background-color: #77C874;display:none" >
                          0%
                          <button  type="button"  class="btn close-free close-product close text-danger" data-product="free" style="position:absolute;right:0;background:transparent;right:17px;bottom:10px;display:none;">&times;</button>
                        </button>

                    </div>
                    <div class="premium-version mt-3 col-12">
                       <button type="button" class="btn col-12  text-white btn-premium">
                         PREMIUM FILE
                         <input type="file" required id="premium" name="premium" style="position: absolute;opacity: 0;cursor: pointer;width:100%;height:100%;right:0px;top:0;" class="mt-1">
                       </button>
                       <button class="btn text-white premium-progress" type="button" style="background-color: #77C874;display:none" >
                          0%
                          <button  type="button"  class="btn close-premium close-product close text-danger" data-product="premium" style="position:absolute;right:0;background:transparent;right:17px;bottom:10px;display:none;">&times;</button>
                       </button>
                    </div>
                    


                </div>`;

          $('.payment-upload').append(upload);
        }

        if ($('.select').val() == 'Graphic') {

          $('.sub').removeAttr('disabled');
          $('.sub-font').remove();
          var arrFont = ['Icons','Illustrations','Web Elements','Objects','Patterns','Textures'];
          $.each(arrFont,function(index,obj)
          {
              var sub = `<option class="sub-font" value="${obj}">${obj}</option>`;
                $('.sub').append(sub);
          });
          
        }
        if ($('.select').val() == 'Photo') {

          $('.sub').removeAttr('disabled');
          $('.sub-font').remove();
          var arrFont = ['Abstract','Animals','Architecture','Arts & Entertainment','Beauty & Fashion','Business','Education','Food & Drink','Health','Holidays','Industrial','Nature','People','Sports','Technology','Transportation'];
          $.each(arrFont,function(index,obj)
          {
              var sub = `<option class="sub-font" value="${obj}">${obj}</option>`;
                $('.sub').append(sub);
          });
          
        }

});
<?php if ($barang['jenis'] == 'Font'): ?>
<?php if ($barang['file_dekstop']): ?>

    $(".render-font").css('display','block');
        

        var nilai = $('#tulis').val();
        $('#code').val('<?= $barang['id_barang'] ?>');
        $.ajax({
            url: '<?=base_url('product/render/') ?>'+'<?= $barang['id_barang'] ?>'+'?s='+nilai,
            
            method: 'GET',
            success : function(data){
            // if (data.success) {
            var dir = "<?= base_url('renderingfont/').$this->session->userdata('render').'/' ?>";
            var fileextension = ".png";
            $.ajax({
              //This will retrieve the contents of the folder if the folder is configured as 'browsable'
              url: dir,
              success: function (data) {
                //List all .png file names in the page
          

                $('.link').remove();
                $('.link1').remove();
                $(data).find("a:contains(" + fileextension + ")").each(function () {
                  var filename = this.href.replace(window.location, "renderingfont/").replace("<?= base_url('upload/edit/') ?>", "<?= base_url('renderingfont/').$this->session->userdata('render').'/' ?>");
                  
                  $(".font").append("<img class='link mt-2' src='"+filename+"'><hr style='margin: 2px;' class='link1'>");
                });
              }
            });			    					
            // }
            }
        });
<?php endif ?>
<?php endif ?>


  $(".payment-upload").on('change','input[name=file]', function(){
        // var form =   $('form');
        // var form_data = new FormData(form[0]);
        var form_data = new FormData();
        form_data.append("file", $('input[name=file]')[0].files[0]);
        form_data.append("np",$('.productName').val());
        form_data.append("jx",$('.jx').val());
        form_data.append("jenis",$('.jenis').val());
        form_data.append("kategori",$('.sub').val());
        form_data.append("deskripsi",$('.deskripsi').val());
        form_data.append("tagline",$('.tagline').val());
        form_data.append("price",$('.label-price').val());
        form_data.append($('#token').attr('name'),$('#token').val());

        $.ajax({
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = ((evt.loaded / evt.total) * 100);
                        $(".btn-free").css('display','none');
                        $(".free-progress").css('display','block');
                        $(".free-progress").css('width',Math.ceil(percentComplete) + '%');
                        $(".free-progress").html(Math.ceil(percentComplete)+'%');
                    }
                }, false);
                return xhr;
            },
            type: 'POST',
            url: '<?= base_url('upload/uploadProduct') ?>',
            data: form_data,
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function(){
                $(".progress-bar").width('0%');
            },
            success: function(e){
                console.log(e);

                $('#token').val(e.csrf_token);


	

                if(e.error){
                  Swal.fire({
                    type:'warning',
                    title: 'Oops...',
                    html: e.errors,
                    confirmButtonColor: '#DB000E',
                  });
                  
                  $(".free-progress").css('width','auto');
                  $(".free-progress").html('0%');
                  $(".free-progress").css('display','none');
                  $(".btn-free").css('display','block');
                  $('#file').val('');

                }
                if(e.success){
                  // $(".productName").attr('disabled','disabled');
                  // $(".label-price").attr('disabled','disabled');
                  // $(".custom-select").attr('disabled','disabled');
                  // $(".deskripsi").attr('disabled','disabled');
                  // $(".tagline").attr('disabled','disabled');
                  $(".btn-free").css('display','none');
                  // $(".btn-desktop").removeAttr('disabled');
                  // $(".btn-desktop input").css('display','inline');
                  // $(".btn-premium").removeAttr('disabled');
                  // $(".btn-premium input").css('display','inline');
                  $('.go-live').removeAttr('disabled');
                  $(".free-progress").css('width','100%');
                  $(".free-progress").html('Successfully');
                  $(".close-free").css('display','inline');
                  $(".format-file").html(e.format_file);
                }

            }
        });
    });

  $(".payment-upload").on('change','input[name=desktop]', function(){
        // var form =   $('form');
        var form_data = new FormData();
        form_data.append("desktop", $('input[name=desktop]')[0].files[0]);
        form_data.append("np",$('.productName').val());
        form_data.append("jx",$('.jx').val());
        form_data.append("jenis",$('.jenis').val());
        form_data.append("kategori",$('.sub').val());
        form_data.append("deskripsi",$('.deskripsi').val());
        form_data.append("tagline",$('.tagline').val());
        form_data.append("price",$('.label-price').val());
        form_data.append($('#token').attr('name'),$('#token').val());

        $.ajax({
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = ((evt.loaded / evt.total) * 100);
                        $(".btn-desktop").css('display','none');
                        $(".desktop-progress").css('display','block');
                        $(".desktop-progress").css('width',Math.ceil(percentComplete) + '%');
                        $(".desktop-progress").html(Math.ceil(percentComplete)+'%');
                    }
                }, false);
                return xhr;
            },
            type: 'POST',
            url: '<?= base_url('upload/uploadProduct') ?>',
            data: form_data,
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function(){
                $(".progress-bar").width('0%');
            },
            success: function(e){
                console.log(e);

                $('#token').val(e.csrf_token);


	

                if(e.error){
                  Swal.fire({
                    type:'warning',
                    title: 'Oops...',
                    html: e.errors,
                    confirmButtonColor: '#DB000E',
                  });
                  
                  $(".desktop-progress").css('width','auto');
                  $(".desktop-progress").html('0%');
                  $(".desktop-progress").css('display','none');
                  $(".btn-desktop").css('display','block');
                  $('#desktop').val('');

                }
                if(e.success){

                  $('#code').val(e.code);

                  var nilai = $('#tulis').val();
                  $.ajax({
                      url: '<?=base_url('product/render/') ?>'+e.code+'?s='+nilai,
                      
                      method: 'GET',
                      success : function(data){
                      // if (data.success) {
                      var dir = "<?= base_url('renderingfont/').$this->session->userdata('render').'/' ?>";
                      var fileextension = ".png";
                      $.ajax({
                        //This will retrieve the contents of the folder if the folder is configured as 'browsable'
                        url: dir,
                        success: function (data) {
                          //List all .png file names in the page
                    

                          $('.link').remove();
                          $('.link1').remove();
                          $(data).find("a:contains(" + fileextension + ")").each(function () {
                            var filename = this.href.replace(window.location, "renderingfont/").replace("<?= base_url('upload/edit/') ?>", "<?= base_url('renderingfont/').$this->session->userdata('render').'/' ?>");
                            
                            $(".font").append("<img class='link mt-2' src='"+filename+"'><hr style='margin: 2px;' class='link1'>");
                          });
                        }
                      });			    					
                      // }
                      }
                  });

                  $(".render-font").css('display','block');
                  // $(".btn-free").css('display','none');
                  // $(".btn-app").removeAttr('disabled');
                  // $(".btn-app input").css('display','inline');
                  // $(".btn-web").removeAttr('disabled');
                  // $(".btn-web input").css('display','inline');s
                  $('.go-live').removeAttr('disabled');
                  $(".desktop-progress").css('width','100%');
                  $(".desktop-progress").html('Successfully');
                  $(".close-desktop").css('display','inline');
                  $(".format-file").html(e.format_file);
                }

            }
        });
    });


    $(".item img").click(function() {
      let thumbnail = $(this).attr('data-thumbnail');
      if(thumbnail != ""){
        $("#image-product").attr("src",thumbnail);
      }
    });

    $('#tulis').on('keyup',function(){

      var nilai = $('#tulis').val();
      // let size = $('.size').val();
      let size = '24';
      // let id = 24;


        $.ajax({
            url: '<?=base_url('product/render/')?>'+$('#code').val()+'/'+$.trim(size)+'?s='+nilai,
            // data,
            method: 'GET',
            dataType:'json',
            success : function(data){
            if (data.success) {
            var dir = "<?= base_url('renderingfont/').$this->session->userdata('render').'/' ?>";
            var fileextension = ".png";
            $.ajax({
              //This will retrieve the contents of the folder if the folder is configured as 'browsable'
              url: dir,
              success: function (data) {
                //List all .png file names in the page
          

                $('.link').remove();
                $('.link1').remove();
                $(data).find("a:contains(" + fileextension + ")").each(function () {
                  var filename = this.href.replace(window.location, "renderingfont/").replace("<?= base_url('upload/edit/') ?>", "<?= base_url('renderingfont/').$this->session->userdata('render').'/' ?>");
                  $(".font").append("<img class='link mt-2' src='"+filename+"'><hr style='margin: 2px;' class='link1'>");
                });
              }
            });			    					
            }
            }
        });
      });

  $(".payment-upload").on('change','input[name=app]',function(){
    var form_data = new FormData();
        form_data.append("app", $('input[name=app]')[0].files[0]);
        form_data.append("np",$('.productName').val());
        form_data.append("jx",$('.jx').val());
        form_data.append("jenis",$('.jenis').val());
        form_data.append("kategori",$('.sub').val());
        form_data.append("deskripsi",$('.deskripsi').val());
        form_data.append("tagline",$('.tagline').val());
        form_data.append("price",$('.label-price').val());
        form_data.append($('#token').attr('name'),$('#token').val());

        $.ajax({
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = ((evt.loaded / evt.total) * 100);
                        $(".btn-app").css('display','none');
                        $(".app-progress").css('display','block');
                        $(".app-progress").css('width',Math.ceil(percentComplete) + '%');
                        $(".app-progress").html(Math.ceil(percentComplete)+'%');
                    }
                }, false);
                return xhr;
            },
            type: 'POST',
            url: '<?= base_url('upload/uploadProduct') ?>',
            data: form_data,
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function(){
                $(".progress-bar").width('0%');
            },
            success: function(e){
                console.log(e);

                $('#token').val(e.csrf_token);


	

                if(e.error){
                  Swal.fire({
                    type:'warning',
                    title: 'Oops...',
                    html: e.errors,
                    confirmButtonColor: '#DB000E',
                  });
                  
                  $(".app-progress").css('width','auto');
                  $(".app-progress").html('0%');
                  $(".app-progress").css('display','none');
                  $(".btn-app").css('display','block');
                  $('#app').val('');

                }
                if(e.success){
                  $(".app-progress").css('width','100%');
                  $(".app-progress").html('Successfully');
                  $(".close-app").css('display','inline');
                  $(".format-file").html(e.format_file);
                  $('.go-live').removeAttr('disabled');
                }

            }
        });
    });
  $(".payment-upload").on('change','input[name=web]',function(){
    var form_data = new FormData();
        form_data.append("web", $('input[name=web]')[0].files[0]);
        form_data.append("np",$('.productName').val());
        form_data.append("jx",$('.jx').val());
        form_data.append("jenis",$('.jenis').val());
        form_data.append("kategori",$('.sub').val());
        form_data.append("deskripsi",$('.deskripsi').val());
        form_data.append("tagline",$('.tagline').val());
        form_data.append("price",$('.label-price').val());
        form_data.append($('#token').attr('name'),$('#token').val());

        $.ajax({
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = ((evt.loaded / evt.total) * 100);
                        $(".btn-web").css('display','none');
                        $(".web-progress").css('display','block');
                        $(".web-progress").css('width',Math.ceil(percentComplete) + '%');
                        $(".web-progress").html(Math.ceil(percentComplete)+'%');
                    }
                }, false);
                return xhr;
            },
            type: 'POST',
            url: '<?= base_url('upload/uploadProduct') ?>',
            data: form_data,
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function(){
                $(".progress-bar").width('0%');
            },
            success: function(e){
                console.log(e);

                $('#token').val(e.csrf_token);


	

                if(e.error){
                  Swal.fire({
                    type:'warning',
                    title: 'Oops...',
                    html: e.errors,
                    confirmButtonColor: '#DB000E',
                  });
                  
                  $(".web-progress").css('width','auto');
                  $(".web-progress").html('0%');
                  $(".web-progress").css('display','none');
                  $(".btn-web").css('display','block');
                  $('#web').val('');

                }
                if(e.success){
                  // $(".btn-image").removeAttr('disabled');
                  // $(".btn-image input").css('display','inline');
                  $(".web-progress").css('width','100%');
                  $(".web-progress").html('Successfully');
                  $(".close-web").css('display','inline');
                  $(".format-file").html(e.format_file);
                  $('.go-live').removeAttr('disabled');
                }

            }
        });
    });

  $(".payment-upload").on('change','input[name=premium]',function(){
    var form_data = new FormData();
        form_data.append("premium", $('input[name=premium]')[0].files[0]);
        form_data.append("np",$('.productName').val());
        form_data.append("jx",$('.jx').val());
        form_data.append("jenis",$('.jenis').val());
        form_data.append("kategori",$('.sub').val());
        form_data.append("deskripsi",$('.deskripsi').val());
        form_data.append("tagline",$('.tagline').val());
        form_data.append("price",$('.label-price').val());
        form_data.append($('#token').attr('name'),$('#token').val());

        $.ajax({
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = ((evt.loaded / evt.total) * 100);
                        $(".btn-premium").css('display','none');
                        $(".premium-progress").css('display','block');
                        $(".premium-progress").css('width',Math.ceil(percentComplete) + '%');
                        $(".premium-progress").html(Math.ceil(percentComplete)+'%');
                    }
                }, false);
                return xhr;
            },
            type: 'POST',
            url: '<?= base_url('upload/uploadProduct') ?>',
            data: form_data,
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function(){
                $(".progress-bar").width('0%');
            },
            success: function(e){
                console.log(e);

                $('#token').val(e.csrf_token);


	

                if(e.error){
                  Swal.fire({
                    type:'warning',
                    title: 'Oops...',
                    html: e.errors,
                    confirmButtonColor: '#DB000E',
                  });
                  
                  $(".premium-progress").css('width','auto');
                  $(".premium-progress").html('0%');
                  $(".premium-progress").css('display','none');
                  $(".btn-premium").css('display','block');
                  $('#premium').val('');

                }
                if(e.success){
                  // $(".btn-image").removeAttr('disabled');
                  // $(".btn-image input").css('display','inline');
                  $(".premium-progress").css('width','100%');
                  $(".premium-progress").html('Successfully');
                  $(".close-premium").css('display','inline');
                  $(".format-file").html(e.format_file);
                  $('.go-live').removeAttr('disabled');
                }

            }
        });
    });


    $(".close-image").on('click',function(){

      let dataItem = $(this).attr('data-item');

      // alert(dataItem);

       var form_data = new FormData();
        form_data.append("jx",$('.jx').val());
        form_data.append("js",dataItem);
        form_data.append($('#token').attr('name'),$('#token').val());

        $.ajax({
              type: 'POST',
              url: '<?= base_url('upload/deleteimage') ?>',
              data: form_data,
              contentType: false,
              cache: false,
              processData:false,
              success: function(e){
                  console.log(e);
                  $('#token').val(e.csrf_token);
                  if(e.error){
                    Swal.fire({
                      type:'warning',
                      title: 'Oops...',
                      html: e.errors,
                      confirmButtonColor: '#DB000E',
                    });
                  }
                  if(e.success){
                    // alert('the image have been deleted');
                    $('.gambar'+dataItem).val('');

                    $(".image1").attr('src','<?= base_url('assets2/img/produk/new-image-upload.svg') ?>');
                    $(".imagethumbnail"+dataItem).attr('src','<?= base_url('assets2/img/produk/new-thumbnail-upload.svg') ?>');
                    $(".imagethumbnail"+dataItem).attr('data-thumbnail','<?= base_url('assets2/img/produk/new-image-upload.svg') ?>');
                    $(".gambar"+dataItem).css('display','inline');
                    $(".close-"+dataItem).css('display','none');


                  }

              }
        });
     

    });

    $(".payment-upload").on('click',".close-product",function(){

      let dataItem = $(this).attr('data-product');

      // alert(dataItem);



      $(".btn-"+dataItem).css('display','block');
      $(".close-"+dataItem).css('display','none');
      $("."+dataItem+"-progress").css('display','none');
      $("#"+dataItem).val('');

      if (dataItem == 'desktop') {
        $(".render-font").css('display','none');
      }
      if (dataItem == 'free') {
        $("#file").val('');
      }

      
       var form_data = new FormData();
        form_data.append("jx",$('.jx').val());
        form_data.append("js",dataItem);
        form_data.append($('#token').attr('name'),$('#token').val());

        $.ajax({
              type: 'POST',
              url: '<?= base_url('upload/deleteproduct') ?>',
              data: form_data,
              contentType: false,
              cache: false,
              processData:false,
              success: function(e){
                  console.log(e);
                  $('#token').val(e.csrf_token);
                  if(e.error){
                    Swal.fire({
                      type:'warning',
                      title: 'Oops...',
                      html: e.errors,
                      confirmButtonColor: '#DB000E',
                    });
                  }
                  if(e.success){
                    //  alert('the product have been deleted');
                    $(".format-file").html(e.format_file);
                  }

              }
        });
      

    });


  $(".item").on('click',function(){

    let dataItem = $(this).attr('data-item');

 

    
    // alert(dataItem);

    $(".item").on('change','.gambar'+dataItem,function(){    

      var form_data = new FormData();
          form_data.append($('.gambar'+dataItem).attr('name'), $('.gambar'+dataItem)[0].files[0]);
          form_data.append("np",$('.productName').val());
          form_data.append("jx",$('.jx').val());
          form_data.append("jenis",$('.jenis').val());
          form_data.append("kategori",$('.sub').val());
          form_data.append("deskripsi",$('.deskripsi').val());
          form_data.append("tagline",$('.tagline').val());
          form_data.append("price",$('.label-price').val());
          form_data.append($('#token').attr('name'),$('#token').val());

      

                  $.ajax({
                      type: 'POST',
                      url: '<?= base_url('upload/uploadProduct') ?>',
                      data: form_data,
                      contentType: false,
                      cache: false,
                      processData:false,
                      beforeSend: function(){
                      },
                      success: function(e){
                          console.log(e);

                          $('#token').val(e.csrf_token);

                          if(e.error){
                            Swal.fire({
                              type:'warning',
                              title: 'Oops...',
                              html: e.errors,
                              confirmButtonColor: '#DB000E',
                            });
                            
                          }
                          if(e.success){
                            $('.gambar'+dataItem).val('');
                            if (dataItem == '1') {
                                $('.gambar'+dataItem).val('');
                                $(".image1").attr('src','<?= base_url('') ?>'+e.lok+e.image);
                                $(".imagethumbnail1").attr('src','<?= base_url('') ?>'+e.lok+e.imagethumbnail);
                                $(".imagethumbnail1").attr('data-thumbnail','<?= base_url('') ?>'+e.lok+e.image);
                                $(".gambar"+dataItem).css('display','none');
                                $(".close-"+dataItem).css('display','inline');


                            }else{
                              if (dataItem == '2') {
                                  $('.gambar'+dataItem).val('');
                                  $(".image1").attr('src','<?= base_url('') ?>'+e.lok+e.image);
                                  $(".imagethumbnail2").attr('src','<?= base_url('') ?>'+e.lok+e.imagethumbnail);
                                  $(".imagethumbnail2").attr('data-thumbnail','<?= base_url('') ?>'+e.lok+e.image);
                                  $(".gambar"+dataItem).css('display','none');
                                  $(".close-"+dataItem).css('display','inline');
                              }else{
                                if (dataItem == '3') {
                                    $('.gambar'+dataItem).val('');
                                    $(".image1").attr('src','<?= base_url('') ?>'+e.lok+e.image);
                                    $(".imagethumbnail3").attr('src','<?= base_url('') ?>'+e.lok+e.imagethumbnail);
                                    $(".imagethumbnail3").attr('data-thumbnail','<?= base_url('') ?>'+e.lok+e.image);
                                    $(".gambar"+dataItem).css('display','none');
                                    $(".close-"+dataItem).css('display','inline');
                                }else{
                                  if (dataItem == '4') {
                                      $('.gambar'+dataItem).val('');
                                      $(".image1").attr('src','<?= base_url('') ?>'+e.lok+e.image);
                                      $(".imagethumbnail4").attr('src','<?= base_url('') ?>'+e.lok+e.imagethumbnail);
                                      $(".imagethumbnail4").attr('data-thumbnail','<?= base_url('') ?>'+e.lok+e.image);
                                      $(".gambar"+dataItem).css('display','none');
                                      $(".close-"+dataItem).css('display','inline');
                                  }else{
                                    if (dataItem == '5') {
                                        $('.gambar'+dataItem).val('');
                                        $(".image1").attr('src','<?= base_url('') ?>'+e.lok+e.image);
                                        $(".imagethumbnail5").attr('src','<?= base_url('') ?>'+e.lok+e.imagethumbnail);
                                        $(".imagethumbnail5").attr('data-thumbnail','<?= base_url('') ?>'+e.lok+e.image);
                                        $(".gambar"+dataItem).css('display','none');
                                        $(".close-"+dataItem).css('display','inline');
                                    }   
                                  }
                                }
                              }
                            }

                            $('.go-live').removeAttr('disabled');

                          // if ($('.select').val() == 'Photo') {
                          //     if ($(".btn-image input").attr('name') == 'gambar2') {  
                          //       $('.go-live').removeAttr('disabled');
                          //     }
                          // }else{
                          //   if($(".imagethumbnail5").attr('data-thumbnail') != ""){
                          //       $('.go-live').removeAttr('disabled');
                          //     }
                          // }
                          }

                      }
                  });



                // }else{
                //            Swal.fire({
                //               type:'warning',
                //               title: 'Oops...',
                //               html:"your upload image " + this.width +" x "+ this.height+"px",
                //               confirmButtonColor: '#DB000E',
                //             });
                // }
          
     });
  
	
    });



      $(".web-open").on('click',function() {
        $(".web-value").toggle();
      });



      $('.go-live').on('click',function(e){
	    	e.preventDefault();
      var form_data = new FormData();
          form_data.append("np",$('.productName').val());
          form_data.append("jx",$('.jx').val());
          form_data.append("jenis",$('.jenis').val());
          form_data.append("kategori",$('.sub').val());
          form_data.append("deskripsi",$('.deskripsi').val());
          form_data.append("tagline",$('.tagline').val());
          form_data.append("price",$('.label-price').val());
          form_data.append($('#token').attr('name'),$('#token').val());

        $.ajax({
                  url  : '<?= base_url('upload/live') ?>',
                  type : "POST",
                  data: form_data,
                  contentType: false,
                  cache: false,
                  processData:false,
                  success: function(data){
                    console.log(data);
                    $('#token').val(data.csrf_token);
                    if(data.error)
                    {
                           Swal.fire({
                              type:'warning',
                              title: 'Oops...',
                              html: data.message,
                              confirmButtonColor: '#DB000E',
                            });                       
                    }   
                    if(data.success)
                    {
                      // location.reload();
                           Swal.fire({
                              type:'success',
                              html: 'success',
                              showConfirmButton: false,
                              timer: 1500,
                              width: 300,
                            });  


                    }   
                    
                  }

        });

	    });




   var vPortWidth  = $(window).width();
  
    if (vPortWidth <= 575) {
        $('#2').remove();
        location.replace('<?= base_url('profile') ?>');
    }else{
        $('#1').remove();
    }

	</script>
</body>
</html



