<!DOCTYPE html>
<html>
<head>
	<title>detail</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,height=device-height,initial-scale=1,maximum-scale=1">
	<meta name="format-detection" content="telephone=no">
	<link rel="shortcut icon" href="favicon.ico">
	<link rel="apple-touch-icon-precomposed" href="favicon.ico">
	<meta name="theme-color" content="#2775FF">
	<meta name="keywords" content="themeforest, theme, html, template">
  <meta property="og:url"           content="<?= base_url('product/detail/').str_replace(' ', '_',$produk['nama_barang'])?>" />
  <meta property="og:type"          content="website" />
  <meta property="og:title"         content="<?= $produk['nama_barang'] ?>" />
  <meta property="og:description"   content="Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo" />
<meta content='website' property='og:type'/>
<b:if cond='<?= base_url() ?><?= $produk['lokasi_gambar'].$produk['gambar1'] ?>'>
<meta expr:content='<?= base_url() ?><?= $produk['lokasi_gambar'].$produk['gambar1'] ?>' property='og:image'/>
<link expr:href='<?= base_url() ?><?= $produk['lokasi_gambar'].$produk['gambar1'] ?>' rel='image_src'/>
  <meta property="og:image"         content="<?= base_url() ?><?= $produk['lokasi_gambar'].$produk['gambar1'] ?>"/>	
	<link rel="stylesheet" id="brk-direction-bootstrap" href="<?= base_url('assets2/') ?>css/assets/bootstrap.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
	<link rel="stylesheet" id="brk-skin-color" href="<?= base_url('assets2/') ?>css/skins/brk-blue.css">
	<link id="brk-base-color" rel="stylesheet" href="<?= base_url('assets2/') ?>css/skins/brk-base-color.css">
	<link rel="stylesheet" id="brk-direction-offsets" href="<?= base_url('assets2/') ?>css/assets/offsets.css">
	<link id="brk-css-min" rel="stylesheet" href="<?= base_url('assets2/') ?>css/assets/styles.min.css">
	<link  rel="stylesheet" href="<?=base_url('assets2/') ?>css/style.css">
	


	<!-- tes -->

     <link rel="stylesheet" href="<?=base_url('assets/tes/') ?>css/font-awesome.min.css"> 

	<style type="text/css">
		@media screen and (min-width: 992px) {
			.free{
				margin-right:-12px;

			}

	
		}
		@media screen and (max-width:970px ) {
			.free{
				margin-right: -18px;
			}
		
		}		

    hr{
      margin-top: 0.3em;
      background-color: #c9caca;
      
    }
    /*---------------------
  Breadcrumb
-----------------------*/

.breadcrumb-text {
    /*border-bottom: 1px solid #ebebeb;*/
    padding: 15px 0;
}

.breadcrumb-text.product-more a:nth-child(1):after {
    color: #252525;
}

.breadcrumb-text a {
    display: inline-block;
    font-size: 16px;
    color: #252525;
    margin-right: 28px;
    position: relative;
}

.breadcrumb-text a:after {
    position: absolute;
    right: -18px;
    top: 0px;
    content: "";
    font-family: "FontAwesome";
    font-size: 16px;
    color: #b2b2b2;
}

.breadcrumb-text span {
    display: inline-block;
    color: #b2b2b2;
}

	</style>
</head>
<body>
	<!-- header -->
<div class="main-wrapper">
		<main class="main-container mb-50">
			<div class="brk-header-mobile">
				<div class="brk-header-mobile__open"><span></span></div>
				<div class="brk-header-mobile__logo"><a href="#"><img class="brk-header-mobile__logo-1  lazyload" src="<?= base_url('assets2/') ?>data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?= base_url('assets2/') ?>img/logo/logo.svg" alt="alt"> <img class="brk-header-mobile__logo-2 lazyload" src="<?= base_url('assets2/') ?>data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?= base_url('assets2/') ?>img/logo/logo.svg" alt="alt"></a></div>
			</div>
			<?php $this->load->view('templates/header_pages') ?>
		</main><br><br><br>
