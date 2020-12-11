

    

    

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <!-- <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1> -->

                   <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold ">PENGAJUAN</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <!-- <th>Photo</th> -->
                      <th>Name</th>
                      <th>Submission Date</th>
                      <th>Submission</th>
                      <th>Status</th> 
                      <th>Status Vendor</th>
                      <th>Action</th>

                      <!-- <th>Post</th> -->
                      <!-- <th>Last Login</th> -->
                      
                    </tr>
                  </thead>
                  <tbody>
                  	<?php 
                  	$i = 1;
                  	foreach ($pengajuan as $key): ?>
                    <?php 
                    $data = $this->db->get_where('user',['email' => $key['email']])->row_array();
                    $id = $this->db->get_where('user_menu',['id' => $data['role_id']])->row_array();
                     ?>
                  
					
                    <tr>
                      <td><?= $i++; ?></td>

                      <!-- <td>foto</td> -->
                      <td><?= $key['username']  ?></td>
                      <td><?=  date('d'.'-'.'M'.'-'.'Y',$key['tanggal']) ?></td>
                      <td><?= $key['status'] ?></td>
                      <?php if ($key['role_id'] == $data['role_id']): ?>
                       <form action="http://localhost/marketplace/admin/role" method="POST">
                      <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                      <input type="hidden" name="role_id" value="1">
                      <input type="hidden" name="email" value="<?= $key['email'] ?>">
                      <td><button class="btn btn-danger" type="submit">disable</button></td>
                      </form>
                      <?php else: ?>
                       <form action="http://localhost/marketplace/admin/role" method="POST">
                      <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                      <input type="hidden" name="role_id" value="<?= $key['role_id'] ?>">
                      <input type="hidden" name="email" value="<?= $key['email'] ?>">
                      <td><button class="btn btn-primary" type="submit">Approve</button></td>
                      </form>                                            
                      <?php endif ?>
                      <td><?= $id['menu'] ?></td>
                      <td><a href="" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Hapus</a></td>
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