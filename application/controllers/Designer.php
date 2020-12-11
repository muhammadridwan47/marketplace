<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class Designer extends  CI_Controller
{

	public function  profile($nama = null)
	{
		if ($nama == null) {
			redirect('home');	
		}

	
		$nama = str_replace('_',' ', $nama);
		$data['title'] = 'Designer Page';
		$data['user'] = $this->db->get_where('user',['email' => $this->session->userdata('email')])->row_array();
		$data['profile'] = $this->db->get_where('user',['username' => $nama])->row_array();
		$email = $data['profile']['email'];

		if ($this->session->userdata('preview_designer') != $data['profile']['username']){
			$this->session->unset_userdata('keyword');
		}

			   // load library
			   $this->load->library('pagination');

			   //ambil data keyword
				if($this->input->post('submit')) {
					$data['keyword'] = $this->input->post('keyword');
					$this->session->set_userdata('keyword',$data['keyword']);
					$this->session->set_userdata('preview_designer',$data['profile']['username']);

				}else{
					$data['keyword'] = $this->session->userdata('keyword');
				}
			   
				if ($this->session->userdata('keyword')) {
					$this->db->select('*');
					$this->db->where('email',$email);
					// $this->db->where_in('WHEREIN', $var);
					$this->db->group_start();
					$this->db->like('nama_barang',$this->session->userdata('keyword'));
					$this->db->or_like('jenis',$this->session->userdata('keyword'));
					$this->db->or_like('kategori',$this->session->userdata('keyword'));
					$this->db->group_end();
					$query = $this->db->get('product')->result_array();
					$config['total_rows'] = count($query);
				}else{
   					$config['total_rows'] = count($this->db->get_where('product',['email' => $email])->result_array());
				}

				// var_dump($query);
			    
			   //config
			   $config['base_url'] = base_url().'designer/profile/'.str_replace(' ','_', $nama);              	  
			
			   
			
			   $config['per_page'] = 2;

				//initialize
			   $this->pagination->initialize($config);
					   
			   $data['start'] = $this->uri->segment(4);

			   if ($this->session->userdata('keyword')) {
					// $like = ['nama_barang' => $data['keyword']];
					// $this->db->like($like);

					$this->db->select('*');
					$this->db->where('email',$email);
					// $this->db->where_in('WHEREIN', $var);
					$this->db->group_start();
					$this->db->like('nama_barang',$this->session->userdata('keyword'));
					$this->db->or_like('jenis',$this->session->userdata('keyword'));
					$this->db->or_like('kategori',$this->session->userdata('keyword'));
					$this->db->group_end();
					$data['produk'] = $query = $this->db->get('product',$config['per_page'],$data['start'])->result_array();
			   }else{
			   $data['produk'] = $this->db->get_where('product',['email' => $email],$config['per_page'],$data['start'])->result_array();
			   }



			   

			   $this->load->view('designer/index',$data);

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


	 public function color()
	 {


		

        if ($this->input->is_ajax_request()) {
            if ($_SERVER['REQUEST_METHOD'] == 'GET')
            {
                $csrf_token =  $this->security->get_csrf_hash();
				$color = $this->db->escape_str($this->input->get('c',true));
				$m = $this->db->escape_str($this->input->get('m',true));
				
				// if ($c == 'checked') {
				// 	$color = '#454A4D';
				// }else{
				// 	$color = '#fffff';
				// }

				if ($m == 'about') {
					$this->db->set('color_about',$color);
				}
				if ($m == 'name') {
					$this->db->set('color_name',$color);
				}

				$this->db->where('email',$this->session->userdata('email'));
				$this->db->update('user');



				$data = [
					'error'   => 'success',
					
					];

					echo json_encode($data);

			}
		}
	 }
	 
	//  public function registration()
	//  {
	 	
	//  	$data['title'] = 'registration page';


	// 	if (!aktif()) {
	// 		if (!$this->db->get_where('pengajuan',['email' => $this->session->userdata('email'),'role_id' => 3])->row_array()) {
	 		
	 
	// 			$user = $this->db->get_where('user',['email' => $this->session->userdata('email')])->row_array();
	// 			$username = $user['name'];

	// 			$data = [
	// 				'username' => $username,
	// 				'email' => $this->session->userdata('email'),
	// 				'status' => 'designer',
	// 				'role_id' => 3,
	// 				'tanggal' => time()

	// 			];


	// 			$this->db->insert('pengajuan',$data);
	// 			redirect('home');
	// 		}else{
	// 			redirect('home');
	// 		}
	// 	}
		
	//  }

}