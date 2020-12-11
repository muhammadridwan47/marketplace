<?php 

/**
 * 
 */
class Mywishlist_model extends CI_model
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
	  $this->db->where('add',$this->session->userdata('email'));
	  return $this->db->get('colection',$limit,$start)->result_array();
	}
	public function countAllPeoples()
	{
	  return $this->db->get_where('colection',['add'=> $this->session->userdata('email')])->num_rows();
	}
	public function user()
	{
		return $this->db->get_where('user',['email' => $this->session->userdata('email')])->row_array();
	}

}