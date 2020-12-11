<?php 

function hashid($id)
{
    
    return urlencode(base64_encode((($id*123456789*5678)/95678)));
}

function dehashid($id)
{

   return round(((base64_decode(urldecode($id))*95678/5678)/123456789));

}



function periksa($id,$format)
{
	$ci = get_instance();
		$ci->db->like('format_file',$format);


	if (
		$ci->db->get_where('product',['id' => $id])->row_array()
	) {
		return 'checked';
	}

}




function delete_directory($dirname) {
  $dir_handle = null;
  if ($dirname != FCPATH) {
           if (is_dir($dirname))
             $dir_handle = opendir($dirname);
       if (!$dir_handle)
            return false;
       while($file = readdir($dir_handle)) {
             if ($file != "." && $file != "..") {
                  if (!is_dir($dirname."/".$file))
                       unlink($dirname."/".$file);
                  else
                       delete_directory($dirname.'/'.$file);
             }
       }
       closedir($dir_handle);
       rmdir($dirname);
       return true;
  }
 }

function aktif()
{
   $ci = get_instance();
   $email = $ci->session->userdata('email');
   if ($ci->db->get_where('user',['email' => $email])->row_array()) {
        if (!$ci->db->get_where('user',['email' => $email,'is_active' => 1])->row_array()) {
            redirect('auth/blocked');          
        }
   }else{
    redirect('auth/blocked'); 
   }
}

 function cek()
 {
   
   $ci = get_instance();
   $email = $ci->session->userdata('email');
   if ($ci->db->get_where('user',['email' => $email])->row_array()) {
        if ($ci->db->get_where('user',['email' => $email,'is_active' => 1])->row_array()) {
                $role_id = $ci->session->userdata('role_id');
                if ($role_id < 3 ) {
                    redirect('auth/blocked');
                }
        }else{
          $ci->session->set_flashdata('message','<div class="alert alert-danger" role="alert">This email has not been activated!</div>');
          redirect('auth');
        }
   }else{

      $menu = $ci->uri->segment(1).'/'.$ci->uri->segment(2);
      $ci->session->set_userdata('alamat',$menu);

      redirect('auth');

   }

 }
  function cekAffiliation()
 {
   
   $ci = get_instance();
   $email = $ci->session->userdata('email');
   if ($ci->db->get_where('user',['email' => $email])->row_array()) {
        if ($ci->db->get_where('user',['email' => $email,'is_active' => 1])->row_array()) {
                $role_id = $ci->session->userdata('role_id');
                if ($role_id == 2 || $role_id == 4 ) {
                }else{
                    redirect('auth/blocked?nama='.$role_id);

                }
        }else{
          $ci->session->set_flashdata('message','<div class="alert alert-danger" role="alert">This email has not been activated!</div>');
          redirect('auth');
        }
   }else{

      $menu = $ci->uri->segment(1).'/'.$ci->uri->segment(2);
      $ci->session->set_userdata('alamat',$menu);

      redirect('auth');

   }

 }


  function cekProductDetail($namaBarang,$email)
 {
   
   $ci = get_instance();
   
   if ($ci->db->get_where('user',['email' => $email])->row_array()) {
        if (!$ci->db->get_where('user',['email' => $email,'is_active' => 1])->row_array()) {
              // $ci->session->set_flashdata('message','<div class="alert alert-danger" role="alert">This email has not been activated!</div>');
              redirect('bloked');
        }
   }else{

      $menu = 'product'.'/'.'detail'.'/'.str_replace(' ', '_',$namaBarang);
      // $ci->session->set_userdata('alamat',$menu);

      redirect('bloked');

   }

 }


   function cekProfileDesainer($namaBarang,$email)
 {
   
   $ci = get_instance();
   
   if ($ci->db->get_where('user',['email' => $email])->row_array()) {
        if (!$ci->db->get_where('user',['email' => $email,'is_active' => 1])->row_array()) {
              $ci->session->set_flashdata('message','<div class="alert alert-danger" role="alert">This email has not been activated!</div>');
              redirect('auth');
        }
   }else{

      $menu = 'profile'.'/'.'designer'.'/'.str_replace(' ', '_',$namaBarang);
      $ci->session->set_userdata('alamat',$menu);

      redirect('auth');

   }

 }



   function cekSaldo()
 {
   
   $ci = get_instance();
   $email = $ci->session->userdata('email');
   if ($ci->db->get_where('user',['email' => $email])->row_array()) {
        if (!$ci->db->get_where('user',['email' => $email,'is_active' => 1])->row_array()) {

          $ci->session->set_flashdata('message','<div class="alert alert-danger" role="alert">This email has not been activated!</div>');
          // redirect('auth');
          redirect('auth/blocked');
        }
   }else{

      // $menu = $ci->uri->segment(1).'/'.$ci->uri->segment(2);
      // $ci->session->set_userdata('alamat',$menu);

      // redirect('auth');
      redirect('auth/blocked');
   }

 }



   function cekAdmin()
 {
   
   $ci = get_instance();
   $email = $ci->session->userdata('email');
   if ($ci->db->get_where('user',['email' => $email])->row_array()) {
        if ($ci->db->get_where('user',['email' => $email,'is_active' => 1])->row_array()) {
                $role_id = $ci->session->userdata('role_id');
                if ($role_id != 5 ) {
        
                    redirect('auth/blocked');

                }
        }else{
          $ci->session->set_flashdata('message','<div class="alert alert-danger" role="alert">This email has not been activated!</div>');
          redirect('auth');
        }
   }else{

      // $menu = $ci->uri->segment(1).'/'.$ci->uri->segment(2);
      // $ci->session->set_userdata('alamat',$menu);

      redirect('home');

   }

 }

   function cekdesainer()
 {
   
   $ci = get_instance();
   $email = $ci->session->userdata('email');
   if ($ci->db->get_where('user',['email' => $email])->row_array()) {
        if ($data = $ci->db->get_where('user',['email' => $email,'is_active' => 1])->row_array()) {
                $role_id = $data['role_id'];

                if ($role_id <= 2 ) {
                    redirect('pagenotfound');
                }
        }else{
          // $ci->session->set_flashdata('message','<div class="alert alert-danger" role="alert">This email has not been activated!</div>');
          redirect('pagenotfound');
        }
   }else{

      // $menu = $ci->uri->segment(1).'/'.$ci->uri->segment(2);
      // $ci->session->set_userdata('alamat',$menu);

      redirect('home');

   }

 }

// function rating($waktuset)
// {
//   $start_date = new DateTime(date('Y-m-d H:i:s',time()));
//   $since_start = $start_date->diff(new DateTime(date('Y-m-d H:i:s',$waktuset)));

//   if ($since_start->d) {
//     return $since_start->h * $since_start->i * ($since_start->d * 24) * 60;
//   }else{
//     if ($since_start->h) {
//      return $since_start->h * $since_start->i * 60;
//     }else{
//       if ($since_start->i) {
//       return   $since_start->i * 60;
//       }
//     }
//   }
  
// }


function ip() {
    $mainIp = '';
    if (getenv('HTTP_CLIENT_IP'))
      $mainIp = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
      $mainIp = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
      $mainIp = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
      $mainIp = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
      $mainIp = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
      $mainIp = getenv('REMOTE_ADDR');
    else
      $mainIp = 'UNKNOWN';
    return $mainIp;
  }


 ?>