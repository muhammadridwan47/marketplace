<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class Upload extends  CI_Controller
{
    public function __construct()
    {
      parent::__construct();
      $this->load->library('image_lib');
      $this->load->library('upload');
      // cek();
    }

      public function index()
    {
      cekdesainer();

      if (!$this->session->userdata('email')) {
           redirect('home');
      }

      $data['judul'] = 'Halaman Upload';
      $data['user'] = $this->db->get_where('user',['email' => $this->session->userdata('email')])->row_array();

    


      $this->load->view('upload/upload_font',$data);
  
    }


    
    public function uploadFont()
    {
      if ($this->input->is_ajax_request()) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
                cekdesainer();

                $csrf_token =  $this->security->get_csrf_hash();
                $data = ['csrf_token' => $csrf_token];

                $this->form_validation->set_rules('namaproduk','Product Name','required|is_unique[product.nama_barang]');
                $this->form_validation->set_rules('deskripsi','Descriptions','required');
                $this->form_validation->set_rules('price','Price','required|numeric');
                $this->form_validation->set_rules('jenis','Category','required');
                $this->form_validation->set_rules('kategori','Sub Category','required');
                $this->form_validation->set_rules('tagline','Tagline','required');

                if ($this->form_validation->run() == false) {

                  $data += [
                            'error'   => true,
                            // 'nameProduct' => form_error('namaproduk'),
                            // 'deskripsi' => form_error('deskripsi'),
                            // 'price' => form_error('price')
                            'errors' => [validation_errors()]
                          ];

                    $this->output->set_content_type('application/json')->set_output(json_encode($data));
                    
                    return false;
                  
                }else{
                  

                      $email = $this->session->userdata('email');
                      $user  = $this->db->get_where('user',['email' => $email])->row_array();
                      $namaproduk = htmlspecialchars($this->db->escape_str($this->input->post('namaproduk')));
                      $deskripsi = htmlspecialchars($this->input->post('deskripsi'));
                      $jenis = htmlspecialchars($this->db->escape_str($this->input->post('jenis')));
                      $kategori = htmlspecialchars($this->db->escape_str($this->input->post('kategori')));
                      $price = htmlspecialchars($this->db->escape_str($this->input->post('price')));
                      $tagline = htmlspecialchars($this->db->escape_str($this->input->post('tagline')));
                      $random1 = strtoupper(base64_encode(random_bytes(6)));
                      $random = preg_replace('/[^A-Za-z0-9\  ]/', '',$random1);
                      $format_file = '';
                      $zip = new ZipArchive;


                      // Validation FIle Font 

                      if (isset($_FILES['file']['name'])){
                          $freeekstensi = explode('.', $_FILES['file']['name']);
                          $freeekstensi = strtolower(end($freeekstensi));
                          if( $freeekstensi != 'zip'){
                            $data += ["errors"=>['File Free Not upload because your file no like a zip file'],'error'   => true];
                            $this->output
                                ->set_content_type('application/json')
                                ->set_output(json_encode($data));
                                return false;
                          }       

                          // if ($_FILES['file']['size'] >= 1024 * 2000) {
                          //     $data += ["errors"=>"max size uploade file FREE VERSION 2MB",'error'   => true,];
                          //     $this->output
                          //         ->set_content_type('application/json')
                          //         ->set_output(json_encode($data));
                          //         return false;
                          // }
                          
              
                      }else{
                            $data += ["errors" => "You must upload file FREE VERSION",'error'   => true];
                            $this->output->set_content_type('application/json')->set_output(json_encode($data));
                            return false;	
                      }
                      // Upload File Font

                      $path = 'produk/'.$user['username'].'/'.$jenis.'/'.$namaproduk.'/'.$kategori.'/';

                      // file Free 
                      if ($_FILES['file']['name']) {
                            
                                //buat folder
                                $pathfolder = FCPATH.$path.'free/';
                                if (!file_exists($pathfolder)) {
                                    mkdir($pathfolder,0755,true);
                                }
              


                            if (move_uploaded_file($_FILES['file']['tmp_name'], $pathfolder.$_FILES['file']['name'])) {

                              if ($zip->open($pathfolder.'/'.$_FILES['file']['name']) === TRUE) {
                                for ($i = 0; $i < $zip->numFiles; $i++) {
                                        $appekstensi = explode('.',$zip->getNameIndex($i));
                                      $appekstensi = strtolower(end($appekstensi));
                                      $format_file  .= $appekstensi.'/';
                                }
                              }                         

                            }else{
                              $data += ["errors" => 'file free not upload','error'   => true];
                              $this->output->set_content_type('application/json')->set_output(json_encode($data));		
                            }
                      }



                  
                                
              
                      if ($jenis == 'Font') {
                              $hasil = [
                                'nama_barang' => $namaproduk,
                                'harga_web' => $price,
                                'harga_dekstop' => $price,
                                'harga_app' => $price,
                                'deskripsi' => $deskripsi,
                                'tagline' => $tagline,
                                'jenis' => $jenis,
                                'kategori' => $kategori,
                                'format_file' => $format_file,
                                'tanggal' => time(), 
                                'file_gratis' => $_FILES['file']['name'],
                                'lokasi_gratis' => $path.'free/',
                                'email' => $email,
                                'id_barang' => $random,
                                'tanggal_upload' => time()
                              ];
                      }else{
                        $hasil = [
                          'nama_barang' => $namaproduk,
                          'harga_premium' => $price,
                          'deskripsi' => $deskripsi,
                          'tagline' => $tagline,
                          'jenis' => $jenis,
                          'kategori' => $kategori,
                          'format_file' => $format_file,
                          'tanggal' => time(), 
                          'file_gratis' => $_FILES['file']['name'],
                          'lokasi_gratis' => $path.'free/',
                          'email' => $email,
                          'id_barang' => $random,
                          'tanggal_upload' => time()
                        ];                
                      }

                    if ($this->db->insert('product',$hasil)) {
                          $data += ["success"=>"uploaded successfully"];
                          $this->output
                              ->set_content_type('application/json')
                              ->set_output(json_encode($data));
                    }

                }

        }else{
          redirect('Notfound');
        }
      }else{
        redirect('Notfound');
      }
 
    }

    public function live(){
      if ($this->input->is_ajax_request()) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
              cekdesainer();
              $email = $this->session->userdata('email');
              // $id_barang = $this->input->get('n');
              $csrf_token =  $this->security->get_csrf_hash();
              $email = $this->session->userdata('email');
              $user  = $this->db->get_where('user',['email' => $email])->row_array();
              $namaproduk = htmlspecialchars($this->db->escape_str($this->input->post('np')));
              $deskripsi = htmlspecialchars($this->input->post('deskripsi'));
              $jenis = htmlspecialchars($this->db->escape_str($this->input->post('jenis')));
              $jx = htmlspecialchars($this->db->escape_str($this->input->post('jx')));
              $kategori = htmlspecialchars($this->db->escape_str($this->input->post('kategori')));
              $price = htmlspecialchars($this->db->escape_str($this->input->post('price')));
              $tagline = htmlspecialchars($this->db->escape_str($this->input->post('tagline')));
              $data = ['csrf_token' => $csrf_token];



        if ($product  = $this->db->get_where('product',['id_barang' => $jx,'email' => $email])->row_array()) {
            

            if ($jenis == 'null' || "") {
              $data += ["error"=> true,"message"=> 'Category is required' ];
              $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($data));
              return false;
              
            }else{

            // if ($jenis == "Font") {

            //   if ($product['jenis'] != 'Font') {

            //     if ($product['file_gratis'] || $product['file_premium']) {
            //         delete_directory(FCPATH.'produk/'.$user['id_designer'].'/'.$product['id_barang']);  
            //         $this->db->set('file_gratis','');
            //         $this->db->set('lokasi_gratis','');  
            //         $this->db->set('file_premium','');
            //         $this->db->set('lokasi_premium',''); 
            //         $this->db->set('format_file',''); 
            //         $this->db->where('id_barang',$product['id_barang']);
            //         $this->db->update('product');

            //         // $this->db->set('format_file','');
            //         $format_file = ''; 
                   
            //     }              
            //   }else{


            //     if ($product['file_gratis'] || $product['file_dekstop'] || $product['file_app'] || $product['file_web']) {
            //       delete_directory(FCPATH.'produk/'.$user['id_designer'].'/'.$product['id_barang']);  
            //       $this->db->where('id_barang',$product['id_barang']);
            //       $this->db->delete('sub_product');
            //       $this->db->set('file_gratis','');
            //       $this->db->set('lokasi_gratis','');  
            //       $this->db->set('file_premium','');
            //       $this->db->set('lokasi_premium','');  
            //       $this->db->set('file_dekstop','');
            //       $this->db->set('lokasi_dekstop',''); 
            //       $this->db->set('file_app','');
            //       $this->db->set('lokasi_app','');                              
            //       $this->db->set('file_web','');
            //       $this->db->set('lokasi_web','');      
            //       $this->db->set('format_file',''); 
            //       $this->db->where('id_barang',$product['id_barang']);
            //       $this->db->update('product');
            //       $format_file = '';                       
            //     }   
                
                

            //   } 
            // }else{

            //   if ($jenis == 'Photo') {
            //     if ($product['jenis'] != 'Font') {

            //       if ($product['file_gratis'] || $product['file_premium']) {
            //           delete_directory(FCPATH.'produk/'.$user['id_designer'].'/'.$product['id_barang']);  
            //           $this->db->set('file_gratis','');
            //           $this->db->set('lokasi_gratis','');  
            //           $this->db->set('file_premium','');
            //           $this->db->set('lokasi_premium',''); 
            //           $this->db->set('format_file',''); 
            //           $this->db->where('id_barang',$product['id_barang']);
            //           $this->db->update('product');
  
            //           // $this->db->set('format_file','');
            //           $format_file = ''; 
                     
            //       }              
            //     }else{
  
  
            //       if ($product['file_gratis'] || $product['file_dekstop'] || $product['file_app'] || $product['file_web']) {
            //         delete_directory(FCPATH.'produk/'.$user['id_designer'].'/'.$product['id_barang']);  
            //         $this->db->where('id_barang',$product['id_barang']);
            //         $this->db->delete('sub_product');
            //         $this->db->set('file_gratis','');
            //         $this->db->set('lokasi_gratis','');  
            //         $this->db->set('file_premium','');
            //         $this->db->set('lokasi_premium','');  
            //         $this->db->set('file_dekstop','');
            //         $this->db->set('lokasi_dekstop',''); 
            //         $this->db->set('file_app','');
            //         $this->db->set('lokasi_app','');                              
            //         $this->db->set('file_web','');
            //         $this->db->set('lokasi_web','');      
            //         $this->db->set('format_file',''); 
            //         $this->db->where('id_barang',$product['id_barang']);
            //         $this->db->update('product');
            //         $format_file = '';                       
            //       }   
                  
                  
  
            //     } 
            //   }

            //   if ($jenis == 'Graphic') {
            //     if ($product['jenis'] != 'Font') {

            //       if ($product['file_gratis'] || $product['file_premium']) {
            //           delete_directory(FCPATH.'produk/'.$user['id_designer'].'/'.$product['id_barang']);  
            //           $this->db->set('file_gratis','');
            //           $this->db->set('lokasi_gratis','');  
            //           $this->db->set('file_premium','');
            //           $this->db->set('lokasi_premium',''); 
            //           $this->db->set('format_file',''); 
            //           $this->db->where('id_barang',$product['id_barang']);
            //           $this->db->update('product');
  
            //           // $this->db->set('format_file','');
            //           $format_file = ''; 
                     
            //       }              
            //     }else{
  
  
            //       if ($product['file_gratis'] || $product['file_dekstop'] || $product['file_app'] || $product['file_web']) {
            //         delete_directory(FCPATH.'produk/'.$user['id_designer'].'/'.$product['id_barang']);  
            //         $this->db->where('id_barang',$product['id_barang']);
            //         $this->db->delete('sub_product');
            //         $this->db->set('file_gratis','');
            //         $this->db->set('lokasi_gratis','');  
            //         $this->db->set('file_premium','');
            //         $this->db->set('lokasi_premium','');  
            //         $this->db->set('file_dekstop','');
            //         $this->db->set('lokasi_dekstop',''); 
            //         $this->db->set('file_app','');
            //         $this->db->set('lokasi_app','');                              
            //         $this->db->set('file_web','');
            //         $this->db->set('lokasi_web','');      
            //         $this->db->set('format_file',''); 
            //         $this->db->where('id_barang',$product['id_barang']);
            //         $this->db->update('product');
            //         $format_file = '';                       
            //       }   
                  
                  
  
            //     } 
            //   }



            // }

            if ($product['jenis'] != $jenis) {
              if ($product['file_gratis'] || $product['file_premium'] || $product['file_dekstop'] || $product['file_app'] || $product['file_web']) {
                delete_directory(FCPATH.'produk/'.$user['id_designer'].'/'.$product['id_barang']);  
                $this->db->where('id_barang',$product['id_barang']);
                $this->db->delete('sub_product');
                $this->db->set('file_gratis','');
                $this->db->set('lokasi_gratis','');  
                $this->db->set('file_premium','');
                $this->db->set('lokasi_premium',''); 
                $this->db->set('file_dekstop','');
                $this->db->set('lokasi_dekstop',''); 
                $this->db->set('file_app','');
                $this->db->set('lokasi_app','');                              
                $this->db->set('file_web','');
                $this->db->set('lokasi_web','');  
                $this->db->set('format_file','');     
                $this->db->where('id_barang',$product['id_barang']);
                $this->db->update('product');                     
              }                          

            }




            $this->db->set('jenis',$jenis);
          }







              if (!$namaproduk) {
                    $data += ["error"=> true,"message"=> 'Product name is required' ];
                    $this->output
                      ->set_content_type('application/json')
                      ->set_output(json_encode($data));
                    return false;
              }else{
                if (!$this->db->get_Where('product',['nama_barang'=> $namaproduk,'id_barang'=> $jx,'email' => $email ])->row_array()) {
                  if($namaproduk){
                      if ($this->db->get_Where('product',['nama_barang'=> $namaproduk])->row_array()) {
                        $data += ["message"=>"Product name already exists",'error'   => true,];
                        $this->output->set_content_type('application/json')->set_output(json_encode($data));
                        return false;
                      }else{
                        $this->db->set('nama_barang',$namaproduk);

                          $lokasi = FCPATH.$product['lokasi_gambar'];
                          if ($product['gambar1']) {
                              rename($lokasi.$product['gambar1'],$lokasi.$namaproduk.'-1.jpg');
                              rename($lokasi.$product['imagecard'],$lokasi.$namaproduk.'-card.jpg');
                              rename($lokasi.$product['image1thumbnail'],$lokasi.$namaproduk.'-thumbnail1.jpg');
                              $this->db->set('gambar1',$namaproduk.'-1.jpg');
                              $this->db->set('imagecard',$namaproduk.'-card.jpg');
                              $this->db->set('image1thumbnail',$namaproduk.'-thumbnail1.jpg');
                          }
                          if ($product['gambar2']) {
                              rename($lokasi.$product['gambar2'],$lokasi.$namaproduk.'-2.jpg');
                              rename($lokasi.$product['image2thumbnail'],$lokasi.$namaproduk.'-thumbnail2.jpg');
                              $this->db->set('gambar2',$namaproduk.'-2.jpg');
                              $this->db->set('image2thumbnail',$namaproduk.'-thumbnail2.jpg');
                          }
                          if ($product['gambar3']) {
                              rename($lokasi.$product['gambar3'],$lokasi.$namaproduk.'-3.jpg');
                              rename($lokasi.$product['image3thumbnail'],$lokasi.$namaproduk.'-thumbnail3.jpg');
                              $this->db->set('gambar3',$namaproduk.'-3.jpg');
                              $this->db->set('image3thumbnail',$namaproduk.'-thumbnail3.jpg');
                          }
                          if ($product['gambar4']) {
                              rename($lokasi.$product['gambar4'],$lokasi.$namaproduk.'-4.jpg');
                              rename($lokasi.$product['image4thumbnail'],$lokasi.$namaproduk.'-thumbnail4.jpg');
                              $this->db->set('gambar4',$namaproduk.'-4.jpg');
                              $this->db->set('image4thumbnail',$namaproduk.'-thumbnail4.jpg');
                          }
                          if ($product['gambar5']) {
                              rename($lokasi.$product['gambar5'],$lokasi.$namaproduk.'-5.jpg');
                              rename($lokasi.$product['image5thumbnail'],$lokasi.$namaproduk.'-thumbnail5.jpg');
                              $this->db->set('gambar5',$namaproduk.'-5.jpg');
                              $this->db->set('image5thumbnail',$namaproduk.'-thumbnail5.jpg');
                          }



                      }
                  }
                }
              }


              if ($kategori == 'null') {
                $data += ["error"=> true,"message"=> 'Sub category is required' ];
                $this->output
                  ->set_content_type('application/json')
                  ->set_output(json_encode($data));
                return false;
              }else{
                $this->db->set('kategori',$kategori);
              }

              if (!$price) {
                $data += ["error"=> true,"message"=> 'price is required' ];
                $this->output
                  ->set_content_type('application/json')
                  ->set_output(json_encode($data));
                return false;
              }else{

               if ($product['jenis'] == 'Font') {
                  $this->db->set('harga_dekstop',$price);
                  $this->db->set('harga_web',$price);
                  $this->db->set('harga_app',$price);
               }else{
                $this->db->set('harga_premium',$price);
               }
              }

              if ($product['jenis'] == 'Font') {
                
                if (!$product['file_gratis']) {
                    $data += ["error"=> true,"message"=> 'File free version is required' ];
                    $this->output
                      ->set_content_type('application/json')
                      ->set_output(json_encode($data));
                    return false;               
                }
                if (!$product['file_dekstop']) {
                    $data += ["error"=> true,"message"=> 'File desktop is required' ];
                    $this->output
                      ->set_content_type('application/json')
                      ->set_output(json_encode($data));
                    return false;               
                }

                if (!$product['file_web']) {
                    $data += ["error"=> true,"message"=> 'File web is required' ];
                    $this->output
                      ->set_content_type('application/json')
                      ->set_output(json_encode($data));
                    return false;               
                }


              }else{

                if (!$product['file_gratis']) {
                  $data += ["error"=> true,"message"=> 'File free version is required' ];
                  $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($data));
                  return false;               
                }

                if (!$product['file_premium']) {
                  $data += ["error"=> true,"message"=> 'File premium is required' ];
                  $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($data));
                  return false;               
                }


              }


              if ($product['jenis'] == 'Font') {

                if ($product['gambar1'] &&  $product['gambar2'] && $product['gambar3'] && $product['gambar4'] && $product['gambar5']) {
            
                }else{
                  $data += ["error"=> true,"message"=> 'Image is required' ];
                  $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($data));
                  return false;   
                }

              }

              if ($product['jenis'] == 'Graphic') {

                if ($product['gambar1'] &&  $product['gambar2'] && $product['gambar3'] && $product['gambar4'] && $product['gambar5']) {
            
                }else{
                  $data += ["error"=> true,"message"=> 'Image is required' ];
                  $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($data));
                  return false;   
                }

              }

              if ($product['jenis'] == 'Photo') {

                if ($product['gambar1']) {
            
                }else{
                  $data += ["error"=> true,"message"=> 'Image is required' ];
                  $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($data));
                  return false;   
                }

              }

              if (!$deskripsi) {
                $data += ["error"=> true,"message"=> 'Description is required' ];
                $this->output
                  ->set_content_type('application/json')
                  ->set_output(json_encode($data));
                return false;
              }else{
                $this->db->set('deskripsi',$deskripsi);
              }
              if (!$tagline) {
                $data += ["error"=> true,"message"=> 'tagline is required' ];
                $this->output
                  ->set_content_type('application/json')
                  ->set_output(json_encode($data));
                return false;
              }else{
                $this->db->set('tagline',$tagline);
               }



              if ($product) {
                  $this->db->set('status','1');
                  $this->db->set('format_file',rtrim($product['format_file'],'/'));
                  $this->db->where(['id_barang' => $jx,'email' => $email]);
                if ($this->db->update('product')) {
                    $data += ["success"=> true ];
                    $this->output
                      ->set_content_type('application/json')
                      ->set_output(json_encode($data));
                }
              
              }

        }else{
          redirect('Notfound');
        }



        }else{
          redirect('Notfound');
        }
      }else{
        redirect('Notfound');
      }
 
    }

    public function uploadset()
    {
      if ($this->input->is_ajax_request()) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
                  cekdesainer();

                  $csrf_token =  $this->security->get_csrf_hash();
                  $data = ['csrf_token' => $csrf_token];

                    
                        $email = $this->session->userdata('email');
                        $user  = $this->db->get_where('user',['email' => $email])->row_array();
                        $namaproduk = htmlspecialchars($this->db->escape_str($this->input->post('np')));
                        $product  = $this->db->get_where('product',['nama_barang' => $namaproduk,'email' => $email])->row_array();
                        if(!$product){
                          redirect('pagenotfound');
                        }
                        $format_file = $product['format_file'];
                        $zip = new ZipArchive;


                        // Validation FIle Font 
                        if ($product['jenis'] == 'Font') {

                              if (!$product['file_dekstop']) {
                                
                                  if (isset($_FILES['desktop']['name'])) {
                                      $desktopekstensi = explode('.', $_FILES['desktop']['name']);
                                      $desktopekstensi = strtolower(end($desktopekstensi));
                                      if( $desktopekstensi != 'zip'){
                                          $data += ["errors"=>"File Desktop Not upload because your file no like a zip file",'error' => true];
                                        $this->output
                                            ->set_content_type('application/json')
                                            ->set_output(json_encode($data));
                                            return false;
                                      }
                    
                                      // if ($_FILES['desktop']['size'] >= 1024 * 2000) {
                                      //   $data += ["errors"=>"max size uploade file DESKTOP 2MB",'error'   => true,];
                                      //   $this->output
                                      //       ->set_content_type('application/json')
                                      //       ->set_output(json_encode($data));
                                      //       return false;
                                      // }
                                  }else{
                                        $data += ["errors" => "You must upload file Desktop",'error' => true];
                                        $this->output->set_content_type('application/json')->set_output(json_encode($data));
                                        return false;	
                                  }

                              }

                              if (!$product['file_app']) {
                                
                                if (isset($_FILES['app']['name'])) {
                                    $appekstensi = explode('.', $_FILES['app']['name']);
                                    $appekstensi = strtolower(end($appekstensi));
                                    if( $appekstensi != 'zip'){
                                        $data += ["errors"=>"File app Not upload because your file no like a zip file",'error'   => true];
                                      $this->output
                                          ->set_content_type('application/json')
                                          ->set_output(json_encode($data));
                                          return false;
                                    }	
                                    // if ($_FILES['app']['size'] >= 1024 * 2000) {
                                    //   $data += ["errors"=>"max size uploade file APP 2MB",'error'   => true,];
                                    //   $this->output
                                    //       ->set_content_type('application/json')
                                    //       ->set_output(json_encode($data));
                                    //       return false;
                                    // }        
                                }

                              }
                              if (!$product['file_web']) {
                                
                                if (isset($_FILES['web']['name'])) {
                                    $webekstensi = explode('.', $_FILES['web']['name']);
                                    $webekstensi = strtolower(end($webekstensi));
                                    if( $webekstensi != 'zip'){
                                        $data += ["errors"=>"File web Not upload because your file no like a zip file",'error'   => true];
                                      $this->output
                                          ->set_content_type('application/json')
                                          ->set_output(json_encode($data));
                                          return false;
                                    }		   
                                    
                                    // if ($_FILES['web']['size'] >= 1024 * 2000) {
                                    //   $data += ["errors"=>"max size uploade file WEB 2MB",'error'   => true,];
                                    //   $this->output
                                    //       ->set_content_type('application/json')
                                    //       ->set_output(json_encode($data));
                                    //       return false;
                                    // }
                                }

                              }

                          }else{
                            if(!$product['file_premium']) {
                                if (isset($_FILES['premium']['name'])) {
                                  $premiumekstensi = explode('.', $_FILES['premium']['name']);
                                  $premiumekstensi = strtolower(end($premiumekstensi));
                                    if( $premiumekstensi != 'zip'){
                                        $data += ["errors"=>"File premium Not upload because your file no like a zip file",'error'   => true,];
                                      $this->output
                                          ->set_content_type('application/json')
                                          ->set_output(json_encode($data));
                                          return false;
                                    }		 
                                    // if ($_FILES['premium']['size'] >= 1024 * 2000) {
                                    //   $data += ["errors"=>"max size uploade file PREMIUM 2MB",'error'   => true,];
                                    //   $this->output
                                    //       ->set_content_type('application/json')
                                    //       ->set_output(json_encode($data));
                                    //       return false;
                                    // }       
                                }
                            } 
                        }
                        
                        // Upload File Font

                        $path = 'produk/'.$user['username'].'/'.$product['jenis'].'/'.$product['nama_barang'].'/'.$product['kategori'].'/';

                    if ($product['jenis'] == 'Font') {
                        
                      if (!$product['file_dekstop']) {
                        // // File Desktop
                        if ($_FILES['desktop']['name']) {
                              
                                  //buat folder
                                  $pathfolder = FCPATH.$path.'desktop/';
                                  if (!file_exists($pathfolder)) {
                                      mkdir($pathfolder,0755,true);
                                  }
                
                              if (move_uploaded_file($_FILES['desktop']['tmp_name'], $pathfolder.$_FILES['desktop']['name'])) {

                                    
                                    if ($zip->open($pathfolder.'/'.$_FILES['desktop']['name']) === TRUE) {
                                      for ($i = 0; $i < $zip->numFiles; $i++) {
                                              $appekstensi = explode('.',$zip->getNameIndex($i));
                                            $appekstensi = strtolower(end($appekstensi));
                                            $format_file  .= $appekstensi.'/';
                                      }
                                    }

                                
                                      if($zip->open($pathfolder.'/'.$_FILES['desktop']['name'])){
                                          $zip->extractTo($pathfolder);
                                          $zip->close();
                                      }
                                    $zip_open = zip_open($pathfolder.'/'.$_FILES['desktop']['name']);
                                    while ($zip_entry = zip_read($zip_open)) {
                        
                        
                                          $nama =  zip_entry_name($zip_entry);
                                          // $ukuran =  zip_entry_filesize($zip_entry);
                                          $ujung = explode('.', $nama);
                                          $ujung = strtolower(end($ujung));
                                          $ektensi = $nama;
                                          $ektensi = explode('.', $ektensi);
                                          $ektensi = strtoupper(end($ektensi));
                                          $ektensi = $ektensi."/";
                                  
                                          $lok_dekstop = $path.'desktop/';
                                          if ($ujung == 'otf') {
                                                $isi = [
                                                'id_barang' => $product['id_barang'],
                                                'file' => $nama,
                                                'tipe' => 'dekstop',
                                                'ektensi' => $ektensi,
                                                'lokasi' => $lok_dekstop,
                                                'email' => $this->session->userdata('email')
                        
                                              ];
                                            $this->db->insert('sub_product',$isi);
                                          }else{
                                            if ($ujung == 'ttf') {
                                                  $isi = [
                                                  'id_barang' => $product['id_barang'],
                                                  'file' => $nama,
                                                  'tipe' => 'dekstop',
                                                  'ektensi' => $ektensi,
                                                  'lokasi' => $lok_dekstop,
                                                  'email' => $this->session->userdata('email')
                                                  ];
                                                $this->db->insert('sub_product',$isi);
                                            }
                                          }       
                                    }  
                                    
                                    
                                    $this->db->set('file_dekstop',$_FILES['desktop']['name']);
                                    $this->db->set('lokasi_dekstop',$path.'desktop/');
                                    $data += ["code" => $product['id_barang']];
                              }else{
                                    $data += ["errors" => 'file not upload','error'   => true];
                                    $this->output->set_content_type('application/json')->set_output(json_encode($data));			       
                              }
                        }
                      }
                      if (!$product['file_app']) {
                          if (isset($_FILES['app']['name'])) {
                                
                            //buat folder
                            $pathfolder = FCPATH.$path.'app/';
                            if (!file_exists($pathfolder)) {
                                mkdir($pathfolder,0755,true);
                            }

                            if (move_uploaded_file($_FILES['app']['tmp_name'], $pathfolder.$_FILES['app']['name'])) {
                    
                              if ($zip->open($pathfolder.'/'.$_FILES['app']['name']) === TRUE) {
                                for ($i = 0; $i < $zip->numFiles; $i++) {
                                        $appekstensi = explode('.',$zip->getNameIndex($i));
                                      $appekstensi = strtolower(end($appekstensi));
                                      $format_file  .= $appekstensi.'/';
                                }
                              }                      
                              $this->db->set('file_app',$_FILES['app']['name']);
                              $this->db->set('lokasi_app',$path.'app/');
                            }else{
                              $data += ["errors" => 'file app not upload','error'   => true];
                              $this->output->set_content_type('application/json')->set_output(json_encode($data));
                            }
                          }
                        }

                        if (!$product['file_web']) {

                          // file Web 
                          if (isset($_FILES['web']['name'])) {
                                
                                    //buat folder
                                    $pathfolder = FCPATH.$path.'web/';
                                    if (!file_exists($pathfolder)) {
                                        mkdir($pathfolder,0755,true);
                                    }
                  

                                if (move_uploaded_file($_FILES['web']['tmp_name'], $pathfolder.$_FILES['web']['name'])) {
                      
                                  if ($zip->open($pathfolder.$_FILES['web']['name']) === TRUE) {
                                    for ($i = 0; $i < $zip->numFiles; $i++) {
                                            $appekstensi = explode('.',$zip->getNameIndex($i));
                                          $appekstensi = strtolower(end($appekstensi));
                                          $format_file  .= $appekstensi.'/';
                                    }
                                  }                     
                                  $this->db->set('file_web',$_FILES['web']['name']);
                                  $this->db->set('lokasi_web',$path.'web/');
                                }else{
                                  $data += ["errors" => 'file web not upload','error'   => true];
                                  $this->output->set_content_type('application/json')->set_output(json_encode($data));	
                                }
                          }

                      }
                    }else{
                      if (!$product['file_premium']) {
                        if (isset($_FILES['premium']['name'])) {
                              
                                  //buat folder
                                  $pathfolder = FCPATH.$path.'premium/';
                                  if (!file_exists($pathfolder)) {
                                      mkdir($pathfolder,0755,true);
                                  }

                              if (move_uploaded_file($_FILES['premium']['tmp_name'], $pathfolder.$_FILES['premium']['name'])) {
                      
                                if ($zip->open($pathfolder.'/'.$_FILES['premium']['name']) === TRUE) {
                                  for ($i = 0; $i < $zip->numFiles; $i++) {
                                          $appekstensi = explode('.',$zip->getNameIndex($i));
                                        $appekstensi = strtolower(end($appekstensi));
                                        $format_file  .= $appekstensi.'/';
                                  }
                                }  
                                
                                $this->db->set('file_premium',$_FILES['premium']['name']);
                                $this->db->set('lokasi_premium',$path.'premium/');
                                
                              }else{
                                $data += ["errors" => 'file app not upload'];
                                $this->output->set_content_type('application/json')->set_output(json_encode($data));
                              }
                        }   
                      }        
                    }


                    // validasi image 

                    if (!$product['gambar1']) {
                      if (isset($_FILES['gambar1']['name'])) {
                        $gambar1ekstensi = explode('.', $_FILES['gambar1']['name']);
                        $gambar1ekstensi = strtolower(end($gambar1ekstensi));
                        if( $gambar1ekstensi != 'jpg'){
                            if( $gambar1ekstensi !=  'jpeg' ){
                              $data += ["errors"=>"File Image1 Not upload because your file no like a jpg or jpeg file",'error'   => true,];
                              $this->output->set_content_type('application/json')->set_output(json_encode($data));
                              return false;
                            }
                        }	        
            
                      } 
                    }
                    if (!$product['gambar2']) {
                      if (isset($_FILES['gambar2']['name'])) {
                        $gambar2ekstensi = explode('.', $_FILES['gambar2']['name']);
                        $gambar2ekstensi = strtolower(end($gambar2ekstensi));
                        if( $gambar2ekstensi != 'jpg'){
                            if( $gambar2ekstensi !=  'jpeg' ){
                              $data += ["errors"=>"File Image2 Not upload because your file no like a jpg or jpeg file",'error'   => true,];
                              $this->output->set_content_type('application/json')->set_output(json_encode($data));
                              return false;
                            }
                        }	        
            
                      } 
                    }
                    if (!$product['gambar3']) {
                      if (isset($_FILES['gambar3']['name'])) {
                        $gambar3ekstensi = explode('.', $_FILES['gambar3']['name']);
                        $gambar3ekstensi = strtolower(end($gambar3ekstensi));
                        if( $gambar3ekstensi != 'jpg'){
                            if( $gambar3ekstensi !=  'jpeg' ){
                              $data += ["errors"=>"File Image3 Not upload because your file no like a jpg or jpeg file",'error'   => true,];
                              $this->output->set_content_type('application/json')->set_output(json_encode($data));
                              return false;
                            }
                        }	        
            
                      }
                    }
                    if (!$product['gambar4']) {
                      if (isset($_FILES['gambar4']['name'])) {
                        $gambar4ekstensi = explode('.', $_FILES['gambar4']['name']);
                        $gambar4ekstensi = strtolower(end($gambar4ekstensi));
                        if( $gambar4ekstensi != 'jpg'){
                            if( $gambar4ekstensi !=  'jpeg' ){
                              $data += ["errors"=>"File Image4 Not upload because your file no like a jpg or jpeg file",'error'   => true,];
                              $this->output->set_content_type('application/json')->set_output(json_encode($data));
                              return false;
                            }
                        }	        
            
                      } 
                    }
                    if (!$product['gambar5']) {
                      if (isset($_FILES['gambar5']['name'])) {
                        $gambar5ekstensi = explode('.', $_FILES['gambar5']['name']);
                        $gambar5ekstensi = strtolower(end($gambar5ekstensi));
                        if( $gambar5ekstensi != 'jpg'){
                            if( $gambar5ekstensi !=  'jpeg' ){
                              $data += ["errors"=>"File Image5 Not upload because your file no like a jpg or jpeg file",'error'   => true,];
                              $this->output->set_content_type('application/json')->set_output(json_encode($data));
                              return false;
                            }
                        }	        
            
                      } 
                    }
            
                    $lokasi_gambar = 'gambar/'.$user['username'].'/'.$namaproduk.'/';

                    $buat_dir = FCPATH.$lokasi_gambar;
                    // buat folder
                    if (!file_exists($buat_dir)){
                      mkdir($buat_dir,0755,true);
                    }        

                    if (!$product['gambar1']) {


                        if(isset($_FILES['gambar1']['name'])){
                            $config['upload_path'] = './'.$lokasi_gambar; //path folder
                            $config['allowed_types'] = 'jpg|jpeg'; //type yang dapat diakses bisa anda sesuaikan
                            $config['file_name'] = $namaproduk.'-1'; //nama yang terupload nantinya
                    
                              $this->upload->initialize($config);
                            
                              if ($this->upload->do_upload('gambar1')){
                                  $gbr = $this->upload->data();

                                  $image1 = $gbr['file_name'];
                                  //Compress Image
                                  $config['image_library']='gd2';
                                  $config['source_image']= './'.$lokasi_gambar.$gbr['file_name'];
                                  $config['create_thumb']= FALSE;
                                  $config['maintain_ratio']= TRUE;
                                  $config['quality']= '75%';
                                  $config['width']= 675;
                                  $config['new_image']=  './'.$lokasi_gambar.$gbr['file_name'];
                                  $this->image_lib->initialize($config);
                                  $this->image_lib->resize();
                                  $this->image_lib->clear();
                              }
                    
                                  $config['file_name'] = $namaproduk.'-card'; //nama yang terupload nantinya
                                  $this->upload->initialize($config);
                              if ($this->upload->do_upload('gambar1')){
                                  $gbr = $this->upload->data();
                                  $imagecard = $gbr['file_name'];
                                  //Compress Image
                                  $config['image_library']='gd2';
                                  $config['source_image']= './'.$lokasi_gambar.$gbr['file_name'];
                                  $config['create_thumb']= FALSE;
                                  $config['maintain_ratio']= TRUE;
                                  $config['quality']= '75%';
                                  $config['width']= 342;
                                  // $config['height']= 228;
                                  $config['new_image']=  './'.$lokasi_gambar.$gbr['file_name'];
                                  $this->image_lib->initialize($config);
                                  $this->image_lib->resize();
                                  $this->image_lib->clear();
                              }

                                $config['file_name'] = $namaproduk.'-thumbnail1'; //nama yang terupload nantinya
                                $this->upload->initialize($config);
                              if ($this->upload->do_upload('gambar1')){
                                  $gbr = $this->upload->data();
                                  $image1thumbnail = $gbr['file_name'];
                                  //Compress Image
                                  $config['image_library']='gd2';
                                  $config['source_image']= './'.$lokasi_gambar.$gbr['file_name'];
                                  $config['create_thumb']= FALSE;
                                  $config['maintain_ratio']= TRUE;
                                  $config['quality']= '75%';
                                  $config['width']= 128;
                                  // $config['height']= 85;
                                  $config['new_image']=  './'.$lokasi_gambar.$gbr['file_name'];
                                  $this->image_lib->initialize($config);
                                  $this->image_lib->resize();
                                  $this->image_lib->clear();
                              }  

                              $this->db->set('lokasi_gambar',$lokasi_gambar);
                              $this->db->set('gambar1',$image1);
                              $this->db->set('imagecard',$imagecard);
                              $this->db->set('image1thumbnail',$image1thumbnail);
                              $data += ["lok"=>$lokasi_gambar,'image'=>$image1,'imagethumbnail'=>$image1thumbnail];
                        }

                    }
                    if (!$product['gambar2']) {

                        // gambar produk 2
                        if(isset($_FILES['gambar2']['name'])){
                            $config['upload_path'] = './'.$lokasi_gambar; //path folder
                            $config['allowed_types'] = 'jpg|jpeg'; //type yang dapat diakses bisa anda sesuaikan
                            $config['file_name'] = $namaproduk.'-2'; //nama yang terupload nantinya
                    
                              $this->upload->initialize($config);
                            
                              if ($this->upload->do_upload('gambar2')){
                                  $gbr = $this->upload->data();
                                  $image2 = $gbr['file_name'];
                                  //Compress Image
                                  $config['image_library']='gd2';
                                  $config['source_image']= './'.$lokasi_gambar.$gbr['file_name'];
                                  $config['create_thumb']= FALSE;
                                  $config['maintain_ratio']= TRUE;
                                  $config['quality']= '75%';
                                  $config['width']= 675;
                                  $config['new_image']=  './'.$lokasi_gambar.$gbr['file_name'];
                                  $this->image_lib->initialize($config);
                                  $this->image_lib->resize();
                                  $this->image_lib->clear();
                              }
                      
                              
                              // thumbnail produk detail 
                                $config['file_name'] = $namaproduk.'-thumbnail2'; //nama yang terupload nantinya
                                $this->upload->initialize($config);
                              if ($this->upload->do_upload('gambar2')){
                                  $gbr = $this->upload->data();
                                  $image2thumbnail = $gbr['file_name'];
                                  //Compress Image
                                  $config['image_library']='gd2';
                                  $config['source_image']= './'.$lokasi_gambar.$gbr['file_name'];
                                  $config['create_thumb']= FALSE;
                                  $config['maintain_ratio']= TRUE;
                                  $config['quality']= '75%';
                                  $config['width']= 128;
                                  // $config['height']= 85;
                                  $config['new_image']=  './'.$lokasi_gambar.$gbr['file_name'];
                                  $this->image_lib->initialize($config);
                                  $this->image_lib->resize();
                                  $this->image_lib->clear();
                              }  

                              $this->db->set('gambar2',$image2);
                              $this->db->set('image2thumbnail',$image2thumbnail);
                              $data += ["lok"=>$lokasi_gambar,'image'=>$image2,'imagethumbnail'=>$image2thumbnail];
                        }

                    }
                    if (!$product['gambar3']) {

                        // gambar produk 2
                        if(isset($_FILES['gambar3']['name'])){
                            $config['upload_path'] = './'.$lokasi_gambar; //path folder
                            $config['allowed_types'] = 'jpg|jpeg'; //type yang dapat diakses bisa anda sesuaikan
                            $config['file_name'] = $namaproduk.'-3'; //nama yang terupload nantinya
                    
                              $this->upload->initialize($config);
                            
                              if ($this->upload->do_upload('gambar3')){
                                  $gbr = $this->upload->data();
                                  $image3 = $gbr['file_name'];
                                  //Compress Image
                                  $config['image_library']='gd2';
                                  $config['source_image']= './'.$lokasi_gambar.$gbr['file_name'];
                                  $config['create_thumb']= FALSE;
                                  $config['maintain_ratio']= TRUE;
                                  $config['quality']= '75%';
                                  $config['width']= 675;
                                  $config['new_image']=  './'.$lokasi_gambar.$gbr['file_name'];
                                  $this->image_lib->initialize($config);
                                  $this->image_lib->resize();
                                  $this->image_lib->clear();
                              }
                      
                              
                              // thumbnail produk detail 
                                $config['file_name'] = $namaproduk.'-thumbnail3'; //nama yang terupload nantinya
                                $this->upload->initialize($config);
                              if ($this->upload->do_upload('gambar3')){
                                  $gbr = $this->upload->data();
                                  $image3thumbnail = $gbr['file_name'];
                                  //Compress Image
                                  $config['image_library']='gd2';
                                  $config['source_image']= './'.$lokasi_gambar.$gbr['file_name'];
                                  $config['create_thumb']= FALSE;
                                  $config['maintain_ratio']= TRUE;
                                  $config['quality']= '75%';
                                  $config['width']= 128;
                                  // $config['height']= 85;
                                  $config['new_image']=  './'.$lokasi_gambar.$gbr['file_name'];
                                  $this->image_lib->initialize($config);
                                  $this->image_lib->resize();
                                  $this->image_lib->clear();
                              }  

                              $this->db->set('gambar3',$image3);
                              $this->db->set('image3thumbnail',$image3thumbnail);
                              $data += ["lok"=>$lokasi_gambar,'image'=>$image3,'imagethumbnail'=>$image3thumbnail];
                        }

                    }
                    if (!$product['gambar4']) {

                        // gambar produk 2
                        if(isset($_FILES['gambar4']['name'])){
                            $config['upload_path'] = './'.$lokasi_gambar; //path folder
                            $config['allowed_types'] = 'jpg|jpeg'; //type yang dapat diakses bisa anda sesuaikan
                            $config['file_name'] = $namaproduk.'-4'; //nama yang terupload nantinya
                    
                              $this->upload->initialize($config);
                            
                              if ($this->upload->do_upload('gambar4')){
                                  $gbr = $this->upload->data();
                                  $image4 = $gbr['file_name'];
                                  //Compress Image
                                  $config['image_library']='gd2';
                                  $config['source_image']= './'.$lokasi_gambar.$gbr['file_name'];
                                  $config['create_thumb']= FALSE;
                                  $config['maintain_ratio']= TRUE;
                                  $config['quality']= '75%';
                                  $config['width']= 675;
                                  $config['new_image']=  './'.$lokasi_gambar.$gbr['file_name'];
                                  $this->image_lib->initialize($config);
                                  $this->image_lib->resize();
                                  $this->image_lib->clear();
                              }
                      
                              
                              // thumbnail produk detail 
                                $config['file_name'] = $namaproduk.'-thumbnail4'; //nama yang terupload nantinya
                                $this->upload->initialize($config);
                              if ($this->upload->do_upload('gambar4')){
                                  $gbr = $this->upload->data();
                                  $image4thumbnail = $gbr['file_name'];
                                  //Compress Image
                                  $config['image_library']='gd2';
                                  $config['source_image']= './'.$lokasi_gambar.$gbr['file_name'];
                                  $config['create_thumb']= FALSE;
                                  $config['maintain_ratio']= TRUE;
                                  $config['quality']= '75%';
                                  $config['width']= 128;
                                  // $config['height']= 85;
                                  $config['new_image']=  './'.$lokasi_gambar.$gbr['file_name'];
                                  $this->image_lib->initialize($config);
                                  $this->image_lib->resize();
                                  $this->image_lib->clear();
                              }  

                              $this->db->set('gambar4',$image4);
                              $this->db->set('image4thumbnail',$image4thumbnail);
                              $data += ["lok"=>$lokasi_gambar,'image'=>$image4,'imagethumbnail'=>$image4thumbnail];
                        }

                    }
                    if (!$product['gambar5']) {

                        // gambar produk 2
                        if(isset($_FILES['gambar5']['name'])){
                            $config['upload_path'] = './'.$lokasi_gambar; //path folder
                            $config['allowed_types'] = 'jpg|jpeg'; //type yang dapat diakses bisa anda sesuaikan
                            $config['file_name'] = $namaproduk.'-5'; //nama yang terupload nantinya
                    
                              $this->upload->initialize($config);
                            
                              if ($this->upload->do_upload('gambar5')){
                                  $gbr = $this->upload->data();
                                  $image5 = $gbr['file_name'];
                                  //Compress Image
                                  $config['image_library']='gd2';
                                  $config['source_image']= './'.$lokasi_gambar.$gbr['file_name'];
                                  $config['create_thumb']= FALSE;
                                  $config['maintain_ratio']= TRUE;
                                  $config['quality']= '75%';
                                  $config['width']= 675;
                                  $config['new_image']=  './'.$lokasi_gambar.$gbr['file_name'];
                                  $this->image_lib->initialize($config);
                                  $this->image_lib->resize();
                                  $this->image_lib->clear();
                              }
                      
                              
                              // thumbnail produk detail 
                                $config['file_name'] = $namaproduk.'-thumbnail5'; //nama yang terupload nantinya
                                $this->upload->initialize($config);
                              if ($this->upload->do_upload('gambar5')){
                                  $gbr = $this->upload->data();
                                  $image5thumbnail = $gbr['file_name'];
                                  //Compress Image
                                  $config['image_library']='gd2';
                                  $config['source_image']= './'.$lokasi_gambar.$gbr['file_name'];
                                  $config['create_thumb']= FALSE;
                                  $config['maintain_ratio']= TRUE;
                                  $config['quality']= '75%';
                                  $config['width']= 128;
                                  // $config['height']= 85;
                                  $config['new_image']=  './'.$lokasi_gambar.$gbr['file_name'];
                                  $this->image_lib->initialize($config);
                                  $this->image_lib->resize();
                                  $this->image_lib->clear();
                              }  

                              $this->db->set('gambar5',$image5);
                              $this->db->set('image5thumbnail',$image5thumbnail);
                              $data += ["lok"=>$lokasi_gambar,'image'=>$image5,'imagethumbnail'=>$image5thumbnail];
                        }

                    }
                          
                          $this->db->set('format_file',$format_file);

                          $this->db->where('id_barang',$product['id_barang']);

                      if ($this->db->update('product')) {
                        $data += ["success"=>"uploaded successfully desktop","format_file" => rtrim($format_file,'/')];
                        $this->output->set_content_type('application/json')->set_output(json_encode($data));
                      } 

        }else{
          redirect('Notfound');
        }                
      }else{
        redirect('Notfound');
      }                    
    }



      public function deletefile()
    {
        cekdesainer();
        $id = dehashid($this->input->post('n'));

        if (!$this->session->userdata('email')) {
           redirect('blocked');
        }

        if ($this->db->get_where('product',['id'=>$id,'email' => $this->session->userdata('email')])->row_array()) {
            $barang = $this->db->get_where('product',['id'=>$id,'email' => $this->session->userdata('email')])->row_array();
        }else{
             redirect('auth/blocked');
        }
        $id_barang = $barang['id_barang'];
        
        $profile = $this->db->get_where('user',['email' => $this->session->userdata('email')])->row_array();

        $hapusBarang = FCPATH.'produk/'.$profile['id_designer'].'/'.$barang['id_barang'];
        $hapusGambar = FCPATH.$barang['lokasi_gambar'];

      
            if ($barang['jenis'] == 'Font') {
                if ($barang['lokasi_dekstop'] || $barang['lokasi_gratis'] || $barang['lokasi_web'] || $barang['lokasi_app'] ) {
                  delete_directory($hapusBarang);
                  if ($barang['lokasi_gambar']) {
                    delete_directory($hapusGambar);
                  }
                }
               $this->db->delete('sub_product',['id_barang'=>$id_barang,'email' => $this->session->userdata('email')]); 
            }else{
              if ($barang['lokasi_premium'] || $barang['lokasi_gratis']) {
                delete_directory($hapusBarang);
                if ($barang['lokasi_gambar']) {
                  delete_directory($hapusGambar);
                }
              }
            }
            $this->db->delete('product',['id'=>$id,'email' => $this->session->userdata('email')]);
            redirect('profile/product');

    }

    public function edit($id_barang)
    {

      // $nama_barang = str_replace('_', ' ', $nama_barang);
      cekdesainer();

      if (!$this->session->userdata('email')) {
         redirect('blocked');
      }

      if ($data['barang'] = $this->db->get_where('product',['id_barang'=>$id_barang,'email' => $this->session->userdata('email')])->row_array()) {

  
        $data['judul'] = 'Halaman Edit';
        $data['user'] = $this->db->get_where('user',['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('upload/edit',$data);


      }else{
           redirect('auth/blocked');
      }





    }






    public function uploadProduct()
    {
      if ($this->input->is_ajax_request()) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {


          


                cekdesainer();
                $csrf_token =  $this->security->get_csrf_hash();
                $email = $this->session->userdata('email');
                $user  = $this->db->get_where('user',['email' => $email])->row_array();
                $namaproduk = htmlspecialchars($this->db->escape_str($this->input->post('np')));
                $deskripsi = htmlspecialchars($this->input->post('deskripsi'));
                $jenis = htmlspecialchars($this->db->escape_str($this->input->post('jenis')));
                $jx = htmlspecialchars($this->db->escape_str($this->input->post('jx')));
                $kategori = htmlspecialchars($this->db->escape_str($this->input->post('kategori')));
                $price = htmlspecialchars($this->db->escape_str($this->input->post('price')));
                $tagline = htmlspecialchars($this->db->escape_str($this->input->post('tagline')));
                $data = ['csrf_token' => $csrf_token];

                if (!$this->db->get_Where('product',['nama_barang'=> $namaproduk,'id_barang'=> $jx,'email' => $email ])->row_array()) {
                    if($namaproduk){
                      if ($this->db->get_Where('product',['nama_barang'=> $namaproduk])->row_array()) {
                          $data += ["errors"=>"Product name already exists",'error'   => true,];
                          $this->output->set_content_type('application/json')->set_output(json_encode($data));
                          return false;
                      }
                    }
                }

                $format_file = '';
                $zip = new ZipArchive;



            if ($product = $this->db->get_Where('product',['id_barang'=> $jx,'email' => $email ])->row_array()) {




                $format_file = $product['format_file'];

                      // validasi gambar

                      // if (!$product['gambar1']) {
                        if (isset($_FILES['gambar1']['name'])) {
                          $gambar1ekstensi = explode('.', $_FILES['gambar1']['name']);
                          $gambar1ekstensi = strtolower(end($gambar1ekstensi));
                          if( $gambar1ekstensi != 'jpg'){
                              if( $gambar1ekstensi !=  'jpeg' ){
                                $data += ["errors"=>"File Image1 Not upload because your file no like a jpg or jpeg file",'error'   => true,];
                                $this->output->set_content_type('application/json')->set_output(json_encode($data));
                                return false;
                              }
                          }	        
              
                        } 
                      // }
                      // if (!$product['gambar2']) {
                        if (isset($_FILES['gambar2']['name'])) {
                          $gambar2ekstensi = explode('.', $_FILES['gambar2']['name']);
                          $gambar2ekstensi = strtolower(end($gambar2ekstensi));
                          if( $gambar2ekstensi != 'jpg'){
                              if( $gambar2ekstensi !=  'jpeg' ){
                                $data += ["errors"=>"File Image2 Not upload because your file no like a jpg or jpeg file",'error'   => true,];
                                $this->output->set_content_type('application/json')->set_output(json_encode($data));
                                return false;
                              }
                          }	        
              
                        } 
                      // }
                      // if (!$product['gambar3']) {
                        if (isset($_FILES['gambar3']['name'])) {
                          $gambar3ekstensi = explode('.', $_FILES['gambar3']['name']);
                          $gambar3ekstensi = strtolower(end($gambar3ekstensi));
                          if( $gambar3ekstensi != 'jpg'){
                              if( $gambar3ekstensi !=  'jpeg' ){
                                $data += ["errors"=>"File Image3 Not upload because your file no like a jpg or jpeg file",'error'   => true,];
                                $this->output->set_content_type('application/json')->set_output(json_encode($data));
                                return false;
                              }
                          }	        
              
                        }
                      // }
                      // if (!$product['gambar4']) {
                        if (isset($_FILES['gambar4']['name'])) {
                          $gambar4ekstensi = explode('.', $_FILES['gambar4']['name']);
                          $gambar4ekstensi = strtolower(end($gambar4ekstensi));
                          if( $gambar4ekstensi != 'jpg'){
                              if( $gambar4ekstensi !=  'jpeg' ){
                                $data += ["errors"=>"File Image4 Not upload because your file no like a jpg or jpeg file",'error'   => true,];
                                $this->output->set_content_type('application/json')->set_output(json_encode($data));
                                return false;
                              }
                          }	        
              
                        } 

                      // if (!$product['gambar5']) {
                        if (isset($_FILES['gambar5']['name'])) {
                          $gambar4ekstensi = explode('.', $_FILES['gambar5']['name']);
                          $gambar4ekstensi = strtolower(end($gambar4ekstensi));
                          if( $gambar4ekstensi != 'jpg'){
                              if( $gambar4ekstensi !=  'jpeg' ){
                                $data += ["errors"=>"File Image4 Not upload because your file no like a jpg or jpeg file",'error'   => true,];
                                $this->output->set_content_type('application/json')->set_output(json_encode($data));
                                return false;
                              }
                          }	        
              
                        } 

                      // Validation FIle Font 

                      if (isset($_FILES['file']['name'])){
                        $freeekstensi = explode('.', $_FILES['file']['name']);
                        $freeekstensi = strtolower(end($freeekstensi));
                        if( $freeekstensi != 'zip'){
                          $data += ["errors"=>'File Free Not upload because your file no like a zip file','error'   => true];
                          // $data += ["errors"=>[$_POST],'error'   => true];
                          $this->output
                              ->set_content_type('application/json')
                              ->set_output(json_encode($data));
                              return false;
                        }       

                        // if ($_FILES['file']['size'] >= 1024 * 2000) {
                        //     $data += ["errors"=>"max size uploade file FREE VERSION 2MB",'error'   => true,];
                        //     $this->output
                        //         ->set_content_type('application/json')
                        //         ->set_output(json_encode($data));
                        //         return false;
                        // }
                        
             
                      }



                      if ($jenis == "Font") {

                        if (isset($_FILES['desktop']['name'])) {
                          $desktopekstensi = explode('.', $_FILES['desktop']['name']);
                          $desktopekstensi = strtolower(end($desktopekstensi));
                          if( $desktopekstensi != 'zip'){
                              $data += ["errors"=>"File Desktop Not upload because your file no like a zip file",'error' => true];
                            $this->output
                                ->set_content_type('application/json')
                                ->set_output(json_encode($data));
                                return false;
                          }
        
                          // if ($_FILES['desktop']['size'] >= 1024 * 2000) {
                          //   $data += ["errors"=>"max size uploade file DESKTOP 2MB",'error'   => true,];
                          //   $this->output
                          //       ->set_content_type('application/json')
                          //       ->set_output(json_encode($data));
                          //       return false;
                          // }
                        }
  
                        if (isset($_FILES['web']['name'])) {
                          $webekstensi = explode('.', $_FILES['web']['name']);
                          $webekstensi = strtolower(end($webekstensi));
                          if( $webekstensi != 'zip'){
                              $data += ["errors"=>"File web Not upload because your file no like a zip file",'error'   => true];
                            $this->output
                                ->set_content_type('application/json')
                                ->set_output(json_encode($data));
                                return false;
                          }		   
                          
                        }
                        
                        if (isset($_FILES['app']['name'])) {
                          $appekstensi = explode('.', $_FILES['app']['name']);
                          $appekstensi = strtolower(end($appekstensi));
                          if( $appekstensi != 'zip'){
                              $data += ["errors"=>"File app Not upload because your file no like a zip file",'error'   => true];
                            $this->output
                                ->set_content_type('application/json')
                                ->set_output(json_encode($data));
                                return false;
                          }	     
                        }
                    
  
                    }else{


                      if (isset($_FILES['premium']['name'])) {
                        $premiumekstensi = explode('.', $_FILES['premium']['name']);
                        $premiumekstensi = strtolower(end($premiumekstensi));
                          if( $premiumekstensi != 'zip'){
                              $data += ["errors"=>"File premium Not upload because your file no like a zip file",'error'   => true,];
                            $this->output
                                ->set_content_type('application/json')
                                ->set_output(json_encode($data));
                                return false;
                          }		    
                      }

                    }




                    // Upload File Font
                    $path = 'produk/'.$user['id_designer'].'/'.$jx.'/';


                    if ($product['jenis'] != $jenis) {
                      if ($product['file_gratis'] || $product['file_premium'] || $product['file_dekstop'] || $product['file_app'] || $product['file_web']) {
                        delete_directory(FCPATH.'produk/'.$user['id_designer'].'/'.$product['id_barang']);  
                        $this->db->where('id_barang',$product['id_barang']);
                        $this->db->delete('sub_product');
                        $this->db->set('file_gratis','');
                        $this->db->set('lokasi_gratis','');  
                        $this->db->set('file_premium','');
                        $this->db->set('lokasi_premium',''); 
                        $this->db->set('file_dekstop','');
                        $this->db->set('lokasi_dekstop',''); 
                        $this->db->set('file_app','');
                        $this->db->set('lokasi_app','');                              
                        $this->db->set('file_web','');
                        $this->db->set('lokasi_web','');      
                        // $this->db->set('format_file',''); 
                        $format_file = '';                       
                      }                          

                    }else{
                        if ($product['file_gratis'] && $product['file_premium']) {
                          delete_directory(FCPATH.'produk/'.$user['id_designer'].'/'.$product['id_barang']);  
                          $this->db->where('id_barang',$product['id_barang']);
                          $this->db->delete('sub_product');
                          $this->db->set('file_gratis','');
                          $this->db->set('lokasi_gratis','');  
                          $this->db->set('file_premium','');
                          $this->db->set('lokasi_premium',''); 
                          $this->db->set('file_dekstop','');
                          $this->db->set('lokasi_dekstop',''); 
                          $this->db->set('file_app','');
                          $this->db->set('lokasi_app','');                              
                          $this->db->set('file_web','');
                          $this->db->set('lokasi_web','');      
                          // $this->db->set('format_file',''); 
                          $format_file = '';                       
                        }

                        // if ($product['file_gratis'] && $product['file_dekstop'] && $product['file_web']) {
                        //   delete_directory(FCPATH.'produk/'.$user['id_designer'].'/'.$product['id_barang']);  
                        //   $this->db->where('id_barang',$product['id_barang']);
                        //   $this->db->delete('sub_product');
                        //   $this->db->set('file_gratis','');
                        //   $this->db->set('lokasi_gratis','');  
                        //   $this->db->set('file_premium','');
                        //   $this->db->set('lokasi_premium',''); 
                        //   $this->db->set('file_dekstop','');
                        //   $this->db->set('lokasi_dekstop',''); 
                        //   $this->db->set('file_app','');
                        //   $this->db->set('lokasi_app','');                              
                        //   $this->db->set('file_web','');
                        //   $this->db->set('lokasi_web','');      
                        //   // $this->db->set('format_file',''); 
                        //   $format_file = '';                       
                        // }
                        
                        


                    }


                    if ($jenis == "Font") {

                      // if ($product['jenis'] != 'Font') {

                      //   if ($product['file_gratis'] || $product['file_premium']) {
                      //       delete_directory(FCPATH.'produk/'.$user['id_designer'].'/'.$product['id_barang']);  
                      //       $this->db->set('file_gratis','');
                      //       $this->db->set('lokasi_gratis','');  
                      //       $this->db->set('file_premium','');
                      //       $this->db->set('lokasi_premium',''); 
                      //       $this->db->where('id_barang',$product['id_barang']);

                      //       $this->db->update('product');

                      //       // $this->db->set('format_file','');
                      //       $format_file = ''; 
                           
                      //   }
                      // }


                            // file Free 
                            if (isset($_FILES['file']['name'])) {
                                  
                                      //buat folder
                                      $pathfolder = FCPATH.$path.'free/';
                                      if (!file_exists($pathfolder)) {
                                          mkdir($pathfolder,0755,true);
                                      }
                    
                                  if (move_uploaded_file($_FILES['file']['tmp_name'], $pathfolder.$_FILES['file']['name'])) {

                                    if ($zip->open($pathfolder.'/'.$_FILES['file']['name']) === TRUE) {
                                      // for ($i = 0; $i < $zip->numFiles; $i++) {
                                      //         $appekstensi = explode('.',$zip->getNameIndex($i));
                                      //       $appekstensi = strtolower(end($appekstensi));
                                      //       $format_file  .= $appekstensi.'/';
                                      // }
                                    }                         


                                    $this->db->set('file_gratis',$_FILES['file']['name']);
                                    $this->db->set('lokasi_gratis',$path.'free/');

                                  }else{
                                    $data += ["errors" => 'file free not upload','error'   => true];
                                    $this->output->set_content_type('application/json')->set_output(json_encode($data));		
                                  }
                            }





                              // // File Desktop
                        if (isset($_FILES['desktop']['name'])) {
                                    
                                //buat folder
                                $pathfolder = FCPATH.$path.'desktop/';
                                if (!file_exists($pathfolder)) {
                                    mkdir($pathfolder,0755,true);
                                }
              
                            if (move_uploaded_file($_FILES['desktop']['tmp_name'], $pathfolder.$_FILES['desktop']['name'])) {

                                  
                                  if ($zip->open($pathfolder.'/'.$_FILES['desktop']['name']) === TRUE) {
                                    for ($i = 0; $i < $zip->numFiles; $i++) {
                                            $appekstensi = explode('.',$zip->getNameIndex($i));
                                          $appekstensi = strtolower(end($appekstensi));
                                          $format_file  .= $appekstensi.'/';
                                    }
                                  }

                              
                                    if($zip->open($pathfolder.'/'.$_FILES['desktop']['name'])){
                                        $zip->extractTo($pathfolder);
                                        $zip->close();
                                    }
                                  $zip_open = zip_open($pathfolder.'/'.$_FILES['desktop']['name']);
                                  while ($zip_entry = zip_read($zip_open)) {
                      
                      
                                        $nama =  zip_entry_name($zip_entry);
                                        // $ukuran =  zip_entry_filesize($zip_entry);
                                        $ujung = explode('.', $nama);
                                        $ujung = strtolower(end($ujung));
                                        $ektensi = $nama;
                                        $ektensi = explode('.', $ektensi);
                                        $ektensi = strtoupper(end($ektensi));
                                        $ektensi = $ektensi."/";
                                
                                        $lok_dekstop = $path.'desktop/';
                                        if ($ujung == 'otf') {
                                              $isi = [
                                              'id_barang' => $product['id_barang'],
                                              'file' => $nama,
                                              'tipe' => 'dekstop',
                                              'ektensi' => $ektensi,
                                              'lokasi' => $lok_dekstop,
                                              'email' => $this->session->userdata('email')
                      
                                            ];
                                          $this->db->insert('sub_product',$isi);
                                        }else{
                                          if ($ujung == 'ttf') {
                                                $isi = [
                                                'id_barang' => $product['id_barang'],
                                                'file' => $nama,
                                                'tipe' => 'dekstop',
                                                'ektensi' => $ektensi,
                                                'lokasi' => $lok_dekstop,
                                                'email' => $this->session->userdata('email')
                                                ];
                                              $this->db->insert('sub_product',$isi);
                                          }
                                        }       
                                  }  
                                  
                                  
                                  $this->db->set('file_dekstop',$_FILES['desktop']['name']);
                                  $this->db->set('lokasi_dekstop',$path.'desktop/');
                                  $data += ["code" => $product['id_barang']];
                            }else{
                                  $data += ["errors" => 'file not upload','error'   => true];
                                  $this->output->set_content_type('application/json')->set_output(json_encode($data));			       
                            }
                        }
                    
                    
                        if (isset($_FILES['app']['name'])) {
                              
                          //buat folder
                          $pathfolder = FCPATH.$path.'app/';
                          if (!file_exists($pathfolder)) {
                              mkdir($pathfolder,0755,true);
                          }

                          if (move_uploaded_file($_FILES['app']['tmp_name'], $pathfolder.$_FILES['app']['name'])) {
                  
                            if ($zip->open($pathfolder.'/'.$_FILES['app']['name']) === TRUE) {
                              for ($i = 0; $i < $zip->numFiles; $i++) {
                                      $appekstensi = explode('.',$zip->getNameIndex($i));
                                    $appekstensi = strtolower(end($appekstensi));
                                    $format_file  .= $appekstensi.'/';
                              }
                            }                      
                            $this->db->set('file_app',$_FILES['app']['name']);
                            $this->db->set('lokasi_app',$path.'app/');
                          }else{
                            $data += ["errors" => 'file app not upload','error'   => true];
                            $this->output->set_content_type('application/json')->set_output(json_encode($data));
                          }
                        }
                      


                        // file Web 
                        if (isset($_FILES['web']['name'])) {
                              
                                  //buat folder
                                  $pathfolder = FCPATH.$path.'web/';
                                  if (!file_exists($pathfolder)) {
                                      mkdir($pathfolder,0755,true);
                                  }
                

                              if (move_uploaded_file($_FILES['web']['tmp_name'], $pathfolder.$_FILES['web']['name'])) {
                    
                                if ($zip->open($pathfolder.$_FILES['web']['name']) === TRUE) {
                                  for ($i = 0; $i < $zip->numFiles; $i++) {
                                          $appekstensi = explode('.',$zip->getNameIndex($i));
                                        $appekstensi = strtolower(end($appekstensi));
                                        $format_file  .= $appekstensi.'/';
                                  }
                                }                     
                                $this->db->set('file_web',$_FILES['web']['name']);
                                $this->db->set('lokasi_web',$path.'web/');
                              }else{
                                $data += ["errors" => 'file web not upload','error'   => true];
                                $this->output->set_content_type('application/json')->set_output(json_encode($data));	
                              }
                        }
                    }else{

                      // if ($product['jenis'] == 'Font') {

                      //     if ($product['file_gratis'] || $product['file_dekstop'] || $product['file_app'] || $product['file_web']) {
                      //         delete_directory(FCPATH.'produk/'.$user['id_designer'].'/'.$product['id_barang']);  
                      //         $this->db->where('id_barang',$product['id_barang']);
                      //         $this->db->delete('sub_product');
                      //         $this->db->set('file_gratis','');
                      //         $this->db->set('lokasi_gratis','');  
                      //         $this->db->set('file_dekstop','');
                      //         $this->db->set('lokasi_dekstop',''); 
                      //         $this->db->set('file_app','');
                      //         $this->db->set('lokasi_app','');                              
                      //         $this->db->set('file_web','');
                      //         $this->db->set('lokasi_web','');      
                      //         // $this->db->set('format_file',''); 
                      //         $format_file = '';                       
                      //     }
                      // }  


                      // if ($product['jenis'] != $jenis) {
                      //   if ($product['file_gratis'] || $product['file_premium'] || $product['file_dekstop'] || $product['file_app'] || $product['file_web']) {
                      //     delete_directory(FCPATH.'produk/'.$user['id_designer'].'/'.$product['id_barang']);  
                      //     $this->db->where('id_barang',$product['id_barang']);
                      //     $this->db->delete('sub_product');
                      //     $this->db->set('file_gratis','');
                      //     $this->db->set('lokasi_gratis','');  
                      //     $this->db->set('file_premium','');
                      //     $this->db->set('lokasi_premium',''); 
                      //     $this->db->set('file_dekstop','');
                      //     $this->db->set('lokasi_dekstop',''); 
                      //     $this->db->set('file_app','');
                      //     $this->db->set('lokasi_app','');                              
                      //     $this->db->set('file_web','');
                      //     $this->db->set('lokasi_web','');      
                      //     // $this->db->set('format_file',''); 
                      //     $format_file = '';                       
                      //   }                          

                      // }






          
                        // file Free 
                        if (isset($_FILES['file']['name'])) {
                              
                                  //buat folder
                                  $pathfolder = FCPATH.$path.'free/';
                                  if (!file_exists($pathfolder)) {
                                      mkdir($pathfolder,0755,true);
                                  }
                
                              if (move_uploaded_file($_FILES['file']['tmp_name'], $pathfolder.$_FILES['file']['name'])) {

                                if ($zip->open($pathfolder.'/'.$_FILES['file']['name']) === TRUE) {
                                  for ($i = 0; $i < $zip->numFiles; $i++) {
                                          $appekstensi = explode('.',$zip->getNameIndex($i));
                                        $appekstensi = strtolower(end($appekstensi));
                                        $format_file  .= $appekstensi.'/';
                                  }
                                }                         


                                $this->db->set('file_gratis',$_FILES['file']['name']);
                                $this->db->set('lokasi_gratis',$path.'free/');

                              }else{
                                $data += ["errors" => 'file free not upload','error'   => true];
                                $this->output->set_content_type('application/json')->set_output(json_encode($data));		
                              }
                        }
                        // file premium 
                        if (isset($_FILES['premium']['name'])) {
                              
                                  //buat folder
                                  $pathfolder = FCPATH.$path.'premium/';
                                  if (!file_exists($pathfolder)) {
                                      mkdir($pathfolder,0755,true);
                                  }
                

                              if (move_uploaded_file($_FILES['premium']['tmp_name'], $pathfolder.$_FILES['premium']['name'])) {
                    
                                if ($zip->open($pathfolder.$_FILES['premium']['name']) === TRUE) {
                                  for ($i = 0; $i < $zip->numFiles; $i++) {
                                          $appekstensi = explode('.',$zip->getNameIndex($i));
                                        $appekstensi = strtolower(end($appekstensi));
                                        $format_file  .= $appekstensi.'/';
                                  }
                                }                     
                                $this->db->set('file_premium',$_FILES['premium']['name']);
                                $this->db->set('lokasi_premium',$path.'premium/');
                              }else{
                                $data += ["errors" => 'file premium not upload','error'   => true];
                                $this->output->set_content_type('application/json')->set_output(json_encode($data));	
                              }
                        }
                    }








                        // buat gambar


                        $lokasi_gambar = 'gambar/'.$user['username'].'/'.$jx.'/';

                        $buat_dir = FCPATH.$lokasi_gambar;
                        // buat folder
                        if (!file_exists($buat_dir)){
                          mkdir($buat_dir,0755,true);
                        }   

                        if(isset($_FILES['gambar1']['name'])){
                            $config['upload_path'] = './'.$lokasi_gambar; //path folder
                            $config['allowed_types'] = 'jpg|jpeg'; //type yang dapat diakses bisa anda sesuaikan
                            $config['file_name'] = $namaproduk.'-1'; //nama yang terupload nantinya
                    
                              $this->upload->initialize($config);
                            
                              if ($this->upload->do_upload('gambar1')){
                                  $gbr = $this->upload->data();

                                  $image1 = $gbr['file_name'];
                                  //Compress Image
                                  $config['image_library']='gd2';
                                  $config['source_image']= './'.$lokasi_gambar.$gbr['file_name'];
                                  $config['create_thumb']= FALSE;
                                  $config['maintain_ratio']= TRUE;
                                  $config['quality']= '75%';
                                  $config['width']= 675;
                                  $config['new_image']=  './'.$lokasi_gambar.$gbr['file_name'];
                                  $this->image_lib->initialize($config);
                                  $this->image_lib->resize();
                                  $this->image_lib->clear();
                              }
                    
                                  $config['file_name'] = $namaproduk.'-card'; //nama yang terupload nantinya
                                  $this->upload->initialize($config);
                              if ($this->upload->do_upload('gambar1')){
                                  $gbr = $this->upload->data();
                                  $imagecard = $gbr['file_name'];
                                  //Compress Image
                                  $config['image_library']='gd2';
                                  $config['source_image']= './'.$lokasi_gambar.$gbr['file_name'];
                                  $config['create_thumb']= FALSE;
                                  $config['maintain_ratio']= TRUE;
                                  $config['quality']= '75%';
                                  $config['width']= 342;
                                  // $config['height']= 228;
                                  $config['new_image']=  './'.$lokasi_gambar.$gbr['file_name'];
                                  $this->image_lib->initialize($config);
                                  $this->image_lib->resize();
                                  $this->image_lib->clear();
                              }

                                $config['file_name'] = $namaproduk.'-thumbnail1'; //nama yang terupload nantinya
                                $this->upload->initialize($config);
                              if ($this->upload->do_upload('gambar1')){
                                  $gbr = $this->upload->data();
                                  $image1thumbnail = $gbr['file_name'];
                                  //Compress Image
                                  $config['image_library']='gd2';
                                  $config['source_image']= './'.$lokasi_gambar.$gbr['file_name'];
                                  $config['create_thumb']= FALSE;
                                  $config['maintain_ratio']= TRUE;
                                  $config['quality']= '75%';
                                  $config['width']= 128;
                                  // $config['height']= 85;
                                  $config['new_image']=  './'.$lokasi_gambar.$gbr['file_name'];
                                  $this->image_lib->initialize($config);
                                  $this->image_lib->resize();
                                  $this->image_lib->clear();
                              }  

                              $this->db->set('lokasi_gambar',$lokasi_gambar);
                              $this->db->set('gambar1',$image1);
                              $this->db->set('imagecard',$imagecard);
                              $this->db->set('image1thumbnail',$image1thumbnail);
                              $data += ["lok"=>$lokasi_gambar,'image'=>$image1,'imagethumbnail'=>$image1thumbnail];
                        }

                        // gambar produk 2
                        if(isset($_FILES['gambar2']['name'])){
                            $config['upload_path'] = './'.$lokasi_gambar; //path folder
                            $config['allowed_types'] = 'jpg|jpeg'; //type yang dapat diakses bisa anda sesuaikan
                            $config['file_name'] = $namaproduk.'-2'; //nama yang terupload nantinya
                    
                              $this->upload->initialize($config);
                            
                              if ($this->upload->do_upload('gambar2')){
                                  $gbr = $this->upload->data();
                                  $image2 = $gbr['file_name'];
                                  //Compress Image
                                  $config['image_library']='gd2';
                                  $config['source_image']= './'.$lokasi_gambar.$gbr['file_name'];
                                  $config['create_thumb']= FALSE;
                                  $config['maintain_ratio']= TRUE;
                                  $config['quality']= '75%';
                                  $config['width']= 675;
                                  $config['new_image']=  './'.$lokasi_gambar.$gbr['file_name'];
                                  $this->image_lib->initialize($config);
                                  $this->image_lib->resize();
                                  $this->image_lib->clear();
                              }
                      
                              
                              // thumbnail produk detail 
                                $config['file_name'] = $namaproduk.'-thumbnail2'; //nama yang terupload nantinya
                                $this->upload->initialize($config);
                              if ($this->upload->do_upload('gambar2')){
                                  $gbr = $this->upload->data();
                                  $image2thumbnail = $gbr['file_name'];
                                  //Compress Image
                                  $config['image_library']='gd2';
                                  $config['source_image']= './'.$lokasi_gambar.$gbr['file_name'];
                                  $config['create_thumb']= FALSE;
                                  $config['maintain_ratio']= TRUE;
                                  $config['quality']= '75%';
                                  $config['width']= 128;
                                  // $config['height']= 85;
                                  $config['new_image']=  './'.$lokasi_gambar.$gbr['file_name'];
                                  $this->image_lib->initialize($config);
                                  $this->image_lib->resize();
                                  $this->image_lib->clear();
                              }  

                              $this->db->set('gambar2',$image2);
                              $this->db->set('image2thumbnail',$image2thumbnail);
                              $data += ["lok"=>$lokasi_gambar,'image'=>$image2,'imagethumbnail'=>$image2thumbnail];
                        }


                        // gambar produk 3
                        if(isset($_FILES['gambar3']['name'])){
                          $config['upload_path'] = './'.$lokasi_gambar; //path folder
                          $config['allowed_types'] = 'jpg|jpeg'; //type yang dapat diakses bisa anda sesuaikan
                          $config['file_name'] = $namaproduk.'-3'; //nama yang terupload nantinya
                  
                            $this->upload->initialize($config);
                          
                            if ($this->upload->do_upload('gambar3')){
                                $gbr = $this->upload->data();
                                $image3 = $gbr['file_name'];
                                //Compress Image
                                $config['image_library']='gd2';
                                $config['source_image']= './'.$lokasi_gambar.$gbr['file_name'];
                                $config['create_thumb']= FALSE;
                                $config['maintain_ratio']= TRUE;
                                $config['quality']= '75%';
                                $config['width']= 675;
                                $config['new_image']=  './'.$lokasi_gambar.$gbr['file_name'];
                                $this->image_lib->initialize($config);
                                $this->image_lib->resize();
                                $this->image_lib->clear();
                            }
                    
                            
                            // thumbnail produk detail 
                              $config['file_name'] = $namaproduk.'-thumbnail3'; //nama yang terupload nantinya
                              $this->upload->initialize($config);
                            if ($this->upload->do_upload('gambar3')){
                                $gbr = $this->upload->data();
                                $image3thumbnail = $gbr['file_name'];
                                //Compress Image
                                $config['image_library']='gd2';
                                $config['source_image']= './'.$lokasi_gambar.$gbr['file_name'];
                                $config['create_thumb']= FALSE;
                                $config['maintain_ratio']= TRUE;
                                $config['quality']= '75%';
                                $config['width']= 128;
                                // $config['height']= 85;
                                $config['new_image']=  './'.$lokasi_gambar.$gbr['file_name'];
                                $this->image_lib->initialize($config);
                                $this->image_lib->resize();
                                $this->image_lib->clear();
                            }  

                            $this->db->set('gambar3',$image3);
                            $this->db->set('image3thumbnail',$image3thumbnail);
                            $data += ["lok"=>$lokasi_gambar,'image'=>$image3,'imagethumbnail'=>$image3thumbnail];
                      }                        


                        // gambar produk 4
                        if(isset($_FILES['gambar4']['name'])){
                          $config['upload_path'] = './'.$lokasi_gambar; //path folder
                          $config['allowed_types'] = 'jpg|jpeg'; //type yang dapat diakses bisa anda sesuaikan
                          $config['file_name'] = $namaproduk.'-4'; //nama yang terupload nantinya
                  
                            $this->upload->initialize($config);
                          
                            if ($this->upload->do_upload('gambar4')){
                                $gbr = $this->upload->data();
                                $image4 = $gbr['file_name'];
                                //Compress Image
                                $config['image_library']='gd2';
                                $config['source_image']= './'.$lokasi_gambar.$gbr['file_name'];
                                $config['create_thumb']= FALSE;
                                $config['maintain_ratio']= TRUE;
                                $config['quality']= '75%';
                                $config['width']= 675;
                                $config['new_image']=  './'.$lokasi_gambar.$gbr['file_name'];
                                $this->image_lib->initialize($config);
                                $this->image_lib->resize();
                                $this->image_lib->clear();
                            }
                    
                            
                            // thumbnail produk detail 
                              $config['file_name'] = $namaproduk.'-thumbnail4'; //nama yang terupload nantinya
                              $this->upload->initialize($config);
                            if ($this->upload->do_upload('gambar4')){
                                $gbr = $this->upload->data();
                                $image4thumbnail = $gbr['file_name'];
                                //Compress Image
                                $config['image_library']='gd2';
                                $config['source_image']= './'.$lokasi_gambar.$gbr['file_name'];
                                $config['create_thumb']= FALSE;
                                $config['maintain_ratio']= TRUE;
                                $config['quality']= '75%';
                                $config['width']= 128;
                                // $config['height']= 85;
                                $config['new_image']=  './'.$lokasi_gambar.$gbr['file_name'];
                                $this->image_lib->initialize($config);
                                $this->image_lib->resize();
                                $this->image_lib->clear();
                            }  

                            $this->db->set('gambar4',$image4);
                            $this->db->set('image4thumbnail',$image4thumbnail);
                            $data += ["lok"=>$lokasi_gambar,'image'=>$image4,'imagethumbnail'=>$image4thumbnail];
                      }


                        // gambar produk 5
                        if(isset($_FILES['gambar5']['name'])){
                          $config['upload_path'] = './'.$lokasi_gambar; //path folder
                          $config['allowed_types'] = 'jpg|jpeg'; //type yang dapat diakses bisa anda sesuaikan
                          $config['file_name'] = $namaproduk.'-5'; //nama yang terupload nantinya
                  
                            $this->upload->initialize($config);
                          
                            if ($this->upload->do_upload('gambar5')){
                                $gbr = $this->upload->data();
                                $image5 = $gbr['file_name'];
                                //Compress Image
                                $config['image_library']='gd2';
                                $config['source_image']= './'.$lokasi_gambar.$gbr['file_name'];
                                $config['create_thumb']= FALSE;
                                $config['maintain_ratio']= TRUE;
                                $config['quality']= '75%';
                                $config['width']= 675;
                                $config['new_image']=  './'.$lokasi_gambar.$gbr['file_name'];
                                $this->image_lib->initialize($config);
                                $this->image_lib->resize();
                                $this->image_lib->clear();
                            }
                    
                            
                            // thumbnail produk detail 
                              $config['file_name'] = $namaproduk.'-thumbnail5'; //nama yang terupload nantinya
                              $this->upload->initialize($config);
                            if ($this->upload->do_upload('gambar5')){
                                $gbr = $this->upload->data();
                                $image5thumbnail = $gbr['file_name'];
                                //Compress Image
                                $config['image_library']='gd2';
                                $config['source_image']= './'.$lokasi_gambar.$gbr['file_name'];
                                $config['create_thumb']= FALSE;
                                $config['maintain_ratio']= TRUE;
                                $config['quality']= '75%';
                                $config['width']= 128;
                                // $config['height']= 85;
                                $config['new_image']=  './'.$lokasi_gambar.$gbr['file_name'];
                                $this->image_lib->initialize($config);
                                $this->image_lib->resize();
                                $this->image_lib->clear();
                            }  

                            $this->db->set('gambar5',$image5);
                            $this->db->set('image5thumbnail',$image5thumbnail);
                            $data += ["lok"=>$lokasi_gambar,'image'=>$image5,'imagethumbnail'=>$image5thumbnail];
                      }



                    $this->db->set('nama_barang',$namaproduk);
                    $this->db->set('deskripsi',$deskripsi);
                    $this->db->set('kategori',$kategori);
                    $this->db->set('jenis',$jenis);

                    if ($jenis == 'Font') {
                        $this->db->set('harga_dekstop',$price);
                        $this->db->set('harga_web',$price);
                        $this->db->set('harga_app',$price);
                    }else{
                      $this->db->set('harga_premium',$price);
                    }

                    $this->db->set('format_file',$format_file);

                    $this->db->where('id_barang',$product['id_barang']);

                    if ($this->db->update('product')) {
                      $data += ["success"=>"update successfully ","format_file" => rtrim($format_file,'/')];
                      $this->output->set_content_type('application/json')->set_output(json_encode($data));
                    } 

                   
            }else{


              $file_gratis = "";
              $lokasi_gratis = "";
              $file_dekstop = "";
              $lokasi_dekstop = "";
              $file_app = "";
              $lokasi_app = "";
              $file_web = "";
              $lokasi_web = "";
              $file_premium = "";
              $lokasi_premium = "";
              $lokasi_gambar = "";
              $image1 = "";
              $image2 = "";
              $image3 = "";
              $image4 = "";
              $image5 = "";
              $imagecard  = "";
              $image1thumbnail = "";
              $image2thumbnail  = "";
              $image3thumbnail = "";
              $image4thumbnail = "";
              $image5thumbnail = "";



                      // validasi gambar

                      // if (!$product['gambar1']) {
                        if (isset($_FILES['gambar1']['name'])) {
                          $gambar1ekstensi = explode('.', $_FILES['gambar1']['name']);
                          $gambar1ekstensi = strtolower(end($gambar1ekstensi));
                          if( $gambar1ekstensi != 'jpg'){
                              if( $gambar1ekstensi !=  'jpeg' ){
                                $data += ["errors"=>"File Image1 Not upload because your file no like a jpg or jpeg file",'error'   => true,];
                                $this->output->set_content_type('application/json')->set_output(json_encode($data));
                                return false;
                              }
                          }	        
              
                        } 
                      // }
                      // if (!$product['gambar2']) {
                        if (isset($_FILES['gambar2']['name'])) {
                          $gambar2ekstensi = explode('.', $_FILES['gambar2']['name']);
                          $gambar2ekstensi = strtolower(end($gambar2ekstensi));
                          if( $gambar2ekstensi != 'jpg'){
                              if( $gambar2ekstensi !=  'jpeg' ){
                                $data += ["errors"=>"File Image2 Not upload because your file no like a jpg or jpeg file",'error'   => true,];
                                $this->output->set_content_type('application/json')->set_output(json_encode($data));
                                return false;
                              }
                          }	        
              
                        } 
                      // }
                      // if (!$product['gambar3']) {
                        if (isset($_FILES['gambar3']['name'])) {
                          $gambar3ekstensi = explode('.', $_FILES['gambar3']['name']);
                          $gambar3ekstensi = strtolower(end($gambar3ekstensi));
                          if( $gambar3ekstensi != 'jpg'){
                              if( $gambar3ekstensi !=  'jpeg' ){
                                $data += ["errors"=>"File Image3 Not upload because your file no like a jpg or jpeg file",'error'   => true,];
                                $this->output->set_content_type('application/json')->set_output(json_encode($data));
                                return false;
                              }
                          }	        
              
                        }
                      // }
                      // if (!$product['gambar4']) {
                        if (isset($_FILES['gambar4']['name'])) {
                          $gambar4ekstensi = explode('.', $_FILES['gambar4']['name']);
                          $gambar4ekstensi = strtolower(end($gambar4ekstensi));
                          if( $gambar4ekstensi != 'jpg'){
                              if( $gambar4ekstensi !=  'jpeg' ){
                                $data += ["errors"=>"File Image4 Not upload because your file no like a jpg or jpeg file",'error'   => true,];
                                $this->output->set_content_type('application/json')->set_output(json_encode($data));
                                return false;
                              }
                          }	        
              
                        } 
                      // }
                      // if (!$product['gambar5']) {
                        if (isset($_FILES['gambar5']['name'])) {
                          $gambar5ekstensi = explode('.', $_FILES['gambar5']['name']);
                          $gambar5ekstensi = strtolower(end($gambar5ekstensi));
                          if( $gambar5ekstensi != 'jpg'){
                              if( $gambar5ekstensi !=  'jpeg' ){
                                $data += ["errors"=>"File Image5 Not upload because your file no like a jpg or jpeg file",'error'   => true,];
                                $this->output->set_content_type('application/json')->set_output(json_encode($data));
                                return false;
                              }
                          }	        
              
                        } 
                      // }



                      // Validation FIle Font 

                      if (isset($_FILES['file']['name'])){
                        $freeekstensi = explode('.', $_FILES['file']['name']);
                        $freeekstensi = strtolower(end($freeekstensi));
                        if( $freeekstensi != 'zip'){
                          // $data += ["errors"=>['File Free Not upload because your file no like a zip file'],'error'   => true];
                          $data += ["errors"=>"File free version Not upload because your file no like a zip file",'error'   => true];
                          $this->output
                              ->set_content_type('application/json')
                              ->set_output(json_encode($data));
                              return false;
                        }       

                        // if ($_FILES['file']['size'] >= 1024 * 2000) {
                        //     $data += ["errors"=>"max size uploade file FREE VERSION 2MB",'error'   => true,];
                        //     $this->output
                        //         ->set_content_type('application/json')
                        //         ->set_output(json_encode($data));
                        //         return false;
                        // }
                        
             
                      }

                  if ($jenis == "Font") {

                      if (isset($_FILES['desktop']['name'])) {
                        $desktopekstensi = explode('.', $_FILES['desktop']['name']);
                        $desktopekstensi = strtolower(end($desktopekstensi));
                        if( $desktopekstensi != 'zip'){
                            $data += ["errors"=>"File Desktop Not upload because your file no like a zip file",'error' => true];
                          $this->output
                              ->set_content_type('application/json')
                              ->set_output(json_encode($data));
                              return false;
                        }
      
                        // if ($_FILES['desktop']['size'] >= 1024 * 2000) {
                        //   $data += ["errors"=>"max size uploade file DESKTOP 2MB",'error'   => true,];
                        //   $this->output
                        //       ->set_content_type('application/json')
                        //       ->set_output(json_encode($data));
                        //       return false;
                        // }
                      }

                      if (isset($_FILES['web']['name'])) {
                        $webekstensi = explode('.', $_FILES['web']['name']);
                        $webekstensi = strtolower(end($webekstensi));
                        if( $webekstensi != 'zip'){
                            $data += ["errors"=>"File web Not upload because your file no like a zip file",'error'   => true];
                          $this->output
                              ->set_content_type('application/json')
                              ->set_output(json_encode($data));
                              return false;
                        }		   
                        
                      }
                      
                      if (isset($_FILES['app']['name'])) {
                        $appekstensi = explode('.', $_FILES['app']['name']);
                        $appekstensi = strtolower(end($appekstensi));
                        if( $appekstensi != 'zip'){
                            $data += ["errors"=>"File app Not upload because your file no like a zip file",'error'   => true];
                          $this->output
                              ->set_content_type('application/json')
                              ->set_output(json_encode($data));
                              return false;
                        }	     
                      }
                  

                  }else{
                    if (isset($_FILES['premium']['name'])) {
                      $premiumekstensi = explode('.', $_FILES['premium']['name']);
                      $premiumekstensi = strtolower(end($premiumekstensi));
                        if( $premiumekstensi != 'zip'){
                            $data += ["errors"=>"File premium Not upload because your file no like a zip file",'error'   => true,];
                          $this->output
                              ->set_content_type('application/json')
                              ->set_output(json_encode($data));
                              return false;
                        }		    
                    }
                  }
                  


                  
                    // Upload File Font
                    $path = 'produk/'.$user['id_designer'].'/'.$jx.'/';

                    // file Free 
                    if (isset($_FILES['file']['name'])) {
                          
                              //buat folder
                              $pathfolder = FCPATH.$path.'free/';
                              if (!file_exists($pathfolder)) {
                                  mkdir($pathfolder,0755,true);
                              }
            
                          if (move_uploaded_file($_FILES['file']['tmp_name'], $pathfolder.$_FILES['file']['name'])) {

                            if ($zip->open($pathfolder.'/'.$_FILES['file']['name']) === TRUE) {
                              // for ($i = 0; $i < $zip->numFiles; $i++) {
                              //         $appekstensi = explode('.',$zip->getNameIndex($i));
                              //       $appekstensi = strtolower(end($appekstensi));
                              //       $format_file  .= $appekstensi.'/';
                              // }
                            }                         


                            $lokasi_gratis = $path.'free/';
                            $file_gratis = $_FILES['file']['name'];

                          }else{
                            $data += ["errors" => 'file free not upload','error'   => true];
                            $this->output->set_content_type('application/json')->set_output(json_encode($data));		
                          }
                    }




                  if ($jenis == "Font") {
                        if (isset($_FILES['desktop']['name'])) {
                              
                                  //buat folder
                                  $pathfolder = FCPATH.$path.'desktop/';
                                  if (!file_exists($pathfolder)) {
                                      mkdir($pathfolder,0755,true);
                                  }
                
                              if (move_uploaded_file($_FILES['desktop']['tmp_name'], $pathfolder.$_FILES['desktop']['name'])) {
                                $lokasi_dekstop = $path.'desktop/';
                                $file_dekstop = $_FILES['desktop']['name'];
                                    
                                    if ($zip->open($pathfolder.'/'.$_FILES['desktop']['name']) === TRUE) {
                                      for ($i = 0; $i < $zip->numFiles; $i++) {
                                              $appekstensi = explode('.',$zip->getNameIndex($i));
                                            $appekstensi = strtolower(end($appekstensi));
                                            $format_file  .= $appekstensi.'/';
                                      }
                                    }

                                
                                      if($zip->open($pathfolder.'/'.$_FILES['desktop']['name'])){
                                          $zip->extractTo($pathfolder);
                                          $zip->close();
                                      }
                                    $zip_open = zip_open($pathfolder.'/'.$_FILES['desktop']['name']);
                                    while ($zip_entry = zip_read($zip_open)) {
                        
                        
                                          $nama =  zip_entry_name($zip_entry);
                                          // $ukuran =  zip_entry_filesize($zip_entry);
                                          $ujung = explode('.', $nama);
                                          $ujung = strtolower(end($ujung));
                                          $ektensi = $nama;
                                          $ektensi = explode('.', $ektensi);
                                          $ektensi = strtoupper(end($ektensi));
                                          $ektensi = $ektensi."/";
                                  
                                          $lok_dekstop = $path.'desktop/';
                                          if ($ujung == 'otf') {
                                                $isi = [
                                                'id_barang' => $jx,
                                                'file' => $nama,
                                                'tipe' => 'dekstop',
                                                'ektensi' => $ektensi,
                                                'lokasi' => $lok_dekstop,
                                                'email' => $this->session->userdata('email')
                        
                                              ];
                                            $this->db->insert('sub_product',$isi);
                                          }else{
                                            if ($ujung == 'ttf') {
                                                  $isi = [
                                                  'id_barang' => $jx,
                                                  'file' => $nama,
                                                  'tipe' => 'dekstop',
                                                  'ektensi' => $ektensi,
                                                  'lokasi' => $lok_dekstop,
                                                  'email' => $this->session->userdata('email')
                                                  ];
                                                $this->db->insert('sub_product',$isi);
                                            }
                                          }       
                                    }  
                                    
                                    
                                    // $this->db->set('file_dekstop',$_FILES['desktop']['name']);
                                    // $this->db->set('lokasi_dekstop',$path.'desktop/');
                                    $data += ["code" => $jx];
                              }else{
                                    $data += ["errors" => 'file not upload','error'   => true];
                                    $this->output->set_content_type('application/json')->set_output(json_encode($data));			       
                              }
                         }

                         
                         if (isset($_FILES['app']['name'])) {
                                
                          //buat folder
                          $pathfolder = FCPATH.$path.'app/';
                          if (!file_exists($pathfolder)) {
                              mkdir($pathfolder,0755,true);
                          }

                          if (move_uploaded_file($_FILES['app']['tmp_name'], $pathfolder.$_FILES['app']['name'])) {
                  


                            if ($zip->open($pathfolder.'/'.$_FILES['app']['name']) === TRUE) {
                              for ($i = 0; $i < $zip->numFiles; $i++) {
                                      $appekstensi = explode('.',$zip->getNameIndex($i));
                                    $appekstensi = strtolower(end($appekstensi));
                                    $format_file  .= $appekstensi.'/';
                              }
                            }                      
                            $lokasi_app = $path.'app/';
                            $file_app = $_FILES['app']['name'];
                          }else{
                            $data += ["errors" => 'file app not upload','error'   => true];
                            $this->output->set_content_type('application/json')->set_output(json_encode($data));
                          }
                        }
                        
                          // file Web 
                          if (isset($_FILES['web']['name'])) {
                                
                                    //buat folder
                                    $pathfolder = FCPATH.$path.'web/';
                                    if (!file_exists($pathfolder)) {
                                        mkdir($pathfolder,0755,true);
                                    }
                  

                                if (move_uploaded_file($_FILES['web']['tmp_name'], $pathfolder.$_FILES['web']['name'])) {
                      
                                  if ($zip->open($pathfolder.$_FILES['web']['name']) === TRUE) {
                                    for ($i = 0; $i < $zip->numFiles; $i++) {
                                            $appekstensi = explode('.',$zip->getNameIndex($i));
                                          $appekstensi = strtolower(end($appekstensi));
                                          $format_file  .= $appekstensi.'/';
                                    }
                                  }                     
                                  $lokasi_web = $path.'web/';
                                  $file_web = $_FILES['web']['name'];
                                }else{
                                  $data += ["errors" => 'file web not upload','error'   => true];
                                  $this->output->set_content_type('application/json')->set_output(json_encode($data));	
                                }
                          }
                          
                          


                         

                  }
                  else{
                        if (isset($_FILES['premium']['name'])) {
                              
                                  //buat folder
                                  $pathfolder = FCPATH.$path.'premium/';
                                  if (!file_exists($pathfolder)) {
                                      mkdir($pathfolder,0755,true);
                                  }

                              if (move_uploaded_file($_FILES['premium']['tmp_name'], $pathfolder.$_FILES['premium']['name'])) {
                      
                                if ($zip->open($pathfolder.'/'.$_FILES['premium']['name']) === TRUE) {
                                  for ($i = 0; $i < $zip->numFiles; $i++) {
                                          $appekstensi = explode('.',$zip->getNameIndex($i));
                                        $appekstensi = strtolower(end($appekstensi));
                                        $format_file  .= $appekstensi.'/';
                                  }
                                }  
                                
                                $lokasi_premium = $path.'premium/';
                                $file_premium = $_FILES['premium']['name'];
                                
                              }else{
                                $data += ["errors" => 'file Premium not upload'];
                                $this->output->set_content_type('application/json')->set_output(json_encode($data));
                              }
                        } 
                                            
                  }




                $lokasi_gambar = 'gambar/'.$user['username'].'/'.$jx.'/';

                $buat_dir = FCPATH.$lokasi_gambar;
                // buat folder
                if (!file_exists($buat_dir)){
                  mkdir($buat_dir,0755,true);
                }        



                    if(isset($_FILES['gambar1']['name'])){
                        $config['upload_path'] = './'.$lokasi_gambar; //path folder
                        $config['allowed_types'] = 'jpg|jpeg'; //type yang dapat diakses bisa anda sesuaikan
                        $config['file_name'] = $namaproduk.'1'; //nama yang terupload nantinya
                
                          $this->upload->initialize($config);
                        
                          if ($this->upload->do_upload('gambar1')){
                              $gbr = $this->upload->data();

                              $image1 = $gbr['file_name'];
                              //Compress Image
                              $config['image_library']='gd2';
                              $config['source_image']= './'.$lokasi_gambar.$gbr['file_name'];
                              $config['create_thumb']= FALSE;
                              $config['maintain_ratio']= TRUE;
                              $config['quality']= '75%';
                              $config['width']= 675;
                              $config['new_image']=  './'.$lokasi_gambar.$gbr['file_name'];
                              $this->image_lib->initialize($config);
                              $this->image_lib->resize();
                              $this->image_lib->clear();
                          }
                
                              $config['file_name'] = $namaproduk.'card1'; //nama yang terupload nantinya
                              $this->upload->initialize($config);
                          if ($this->upload->do_upload('gambar1')){
                              $gbr = $this->upload->data();
                              $imagecard = $gbr['file_name'];
                              //Compress Image
                              $config['image_library']='gd2';
                              $config['source_image']= './'.$lokasi_gambar.$gbr['file_name'];
                              $config['create_thumb']= FALSE;
                              $config['maintain_ratio']= TRUE;
                              $config['quality']= '75%';
                              $config['width']= 342;
                              // $config['height']= 228;
                              $config['new_image']=  './'.$lokasi_gambar.$gbr['file_name'];
                              $this->image_lib->initialize($config);
                              $this->image_lib->resize();
                              $this->image_lib->clear();
                          }

                            $config['file_name'] = $namaproduk.'thumbnail1'; //nama yang terupload nantinya
                            $this->upload->initialize($config);
                          if ($this->upload->do_upload('gambar1')){
                              $gbr = $this->upload->data();
                              $image1thumbnail = $gbr['file_name'];
                              //Compress Image
                              $config['image_library']='gd2';
                              $config['source_image']= './'.$lokasi_gambar.$gbr['file_name'];
                              $config['create_thumb']= FALSE;
                              $config['maintain_ratio']= TRUE;
                              $config['quality']= '75%';
                              $config['width']= 128;
                              // $config['height']= 85;
                              $config['new_image']=  './'.$lokasi_gambar.$gbr['file_name'];
                              $this->image_lib->initialize($config);
                              $this->image_lib->resize();
                              $this->image_lib->clear();
                          }  

                          // $this->db->set('lokasi_gambar',$lokasi_gambar);
                          // $this->db->set('gambar1',$image1);
                          // $this->db->set('imagecard',$imagecard);
                          // $this->db->set('image1thumbnail',$image1thumbnail);
                          $data += ["lok"=>$lokasi_gambar,'image'=>$image1,'imagethumbnail'=>$image1thumbnail];
                    }

                

                    // gambar produk 2
                    if(isset($_FILES['gambar2']['name'])){
                        $config['upload_path'] = './'.$lokasi_gambar; //path folder
                        $config['allowed_types'] = 'jpg|jpeg'; //type yang dapat diakses bisa anda sesuaikan
                        $config['file_name'] = $namaproduk.'2'; //nama yang terupload nantinya
                
                          $this->upload->initialize($config);
                        
                          if ($this->upload->do_upload('gambar2')){
                              $gbr = $this->upload->data();
                              $image2 = $gbr['file_name'];
                              //Compress Image
                              $config['image_library']='gd2';
                              $config['source_image']= './'.$lokasi_gambar.$gbr['file_name'];
                              $config['create_thumb']= FALSE;
                              $config['maintain_ratio']= TRUE;
                              $config['quality']= '75%';
                              $config['width']= 675;
                              $config['new_image']=  './'.$lokasi_gambar.$gbr['file_name'];
                              $this->image_lib->initialize($config);
                              $this->image_lib->resize();
                              $this->image_lib->clear();
                          }
                  
                          
                          // thumbnail produk detail 
                            $config['file_name'] = $namaproduk.'thumbnail2'; //nama yang terupload nantinya
                            $this->upload->initialize($config);
                          if ($this->upload->do_upload('gambar2')){
                              $gbr = $this->upload->data();
                              $image2thumbnail = $gbr['file_name'];
                              //Compress Image
                              $config['image_library']='gd2';
                              $config['source_image']= './'.$lokasi_gambar.$gbr['file_name'];
                              $config['create_thumb']= FALSE;
                              $config['maintain_ratio']= TRUE;
                              $config['quality']= '75%';
                              $config['width']= 128;
                              // $config['height']= 85;
                              $config['new_image']=  './'.$lokasi_gambar.$gbr['file_name'];
                              $this->image_lib->initialize($config);
                              $this->image_lib->resize();
                              $this->image_lib->clear();
                          }  

                          // $this->db->set('gambar2',$image2);
                          // $this->db->set('image2thumbnail',$image2thumbnail);
                          $data += ["lok"=>$lokasi_gambar,'image'=>$image2,'imagethumbnail'=>$image2thumbnail];
                    }

                

                    // gambar produk 3
                    if(isset($_FILES['gambar3']['name'])){
                        $config['upload_path'] = './'.$lokasi_gambar; //path folder
                        $config['allowed_types'] = 'jpg|jpeg'; //type yang dapat diakses bisa anda sesuaikan
                        $config['file_name'] = $namaproduk.'3'; //nama yang terupload nantinya
                
                          $this->upload->initialize($config);
                        
                          if ($this->upload->do_upload('gambar3')){
                              $gbr = $this->upload->data();
                              $image3 = $gbr['file_name'];
                              //Compress Image
                              $config['image_library']='gd2';
                              $config['source_image']= './'.$lokasi_gambar.$gbr['file_name'];
                              $config['create_thumb']= FALSE;
                              $config['maintain_ratio']= TRUE;
                              $config['quality']= '75%';
                              $config['width']= 675;
                              $config['new_image']=  './'.$lokasi_gambar.$gbr['file_name'];
                              $this->image_lib->initialize($config);
                              $this->image_lib->resize();
                              $this->image_lib->clear();
                          }
                  
                          
                          // thumbnail produk detail 
                            $config['file_name'] = $namaproduk.'thumbnail3'; //nama yang terupload nantinya
                            $this->upload->initialize($config);
                          if ($this->upload->do_upload('gambar3')){
                              $gbr = $this->upload->data();
                              $image3thumbnail = $gbr['file_name'];
                              //Compress Image
                              $config['image_library']='gd2';
                              $config['source_image']= './'.$lokasi_gambar.$gbr['file_name'];
                              $config['create_thumb']= FALSE;
                              $config['maintain_ratio']= TRUE;
                              $config['quality']= '75%';
                              $config['width']= 128;
                              // $config['height']= 85;
                              $config['new_image']=  './'.$lokasi_gambar.$gbr['file_name'];
                              $this->image_lib->initialize($config);
                              $this->image_lib->resize();
                              $this->image_lib->clear();
                          }  

                          // $this->db->set('gambar3',$image3);
                          // $this->db->set('image3thumbnail',$image3thumbnail);
                          $data += ["lok"=>$lokasi_gambar,'image'=>$image3,'imagethumbnail'=>$image3thumbnail];
                    }


                    // gambar produk 4
                    if(isset($_FILES['gambar4']['name'])){
                        $config['upload_path'] = './'.$lokasi_gambar; //path folder
                        $config['allowed_types'] = 'jpg|jpeg'; //type yang dapat diakses bisa anda sesuaikan
                        $config['file_name'] = $namaproduk.'4'; //nama yang terupload nantinya
                
                          $this->upload->initialize($config);
                        
                          if ($this->upload->do_upload('gambar4')){
                              $gbr = $this->upload->data();
                              $image4 = $gbr['file_name'];
                              //Compress Image
                              $config['image_library']='gd2';
                              $config['source_image']= './'.$lokasi_gambar.$gbr['file_name'];
                              $config['create_thumb']= FALSE;
                              $config['maintain_ratio']= TRUE;
                              $config['quality']= '75%';
                              $config['width']= 675;
                              $config['new_image']=  './'.$lokasi_gambar.$gbr['file_name'];
                              $this->image_lib->initialize($config);
                              $this->image_lib->resize();
                              $this->image_lib->clear();
                          }
                  
                          
                          // thumbnail produk detail 
                            $config['file_name'] = $namaproduk.'thumbnail4'; //nama yang terupload nantinya
                            $this->upload->initialize($config);
                          if ($this->upload->do_upload('gambar4')){
                              $gbr = $this->upload->data();
                              $image4thumbnail = $gbr['file_name'];
                              //Compress Image
                              $config['image_library']='gd2';
                              $config['source_image']= './'.$lokasi_gambar.$gbr['file_name'];
                              $config['create_thumb']= FALSE;
                              $config['maintain_ratio']= TRUE;
                              $config['quality']= '75%';
                              $config['width']= 128;
                              // $config['height']= 85;
                              $config['new_image']=  './'.$lokasi_gambar.$gbr['file_name'];
                              $this->image_lib->initialize($config);
                              $this->image_lib->resize();
                              $this->image_lib->clear();
                          }  

                          // $this->db->set('gambar4',$image4);
                          // $this->db->set('image4thumbnail',$image4thumbnail);
                          $data += ["lok"=>$lokasi_gambar,'image'=>$image4,'imagethumbnail'=>$image4thumbnail];
                    }

                

                    // gambar produk 5
                    if(isset($_FILES['gambar5']['name'])){
                        $config['upload_path'] = './'.$lokasi_gambar; //path folder
                        $config['allowed_types'] = 'jpg|jpeg'; //type yang dapat diakses bisa anda sesuaikan
                        $config['file_name'] = $namaproduk.'5'; //nama yang terupload nantinya
                
                          $this->upload->initialize($config);
                        
                          if ($this->upload->do_upload('gambar5')){
                              $gbr = $this->upload->data();
                              $image5 = $gbr['file_name'];
                              //Compress Image
                              $config['image_library']='gd2';
                              $config['source_image']= './'.$lokasi_gambar.$gbr['file_name'];
                              $config['create_thumb']= FALSE;
                              $config['maintain_ratio']= TRUE;
                              $config['quality']= '75%';
                              $config['width']= 675;
                              $config['new_image']=  './'.$lokasi_gambar.$gbr['file_name'];
                              $this->image_lib->initialize($config);
                              $this->image_lib->resize();
                              $this->image_lib->clear();
                          }
                  
                          
                          // thumbnail produk detail 
                            $config['file_name'] = $namaproduk.'thumbnail5'; //nama yang terupload nantinya
                            $this->upload->initialize($config);
                          if ($this->upload->do_upload('gambar5')){
                              $gbr = $this->upload->data();
                              $image5thumbnail = $gbr['file_name'];
                              //Compress Image
                              $config['image_library']='gd2';
                              $config['source_image']= './'.$lokasi_gambar.$gbr['file_name'];
                              $config['create_thumb']= FALSE;
                              $config['maintain_ratio']= TRUE;
                              $config['quality']= '75%';
                              $config['width']= 128;
                              // $config['height']= 85;
                              $config['new_image']=  './'.$lokasi_gambar.$gbr['file_name'];
                              $this->image_lib->initialize($config);
                              $this->image_lib->resize();
                              $this->image_lib->clear();
                          }  

                          // $this->db->set('gambar5',$image5);
                          // $this->db->set('image5thumbnail',$image5thumbnail);
                          $data += ["lok"=>$lokasi_gambar,'image'=>$image5,'imagethumbnail'=>$image5thumbnail];
                    }



                      









                  
                                
              
                      if ($jenis == 'Font') {
                              $hasil = [
                                'nama_barang' => $namaproduk,
                                'harga_web' => $price,
                                'harga_dekstop' => $price,
                                'harga_app' => $price,
                                'deskripsi' => $deskripsi,
                                'tagline' => $tagline,
                                'jenis' => $jenis,
                                'kategori' => $kategori,
                                'format_file' => $format_file,
                                'tanggal' => time(), 
                                'file_gratis' => $file_gratis,
                                'lokasi_gratis' => $lokasi_gratis,
                                'file_dekstop' => $file_dekstop,
                                'lokasi_dekstop' => $lokasi_dekstop,
                                'file_app' => $file_app,
                                'lokasi_app' => $lokasi_app,
                                'file_web' => $file_web,
                                'lokasi_web' => $lokasi_web,
                                'lokasi_gambar' => $lokasi_gambar,
                                'gambar1' => $image1,
                                'gambar2' => $image2,
                                'gambar3' => $image3,
                                'gambar4' => $image4,
                                'gambar5' => $image5,
                                'imagecard' => $imagecard ,
                                'image1thumbnail' => $image1thumbnail,
                                'image2thumbnail' =>$image2thumbnail ,
                                'image3thumbnail' => $image3thumbnail,
                                'image4thumbnail' => $image4thumbnail,
                                'image5thumbnail' => $image5thumbnail,
                                'email' => $email,
                                'id_barang' => $jx,
                                'tanggal_upload' => time()
                              ];
                      }else{
                        $hasil = [
                          'nama_barang' => $namaproduk,
                          'harga_premium' => $price,
                          'deskripsi' => $deskripsi,
                          'tagline' => $tagline,
                          'jenis' => $jenis,
                          'kategori' => $kategori,
                          'format_file' => $format_file,
                          'tanggal' => time(), 
                          'file_gratis' => $file_gratis,
                          'lokasi_gratis' => $lokasi_gratis,
                          'file_premium' => $file_premium,
                          'lokasi_premium' => $lokasi_premium,
                          'lokasi_gambar' => $lokasi_gambar,
                          'gambar1' => $image1,
                          'gambar2' => $image2,
                          'gambar3' => $image3,
                          'gambar4' => $image4,
                          'gambar5' => $image5,
                          'imagecard' => $imagecard ,
                          'image1thumbnail' => $image1thumbnail,
                          'image2thumbnail' =>$image2thumbnail ,
                          'image3thumbnail' => $image3thumbnail,
                          'image4thumbnail' => $image4thumbnail,
                          'image5thumbnail' => $image5thumbnail,
                          'email' => $email,
                          'id_barang' => $jx,
                          'tanggal_upload' => time()
                        ];                
                      }

                    if ($this->db->insert('product',$hasil)) {
                          $data += ["success"=>"uploaded successfully","format_file"=> $format_file];
                          $this->output
                              ->set_content_type('application/json')
                              ->set_output(json_encode($data));
                    }


            }
           

        }else{
          redirect('Notfound');
        }
      }else{
        redirect('Notfound');
      }
 
    }


    public function deleteimage()
    {
      if ($this->input->is_ajax_request()) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
                cekdesainer();
                $csrf_token =  $this->security->get_csrf_hash();
                $email = $this->session->userdata('email');
                $jx = htmlspecialchars($this->db->escape_str($this->input->post('jx')));
                $js = htmlspecialchars($this->db->escape_str($this->input->post('js')));
                
                $data = ['csrf_token' => $csrf_token];

                 if ($barang = $this->db->get_Where('product',['id_barang'=> $jx,'email' => $email ])->row_array()) {

                  if ($js == '1') {
                    if ($barang['gambar1']) {
                        $gambar = $barang['gambar1'];
                        $thumbnail = $barang['image1thumbnail'];
                        unlink(FCPATH . $barang['lokasi_gambar'].$barang['imagecard']);
                        $this->db->set('gambar1','');
                        $this->db->set('image1thumbnail','');
                        $this->db->set('imagecard','');
                    }
                  }
                  if ($js == '2') {
                    if ($barang['gambar2']) {
                        $gambar = $barang['gambar2'];
                        $thumbnail = $barang['image2thumbnail'];
                        $this->db->set('gambar2','');
                        $this->db->set('image2thumbnail','');
                    }
                    
                  }
                  if ($js == '3') {
                    if ($barang['gambar3']) {
                        $gambar = $barang['gambar3'];
                        $thumbnail = $barang['image3thumbnail'];
                        $this->db->set('gambar3','');
                        $this->db->set('image3thumbnail','');
                    }

                  }
                  if ($js == '4') {
                    if ($barang['gambar4']) {
                        $gambar = $barang['gambar4'];
                        $thumbnail = $barang['image4thumbnail'];
                        $this->db->set('gambar4','');
                        $this->db->set('image4thumbnail','');
                    }

                  }
                  if ($js == '5') {
                    if ($barang['gambar5']) {
                        $gambar = $barang['gambar5'];
                        $thumbnail = $barang['image5thumbnail'];
                        $this->db->set('gambar5','');
                        $this->db->set('image5thumbnail','');
                    }
                    
                  }



                     unlink(FCPATH . $barang['lokasi_gambar'].$gambar);
                     unlink(FCPATH . $barang['lokasi_gambar'].$thumbnail);
                     
                     $this->db->Where(['id_barang' => $jx,'email' => $email]);
                     $this->db->update('product');

                     $data += ["success"=>"Image deleted"];
                     $this->output
                         ->set_content_type('application/json')
                         ->set_output(json_encode($data));

                 }else{
                  redirect('pagenotfound');
                 }
         }else{
          redirect('pagenotfound');
        }
      }else{
        redirect('pagenotfound');
      }
    }

    public function deleteproduct()
    {
      if ($this->input->is_ajax_request()) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
                cekdesainer();
                $csrf_token =  $this->security->get_csrf_hash();
                $email = $this->session->userdata('email');
                $jx = htmlspecialchars($this->db->escape_str($this->input->post('jx')));
                $js = htmlspecialchars($this->db->escape_str($this->input->post('js')));
                
                $data = ['csrf_token' => $csrf_token];

                 if ($barang = $this->db->get_Where('product',['id_barang'=> $jx,'email' => $email ])->row_array()) {

                  if ($js == 'free') {
                    if ($barang['file_gratis']) {
                      $this->db->set('file_gratis','');
                      $this->db->set('lokasi_gratis','');
                      $this->db->set('format_file','');
                      unlink(FCPATH . $barang['lokasi_gratis'].$barang['file_gratis']);
                    }
                  }
                  if ($js == 'desktop') {
                    if ($barang['file_dekstop']) {
                      $this->db->where('id_barang',$barang['id_barang']);
                      $this->db->delete('sub_product');
                      $this->db->set('file_dekstop','');
                      $this->db->set('lokasi_dekstop','');
                      $this->db->set('format_file','');
                      delete_directory(FCPATH . $barang['lokasi_dekstop']);
                    }
                    
                  }
                  if ($js == 'app') {
                    if ($barang['file_app']) {
                      $this->db->set('file_app','');
                      $this->db->set('lokasi_app','');
                      $this->db->set('format_file','');
                      delete_directory(FCPATH . $barang['lokasi_app']);
                    }

                  }
                  if ($js == 'web') {
                    if ($barang['file_web']) {
                      $this->db->set('file_web','');
                      $this->db->set('lokasi_web','');
                      $this->db->set('format_file','');
                      delete_directory(FCPATH . $barang['lokasi_web']);
                    }

                  }
                  if ($js == 'premium') {
                    if ($barang['file_premium']) {
                        $this->db->set('file_premium','');
                        $this->db->set('lokasi_premium','');
                        $this->db->set('format_file','');
                        delete_directory(FCPATH . $barang['lokasi_premium']);
                    }
                    
                  }



                     
                     
                     
                     $this->db->Where(['id_barang' => $jx,'email' => $email]);
                     $this->db->update('product');

                     $data += ["success"=>"uploaded successfully","format_file"=>""];
                     $this->output
                         ->set_content_type('application/json')
                         ->set_output(json_encode($data));

                 }else{
                  redirect('pagenotfound');
                 }
         }else{
          redirect('pagenotfound');
        }
      }else{
        redirect('pagenotfound');
      }
    }




    public function daily(){
      cekAdmin();

      $id = dehashid($this->input->post('n'));

      if (!$this->session->userdata('email')) {
         redirect('blocked');
      }

      if ($data = $this->db->get_where('product',['daily_deal' => '1'])->row_array()) {
        $this->db->set('daily_Deal','0');
        $this->db->set('time_daily','0');
        $this->db->set('waktu_daily','');
        $this->db->where('id',$data['id']);
        $this->db->update('product');
      }


      if ($this->db->get_where('product',['id'=>$id,'daily_deal' => '0'])->row_array()) {

          $this->db->set('daily_Deal','1');
          $this->db->set('time_daily',time());
          $this->db->set('waktu_daily',date('M j , Y H:i:s', strtotime("+1 day", strtotime(date("M j , Y H:i:s")))));
          $this->db->where('id',$id);
          $this->db->update('product');
      }else{
           redirect('auth/blocked');
      }
      
      redirect('profile/product');

      
    }
    
}