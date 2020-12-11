	<?php 
	defined('BASEPATH') or exit('No direct script access allowed');

	class Pembayaran extends  CI_Controller
	{

		public function __construct()
		{
			parent::__construct();
			// cekProductDetail($this->input->post('nama_barang'),$this->session->userdata('email'));
		}

		public function buy($referal = null)
		{
			// var_dump(preg_replace('/[^A-Za-z0-9\  ]/', '',$_POST['jml']));die;


			$id = dehashid($this->input->post('name'));
			if (!$this->session->userdata('email')) {
				redirect('auth/blocked');
			}

			$email = $this->session->userdata('email');
			$user = $this->db->get_where('user',['email' => $email])->row_array();
			// $jenis = $this->input->post('jenis');
			// $nama_barang = $this->input->post('nama_barang');
			// $tipe = $this->input->post('tipe');
			// $harga = $this->input->post('harga');
			$data = $this->db->get_where('product',['id' => $id])->row_array();
			$jenis = htmlspecialchars($this->input->post('jenis'));
			$jml = htmlspecialchars($this->input->post('jml'));
			$jml = preg_replace('/[^A-Za-z0-9\  ]/', '',$jml);
			if (!is_numeric($jml)) {
				redirect('blocked');
			}
			$jml = intval($jml);

			if (!is_int($jml)) {
				redirect('blocked');
			}
			if ($jml == 0) {
					redirect('blocked');
			}

			if (!$data) {
				redirect('block');
			}

			$jenisAkhir = array("desktop", "app", "web", "premium");

			if (!in_array($jenis, $jenisAkhir, TRUE))
			{
				redirect('block');
			}

			$nama_barang = $data['nama_barang'];
			$tipe = $data['kategori'];
			$pemilik = $data['email'];

			$random1 = strtoupper(base64_encode(random_bytes(6)));
			$random = preg_replace('/[^A-Za-z0-9\  ]/', '',$random1);

			if ($jenis == 'desktop') {
				
				$harga = $jml * ($data['daily_deal'] == '1') ? $data['harga_dekstop'] / 2 : $data['harga_dekstop'];
				if ($this->db->get_where('transaksi_paypal',['id_barang' => $id,'email' => $this->session->userdata('email'),'jenis' => 'dekstop'])->row_array()) {
						$this->session->set_flashdata('message','    <div class="alert alert-success alert-dismissible">
						<button class="close" type="button" data-dismiss="alert">
							<span>&times;</span>
						</button>
						The product has been  <strong>purchased</strong>
						</div>');	         	
					redirect('product/detail/'.str_replace(' ','_', $nama_barang));
				} else {
					
					$saldo = $user['saldo'];
					if ($saldo > $harga || $saldo == $harga) {
						$this->db->query("UPDATE user SET saldo = $saldo - {$harga} WHERE email= '{$email}'");

						$point = $data['point'] + $harga * 2;
						$rating = $data['rating'] + ($harga * 2 * 500000);


						$set = [
							'point' => $point,
							'rating' => $rating,
							'waktu_rating' => time()
						];

						$this->db->update('product', $set, ['id' => $id]);

						$data = [
							'nama_barang' => $nama_barang,
							'id_barang' => $id,
							'jenis' => $jenis,
							'tipe' => $tipe,
							'harga' => $harga,
							'jumlah' => $jml,
							'email' => $this->session->userdata('email'),
							'pemilik' => $pemilik,
							'tanggal' => time(),
							'date' => date('Y-m-d'),
							'no_tagihan' => $random,
							'referal' => $referal

						];
						$this->db->insert('transaksi_paypal',$data);
						$this->session->set_flashdata('message','    <div class="alert alert-success alert-dismissible">
						<button class="close" type="button" data-dismiss="alert">
							<span>&times;</span>
						</button>
						Your success buying to <strong>product</strong>
						</div>');
						redirect('product/detail/'.str_replace(' ','_', $nama_barang));
					}else{
						$this->session->set_flashdata('message','    <div class="alert alert-warning mt-5 alert-dismissible">
						<button class="close" type="button" data-dismiss="alert">
							<span>&times;</span>
						</button>
						your credit is lacking
						</div>');
						redirect('credit');
					}   
				}
			}

			if ($jenis == 'web') {

				if ($jml == 1) {
					$harga =  ($data['daily_deal'] == '1') ? $data['harga_web'] / 2 : $data['harga_web'] ;
					$jml = '10K';
				}
				if ($jml == 2) {
					$harga = 3 *  ($data['daily_deal'] == '1') ? $data['harga_web'] / 2 : $data['harga_web'] ;
					$jml = '100K';
				}
				if ($jml == 3) {
					$harga = 6 *  ($data['daily_deal'] == '1') ? $data['harga_web'] / 2 : $data['harga_web'] ;
					$jml = '1M';
				}
				if ($jml == 4) {
					$harga = 20 *  ($data['daily_deal'] == '1') ? $data['harga_web'] / 2 : $data['harga_web'] ;
					$jml = 'NO LIMIT';
				}

				
				if ($this->db->get_where('transaksi_paypal',['id_barang' => $id,'email' => $this->session->userdata('email'),'jenis' => 'web'])->row_array()) {
					redirect('product/detail/'.str_replace(' ','_', $nama_barang));
				} else {
					
					$saldo = $user['saldo'];
					if ($saldo > $harga || $saldo == $harga) {
						$this->db->query("UPDATE user SET saldo = $saldo - {$harga} WHERE email= '{$email}'");		

						$point = $data['point'] + $harga * 2;
						$rating = $data['rating'] + ($harga * 2 * 500000);


						$set = [
							'point' => $point,
							'rating' => $rating,
							'waktu_rating' => time()
						];

						$this->db->update('product', $set, ['id' => $id]);

					
						$data = [
							'nama_barang' => $nama_barang,
							'id_barang' => $id,
							'jenis' => $jenis,
							'tipe' => $tipe,
							'harga' => $harga, 
							'jumlah' => $jml,
							'email' => $this->session->userdata('email'),
							'pemilik' => $pemilik,
							'tanggal' => time(),
							'date' => date('Y-m-d'),
							'no_tagihan' => $random,
							'referal' => $referal

						];
					$this->db->insert('transaksi_paypal',$data);
					redirect('product/detail/'.str_replace(' ','_', $nama_barang));
					}else{
						$this->session->set_flashdata('message','    <div class="alert alert-warning mt-5 alert-dismissible">
						<button class="close" type="button" data-dismiss="alert">
							<span>&times;</span>
						</button>
						your credit is lacking
						</div>');	            	
						redirect('credit');
					}   
				}
			}         

			if ($jenis == 'app') {
				$harga = $jml * 10 * ($data['daily_deal'] == '1') ? $data['harga_app'] / 2 : $data['harga_app'];
				if ($this->db->get_where('transaksi_paypal',['id_barang' => $id,'email' => $this->session->userdata('email'),'jenis' => 'app'])->row_array()) {
					redirect('product/detail/'.str_replace(' ','_', $nama_barang));
				} else {
					
					$saldo = $user['saldo'];
					if ($saldo > $harga || $saldo == $harga) {
						$this->db->query("UPDATE user SET saldo = $saldo - {$harga} WHERE email= '{$email}'");		
						$point = $data['point'] + $harga * 2;
						$rating = $data['rating'] + ($harga * 2 * 500000);


						$set = [
							'point' => $point,
							'rating' => $rating,
							'waktu_rating' => time()
						];

						$this->db->update('product', $set, ['id' => $id]);

						$data = [
							'nama_barang' => $nama_barang,
							'id_barang' => $id,
							'jenis' => $jenis,
							'tipe' => $tipe,
							'harga' => $harga,
							'jumlah' => $jml,
							'email' => $this->session->userdata('email'),
							'pemilik' => $pemilik,
							'tanggal' => time(),
							'date' => date('Y-m-d'),
							'no_tagihan' => $random,
							'referal' => $referal

						];
					$this->db->insert('transaksi_paypal',$data);
					redirect('product/detail/'.str_replace(' ','_', $nama_barang));

					}else{
						$this->session->set_flashdata('message','    <div class="alert alert-warning mt-5 alert-dismissible">
						<button class="close" type="button" data-dismiss="alert">
							<span>&times;</span>
						</button>
						your credit is lacking
						</div>');	            	
						redirect('credit');
					}   
				}
			}


			if ($jenis == 'premium') {
				$harga = $jml *  ($data['daily_deal'] == '1') ? $data['harga_premium'] / 2 : $data['harga_premium'] ;
				if ($this->db->get_where('transaksi_paypal',['id_barang' => $id,'email' => $this->session->userdata('email'),'jenis' => 'premium'])->row_array()) {
					redirect('product/detail/'.str_replace(' ','_', $nama_barang));
				} else {
					
					$saldo = $user['saldo'];
					if ($saldo > $harga || $saldo == $harga) {
						$this->db->query("UPDATE user SET saldo = $saldo - {$harga} WHERE email= '{$email}'");		
						$point = $data['point'] + $harga * 2;
						$rating = $data['rating'] + ($harga * 2 * 500000);


						$set = [
							'point' => $point,
							'rating' => $rating,
							'waktu_rating' => time()
						];

						$this->db->update('product', $set, ['id' => $id]);

						$data = [
							'nama_barang' => $nama_barang,
							'id_barang' => $id,
							'jenis' => $jenis,
							'tipe' => $tipe,
							'harga' => $harga,
							'jumlah' => $jml,
							'email' => $this->session->userdata('email'),
							'pemilik' => $pemilik,
							'tanggal' => time(),
							'date' => date('Y-m-d'),
							'no_tagihan' => $random,
							'referal' => $referal

						];
					$this->db->insert('transaksi_paypal',$data);
					redirect('product/detail/'.str_replace(' ','_', $nama_barang));
					}else{
						$this->session->set_flashdata('message','    <div class="alert alert-warning mt-5 alert-dismissible">
						<button class="close" type="button" data-dismiss="alert">
							<span>&times;</span>
						</button>
						your credit is lacking
						</div>');	            	
						redirect('credit');
					}   	             
				}
			}

		}

	}
