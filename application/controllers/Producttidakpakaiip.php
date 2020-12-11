<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class Product extends  CI_Controller
{

    public function index()
    {

                $this->load->model('Product_model','peoples');
                if ($this->peoples->countAllPeoples() === 0) {
                     redirect('page_not_found');
                } 
                $data['user'] = $this->peoples->user();
                $data['title'] = 'halaman index';
                $data['periksa'] = 'n';

                // load library
                $this->load->library('pagination');

                //ambil data keyword
                if($this->input->post('submit')) {
                   $data['keyword'] = $this->input->post('keyword');
                   $this->session->set_userdata('keyword',$data['keyword']);
                }else{
                    $data['keyword'] = $this->session->userdata('keyword');
                }
                
                //config
                $config['base_url'] = base_url().'product/index';
                $this->db->like('nama_barang',$data['keyword']);
                $this->db->or_like('jenis',$data['keyword']);
                $this->db->or_like('kategori',$data['keyword']);
                $this->db->or_like('harga_dekstop',$data['keyword']);
                $this->db->from('product');
                $config['total_rows'] = $this->db->count_all_results();
                $data['total_rows'] = $config['total_rows'];
                $config['per_page'] = 27;

              

                 //initialize
                $this->pagination->initialize($config);

                        
                $data['start'] = $this->uri->segment(3);
                $data['produk'] = $this->peoples->getPeoples($config['per_page'],$data['start'],$data['keyword']);

                
        $this->load->view('produk/header',$data);
        $this->load->view('produk/body',$data);
        $this->load->view('produk/footer');
    }
        public function detail($nama_barang)
        {
          // $id  = dehashid($id);

          
          $nama_barang = str_replace('_', ' ', $nama_barang);

          $this->load->model('Graphics_model','peoples');

          $data['produk'] = $this->db->get_where('product',['nama_barang'=> $nama_barang])->row_array();
          $id = $data['produk']['id'];
          $email = $data['produk']['email'];
          $data['pemilik'] = $this->db->get_where('user',['email'=> $email ])->row_array();
          $data['colection'] = $this->db->get_where('colection',['id_barang'=> $id ])->result_array();
          $data['komentar'] = $this->db->get_where('komentar',['id_barang'=> $id ])->result_array();
          $data['suka'] = $this->db->get_where('suka',['id_barang'=> $id ])->result_array();
          $data['user'] = $this->peoples->user();
          
          $data['title'] = 'halaman index';  
          $this->load->view('produk/detail',$data); 
         if ($referal = $this->input->get('referal')) {
            $id_barang =  $data['produk']['id_barang'];
            

            $data = [
                'referal' => $referal,
                'id_barang' => $id_barang,
                'email' => $this->session->userdata('email')
            ];
            $this->db->insert('click_referal',$data);

          }             

        }
    public function graphics()
    {
         $this->load->model('Graphics_model','peoples');

         if ($this->peoples->countAllPeoples() === 0) {
             redirect('page_not_found');
          } 

   

    
        $data['user'] = $this->peoples->user();
        $data['title'] = 'halaman graphics';
        $data['periksa'] = 'n';

        // Stayling

        $config['full_tag_open'] = '<nav aria-label="page navigation example"><ul class="pagination justify-content-center">';
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
        $config['base_url'] = base_url().'product/graphics';
        $config['total_rows'] = $this->peoples->countAllPeoples();
        $config['per_page'] = 27;

        // initialize
        $this->pagination->initialize($config);

        
        $data['start'] = $this->uri->segment(3);
        $data['produk'] = $this->peoples->getPeoples($config['per_page'],$data['start']);

        $this->load->view('produk/header',$data);
        $this->load->view('produk/body',$data);
        $this->load->view('produk/footer');
    }

    public function templates()
    {

        $this->load->model('Templates_model','peoples');
         if ($this->peoples->countAllPeoples() === 0) {
             redirect('page_not_found');
          }         
        $data['user'] = $this->peoples->user();
        $data['title'] = 'halaman templates';
        $data['periksa'] = 'n';

        // Stayling

        $config['full_tag_open'] = '<nav aria-label="page navigation example"><ul class="pagination justify-content-center">';
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
        $config['base_url'] = base_url().'product/templates';
        $config['total_rows'] = $this->peoples->countAllPeoples();
        $config['per_page'] = 27;

        // initialize
        $this->pagination->initialize($config);

        
        $data['start'] = $this->uri->segment(3);
        $data['produk'] = $this->peoples->getPeoples($config['per_page'],$data['start']);

        $this->load->view('produk/header',$data);
        $this->load->view('produk/body',$data);
        $this->load->view('produk/footer');
    }

    public function photos()
    {
        $this->load->model('Photos_model','peoples');
         if ($this->peoples->countAllPeoples() === 0) {
             redirect('page_not_found');
          }     
        $data['user'] = $this->peoples->user();
        $data['title'] = 'halaman photos';
        $data['periksa'] = 'n';

        // Stayling

        $config['full_tag_open'] = '<nav aria-label="page navigation example"><ul class="pagination justify-content-center">';
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
        $config['base_url'] = base_url().'product/photos';
        $config['total_rows'] = $this->peoples->countAllPeoples();
        $config['per_page'] = 27;

        // initialize
        $this->pagination->initialize($config);

        
        $data['start'] = $this->uri->segment(3);
        $data['produk'] = $this->peoples->getPeoples($config['per_page'],$data['start']);

        $this->load->view('produk/header',$data);
        $this->load->view('produk/body',$data);
        $this->load->view('produk/footer');
    }

    public function illustrations()
    {
        $this->load->model('illustrations_model','peoples');
         if ($this->peoples->countAllPeoples() === 0) {
             redirect('page_not_found');
          }     
        $data['user'] = $this->peoples->user();
        $data['title'] = 'halaman illustrations';
        $data['periksa'] = 'n';

        // Stayling

        $config['full_tag_open'] = '<nav aria-label="page navigation example"><ul class="pagination justify-content-center">';
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
        $config['base_url'] = base_url().'product/illustrations';
        $config['total_rows'] = $this->peoples->countAllPeoples();
        $config['per_page'] = 27;

        // initialize
        $this->pagination->initialize($config);

        
        $data['start'] = $this->uri->segment(3);
        $data['produk'] = $this->peoples->getPeoples($config['per_page'],$data['start']);

        $this->load->view('produk/header',$data);
        $this->load->view('produk/body',$data);
        $this->load->view('produk/footer');
    }

    public function fonts()
    {
         $this->load->model('fonts_model','peoples');
         if ($this->peoples->countAllPeoples() === 0) {
             redirect('page_not_found');
          } 

        $data['user'] = $this->peoples->user();
        $data['title'] = 'halaman fonts';
        $data['periksa'] = 'n';

        // Stayling

        $config['full_tag_open'] = '<nav aria-label="page navigation example"><ul class="pagination justify-content-center">';
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
        $config['base_url'] = base_url().'product/fonts';
        $config['total_rows'] = $this->peoples->countAllPeoples();
        $config['per_page'] = 27;

        // initialize
        $this->pagination->initialize($config);

        
        $data['start'] = $this->uri->segment(3);
        $data['produk'] = $this->peoples->getPeoples($config['per_page'],$data['start']);

        $this->load->view('produk/header',$data);
        $this->load->view('produk/body',$data);
        $this->load->view('produk/footer');
    }

    public function mywishlist()
    {
   if ($this->db->get_where('user',['email' => $this->session->userdata('email')])->row_array()) {
       if (!$this->db->get_where('user',['email' => $this->session->userdata('email'),'is_active' => 1])->row_array()) {
              $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">This email has not been activated!</div>');
              redirect('auth');
        }
   }else{

      redirect('auth');

   }

        $this->load->model('Mywishlist_model','peoples');
        $data['user'] = $this->peoples->user();
        $data['title'] = 'halaman MywishList';
        $data['periksa'] = 'w';

        // Stayling

        $config['full_tag_open'] = '<nav aria-label="page navigation example"><ul class="pagination justify-content-center">';
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
        $config['base_url'] = base_url().'product/mywishlist';
        $config['total_rows'] = $this->peoples->countAllPeoples();
        $config['per_page'] = 27;

        // initialize
        $this->pagination->initialize($config);

        
        $data['start'] = $this->uri->segment(3);
        $data['produk'] = $this->peoples->getPeoples($config['per_page'],$data['start']);

        $this->load->view('produk/header',$data);
        $this->load->view('produk/body',$data);
        $this->load->view('produk/footer');
    }   

    public function love($id)
    {
       if (!$this->session->userdata('email')) {
        $output = [
             'login' => 'you must login'
            ];

             echo json_encode($output);
        }else{
            //  $output = [
            //  'success' => 'success save to colection'
            // ];

            // echo json_encode($output);
            $this->colection($id,'ok');

        }
    }

    public function thumb($id)
    {
       if (!$this->session->userdata('email')) {
        $output = [
             'login' => 'You must login'
            ];

             echo json_encode($output);
        }else{
            $id = dehashid($id);
            if (!$this->db->get_where('transaksi_paypal',['id_barang'=> $id,'email' => $this->session->userdata('email') ])->row_array()) {
                $output = [
                 'success' => 'You must buying to product'
                ];

                 echo json_encode($output);
            }else{
            //   $output = [
            //  'success' => 'success like'
            // ];

            //    echo json_encode($output);
               $this->like(hashid($id),'ok'); 


            }
            
        }
    }

    public function like($id,$status=null)
    {

        // if (!$this->session->userdata('email')) {
        //     redirect('auth');
        // }
        $id = dehashid($id);

        $pemilik = $this->db->get_where('product',['id'=> $id])->row_array();
        cekProductDetail($pemilik['nama_barang'],$this->session->userdata('email'));
        $nama_barang = str_replace(' ', '_', $pemilik['nama_barang']);
        if (!$this->db->get_where('transaksi_paypal',['id_barang'=> $id,'email' => $this->session->userdata('email') ])->row_array()) {
                                 $this->session->set_flashdata('message','    <div class="alert alert-warning alert-dismissible">
                      <button class="close" type="button" data-dismiss="alert">
                          <span>&times;</span>
                      </button>
                      You must Buying to  <strong>Product</strong>
                    </div>'); 
            if ($status != 'oke') {
                redirect('product/detail/'.$nama_barang);
            }
            
              
        }else{

            if (!$this->db->get_where('suka',['id_barang'=> $id,'email' => $this->session->userdata('email') ])->row_array()) {    
                $pemilik = $pemilik['email'];

                $data = [
                    'id_barang' => $id,
                    'tanggal' => time(),
                    'email' => $this->session->userdata('email'),
                    'pemilik' => $pemilik
                ];
                $this->db->insert('suka',$data);
             if ($status != 'ok') {
                redirect('product/detail/'.$nama_barang);
             }else{
                $output = [
                 'success' => 'success like'
                ];

               echo json_encode($output);
             }
            }else{

          if ($status != 'ok') {
                redirect('product/detail/'.$nama_barang);
            }else{
                 $output = [
                 'success' => 'have been to like'
                 ];

                 echo json_encode($output);
            }
            }
        }

    }           



    public function colection($id,$status=null)
    {

        // if (!$this->session->userdata('email')) {
        //     redirect('auth');
        // }

        $id = dehashid($id);
        $pemilik = $this->db->get_where('product',['id'=> $id])->row_array();
        
        
        cekProductDetail($pemilik['nama_barang'],$this->session->userdata('email'));
        
        $nama_barang = str_replace(' ', '_', $pemilik['nama_barang']);

        if ($this->db->get_where('colection',['id_barang'=> $id,'add' => $this->session->userdata('email') ])->row_array()) {
            if ($status != 'ok') {
                redirect('product/detail/'.$nama_barang);
            }
            $output = [
             'success' => 'have been to save'
            ];

            echo json_encode($output);
        }else{

            $point = $pemilik['point'] + 1;
            $rating = $pemilik['rating'] + 1;
           


            $set = [
            'point' => $point,
            'rating' => $rating
            
            ];

            $this->db->update('product', $set, ['id' => $id]);        
        
        
        $gambar1 = $pemilik['gambar1'];
        $jenis = $pemilik['jenis'];
        $lokasi_gambar = $pemilik['lokasi_gambar'];
        $email = $pemilik['email'];
       
       if ($pemilik['jenis'] == 'Font') {
            $harga_dekstop =  $pemilik['harga_dekstop'];
            $data = [
                'id_barang' => $id,
                'add' => $this->session->userdata('email'),
                'email' => $email,
                'nama_barang' => $nama_barang,
                'jenis' => $jenis,
                'harga_dekstop' => $harga_dekstop,
                'gambar1' => $gambar1,
                'lokasi_gambar' => $lokasi_gambar
                
            ];
       } else {
            $harga_dekstop =  $pemilik['harga_premium'];
            $data = [
                'id_barang' => $id,
                'add' => $this->session->userdata('email'),
                'email' => $email,
                'nama_barang' => $nama_barang,
                'jenis' => $jenis,
                'harga_dekstop' => $harga_dekstop,
                'gambar1' => $gambar1,
                'lokasi_gambar' => $lokasi_gambar
                
            ];
       }
       




        $this->db->insert('colection',$data);
            if ($status != 'ok') {
                redirect('product/detail/'.$nama_barang);
            }else{
            $output = [
             'success' => 'success save to colection'
            ];

            echo json_encode($output);
            }
        }

    }  


    public function komentar()
    {

    $id = $this->input->post('id');
    $produk = $this->db->get_where('product',['id'=> $id])->row_array();
    cekProductDetail($produk['nama_barang'],$this->session->userdata('email'));



     $profile = $this->db->get_where('user',['email'=> $this->session->userdata('email') ])->row_array();
     $gambar = $profile['lokasi'].$profile['image'];
     $ada = $this->db->get_where('product',['id'=> $id,'email'=> $this->session->userdata('email') ])->row_array();
     $alamatnama = str_replace(' ', '_', $produk['nama_barang']);
     $nama = $profile['name'];
     $review = htmlspecialchars($this->input->post('review',TRUE));
    


     if ($this->db->get_where('transaksi_paypal',['id_barang'=> $id,'email' => $this->session->userdata('email') ])->row_array()) {
         
         $data = [
            'nama' => $nama,
            'tipe' => 'pembeli',
            'review' => $review,
            'gambar' => $gambar,
            'id_barang' => $id,
            'email' => $this->session->userdata('email')

        ];

        $this->db->insert('komentar',$data);
        redirect('product/detail/'.$alamatnama);
     }elseif ($ada) {
         $data = [
            'nama' => $nama,
            'tipe' => 'desainer',
            'review' => $review,
            'gambar' => $gambar,
            'id_barang' => $id,
            'email' => $this->session->userdata('email')

        ];

        $this->db->insert('komentar',$data);
        redirect('product/detail/'.$alamatnama);
     }else{
         $data = [
            'nama' => $nama,
            'tipe' => 'pengunjung',
            'review' => $review,
            'gambar' => $gambar,
            'id_barang' => $id,
            'email' => $this->session->userdata('email')

        ];

        $this->db->insert('komentar',$data);
        redirect('product/detail/'.$alamatnama);
     }

     

    }

    public function render($id,$size=null)
    {

        if ($this->input->get('s')) {
           $text = $this->input->get('s');
           if ($size == null) {
               $ukuran = strlen($text) * 30;
               $tinggi = 57;
           }
           if ($size == 24) {
               $ukuran = strlen($text) * 30;
               $tinggi = 57;
           }
           elseif ($size == 36) {
               $ukuran = strlen($text) * 40;
               $tinggi = 61;
           }
           elseif ($size == 48) {
               $ukuran = strlen($text) * 50;
               $tinggi = 81;
           }elseif ($size == 72) {
               $ukuran = strlen($text) * 70;
               $tinggi = 119;
           }
           
        } else {
           $text = "WHEN ZOMBIES ARRIVES QUICKLY FAX JUDGE PAT";

           if ($size == null) {
            $ukuran = strlen($text) * 30;
            $tinggi = 57;
            }
            if ($size == 24) {
                $ukuran = strlen($text) * 30;
                $tinggi = 57;
            }
            elseif ($size == 36) {
                $ukuran = strlen($text) * 40;
                $tinggi = 61;
            }
            elseif ($size == 48) {
                $ukuran = strlen($text) * 50;
                $tinggi = 81;
            }elseif ($size == 72) {
                $ukuran = strlen($text) * 70;
                $tinggi = 119;
            }
        }
         // $data = $this->db->get_where('sub_product',['id_barang' => $id,'id' => 312])->result_array();
        
        if ($this->db->get_where('sub_product',['id_barang' => $id,'ektensi' => 'OTF/'])->result_array()) {
            $data = $this->db->get_where('sub_product',['id_barang' => $id,'ektensi' => 'OTF/'])->result_array();
        }else{
            $data = $this->db->get_where('sub_product',['id_barang' => $id,'ektensi' => 'TTF/'])->result_array();
        }


        //  $path = FCPATH.'renderingfont/';
        //  if (!file_exists($path)) {
        //     mkdir($path,0755,true);
        // } 

        $j = 1;
        $files = glob('renderingfont/*'); // Ambil semua file yang ada dalam folder
        foreach($files as $file){ // Lakukan perulangan dari file yang kita ambil
        if(is_file($file)) // Cek apakah file tersebut benar-benar ada
        unlink($file); // Jika ada, hapus file tersebut
        }

        header("Content-type: image/png");
        $img_width = $ukuran;
        $img_height = $tinggi;
        $img = imagecreatetruecolor($img_width, $img_height);
        $black = imagecolorallocate($img, 95, 93,93);
        $white = imagecolorallocate($img, 255, 255, 255); 
        imagefill($img, 0, 0, $white);
        imagecolortransparent($img,imagecolorallocate($img, 255, 255, 255));


        foreach ($data as $da ) {        
        $random1 = strtoupper(base64_encode(random_bytes(6)));
        $random = preg_replace('/[^A-Za-z0-9\  ]/', '',$random1);
      
        $lokasifont = FCPATH . '/'.$da['lokasi'].$da['file'];
        
       
        if ($size) {
            $ukuranfont = $size;
            if ($size == 24) {
                $atas = 1.5;
            }
            if ($size == 36) {
                $atas = 1.3;
            }
            if ($size == 48) {
                $atas = 1.3;
            }
            if ($size == 72) {
                $atas = 1.2;
            }
            
        }else{
            $ukuranfont = 24;
            $atas = 1.5;
        }

        


        
        imagettftext($img,$ukuranfont, 0, $img_width/700, $img_height/$atas,$black,$lokasifont,$text);  

        
        imagepng($img,'renderingfont/'.$j.'I'.$random.'.png');
        $j++;
        }   
        

        if (glob('renderingfont/*')) {
             $output = [
             'success' => 'success like'
            ];

             echo json_encode($output);
        }

       

    }


        public function free_download($id){
        $id = dehashid($id);
        $data = $this->db->get_where('product',['id' => $id])->row_array();
    
        if (!cekProductDetail($data['nama_barang'],$this->session->userdata('email'))) {
         $lokasi = $data['lokasi_gratis'].$data['file_gratis'];
         force_download($lokasi, NULL);
        }

        
        }
        public function desktop_download($id){
        $id = dehashid($id);
        $data = $this->db->get_where('product',['id' => $id])->row_array();
    
        if (!cekProductDetail($data['nama_barang'],$this->session->userdata('email'))) {
             if ($this->db->get_where('transaksi_paypal',['id_barang' => $id,'email' => $this->session->userdata('email'),'jenis' => 'desktop'])->row_array()) {
                 $lokasi = $data['lokasi_dekstop'].$data['file_dekstop'];
                 force_download($lokasi, NULL);
             }
         }
         

        
        }

        public function web_download($id){
        $id = dehashid($id);
        $data = $this->db->get_where('product',['id' => $id])->row_array();
    
        if (!cekProductDetail($data['nama_barang'],$this->session->userdata('email'))) {
             if ($this->db->get_where('transaksi_paypal',['id_barang' => $id,'email' => $this->session->userdata('email'),'jenis' => 'web'])->row_array()) {
                 $lokasi = $data['lokasi_web'].$data['file_web'];
                 force_download($lokasi, NULL);
             }
         }
         

        
        }
        public function app_download($id){
        $id = dehashid($id);
        $data = $this->db->get_where('product',['id' => $id])->row_array();
    
        if (!cekProductDetail($data['nama_barang'],$this->session->userdata('email'))) {
             if ($this->db->get_where('transaksi_paypal',['id_barang' => $id,'email' => $this->session->userdata('email'),'jenis' => 'app'])->row_array()) {
                 $lokasi = $data['lokasi_app'].$data['file_app'];
                 force_download($lokasi, NULL);
             }
         }
         

        
        }
        public function premium_download($id){
        $id = dehashid($id);
        $data = $this->db->get_where('product',['id' => $id])->row_array();
    
        if (!cekProductDetail($data['nama_barang'],$this->session->userdata('email'))) {
             if ($this->db->get_where('transaksi_paypal',['id_barang' => $id,'email' => $this->session->userdata('email'),'jenis' => 'premium'])->row_array()) {
                 $lokasi = $data['lokasi_premium'].$data['file_premium'];
                 force_download($lokasi, NULL);
             }
         }
         

        
        
        }
}