<br><br>


		<!-- gambar produk -->
	<section class="layer">
	  <div class="container">
		<div class="row">
			<div class="col-12">
				<div class="row">
					<div class="col-lg-8 ">
						<?= $this->session->flashdata('message'); ?>
			          <div class="designed-by">
			            <div class="row">
			            	 
				              <div class="col-md-6">
				            	 <a href="<?= base_url('profile/index/').str_replace(' ','_', $pemilik['name']) ?>"><img width="52" height="52"  src="<?= base_url('').$pemilik['lokasi'].$pemilik['image'] ?>" class="rounded-circle"></a>
				              	 <a href="<?= base_url('profile/index/').str_replace(' ','_', $pemilik['name']) ?>" style="display: inline-block;font-weight: bold;margin-top:14px;color: #666"><?= $pemilik['name'] ?></a>


				              </div>
				         
				              <div class="col-md-6  text-lg-right" style="background-color: ">
				         <!--        <a href="" style="float: right;display: inline-block;" class="mt-2">
				                	 <?= $produk['nama_barang'] ?></a>
				                <a href="" style="float: right;display: inline-block;" class="mt-2">
				                	<?= $produk['kategori'] ?>/</a>				     
				                <a href="<?= base_url('product/') . $produk['jenis'] ?>s" style="float: right;display: inline-block;" class="mt-2">
				                	<?= $produk['jenis'] ?>/</a>	 -->

								    <div class="breadcrumb-text product-more">
				                        <a href="<?= base_url() ?>"><i class="far fa-home mt-1"></i> Home</a>
				                        <a href="<?= base_url('product/') . $produk['jenis'] ?>s"> <?= $produk['jenis'] ?></a>
				                        <span><?= $produk['nama_barang'] ?></span>
				                    </div>	                	
				              </div>
				         </div>
				        </div>
					</div>
					<div class="col-lg-8"  style="background-color: ;margin-bottom: -44px;margin-right:-25px">
