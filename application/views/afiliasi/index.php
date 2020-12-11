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
    <link rel="stylesheet" href="<?= base_url('assets2/') ?>prtfolio/css/style.css">

    <title>AFFILIATE</title>
  </head>
  <body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="#home"><?= $profile['name'] ?></a>
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


    <div class="jumbotron" id="home" style="background-image: url('<?= base_url('assets2/') ?>img/bg-header-5.jpg'); background-repeat: no-repeat;">
      <div class="container">
        <div class="text-center">
          <img src="<?= base_url('assets2/') ?>prtfolio/img/profile1.png" class="rounded-circle img-thumbnail"><br>
          <h1 class="display-4"><?= $profile['name'] ?></h1>
          <a href="<?= base_url() ?>"><button class="btn btn-info">BEGINT TO SHARE</button></a>
        </div>
      </div>
    </div>

    <div class="container p-3">
      <div class="row">
        <div class="col-md-12">
           <div class="row text-center" style="background-color: #57bc90; border-radius: 5px;">
             <div class="col-md-3 p-2">
               <img src="<?= base_url('assets2/') ?>img/money.png" width="90px" height="90px">
               <h4>Earning</h4>
               <div style="border: 2px solid; height: 30px; width:90px; border-radius: 5px; text-align: center; display: inline-block;">
                 <?php 
                 $hasil = 0;
                 foreach ($transaksi as $tran): ?>
                   <?php 
                     $hasil  += $tran['harga'] / 10;

                    ?>
                 <?php endforeach ?>

                   $<?= $hasil ?> 
               </div>
             </div>
              <div class="col-md-3 p-2" style="background-color: #77c9d4; border-radius: 5px;">
               <img src="<?= base_url('assets2/') ?>img/tap.png" width="90px" height="90px">
               <h4>Click</h4>
                <div style="border: 2px solid; height: 30px; width:90px; border-radius: 5px; text-align: center;display: inline-block;">
               <?= count($transaksi) ?>
               </div>
             </div>
            <div class="col-md-3 p-2" style="background-color: #57bc90; border-radius: 5px;">
               <img src="<?= base_url('assets2/') ?>img/paid.png" width="90px" height="90px">
               <h4>Purchased</h4>
                <div style="border: 2px solid; height: 30px; width:90px; border-radius: 5px; text-align: center; display: inline-block;">
                 <?= count($klik) ?>
               </div>
             </div>
             <div class="col-md-3 p-2" style="background-color: #77c9d4; border-radius: 5px;">
               <img src="<?= base_url('assets2/') ?>img/commission.png" width="90px" height="90px">
               <h4>Commission</h4>
                <div style="border: 2px solid; height: 30px; width:90px; border-radius: 5px; text-align: center; display: inline-block;">
                 10%
               </div>
             </div>
           </div>
        </div>
      </div>
    </div>

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