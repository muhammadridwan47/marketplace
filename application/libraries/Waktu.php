<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Waktu {


public function __construct()
{
			$ci = get_instance();
			if (!$ci->session->userdata('render')) {
				$random1 = strtoupper(base64_encode(random_bytes(32)));
				$random = preg_replace('/[^A-Za-z0-9\  ]/', '',$random1);
				$ci->session->set_userdata(['render' => $random]);
			 }
			$hasil = $ci->db->get('product')->result_array();

			foreach ($hasil as $key) {
				if ($key['waktu_rating']) {
					  if (time() - $key['waktu_rating'] > (60 * 2)) { 
					  	// echo $key['nama_barang'] . '/'.'sudah cukup <br>';
					  		$waktu = $key['waktu_rating'];
					  		// rating($waktu);
						
								
							  $start_date = new DateTime(date('Y-m-d H:i:s',time()));
							  $since_start = $start_date->diff(new DateTime(date('Y-m-d H:i:s',$waktu)));

							  if ($since_start->d) {
							    $ambil =  $since_start->h * $since_start->i * ($since_start->d * 24) * 60;
							  }else{
							    if ($since_start->h) {
							     $ambil =  $since_start->h * $since_start->i * 60;
							    }else{
							      if ($since_start->i) {
							      $ambil =    $since_start->i * 60;  

							      }
							    }
							  }
							
							// echo $ambil;
					  	if ($key['rating'] > 0) {
						  $rating = $key['rating'] - $ambil;
						  if ($rating > 0) {
							  $set = [
							 	'rating' => $rating,
							 	'waktu_rating' => time()
							 ];

							 $ci->db->update('product', $set, ['id' => $key['id']]);
						   }else{

							  $set = [
							 	'rating' => $key['point'],
							 	'waktu_rating' => 0
							 ];

							 $ci->db->update('product', $set, ['id' => $key['id']]);						   	
						   }
					  	}


					  }
				}
			}


}

// $ci = get_instance();


// public function waktu(){
// 	$ci = get_instance();

// 	$ci->db->insert('mahasiswa',['nama' => 'nama']);
// }

// $this->waktu();

}