
	<?php $this->load->view('templates/header_pages') ?>
	

	<div class="mt-4 mb-4">
    
    <div class="container ">
      <div class="row justify-content-end">
        <div class="col-md-11">
            <div class="row">
              <div class="col-sm-8 bg-">
			          <div class="designed-by">
			            <div class="row">
			            	 
				              <div class="col-md-12 mt-4 mb-1">
				            	 <a href="<?= base_url('designer/profile/').str_replace(' ','_', $pemilik['name']) ?>"><img class="rounded-circle" style="width: 40.52px;height:40.52px;"  src="<?= base_url('').$pemilik['lokasi'].$pemilik['image'] ?>" class="rounded-circle"></a>
									&nbsp;
				            	
				              		 <a style="color: #424343" href="<?= base_url('designer/profile/').str_replace(' ','_', $pemilik['name']) ?>" ><?= $pemilik['name'] ?>
				              		  </a> 
				              		 <span style="color: #CACBCB">|</span>
				              		 <a style="color: #424343" href="<?= base_url('product/detail/').str_replace(' ','_', $produk['nama_barang']) ?>" ><?= $produk['nama_barang'] ?>
				              		  </a>
				              		 <span style="color: #CACBCB">|</span>
				              		 <a style="color: #424343" href="<?= base_url('product/').str_replace(' ','_', $produk['jenis'].'s') ?>" ><?= $produk['jenis'] ?>
				              		 </a> 
							
				              </div>
				        
				         </div>
				        </div>

                  <div class="image-produk" style="position: relative">
                    <img src="<?= base_url() ?><?= $produk['lokasi_gambar'].$produk['gambar1'] ?>" class="img-fluid img" id="image-product">

                         <div class="icon-promo-detail " style="">
                            <div class="row" >

                              <div class="col-9 ">
                                <a href="" class="d-flex" style="height: 100%;width:100%"></a>
                              </div>
                              <div class="col-3 text-right">

                                <a href="#" class="love-promo love-detail d-inline-block mb-2 position-relative"  <?php if ($this->session->userdata('email')): ?>data-love="<?= hashid($produk['id']) ?>"  <?php else: ?> data-toggle="modal" data-target="#loginModal"<?php endif ?> ><img  src="<?= base_url('assets2/') ?>img/logo/love-promo.svg" ><br> <center><?=  count($this->db->get_where('colection',['id_barang' => $produk['id']])->result_array()) ?></center></a>
                                <br>
                                <a href="#" class="like-promo like-detail d-inline-block mb-2" <?php if ($this->session->userdata('email')): ?>data-like="<?= hashid($produk['id']) ?>" <?php else: ?> data-toggle="modal" data-target="#loginModal"<?php endif ?>><img src="<?= base_url('assets2/') ?>img/logo/like-promo.svg" > <br> <center><?=  count($this->db->get_where('suka',['id_barang' => $produk['id']])->result_array()) ?></center></a>
                                <a href="#" class=" d-block" style="margin-right:5px"><img src="<?= base_url('assets2/') ?>img/logo/share.svg" ></a>


                              </div>
                            </div>
                          </div>
                  </div>
                  <div class="owl-carousel owl-theme image-small mt-1 mt-sm-2" style="">
                    <div class="item ">
                      <img src="<?= base_url() ?><?= $produk['lokasi_gambar'].$produk['image1thumbnail'] ?>" class="img-fluid thumbnail" data-thumbnail="<?= base_url() ?><?= $produk['lokasi_gambar'].$produk['gambar1'] ?>" >
                    </div>
                    <div class="item ">
                      <img src="<?= base_url() ?><?= $produk['lokasi_gambar'].$produk['image2thumbnail'] ?>" class="img-fluid thumbnail"  data-thumbnail="<?= base_url() ?><?= $produk['lokasi_gambar'].$produk['gambar2'] ?>">
                    </div>
                    <div class="item ">
                      <img src="<?= base_url() ?><?= $produk['lokasi_gambar'].$produk['image3thumbnail'] ?>" class="img-fluid thumbnail"  data-thumbnail="<?= base_url() ?><?= $produk['lokasi_gambar'].$produk['gambar3'] ?>">
                    </div>
                    <div class="item ">
                      <img src="<?= base_url() ?><?= $produk['lokasi_gambar'].$produk['image4thumbnail'] ?>" class="img-fluid thumbnail"  data-thumbnail="<?= base_url() ?><?= $produk['lokasi_gambar'].$produk['gambar4'] ?>">
                    </div>
                    <div class="item ">
                      <img src="<?= base_url() ?><?= $produk['lokasi_gambar'].$produk['image5thumbnail'] ?>" class="img-fluid thumbnail"  data-thumbnail="<?= base_url() ?><?= $produk['lokasi_gambar'].$produk['gambar5'] ?>">
                    </div>
                  </div>
              </div>

              <div class="col-sm-3 payment d-none d-sm-block" style="" id="2">
                <div class="row justify-content-center" style="">
                  <div class="col-sm-12">
                    <p class="text-center" style="">Finish Purchase</p>
                    <?php if ($produk['file_gratis']): ?>
                      <a <?php if ($this->session->userdata('email')): ?> href="<?= base_url('Product/free_download/') . hashid($produk['id']) ?>"  <?php else: ?> data-toggle="modal" data-target="#loginModal"<?php endif ?> ><button class="btn rounded-0 text-white free-btn">FREE VERSION </button></a>
                    <?php endif ?>
                    

                    <?php if (!$this->db->get_where('transaksi_paypal',['id_barang' => $produk['id'],'email' => $this->session->userdata('email'),'jenis' => 'premium'])->row_array()): ?>

                        <?php if ($produk['file_premium']): ?>
                          <div class="mt-2 desktop premium btn-payment">
                          <span class="d-inline-block text-white text-desktop " >PREMIUM&nbsp;</span>
                          <input class="text-right jml-premium"   type="number" placeholder="1 " value="1 ">
                              <div class="d-inline-block text-center price-desktop" style=""><span class="d-inline-block val-premium" style="">$<?= $produk['harga_premium'] ?> </span>
                              </div>
                          </div>
                          <?php endif ?>
                     <?php else: ?>
                      <a  href="<?= base_url('Product/premium_download/') . hashid($produk['id']) ?>" ><button class="btn rounded-0 text-white free-btn mt-2">DOWNLOAD</button></a>
                    <?php endif ?>

                    <?php if (!$this->db->get_where('transaksi_paypal',['id_barang' => $produk['id'],'email' => $this->session->userdata('email'),'jenis' => 'desktop'])->row_array()): ?>

                        <?php if ($produk['file_dekstop']): ?>
                          <div class="mt-2 desktop btn-payment">
                          <span class="d-inline-block text-white text-desktop" >DESKTOP&nbsp;</span>
                              <input class="text-right jml-desktop"   type="number" placeholder="1 " value="1 ">
                              <!-- <input class="text-right amb-desktop"   type="hidden"> -->
                              <div class="d-inline-block text-center price-desktop" style=""><span class="d-inline-block val-desktop" value="">$<?= $produk['harga_dekstop'] ?> </span>
            
                              </div>
                          </div>
                          <?php endif ?>
                     <?php else: ?>
                      <a  href="<?= base_url('Product/desktop_download/') . hashid($produk['id']) ?>" ><button class="btn rounded-0 text-white free-btn mt-2">DOWNLOAD</button></a>
                    <?php endif ?>



                    <?php if (!$this->db->get_where('transaksi_paypal',['id_barang' => $produk['id'],'email' => $this->session->userdata('email'),'jenis' => 'app'])->row_array()): ?>                    
                      <?php if ($produk['file_app']): ?>
                      <div class="mt-2 app btn-payment" >
                          <span class="d-inline-block text-white  text-app" style="" >APP&nbsp;</span>
                          <input class="text-right jml-app" style=""  type="number" name="keyword" placeholder="1 " value="1 ">
                          <div class="d-inline-block text-center price-app" style=""><span class="d-inline-block val-app" style="">$<?= $produk['harga_app'] * 10?> </span>
                          </div>
                      </div>
                      <?php endif ?>
                    <?php else: ?>
                      <a  href="<?= base_url('Product/app_download/') . hashid($produk['id']) ?>" ><button class="btn rounded-0 text-white free-btn mt-2">DOWNLOAD</button></a>
                    <?php endif ?>


                    <?php if (!$this->db->get_where('transaksi_paypal',['id_barang' => $produk['id'],'email' => $this->session->userdata('email'),'jenis' => 'web'])->row_array()): ?>                     
                      <?php if ($produk['file_web']): ?>
                        <div class="mt-2 web web-open btn-payment " style="">
                        <span class="d-inline-block text-white text-web" style="" >WEB&nbsp;</span>
                            <input class="text-right value " style=""  type="text" name="keyword" placeholder="10K " value="10K " readonly>
    
                            <input class="text-right web-value" style="display:none"  type="text" name="keyword" placeholder="10K " value="10K " readonly>
                            <input class="text-right web-value" style="display:none"  type="text" name="keyword" placeholder="100K " value="100K " readonly>
    
                            <input class="text-right web-value" style="display:none"  type="text" name="keyword" placeholder="1M " value="1M " readonly>
    
                            <input class="text-right web-value" style="display:none"  type="text" name="keyword" placeholder="NO LIMIT" value=" NO LIMIT " readonly>
                            
                            <div class="d-inline-block text-center price-web" ><span class="d-inline-block val-web" style="">$<?= $produk['harga_web'] ?> </span>
                            </div>                       
                        </div>
                        <?php endif ?>
                    <?php else: ?>
                      <a  href="<?= base_url('Product/web_download/') . hashid($produk['id']) ?>" ><button class="btn rounded-0 text-white free-btn mt-2">DOWNLOAD</button></a>
                    <?php endif ?>

                      <div align="center">
                      <form action="<?=base_url('pembayaran/buy') ?><?php if(isset($_GET['referal']))echo '/'.$_GET['referal']; ?>" method="POST">
                       <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                       <input type="hidden" name="name" value="<?= hashid($produk['id']) ?>">
							      	 <input type="hidden" id="jenis" name="jenis">
							      	 <input type="hidden" id="jml" name="jml">

                        <button class="btn rounded-0 text-white mt-md-5 mt-2 text-center purchase" type="button" <?php if (!$this->session->userdata('email')): ?> data-toggle="modal" data-target="#loginModal"<?php endif ?> >Purchase Now</button>

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


  <nav class="navbar note-file" style="">
   
      <div class="container justify-content-center">
            
              <div class="col-8 col-sm-7 " >
                <p class="text-white text-uppercase" style="">Files Included: <?= $produk['format_file'] ?></p>
              </div>

              <div class="col-4 col-sm-3 preview-font position-relative" >
              <?php if ($produk['jenis'] == 'Font'): ?>
                  <img src="<?= base_url('assets2/') ?>img/logo/pt.svg" class="float-right" style="">
                  <input type="text" class="float-right text-right size" style="" placeholder="24 " value="24 "> 

                  
                  <input type="text" class="float-right text-right size-font "  style="display: none;position:absolute;right:57px;top:34px" placeholder="24 " value="24 " readonly> 
                  <input type="text" class="float-right text-right size-font "  style="display: none;position:absolute;right:57px;top:68px" placeholder="36 " value="36 " readonly> 
                  <input type="text" class="float-right text-right size-font "  style="display: none;position:absolute;right:57px;top:102px" placeholder="48 " value="48 " readonly> 
                  <input type="text" class="float-right text-right size-font "  style="display: none;position:absolute;right:57px;top:136px" placeholder="72 " value="72 " readonly> 
              <?php endif ?>
              </div>
      </div>

     
          <div class="col-8 col-sm-7 d-sm-none  " >

           <div class="" style="overflow:hidden;text-overflow:ellipsis;margin-left:-12px">
          
           
            <p class="text-white text-uppercase mt-2 "  >Files Included: <span class="d-inline-block " style="width: 30px"><?= $produk['format_file'] ?></span></p>
            </div>
          </div>

          <div class="col-4 col-sm-3 preview-font d-sm-none">
          <?php if ($produk['jenis'] == 'Font'): ?>
              <img src="<?= base_url('assets2/') ?>img/logo/pt.svg" class="float-right" style="">
              <input type="text" class="float-right text-right size" style="" placeholder="24 "> 
                  <input type="text" class="float-right text-right size-font "  style="display: none;position:absolute;right:53px;top:34px" placeholder="24 " value="24 " readonly> 
                  <input type="text" class="float-right text-right size-font "  style="display: none;position:absolute;right:53px;top:68px" placeholder="36 " value="36 " readonly> 
                  <input type="text" class="float-right text-right size-font "  style="display: none;position:absolute;right:53px;top:102px" placeholder="48 " value="48 " readonly> 
                  <input type="text" class="float-right text-right size-font "  style="display: none;position:absolute;right:53px;top:136px" placeholder="72 " value="72 " readonly> 
          <?php endif ?>
          </div>
  </nav>
  




