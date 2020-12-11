<?php 

/**
 * 
 */
class Photos_model extends CI_model
{

	public function getAllPeoples()
	{
	  return $this->db->get('product')->result_array();
	}
	public function getPeoples($limit,$start,$keyword = null)
	{
		if ($keyword){
			$this->db->like('nama_barang',$keyword); 
			$this->db->or_like('jenis',$keyword);
			$this->db->or_like('kategori',$keyword);
		}
	  $this->db->where('jenis','Photo');
	  $this->db->order_by('rating', 'DESC');
	  return $this->db->get('product',$limit,$start)->result_array();
	}
	public function countAllPeoples()
	{
	  $this->db->where('jenis','Photo');
	  return $this->db->get('product')->num_rows();
	}
	public function user()
	{
		return $this->db->get_where('user',['email' => $this->session->userdata('email')])->row_array();
	}

}