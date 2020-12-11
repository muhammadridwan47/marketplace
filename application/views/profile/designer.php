

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
    <!-- <link rel="stylesheet" href="<?=base_url('assets2/') ?>css/style.css"> -->
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
    <title><?= $title; ?></title>
  </head>
  <body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <!-- <a class="navbar-brand" href="#home"><?= $profile['name'] ?></a> -->
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


    <div class="jumbotron" id="home" style="background-image: url('<?= base_url('').$profile['lokasi'].$profile['background'] ?>'); background-repeat: no-repeat;">
      <div class="container">
        <div class="text-center">
          <img src="<?= base_url('').$profile['lokasi'].$profile['image'] ?>" class="rounded-circle img-thumbnail">
          <h1 class="display-4"><?= $profile['name'] ?></h1>
          <h3 class="lead"><?= $profile['job'] ?></h3>

        </div>
      </div>
    </div>


    <!-- About -->
    <section class="about" id="about">
      <div class="container">
        <div class="row mb-4">
          <div class="col text-center">
            <h2>About</h2>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-md-10">
            <p><?= $profile['tentang'] ?></p>
          </div>
        </div>
      </div>
    </section>


    <!-- Portfolio -->
    <section class="portfolio bg-light" id="portfolio">
      <div class="container">
        <div class="row pt-4 mb-4">
          <div class="col text-center">
            <h2>Portfolio</h2>
          </div>
        </div>
          <div class="navlist">
              <ul class="nav nav-tabs" id="myTab" role="tablist">
 <!--                <li class="nav-item">
                  <a class="nav-link active" id="product-tab" data-toggle="tab" href="#product" role="tab" aria-controls="product" aria-selected="true">Product</a>
                </li> -->
                <li class="nav-item">
                  <a class="nav-link active" id="like-tab" data-toggle="tab" href="#like" role="tab" aria-controls="like" aria-selected="false">Likes</a>
                </li>
<!--                 <li class="nav-item">
                  <a class="nav-link" id="comment-tab" data-toggle="tab" href="#comment" role="tab" aria-controls="comment" aria-selected="false">Comment</a>
                </li> -->
              </ul>
              <div class="tab-content p-4" id="myTabContent">
                <div class="tab-pane fade show active" id="product" role="tabpanel" aria-labelledby="product-tab">
  <!--                 <div class="row pb-3">
                  
                  <?php foreach ($produk as $pro): ?>
                    
                    <div class="col-lg-4">
                        <div class="card text-center">
                        <a href="<?= base_url('product/detail/'). str_replace(' ','_',$pro['nama_barang'])?>"><img class="card-img-top" src="<?= base_url().$pro['lokasi_gambar'].$pro['gambar1'] ?>" alt="Card image cap"></a>
                          <div class="card-body">
                              <?php if ($pro['jenis'] == 'Font'): ?>
                              <a class="menuu" style="float: left;">$ <?= $pro['harga_dekstop'] ?></a>
                            <?php else: ?>
                              <a class="menuu" style="float: left;">$ <?= $pro['harga_premium'] ?></a>
                            <?php endif ?>
                            <a ><?= $pro['nama_barang'] ?></a>

                            
                            <div class="iconhati">
                              <a href="#"><i class="far fa-heart"></i></a>
                            </div>
                          </div>
                        </div>
                    </div>
                  <?php endforeach ?>
                   
                  </div>
  -->

                  


                  
                </div>
                <div class="tab-pane fade" id="like" role="tabpanel" aria-labelledby="like-tab">
                   <?php foreach ($suka as $like): ?>

                               <?php
                                $data = $this->db->query("SELECT name,lokasi,image FROM user WHERE email = '{$like['email']}'")->row_array();
                                // $data = $this->db->get_where('user',['email' => $like['email']])->row_array();
                            
                    ?> 

         
                  <div class="row">
                    <div class="col-xl-1 col-md-2 col-xs-6" style="background-color:;margin-right: -35px">
                      <img src="<?= base_url() . $data['lokasi'] . $data['image']?>" style="width: 48px;height: 48px" alt="">
                    </div>
                    <div class="col-xl-11 col-md-10 col-xs-6" style="background-color:">
                      <h6><a href=""><?= $data['name'] ?></a> liked your product</h6>
                      <p style="line-height: 20px;"><i class="far fa-heart pr-2"></i><?= $like['tanggal'] ?></p>
                    </div>
                  </div>
                  <?php endforeach ?>
                </div>
