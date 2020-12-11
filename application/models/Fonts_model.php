<?php 

/**
 * 
 */
class Fonts_model extends CI_model
{
	

	public function getAllPeoples()
	{
	  return $this->db->get('product')->result_array();
	}
	public function getPeoples($limit,$start,$keyword = null)
	{
		if ($keyword){
			$this->db->select('*');
			$this->db->where(['jenis' => 'Font','status' => 1]);
			$this->db->group_start();
			$this->db->like('nama_barang',$keyword); 
			$this->db->or_like('jenis',$keyword);
			$this->db->or_like('kategori',$keyword);
			$this->db->group_end();
			return $this->db->get('product',$limit,$start)->result_array();


		}
		else{
			
			$this->db->where(['jenis' => 'Font','status' => 1]);
			$this->db->order_by('rating', 'DESC');
			return $this->db->get('product',$limit,$start)->result_array();
		}
	  
	//   $this->db->where('jenis','Font');

	}
	public function countAllPeoples()
	{
	//   $this->db->where('jenis','Font');
	  $this->db->where(['jenis' => 'Font','status' => 1]);
	  return $this->db->get('product')->num_rows();
	}

	public function user()
	{
		return $this->db->get_where('user',['email' => $this->session->userdata('email')])->row_array();
	}

}