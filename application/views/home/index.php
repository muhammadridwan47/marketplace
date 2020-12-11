<?php $this->load->view('templates/header_pages') ?> 
<?php $this->load->view('card/card-promo-header') ?>  
<?php $this->load->view('card/search') ?>  


<div class="container mt-4">
      <?php $this->load->view('card/promo'); ?>

      <div class="text-center">
        <h1 class="mt-5 mb-0 " style="font-size: 27px;color: #37363C;">POPULAR PRODUCTS</h1>
        <a href="" class="text-decoration-none " style="font-size: 14px;color: #999;" >POPULAR FONTS</a>
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



<?php $this->load->view('templates/footer_pages') ?>




