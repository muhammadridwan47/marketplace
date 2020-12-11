

    

    

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <!-- <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1> -->

                   <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold">Data Produk </h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Barang</th>
                      <th>Jenis</th>
                      <th>Kategori</th>
                      <th>Format</th>
                      <th>ID Barang</th>
                      <th>Tanggal</th> 
                      <th>Pemilik</th>
                      <th>Action</th>
                      
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $i = 1;
                    foreach ($produk as $key): ?>
                    <?php 
                    $pemilik = $this->db->get_where('user',['email' => $key['email']])->row_array();
                    // $id = $this->db->get_where('user_menu',['id' => $data['role_id']])->row_array();
                     ?>
                  
          
                    <tr>
                      <td><?= $i++; ?></td>
                      <td><?= $key['nama_barang'] ?></td>
                      <td><?= $key['jenis'] ?></td>
                      <td><?= $key['kategori'] ?></td>
                      <td><?= $key['format_file'] ?></td>
                      <td><?= $key['id_barang'] ?></td>
                      <td><?= date('d-m-Y',$key['tanggal'])  ?></td>
                      <td><?= $pemilik['name']  ?></td>
                      <td><a href="" class="btn btn-success btn-sm">ON</a> <a href="" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>  </td>
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