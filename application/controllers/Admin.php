<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends  CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		cekAdmin();

	}

	public function index()
	{ 
		$data['title'] = 'Dashboard';
		$data['user'] = $this->db->get_where('user',['email' => $this->session->userdata('email')])->row_array();
		$data['pengguna'] = $this->db->get_where('user',['role_id !=' => 5])->result_array();
		$data['transaksi'] = $this->db->query('SELECT SUM(harga) FROM transaksi_paypal')->result_array();
		$data['jumlah_transaksi'] = $this->db->get('transaksi_paypal')->result_array();

		

		$this->load->view('templates/header',$data);
		$this->load->view('templates/sidebar',$data);
		$this->load->view('templates/topbar',$data);
		$this->load->view('admin/index',$data);
		$this->load->view('templates/footer');
	}
		public function pengajuan()
	{ 
		$data['title'] = 'pengajuan';
		$data['user'] = $this->db->get_where('user',['email' => $this->session->userdata('email')])->row_array();
		$data['pengajuan'] = $this->db->get('pengajuan')->result_array();

		$this->load->view('templates/header',$data);
		$this->load->view('templates/sidebar',$data);
		$this->load->view('templates/topbar',$data);
		$this->load->view('admin/pengajuan',$data);
		$this->load->view('templates/footer');
	}
		public function akun()
	{ 
		$data['title'] = 'Akun';
		$data['user'] = $this->db->get_where('user',['email' => $this->session->userdata('email')])->row_array();
		$data['pengguna'] = $this->db->get_where('user',['role_id !=' => 5])->result_array();
		// $data['pengajuan'] = $this->db->get('pengajuan')->result_array();

		$this->load->view('templates/header',$data);
		$this->load->view('templates/sidebar',$data);
		$this->load->view('templates/topbar',$data);
		$this->load->view('admin/pengguna',$data);
		$this->load->view('templates/footer');
	}

		public function produk()
	{ 
		$data['title'] = 'produk';
		$data['user'] = $this->db->get_where('user',['email' => $this->session->userdata('email')])->row_array();
		$data['produk'] = $this->db->get('product')->result_array();

		$this->load->view('templates/header',$data);
		$this->load->view('templates/sidebar',$data);
		$this->load->view('templates/topbar',$data);
		$this->load->view('admin/produk',$data);
		$this->load->view('templates/footer');
	}

		public function transaksi()
	{ 
		$data['title'] = 'transaksi';
		$data['user'] = $this->db->get_where('user',['email' => $this->session->userdata('email')])->row_array();
		$data['transaksi'] = $this->db->get('transaksi_paypal')->result_array();

		$this->load->view('templates/header',$data);
		$this->load->view('templates/sidebar',$data);
		$this->load->view('templates/topbar',$data);
		$this->load->view('admin/transaksi',$data);
		$this->load->view('templates/footer');
	}
		
	public function role()
	{ 

		$role_id = htmlspecialchars($this->input->post('role_id',TRUE));
		$email = htmlspecialchars($this->input->post('email',TRUE));
	    $user = $this->db->get_where('user',['email' => $email])->row_array();

		if ($role_id == 2) {
		 $random1 = strtoupper(base64_encode(random_bytes(6)));
         $random = preg_replace('/[^A-Za-z0-9\  ]/', '',$random1);
         if (!$user['referal']) {
		  	$this->db->set('referal',$random);
		  }
		 
		}else{
		  if (!$user['referal']) {
		  		$random = null;
		  }
		}
		$this->db->set('role_id',$role_id);
		$this->db->where('email',$email);
		$this->db->update('user');


		redirect('admin/pengajuan');

		

	}
    

	
}