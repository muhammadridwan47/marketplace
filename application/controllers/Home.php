<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends  CI_Controller
{

	public function index()
    {
        // date('M j , Y H:i:s', strtotime("+1 day", strtotime(date("M j , Y H:i:s"))))

    //    echo date('M j , Y H:i:s', strtotime("+1 day", strtotime(date("M j , Y H:i:s")))) - Jun 27 , 2020 17:33:13;

    //    if (date('M j , Y H:i:s', strtotime("+1 day", strtotime(date("M j , Y H:i:s")))) == 'Jun 27 , 2020 17:33:13') {
    //        echo 'mantap';
    //    }

    //    echo date('M j , Y H:i:s');
        
        // $user= $this->db->get_where('user',['email' => $this->session->userdata('email')])->row_array();

        // echo base64_encode('angga@gmail.com');

        // echo urlencode(base64_encode('rolilaz47@gmail.com'));

        // if (password_verify('123', $user['password'])) {
        //     echo '<br> ada';
        // }else{
        //     echo ' <br> tidak ada';
        // }

        

        $data['user'] = $this->db->get_where('user',['email' => $this->session->userdata('email')])->row_array();
        $data['home'] =1;
        $this->load->model('Home_model','peoples');

        $data['title'] = 'Graphic Suplement';

        // Stayling

        $config['full_tag_open'] = '<nav aria-label=""><ul class="pagination justify-content-center">';
        $config['full_tag_close'] = '</ul></nav>';

        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li class="page-item first" >';
        $config['first_tag_close'] = '</li>';
        
        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li class="page-item last">';
        $config['last_tag_close'] = '</li>';

        $config['next_link'] = 'Next';
        $config['next_tag_open'] = '<li class="page-item next">';
        $config['next_tag_close'] = '</li>';

        $config['prev_link'] = 'Prev';
        $config['prev_tag_open'] = '<li class="page-item prev">';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="page-item active "><a href="#" class="page-link border-0 rounded-0" >';
        $config['cur_tag_close'] = '</a></li>';

        $config['num_tag_open'] = '<li class="page-item isi ">';
        $config['num_tag_close'] = '</li>';

        $config['attributes'] = array('class' => 'page-link');

        $config['num_links'] = 1;
		// load library
        $this->load->library('pagination');



		// CONDFIG
		$config['base_url'] = base_url().'home/index';
		$config['total_rows'] = $this->peoples->countAllPeoples();
		$config['per_page'] = 27;

		// initialize
		$this->pagination->initialize($config);

		
		$data['start'] = $this->uri->segment(3);
        $data['produk'] = $this->peoples->getPeoples($config['per_page'],$data['start']);
        
            
                // $this->security->csrf_protection('FALSE');
                // $this->config->item('csrf_protection', FALSE);
                // $this->config->load('csrf_protection', FALSE);

		$this->load->view('home/index',$data);

	}


}
