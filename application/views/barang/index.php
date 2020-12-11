
<?php 
// $koneksi = mysqli_connect('localhost','root','','magenta');
// $query = mysqli_query($koneksi,'SELECT * FROM barang');

 ?>
    

    

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

           <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Barang</th>
                      <th>ID Barang</th>
                      <th>Ukuran</th>
                      <th>Harga</th>
                      <th>Deskripsi</th>
                      <th>Informasi Barang</th>
                      <th>Komentar</th>
                      <th>Gambar</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>No</th>
                      <th>Nama Barang</th>
                      <th>ID Barang</th>
                      <th>Ukuran</th>
                      <th>Harga</th>
                      <th>Deskripsi</th>
                      <th>Informasi Barang</th>
                      <th>Komentar</th>
                      <th>Gambar</th>
                    </tr>
                  </tfoot>
                   
                  <tbody>
                    <?php 
                   $i = 1;
                   foreach ($query as $data): ?>
                    <tr>
                      <td><?= $i; ?></td>
                      <td><?= $data['nama_brg'] ?></td>
                      <td><?= $data['id_barang'] ?></td>
                      <td><?= $data['ukuran'] ?></td>
                      <td><?= $data['harga'] ?></td>
                      <td><?= $data['deskripsi'] ?></td>
                      <td><?= $data['informasi_brg'] ?></td>
                      <td><?= $data['komentar'] ?></td>
                      <td><?= $data['gambar'] ?></td>
                    </tr>
                  <?php $i++; ?>
                    <?php endforeach ?>
                  </tbody>
                    
                </table>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      