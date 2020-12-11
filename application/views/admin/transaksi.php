

    

    

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <!-- <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1> -->

                   <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold">Data Transaksi </h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Pembeli</th>
                      <th>Nama barang</th>
                      <th>Tipe</th>
                      <th>Harga</th>
                      <th>Pemilik</th>
                      <th>Tanggal</th> 
                      <th>Action</th>
                      
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $i = 1;
                    foreach ($transaksi as $key): ?>
                    <?php 
                    $data = $this->db->get_where('user',['email' => $key['email']])->row_array();
                    $pemilik = $this->db->get_where('user',['email' => $key['pemilik']])->row_array();
                    // $id = $this->db->get_where('user_menu',['id' => $data['role_id']])->row_array();
                     ?>
                  
          
                    <tr>
                      <td><?= $i++; ?></td>
                      <td><?= $data['name'] ?></td>
                      <td><?= $key['nama_barang'] ?></td>
                      <td><?= $key['tipe'] ?></td>
                      <td>$<?= $key['harga'] ?></td>
                      <td><?= $pemilik['name'] ?></td>
                      <td><?= date('d-m-Y',$key['tanggal'])  ?></td>
                      <td class="text-center"><a href="" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Hapus</a></td>
                    </tr>
          
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

      <script>
      $('.form-check-input').on('click',function(){
           const menuId = $(this).data('menu');
           const roleId = $(this).data('role');

            $.ajax({
           url: "<?= base_url('admin/changeaccess'); ?>",
           type: 'post',
           data: {
            menuId: menuId,
            roleId: roleId
           },
           success: function(){
            document.location.href = "<?= base_url('admin/pengajuan/'); ?>" + roleId;
           }
      });
      });
      </script>