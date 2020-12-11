<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends  CI_Controller
{

	 public function  index()
	 {
		cekSaldo();
		
		 $data['title'] = 'Profile Page';
		 
		 $email = $this->session->userdata('email');

		 $this->load->model('Product_model','peoples');
		 $data['user'] = $this->peoples->user();
		 $data['profile'] = $this->db->get_where('user',['email' => $email])->row_array();

		 $this->form_validation->set_rules('name','name','required|trim');

		if ($this->form_validation->run() == false) {
			$this->load->view('profile/index',$data);
		}else{


			
			$upload_background = $_FILES['image-background']['name'];
		   if ($upload_background) {
			   $path = 'gambar profile/'.$data['profile']['username'].'/';
			   if (!file_exists($path)) {
					 mkdir($path,0755,true);
				 }
			   $config['allowed_types'] = 'jpg|png|jpeg';
			   $config['max_size'] = '10000';
			   $config['max_width'] = '1366';
			   $config['max_height'] = '350';
			   $config['min_width'] = '1366';
			   $config['min_height'] = '350';
			   $config['upload_path'] = './'.$path;
			   $this->load->library('upload',$config);

			   if ($this->upload->do_upload('image-background')) {

				   $old_background = $data['profile']['background'];
				   if ($old_background != 'default.jpg') {
					   unlink(FCPATH . $path . $old_background);
				   }
				   $new_background = $this->upload->data('file_name');
				   $this->db->set('background',$new_background);
				   $this->db->set('lokasi',$path);

			   }else{
				   echo $this->upload->display_errors();
				   die;
			   }

		   }

		   $upload_image = $_FILES['image-profile']['name'];
		   if ($upload_image) {
			   $path = 'gambar profile/'.$data['profile']['username'].'/';
			   if (!file_exists($path)) {
					 mkdir($path,0755,true);
				 }
			   $config['allowed_types'] = 'jpg|png|jpeg';
			   $config['max_size'] = '10000';
			   $config['max_width'] = '60';
			   $config['max_height'] = '60';
			   $config['min_width'] = '60';
			   $config['min_height'] = '60';
			   $config['upload_path'] = './'.$path;
			   $this->load->library('upload',$config);

			   if ($this->upload->do_upload('image-profile')) {

				   $old_image = $data['profile']['image'];
				   if ($old_image != 'default.jpg') {
					   unlink(FCPATH . $path . $old_image);
				   }
				   $new_image = $this->upload->data('file_name');
				   $this->db->set('image',$new_image);
				   $this->db->set('lokasi',$path);

			   }else{
				   echo $this->upload->display_errors();
				   die;
			   }

		   }



		   $this->db->set('name',htmlspecialchars($this->input->post('name',TRUE)));
		   $this->db->set('url',htmlspecialchars($this->input->post('url',TRUE)));
		   $this->db->set('tentang',htmlspecialchars($this->input->post('bio',TRUE)));
		   $this->db->set('street',htmlspecialchars($this->input->post('street',TRUE)));
		   $this->db->set('city',htmlspecialchars($this->input->post('city',TRUE)));
		   $this->db->set('province',htmlspecialchars($this->input->post('province',TRUE)));
		   $this->db->set('country',htmlspecialchars($this->input->post('country',TRUE)));
		   $this->db->set('phone_number',htmlspecialchars($this->input->post('phone_number',TRUE)));
		   $this->db->set('zip_code',htmlspecialchars($this->input->post('zip_code',TRUE)));

			$this->db->where('email',$email);
			$this->db->update('user');

			redirect('profile');
		}







	 }



	 public function sale(){
		cekSaldo();
		
		 $this->load->model('Product_model','peoples');
		 $data['user'] = $this->peoples->user();
		 $email = $this->session->userdata('email');

		 if($_POST){
			$this->db->where('date >=',$this->input->post('period1'));
			$this->db->where('date <=',$this->input->post('period2'));
			$this->db->where('pemilik',$this->session->userdata('email'));
			$data['transaksi'] = $this->db->get('transaksi_paypal')->result_array();
		 }else{
			$data['transaksi'] = $this->db->get_where('transaksi_paypal',['pemilik' => $email])->result_array();
		 }

		$data['balance'] = $this->db->query("SELECT SUM(harga) FROM transaksi_paypal WHERE pemilik = '$email'")->result_array();


    	 $this->load->view('profile/sale',$data);
	 }


	 public function affiliation(){
		cekSaldo();
		
		 $this->load->model('Product_model','peoples');
		 $data['user'] = $this->peoples->user();
		 $referal = $data['user']['referal'];
		 $role_id = $data['user']['role_id'];

		 if($_POST){
			$this->db->where('date >=',$this->input->post('period1'));
			$this->db->where('date <=',$this->input->post('period2'));
			$this->db->where('referal',$referal);
			$data['transaksi'] = $this->db->get('transaksi_paypal')->result_array();
		 }else{
			$data['transaksi'] = $this->db->get_where('transaksi_paypal',['referal' => $referal ])->result_array();
		 }

			$data['balance'] = $this->db->query("SELECT SUM(harga) FROM transaksi_paypal WHERE referal = '$referal'")->result_array();


    	 $this->load->view('profile/affiliasi',$data);
	 }





	 public function product(){
		cekSaldo();
		
		 $this->load->model('Product_model','peoples');
		 $data['user'] = $this->peoples->user();
		 $email = $this->session->userdata('email');

		//  if($_POST){
		// 	$this->db->where('date >=',$this->input->post('period1'));
		// 	$this->db->where('date <=',$this->input->post('period2'));
			$this->db->where('pemilik',$this->session->userdata('email'));
			$data['transaksi'] = $this->db->get('transaksi_paypal')->result_array();
		//  }else{
			if ($data['user']['role_id'] == 3 | 4) {
				$data['product'] = $this->db->get_where('product',['email' => $email])->result_array();
			}
			
			if ($data['user']['role_id'] == 5) {
				$data['product'] = $this->db->get_where('product')->result_array();
			}


		//  }

		// $data['balance'] = $this->db->query("SELECT SUM(harga) FROM transaksi_paypal WHERE pemilik = '$email'")->result_array();


    	 $this->load->view('profile/product',$data);
	 }


	 public function  myshop()
	 {
		cekSaldo();

		$data['title'] = 'My shop Page';
		$data['user'] = $this->db->get_where('user',['email' => $this->session->userdata('email')])->row_array();
		// $data['profile'] = $this->db->get_where('user',['name' => $nama])->row_array();

			   
			   // load library
			   $this->load->library('pagination');

			   //ambil data keyword
			   if($this->input->post('submit')) {
				  $data['keyword'] = $this->input->post('keyword');
				  $this->session->set_userdata('keyword',$data['keyword']);

			   }else{
				   $data['keyword'] = $this->session->userdata('keyword');
			   }
			   
			   if ($this->session->userdata('keyword')) {
						$this->db->select('*');
						$this->db->where('email',$this->session->userdata('email'));
						$this->db->group_start();
						$this->db->like('nama_barang',$this->session->userdata('keyword'));
						$this->db->or_like('jenis',$this->session->userdata('keyword'));
						$this->db->or_like('kategori',$this->session->userdata('keyword'));
						$this->db->group_end();
						$query = $this->db->get('product')->result_array();
						$config['total_rows'] = count($query);
				}else{
					$config['total_rows'] = count($this->db->get_where('product',['email' => $this->session->userdata('email')])->result_array());
				}

			   //config
			   $config['base_url'] = base_url().'profile/myshop/';              		  
			//    $config['total_rows'] = count($this->db->get_where('product',['email' => $this->session->userdata('email')])->result_array());

			   $config['per_page'] = 2;

				//initialize
			   $this->pagination->initialize($config);
					   
			   $data['start'] = $this->uri->segment(3);

			   if ($this->session->userdata('keyword')) {

					$this->db->select('*');
					$this->db->where('email',$this->session->userdata('email'));
					// $this->db->where_in('WHEREIN', $var);
					$this->db->group_start();
					$this->db->like('nama_barang',$this->session->userdata('keyword'));
					$this->db->or_like('jenis',$this->session->userdata('keyword'));
					$this->db->or_like('kategori',$this->session->userdata('keyword'));
					$this->db->group_end();
					$data['produk'] = $this->db->get('product',$config['per_page'],$data['start'])->result_array();
				}else{
					$data['produk'] = $this->db->get_where('product',['email' => $this->session->userdata('email')],$config['per_page'],$data['start'])->result_array();
				}


			$this->load->view('profile/myshop',$data);
 
	 }



	//  public function  designer($nama)
	//  {
	//  	$nama = str_replace('_',' ', $nama);
 	// 	$data['title'] = 'Designer Page';
 	// 	$data['profile'] = $this->db->get_where('user',['name' => $nama])->row_array();
 	// 	$email = $data['profile']['email'];
 	// 	$data['produk'] = $this->db->get_where('product',['email' => $email])->result_array();
 	// 	$data['suka'] = $this->db->get_where('suka',['pemilik' => $email])->result_array();
 	// 	$data['komentar'] = $this->db->get_where('komentar_desainer',['desainer' => $email])->result_array();


 	// 	if ($this->input->post('review',TRUE)) {
 	// 		cekProfileDesainer($nama,$this->session->userdata('email'));

	// 	 	 $profile = $this->db->get_where('user',['email'=> $this->session->userdata('email') ])->row_array();
	// 	     $gambar = $profile['lokasi'].$profile['image'];
	// 	     // $ada = $this->db->get_where('product',['id'=> $id,'email'=> $this->session->userdata('email') ])->row_array();
	// 	     // $produk = $this->db->get_where('product',['id'=> $id])->row_array();
	// 	     // $alamatnama = str_replace(' ', '_', $produk['nama_barang']);
	// 	     $name = $profile['name'];
	// 	     $role_id = $profile['role_id'];
	// 	     $review = htmlspecialchars($this->input->post('review',TRUE));



	// 		$hasil = [
	//             'nama' => $name,
	//             'tipe' => $role_id,
	//             'review' => $review,
	//             'gambar' => $gambar,
	//             'email' => $this->session->userdata('email'),
	//             'desainer' => $email,


	//         ];

	//         $this->db->insert('komentar_desainer',$hasil);

 	// 	}

 	//     $this->load->model('Designer_model','peoples');

    //     $config['full_tag_open'] = '<nav aria-label="page navigation example"><ul class="pagination justify-content-center">';
    //     $config['full_tag_close'] = '</ul></nav>';

    //     $config['first_link'] = 'First';
    //     $config['first_tag_open'] = '<li class="page-item">';
    //     $config['first_tag_close'] = '</li>';
        
    //     $config['last_link'] = 'Last';
    //     $config['last_tag_open'] = '<li class="page-item">';
    //     $config['last_tag_close'] = '</li>';

    //     $config['next_link'] = '&raquo';
    //     $config['next_tag_open'] = '<li class="page-item">';
    //     $config['next_tag_close'] = '</li>';

    //     $config['prev_link'] = '&laquo';
    //     $config['prev_tag_open'] = '<li class="page-item">';
    //     $config['prev_tag_close'] = '</li>';

    //     $config['cur_tag_open'] = '<li class="page-item active"><a href="#" class="page-link">';
    //     $config['cur_tag_close'] = '</a></li>';

    //     $config['num_tag_open'] = '<li class="page-item ">';
    //     $config['num_tag_close'] = '</li>';

    //     $config['attributes'] = array('class' => 'page-link');


	// 	// load library
    //     $this->load->library('pagination');



	// 	// CONDFIG
	// 	$config['base_url'] = base_url().'profile/designer/'.$nama;
	// 	$config['total_rows'] = $this->peoples->countAllPeoples($email);
	// 	$config['per_page'] = 3;

	// 	// initialize
	// 	$this->pagination->initialize($config);

		
	// 	$data['start'] = $this->uri->segment(4);
    //     $data['produk'] = $this->peoples->getPeoples($config['per_page'],$data['start'],$email);



 	// 	$this->load->view('profile/designer',$data);

	//  }




	//  public function  edit()
	//  {
	//  	cekSaldo();
	//  	$email = $this->session->userdata('email');

 	// 	$data['title'] = 'Designer Page';

 	// 	$data['profile'] = $this->db->get_where('user',['email' => $email])->row_array();
 	// 	$email = $data['profile']['email'];
 	// 	$data['produk'] = $this->db->get_where('product',['email' => $email])->result_array();

 	// 	$this->form_validation->set_rules('current_password','Current Password','required|trim');
    //     $this->form_validation->set_rules('new_password1','New Password','required|trim|min_length[3]|matches[new_password2]');
    //     $this->form_validation->set_rules('new_password2','Confirm New Password','required|trim|min_length[3]|matches[new_password1]');
	// 	if ($this->form_validation->run() == false) {
	// 		$this->load->view('profile/edit',$data);
	// 	}else{
	// 		$current_password = htmlspecialchars($this->input->post('current_password',TRUE));
	// 		$new_password = htmlspecialchars($this->input->post('new_password1',TRUE));

	// 		if (!password_verify($current_password, $data['profile']['password'])) {
	// 			   $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Wrong current password</div>');
    //                redirect('user/changepassword');
	// 		}else{
	// 			if ($new_password == $current_password) {
	// 				 $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">New password cannot be the same as  current password</div>');
    //                redirect('user/changepassword');
	// 			}else{
	// 				// password kalau sudah ok
	// 				$password_hash = password_hash($new_password, PASSWORD_DEFAULT);

	// 				$this->db->set('password',$password_hash);
	// 				$this->db->where('email',$this->session->userdata('email'));
	// 				$this->db->update('user');
                    
    //                 $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Password change</div>');
    //                 redirect('profile/edit');

	// 			}
	// 		}
	// 	}

	//  }



	//  	 public function  editnama()
	//  {
	//  	$email = $this->session->userdata('email');
	//  	if (!$this->db->get_where('user',['email' => $email])->row_array()) {
	//  	  redirect('auth');
	//  	}
	//  	$data['profile'] = $this->db->get_where('user',['email' => $email])->row_array();
	//  	$produk = $this->db->get_where('product',['email'=> $email])->result_array();
	//  	$produkrow = $this->db->get_where('product',['email'=> $email])->row_array();
	//  	$sub_produk = $this->db->get_where('sub_product',['email'=> $email])->result_array();
	//  	$this->form_validation->set_rules('nama','name','required|trim|is_unique[user.name]');


	//  	if ($this->form_validation->run() == TRUE) {
	//  		$nama = htmlspecialchars($this->input->post('nama',TRUE));
	 		

	//  		// gambar produk

	//  		$nama_gambar_lama = 'gambar/'.$data['profile']['name'].'/';
	//  		$nama_gambar_baru = 'gambar/'.$nama.'/';
	//  		$lok = str_replace($data['profile']['name'], $nama, $produkrow['lokasi_gambar']);
	//  		$this->db->where('email',$produk['email']);
	//  		$this->db->update('product',['lokasi_gambar' => $lok]);
	//  		rename($nama_gambar_lama, $nama_gambar_baru);

	 		
	//  		// gambar profile
	//  		$pathlama = rtrim($data['profile']['lokasi'],'/');
	//  		$pathbaru = 'gambar profile/'.$nama;	 		
	//  		rename($pathlama, $pathbaru);
	 		

	// 		 	if ($this->input->post('nama')) {
	// 		 		foreach ($produk as $ubah ) {

	// 		 				if ($ubah['lokasi_gratis']) {
	// 		 				$lokasi_gratis = str_replace($data['profile']['name'], $nama, $ubah['lokasi_gratis']);

	// 		 				$this->db->set('lokasi_gratis',$lokasi_gratis);
	// 		 				$this->db->where('id',$ubah['id']);
	// 			 			$this->db->update('product');

	// 		 				}
	// 		 				if ($ubah['lokasi_dekstop']) {
	// 		 				$lokasi_dekstop = str_replace($data['profile']['name'], $nama, $ubah['lokasi_dekstop']);

	// 		 				$this->db->set('lokasi_dekstop',$lokasi_dekstop);
	// 		 				$this->db->where('id',$ubah['id']);
	// 			 			$this->db->update('product');

	// 		 				}	 				
	// 		 				if ($ubah['lokasi_web']) {
	// 		 				$lokasi_web = str_replace($data['profile']['name'], $nama, $ubah['lokasi_web']);
	// 		 				$this->db->set('lokasi_web',$lokasi_web);
	// 		 				$this->db->where('id',$ubah['id']);
	// 			 			$this->db->update('product');

	// 		 				}
	// 		 				if ($ubah['lokasi_app']) {
	// 		 				$lokasi_app = str_replace($data['profile']['name'], $nama, $ubah['lokasi_app']);
	// 		 				$this->db->set('lokasi_app',$lokasi_app);
	// 		 				$this->db->where('id',$ubah['id']);
	// 			 			$this->db->update('product');

	// 		 				}
	// 		 				if ($ubah['lokasi_premium']) {
	// 		 				$lokasi_premium = str_replace($data['profile']['name'], $nama, $ubah['lokasi_premium']);
	// 		 				$this->db->set('lokasi_premium',$lokasi_premium);
	// 		 				$this->db->where('id',$ubah['id']);
	// 			 			$this->db->update('product');

	// 		 				}
	// 		 				if ($ubah['lokasi_gambar']) {
	// 		 				$lokasi_gambar = str_replace($data['profile']['name'], $nama, $ubah['lokasi_gambar']);
	// 		 				$this->db->set('lokasi_gambar',$lokasi_gambar);
	// 		 				$this->db->where('id',$ubah['id']);
	// 			 			$this->db->update('product');

	// 		 				}	 				

	// 		 		}

	// 		 		foreach ($sub_produk as $sub_ubah ) {

	// 		 				if ($sub_ubah['lokasi']) {
	// 		 				$lokasi = str_replace($data['profile']['name'], $nama, $sub_ubah['lokasi']);
	// 		 				$this->db->set('lokasi',$lokasi);
	// 		 				$this->db->where('email',$email);
	// 			 			$this->db->update('sub_product');

	// 		 				}


	// 		 		}

	// 		 		$pathlamaproduct = 'produk/'.$data['profile']['name'];
	// 		 		$pathbaruproduct = 'produk/'.$nama;
	// 		 		if (file_exists($pathlamaproduct)) {
	// 		 		rename($pathlamaproduct, $pathbaruproduct);
	// 				} 
	// 		 		$pathlamagambar = 'gambar/'.$data['profile']['name'];
	// 		 		$pathbarugambar = 'gambar/'.$nama;
	// 		 		if (file_exists($pathlamagambar)) {
	// 		 		rename($pathlamagambar, $pathbarugambar);
	// 		 		}



	// 		 	}
	// 		 	$this->db->set('name',$nama);
	// 			$this->db->set('lokasi',$pathbaru.'/');
	//  	}



	//  	if ($job = htmlspecialchars($this->input->post('job',TRUE))) {
	//  		$this->db->set('job',$job);
	//  	} 	 	
	 	

	//  	    $upload_background = $_FILES['background']['name'];
    //         if ($upload_background) {
    //         	$path = 'gambar profile/'.$data['profile']['name'].'/';
    //         	if (!file_exists($path)) {
    //           		mkdir($path,0,true);
    //      		 }
    //         	$config['allowed_types'] = 'jpg|png|jpeg';
    //         	$config['max_size'] = '10000';
    //         	$config['upload_path'] = './'.$path;
    //         	$this->load->library('upload',$config);

    //         	if ($this->upload->do_upload('background')) {

    //         		$old_background = $data['profile']['background'];
    //         		if ($old_background != 'default.jpg') {
    //         			unlink(FCPATH . $path . $old_background);
    //         		}
    //         		$new_background = $this->upload->data('file_name');
    //         		$this->db->set('background',$new_background);
    //         		$this->db->set('lokasi',$path);

    //         	}else{
    //         		echo $this->upload->display_errors();
    //         	}

    //         }
    //         $upload_image = $_FILES['image']['name'];
    //         if ($upload_image) {
    //         	$path = 'gambar profile/'.$data['profile']['name'].'/';
    //         	if (!file_exists($path)) {
    //           		mkdir($path,0,true);
    //      		 }
    //         	$config['allowed_types'] = 'jpg|png|jpeg';
    //         	$config['max_size'] = '10000';
    //         	$config['upload_path'] = './'.$path;
    //         	$this->load->library('upload',$config);

    //         	if ($this->upload->do_upload('image')) {

    //         		$old_image = $data['profile']['image'];
    //         		if ($old_image != 'default.jpg') {
    //         			unlink(FCPATH . $path . $old_image);
    //         		}
    //         		$new_image = $this->upload->data('file_name');
    //         		$this->db->set('image',$new_image);
    //         		$this->db->set('lokasi',$path);

    //         	}else{
    //         		echo $this->upload->display_errors();
    //         	}

    //         }


	//  	$this->db->where('email',$email);
	//  	$this->db->update('user');



	//  	redirect('profile/edit');
	//  }







}