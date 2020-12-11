<?php 


class Barang extends  CI_Controller
{
   public function index()
	{ 
		$koneksi = mysqli_connect('localhost','root','','magenta');
		$data['query'] = $koneksi->query('select * from barang');
		$data['title'] = 'Barang';
		$data['user'] = $this->db->get_where('user',['email' => $this->session->userdata('email')])->row_array();
		$this->load->view('templates/header',$data);
		$this->load->view('templates/sidebar',$data);
		$this->load->view('templates/topbar',$data);
		$this->load->view('barang/index',$data);
		$this->load->view('templates/footer');
	}

	 public function tes()
	{
		echo json_encode($_GET);
	}
}