<?php if ($produk['jenis'] == 'Font'): ?>
  <section class="mb-3" style="margin-top: 43px;">
    <div class="container ">
      <div class="row justify-content-end">
        <div class="col-sm-11 ">

        <div class="row">
          <div class="col-sm-8">
              <input type="text" id="tulis" class="rounded-2"  placeholder=" WHEN ZOMBIES ARRIVES QUICKLY FAX JUDGE PAT" style="width: 100%;height: 33.42px;border: 0.22px solid #F39B9D;">
              
            <div class="font-example mt-3 font" style="overflow-x: hidden;" >

            </div>
            
            
          </div>
        </div>
       
        </div>
      </div>
    </div>
  </section>
<?php endif ?>
  


  <section style="background-color: #F9FAFA;border-bottom: 6.50px solid #BDBEBF" class="">

    <div class="container ">
      <div class="row justify-content-end">
        <div class="col-sm-11 ">

          <p class="mt-3 mb-1" style="font-size: 18px !important;color: #161514;">Descriptions:</p>
          <div class="row">
            <div class="col-sm-10">
              <p  style="font-size: 14px !important;color: #424343;white-space:pre-line;">
              <?= $produk['deskripsi'] ?>
              </p>
            </div>
          </div>

       
        </div>
      </div>
    </div>

      
    
  </section>

  <section style="">

    <div class="container mb-5 ">
      <div class="row justify-content-end">
        <div class="col-sm-11 ">


          
          <div class="row">
            <div class="col-sm-8">
              <p class="mt-3 mb-1" style="font-size: 15px !important;color: #161514;border-bottom: 1px solid #B2B3B3;">Comments:</p>

              <div class="" style="max-height:350px ;overflow-y: scroll;">

              <?php foreach ($komentar as $komen): ?>
                 <div class="media mt-3">

                    <?php $gambar = $this->db->get_where('user',['email'=> $komen['email']])->row_array() ?>
                     <img class="d-flex rounded-circle avatar z-depth-1-half mr-3" style="width:27.64px;height:27.64px" src="<?= base_url().$gambar['lokasi'].$gambar['image'] ?>">
                      <div class="media-body">
                        <div style="border-bottom: 1px solid #B2B3B3;position: relative;" class="d-inline align-items-center">
                            <h5 class="mt-0 d-inline  " style="font-size: 15px;position: relative;">
                            <?= $komen['nama'] ?> 
                            </h5>




                            <?php if ($komen['tipe'] == 'pembeli'): ?>
                              <span class="d-inline-block text-center text-white" style="font-size: 7px;background-color: #F39B9D;width: 69.23px !important;height: 12.31px;margin-left: 26px;line-height: 1.7;position: relative;bottom: 7px; ">Purchased</span>
                            <?php elseif ($komen['tipe'] == 'desainer'): ?>
                              <span class="d-inline-block text-center text-white" style="font-size: 7px;background-color: #84CFF5;width: 69.23px !important;height: 12.31px;margin-left: 26px;line-height: 1.7;position: relative;bottom: 7px; ">Author</span>
                            
                              
                            <?php endif ?>


                        </div>
                          <p style="font-size: 11px;white-space:pre-line;"><?= $komen['review'] ?></p>
  
                      </div>
                 </div>
              <?php endforeach ?>

               </div>
               <hr>
               <?php if ($this->session->userdata('email')): ?>
               
               
               <div class="media mt-3">
                 <img class="d-flex rounded-circle avatar z-depth-1-half mr-3" style="width:27.64px;height:27.64px" src="<?= base_url('').$user['lokasi'].$user['image'] ?>">
                 <div class="media-body">
                   <div style="border-bottom: 1px solid #B2B3B3;position: relative;" class="d-inline align-items-center">
                       <h5 class="mt-0 d-inline  " style="font-size: 15px;position: relative;">
                         <?= $user['name'] ?>
                       </h5>
                   </div>
                     <div class="form-group">
                     <form action="<?= base_url('product/komentar') ?>" method="POST">
                      <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
					          	<input type="hidden" name="id" value="<?= $produk['id'] ?>">
                      <textarea class="form-control d-inline  col-8" name="review" style="border: 0;" rows="3"></textarea>
                        <button class="btn rounded-0 text-white align-top" type="submit" style="font-size: 7px;background-color: #84CFF5;width: 34.23px !important;height: 12.31px;line-height:0.1;padding: 0;">send</button>
                     </form>
                    </div>

                </div>
                <?php endif ?>
             </div>



            </div>
          </div>

       
        </div>
      </div>
    </div>

      
    
  </section>


  <section class="payment-mobile d-block d-sm-none mt-5 " style="margin-bottom: 85px" id="1">

    <div class=" payment" style="">
      <div class="row justify-content-center" style="">
        <div class="col-12 ">
          
          <div class="row justify-content-center ">
            <div class="ml-4">
              <!-- <section style=""> -->
                <p class="text-center" style="">Finish Purchase</p>
                   <?php if ($produk['file_gratis']): ?>
                      <a <?php if ($this->session->userdata('email')): ?> href="<?= base_url('Product/free_download/') . hashid($produk['id']) ?>"  <?php else: ?> data-toggle="modal" data-target="#loginModal"<?php endif ?> ><button class="btn rounded-0 text-white free-btn">FREE VERSION </button></a>
                    <?php endif ?>

                    <?php if (!$this->db->get_where('transaksi_paypal',['id_barang' => $produk['id'],'email' => $this->session->userdata('email'),'jenis' => 'premium'])->row_array()): ?>

                    <?php if ($produk['file_premium']): ?>
                      <div class="mt-2 desktop premium btn-payment">
                      <span class="d-inline-block text-white text-desktop " >PREMIUM&nbsp;</span>
                      <input class="text-right jml-premium"   type="number" placeholder="1 " value="1 ">
                          <div class="d-inline-block text-center price-desktop" style=""><span class="d-inline-block val-premium" style="">$<?= $produk['harga_premium'] ?> </span>
                          </div>
                      </div>
                      <?php endif ?>
                    <?php else: ?>
                    <a  href="<?= base_url('Product/premium_download/') . hashid($produk['id']) ?>" ><button class="btn d-block rounded-0 text-white free-btn mt-2">DOWNLOAD</button></a>
                    <?php endif ?>


                    <?php if (!$this->db->get_where('transaksi_paypal',['id_barang' => $produk['id'],'email' => $this->session->userdata('email'),'jenis' => 'desktop'])->row_array()): ?>

                    <?php if ($produk['file_dekstop']): ?>
                      <div class="mt-2 desktop btn-payment">
                      <span class="d-inline-block text-white text-desktop" >DESKTOP&nbsp;</span>
                          <input class="text-right jml-desktop"   type="number" placeholder="1 " value="1 ">
                          <!-- <input class="text-right amb-desktop"   type="hidden"> -->
                          <div class="d-inline-block text-center price-desktop" style=""><span class="d-inline-block val-desktop" value="">$<?= $produk['harga_dekstop'] ?> </span>

                          </div>
                      </div>
                      <?php endif ?>
                    <?php else: ?>
                    <a  href="<?= base_url('Product/desktop_download/') . hashid($produk['id']) ?>" ><button class="btn d-block rounded-0 text-white free-btn mt-2">DOWNLOAD</button></a>
                    <?php endif ?>
                
                
                    <?php if (!$this->db->get_where('transaksi_paypal',['id_barang' => $produk['id'],'email' => $this->session->userdata('email'),'jenis' => 'app'])->row_array()): ?>                    
                      <?php if ($produk['file_app']): ?>
                      <div class="mt-2 app btn-payment" >
                          <span class="d-inline-block text-white  text-app" style="" >APP&nbsp;</span>
                          <input class="text-right jml-app" style=""  type="number" name="keyword" placeholder="1 " value="1 ">
                          <div class="d-inline-block text-center price-app" style=""><span class="d-inline-block val-app" style="">$<?= $produk['harga_app'] * 10?> </span>
                          </div>
                      </div>
                      <?php endif ?>
                    <?php else: ?>
                      <a  href="<?= base_url('Product/app_download/') . hashid($produk['id']) ?>" ><button class="btn rounded-0 text-white free-btn mt-2">DOWNLOAD</button></a>
                    <?php endif ?>



                    
                
                    <?php if (!$this->db->get_where('transaksi_paypal',['id_barang' => $produk['id'],'email' => $this->session->userdata('email'),'jenis' => 'web'])->row_array()): ?>                     
                      <?php if ($produk['file_web']): ?>
                        <div class="mt-2 web web-open btn-payment " style="">
                        <span class="d-inline-block text-white text-web" style="" >WEB&nbsp;</span>
                            <input class="text-right value " style=""  type="text" name="keyword" placeholder="10K " value="10K " readonly>
    
                            <input class="text-right web-value" style="display:none"  type="text" name="keyword" placeholder="10K " value="10K " readonly>
                            <input class="text-right web-value" style="display:none"  type="text" name="keyword" placeholder="100K " value="100K " readonly>
    
                            <input class="text-right web-value" style="display:none"  type="text" name="keyword" placeholder="1M " value="1M " readonly>
    
                            <input class="text-right web-value" style="display:none"  type="text" name="keyword" placeholder="NO LIMIT" value=" NO LIMIT " readonly>
                            
                            <div class="d-inline-block text-center price-web" ><span class="d-inline-block val-web" style="">$<?= $produk['harga_web'] ?> </span>
                            </div>                       
                        </div>
                        <?php endif ?>
                    <?php else: ?>
                      <a  href="<?= base_url('Product/web_download/') . hashid($produk['id']) ?>" ><button class="btn rounded-0 d-block text-white free-btn mt-2">DOWNLOAD</button></a>
                    <?php endif ?>




                  <div align="center">
                  <form action="<?=base_url('pembayaran/buy') ?><?php if(isset($_GET['referal']))echo '/'.$_GET['referal']; ?>" method="POST">
                       <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                       <input type="hidden" name="name" value="<?= hashid($produk['id']) ?>">
							      	 <input type="hidden" id="jenis" name="jenis">
							      	 <input type="hidden" id="jml" name="jml">

                        <button class="btn rounded-0 text-white mt-4 text-center purchase" type="button" <?php if (!$this->session->userdata('email')): ?> data-toggle="modal" data-target="#loginModal"<?php endif ?> >Purchase Now</button>

                        </form>
      
                  </div>
                <!-- </section>                -->
            </div>
          </div>







        </div>
      </div>




    </div>

  </section>







	<?php $this->load->view('templates/footer_pages') ?>

	<script src="<?= base_url('assets2/')?>js/jquery-3.2.1.min.js"></script>
	<!-- <script src="<?= base_url('assets2/')?>js/scripts.min.js"></script> -->
	<script src="<?= base_url('assets2/')?>js/auth.js"></script>
  <script src="<?= base_url('assets2/')?>js/owl.carousel.min.js"></script>
  <script>
    $(document).ready(function() {
      var owl = $('.owl-carousel');
      owl.owlCarousel({
        nav: true,
        // loop: true,
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
    })
  </script>
	
	<script>
<?php if ($this->session->userdata('email')): ?>
	


	  $('.like-detail').on('click',function(){
        
          
          const like = $(this).data('like');
          $.ajax({
              url: '<?= base_url('product/thumb/') ?>'+like,
              method: 'get',
              dataType: 'json',
              success : function(data){
              	// console.log(data.success);
              	
              	// alert(data.success);
                
                Swal.fire({
                  type:'success',
                  title: 'success',
                  html: data.success,
                  showConfirmButton: false,
                  timer:1500
				      	});	

              }
          });
         

       });

	  $('.love-detail').on('click',function(){
        
          
          const love = $(this).data('love');
          $.ajax({
              url: '<?= base_url('product/love/') ?>'+love,
              method: 'get',
              dataType: 'json',
              success : function(data){
              	// console.log(data.success);
                Swal.fire({
                  type:'success',
                  title: 'success',
                  html: data.success,
                  showConfirmButton: false,
                  timer:1500

				      	});	
              }
          });
         

       });

<?php endif ?> 

var vPortWidth  = $(window).width();
  
  if (vPortWidth <= 575) {
      $('#2').remove();
  }else{
      $('#1').remove();
  }


$('.btn-payment').on('click',function(){

    $(".btn-payment").removeAttr("style");
    $(this).css("background-color","salmon");
});

$(".web-open").on('click',function() {
  $(".web-value").toggle();
});
$('#jml').val(1);
$(".web-value").on('click',function() {

 let tes =  $(this).val();
 $('.value').val(tes);
 
 

//  $('.val-web').html('$'+<?= $produk['harga_dekstop'] ?>);
 if (tes === '10K ') {
  
  $('.val-web').html('$'+<?= $produk['harga_dekstop'] ?>);
  $('#jml').val(1); 
 }
 if (tes == '100K ') {

  $('.val-web').html('$'+ 3 * <?= $produk['harga_dekstop'] ?>);
  $('#jml').val(2); 
 }
 if (tes == '1M ') {

  $('.val-web').html('$'+ 6 * <?= $produk['harga_dekstop'] ?>);
  $('#jml').val(3); 
 }
 
 if (tes == ' NO LIMIT ') {

  $('.val-web').html('$'+ 20 * <?= $produk['harga_dekstop'] ?>);
  $('#jml').val(4); 
 }

});


$('.jml-desktop').on('keyup',function(){
    
 let jml_desktop =  $('.jml-desktop').val().replace(/[^0-9\.]+/g, "");

 if(jml_desktop == 0){
  $('.val-desktop').html('$'+<?= $produk['harga_dekstop'] ?>);
  // $('.amb-desktop').val(1);
  $('#jml').val(jml_desktop);
  // $('.jml-desktop').val(1);
 }else{
  // $('.amb-desktop').val(jml_desktop);
  $('.val-desktop').html('$' + jml_desktop * <?= $produk['harga_dekstop'] ?>);
  // $('.amb-desktop').val(jml_desktop * <?= $produk['harga_dekstop'] ?>);
  $('#jml').val(jml_desktop);
 }


});
$('.jml-app').on('keyup',function(){
    
 let jml_app =  $('.jml-app').val().replace(/[^0-9\.]+/g, "");

 if(jml_app == 0){
  $('.val-app').html('$'+ 10 * <?= $produk['harga_dekstop'] ?>);
  // $('.amb-app').val(1);
  $('#jml').val(jml_app);
  // $('.jml-app').val(1);
 }else{
  // $('.amb-app').val(jml_app);
  $('.val-app').html('$' + jml_app *10* <?= $produk['harga_dekstop'] ?>);
  // $('.amb-app').val(jml_app * <?= $produk['harga_dekstop'] ?>);
  $('#jml').val(jml_app);
 }
});

<?php if ($produk['harga_premium']): ?>

$('.jml-premium').on('keyup',function(){
    
 let jml_premium =  $('.jml-premium').val().replace(/[^0-9\.]+/g, "");

 if(jml_premium == 0){
  $('.val-premium').html('$'+ <?= $produk['harga_premium'] ?>);
  $('#jml').val(jml_premium);
  
 }else{
  $('.val-premium').html('$' + jml_premium * <?= $produk['harga_premium'] ?>);
  $('#jml').val(jml_premium);
 }
});
<?php endif ?>


<?php if ($this->session->userdata('email')): ?>
$('.desktop').on('click',function(){

    $('#jenis').val('desktop');
    $('#jml').val(1);
    $('.purchase').removeAttr('type','button');

});

$('.app').on('click',function(){
    $('#jenis').val('app');
    $('#jml').val(1);
    $('.purchase').removeAttr('type','button');
});

$('.web').on('click',function(){
    $('#jenis').val('web');
    $('.purchase').removeAttr('type','button');
    
});

$('.premium').on('click',function(){
    $('#jenis').val('premium');
    $('#jml').val(1);
    $('.purchase').removeAttr('type','button');
});

<?php endif ?>

// preview-font 

$(".preview-font").on('click',function() {
  $(".size-font").toggle();
});

$(".size-font").on('click',function() {

let size =  $(this).val();
$('.size').val(size);

         var nilai = $('#tulis').val();

          $.ajax({
						url: '<?=base_url('product/render/').$produk['id_barang'] ?>/'+$.trim(size)+'?s='+nilai,
						
						method: 'GET',
						dataType:'json',
						success : function(data){
						// console.log(data.success);
		    //           	alert(data.success);
		    			if (data.success) {
							var dir = "<?= base_url('renderingfont/') ?>";
							var fileextension = ".png";
							$.ajax({
								//This will retrieve the contents of the folder if the folder is configured as 'browsable'
								url: dir,
								success: function (data) {
									//List all .png file names in the page
						

									$('.link').remove();
									$('.link1').remove();
									$(data).find("a:contains(" + fileextension + ")").each(function () {
										var filename = this.href.replace(window.location, "").replace("product/detail/", "renderingfont/");
										// alert(filename);
										$(".font").append("<img class='link mt-2' src='"+filename+"'><hr style='margin: 2px;' class='link1'>");
									});
								}
							});			    					
		    			}

						}
					}); 



});


      // image 
      $(".thumbnail").click(function() {

        let thumbnail = $(this).attr('data-thumbnail');
        $("#image-product").attr("src",thumbnail);
      })


	         var nilai = $('#tulis').val();
	 

          $.ajax({
              url: '<?=base_url('product/render/').$produk['id_barang'] ?>?s='+nilai,
              
              method: 'GET',
              success : function(data){
		    			// if (data.success) {
							var dir = "<?= base_url('renderingfont/') ?>";
							var fileextension = ".png";
							$.ajax({
								//This will retrieve the contents of the folder if the folder is configured as 'browsable'
								url: dir,
								success: function (data) {
									//List all .png file names in the page
						

									$('.link').remove();
									$('.link1').remove();
									$(data).find("a:contains(" + fileextension + ")").each(function () {
										var filename = this.href.replace(window.location, "").replace("product/detail/", "renderingfont/");
										// alert(filename);
										$(".font").append("<img class='link mt-2' src='"+filename+"'><hr style='margin: 2px;' class='link1'>");
									});
								}
							});			    					
		    			// }
              }
           });

 

 	$('#tulis').on('keyup',function(){

	      var nilai = $('#tulis').val();
	      let size = $('.size').val();
	      // let id = 24;


          $.ajax({
              url: '<?=base_url('product/render/').$produk['id_barang'] ?>/'+$.trim(size)+'?s='+nilai,
              // data,
              method: 'GET',
              dataType:'json',
              success : function(data){
              console.log(data);
		    			if (data.success) {
							var dir = "<?= base_url('renderingfont/') ?>";
							var fileextension = ".png";
							$.ajax({
								//This will retrieve the contents of the folder if the folder is configured as 'browsable'
								url: dir,
								success: function (data) {
									//List all .png file names in the page
						

									$('.link').remove();
									$('.link1').remove();
									$(data).find("a:contains(" + fileextension + ")").each(function () {
										var filename = this.href.replace(window.location, "").replace("product/detail/", "renderingfont/");
										// alert(filename);
										$(".font").append("<img class='link mt-2' src='"+filename+"'><hr style='margin: 2px;' class='link1'>");
									});
								}
							});			    					
		    			}
              }
          });



 	});




 	 	function shareFacebook(url)
    {
    	 window.open(url,'_blank');
    	// win.focus();
    }

	</script>
</body>
</html