<!-- 						<a href="">
							<img src="img/55x55_2.jpg" class="rounded-circle">
							<a href="">Rudi</a>
						</a>
						<a href="" style="float: right;">dwaw</a> -->

						
						<div class="gambar">
					        <div id="myCarousel" class="carousel slide mb-5" data-ride="carousel">
								<ol class="carousel-indicators">
								   <?php if ($produk['gambar1']): ?>	
									<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
								   <?php endif ?>	 	
								   <?php if ($produk['gambar2']): ?>
									<li data-target="#myCarousel" data-slide-to="1"></li>
								   <?php endif ?>	
								   <?php if ($produk['gambar3']): ?>
								   	<li data-target="#myCarousel" data-slide-to="2"></li>
								   <?php endif ?>	
								   <?php if ($produk['gambar4']): ?>
								   	<li data-target="#myCarousel" data-slide-to="3"></li>
								   <?php endif ?>	
								   <?php if ($produk['gambar5']): ?>
								   	<li data-target="#myCarousel" data-slide-to="4"></li>
								   <?php endif ?>		
								</ol>

					          <div class="carousel-inner">
								<?php if ($produk['gambar1']): ?>
									<div class="carousel-item active">
										<img class="first-slide d-block img-fluid img-thumbnail" src="<?= base_url() ?><?= $produk['lokasi_gambar'].$produk['gambar1'] ?>" alt="First slide"   >
									</div>							
								<?php endif ?>		  	  
								<?php if ($produk['gambar2']): ?>
									<div class="carousel-item">
										<img class="second-slide d-block img-fluid img-thumbnail" src="<?= base_url() ?><?= $produk['lokasi_gambar'].$produk['gambar2'] ?>" alt="Second slide"   >
									</div>
								<?php endif ?>
								<?php if ($produk['gambar3']): ?>
									<div class="carousel-item">
										<img class="third-slide d-block img-fluid img-thumbnail" src="<?= base_url() ?><?= $produk['lokasi_gambar'].$produk['gambar3'] ?>" alt="Third slide"   >
									</div>
								<?php endif ?>
								<?php if ($produk['gambar4']): ?>
									<div class="carousel-item">
										<img class="fourth-slide d-block img-fluid img-thumbnail" src="<?= base_url() ?><?= $produk['lokasi_gambar'].$produk['gambar4'] ?>" alt="Fourth slide"   >
									</div>
								<?php endif ?>
								<?php if ($produk['gambar5']): ?>
									<div class="carousel-item">
										<img class="fifth-slide d-block img-fluid img-thumbnail" src="<?= base_url() ?><?= $produk['lokasi_gambar'].$produk['gambar5'] ?>" alt="Fifth slide"   >
									</div>
								<?php endif ?>
					          </div>

					          <a href="#myCarousel" class="carousel-control-prev" data-slide="prev">
					            <span class="carousel-control-prev-icon"></span>
					          </a>

					          <a href="#myCarousel" class="carousel-control-next" data-slide="next">
					            <span class="carousel-control-next-icon"></span>
					          </a>
					        </div>							
						</div>

			            <!-- </div> -->
			          <!-- </div>	 -->
			          					
					</div>
					<div class="col-lg-2  d-none d-md-block side  "  style="background-color: ;">
					<?php if ($produk['gambar1']): ?>
					<img src="<?= base_url() ?><?= $produk['lokasi_gambar'].$produk['gambar1'] ?>"  class=" img-fluid img-thumbnail mb-lg-1"  style="max-width: 137px" data-target="#myCarousel" data-slide-to="0">			
					<?php endif ?>
					<?php if ($produk['gambar2']): ?>
					<img src="<?= base_url() ?><?= $produk['lokasi_gambar'].$produk['gambar2'] ?>" class=" img-fluid img-thumbnail mb-lg-1"  style="max-width: 137px" data-target="#myCarousel" data-slide-to="1">
					<?php endif ?>
					<?php if ($produk['gambar3']): ?>
					<img src="<?= base_url() ?><?= $produk['lokasi_gambar'].$produk['gambar3'] ?>" class=" img-fluid img-thumbnail mb-lg-1"  style="max-width: 137px" data-target="#myCarousel" data-slide-to="2">
					<?php endif ?>
					<?php if ($produk['gambar4']): ?>
					<img src="<?= base_url() ?><?= $produk['lokasi_gambar'].$produk['gambar4'] ?>" class=" img-fluid img-thumbnail mb-lg-1"  style="max-width: 137px" data-target="#myCarousel" data-slide-to="3">	
					<?php endif ?>
					<?php if ($produk['gambar5']): ?>
					<img src="<?= base_url() ?><?= $produk['lokasi_gambar'].$produk['gambar5'] ?>"  class=" img-fluid img-thumbnail mb-lg-1 " style="max-width: 137px" data-target="#myCarousel" data-slide-to="4">	
					<?php endif ?>	

		
					
					</div>
				</div>
			</div>


		 <div class="col-lg-8 col-xs-12 " style="background-color:  ;margin-top:-9px;margin-right: -50px;margin-left:-10px">
		 	
		 	<div class="row" style="background-color:  ">
		 	 <?php if ($produk['file_gratis']): ?>
		 	 <div class="col-lg-3 col-xs-12 col-sm-6 free" style="background-color: ;">
			 	<a 
			 				<?php if ($this->session->userdata('email')): ?>
			 		             href="<?= base_url('Product/free_download/') . hashid($produk['id']) ?>"
			 		        <?php else: ?>
								 href="#" data-toggle="modal" data-target="#loginModal"
			 	            <?php endif ?>  

			 	 style="background-color: pink;color: white;width: " class="btn col-lg-4"><button >FREE VERSION  </button></a>
		 	 </div>
			 <?php endif ?>

			<?php if ($produk['file_dekstop']): ?>
	
	
		 	 <div class="col-lg-3 col-xs-12 col-sm-6 pl-lg-2" style="background-color: ;margin-right: -18px ">
			 	<?php if (!$this->db->get_where('transaksi_paypal',['id_barang' => $produk['id'],'email' => $this->session->userdata('email'),'jenis' => 'dekstop'])->row_array()): ?>
					<form action="<?=base_url('pembayaran/buy') ?><?php if(isset($_GET['referal']))echo '/'.$_GET['referal']; ?>" method="POST">
						<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">		

								<input type="hidden" name="name" value="<?= hashid($produk['id']) ?>">
								<input type="hidden" name="jenis" value="dekstop">



					 	<a ><button 
			 				<?php if ($this->session->userdata('email')): ?>
			 		             type="submit"
			 		        <?php else: ?>
								 type="button" data-toggle="modal" data-target="#loginModal"
			 	            <?php endif ?>  

					 		style="background-color: pink;color: white;" class="btn col-lg-4 pr-lg-2">DEKSTOP | $<?= $produk['harga_dekstop'] ?>&nbsp; <span style="border: 2px solid;float: right;width: 23px;background-color: #fad8d7 ">1</span></button></a>
					 	</form>
					 	<?php else: ?>
					 	<a href="<?= base_url('Product/dekstop_download/') . hashid($produk['id']) ?>" style="background-color: pink;color: white;" class="btn col-lg-4 pr-lg-2"><button >Download</button></a>
			      
			 	<?php endif ?>
		 	 </div>
			<?php endif ?>	

			
			<?php if ($produk['file_web']): ?>
		 	 <div class="col-lg-3 col-xs-12 col-sm-6" style="background-color: ;margin-right: -18px">
			   <?php if (!$this->db->get_where('transaksi_paypal',['id_barang' => $produk['id'],'email' => $this->session->userdata('email'),'jenis' => 'web'])->row_array()): ?>
				

				<form action="<?=base_url('pembayaran/buy') ?><?php if(isset($_GET['referal']))echo '/'.$_GET['referal']; ?>" method="POST">


				<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">		

						<input type="hidden" name="name" value="<?= hashid($produk['id']) ?>">
						<input type="hidden" name="jenis" value="web">



			 	<a ><button 
			 				<?php if ($this->session->userdata('email')): ?>
			 		             type="submit"
			 		        <?php else: ?>
								 type="button" data-toggle="modal" data-target="#loginModal"
			 	            <?php endif ?>  

			 	style="background-color: pink;color: white;width:" class="btn col-lg-4 " >WEB | $<?= $produk['harga_web'] ?> <span style="border: 2px solid;float: right;width: 23px;background-color: #fad8d7 ">1</span> </button></a>

			 	</form>
			  <?php else: ?>
				<a href="<?= base_url('Product/web_download/') . hashid($produk['id']) ?>" style="background-color: pink;color: white;width:" class="btn col-lg-4 "><button >Download </button></a>  	
			 
			  <?php endif ?>
			 
		 	 </div>
			<?php endif ?>

			<?php if ($produk['file_app']): ?>
		 	 <div class="col-lg-3 col-xs-12 col-sm-6" style="background-color: ;margin-right: -18px">
			   <?php if (!$this->db->get_where('transaksi_paypal',['id_barang' => $produk['id'],'email' => $this->session->userdata('email'),'jenis' => 'app'])->row_array()): ?>
				<form action="<?=base_url('pembayaran/buy') ?><?php if(isset($_GET['referal']))echo '/'.$_GET['referal']; ?>" method="POST">
				<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">		

						<input type="hidden" name="name" value="<?= hashid($produk['id']) ?>">
						<input type="hidden" name="jenis" value="app">



			 	<a ><button  

			 				<?php if ($this->session->userdata('email')): ?>
			 		             type="submit"
			 		        <?php else: ?>
								 type="button" data-toggle="modal" data-target="#loginModal"
			 	            <?php endif ?>  

			 	 style="background-color: pink;color: white;width:" class="btn col-lg-4 " >APP | $<?= $produk['harga_app'] ?> <span style="border: 2px solid;float: right;width: 23px;background-color: #fad8d7 ">1</span> </button></a>

			 	</form>
			  <?php else: ?>
				<a href="<?= base_url('Product/app_download/') . hashid($produk['id']) ?>" style="background-color: pink;color: white;width:" class="btn col-lg-4 "><button >Download </button></a>  	
			 
			  <?php endif ?>
			 
		 	 </div>
			<?php endif ?>
	
			<?php if ($produk['file_premium']): ?>
		 	 <div class="col-lg-3 col-xs-12 col-sm-6" style="background-color: ;margin-right: -18px">
			   <?php if (!$this->db->get_where('transaksi_paypal',['id_barang' => $produk['id'],'email' => $this->session->userdata('email'),'jenis' => 'premium'])->row_array()): ?>
				<form action="<?=base_url('pembayaran/buy') ?><?php if(isset($_GET['referal']))echo '/'.$_GET['referal']; ?>" method="POST">
				<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">		

						<input type="hidden" name="name" value="<?= hashid($produk['id']) ?>">
						<input type="hidden" name="jenis" value="premium">
			


			 	<a ><button  

			 				<?php if ($this->session->userdata('email')): ?>
			 		             type="submit"
			 		        <?php else: ?>
								 type="button" data-toggle="modal" data-target="#loginModal"
			 	            <?php endif ?>  
			 		 style="background-color: pink;color: white;width:" class="btn col-lg-4 " >PREMIUM | $<?= $produk['harga_premium'] ?> <span style="border: 2px solid;float: right;width: 23px;background-color: #fad8d7 ">1</span> </button></a>

			 	</form>
			  <?php else: ?>
				<a href="<?= base_url('Product/premium_download/') . hashid($produk['id']) ?>" style="background-color: pink;color: white;width:" class="btn col-lg-4 "><button >Download </button></a>  	
			 
			  <?php endif ?>
			 
		 	 </div>
			<?php endif ?>



		 	</div>

		 	

		</div>
		 <div class="col-lg-3" style="background-color: ;height: 100px">
		 	
	
		 		<div class="format" style="font-weight: bold;border: 1px solid;text-align: center">
					<ul>
						<li>FILE INCLUDES:<hr>
						<?= $produk['format_file'] ?></li>
					</ul>
				</div>

		 </div>


		</div>

		


	 </div>
	</section>



	<div class="container" >
	
			<!-- harga -->
		<div class="harga col-md-7 col-sm-12">
			<!-- share -->
			<div style=" padding-top: 10px;">
				<hr style="width: 100%">
				
				<div class="row">
					<div class="col-6 ">


					<p  style="float: left; color: #f4b3b3; line-height: 5px">
						<a href="<?= base_url('product/colection/').hashid($produk['id']) ?>" <?php if (!$this->session->userdata('email')): ?>data-toggle="modal" data-target="#loginModal"<?php endif ?> ><i class="far fa-heart fa-lg">&nbsp;<?= count($colection); ?></i></a>
						&nbsp;&nbsp;
						<a href="<?= base_url('product/like/').hashid($produk['id']) ?>" <?php if (!$this->session->userdata('email')): ?>data-toggle="modal" data-target="#loginModal"<?php endif ?>><i class="far fa-thumbs-up fa-lg" style=";margin-right: 20px;">&nbsp;<?= count($suka); ?></i></a>
					</p>
					<!-- <p>hai</p> -->

				</div>						
					<!-- </div> -->
					<div class="col-6 text-right">
				<div>
					<h5 class="d-none d-sm-inline" style="line-height: 14px; padding-top: 5px; margin-left: 20px; margin-right: 10px;display: inline">share & earn</h5>
					<?php if ($user['role_id'] == 2 || $user['role_id'] == 4): ?>
						
					
					
						<a href="#" onclick="shareWhatsapp('https://wa.me/?text=Name%20Product%3A%20<?= $produk['nama_barang']?>%0AType%3A%20<?= $produk['jenis'].'=>'.$produk['kategori']?>%0APrice%3A%20$<?= $produk['harga_dekstop']?>%0ALink%3A%20<?= base_url('product/detail/').str_replace(' ', '_',$produk['nama_barang']) ?>?referal=<?= $user['referal'] ?>')"><i class="fab fa-whatsapp fa-lg"></i></a>
						<!-- <a href="#"><i class="fab fa-instagram"></i></a> -->
						<a href="#" onclick="shareFacebook('http://www.facebook.com/sharer.php?u=<?= base_url('product/detail/').str_replace(' ', '_',$produk['nama_barang']) ?>?referal=<?= $user['referal'] ?>')"><i class="fab fa-facebook-square fa-lg"></i></a>
						<a href="#" onclick="sharetwitter('http://twitter.com/share?text=<?= $produk['nama_barang'] ?>:&url=<?= base_url('product/detail/').str_replace(' ', '_',$produk['nama_barang']) ?>?referal=<?= $user['referal'] ?>')"><i class="fab fa-twitter-square fa-lg"></i></a>
						<!-- <a href="#"><i class="fab fa-linkedin"></i></a> -->
						<!-- <a href="#"><i class="fab fa-behance-square"></i></a> -->

						<a href="#" onclick="sharepinterest('https://id.pinterest.com/pin/create/button/?url=<?= base_url('product/detail/').str_replace(' ', '_',$produk['nama_barang']) ?>?referal=<?= $user['referal'] ?>&description=<?= $produk['nama_barang']?>&media=<?= base_url() ?><?= $produk['lokasi_gambar'].$produk['gambar1'] ?>')"><i class="fab fa-pinterest fa-lg"></i></a>
				
					<?php else: ?>
					
						<a href="#" onclick="shareWhatsapp('https://wa.me/?text=Name%20Product%3A%20<?= $produk['nama_barang']?>%0AType%3A%20<?= $produk['jenis'].'=>'.$produk['kategori']?>%0APrice%3A%20$<?= $produk['harga_dekstop']?>%0ALink%3A%20<?= base_url('product/detail/').str_replace(' ', '_',$produk['nama_barang']) ?>')"><i class="fab fa-whatsapp fa-lg"></i></a>
						<!-- <a href="#"><i class="fab fa-instagram"></i></a> -->
						<a href="#" onclick="shareFacebook('http://www.facebook.com/sharer.php?u=<?= base_url('product/detail/').str_replace(' ', '_',$produk['nama_barang']) ?>')"><i class="fab fa-facebook-square fa-lg"></i></a>
						<a href="#" onclick="sharetwitter('http://twitter.com/share?text=<?= $produk['nama_barang'] ?>:&url=<?= base_url('product/detail/').str_replace(' ', '_',$produk['nama_barang']) ?>')"><i class="fab fa-twitter-square fa-lg"></i></a>
						<!-- <a href="#"><i class="fab fa-linkedin"></i></a> -->
						<!-- <a href="#"><i class="fab fa-behance-square"></i></a> -->

						<a href="#" onclick="sharepinterest('https://id.pinterest.com/pin/create/button/?url=<?= base_url('product/detail/').str_replace(' ', '_',$produk['nama_barang']) ?>&description=<?= $produk['nama_barang']?>&media=<?= base_url() ?><?= $produk['lokasi_gambar'].$produk['gambar1'] ?>')"><i class="fab fa-pinterest fa-lg"></i></a>
				


					<?php endif ?>

				</div>						
					</div>
				</div>


				<!-- <div> -->
					<!-- </div>  -->


			
				<hr style="width: 100%" class="mt-2">

			</div>
			
		</div>

	</div><br><br>

