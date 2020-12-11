


<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

    <!-- My CSS -->
      <style>
        body {
            margin-top: 50px;
        }

        .jumbotron img {
            width: 25%;
        }

        section {
            min-height: 420px;
        }

        footer {
            min-height: 50px;
            padding-top:12px;
        }
        .display-4{
          color: #fff;
        }
        .lead{
          color: #fff;
        }
        .navlist{
          background-color: #fff;
          height: 300px;
          overflow: scroll;
          box-shadow: 0 4px 5px rgba(0, 0, 0, 0.1);
        }
        .iconhati{
          float: right;
          color: #f4b3b3;
        }
        /*css punya form update*/
        .gaya{
          height: 400px;
          overflow: scroll;
          box-shadow: 0 4px 5px rgba(0, 0, 0, 0.2);
          padding: 10px;
        }      
    </style>

    <title>Edit profile</title>
  </head>
  <body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <!-- <a class="navbar-brand" href="#home">Desainer name</a> -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="<?= base_url() ?>">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#about">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#portfolio">Portfolio</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>


    <div class="jumbotron" id="home" style="background-image: url('<?= base_url() . $profile['lokasi'].$profile['background'] ?>'); background-repeat: no-repeat;">
      <div class="container">
        <div class="text-center">
          <img src="<?= base_url() . $profile['lokasi'].$profile['image'] ?>" class="rounded-circle img-thumbnail"><br>
          <h1 class="display-4"><?= $profile['name'] ?></h1>
          <h3 class="lead"><?= $profile['job'] ?></h3>
        </div>
      </div>
    </div>

    <!-- Contact -->
    <section class="contact" id="contact">
      <div class="container pb-3">
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <?php if ($profile['role_id'] > 3): ?>
            <li class="nav-item">
              <a class="nav-link active" id="progres-tab" data-toggle="tab" href="#progres" role="tab" aria-controls="progres" aria-selected="true">Progres</a>
            </li>              
            <?php endif ?>



            <li class="nav-item">
              <a <?php if ($profile['role_id'] > 3): ?>class="nav-link" <?php else: ?> class="nav-link active" <?php endif ?>  id="changename-tab" data-toggle="tab" href="#changename" role="tab" aria-controls="changename" aria-selected="true">Name</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="profilephoto-tab" data-toggle="tab" href="#profilephoto" role="tab" aria-controls="profilephoto" aria-selected="false">change password</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="photo-tab" data-toggle="tab" href="#photo" role="tab" aria-controls="photo" aria-selected="false">Foto Profile</a>
            </li>
          </ul>
          <div class="tab-content pt-3 gaya" id="myTabContent">


            <?php if ($profile['role_id'] > 3): ?>
            <div class="tab-pane fade show active" id="progres" role="tabpanel" aria-labelledby="progres-tab">
              <h3 align="center">sales progress</h3>
              <center class="mb-2"><button  class="btn btn-primary" data-toggle="modal" data-target="#add"><i class="far fa-plus-square"></i> Add Product</button></center> 
              <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="add" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="newMenuModalLabel" >Add New Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  
                  <div class="modal-body menuModalForm text-center">
                    <!-- <form action="<?= base_url('menu'); ?>" method="POST"> -->
                    
                    <!--   <div class="form-group">
                        <input type="text" class="form-control" id="menu" name="menu" placeholder="Menu name">
                      </div> -->
    
                      <a href="<?= base_url('upload/font') ?>" class="btn btn-primary"><i class="fas fa-file-signature"></i> Add Font Product</a>
                      <a href="<?= base_url('upload/file') ?>" class="btn btn-primary"><i class="fas fa-file"></i> Add File Product</a>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <!-- <button type="submit" class="btn btn-primary">Add</button> -->
                  </div>
                  
                </div>
              </div>
            </div>
              <table class="table table-striped table-hover">
                <tr>
                  <th>No</th>  
                  <th>Action</th>  
                  <th>Gambar</th>
                  <th>Nama</th>
                  <th>tipe</th>
                  <th>Harga</th>
                  <th>Terjual</th>
                  <th>Like</th>
                  <th>Earning</th>
                </tr>
                  <?php 
                  $i = 1;
                  foreach ($produk as $pro): ?>                
                <tr>
                  <td><?= $i++ ?></td>
                  <td>
                    <?php if ($pro['jenis'] == 'Font'): ?>
                       <a href="<?= base_url('upload/editfont/') .hashid($pro['id']) ?>" ><i class="fa fa-edit"></i></a>
                     | <a href="<?= base_url('upload/deletefont/') .hashid($pro['id']) ?>" class="text-danger"><i class="fa fa-trash"></i></a></td>

                    <?php else: ?>
                       <a href="<?= base_url('upload/updatefile/') .hashid($pro['id']) ?>" ><i class="fa fa-edit"></i></a> 
                     | <a href="<?= base_url('upload/deletefile/') .hashid($pro['id']) ?>" class="text-danger"><i class="fa fa-trash"></i></a></td>

                    <?php endif ?>
                   


                  <td><img src="<?= base_url() . $pro['lokasi_gambar'] . $pro['gambar1']?>" height="40" width="60"></td>
                  <td><?= $pro['nama_barang'] ?></td>
                  <td><?= $pro['jenis'] ?></td>
                  <?php if ($pro['jenis'] == 'Font'): ?>
                      <?php 

                      $dekstop =  $this->db->get_where('transaksi_paypal',['pemilik' => $this->session->userdata('email'),'id_barang' => $pro['id'],'jenis' => 'dekstop'])->result_array();
                      $web =  $this->db->get_where('transaksi_paypal',['pemilik' => $this->session->userdata('email'),'id_barang' => $pro['id'],'jenis' => 'web'])->result_array();
                      $app =  $this->db->get_where('transaksi_paypal',['pemilik' => $this->session->userdata('email'),'id_barang' => $pro['id'],'jenis' => 'app'])->result_array();
                      $premium =  $this->db->get_where('transaksi_paypal',['pemilik' => $this->session->userdata('email'),'id_barang' => $pro['id'],'jenis' => 'premium'])->result_array();

                      
                      
                     ?>
                  <td>
                    <?php if ($dekstop): ?>
                    Dekstop($<?= $pro['harga_dekstop'] ?>) <br>
                    <?php endif ?>
                    <?php if ($web): ?>
                    Web($<?= $pro['harga_web'] ?>) <br>
                    <?php endif ?>
                    <?php if ($app): ?>
                    App($<?= $pro['harga_app'] ?>)
                    <?php endif ?>
                  </td>

                  <?php else: ?>
                  <td>$<?= $pro['harga_premium'] ?></td>  
                  <?php endif ?>
                  <?php if ($pro['jenis'] == 'Font'): ?>
                  <td>
 
                    <?php if ($dekstop): ?>
                      <?= count($dekstop) ?> <br>
                    <?php endif ?>
                    <?php if ($web): ?>
                    <?= count($web) ?> <br>
                    <?php endif ?>
                    <?php if ($app): ?>
                    <?= count($app) ?>
                      
                    <?php endif ?>
                  </td>
                  <?php else: ?>
                  <td><?= count($premium) ?></td>  
                  <?php endif ?>

                  <td><?= count($this->db->get_where('suka',['pemilik' => $this->session->userdata('email'),'id_barang' => $pro['id']])->result_array()) ?></td>
                  <td>
                    <?php 
                        $hasil = count($dekstop) * $pro['harga_dekstop'] + count($web) * $pro['harga_web'] + count($app) * $pro['harga_app'];

                        $hasil  = $hasil / 2;
                     ?>
                     $<?= $hasil ?>
                  </td>
                </tr>
                <?php endforeach ?>
    
              </table>

             <!-- <center><a href="" class="btn btn-primary">Add Product</a></center>  -->
            </div>         

            <?php endif ?>



            <div  <?php if ($profile['role_id'] > 3): ?>class="tab-pane fade" <?php else: ?>class="tab-pane show active"<?php endif ?>    id="changename" role="tabpanel" aria-labelledby="changename-tab">
            <form action="<?=base_url('profile/editnama') ?>" method="POST">
              <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
              <h3 align="center">change name</h3>
                <div class="form-row">
                  <div class="col">
                    <label>Your email</label>
                    <input type="text" name="email" class="form-control" value="<?= $profile['email'] ?>" readonly>
                  </div>
                </div> 
                <div class="form-row">
                  <div class="col">
                    <label>Name</label>
                    <input type="text" name="nama" class="form-control" placeholder="Change your name">
                  </div>
                </div> 
                <div class="form-row">
                  <div class="col">
                    <label>Your job</label>
                    <input type="text" name="job" class="form-control" placeholder="Change your job">
                  </div>
                </div>   

                <center> <button class="btn btn-primary mt-4" name="submit">UPDATE</button></center>
              
              </form>
            </div>
            
             <div class="tab-pane fade" id="profilephoto" role="tabpanel" aria-labelledby="profilephoto-tab">
              <h3 align="center">change password </h3>
                <form action="<?=base_url('profile/edit') ?>" method="POST">
                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                <div class="form-row ">
                  <div class="col ">
                    <label>Current Password</label>
                    <input type="password" name="current_password" class="form-control" placeholder="Current Password">
                  </div>
                </div>
                <div class="form-row">
                  <div class="col ">
                    <label>New password</label>
                    <input type="password" name="new_password1" class="form-control" placeholder="new password">
                    <span class="glyphicon glyphicon-eye-open"></span>
                  </div>
                </div>
                <div class="form-row">
                  <div class="col ">
                    <label>Repeat password</label>
                    <input type="password" name="new_password2" class="form-control" placeholder="repeat password">
                  </div>
                </div>


                <center> <button class="btn btn-primary mt-4" name="submit">Change</button></center>
              </form>
            </div>



          <div class="tab-pane fade" id="photo" role="tabpanel" aria-labelledby="photo-tab">
              <?= form_open_multipart('profile/editnama'); ?>
              <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
            <center><label>Ubah foto sampul</label></center>
            <div class="form-row pb-3">
              <div class="col">
                <img src="<?= base_url() .$profile['lokasi'].$profile['background'] ?>" class="img-thumbnail" width="500px" height="100px">
              </div>
              <div class="col">
                <input type="file" name="background" class="form-control">
                <label>image resolution 1776 x 756</label>
              </div>
            </div>
            <center><label>Ubah foto profile</label></center>
            <div class="form-row">
              <div class="col">
                <img src="<?= base_url() .$profile['lokasi'].$profile['image'] ?>" class="img-thumbnail rounded-circle" width="300px" height="300px">
              </div>
              <div class="col">
                <input type="file" name="image" class="form-control">
                <label>image resolution 512 x 512</label>
              </div>
            </div>
              <center> <button class="btn btn-primary mt-4" name="submit">UPDATE</button></center>
          </form>
          </div>
      </div>
    </section>


    <!-- footer -->
    <footer class="bg-dark text-white mt-5">
      <div class="container">
        <div class="row">
          <div class="col text-center">
            <p>Copyright &copy; 2018.</p>
          </div>
        </div>
      </div>
    </footer>







    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
  </body>
</html>