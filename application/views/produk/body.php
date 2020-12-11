<?php $this->load->view('card/card-promo-header') ?>  
<?php $this->load->view('card/search') ?>  


<div class="container mt-4">
        <?php $this->load->view('card/promo'); ?>

        <div class="text-center">
          <?php if ($periksa == 'w'): ?>
          <h1 class="mt-5 mb-0 " style="font-size: 27px;color: #37363C;">MY WISHLIST</h1>
          <?php else: ?>
          <h1 class="mt-5 mb-0 " style="font-size: 27px;color: #37363C;">POPULAR PRODUCTS</h1>
          <a href="" class="text-decoration-none " style="font-size: 14px;color: #999;" >POPULER FONTS</a>

          <?php endif ?>
        </div>

        
      <div class="row justify-content-center">
        <?php $this->load->view('card/index'); ?>    
      </div> 


 </div>

      <div class="col-12 mt-5 ">
        <section class="">
          <?= $this->pagination->create_links(); ?>
        </section>
      </div>