<!--                 <div class="tab-pane fade" id="comment" role="tabpanel" aria-labelledby="comment-tab">

                  <?php foreach ($komentar as $komen): ?>
                  <div class="row">
                    <div class="col-xl-1 col-md-2 col-xs-6" style="background-color:;margin-right: -28px">
                      <img src="<?= base_url(). $komen['gambar'] ?>" style="width: 55px;height: 55px;" class="rounded-circle">
                    </div>
                    <div class="col-xl-11 col-md-10 col-xs-6">
                      <h5><a href=""><?= $komen['nama'] ?></a></h5>
                      <p><?= $komen['review'] ?></p>
                    </div>
                  </div>
                  <?php endforeach ?>
 
                </div> -->
              </div>
            </div>
          </div>
      </section>


    <div class="produc mt-3 ">
      <div class="container">
      <div class="row">
        <div class="col-12">
            <h2 class="text-center mb-4">product</h2>



                <div class="row text-center justify-content-center">
                  <?php foreach ($produk as $pro): ?>
                    <div class="col-sm-3">
                        <div class="card ">
                        <a href="<?= base_url('product/detail/'). str_replace(' ','_',$pro['nama_barang'])?>"><img class="card-img-top" src="<?= base_url().$pro['lokasi_gambar'].$pro['gambar1'] ?>" alt="Card image cap"></a>
                          <div class="card-body">
                              <?php if ($pro['jenis'] == 'Font'): ?>
                              <a class="menuu" style="float: left;">$ <?= $pro['harga_dekstop'] ?></a>
                            <?php else: ?>
                              <a class="menuu" style="float: left;">$ <?= $pro['harga_premium'] ?></a>
                            <?php endif ?>
                            <a ><?= $pro['nama_barang'] ?></a>

                            
                            <div class="iconhati">
                              <a href="#"><i class="far fa-heart"></i></a>
                            </div>
                          </div>
                        </div>
                    </div>
                  <?php endforeach ?>     
                </div>
                                   <!-- pagination -->
                    <div class="mt-4">
                  
                        <?= $this->pagination->create_links(); ?>
                 
                    </div>  
        </div>
      </div>
      </div>
    </div>

    <!-- Contact -->
    <section class="contact" id="contact">
      <div class="container">
        <div class="row pt-4 mb-4">
          <div class="col text-center">
            <h2>Contact</h2>
          </div>
        </div>

        <div class="row justify-content-center">
          <div class="col-lg-8">
            <div class="card bg-primary text-white mb-4 text-center">
              <div class="card-body">
                <h5 class="card-title">Contact Me</h5>
             
              </div>
            </div>
            
            <ul class="list-group mb-4">
              <li class="list-group-item"><h3>My Address</h3></li>
              <li class="list-group-item"><?= $profile['alamat'] ?></li>
            </ul>
          </div>

<!--           <div class="col-lg-6">
            
            <form action="" method="POST">
              <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
              <div class="form-group">
                <label for="message">Message</label>
                <textarea class="form-control" id="message" rows="3" name="review"></textarea>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-primary">Send Message</button>
              </div>
            </form>

          </div> -->
        </div>
      </div>
    </section>


    <!-- footer -->
    <footer class="bg-dark text-white mt-5">
      <div class="container">
        <div class="row">
          <div class="col text-center">
            <p>Copyright &copy; 2019.</p>
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