<?php if ($produk['jenis'] == 'Font'): ?>
	
<!-- <h1 class="tekan">tekan</h1> -->
<!-- deskripsi -->
<div class="container">
			    <h1 class="text-center">Preview Text</h1>	
         	<div class="row brk-form brk-form-strict"  data-brk-library="component__form">
			    <div class="col-xl-9  col-sm-6">
					   <!-- <label for="inputCity">Text Preview</label> -->
					   <input type="text" class="form-control" value="GraphicSuplement.com"  id="tulis">
				</div>
				<div class="col-xl-3 col-sm-6">

<!-- 						 <label for="formControlRange">Font Size</label>
						 <input type="range" class="form-control-range" min="24"  max="72" list="data" value="48" id="range">
						 <p id="ukuran">48px</p>

						 <datalist id="data">
							<option value="24" label="24"></option>
							<option value="36" label="36"></option>
							<option value="48" label="48"></option>
							<option value="72" label="72"></option>
						 </datalist> -->


						 			<div class="" id="tekan"><select name="select" id="range">
										<option value="24" id="tes">24px</option>
										<option value="36" id="tes" selected>36px</option>
										<option value="48" id="tes">48px</option>
										<option value="72" id="tes">72px</option>

									</select></div>
			    </div>
		    </div>
