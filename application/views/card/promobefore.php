        <div class="row text-center justify-content-center">
          <?php if ($this->session->userdata('email')) : ?>
              
              <?php if ($user['role_id'] < 4): ?>
              <?php if ($user['role_id'] != 3): ?>
              <div class="col-4 col-sm-4 col-md-3 col-lg-2">
                <a href="<?=base_url('designer/registration') ?>">
                <img src="<?= base_url('assets2/') ?>img/logo/open-shop.svg" class="d-none d-sm-inline">
                <img src="<?= base_url('assets2/') ?>img/logo/open-shop-mobile.svg" class="d-sm-none d-inline img-fluid">
                </a>
              </div>                
              <?php endif ?>
               <?php if ($user['role_id'] != 2 && $user['referal'] != ''): ?>
                  <div class="col-4 col-sm-4 col-md-3  <?php if ($user['role_id'] == 3): ?>
                      col-lg-2
                   <?php else: ?>
                      col-lg-3
                  <?php endif ?>">
                  <a href="<?=base_url('affiliation/registration') ?>">
                    <img src="<?= base_url('assets2/') ?>img/logo/share-earn.svg" class="d-none d-sm-inline ">
                    <img src="<?= base_url('assets2/') ?>img/logo/share-earn-mobile.svg" class="d-sm-none d-inline img-fluid ">
                  </a>
                  </div>                         
                <?php endif ?> 
         
              <?php endif ?>


              <div class="col-4 col-sm-4 col-md-3 col-lg-2">
                <a href="<?=base_url('credit') ?>">
                <img src="<?= base_url('assets2/') ?>img/logo/purchase-creadit.svg" class="d-none d-sm-inline">
                <img src="<?= base_url('assets2/') ?>img/logo/purchase-creadit-mobile.svg" class="d-sm-none img-fluid d-inline ">
                </a>
              </div>

          <?php else: ?>
               <div class="col-4 col-sm-4 col-md-3 col-lg-2">
                <a style="cursor: pointer;" <?php if ($this->session->userdata('email')): ?> href="<?=base_url('designer/registration') ?>"  <?php else: ?> data-toggle="modal" data-target="#loginModal"<?php endif ?>>
                <img src="<?= base_url('assets2/') ?>img/logo/open-shop.svg" class="d-none d-sm-inline">
                <img src="<?= base_url('assets2/') ?>img/logo/open-shop-mobile.svg" class="d-sm-none d-inline img-fluid">
                </a>
              </div>
              <div class="col-4 col-sm-4 col-md-3 col-lg-3">
                <a style="cursor: pointer;" <?php if ($this->session->userdata('email')): ?> href="<?=base_url('affiliation/registration') ?>"  <?php else: ?> data-toggle="modal" data-target="#loginModal"<?php endif ?>>
                <img src="<?= base_url('assets2/') ?>img/logo/share-earn.svg" class="d-none d-sm-inline ">
                <img src="<?= base_url('assets2/') ?>img/logo/share-earn-mobile.svg" class="d-sm-none d-inline img-fluid ">
                </a>
              </div>
              <div class="col-4 col-sm-4 col-md-3 col-lg-2">
                <a style="cursor: pointer;" <?php if ($this->session->userdata('email')): ?> href="<?=base_url('products') ?>"  <?php else: ?> data-toggle="modal" data-target="#loginModal"<?php endif ?>>
                <img src="<?= base_url('assets2/') ?>img/logo/purchase-creadit.svg" class="d-none d-sm-inline">
                <img src="<?= base_url('assets2/') ?>img/logo/purchase-creadit-mobile.svg" class="d-sm-none img-fluid d-inline ">
                </a>
              </div>               
          <?php endif ?>


        </div>