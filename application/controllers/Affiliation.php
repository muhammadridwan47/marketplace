<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class Affiliation extends  CI_Controller
{

	 public function index()
	 {
	 	cekAffiliation();


	 	$data['title'] = 'affilation page';
	    $email = $this->session->userdata('email');
	    $data['profile']  = $this->db->get_where('user',['email' => $email])->row_array();
	    $data['transaksi']  = $this->db->get_where('transaksi_paypal',['referal' => $data['profile']['referal']])->result_array();
	    $data['klik'] = $this->db->get_where('click_referal',['referal' =>$data['profile']['referal']])->result_array();

	    

        // $data['user'] = $this->peoples->user();    

	 	// $this->load->view('produk/header',$data);
	 	$this->load->view('afiliasi/index',$data);
	 	// $this->load->view('produk/footer');
	 }
	 public function licence()
	 {
	 	$data['title'] = 'affilation page';
	    $this->load->model('Templates_model','peoples');
        $data['user'] = $this->peoples->user();    

	 	$this->load->view('produk/header',$data);
	 	$this->load->view('afiliasi/afiliasi',$data);
	 	$this->load->view('produk/footer');
	 }
	 
	//  public function registration()
	//  {
	 		
	//  		if (!aktif()) {
	//  			if (!$this->db->get_where('pengajuan',['email' => $this->session->userdata('email'),'role_id' => 2])->row_array()) {
	// 				$user = $this->db->get_where('user',['email' => $this->session->userdata('email')])->row_array();
	// 				$username = $user['name'];
				

					
	// 				$data = [
	// 					'username' => $username,
	// 					'email' => $this->session->userdata('email'),
	// 					'status' => 'affiliasi',
	// 					'role_id' => 2,
	// 					'tanggal' => time()

	// 				];


	// 				$this->db->insert('pengajuan',$data);
	// 				redirect('home');
	// 			}else{
	// 				redirect('home');
	// 			}
	//  		}

		
	 		


	//  }

}