<!-- contoh font -->
	<!-- <p class="sakit">Font Sampler</p> -->
	<hr>
	<div class="row">
		<div class="col-12 scrollbar" style="overflow: scroll;height: 300px; width: auto;" id="style-1">
		<div class="font " style="height: auto; width: 2000px;" >
	<!-- <div style="height:100px; width: 1200px;">
	<p>	Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae quaerat aut, eius deleniti facere amet dolorum illum doloribus? Sequi, distinctio! Amet dolor minus ullam non? Distinctio perspiciatis dicta voluptate hic.
	Lorem ipsum dolor, sit amet consectetur adipisicing elit. Deserunt, repellendus facilis! Ex minima itaque distinctio dolorum ad nisi nulla culpa, enim exercitationem magni obcaecati error libero cum eum aliquam fugiat.	</p>
	</div> -->



		
	</div>
		</div>
	</div>

</div><br>
<?php endif ?>

<!-- product description -->
<section class="product-description mt-5">
	<div class="container">
		<div class="row">
			<div class="col-lg-9">
				<ul class="nav nav-tabs" id="myTab" role="tablist">
				  <li class="nav-item">
				    <a class="nav-link active" id="description-tab" data-toggle="tab" href="#description" role="tab" aria-controls="description" aria-selected="true">Description</a>
				  </li>
				  <li class="nav-item">
				    <a class="nav-link" id="review-tab" data-toggle="tab" href="#review" role="tab" aria-controls="review" aria-selected="false">Reviews(<?= count($komentar) ?>)</a>
				  </li>
				</ul>
				<div class="tab-content p-3" id="myTabContent">

						<div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
							<p style="white-space:pre-line;"><?= $produk['deskripsi'] ?></p>
						</div>
					  
				  	<div class="tab-pane fade " id="review" role="tabpanel" aria-labelledby="review-tab">
						<!-- <div class="row"> -->
							<div class=" product-review scrollbar" id="style-1">

							 <?php foreach ($komentar as $komen): ?>
								<div class="media mb-3 mt-2">
								<img class="d-flex rounded-circle avatar z-depth-1-half mr-3" src="<?= base_url().$komen['gambar'] ?>"
									alt="Avatar">
								<div class="media-body">
									<h5 class="mt-0 font-weight-bold blue-text">
									<?= $komen['nama'] ?> 
									<?php if ($komen['tipe'] == 'pembeli'): ?>
										<sup class="text-white bg-success rounded">&nbsp;Purchase&nbsp;</sup>
									<?php elseif ($komen['tipe'] == 'desainer'): ?>
										<sup class="text-white bg-warning rounded">&nbsp;Designer&nbsp;</sup>
									<?php else: ?>
										<sup class="text-white bg-secondary rounded">&nbsp;vistor&nbsp; </sup>
									<?php endif ?>
									</h5>
									<p><?= $komen['review'] ?></p>
									


								</div>
								</div>
							 <?php endforeach ?>

							</div>
						<!-- </div> -->

						
						<div class="brk-forum-redactor brk-form-strict   pl-xs-0" data-brk-library="component__form,component__forum_main">
						<form  action="<?= base_url('product/komentar') ?>" method="POST">
						<textarea name="review" placeholder="Write your comment" required></textarea>
						<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
						<input type="hidden" name="id" value="<?= $produk['id'] ?>">

						
						<button class="btn btn-prime btn-lg font__family-montserrat d-block mx-auto mt-3 font__weight-light btn-min-width-200"
						 <?php if ($this->session->userdata('email')): ?>
						 	data-toggle="modal" data-target="#loginModal" 
						 	type="submit"
						 <?php else: ?>
						 	data-toggle="modal" data-target="#loginModal" 
							type="button"	
						 <?php endif ?>
						 

						  data-brk-library="component__button">
							<span class="before"></span><span class="after"></span><span class="border-btn"></span>
							comment
						</button>
						</form>
					   </div>	



						







					</div>


				</div>
			</div>
		</div>
	</div>
