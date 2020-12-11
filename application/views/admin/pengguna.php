

    

    

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <!-- <h1 class="h3 mb-4 text-gray-800">Akun</h1> -->

                   <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold ">Accounts</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <!-- <th>Photo</th> -->
                      <th>Nama</th>
                      <th>Username</th>
                      <th>Email</th>
                      <th>Role</th> 
                      <th>Tanggal</th>
                      <th>Saldo</th>
                      <th>Status</th>
                      <th>Aksi</th>
                      
                    </tr>
                  </thead>

                  <tbody>
                  	<?php 
                  	$i = 1;
                  	foreach ($pengguna as $key): ?>
                    <tr>
                      <td><?= $i++; ?></td>

                      <!-- <td>foto</td> -->
                      <td><?= $key['name']  ?></td>
                      <td><?= $key['username']  ?></td>
                      <td><?= $key['email'] ?></td>
                      <td>
                        <?php if ($key['role_id'] == 1): ?>
                          User
                        <?php elseif ($key['role_id'] == 2): ?>
                          Referral
                        <?php elseif ($key['role_id'] == 3): ?>
                          Designer
                        <?php elseif ($key['role_id'] == 4): ?>
                          Designer dan Referral
                        <?php endif ?>
                        
                          
                        </td>
                      <td><?=  date('d'.'-'.'M'.'-'.'Y',$key['date_created']) ?></td>
                      <td><?= $key['saldo'] ?></td>
                      <td>
                        
                        <?php if ($key['is_active'] == 1): ?>
                          <strong class="text-success">Aktif</strong>
                        <?php else: ?>
                         <strong class="text-danger">Tidak Aktif</strong>
                        <?php endif ?>
                          
                      </td>
                      <td><a href="" class="btn btn-success btn-sm">ON</a> <a href="" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a></td>
                      <!-- <td>Last Login</td> -->
                      <!-- <td>Post</td> -->

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