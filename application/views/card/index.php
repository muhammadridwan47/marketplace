<div class="col-sm-12 col-md-11 col-lg-10  ">

<div class="row  mt-3  row-card ">


<?php


$i = 1 + $start;
 foreach ($produk as $pro): ?>
          
<?php
  

  $hasil = $this->db->get_where('user',['email'=>$pro['email']])->row_array();

  ?> 

     <div class="col-sm-6 col-md-5 col-lg-4 owl-card   card-product ">
      <div class=" border-0">
        <div class="row">
          <div class="col-12">              
            <div class="shadow-sm" style="position: relative;height: 0;padding-bottom: 66.894%;overflow: hidden;">
            <a href="<?= base_url('product/detail/') . str_replace(' ', '_', $pro['nama_barang']) ?>">
            <img src="<?=base_url() ?><?= $pro['lokasi_gambar'] ?><?= $pro['imagecard'] ?>" class="img-fluid card-img-top">
            </a>
            <div class="icon-card">
              <a href="">
                <div class="row" >
                      <div class="col-9 ">
                        <a href="<?= base_url('product/detail/') . str_replace(' ', '_', $pro['nama_barang']) ?>" class="d-flex" style="height: 100%;width:100%"></a>
                        </div>
                        <div class="col-3 text-right" style="transform: translateY(-35px);">
                          <a  class="love-card d-none d-sm-inline-block  mb-2 position-relative" ><img src="<?= base_url('assets2/') ?>img/logo/improve/love-card.svg" ><br> <center><?=  count($this->db->get_where('colection',['id_barang' => $pro['id']])->result_array()) ?></center></a>
                          <a  class="love-card  d-inline-block d-sm-none mb-2 position-relative" ><img src="<?= base_url('assets2/') ?>img/logo/improve/love-card.svg" ><br> <center><?=  count($this->db->get_where('colection',['id_barang' => $pro['id']])->result_array()) ?></center></a>
                          <br>
                          <a  class="like-card d-none d-sm-inline-block mb-2" ><img src="<?= base_url('assets2/') ?>img/logo/improve/like-card.svg" > <br> <center><?=  count($this->db->get_where('suka',['id_barang' => $pro['id']])->result_array()) ?></center></a>
                          <a  class="like-card d-inline-block d-sm-none mb-2" ><img src="<?= base_url('assets2/') ?>img/logo/improve/like-card.svg" > <br> <center><?=  count($this->db->get_where('suka',['id_barang' => $pro['id']])->result_array()) ?></center></a>
                          <a  class=" d-sm-none d-block copy" style="margin-right:10px;cursor:pointer" data-clipboard-text="<?= base_url('product/detail/'). str_replace(' ', '_', $pro['nama_barang'])  ?>"><img src="<?= base_url('assets2/') ?>img/logo/improve/share-card.svg" ></a>
                          <a  class="d-none d-sm-block copy " style="margin-right:10px;cursor:pointer"  data-clipboard-text="<?= base_url('product/detail/'). str_replace(' ', '_', $pro['nama_barang'])  ?>"><img src="<?= base_url('assets2/') ?>img/logo/improve/share-card.svg" ></a>
                        </div>
                </div>
              </div>
              
            </div>
            <div class="row information-card">
                <div class="col-9" >
                  <h5><div class="d-inline d-sm-none"><?= $i++; ?>. </div><?= $pro['nama_barang'] ?></h5>
                  <h6>by <a href="<?= base_url('designer/profile/').str_replace(' ', '_', $hasil['username']) ?>"><?= $hasil['username'] ?></a> in <a href="<?= base_url('product/').$pro['jenis'] ?>s"><?= $pro['jenis'] ?></a></h6>
                </div>
                <div class="col-3">
                    <div class="text-center float-right price">
                      <span class="d-inline-block mt-1">
                                  <?php if ($pro['daily_deal'] == 1): ?>
                                   $<?php if ($pro['harga_dekstop']): ?><?= $pro['harga_dekstop'] / 2 ?> <?php else: ?><?= $pro['harga_premium'] / 2 ?>  <?php endif ?> 
                                  <?php else: ?>
                                    $<?php if ($pro['harga_dekstop']): ?><?= $pro['harga_dekstop'] ?> <?php else: ?><?= $pro['harga_premium'] ?>  <?php endif ?>
                                  <?php endif ?>
                      </span>
                    </div>
                </div>
            </div>
           
          </div>
        </div>
      </div>
    </div>

    <?php endforeach ?>

</div>

</div>




