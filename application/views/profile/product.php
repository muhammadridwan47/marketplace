

<?php $this->load->view('templates/header_pages') ?>

<section class="my-profile mt-5" style="margin-bottom: 200px">

<div class="container ">

  <div class="row justify-content-end ">
    <div class="col-md-11">
      <div class="menu-profile">
      <a href="<?= base_url('profile') ?>"> <button class="btn rounded-0 text-white" style="">My Profile</button></a>
      <a href="<?= base_url('auth/reset') ?>"><button class="btn rounded-0 text-white" style="">Password</button></a>
      <?php if ($user['role_id'] >= 3): ?>
      <a href="<?= base_url('profile/myshop') ?>"><button class="btn rounded-0 text-white" style="">My Shop</button></a>
      <a href="<?= base_url('profile/sale') ?>"><button class="btn rounded-0 text-white sale d-none d-md-inline" >Sale & Payout</button></a>
        <button class="btn rounded-0 text-white sale d-none d-md-inline" style="background:#CACBCB">My Products</button>
        <a class="d-none d-md-inline" href="<?= base_url('upload') ?>"><button class="btn rounded-0 text-white sale"  >Add Product</button></a>
      <?php endif ?>
      </div>
     
     


          <p class="mt-5" style="font-size: 20px;color:#3C4146">My Products</p>
          <table class="table-responsive-md" border="0" style="width:100%;" >
              <thead >
                  <tr  class="text-center heading-tr" >
                      <th style="min-width: 100px;">UPLOADED</th>
                      <th class=" text-left ml-3" style="min-width: 200px;float: left;">PRODUCTS</th>
                      <th>CATEGORY</th>
                      <th>VIEWS</th>
                      <th>LIKES</th>
                      <th>SOLD</th>
                      <th>PRICE</th>
                      <!-- <th style="min-width: 70px;">SHOP CUT</th> -->
                      <th>EARNING</th>
                      <th></th>
                  </tr>
                  <tr class="margin-bottom"></tr>
              </thead>
              <tfoot >
                  <tr class="margin"></tr>
                  
                  <tr class="none">
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                  </tr>
              </tfoot>
              
              <tbody >

              <?php foreach ($product as $pro): ?>
                <?php 
                  $transaksi = $this->db->get_where('transaksi_paypal',['id_barang' => $pro['id'],'pemilik' => $pro['email']])->result_array();
                  $customer = $this->db->get_where('user',['email' => $pro['email']])->row_array();
                  $email = $user['email'];
                  $id_barang = $pro['id'];
                  $earning = $this->db->query("SELECT SUM(harga) FROM transaksi_paypal WHERE pemilik = '$email' AND id_barang = '$id_barang'")->result_array();
                  ?>

                <tr class="text-center" >
                      <td class="" ><?= date('d/m/Y',$pro['tanggal_upload']) ?></td>
                      <td class="text-left"><?= $pro['nama_barang'] ?></td>
                      <td><?= $pro['kategori'] ?></td>
                      <td><?=  count($this->db->get_where('view',['id_barang' => $pro['id']])->result_array()) ?></td>
                      <td><?=  count($this->db->get_where('colection',['id_barang' => $pro['id']])->result_array()) ?></td>
                      <td><?=  count($this->db->get_where('transaksi_paypal',['id_barang' => $pro['id'],'pemilik' => $email])->result_array()) ?></td>
                      <td>$
                          <?php if ($pro['jenis'] == 'Font'): ?>
                             <?= $pro['harga_dekstop'] ?>
                          <?php else : ?>
                            <?= $pro['harga_premium'] ?>
                          <?php endif ?>
                        </td>
                      <td>$ 
                      <?= $earning[0]['SUM(harga)'] / 2?> 
                      </td>
                      <td>
                
                      <?php if ($pro['daily_deal'] == 0): ?>

                         <?php if ($user['role_id'] == 5): ?>
                         <form action="<?= base_url('upload/daily') ?>" method="POST" class="d-inline"> 
                         <input type="hidden" name="n" value="<?= hashid($pro['id']); ?>">
                         <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>"> 
                         <button type="submit" class="btn btn-sm btn-info rounded-0" style="height: 20px; padding:0px;padding-bottom:20px !important;width:49.57px">Live</button>
                         </form>
                         <?php endif ?>
                      
                      <?php else : ?>
                        <?php if ($user['role_id'] == 5): ?>
                          <a href="#"><button type="submit" class="btn btn-sm btn-danger rounded-0" style="height: 20px; padding:0px;padding-bottom:20px !important;width:49.57px">OFF</button> </a> 
                        <?php endif ?>
                      <?php endif ?>

                         <a href="<?= base_url('upload/edit/').str_replace(' ', '_', $pro['id_barang']);  ?>"><button type="submit" class="btn btn-sm btn-success rounded-0" style="height: 20px; padding:0px;padding-bottom:20px !important;width:49.57px">Edit</button> </a>   
                        <!-- </form> -->
                        <form action="<?= base_url('upload/deletefile') ?>" method="POST" class="d-inline"> 
                          <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">  
                          <input type="hidden" name="n" value="<?= hashid($pro['id']); ?>">
                          &nbsp;<button type="submit" class="btn btn-sm btn-danger rounded-0" style="height: 20px; padding:0px;padding-bottom:20px !important;width:49.57px" onclick="return confirm('Apakah yakin')">Delete</button>
                          </form>
                      </td>
                  </tr>
             <?php endforeach ?>
             
              </tbody>


          </table>


       </div>
   </div>
  </div>
  </div>

</div>

</section>




<?php $this->load->view('templates/footer_pages') ?>


<script>

var vPortWidth  = $(window).width();
  
  if (vPortWidth <= 575) {
      location.replace('<?= base_url('profile') ?>');
  }
</script>