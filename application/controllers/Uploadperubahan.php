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


      // if (!$this->session->userdata('email')) {
      //      redirect('auth/blocked');
      // }
      $data['judul'] = 'Halaman Upload';
      $data['user'] = $this->db->get_where('user',['email' => $this->session->userdata('email')])->row_array();

    


      $this->load->view('upload/upload_font',$data);
  
    }


    
    public function uploadFont()
    {

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
              $deskripsi = htmlspecialchars($this->db->escape_str($this->input->post('deskripsi')));
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
                    $data += ["errors"=>['File Free Not upload because your file no like a zip file'],'error'   => true,];
                    $this->output
                        ->set_content_type('application/json')
                        ->set_output(json_encode($data));
                        return false;
                  }       

                  if ($_FILES['file']['size'] >= 1024 * 2000) {
                      $data += ["errors"=>"max size uploade file FREE VERSION 2MB",'error'   => true,];
                      $this->output
                          ->set_content_type('application/json')
                          ->set_output(json_encode($data));
                          return false;
                  }
                  
       
               }else{
                    $data += ["errors" => "You must upload file FREE VERSION",'error'   => true,];
                    $this->output->set_content_type('application/json')->set_output(json_encode($data));
                    return false;	
               }

        if ($jenis == 'Font') {

              if (isset($_FILES['desktop']['name'])) {
                  $desktopekstensi = explode('.', $_FILES['desktop']['name']);
                  $desktopekstensi = strtolower(end($desktopekstensi));
                  if( $desktopekstensi != 'zip'){
                      $data += ["errors"=>"File Desktop Not upload because your file no like a zip file",'error'   => true,];
                    $this->output
                        ->set_content_type('application/json')
                        ->set_output(json_encode($data));
                        return false;
                  }

                  if ($_FILES['desktop']['size'] >= 1024 * 2000) {
                    $data += ["errors"=>"max size uploade file DESKTOP 2MB",'error'   => true,];
                    $this->output
                        ->set_content_type('application/json')
                        ->set_output(json_encode($data));
                        return false;
                  }
               }else{
                    $data += ["errors" => "You must upload file Desktop",'error'   => true,];
                    $this->output->set_content_type('application/json')->set_output(json_encode($data));
                    return false;	
               }

              if (isset($_FILES['web']['name'])) {
                  $webekstensi = explode('.', $_FILES['web']['name']);
                  $webekstensi = strtolower(end($webekstensi));
                  if( $webekstensi != 'zip'){
                      $data += ["errors"=>"File web Not upload because your file no like a zip file",'error'   => true,];
                    $this->output
                        ->set_content_type('application/json')
                        ->set_output(json_encode($data));
                        return false;
                  }		   
                  
                  if ($_FILES['web']['size'] >= 1024 * 2000) {
                    $data += ["errors"=>"max size uploade file WEB 2MB",'error'   => true,];
                    $this->output
                        ->set_content_type('application/json')
                        ->set_output(json_encode($data));
                        return false;
                  }
               }else{
                    $data += ["errors" => "You must upload file web",'error'   => true,];
                    $this->output->set_content_type('application/json')->set_output(json_encode($data));
                    return false;
               }

              if (isset($_FILES['app']['name'])) {
                  $appekstensi = explode('.', $_FILES['app']['name']);
                  $appekstensi = strtolower(end($appekstensi));
                  if( $appekstensi != 'zip'){
                      $data += ["errors"=>"File app Not upload because your file no like a zip file",'error'   => true,];
                    $this->output
                        ->set_content_type('application/json')
                        ->set_output(json_encode($data));
                        return false;
                  }	
                  if ($_FILES['app']['size'] >= 1024 * 2000) {
                    $data += ["errors"=>"max size uploade file APP 2MB",'error'   => true,];
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
            if ($_FILES['premium']['size'] >= 1024 * 2000) {
              $data += ["errors"=>"max size uploade file PREMIUM 2MB",'error'   => true,];
              $this->output
                  ->set_content_type('application/json')
                  ->set_output(json_encode($data));
                  return false;
            }       
         }else{
              $data += ["errors" => "You must upload file premium",'error'   => true,];
              $this->output->set_content_type('application/json')->set_output(json_encode($data));
              return false;
         }

        }

              //  Validation File Gambar

              if (isset($_FILES['gambar1']['name'])) {
                $gambar1ekstensi = explode('.', $_FILES['gambar1']['name']);
                $gambar1ekstensi = strtolower(end($gambar1ekstensi));
                if( $gambar1ekstensi != 'jpg'){
                    if( $gambar1ekstensi !=  'jpeg' ){
                      $data += ["errors"=>"File Image Not upload because your file no like a jpg or jpeg file",'error'   => true,];
                      $this->output->set_content_type('application/json')->set_output(json_encode($data));
                      return false;
                    }
                }	        
     
              }else{
                  $data += ["errors" => "You must file Image",'error'   => true,];
                  $this->output->set_content_type('application/json')->set_output(json_encode($data));
                  return false;	
              }  


              if (isset($_FILES['gambar2']['name'])) {
                $gambar2ekstensi = explode('.', $_FILES['gambar2']['name']);
                $gambar2ekstensi = strtolower(end($gambar2ekstensi));
                if( $gambar2ekstensi != 'jpg'){
                    if( $gambar2ekstensi !=  'jpeg' ){
                      $data += ["errors"=>"File Image Not upload because your file no like a jpg or jpeg file",'error'   => true,];
                      $this->output->set_content_type('application/json')->set_output(json_encode($data));
                      return false;
                    }
                }	        
     
              }else{
                  $data += ["errors" => "You must file Image",'error'   => true,];
                  $this->output->set_content_type('application/json')->set_output(json_encode($data));
                  return false;	
              }  

              if (isset($_FILES['gambar3']['name'])) {
                $gambar3ekstensi = explode('.', $_FILES['gambar3']['name']);
                $gambar3ekstensi = strtolower(end($gambar3ekstensi));
                if( $gambar3ekstensi != 'jpg'){
                    if( $gambar3ekstensi !=  'jpeg' ){
                      $data += ["errors"=>"File Image Not upload because your file no like a jpg or jpeg file"];
                      $this->output->set_content_type('application/json')->set_output(json_encode($data));
                      return false;
                    }
                }	        
     
              }else{
                  $data += ["errors" => "You must file Image"];
                  $this->output->set_content_type('application/json')->set_output(json_encode($data));
                  return false;	
              } 





              if (isset($_FILES['gambar4']['name'])) {
                $gambar4ekstensi = explode('.', $_FILES['gambar4']['name']);
                $gambar4ekstensi = strtolower(end($gambar4ekstensi));
                if( $gambar4ekstensi != 'jpg'){
                    if( $gambar4ekstensi !=  'jpeg' ){
                      $data += ["errors"=>"File Image Not upload because your file no like a jpg or jpeg file"];
                      $this->output->set_content_type('application/json')->set_output(json_encode($data));
                      return false;
                    }
                }	        
     
              }else{
                  $data += ["errors" => "You must file Image"];
                  $this->output->set_content_type('application/json')->set_output(json_encode($data));
                  return false;	
              }  

              if (isset($_FILES['gambar5']['name'])) {
                $gambar5ekstensi = explode('.', $_FILES['gambar5']['name']);
                $gambar5ekstensi = strtolower(end($gambar5ekstensi));
                if( $gambar5ekstensi != 'jpg'){
                    if( $gambar5ekstensi !=  'jpeg' ){
                      $data += ["errors"=>"File Image Not upload because your file no like a jpg or jpeg file"];
                      $this->output->set_content_type('application/json')->set_output(json_encode($data));
                      return false;
                    }
                }	        
     
              }else{
                  $data += ["errors" => "You must file Image"];
                  $this->output->set_content_type('application/json')->set_output(json_encode($data));
                  return false;	
              }  


              // Upload File Font

              $path = 'produk/'.$user['username'].'/'.$jenis.'/'.$namaproduk.'/'.$kategori.'/';


        //       // // file Free 
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
                      $data += ["errors" => 'file free not upload'];
                      $this->output->set_content_type('application/json')->set_output(json_encode($data));		
                    }
              }



        //       // Upload kalau jenis font 
        //  if ($jenis == 'Font') {
            



        //       // // File Desktop
        //       if ($_FILES['desktop']['name']) {
                    
        //                 //buat folder
        //                 $pathfolder = FCPATH.$path.'desktop/';
        //                 if (!file_exists($pathfolder)) {
        //                     mkdir($pathfolder,0755,true);
        //                 }
      
        //             if (move_uploaded_file($_FILES['desktop']['tmp_name'], $pathfolder.$_FILES['desktop']['name'])) {

                          
        //                   if ($zip->open($pathfolder.'/'.$_FILES['desktop']['name']) === TRUE) {
        //                     for ($i = 0; $i < $zip->numFiles; $i++) {
        //                             $appekstensi = explode('.',$zip->getNameIndex($i));
        //                           $appekstensi = strtolower(end($appekstensi));
        //                           $format_file  .= $appekstensi.'/';
        //                     }
        //                   }

                      
        //                     if($zip->open($pathfolder.'/'.$_FILES['desktop']['name'])){
        //                         $zip->extractTo($pathfolder);
        //                         $zip->close();
        //                     }
        //                   $zip_open = zip_open($pathfolder.'/'.$_FILES['desktop']['name']);
        //                   while ($zip_entry = zip_read($zip_open)) {
              
              
        //                         $nama =  zip_entry_name($zip_entry);
        //                         $ukuran =  zip_entry_filesize($zip_entry);
        //                         $ujung = explode('.', $nama);
        //                         $ujung = strtolower(end($ujung));
        //                         $ektensi = $nama;
        //                         $ektensi = explode('.', $ektensi);
        //                         $ektensi = strtoupper(end($ektensi));
        //                         $ektensi = $ektensi."/";
                        
        //                         $lok_dekstop = $path.'desktop/';
        //                         if ($ujung == 'otf') {
        //                               $isi = [
        //                               'id_barang' => $random,
        //                               'file' => $nama,
        //                               'tipe' => 'dekstop',
        //                               'ektensi' => $ektensi,
        //                               'lokasi' => $lok_dekstop,
        //                               'email' => $this->session->userdata('email')
              
        //                             ];
        //                           $this->db->insert('sub_product',$isi);
        //                         }else{
        //                           if ($ujung == 'ttf') {
        //                                 $isi = [
        //                                 'id_barang' => $random,
        //                                 'file' => $nama,
        //                                 'tipe' => 'dekstop',
        //                                 'ektensi' => $ektensi,
        //                                 'lokasi' => $lok_dekstop,
        //                                 'email' => $this->session->userdata('email')
        //                                 ];
        //                               $this->db->insert('sub_product',$isi);
        //                           }
        //                         }       
        //                   }  
                          
                          

        //             }else{
        //                   $data += ["errors" => 'file not upload'];
        //                   $this->output->set_content_type('application/json')->set_output(json_encode($data));			       
        //             }
        //       }

        //       // file Web 
        //       if ($_FILES['web']['name']) {
                    
        //                 //buat folder
        //                 $pathfolder = FCPATH.$path.'web/';
        //                 if (!file_exists($pathfolder)) {
        //                     mkdir($pathfolder,0755,true);
        //                 }
      

        //             if (move_uploaded_file($_FILES['web']['tmp_name'], $pathfolder.$_FILES['web']['name'])) {
           
        //               if ($zip->open($pathfolder.$_FILES['web']['name']) === TRUE) {
        //                 for ($i = 0; $i < $zip->numFiles; $i++) {
        //                         $appekstensi = explode('.',$zip->getNameIndex($i));
        //                       $appekstensi = strtolower(end($appekstensi));
        //                       $format_file  .= $appekstensi.'/';
        //                 }
        //               }                     
                      
        //             }else{
        //               $data += ["errors" => 'file web not upload'];
        //               $this->output->set_content_type('application/json')->set_output(json_encode($data));	
        //             }
        //       }

              // file App 
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
                      
                    }else{
                      $data += ["errors" => 'file app not upload'];
                      $this->output->set_content_type('application/json')->set_output(json_encode($data));
                    }
              }

        //  }else{
        //       // file App 
        //       if (isset($_FILES['premium']['name'])) {
                    
        //                 //buat folder
        //                 $pathfolder = FCPATH.$path.'premium/';
        //                 if (!file_exists($pathfolder)) {
        //                     mkdir($pathfolder,0755,true);
        //                 }

        //             if (move_uploaded_file($_FILES['premium']['tmp_name'], $pathfolder.$_FILES['premium']['name'])) {
             
        //               if ($zip->open($pathfolder.'/'.$_FILES['premium']['name']) === TRUE) {
        //                 for ($i = 0; $i < $zip->numFiles; $i++) {
        //                         $appekstensi = explode('.',$zip->getNameIndex($i));
        //                       $appekstensi = strtolower(end($appekstensi));
        //                       $format_file  .= $appekstensi.'/';
        //                 }
        //               }                      
                      
        //             }else{
        //               $data += ["errors" => 'file app not upload'];
        //               $this->output->set_content_type('application/json')->set_output(json_encode($data));
        //             }
        //       }
        //  }




        //       // Gambar produk

        //       $lokasi_gambar = 'gambar/'.$user['username'].'/'.$namaproduk.'/';

        //       $buat_dir = FCPATH.$lokasi_gambar;
        //       // buat folder
        //       if (!file_exists($buat_dir)){
        //         mkdir($buat_dir,0755,true);
        //         }

        //       if(!empty($_FILES['gambar1']['name'])){
        //           $config['upload_path'] = './'.$lokasi_gambar; //path folder
        //           $config['allowed_types'] = 'jpg|jpeg'; //type yang dapat diakses bisa anda sesuaikan
        //           $config['file_name'] = $namaproduk.'1'; //nama yang terupload nantinya
          
        //             $this->upload->initialize($config);
                  
        //             if ($this->upload->do_upload('gambar1')){
        //                 $gbr = $this->upload->data();

        //                 $image1 = $gbr['file_name'];

        //                 //Compress Image
        //                 $config['image_library']='gd2';
        //                 $config['source_image']= './'.$lokasi_gambar.$gbr['file_name'];
        //                 $config['create_thumb']= FALSE;
        //                 $config['maintain_ratio']= FALSE;
        //                 $config['quality']= '75%';
        //                 $config['width']= 675;
        //                 $config['height']= 449;
        //                 $config['new_image']=  './'.$lokasi_gambar.$gbr['file_name'];
        //                 $this->image_lib->initialize($config);
        //                 $this->image_lib->resize();
        //                 $this->image_lib->clear();
        //             }
          
        //                 $config['file_name'] = $namaproduk.'card1'; //nama yang terupload nantinya
        //                 $this->upload->initialize($config);
        //             if ($this->upload->do_upload('gambar1')){
        //                 $gbr = $this->upload->data();
        //                 $imagecard = $gbr['file_name'];
        //                 //Compress Image
        //                 $config['image_library']='gd2';
        //                 $config['source_image']= './'.$lokasi_gambar.$gbr['file_name'];
        //                 $config['create_thumb']= FALSE;
        //                 $config['maintain_ratio']= FALSE;
        //                 $config['quality']= '75%';
        //                 $config['width']= 342;
        //                 $config['height']= 228;
        //                 $config['new_image']=  './'.$lokasi_gambar.$gbr['file_name'];
        //                 $this->image_lib->initialize($config);
        //                 $this->image_lib->resize();
        //                 $this->image_lib->clear();
        //             }
                           
          
        //                $config['file_name'] = $namaproduk.'thumbnail1'; //nama yang terupload nantinya
        //                $this->upload->initialize($config);
        //             if ($this->upload->do_upload('gambar1')){
        //                 $gbr = $this->upload->data();
        //                 $image1thumbnail = $gbr['file_name'];
        //                 //Compress Image
        //                 $config['image_library']='gd2';
        //                 $config['source_image']= './'.$lokasi_gambar.$gbr['file_name'];
        //                 $config['create_thumb']= FALSE;
        //                 $config['maintain_ratio']= FALSE;
        //                 $config['quality']= '75%';
        //                 $config['width']= 128;
        //                 $config['height']= 85;
        //                 $config['new_image']=  './'.$lokasi_gambar.$gbr['file_name'];
        //                 $this->image_lib->initialize($config);
        //                 $this->image_lib->resize();
        //                 $this->image_lib->clear();
        //             }  
        //       }

        //       // gambar produk 2
        //       if(!empty($_FILES['gambar2']['name'])){
        //           $config['upload_path'] = './'.$lokasi_gambar; //path folder
        //           $config['allowed_types'] = 'jpg|jpeg'; //type yang dapat diakses bisa anda sesuaikan
        //           $config['file_name'] = $namaproduk.'2'; //nama yang terupload nantinya
          
        //             $this->upload->initialize($config);
                  
        //             if ($this->upload->do_upload('gambar2')){
        //                 $gbr = $this->upload->data();
        //                 $image2 = $gbr['file_name'];
        //                 //Compress Image
        //                 $config['image_library']='gd2';
        //                 $config['source_image']= './'.$lokasi_gambar.$gbr['file_name'];
        //                 $config['create_thumb']= FALSE;
        //                 $config['maintain_ratio']= FALSE;
        //                 $config['quality']= '75%';
        //                 $config['width']= 675;
        //                 $config['height']= 449;
        //                 $config['new_image']=  './'.$lokasi_gambar.$gbr['file_name'];
        //                 $this->image_lib->initialize($config);
        //                 $this->image_lib->resize();
        //                 $this->image_lib->clear();
        //             }
             
                    
        //             // thumbnail produk detail 
        //                $config['file_name'] = $namaproduk.'thumbnail2'; //nama yang terupload nantinya
        //                $this->upload->initialize($config);
        //             if ($this->upload->do_upload('gambar2')){
        //                 $gbr = $this->upload->data();
        //                 $image2thumbnail = $gbr['file_name'];
        //                 //Compress Image
        //                 $config['image_library']='gd2';
        //                 $config['source_image']= './'.$lokasi_gambar.$gbr['file_name'];
        //                 $config['create_thumb']= FALSE;
        //                 $config['maintain_ratio']= FALSE;
        //                 $config['quality']= '75%';
        //                 $config['width']= 128;
        //                 $config['height']= 85;
        //                 $config['new_image']=  './'.$lokasi_gambar.$gbr['file_name'];
        //                 $this->image_lib->initialize($config);
        //                 $this->image_lib->resize();
        //                 $this->image_lib->clear();
        //             }  
        //       }
          
        //       // gambar produk 3
        //       if(!empty($_FILES['gambar3']['name'])){
        //           $config['upload_path'] = './'.$lokasi_gambar; //path folder
        //           $config['allowed_types'] = 'jpg|jpeg'; //type yang dapat diakses bisa anda sesuaikan
        //           $config['file_name'] = $namaproduk.'3'; //nama yang terupload nantinya
          
        //             $this->upload->initialize($config);
                  
        //             if ($this->upload->do_upload('gambar3')){
        //                 $gbr = $this->upload->data();
        //                 $image3 = $gbr['file_name'];
        //                 //Compress Image
        //                 $config['image_library']='gd2';
        //                 $config['source_image']= './'.$lokasi_gambar.$gbr['file_name'];
        //                 $config['create_thumb']= FALSE;
        //                 $config['maintain_ratio']= FALSE;
        //                 $config['quality']= '75%';
        //                 $config['width']= 675;
        //                 $config['height']= 449;
        //                 $config['new_image']=  './'.$lokasi_gambar.$gbr['file_name'];
        //                 $this->image_lib->initialize($config);
        //                 $this->image_lib->resize();
        //                 $this->image_lib->clear();
        //             }
             
                    
        //             // thumbnail produk detail 
        //                $config['file_name'] = $namaproduk.'thumbnail3'; //nama yang terupload nantinya
        //                $this->upload->initialize($config);
        //             if ($this->upload->do_upload('gambar3')){
        //                 $gbr = $this->upload->data();
        //                 $image3thumbnail = $gbr['file_name'];
        //                 //Compress Image
        //                 $config['image_library']='gd2';
        //                 $config['source_image']= './'.$lokasi_gambar.$gbr['file_name'];
        //                 $config['create_thumb']= FALSE;
        //                 $config['maintain_ratio']= FALSE;
        //                 $config['quality']= '75%';
        //                 $config['width']= 128;
        //                 $config['height']= 85;
        //                 $config['new_image']=  './'.$lokasi_gambar.$gbr['file_name'];
        //                 $this->image_lib->initialize($config);
        //                 $this->image_lib->resize();
        //                 $this->image_lib->clear();
        //             }  
        //       }
        //       // gambar produk 4
        //       if(!empty($_FILES['gambar4']['name'])){
        //           $config['upload_path'] = './'.$lokasi_gambar; //path folder
        //           $config['allowed_types'] = 'jpg|jpeg'; //type yang dapat diakses bisa anda sesuaikan
        //           $config['file_name'] = $namaproduk.'4'; //nama yang terupload nantinya
          
        //             $this->upload->initialize($config);
                  
        //             if ($this->upload->do_upload('gambar4')){
        //                 $gbr = $this->upload->data();
        //                 $image4 = $gbr['file_name'];
        //                 //Compress Image
        //                 $config['image_library']='gd2';
        //                 $config['source_image']= './'.$lokasi_gambar.$gbr['file_name'];
        //                 $config['create_thumb']= FALSE;
        //                 $config['maintain_ratio']= FALSE;
        //                 $config['quality']= '75%';
        //                 $config['width']= 675;
        //                 $config['height']= 449;
        //                 $config['new_image']=  './'.$lokasi_gambar.$gbr['file_name'];
        //                 $this->image_lib->initialize($config);
        //                 $this->image_lib->resize();
        //                 $this->image_lib->clear();
        //             }
             
                    
        //             // thumbnail produk detail 
        //                $config['file_name'] = $namaproduk.'thumbnail4'; //nama yang terupload nantinya
        //                $this->upload->initialize($config);
        //             if ($this->upload->do_upload('gambar4')){
        //                 $gbr = $this->upload->data();
        //                 $image4thumbnail = $gbr['file_name'];
        //                 //Compress Image
        //                 $config['image_library']='gd2';
        //                 $config['source_image']= './'.$lokasi_gambar.$gbr['file_name'];
        //                 $config['create_thumb']= FALSE;
        //                 $config['maintain_ratio']= FALSE;
        //                 $config['quality']= '75%';
        //                 $config['width']= 128;
        //                 $config['height']= 85;
        //                 $config['new_image']=  './'.$lokasi_gambar.$gbr['file_name'];
        //                 $this->image_lib->initialize($config);
        //                 $this->image_lib->resize();
        //                 $this->image_lib->clear();
        //             }  
        //       }
          
        // //       // gambar produk 5
        //       if(!empty($_FILES['gambar5']['name'])){
        //           $config['upload_path'] = './'.$lokasi_gambar; //path folder
        //           $config['allowed_types'] = 'jpg|jpeg'; //type yang dapat diakses bisa anda sesuaikan
        //           $config['file_name'] = $namaproduk.'5'; //nama yang terupload nantinya
          
        //             $this->upload->initialize($config);
                  
        //             if ($this->upload->do_upload('gambar5')){
        //                 $gbr = $this->upload->data();
        //                 $image5 = $gbr['file_name'];
        //                 //Compress Image
        //                 $config['image_library']='gd2';
        //                 $config['source_image']= './'.$lokasi_gambar.$gbr['file_name'];
        //                 $config['create_thumb']= FALSE;
        //                 $config['maintain_ratio']= FALSE;
        //                 $config['quality']= '75%';
        //                 $config['width']= 675;
        //                 $config['height']= 449;
        //                 $config['new_image']=  './'.$lokasi_gambar.$gbr['file_name'];
        //                 $this->image_lib->initialize($config);
        //                 $this->image_lib->resize();
        //                 $this->image_lib->clear();
        //             }
             
                    
        //             // thumbnail produk detail 
        //                $config['file_name'] = $namaproduk.'thumbnail5'; //nama yang terupload nantinya
        //                $this->upload->initialize($config);
        //             if ($this->upload->do_upload('gambar5')){
        //                 $gbr = $this->upload->data();
        //                 $image5thumbnail = $gbr['file_name'];
        //                 //Compress Image
        //                 $config['image_library']='gd2';
        //                 $config['source_image']= './'.$lokasi_gambar.$gbr['file_name'];
        //                 $config['create_thumb']= FALSE;
        //                 $config['maintain_ratio']= FALSE;
        //                 $config['quality']= '75%';
        //                 $config['width']= 128;
        //                 $config['height']= 85;
        //                 $config['new_image']=  './'.$lokasi_gambar.$gbr['file_name'];
        //                 $this->image_lib->initialize($config);
        //                 $this->image_lib->resize();
        //                 $this->image_lib->clear();
        //             }  
        //       }
          
          
                        
       
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
                        // 'file_web' => $_FILES['web']['name'],
                        // 'file_dekstop' => $_FILES['desktop']['name'],
                        // 'file_app' => $_FILES['app']['name'],
                        'file_gratis' => $_FILES['file']['name'],
                        'lokasi_gratis' => $path.'free/',
                        // 'lokasi_web' => $path.'web/',
                        // 'lokasi_dekstop' => $path.'desktop/',
                        // 'lokasi_app' => $path.'app/',
                        // 'lokasi_gambar' => $lokasi_gambar,
                        // 'gambar1' => $image1,
                        // 'gambar2' => $image2,
                        // 'gambar3' => $image3,
                        // 'gambar4' => $image4,
                        // 'gambar5' => $image5,
                        // 'gambar5' => $image5,
                        // 'imagecard' => $imagecard,
                        // 'image1thumbnail' => $image1thumbnail,
                        // 'image2thumbnail' => $image2thumbnail,
                        // 'image3thumbnail' => $image3thumbnail,
                        // 'image4thumbnail' => $image4thumbnail,
                        // 'image5thumbnail' => $image5thumbnail,
                        'email' => $email,
                        'id_barang' => $random
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
                      'file_premium' => $_FILES['premium']['name'],
                      'file_gratis' => $_FILES['file']['name'],
                      'lokasi_gratis' => $path.'free/',
                      'lokasi_premium' => $path.'premium/',
                      'lokasi_gambar' => $lokasi_gambar,
                      'gambar1' => $image1,
                      'gambar2' => $image2,
                      'gambar3' => $image3,
                      'gambar4' => $image4,
                      'gambar5' => $image5,
                      'gambar5' => $image5,
                      'imagecard' => $imagecard,
                      'image1thumbnail' => $image1thumbnail,
                      'image2thumbnail' => $image2thumbnail,
                      'image3thumbnail' => $image3thumbnail,
                      'image4thumbnail' => $image4thumbnail,
                      'image5thumbnail' => $image5thumbnail,
                      'email' => $email,
                      'id_barang' => $random
                    ];
              }

                   
            

             if ($this->db->insert('product',$hasil)) {
                  $data += ["success"=>"uploaded successfully"];
                  $this->output
                      ->set_content_type('application/json')
                      ->set_output(json_encode($data));
             }

        }



 
    }








     public function file()
    {

      if (!$this->session->userdata('email')) {
           redirect('auth');
      }
      $data['judul'] = 'Halaman Upload';


      
      $this->form_validation->set_rules('nama_barang','Name Product','required|is_unique[product.nama_barang]');
      // $this->form_validation->set_rules('gambar1','First slide','required');
      $this->form_validation->set_rules('deskripsi','Deskripsi','required');
      $this->form_validation->set_rules('jenis','Jenis','required');
      $this->form_validation->set_rules('deskripsi','Description','required');

      // $this->form_validation->set_rules('kategori','Compitable','required');
            // var_dump($_FILES);


    if($this->form_validation->run() == FALSE) {
      $this->load->view('upload/upload_file',$data);
    }else{ 
      $email = $this->session->userdata('email');
      $user  = $this->db->get_where('user',['email' => $email])->row_array();
      $nama_desainer = $user['name'];
    $nama_barang = htmlspecialchars($this->input->post('nama_barang'));
    $jenis = htmlspecialchars($this->input->post('jenis'));
    $kategori = htmlspecialchars($this->input->post('kategori'));
    $harga_premium = htmlspecialchars($this->input->post('harga_premium'));

    $deskripsi = htmlspecialchars($this->input->post('deskripsi'));
    $tag = htmlspecialchars($this->input->post('tag'));
    $tag = htmlspecialchars($this->input->post('tag'));
      $random1 = strtoupper(base64_encode(random_bytes(6)));
      $random = preg_replace('/[^A-Za-z0-9\  ]/', '',$random1);

      $file_gratis = $_FILES['file_gratis']['name'];
      $file_premium = $_FILES['file_premium']['name'];

      if ($file_gratis) {
        $file_gratis1 = $_FILES['file_gratis']['name'];
        $file_gratis1 = explode('.', $file_gratis1);
        $file_gratis1 = strtolower(end($file_gratis1));
 
      }
      if ($file_premium) {
        $file_premium1 = $_FILES['file_premium']['name'];
        $file_premium1 = explode('.', $file_premium1);
        $file_premium1 = strtolower(end($file_premium1));
 
      }      


  if( $file_gratis1 == 'zip'){
 
  if($_FILES['file_gratis']['name'] != ''){
     $file_name = $_FILES['file_gratis']['name'];
     $array = explode(".", $file_name);
     $name = $array[0];
     // $ext = $array[1];
     $ext = explode('.', $file_name);
     $ext = strtolower(end($ext));
     if($ext == 'zip'){



        $path = FCPATH.'produk/'.$nama_desainer.'/'.$jenis.'/'.$nama_barang.'/'.$kategori.'/'.'gratis/'.$name;
        //buat folder
        if (!file_exists($path)) {
            mkdir($path,0755,true);
        } 

        // $path1 = $path.'/';
        $lok_gratis  = 'produk/'.$nama_desainer.'/'.$jenis.'/'.$nama_barang.'/'.$kategori.'/'.'gratis/'.$name.'/';

        
        $location = $path.'/'. $file_name;
      

      }
      move_uploaded_file($_FILES['file_gratis']['tmp_name'], $location);

     }
    }

  if( $file_premium1 == 'zip'){
 
  if($_FILES['file_premium']['name'] != ''){
     $file_name = $_FILES['file_premium']['name'];
     $array = explode(".", $file_name);
     $name = $array[0];
     // $ext = $array[1];
     $ext = explode('.', $file_name);
     $ext = strtolower(end($ext));
     if($ext == 'zip'){



        $path = FCPATH.'produk/'.$nama_desainer.'/'.$jenis.'/'.$nama_barang.'/'.$kategori.'/'.'premium/'.$name;
        //buat folder
        if (!file_exists($path)) {
            mkdir($path,0755,true);
        } 

        // $path1 = $path.'/';
        $lok_premium  = 'produk/'.$nama_desainer.'/'.$jenis.'/'.$nama_barang.'/'.$kategori.'/'.'premium/'.$name.'/';

        
        $location = $path.'/'. $file_name;
      

      }
      move_uploaded_file($_FILES['file_premium']['tmp_name'], $location);
 
     }
    }

  

      $format_file =rtrim($this->input->post('1').$this->input->post('2').$this->input->post('3').$this->input->post('4').$this->input->post('5').$this->input->post('6').$this->input->post('7').$this->input->post('8'),'/');

      // gambar slider
            $gambar1 = $_FILES['gambar1']['name'];
            $gambar2 = $_FILES['gambar2']['name'];
            $gambar3 = $_FILES['gambar3']['name'];
            $gambar4 = $_FILES['gambar4']['name'];
            $gambar5 = $_FILES['gambar5']['name'];
            $lokasi_gambar = './gambar/'.$nama_desainer.'/'.$nama_barang.'/';
            $lokasi_gambar1 = 'gambar/'.$nama_desainer.'/'.$nama_barang.'/';


            if ($gambar1) {
            $buat_dir1 = FCPATH.'gambar/'.$nama_desainer;
            $buat_dir2 = $buat_dir1.'/'.$nama_barang;
            
               if (!file_exists($buat_dir1)){
               mkdir($buat_dir1,0755,true);
               }
               if (!file_exists($buat_dir2)){
               mkdir($buat_dir2,0755,true);
               }                
               $config['allowed_types'] = 'gif|jpg|png|jpeg';
               $config['max_size'] = '100000';
               // $config['max_width']= 1024;
               // $config['max_height'] = 768;

               $config['upload_path'] = $lokasi_gambar;
               $this->load->library('upload',$config);

               if ($this->upload->do_upload('gambar1')) {
                  $image1 = $this->upload->data('file_name');
               }else{
                  echo $this->upload->display_errors();
               }

            }
            if ($gambar2) {
               $config['allowed_types'] = 'gif|jpg|png|jpeg';
               $config['max_size'] = '100000';
               // $config['max_width']  = 1024;
               // $config['max_height'] = 768;
               $config['upload_path'] = $lokasi_gambar;
               $this->load->library('upload',$config);

               if ($this->upload->do_upload('gambar2')) {

                  $image2 = $this->upload->data('file_name');
               }else{
                  echo $this->upload->display_errors();
               }

            }
            if ($gambar3) {
               $config['allowed_types'] = 'gif|jpg|png|jpeg';
               $config['max_size'] = '100000';
               // $config['max_width'] = 1024;
               // $config['max_height'] = 768;
               $config['upload_path'] = $lokasi_gambar;
               $this->load->library('upload',$config);

               if ($this->upload->do_upload('gambar3')) {
                  $image3 = $this->upload->data('file_name');
               }else{
                  echo $this->upload->display_errors();
               }

            }
            if ($gambar4) {
               $config['allowed_types'] = 'gif|jpg|png|jpeg';
               $config['max_size'] = '100000';
               // $config['max_width'] = 1024;
               // $config['max_height'] = 768;
               $config['upload_path'] = $lokasi_gambar;
               $this->load->library('upload',$config);

               if ($this->upload->do_upload('gambar4')) {
                  $image4 = $this->upload->data('file_name');
               }else{
                  echo $this->upload->display_errors();
               }

            }
            if ($gambar5) {
               $config['allowed_types'] = 'gif|jpg|png|jpeg';
               $config['max_size'] = '100000';
               // $config['max_width'] = 1024;
               // $config['max_height'] = 768;
               $config['upload_path'] = $lokasi_gambar;
               $this->load->library('upload',$config);

               if ($this->upload->do_upload('gambar5')) {

                  $image5 = $this->upload->data('file_name');
               }else{
                  echo $this->upload->display_errors();
               }

            }

            if ($gambar1) {
        if ($gambar2) {
            if ($gambar3) {
              if ($gambar4) {
                 if ($gambar5) {
                 $data = [
                      'nama_barang' => $nama_barang,
                      // 'ukuran' => $ukuran,
                      'harga_premium' => $harga_premium,
                      'deskripsi' => $deskripsi,
                      'tag' => $tag,
                      'jenis' => $jenis,
                      'kategori' => $kategori,
                      'format_file' => $format_file,
                      'tanggal' => time(), 
                            'file_premium' => $file_premium,
                            'file_gratis' => $file_gratis,
                            'lokasi_gratis' => $lok_gratis,
                            'lokasi_premium' => $lok_premium,
                            'lokasi_gambar' => $lokasi_gambar1,
                      'gambar1' => $image1,
                      'gambar2' => $image2,
                       'gambar3' => $image3,
                       'gambar4' => $image4,
                       'gambar5' => $image5,
                        'email' => $email,
                        'id_barang' => $random
                     ];
                 } else {
                $data = [
                      'nama_barang' => $nama_barang,
                      // 'ukuran' => $ukuran,
                      'harga_web' => $harga_premium,
                      'deskripsi' => $deskripsi,
                      'tag' => $tag,
                      'jenis' => $jenis,
                      'kategori' => $kategori,
                      'format_file' => $format_file,
                      'tanggal' => time(), 
                            'file_premium' => $file_premium,
                            'file_gratis' => $file_gratis,
                            'lokasi_gratis' => $lok_gratis,
                            'lokasi_premium' => $lok_premium,                           
                            'file5' => $fileNama5,
                            'lokasi_gambar' => $lokasi_gambar1,
                      'gambar1' => $image1,
                      'gambar2' => $image2,
                       'gambar3' => $image3,
                       'gambar4' => $image4,
                        'email' => $email,
                        'id_barang' => $random

                     ];   
                 }
                 

              } else {
                $data = [
                      'nama_barang' => $nama_barang,
                      // 'ukuran' => $ukuran,
                      'harga_premium' => $harga_premium,
                      'deskripsi' => $deskripsi,
                      'tag' => $tag,
                      'jenis' => $jenis,
                      'kategori' => $kategori,
                      'format_file' => $format_file,
                      'tanggal' => time(), 
                      'file_premium' => $file_premium,
                      'file_gratis' => $file_gratis,
                            'lokasi_gratis' => $lok_gratis,
                            'lokasi_premium' => $lok_premium,                     
                            'lokasi_gambar' => $lokasi_gambar1,
                      'gambar1' => $image1,
                      'gambar2' => $image2,
                       'gambar3' => $image3,
                        'email' => $email,
                        'id_barang' => $random

                   ];
              }
              
            } else {
              $data = [
                    'nama_barang' => $nama_barang,
                    // 'ukuran' => $ukuran,
                    'harga_premium' => $harga_premium,
                    'deskripsi' => $deskripsi,
                    'tag' => $tag,
                    'jenis' => $jenis,
                    'kategori' => $kategori,
                    'format_file' => $format_file,
                    'tanggal' => time(), 
                    'file_premium' => $file_premium,
                         'file_gratis' => $file_gratis,
                          'lokasi_gratis' => $lok_gratis,
                          'lokasi_premium' => $lok_premium,
                         'lokasi_gambar' => $lokasi_gambar1,
                     'gambar1' => $image1,
                     'gambar2' => $image2,
                        'email' => $email,
                        'id_barang' => $random

                ];
            }

        } else {
          $data = [
                  'nama_barang' => $nama_barang,
                  // 'ukuran' => $ukuran,
                  'harga_premium' => $harga_premium,
                  'deskripsi' => $deskripsi,
                  'tag' => $tag,
                  'jenis' => $jenis,
                  'kategori' => $kategori,
                  'format_file' => $format_file,
                  'tanggal' => time(), 
                  'file_premium' => $file_premium,
                    'file_gratis' => $file_gratis,
                    'lokasi_gratis' => $lok_gratis,
                    'lokasi_premium' => $lok_premium,
                    'lokasi_gambar' => $lokasi_gambar1,
                  'gambar1' => $image1,
                      'email' => $email,
                      'id_barang' => $random

                 ];
        }
        

      }
      



          
            
            $this->db->insert('product',$data);
            $this->session->set_flashdata('message','<div class="col-9">
             <div class="alert alert-success alert-dismissible">
                    <button class="close" type="button" data-dismiss="alert">
                        <span>&times;</span>
                    </button>
                    Your success Upload <strong>product</strong>
                  </div>
           </div> ');
            redirect('upload/file');



    }     
    }













      public function editfont($id)
    {
      if (!$this->session->userdata('email')) {
           redirect('auth');
      }
      $id = dehashid($id);
      if ($this->db->get_where('product',['id'=>$id,'email' => $this->session->userdata('email')])->row_array()) {
            $data['barang'] = $this->db->get_where('product',['id'=>$id])->row_array();
      }else{
             redirect('auth/blocked');
      }
      $data['judul'] = 'Halaman Update';
      // $id = dehashid($id);
      // $id = 65;
      



      
      $this->form_validation->set_rules('nama_barang','Name Product','required');
      // $this->form_validation->set_rules('gambar1','First slide','required');
      // $this->form_validation->set_rules('deskripsi','Deskripsi','required');
      $this->form_validation->set_rules('jenis','Jenis','required');


    if($this->form_validation->run() == FALSE) {
       $this->load->view('upload/update_font',$data);
    }else{ 

      $email = $this->session->userdata('email');
      $user  = $this->db->get_where('user',['email' => $email])->row_array();
      $barang  = $this->db->get_where('product',['id' => $id])->row_array();
      $id_barang = $barang['id_barang'];
      $barang_gratis  = $barang['lokasi_gratis'];
      $barang_web  = $barang['lokasi_web'];
      $barang_app  = $barang['lokasi_app'];
      $barang_dekstop  = $barang['lokasi_dekstop'];
      $nama_desainer = $user['name'];

      $random1 = strtoupper(base64_encode(random_bytes(6)));
      $random = preg_replace('/[^A-Za-z0-9\  ]/', '',$random1);

      if ($nama_barang = htmlspecialchars($this->input->post('nama_barang',TRUE))) {
          $this->db->set('nama_barang',$nama_barang);
      }
      if ($jenis = htmlspecialchars($this->input->post('jenis',TRUE))) {
          $this->db->set('jenis',$jenis);
      }
      if ($kategori = htmlspecialchars($this->input->post('kategori',TRUE))) {
          $this->db->set('kategori',$kategori);
          if ($kategori != $barang['kategori']) {
            $lama = FCPATH.'/produk/'.$user['name'].'/'.$barang['jenis'].'/'.$nama_barang.'/'.$barang['kategori'];
            $baru = FCPATH.'/produk/'.$user['name'].'/'.$barang['jenis'].'/'.$nama_barang.'/'.$kategori;
            rename($lama, $baru);
          }
      }
      if ($harga_web = htmlspecialchars($this->input->post('harga_web',TRUE))) {
          $this->db->set('harga_web',$harga_web);
      }
      if ($harga_dekstop = htmlspecialchars($this->input->post('harga_dekstop',TRUE))) {
          $this->db->set('harga_dekstop',$harga_dekstop);
      }
      if ($harga_app = htmlspecialchars($this->input->post('harga_app',TRUE))){
          $this->db->set('harga_app',$harga_app);
      }
      if ($deskripsi = htmlspecialchars($this->input->post('deskripsi',TRUE))) {
          $this->db->set('deskripsi',$deskripsi);
      }
      $format_file = rtrim($this->input->post('1').$this->input->post('2').$this->input->post('3').$this->input->post('4').$this->input->post('5').$this->input->post('6').$this->input->post('7').$this->input->post('8'),'/');
      $this->db->set('format_file',$format_file);

      //lokasi
      if ($barang['lokasi_gratis']) {
          $lok_gratis  = 'produk/'.$nama_desainer.'/'.$jenis.'/'.$nama_barang.'/'.$kategori.'/'.'gratis/'.str_replace('.zip','', $barang['file_gratis']).'/';
          $this->db->set('lokasi_gratis',$lok_gratis);
      }
      if ($barang['lokasi_dekstop']) {
          $lok_dekstop  = 'produk/'.$nama_desainer.'/'.$jenis.'/'.$nama_barang.'/'.$kategori.'/'.'dekstop/'.str_replace('.zip','', $barang['file_dekstop']).'/';
          $this->db->set('lokasi_dekstop',$lok_dekstop);

          $this->db->query("UPDATE sub_product SET lokasi = '{$lok_dekstop}' WHERE id_barang = '{$id_barang}'");


      }
      if ($barang['lokasi_web']) {
          $lok_web  = 'produk/'.$nama_desainer.'/'.$jenis.'/'.$nama_barang.'/'.$kategori.'/'.'web/'.str_replace('.zip','', $barang['file_web']).'/';
          $this->db->set('lokasi_web',$lok_web);
      }
      if ($barang['lokasi_app']) {
          $lok_app  = 'produk/'.$nama_desainer.'/'.$jenis.'/'.$nama_barang.'/'.$kategori.'/'.'app/'.str_replace('.zip','', $barang['file_app']).'/';
          $this->db->set('lokasi_app',$lok_app);

      }



      
      $file_gratis1   = ' ';
      $file_dekstop1 = ' ';
      $file_app1 = ' ';
      $file_web1 = ' ';

      $file_gratis = $_FILES['file_gratis']['name'];
      // var_dump($file_gratis);die;
      $file_web = $_FILES['file_web']['name'];
      $file_dekstop = $_FILES['file_dekstop']['name'];
      $file_app = $_FILES['file_app']['name'];
      if ($file_gratis) {
        $file_gratis1 = $_FILES['file_gratis']['name'];
        $file_gratis1 = explode('.', $file_gratis1);
        $file_gratis1 = strtolower(end($file_gratis1));
 
      }
      if ($file_web) {
        $file_web1 = $_FILES['file_web']['name'];
        $file_web1 = explode('.', $file_web1);
        $file_web1 = strtolower(end($file_web1));
 
      }      
      if ($file_dekstop) {
        $file_dekstop1 = $_FILES['file_dekstop']['name'];
        $file_dekstop1 = explode('.', $file_dekstop1);
        $file_dekstop1 = strtolower(end($file_dekstop1));
 
      }
      if ($file_app) {
        $file_app1 = $_FILES['file_app']['name'];
        $file_app1 = explode('.', $file_app1);
        $file_app1 = strtolower(end($file_app1));
 
      }

  if( $file_gratis1 == 'zip'){
 
  if($_FILES['file_gratis']['name'] != ''){
     $file_name = $_FILES['file_gratis']['name'];
     $array = explode(".", $file_name);
     $name = $array[0];


        $path = FCPATH.'produk/'.$nama_desainer.'/'.$jenis.'/'.$nama_barang.'/'.$kategori.'/'.'gratis/'.$name;
        //buat folder
        if (!file_exists($path)) {
            mkdir($path,0755,true);
        } 

        // $path1 = $path.'/';
        $lok_gratis  = 'produk/'.$nama_desainer.'/'.$jenis.'/'.$nama_barang.'/'.$kategori.'/'.'gratis/'.$name.'/';
        $location = $path.'/'. $file_name;
        $brg_gratis =  FCPATH.'/'.$barang_gratis;
        $pindah = FCPATH.'/backup/update/'.str_replace('produk/', '', $barang_gratis);
        $pindahbaru = FCPATH.'/backup/update/'.str_replace('produk/', '', $barang_gratis).$barang['file_gratis'];
        $pindahlama = FCPATH.$barang_gratis.$barang['file_gratis'];


        //backup data
          if (!file_exists($pindah)) {
              mkdir($pindah,0755,true);
          }

        rename($pindahlama,$pindahbaru);

        // cara hapus folder dan file yang bagus
        delete_directory($brg_gratis);

       


      $this->db->set('lokasi_gratis',$lok_gratis);
      $this->db->set('file_gratis',$file_gratis);
      move_uploaded_file($_FILES['file_gratis']['tmp_name'], $location);

     }
    }





  if( $file_dekstop1 == 'zip'){
 
  // if($_FILES['file_dekstop']['name'] != ''){
     $file_name = $_FILES['file_dekstop']['name'];
     $array = explode(".", $file_name);
     $name = $array[0];
     // $ext = $array[1];
     $ext = explode('.', $file_name);
     $ext = strtolower(end($ext));
     if($ext == 'zip'){



        $path = FCPATH.'produk/'.$nama_desainer.'/'.$jenis.'/'.$nama_barang.'/'.$kategori.'/'.'dekstop/'.$name;
        $location = $path.'/'. $file_name;
        //buat folder
        if (!file_exists($path)) {
            mkdir($path,0755,true);
        } 

        // $path1 = $path.'/';
        $lok_dekstop  = 'produk/'.$nama_desainer.'/'.$jenis.'/'.$nama_barang.'/'.$kategori.'/'.'dekstop/'.$name.'/';
        $brg_dekstop =  FCPATH.'/'.$barang_dekstop;
        $pindah = FCPATH.'/backup/update/'.str_replace('produk/', '', $barang_dekstop);
        $pindahbaru = FCPATH.'/backup/update/'.str_replace('produk/', '', $barang_dekstop).$barang['file_dekstop'];
        $pindahlama = FCPATH.$barang_dekstop.$barang['file_dekstop'];

        //backup data
          if (!file_exists($pindah)) {
              mkdir($pindah,0755,true);
          }

        //pindah file
        rename($pindahlama,$pindahbaru);

        // cara hapus folder dan file yang bagus
        delete_directory($brg_dekstop); 

      }
        if(move_uploaded_file($_FILES['file_dekstop']['tmp_name'], $location)){

           $zip = new ZipArchive;
           if($zip->open($location)){
              $zip->extractTo($path);
              $zip->close();
           }
             $zip = zip_open($location);
        $this->db->delete('sub_product',['id_barang' => $id_barang]);
        while ($zip_entry = zip_read($zip)) {

       $nama =  zip_entry_name($zip_entry);
       $ukuran =  zip_entry_filesize($zip_entry);
       $ujung = explode('.', $nama);
       $ujung = strtolower(end($ujung));
       $ektensi = $nama;
       $ektensi = explode('.', $ektensi);
       $ektensi = strtoupper(end($ektensi));
       $ektensi = $ektensi."/";
       
      


       if ($ujung == 'otf') {
            $isi = [
            'id_barang' => $id_barang,
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
              'id_barang' => $id_barang,
              'file' => $nama,
              'tipe' => 'dekstop',
              'ektensi' => $ektensi,
              'lokasi' => $lok_dekstop,
              'email' => $this->session->userdata('email')
            ];
           $this->db->insert('sub_product',$isi);
         }        
       }       



          

           // echo "<script>alert('Data berhasil diupload'); location='index.php';</script>";
        }
         // unlink($location);

       } else {
          // echo "<script>alert('Hanya .zip yang diperbolehkan'); location='index.php';</script>";
       }
     // }
    }
      if ($file_dekstop1 == 'zip') {
    $this->db->set('file_dekstop',$file_dekstop);
    $this->db->set('lokasi_dekstop',$lok_dekstop); 
  }


    // Upload type ci untuk web
        if ($file_app1 == 'zip') {
        $array = explode(".", $file_app);
        $name = $array[0];
        $file_name = $_FILES['file_app']['name'];


        $path = FCPATH.'produk/'.$nama_desainer.'/'.$jenis.'/'.$nama_barang.'/'.$kategori.'/'.'app/'.$name;
        //buat folder
        if (!file_exists($path)) {
            mkdir($path,0755,true);
        } 

        // $path1 = $path.'/';
        $lok_app  = 'produk/'.$nama_desainer.'/'.$jenis.'/'.$nama_barang.'/'.$kategori.'/'.'app/'.$name.'/';
        $location_app = $path.'/'. $file_name;
        $brg_app =  FCPATH.'/'.$barang_app;
        $pindah = FCPATH.'/backup/update/'.str_replace('produk/', '', $barang_app);
        $pindahbaru = FCPATH.'/backup/update/'.str_replace('produk/', '', $barang_app).$barang['file_app'];
        $pindahlama = FCPATH.$barang_app.$barang['file_app'];

        //backup data
          if (!file_exists($pindah)) {
              mkdir($pindah,0755,true);
          }

        //pindah file
          rename($pindahlama,$pindahbaru);

        // cara hapus folder dan file yang bagus
            delete_directory($brg_app);

            // buat folder
            if (!file_exists($path2)){
            mkdir($path2,0755,true);
            }
             if (!file_exists($path)){
            mkdir($path,0755,true);
            }
             if (!file_exists($path3)){
            mkdir($path3,0755,true);
            }
             if (!file_exists($path4)){
            mkdir($path4,0755,true);
            } 
             if (!file_exists($path5)){
            mkdir($path5,0755,true);
            }        


                $this->db->set('file_app',$file_app);
                $this->db->set('lokasi_app',$lok_app);
                move_uploaded_file($_FILES['file_app']['tmp_name'], $location_app);


 

      }   
     // $upload_web = $_FILES['file_web']['name'];
     if ($file_web1 == 'zip') {
        $array = explode(".", $file_web);
        $name = $array[0];
        $file_name = $_FILES['file_web']['name'];
        // $path2 = FCPATH.'produk/'.$nama_desainer;
        // $path = $path2.'/'.$jenis;
        // // $path1 = $path.'/'.$nama_barang;
        // $path3 = $path.'/'.$kategori;
        // $path4 = $path3.'/'.'web';
        // $path5 = $path4.'/'.$name;

        $path = FCPATH.'produk/'.$nama_desainer.'/'.$jenis.'/'.$nama_barang.'/'.$kategori.'/'.'web/'.$name;
        //buat folder
        if (!file_exists($path)) {
            mkdir($path,0755,true);
        }

        // $path1 = $path.'/';
        $lok_web  = 'produk/'.$nama_desainer.'/'.$jenis.'/'.$nama_barang.'/'.$kategori.'/'.'web/'.$name.'/';
        $location_web = $path.'/'. $file_name;
        $brg_web =  FCPATH.'/'.$barang_web;
        $pindah = FCPATH.'/backup/update/'.str_replace('produk/', '', $barang_web);
        $pindahbaru = FCPATH.'/backup/update/'.str_replace('produk/', '', $barang_web).$barang['file_web'];
        $pindahlama = FCPATH.$barang_web.$barang['file_web'];

        //backup data
          if (!file_exists($pindah)) {
              mkdir($pindah,0755,true);
          }

        //pindah file
        rename($pindahlama,$pindahbaru);

        // cara hapus folder dan file yang bagus
        delete_directory($brg_web);




                $this->db->set('file_web',$file_web);
                $this->db->set('lokasi_web',$lok_web);
                move_uploaded_file($_FILES['file_web']['tmp_name'], $location_web);

      }

    //tutup
  


            $gambar1 = $_FILES['gambar1']['name'];
            $gambar2 = $_FILES['gambar2']['name'];
            $gambar3 = $_FILES['gambar3']['name'];
            $gambar4 = $_FILES['gambar4']['name'];
            $gambar5 = $_FILES['gambar5']['name'];
            $lokasi_gambar = './gambar/'.$nama_desainer.'/'.$nama_barang.'/';
            $lokasi_gambar1 = 'gambar/'.$nama_desainer.'/'.$nama_barang.'/';
            $buat_dir1 = FCPATH.'/gambar/'.$nama_desainer.'/'.$nama_barang;
            $lama = FCPATH.'/'.$barang['lokasi_gambar'];


            $this->db->set('lokasi_gambar',$lokasi_gambar1);
            if ($nama_barang != $barang['nama_barang'] ) {
                rename($lama, $buat_dir1);
              $path = $buat_dir1;

            }else{
              $path = FCPATH.'/'.$barang['lokasi_gambar'];
            }

            if ($gambar1) {
              if (!file_exists($buat_dir1)) {
                  mkdir($buat_dir1,0755,true);
              }            
            
                  
               $config['allowed_types'] = 'gif|jpg|png|jpeg';
               $config['max_size'] = '100000';
               // $config['max_width']= 1024;
               // $config['max_height'] = 768;

               $config['upload_path'] = $lokasi_gambar;
               $this->load->library('upload',$config);

               if ($this->upload->do_upload('gambar1')) {
                  $old_image1 =  $barang['gambar1'];
                  if ($old_image1 != 'default.jpg') {
                    unlink($path . $old_image1);
                  }                
                  $image1 = $this->upload->data('file_name');
                  $this->db->set('gambar1',$image1);
               }else{
                  echo $this->upload->display_errors();
               }

            }
            if ($gambar2) {
              if (!file_exists($buat_dir1)) {
                  mkdir($buat_dir1,0755,true);
              }
               $config['allowed_types'] = 'gif|jpg|png|jpeg';
               $config['max_size'] = '100000';
               // $config['max_width']  = 1024;
               // $config['max_height'] = 768;
               $config['upload_path'] = $lokasi_gambar;
               $this->load->library('upload',$config);

               if ($this->upload->do_upload('gambar2')) {
                  $old_image2 = $barang['gambar2'];
                  if ($old_image2 != 'default.jpg') {
                    unlink($path . $old_image2);
                  }
                  $image2 = $this->upload->data('file_name');
                  $this->db->set('gambar2',$image2);
               }else{
                  echo $this->upload->display_errors();
               }

            }
            if ($gambar3) {
              if (!file_exists($buat_dir1)) {
                  mkdir($buat_dir1,0755,true);
              }
               $config['allowed_types'] = 'gif|jpg|png|jpeg';
               $config['max_size'] = '100000';
               // $config['max_width'] = 1024;
               // $config['max_height'] = 768;
               $config['upload_path'] = $lokasi_gambar;
               $this->load->library('upload',$config);

               if ($this->upload->do_upload('gambar3')) {
                  $old_image3 = $barang['gambar3'];
                  if ($old_image3 != 'default.jpg') {
                    unlink($path . $old_image3);
                  }
                  $image3 = $this->upload->data('file_name');
                  $this->db->set('gambar3',$image3);
               }else{
                  echo $this->upload->display_errors();
               }

            }
            if ($gambar4) {
              if (!file_exists($buat_dir1)) {
                  mkdir($buat_dir1,0755,true);
              }
               $config['allowed_types'] = 'gif|jpg|png|jpeg';
               $config['max_size'] = '100000';
               // $config['max_width'] = 1024;
               // $config['max_height'] = 768;
               $config['upload_path'] = $lokasi_gambar;
               $this->load->library('upload',$config);

               if ($this->upload->do_upload('gambar4')) {
                  $old_image4 = $barang['gambar4'];
                  if ($old_image4 != 'default.jpg') {
                    unlink($path . $old_image4);
                  }
                  $image4 = $this->upload->data('file_name');
                  $this->db->set('gambar4',$image4);
               }else{
                  echo $this->upload->display_errors();
               }

            }
            if ($gambar5) {
              if (!file_exists($buat_dir1)) {
                  mkdir($buat_dir1,0755,true);
              }
               $config['allowed_types'] = 'gif|jpg|png|jpeg';
               $config['max_size'] = '100000';
               // $config['max_width'] = 1024;
               // $config['max_height'] = 768;
               $config['upload_path'] = $lokasi_gambar;
               $this->load->library('upload',$config);

               if ($this->upload->do_upload('gambar5')) {
                  $old_image5 = $barang['gambar5'];
                  if ($old_image5 != 'default.jpg') {
                    unlink($path . $old_image5);
                  }
                  $image5 = $this->upload->data('file_name');
                  $this->db->set('gambar5',$image5);
               }else{
                  echo $this->upload->display_errors();
               }

            }



          
            $this->db->where('id',$id);
            $this->db->update('product');
            $this->session->set_flashdata('message','     <div class="col-9">
       <div class="alert alert-success alert-dismissible">
              <button class="close" type="button" data-dismiss="alert">
                  <span>&times;</span>
              </button>
              Your Successly Updated <strong>product</strong>
            </div>
     </div> ');
            redirect('upload/editfont/'.hashid($id));
            // redirect('upload/editfont');



    }     
    }




     public function updatefile($id)
    {
      $id = dehashid($id);

      if (!$this->session->userdata('email')) {                                                                                                                              
           redirect('auth');
      }
      if ($this->db->get_where('product',['id'=>$id,'email' => $this->session->userdata('email')])->row_array()) {
            $data['barang'] = $this->db->get_where('product',['id'=>$id])->row_array();
      }else{
             redirect('auth/blocked');
      }
      $data['judul'] = 'Halaman Upload';

      // $id = dehashid($id);
      // $data['barang'] = $this->db->get_where('product',['id'=>$id])->row_array();
      
      $this->form_validation->set_rules('nama_barang','Name Product','required');
      // $this->form_validation->set_rules('gambar1','First slide','required');
      $this->form_validation->set_rules('deskripsi','Deskripsi','required');
      $this->form_validation->set_rules('jenis','Jenis','required');
      $this->form_validation->set_rules('deskripsi','Description','required');

      // $this->form_validation->set_rules('kategori','Compitable','required');
            // var_dump($_FILES);


    if($this->form_validation->run() == FALSE) {
      $this->load->view('upload/update_file',$data);
    }else{ 
      $email = $this->session->userdata('email');
      $user  = $this->db->get_where('user',['email' => $email])->row_array();
      $barang  = $this->db->get_where('product',['id' => $id])->row_array();
      $nama_desainer = $user['name'];
      $id_barang = $barang['id_barang'];
      $barang_premium  = $barang['lokasi_premium'];
      $barang_gratis  = $barang['lokasi_gratis'];
      $nama_desainer = $user['name'];



      if ($nama_barang = htmlspecialchars($this->input->post('nama_barang',TRUE))) {
          $this->db->set('nama_barang',$nama_barang);
  
      }
      if ($jenis = htmlspecialchars($this->input->post('jenis',TRUE))) {
          $this->db->set('jenis',$jenis);

      }
      if ($kategori = htmlspecialchars($this->input->post('kategori',TRUE))) {
          $this->db->set('kategori',$kategori);
      }
      if ($harga_premium = htmlspecialchars($this->input->post('harga_premium',TRUE))) {
          $this->db->set('harga_premium',$harga_premium);
      }
 
      if ($deskripsi = htmlspecialchars($this->input->post('deskripsi',TRUE))) {
          $this->db->set('deskripsi',$deskripsi);
      }
      if ($tag = htmlspecialchars($this->input->post('tag'))) {
          $this->db->set('tag',$tag);
      }

      if ($jenis != $barang['jenis'] && $kategori != $barang['kategori']) {
          // $lama = FCPATH.'/produk/'.$user['name'].'/'.$barang['jenis'].'/'.$nama_barang.'/'.$barang['kategori'];
          // $baru = FCPATH.'/produk/'.$user['name'].'/'.$jenis.'/'.$nama_barang.'/'.$kategori;
          // rename($lama, $baru);

            $lamajenis = FCPATH.'/produk/'.$user['name'].'/'.$barang['jenis'];
            $barujenis = FCPATH.'/produk/'.$user['name'].'/'.$jenis;
            rename($lamajenis, $barujenis);
            $lama = FCPATH.'/produk/'.$user['name'].'/'.$jenis.'/'.$nama_barang.'/'.$barang['kategori'];
            $baru = FCPATH.'/produk/'.$user['name'].'/'.$jenis.'/'.$nama_barang.'/'.$kategori;
            rename($lama, $baru);

      }else{
          if ($jenis != $barang['jenis']){
            $lama = FCPATH.'/produk/'.$user['name'].'/'.$barang['jenis'];
            $baru = FCPATH.'/produk/'.$user['name'].'/'.$jenis;
            rename($lama, $baru);
          }elseif ($kategori != $barang['kategori']) {
            $lama = FCPATH.'/produk/'.$user['name'].'/'.$barang['jenis'].'/'.$nama_barang.'/'.$barang['kategori'];
            $baru = FCPATH.'/produk/'.$user['name'].'/'.$barang['jenis'].'/'.$nama_barang.'/'.$kategori;
            rename($lama, $baru);
          }
      }

      $format_file = rtrim($this->input->post('1').$this->input->post('2').$this->input->post('3').$this->input->post('4').$this->input->post('5').$this->input->post('6').$this->input->post('7').$this->input->post('8'),'/');
      $this->db->set('format_file',$format_file);

      //Lokasi
      if ($barang['lokasi_gratis']) {
          $lok_gratis  = 'produk/'.$nama_desainer.'/'.$jenis.'/'.$nama_barang.'/'.$kategori.'/'.'gratis/'.str_replace('.zip','', $barang['file_gratis']).'/';
          $this->db->set('lokasi_gratis',$lok_gratis);
      }
      if ($barang['lokasi_premium']) {
          $lok_premium  = 'produk/'.$nama_desainer.'/'.$jenis.'/'.$nama_barang.'/'.$kategori.'/'.'premium/'.str_replace('.zip','', $barang['file_premium']).'/';
          $this->db->set('lokasi_premium',$lok_premium);
      }



      $file_gratis1   = ' ';
      $file_premium1 = ' ';

      $file_gratis = $_FILES['file_gratis']['name'];
      $file_premium = $_FILES['file_premium']['name'];

      if ($file_gratis) {
        $file_gratis1 = $_FILES['file_gratis']['name'];
        $file_gratis1 = explode('.', $file_gratis1);
        $file_gratis1 = strtolower(end($file_gratis1));
 
      }
      if ($file_premium) {
        $file_premium1 = $_FILES['file_premium']['name'];
        $file_premium1 = explode('.', $file_premium1);
        $file_premium1 = strtolower(end($file_premium1));
 
      }      


      if( $file_gratis1 == 'zip'){
     
      // if($_FILES['file_gratis']['name'] != ''){
         $file_name = $_FILES['file_gratis']['name'];
         $array = explode(".", $file_name);
         $name = $array[0];



            // $path1 = $path.'/';
            $path = FCPATH.'produk/'.$nama_desainer.'/'.$jenis.'/'.$nama_barang.'/'.$kategori.'/'.'gratis'.'/'.$name;
            $lok_gratis  = 'produk/'.$nama_desainer.'/'.$jenis.'/'.$nama_barang.'/'.$kategori.'/'.'gratis/'.$name.'/';
            $location = $path.'/'. $file_name;
            $brg_gratis =  FCPATH.'/'.$barang_gratis;
            $pindah = FCPATH.'/backup/update/'.str_replace('produk/', '', $barang_gratis);
            $pindahbaru = FCPATH.'/backup/update/'.str_replace('produk/', '', $barang_gratis).$barang['file_gratis'];
            $pindahlama = FCPATH.$barang_gratis.$barang['file_gratis'];


            //backup data
              if (!file_exists($pindah)) {
                  mkdir($pindah,0755,true);
              }

            rename($pindahlama,$pindahbaru);

            // cara hapus folder dan file yang bagus
            delete_directory($brg_gratis);

           

             if (!file_exists($path2)){
            mkdir($path2,0755,true);
            }
             if (!file_exists($path)){
            mkdir($path,0755,true);
            }
             if (!file_exists($path3)){
            mkdir($path3,0755,true);
            }
             if (!file_exists($path4)){
            mkdir($path4,0755,true);
            } 
             if (!file_exists($path5)){
            mkdir($path5,0755,true);
            }        
          //   if (!file_exists($path))
          //     mkdir($path);
            
          

          // }
          $this->db->set('lokasi_gratis',$lok_gratis);
          $this->db->set('file_gratis',$file_gratis);
          move_uploaded_file($_FILES['file_gratis']['tmp_name'], $location);

         // }
        }

         if ($file_premium1 == 'zip') {
            $array = explode(".", $file_premium);
            $name = $array[0];
            $file_name = $_FILES['file_premium']['name'];
            $path = FCPATH.'produk/'.$nama_desainer.'/'.$jenis.'/'.$nama_barang.'/'.$kategori.'/'.'premium'.'/'.$name;

            $lok_premium  = 'produk/'.$nama_desainer.'/'.$jenis.'/'.$nama_barang.'/'.$kategori.'/'.'premium/'.$name.'/';
            $location_premium = $path.'/'. $file_name;
            $brg_premium =  FCPATH.'/'.$barang_premium;
            $pindah = FCPATH.'/backup/update/'.str_replace('produk/', '', $barang_premium);
            $pindahbaru = FCPATH.'/backup/update/'.str_replace('produk/', '', $barang_premium).$barang['file_premium'];
            $pindahlama = FCPATH.$barang_premium.$barang['file_premium'];

            //backup data
              if (!file_exists($pindah)) {
                  mkdir($pindah,0755,true);
              }

            //pindah file
              rename($pindahlama,$pindahbaru);

            // cara hapus folder dan file yang bagus
                delete_directory($brg_premium);

              if (!file_exists($path)) {
                  mkdir($path,0755,true);
              }


                    $this->db->set('file_premium',$file_premium);
                    $this->db->set('lokasi_premium',$lok_premium);
                    move_uploaded_file($_FILES['file_premium']['tmp_name'], $location_premium);

          }

  
     


      $format_file =rtrim($this->input->post('1').$this->input->post('2').$this->input->post('3').$this->input->post('4').$this->input->post('5').$this->input->post('6').$this->input->post('7').$this->input->post('8'),'/');

 //     // gambar slider
            $gambar1 = $_FILES['gambar1']['name'];
            $gambar2 = $_FILES['gambar2']['name'];
            $gambar3 = $_FILES['gambar3']['name'];
            $gambar4 = $_FILES['gambar4']['name'];
            $gambar5 = $_FILES['gambar5']['name'];
            $lokasi_gambar = './gambar/'.$nama_desainer.'/'.$nama_barang.'/';
            $lokasi_gambar1 = 'gambar/'.$nama_desainer.'/'.$nama_barang.'/';
            $buat_dir1 = FCPATH.'/gambar/'.$nama_desainer.'/'.$nama_barang;
            $lama = FCPATH.'/'.$barang['lokasi_gambar'];


            $this->db->set('lokasi_gambar',$lokasi_gambar1);
            if ($nama_barang != $barang['nama_barang'] ) {
                rename($lama, $buat_dir1);
                $path = $buat_dir1;

                

            }else{
              $path = FCPATH.'/'.$barang['lokasi_gambar'];
            }

            if ($gambar1) {
              if (!file_exists($buat_dir1)) {
                  mkdir($buat_dir1,0755,true);
              }            
            
                  
               $config['allowed_types'] = 'gif|jpg|png|jpeg';
               $config['max_size'] = '100000';
               // $config['max_width']= 1024;
               // $config['max_height'] = 768;

               $config['upload_path'] = $lokasi_gambar;
               $this->load->library('upload',$config);

               if ($this->upload->do_upload('gambar1')) {
                  $old_image1 =  $barang['gambar1'];
                  if ($old_image1 != 'default.jpg') {
                    unlink($path . $old_image1);
                  }                
                  $image1 = $this->upload->data('file_name');
                  $this->db->set('gambar1',$image1);
               }else{
                  echo $this->upload->display_errors();
               }

            }
            if ($gambar2) {
              if (!file_exists($buat_dir1)) {
                  mkdir($buat_dir1,0755,true);
              }
               $config['allowed_types'] = 'gif|jpg|png|jpeg';
               $config['max_size'] = '100000';
               // $config['max_width']  = 1024;
               // $config['max_height'] = 768;
               $config['upload_path'] = $lokasi_gambar;
               $this->load->library('upload',$config);

               if ($this->upload->do_upload('gambar2')) {
                  $old_image2 = $barang['gambar2'];
                  if ($old_image2 != 'default.jpg') {
                    unlink($path . $old_image2);
                  }
                  $image2 = $this->upload->data('file_name');
                  $this->db->set('gambar2',$image2);
               }else{
                  echo $this->upload->display_errors();
               }

            }
            if ($gambar3) {
              if (!file_exists($buat_dir1)) {
                  mkdir($buat_dir1,0755,true);
              }
               $config['allowed_types'] = 'gif|jpg|png|jpeg';
               $config['max_size'] = '100000';
               // $config['max_width'] = 1024;
               // $config['max_height'] = 768;
               $config['upload_path'] = $lokasi_gambar;
               $this->load->library('upload',$config);

               if ($this->upload->do_upload('gambar3')) {
                  $old_image3 = $barang['gambar3'];
                  if ($old_image3 != 'default.jpg') {
                    unlink($path . $old_image3);
                  }
                  $image3 = $this->upload->data('file_name');
                  $this->db->set('gambar3',$image3);
               }else{
                  echo $this->upload->display_errors();
               }

            }
            if ($gambar4) {
              if (!file_exists($buat_dir1)) {
                  mkdir($buat_dir1,0755,true);
              }
               $config['allowed_types'] = 'gif|jpg|png|jpeg';
               $config['max_size'] = '100000';
               // $config['max_width'] = 1024;
               // $config['max_height'] = 768;
               $config['upload_path'] = $lokasi_gambar;
               $this->load->library('upload',$config);

               if ($this->upload->do_upload('gambar4')) {
                  $old_image4 = $barang['gambar4'];
                  if ($old_image4 != 'default.jpg') {
                    unlink($path . $old_image4);
                  }
                  $image4 = $this->upload->data('file_name');
                  $this->db->set('gambar4',$image4);
               }else{
                  echo $this->upload->display_errors();
               }

            }
            if ($gambar5) {
              if (!file_exists($buat_dir1)) {
                  mkdir($buat_dir1,0755,true);
              }
               $config['allowed_types'] = 'gif|jpg|png|jpeg';
               $config['max_size'] = '100000';
               // $config['max_width'] = 1024;
               // $config['max_height'] = 768;
               $config['upload_path'] = $lokasi_gambar;
               $this->load->library('upload',$config);

               if ($this->upload->do_upload('gambar5')) {
                  $old_image5 = $barang['gambar5'];
                  if ($old_image5 != 'default.jpg') {
                    unlink($path . $old_image5);
                  }
                  $image5 = $this->upload->data('file_name');
                  $this->db->set('gambar5',$image5);
               }else{
                  echo $this->upload->display_errors();
               }

            }



          
            $this->db->where('id',$id);
            $this->db->update('product');
            $this->session->set_flashdata('message','<div class="col-9">
       <div class="alert alert-success alert-dismissible">
              <button class="close" type="button" data-dismiss="alert">
                  <span>&times;</span>
              </button>
              Your Successly Updated <strong>product</strong>
            </div>
     </div>');
            redirect('upload/updatefile/'.hashid($id));
            


    }
    }



    public function deletefont($id)
    {
        $id = dehashid($id);
        if (!$this->session->userdata('email')) {
           redirect('auth');
        }
        if ($this->db->get_where('product',['id'=>$id,'email' => $this->session->userdata('email')])->row_array()) {
            $barang = $this->db->get_where('product',['id'=>$id,'email' => $this->session->userdata('email')])->row_array();
        }else{
             redirect('auth/blocked');
        }
        $id_barang = $barang['id_barang'];
        // $hapusGambar = FCPATH.$barang['lokasi_gambar'];
        $profile = $this->db->get_where('user',['email' => $this->session->userdata('email')])->row_array();


        // backup gratis
        if ($barang['lokasi_gratis']) {
        $barang_gratis  = $barang['lokasi_gratis'];
        $pindah = FCPATH.'/backup/hapus/'.str_replace('produk/', '', $barang_gratis);
        $pindahbaru = FCPATH.'/backup/hapus/'.str_replace('produk/', '', $barang_gratis).$barang['file_gratis'];
        $pindahlama = FCPATH.$barang_gratis.$barang['file_gratis'];
        // $hapus = FCPATH.$barang_gratis;

        //backup data
          if (!file_exists($pindah)) {
              mkdir($pindah,0755,true);
          }

        rename($pindahlama,$pindahbaru);  
        // hapus folder
        // delete_directory($hapus);  
        }
      

        // backup dekstop
        if ($barang['lokasi_dekstop']) {
        $barang_dekstop  = $barang['lokasi_dekstop'];
        $pindah = FCPATH.'/backup/hapus/'.str_replace('produk/', '', $barang_dekstop);
        $pindahbaru = FCPATH.'/backup/hapus/'.str_replace('produk/', '', $barang_dekstop).$barang['file_dekstop'];
        $pindahlama = FCPATH.$barang_dekstop.$barang['file_dekstop'];
        // $hapus = FCPATH.$barang_dekstop;


        //backup data
          if (!file_exists($pindah)) {
              mkdir($pindah,0755,true);
          }

        rename($pindahlama,$pindahbaru); 
        // hapus folder
        // delete_directory($hapus);  
        }
     
        
        // backup web
        if ($barang['lokasi_web']) {
        $barang_web  = $barang['lokasi_web'];
        $pindah = FCPATH.'/backup/hapus/'.str_replace('produk/', '', $barang_web);
        $pindahbaru = FCPATH.'/backup/hapus/'.str_replace('produk/', '', $barang_web).$barang['file_web'];
        $pindahlama = FCPATH.$barang_web.$barang['file_web'];
        // $hapus = FCPATH.$barang_web;

        //backup data
          if (!file_exists($pindah)) {
              mkdir($pindah,0755,true);
          }

        rename($pindahlama,$pindahbaru);  
        // hapus folder
        // delete_directory(FCPATH.$barang_web);
        }

        // backup app
        if ($barang['lokasi_app']) {
        $barang_app = $barang['lokasi_app'];
        $pindah = FCPATH.'/backup/hapus/'.str_replace('produk/', '', $barang_app);
        $pindahbaru = FCPATH.'/backup/hapus/'.str_replace('produk/', '', $barang_app).$barang['file_app'];
        $pindahlama = FCPATH.$barang_app.$barang['file_app'];
        

        //backup data
          if (!file_exists($pindah)) {
              mkdir($pindah,0755,true);
          }

        rename($pindahlama,$pindahbaru);  

        // hapus folder
        }

        if ($barang['lokasi_dekstop'] || $barang['lokasi_gratis'] || $barang['lokasi_web'] || $barang['lokasi_app'] ) {
            $hapusGambar = FCPATH.$barang['lokasi_gambar'];
            $hapus = FCPATH.'produk/'.$profile['name'].'/'.$barang['jenis'].'/'.$barang['nama_barang'];
            delete_directory($hapus);
            delete_directory($hapusGambar);
        }


 



        $this->db->delete('product',['id'=>$id,'email' => $this->session->userdata('email')]);
        $this->db->delete('sub_product',['id_barang'=>$id_barang,'email' => $this->session->userdata('email')]);

            $this->session->set_flashdata('message','<div class="col-9">
       <div class="alert alert-success alert-dismissible">
              <button class="close" type="button" data-dismiss="alert">
                  <span>&times;</span>
              </button>
              Your Successly Updated <strong>product</strong>
            </div>
     </div>');
            redirect('profile/edit');


    }

      public function deletefile($id)
    {
        $id = dehashid($id);

        if (!$this->session->userdata('email')) {
           redirect('auth');
        }
        if ($this->db->get_where('product',['id'=>$id,'email' => $this->session->userdata('email')])->row_array()) {
            $barang = $this->db->get_where('product',['id'=>$id,'email' => $this->session->userdata('email')])->row_array();
        }else{
             redirect('auth/blocked');
        }
        $id_barang = $barang['id_barang'];
        
        $profile = $this->db->get_where('user',['email' => $this->session->userdata('email')])->row_array();


        // backup gratis
        if ($barang['lokasi_gratis']) {
        $barang_gratis  = $barang['lokasi_gratis'];
        $pindah = FCPATH.'/backup/hapus/'.str_replace('produk/', '', $barang_gratis);
        $pindahbaru = FCPATH.'/backup/hapus/'.str_replace('produk/', '', $barang_gratis).$barang['file_gratis'];
        $pindahlama = FCPATH.$barang_gratis.$barang['file_gratis'];
        // $hapus = FCPATH.$barang_gratis;

        //backup data
          if (!file_exists($pindah)) {
              mkdir($pindah,0755,true);
          }

        rename($pindahlama,$pindahbaru);  
        // hapus folder
        // delete_directory($hapus);  
        }
      

        // backup dekstop
        if ($barang['lokasi_premium']) {
        $barang_premium  = $barang['lokasi_premium'];
        $pindah = FCPATH.'/backup/hapus/'.str_replace('produk/', '', $barang_premium);
        $pindahbaru = FCPATH.'/backup/hapus/'.str_replace('produk/', '', $barang_premium).$barang['file_premium'];
        $pindahlama = FCPATH.$barang_premium.$barang['file_premium'];
        // $hapus = FCPATH.$barang_dekstop;


        //backup data
          if (!file_exists($pindah)) {
              mkdir($pindah,0755,true);
          }

        rename($pindahlama,$pindahbaru); 
        // hapus folder
        // delete_directory($hapus);  
        }
      
        if ($barang['lokasi_premium'] || $barang['lokasi_gratis']) {
            $hapusGambar = FCPATH.$barang['lokasi_gambar'];
            $hapus = FCPATH.'produk/'.$profile['name'].'/'.$barang['jenis'].'/'.$barang['nama_barang'];
            delete_directory($hapus);
            delete_directory($hapusGambar);
        }



 



        $this->db->delete('product',['id'=>$id,'email' => $this->session->userdata('email')]);
        // $this->db->delete('sub_product',['id_barang'=>$id_barang,'email' => $this->session->userdata('email')]);

            $this->session->set_flashdata('message','<div class="col-9">
       <div class="alert alert-success alert-dismissible">
              <button class="close" type="button" data-dismiss="alert">
                  <span>&times;</span>
              </button>
              Your Successly Updated <strong>product</strong>
            </div>
     </div>');
            redirect('profile/edit');

    }


}