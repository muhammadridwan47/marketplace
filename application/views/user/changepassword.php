

    

    

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
            
            <div class="row">
              <div class="col-lg-6">
                <?= $this->session->flashdata('message'); ?>
                
                <form action="<?= base_url('user/changepassword'); ?>" method="POST">
                  <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                     <div class="form-group">
                         <label for="current_password">Current Password</label>
                         <input type="password" name="current_password" class="form-control" id="current_password" >
                         <?= form_error('current_password','<small class="text-danger pl-3">','</small>') ?>
                     </div>
                     <div class="form-group">
                         <label for="new_password1">new Password</label>
                         <input type="password"  name="new_password1" class="form-control" id="new_password1">
                          <?= form_error('new_password1','<small class="text-danger pl-3">','</small>') ?>
                     </div>
                     <div class="form-group">
                         <label for="new_password2">Repeart Password</label>
                         <input type="password"  name="new_password2" class="form-control" id="new_password2" >
                          <?= form_error('new_password2','<small class="text-danger pl-3">','</small>') ?>
                     </div>
                     <div class="form-group">
                          <a href="<?=base_url('user') ?>" class="btn btn-success">Previus</a>
                          
                          <button type="submit" class="btn btn-primary">Change Password</button>
                         
                     </div>
                </form>

              </div>
            </div>
         
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      