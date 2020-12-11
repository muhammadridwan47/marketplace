

<?php $this->load->view('templates/header_pages') ?>

<section class="my-profile mt-5" style="margin-bottom: 200px">

<div class="container ">

  <div class="row justify-content-end ">
    <div class="col-md-11">
      <div class="menu-profile">
      <a href="<?= base_url('profile') ?>"> <button class="btn rounded-0 text-white" style="">My Profile</button></a>
      <a href="<?= base_url('auth/reset') ?>"><button class="btn rounded-0 text-white" style="">Password</button></a>
      <button class="btn rounded-0 text-white sale d-none d-md-inline" style="background:#CACBCB">Sale & Payout</button>

      <!-- <?php if ($user['role_id'] >= 3): ?>
      <a href="<?= base_url('profile/myshop') ?>"><button class="btn rounded-0 text-white" style="">My Shop</button></a>
        <a href="<?= base_url('profile/product') ?>"><button class="btn rounded-0 text-white sale d-none d-md-inline" >My Products</button></a>
        <a class="d-none d-md-inline" href="<?= base_url('upload') ?>"><button class="btn rounded-0 text-white sale"  >Add Product</button></a>
      <?php endif ?> -->
      </div>
     
     


   <div class="row mt-4">
       <div class="col-12">
<!-- <input type="date"> -->

          <div class="row ">
              <div class="col-sm-6">
                  <form action="" method="POST" class="period-date mt-3">
                  <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                    <button class="btn period rounded-0 text-white" type="submit" name="period">PERIOD</button>
                    <input type="text" class="col-12" name="period1"  placeholder="&nbsp; dd/mm/yy" onfocus="(this.type='date')"
        onblur="(this.type='text')" >
                    <span>to</span>
                    <input type="text" class="col-12" name="period2" placeholder="&nbsp; dd/mm/yy" onfocus="(this.type='date')"
        onblur="(this.type='text')">
                  </form>
              </div>
              <div class="col-sm-6" >

              <section class="section-balance ">
              
               <div class="bungkus " style="">
                  <div class=" mb-2 mt-3 balance">
                      <div class="text-white  d-block-inline text-center float-left" style="">
                        <span>BALANCE</span>
                      </div>
                      <input class="text-right" type="text" readonly placeholder="$<?= $balance[0]['SUM(harga)'] / 4 ?>" value="$<?= $balance[0]['SUM(harga)'] / 4?> " >
                  </div>
                  <div class=" mb-3 balance">
                      <div class="text-white  d-block-inline text-center float-left" style="">
                        <span>PAYOUT</span>
                      </div>
                      <input class="text-right" type="text" style="" placeholder="$ 500"  >
                      <button class="btn text-white submit ml-3 rounded-0">SUBMIT</button>
                  </div>
              </div>
              </section>

              </div>
          </div>


          <table class="mt-2 table-responsive-md" border="0" style="width:100%;" >
              <thead >
                  <tr  class="text-center heading-tr" >
                      <th style="min-width: 100px;">DATE SOLD</th>
                      <th class=" text-left ml-3" style="min-width: 200px;float: left;">PRODUCT</th>
                      <th>CUSTOMER</th>
                      <th>LICENSE</th>
                      <th>EARNING</th>
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
                  </tr>
              </tfoot>
              
              <tbody >

              <?php foreach ($transaksi as $tran): ?>
                <?php $customer = $this->db->get_where('user',['email' => $tran['email']])->row_array(); ?>
                  <tr class="text-center" >
                      <td class="" ><?= date('d/m/Y',$tran['tanggal']) ?></td>
                      <td class="text-left"><?= $tran['nama_barang'] ?></td>
                      <td><?= $customer['name'] ?></td>
                      <td><?= $tran['jenis'] ?></td>
                      <td>$ <?= $tran['harga'] / 4 ?></td>
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