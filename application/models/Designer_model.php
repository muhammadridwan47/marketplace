<?php 

/**
 * 
 */
class Designer_model extends CI_model
{

	public function getAllPeoples()
	{
	  return $this->db->get('product')->result_array();
	}

	public function getPeoples($limit,$start,$email)
	{
		// $keyword = null;
		// if ($keyword){
		// 	$this->db->like('nama_barang',$keyword); 
		// 	$this->db->or_like('jenis',$keyword);
		// 	$this->db->or_like('kategori',$keyword);
		// }
	  $this->db->where('email',$email);
	  $this->db->order_by('rating', 'DESC');
	  
	  
	   $hasil = $this->db->get('product',$limit,$start)->result_array();
    //    $this->dapat($hasil);
	   return $hasil;
	}
	// public function dapat($dapat)
	// {
	  
	//   return $dapat;

	// }	

	public function countAllPeoples($email)
	{
	  $this->db->where('email',$email);
	  return $this->db->get('product')->num_rows();

	}



}