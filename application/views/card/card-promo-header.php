<?php 

  $data = $this->db->get_where('product',['daily_deal'=> '1'])->row_array();
  $bio = $this->db->get_where('user',['email'=> $data['email']])->row_array();

  // var_dump($data);

?>

<div class="container promo-container ">
      <div class="row justify-content-center">
          <div class="col-12 col-md-5 first-card" >

            <div class="card-promo rounded-0 border-0" >
                  <div class="row">
                    <div class="col-12 mb-5">
                      
                        <div class="float-sm-right promo-daily text-center">
                          <h5 class="text-right d-inline align-middle">DAILY DEAL 
                          </h5>
                          <span class="text-white d-inline-block text-center ml-2 time hour">0</span>
                          <span class="text-white d-inline-block text-center time minute">0</span> 
                          <span class="text-white d-inline-block text-center time-3 second">0</span>
                        </div>
                        <div style="clear:right"></div>
                        <div style="position:relative;height: 0;padding-bottom: 68.894%;overflow: hidden;">
                        <?php if ($data): ?>
                          <img src="<?=base_url() ?><?= $data['lokasi_gambar'] ?><?= $data['imagecard'] ?>" class="card-img-top">
                        
                        <?php else: ?>
                          <img src="<?= base_url('assets2/') ?>img/logo/improve/promo.jpg" class="card-img-top">
                        <?php endif ?>  
                             <input type="hidden" class="wtk" value="<?= $data['waktu_daily'] ?>">
                              <div class="icon-promo">
                                <div class="row" >

                                  <div class="col-9 ">
                                    <a href="<?= base_url('product/detail/') . str_replace(' ', '_', $data['nama_barang']) ?>" class="d-flex" style="height: 100%;width:100%"></a>
                                  </div>
                                  <div class="col-3 text-right">

                                    <a  class="love-promo d-inline-block mb-2 position-relative" ><img src="<?= base_url('assets2/') ?>img/logo/improve/love.svg" ><br> <center><?=  count($this->db->get_where('colection',['id_barang' => $data['id']])->result_array()) ?></center></a>
                                    <br>
                                    <a  class="like-promo d-inline-block mb-2" ><img src="<?= base_url('assets2/') ?>img/logo/improve/like.svg" > <br> <center><?=  count($this->db->get_where('suka',['id_barang' => $data['id']])->result_array()) ?></center></a>
                                    <a href="#" class=" d-block copy " style="margin-right:10px;cursor:pointer"  data-clipboard-text="<?= base_url('product/detail/'). str_replace(' ', '_', $data['nama_barang'])  ?>"><img src="<?= base_url('assets2/') ?>img/logo/improve/share.svg" ></a>


                                  </div>
                                </div>
                              </div>
                        </div>

                         <div class="row information-promo-create">
                            <div class="col-6" >
                            <?php if ($data['nama_barang']): ?>
                              <h5><?= $data['nama_barang'] ?></h5>
                            <?php else: ?>
                              <h5>Time up</h5>
                            <?php endif ?>
                              <h6 style="color:#999;">by <a href="<?= base_url('designer/profile/').str_replace(' ', '_', $bio['username']) ?>" style="color:#424343;"><?= $bio['username'] ?></a> in <a href="<?= base_url('product/').$data['jenis'] ?>s" style="color:#424343;"><?= $data['jenis'] ?></a></h6>
                            </div>
                            <div class="col-6">
                                <div class="text-center float-right price" >
                                  <span class="d-inline-block mt-1">
                                  <?php if ($data['daily_deal'] == 1): ?>
                                   $<?php if ($data['harga_dekstop']): ?><?= $data['harga_dekstop'] / 2 ?> <?php else: ?><?= $data['harga_premium'] / 2 ?>  <?php endif ?> 
                                  <?php else: ?>
                                    $<?= '0' ?>
                                  <?php endif ?>
                                  </span>
                                </div>
                            </div>
                      
                          </div> 


                    </div>
                  </div>
                    
            </div>

          </div>
          <div class="col-12  col-md-5">

            <div class="card-promo rounded-0 border-0">
              <div class="row">
                <div class="col-12">
                  
                    <div class="float-sm-left promo-weekly text-center">
                      <h5 class="text-right align-middle d-inline d-sm-none mr-2" >WEEKLY DEAL</h5>
                      <span class="text-white d-inline-block text-center time" > 59</span>
                      <span class="text-white d-inline-block text-center time" > 59</span> 
                      <span class="text-white d-inline-block text-center time mr-2" > 23</span>
                      <h5 class="text-right align-middle d-none d-sm-inline" style="display: inline;">WEEKLY DEAL</h5>
                    </div>
                  <div style="clear:left"></div>
                  <div class="" style="position:relative;height: 0;padding-bottom: 68.894%;overflow: hidden;">
                   <img src="<?= base_url('assets2/') ?>img/logo/improve/promo.jpg" class="card-img-top">
                   <div class="icon-promo">
                    <div class="row" >
                    <div class="col-9 ">
                                <a href="" class="d-flex" style="height: 100%;width:100%"></a>
                              </div>
                              <div class="col-3 text-right">

                                <a  class="love-promo d-inline-block mb-2 position-relative" ><img src="<?= base_url('assets2/') ?>img/logo/improve/love.svg" ><br> <center>100</center></a>
                                <br>
                                <a  class="like-promo d-inline-block mb-2" ><img src="<?= base_url('assets2/') ?>img/logo/improve/like.svg" > <br> <center>100</center></a>
                                <a href="#" class=" d-block" style="margin-right:10px"><img src="<?= base_url('assets2/') ?>img/logo/improve/share.svg" ></a>


                              </div>
                    </div>
                  </div>


                  </div>
                  <div class="row information-promo-create">
                      <div class="col-6" >
                        <h5>Product Name</h5>
                        <h6>by Designer in Font</h6>
                      </div>
                      <div class="col-6">
                          <div class="text-center float-right price">
                            <span class="d-inline-block mt-1">$999</span>
                          </div>
                      </div>
                  </div>


                </div>
              </div>
            </div>

          </div>
      </div>
  </div>




 