</section>
<div style="height: 100px">

</div>
<!-- produk serupa -->
		
<!-- prev next -->

</div>

	<?php $this->load->view('templates/footer_pages') ?>

	<script src="<?= base_url('assets2/')?>js/jquery-3.2.1.min.js"></script>
	<script src="<?= base_url('assets2/')?>js/scripts.min.js"></script>
	<script src="<?= base_url('assets2/')?>js/auth.js"></script>

	
	<script>


	 var nilai = $('#tulis').val();
	 

          $.ajax({
              url: '<?=base_url('product/render/').$produk['id_barang'] ?>?s='+nilai,
              
              method: 'GET',
              success : function(data){
		    			// if (data.success) {
							var dir = "<?= base_url('renderingfont/') .ip().'/' ?>";
							var fileextension = ".png";
							$.ajax({
								//This will retrieve the contents of the folder if the folder is configured as 'browsable'
								url: dir,
								success: function (data) {
									//List all .png file names in the page
						

									$('.link').remove();
									$('.link1').remove();
									$(data).find("a:contains(" + fileextension + ")").each(function () {
										var filename = this.href.replace(window.location, "").replace("product/detail/", "renderingfont/<?= ip().'/' ?>");
										// alert(filename);
										$(".font").append("<img class='link' src='"+filename+"'><hr class='link1'>");
									});
								}
							});			    					
		    			// }
              }
           });

 




var idi = $('#range').val();
$('#tekan').on('click',function(){

               var id = $('#range').val();
               var idi = $('#ren').val();
               $('#ren').val(id);
               // var id2 = $('#tes').val();

               if (id !== idi) {
 				var nilai = $('#tulis').val();
	 

					$.ajax({
						url: '<?=base_url('product/render/').$produk['id_barang'] ?>/'+id+'?s='+nilai,
						
						method: 'GET',
						dataType:'json',
						success : function(data){
						// console.log(data.success);
		    //           	alert(data.success);
		    			if (data.success) {
							var dir = "<?= base_url('renderingfont/'.ip().'/') ?>";
							var fileextension = ".png";
							$.ajax({
								//This will retrieve the contents of the folder if the folder is configured as 'browsable'
								url: dir,
								success: function (data) {
									//List all .png file names in the page
						

									$('.link').remove();
									$('.link1').remove();
									$(data).find("a:contains(" + fileextension + ")").each(function () {
										var filename = this.href.replace(window.location, "").replace("product/detail/", "renderingfont/<?= ip().'/' ?>");
										// alert(filename);
										$(".font").append("<img class='link' src='"+filename+"'><hr class='link1'>");
									});
								}
							});			    					
		    			}

						}
					});              	
               }


});











 	$('#tulis').on('keyup',function(){

	      var nilai = $('#tulis').val();
	      let id = $('#range').val();

          $.ajax({
              url: '<?=base_url('product/render/').$produk['id_barang'] ?>/'+id+'?s='+nilai,
              // data,
              method: 'GET',
              dataType:'json',
              success : function(data){
		    			if (data.success) {
							var dir = "<?= base_url('renderingfont/'.ip().'/') ?>";
							var fileextension = ".png";
							$.ajax({
								//This will retrieve the contents of the folder if the folder is configured as 'browsable'
								url: dir,
								success: function (data) {
									//List all .png file names in the page
						

									$('.link').remove();
									$('.link1').remove();
									$(data).find("a:contains(" + fileextension + ")").each(function () {
										var filename = this.href.replace(window.location, "").replace("product/detail/", "renderingfont/<?= ip().'/' ?>");
										// alert(filename);
										$(".font").append("<img class='link' src='"+filename+"'><hr class='link1'>");
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


     	 	function shareWhatsapp(url)
    {
    	 window.open(url,'_blank');
    	// win.focus();
    } 

        	function sharepinterest(url)
    {
    	 window.open(url,'_blank');
    	// win.focus();
    } 
            function sharetwitter(url)
    {
    	 window.open(url,'_blank');
    	// win.focus();
    } 
	</script>
</body>
</html



