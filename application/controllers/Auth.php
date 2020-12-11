<?php 
        require APPPATH.'libraries/phpmailer/src/Exception.php';
        require APPPATH.'libraries/phpmailer/src/PHPMailer.php';
        require APPPATH.'libraries/phpmailer/src/SMTP.php';
        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\Exception;

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');


    }

    public function designer()
    {


        $data['title'] = 'Designer Registration';
        $this->form_validation->set_rules('shopname','Shop Name','trim|required',true);
        $this->form_validation->set_rules('url','Portfilio Website','trim|required|valid_url',true);
        $this->form_validation->set_rules('reason','Reason','trim|required|max_length[500]',true);
        if ($this->form_validation->run() == false) { 
            $this->load->view('auth/header',$data);
            $this->load->view('designer/registration');
            $this->load->view('auth/footer');
        }else{

            if (!$this->db->get_where('pengajuan',['email' => $this->session->userdata('email')])->row_array()) {
                $user = $this->db->get_where('user',['email' => $this->session->userdata('email')])->row_array();
				$username = $user['name'];
                $data = [
                    'namatoko' => htmlspecialchars($this->input->post('shopname')),
                    'website' => htmlspecialchars($this->input->post('url')),
                    'alasan' => htmlspecialchars($this->input->post('reason')),
                    'username' => $username,
                    'email' => $this->session->userdata('email'),
                    'status' => 'designer',
                    'role_id' => 3,
                    'tanggal' => time()
                ];

                $this->db->insert('pengajuan',$data);
                $random1 = strtoupper(base64_encode(random_bytes(16)));
                $random = preg_replace('/[^A-Za-z0-9\  ]/', '',$random1);
                $this->db->set('id_designer',$random);
                $this->db->set('role_id',3);
                $this->db->where('email',$this->session->userdata('email'));
                $this->db->update('user');

                $this->session->set_flashdata('message','<div class="text-success text-center" role="alert">Your Request Has Been Received.</div>');

             }
             redirect('auth/designer');
        }
        
    }
    public function affiliation()
    {
        if (!$this->session->userdata('email')) {
            redirect('notfound');
        }

       $data['title'] = 'Affiliation Registration';
       $this->form_validation->set_rules('url','Portfilio Website','trim|required|valid_url|prep_url',true);
       $this->form_validation->set_rules('reason','Reason','trim|required|max_length[500]',true);
       if ($this->form_validation->run() == false) { 
            $this->load->view('auth/header',$data);
            $this->load->view('afiliasi/registration');
            $this->load->view('auth/footer');
       }else{

           if (!$this->db->get_where('pengajuan',['email' => $this->session->userdata('email')])->row_array()) {
               $user = $this->db->get_where('user',['email' => $this->session->userdata('email')])->row_array();
               $username = $user['name'];
               $data = [
                   'website' => htmlspecialchars($this->input->post('url')),
                   'alasan' => htmlspecialchars($this->input->post('reason')),
                   'username' => $username,
                   'email' => $this->session->userdata('email'),
                   'status' => 'affiliasi',
                   'role_id' => 2,
                   'tanggal' => time()
               ];


               $this->db->insert('pengajuan',$data);


               $random1 = strtoupper(base64_encode(random_bytes(6)));
               $random = preg_replace('/[^A-Za-z0-9\  ]/', '',$random1);
               $this->db->set('referal',$random);
               $this->db->set('role_id',2);
               $this->db->where('email',$this->session->userdata('email'));
               $this->db->update('user');

               $this->session->set_flashdata('message','<div class="text-success text-center" role="alert">Your Request Has Been Approved.</div>');

            }
            redirect('auth/affiliation');
       }
    }
    

    public function reset()
    {
        // if (!$this->session->userdata('email')) {
        //     redirect('notfound');
        // }

        $this->form_validation->set_rules('email','Email','trim|required|valid_email',true);
        
       if ($this->form_validation->run() == false) {
            $data['title'] = 'Reset Password';
            $this->load->view('auth/header',$data);
            $this->load->view('auth/reset');
            $this->load->view('auth/footer');
 
       }else{

           $email = htmlspecialchars($this->input->post('email'));
           $user = $this->db->get_where('user',['email' => $email,'is_active' => 1])->row_array();
           
           if ($user) {
                $token = base64_encode(random_bytes(32));
                $user_token = [
                     'email' => $email,
                     'token' => $token,
                     'date_created' => time()
                 ];
                 $this->db->insert('user_token',$user_token);
                 $this->_sendEmail($token,'forgot');

                 $this->session->set_flashdata('message','<div class="text-success" role="alert">The email has been sent</div>');
                 redirect('auth/reset');

           }else{
               $this->session->set_flashdata('message','<div class="text-success" role="alert">Email is not registered!</div>');
              redirect('auth/reset');
           }
       }
 
    }

    private function _login()
    {
       
      $username = htmlspecialchars($this->db->escape_str($this->input->post('username')));
      $password = htmlspecialchars($this->db->escape_str($this->input->post('password')));

        $user = $this->db->get_where('user',['username' => $username])->row_array();
        //jika usernya ada
        if ($user) {
         //jika user aktif
            if ($user['is_active'] == 1) {
                //cek password
                if (password_verify($password, $user['password'])) {
                     $data = [
                        'email' => $user['email'],
                        'role_id' => $user['role_id']
                     ];
                     $this->session->set_userdata($data);

                     if ($alamat = $this->session->userdata('alamat')) {
                          $this->session->unset_userdata('alamat');
                          redirect($alamat);
                     }

                     if ($user['role_id'] == 1) {
                         redirect('admin');
                     }else{

                         redirect('home');

                     }

                }else{
                       $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Wrong password</div>');
                       redirect('auth');
                }
                
            }else{
                $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">This Account has not been activated!</div>');
                redirect('auth');
            }

        }else{
              $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Account is not registered!</div>');
              redirect('auth');
        }
    }

    public function login()
    {


        if ($this->input->is_ajax_request()) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST')
            {
                $csrf_token =  $this->security->get_csrf_hash();
    
      
                $this->form_validation->set_rules('username','Username','trim|required');
                $this->form_validation->set_rules('password','Password','trim|required');
        
                if ($this->form_validation->run() == false) {
        
                   $data = [
                            'error'   => true,
                            'username_error' => form_error('username'),
                            'csrf_token' => $csrf_token,
                            'password' => form_error('password')
                           ];
                  echo json_encode($data);
                  
                }else{
                      $username = htmlspecialchars($this->db->escape_str($this->input->post('username')));
                      $password = htmlspecialchars($this->db->escape_str($this->input->post('password')));
        
                      $user = $this->db->get_where('user',['username' => $username])->row_array();
                        //jika usernya ada
                        if ($user) {
                         //jika user aktif
                            if ($user['is_active'] == 1) {
                                //cek password
                                if (password_verify($password, $user['password'])) {
                                     $data = [
                                        'email' => $user['email'],
                                        'role_id' => $user['role_id']
                                     ];
                                     $this->session->set_userdata($data);
        
                                    $data = [
                                      'success'   => 'success',
                                     ];
                                     echo json_encode($data);
        
             
        
                                }else{
                                     $data = [
                                              'error'   => true,
                                              'csrf_token' => $csrf_token,
                                              'password' => 'Wrong Password'
                                             ];
                                    echo json_encode($data);
                                }
                                
                            }else{
                                
        
                                 $data = [
                                  'error'   => true,
                                  'csrf_token' => $csrf_token,
                                   'not_active' => 'This Account has not been activated!'
                                  ];
                                echo json_encode($data);
                            }
        
                        }else{
                             
        
                                 $data = [
                                  'error'   => true,
                                  'csrf_token' => $csrf_token,
                                   'not_registered' => 'This Account is not registered!'
                                  ];
                                echo json_encode($data);                      
                        }
        
        
                }
    
            }else{
                
                redirect('Notfound');
    
            }
        }else{
        
            redirect('Notfound');
        }



  



 
    }



    public function registration()
    {


        if ($this->input->is_ajax_request()) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST')
            {

                $csrf_token =  $this->security->get_csrf_hash();

                $this->form_validation->set_rules('name','Name','required|trim');
                $this->form_validation->set_rules('email','Email','required|trim|valid_email|is_unique[user.email]',[
                'is_unique' => 'This email has already registered!'

                ]);  
                $this->form_validation->set_rules('username','Username','required|trim|is_unique[user.username]|min_length[7]',[
                'is_unique' => 'This Username has already registered!'

                ]);
                $this->form_validation->set_rules('password','Password','required|trim|min_length[3]',[
                
                'min_length' => 'Password too short'

                ]);
                
                        

                if ($this->form_validation->run() == false) {
                    // $data['title'] = 'User registration';
            
                    // $this->load->view('auth/registration',$data);     

                            $data = [
                            'error'   => true,
                            'email_error' => form_error('email'),
                            'name_error' => form_error('name'),
                            'username_error' => form_error('username'),
                            'password_error' => form_error('password'),
                            'csrf_token' => $csrf_token
                            
                            ];

                            echo json_encode($data);
                    
                }else{
                    $email = $this->db->escape_str($this->input->post('email',true));
                    $username = $this->db->escape_str($this->input->post('username',true));
                    $data = [
                        'name' => htmlspecialchars($this->input->post('name',true)),
                        'email' => htmlspecialchars($email),
                        'username' => htmlspecialchars($username),
                        'image' => 'default.png',
                        'background' => 'background.png',
                        'lokasi' => 'gambar profile/kosong/',
                        'password' => password_hash($this->input->post('password'),PASSWORD_DEFAULT),
                        'role_id' => 1,
                        'is_active' => 0,
                        'date_created' => time()


                    ];
                    //siapakan Token
                    $token = base64_encode(random_bytes(32));
                    $user_token = [
                        'email' => $email,
                        'token' => $token,
                        'date_created' => time()

                    ];

                    $this->db->insert('user',$data);
                    $this->db->insert('user_token',$user_token);

                    

                    $this->_sendEmail($token,'verify');


                    $data = [
                    'success'   => 'Success,Please check your Email for activation Account!',
                    'csrf_token' => $csrf_token
                    
                    ];
                    echo json_encode($data);              
                    
                }

            }else{
                redirect('Notfound');
            }

        }else{
            redirect('Notfound');
        }   
    }

        private function _sendEmail($token,$type)
        {


            
                    $hasil = $this->db->get_where('user',['email'=> $this->input->post('email')])->row_array();
                    $name = $hasil['name'];
                    // PHPMailer object
                    //  $response = false;
                     $mail = new PHPMailer();
                   
            
                    // SMTP configuration
                    $mail->isSMTP();
                    $mail->Host     = 'muhammadriduwan.com'; //sesuaikan sesuai nama domain hosting/server yang digunakan
                    $mail->SMTPAuth = true;
                    $mail->Username = 'noreply@muhammadriduwan.com'; // user email
                    $mail->Password = 'muhammadriduwan'; // password email
                    $mail->SMTPSecure = 'ssl';
                    $mail->Port     = 465;

                    $mail->setFrom('noreply@muhammadriduwan.com', ''); // user email
                    $mail->addReplyTo('noreply@muhammadriduwan.com', ''); //user email
                   
                    // Add a recipient
                    $mail->addAddress($this->input->post('email')); //email tujuan pengiriman email 
                    // Set email format to HTML
                    $mail->isHTML(true);

            if ($type == 'verify') {

                    // Email subject
                    $mail->Subject = 'Account Verification'; //subject email
                    // Email body content
                    // $mailContent = 'Click this link to verify you account : <a href="'.base_url() . 'auth/verify?email=' . $this->input->post('email') . '&token='. urlencode($token) . '">Activate</a>'; // isi email
                    $mailContent = '
                    
                    <div align="center">  
                        <div style="font-family: Tahoma;width: 503.89px;position: relative;" >
                            <img src="'.base_url('assets2/img/logo/improve/emaillogo.jpg') . '" >
                            <div style="border-top: 1px solid #FF3C3C;width: 100%;border-bottom: 1px solid #FF3C3C;width: 100%;text-align: center;" >
                                <div style="text-align: left;margin-left: 20%;">
                                <br>
                                <br>
                                <p style="font-size: 15px;">HI '.$name.',</p>
                                <p style="font-size: 15px;">Please <a href="'.base_url() . 'auth/verify?email=' . $this->input->post('email') . '&token='. urlencode($token) . '" style="text-decoration: none;color: #FF0000;">CLICK HERE</a> to activate your account.</p>
                                <p>If you didn\'t sign up for an account on our site,
                                <br>please ignore this email.</p>
                                <br>
                                <br>
                                </div>
                            </div>
                        </div>
                    </div>
                    '; // isi email
                    $mail->Body = $mailContent;

            }elseif ($type == 'forgot') {

                    // Email subject
                    $mail->Subject = 'Reset Password'; //subject email
                    // Email body content
                    // $mailContent = 'Click this link to reset your password : <a href="'.base_url() . 'auth/resetpassword?email=' . $this->input->post('email') . '&token='. urlencode($token) . '">Reset Password</a>'; // isi email


                    $mailContent = '
                    <div align="center">  
                        <div style="font-family: Tahoma;width: 503.89px;position: relative;" >
                            <img src="'.base_url('assets2/img/logo/improve/emaillogo.jpg') . '" >
                            <div style="border-top: 1px solid #FF3C3C;width: 100%;border-bottom: 1px solid #FF3C3C;width: 100%;text-align: center;" >
                                <div style="text-align: left;margin-left: 20%;">
                                <br>
                                <br>
                                <p style="font-size: 15px;">HI '.$name.',</p>
                                <p style="font-size: 15px;">Please <a href="'.base_url() . 'auth/resetpassword?email=' . $this->input->post('email') . '&token='. urlencode($token) . '" style="text-decoration: none;color: #FF0000;">CLICK HERE</a> to reset your password.</p>
                                <p>If you don\'t request to reset your password,
                                <br>please ignore this email.</p>
                                <br>
                                <br>
                                </div>
                            </div>
                        </div>
                    </div>
                    '; // isi email
                    $mail->Body = $mailContent;
            }
                    

            $mail->send();

                    // Send email
                    // if(!$mail->send()){
                    //     echo 'Message could not be sent.';
                    //     echo 'Mailer Error: ' . $mail->ErrorInfo;
                    // }else{
                    //     echo 'Message has been sent';
                    // }            
        
        }

    public function verify()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('user',['email' => $email])->row_array();

        if ($user) {
              $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

              if ($user_token) {
                   if (time() - $user_token['date_created'] < (60 * 60 * 24)) {
                        $this->db->set('is_active',1);
                        $this->db->where('email',$email);
                        $this->db->update('user');

                        $this->db->delete('user_token', ['email'=> $email] ); 
                         
                        $data = [
                            'email' => $user['email'],
                            'role_id' => $user['role_id']
                         ];
                         $this->session->set_userdata($data);
                        
                        // $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">'. $email .' has been activated! Please login.</div>');
                        redirect('profile');
                   }else{

                      $this->db->delete('user',['email'=> $email] );   
                      $this->db->delete('user_token',['email'=> $email] );                    
                      $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Account activation failed!  token expired.</div>');
                      redirect('home');
                   }
              }else{
                   $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Account activation failed! Wrong token.</div>');
                   redirect('home');
              }
        }else{
              $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Account activation failed! Wrong email.</div>');
              redirect('home');
        }
    }



    public function logout()
    {
        if ($this->input->is_ajax_request()) {
            if ($_SERVER['REQUEST_METHOD'] == 'GET')
            {
                $this->session->unset_userdata('email');
                $this->session->unset_userdata('role_id');
                $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">You have been logged out</div>');
                $data = [
                'success'   => 'success',
                ];
                echo json_encode($data);
            }else{
                redirect('Notfound');
            }
        }else{
            redirect('Notfound');
        } 

    }
 
   public function blocked()
   {
      $this->load->view('auth/blocked');
   }
    
   public function forgotPassword()
   {
    if ($this->input->is_ajax_request()) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {

            $csrf_token =  $this->security->get_csrf_hash();
                        

        $this->form_validation->set_rules('email','Email','trim|required|valid_email',true);
        if ($this->form_validation->run() == false) {

                        $data = [
                        'error'   => true,
                        'email_error' => form_error('email'),
                        'csrf_token' => $csrf_token
                        
                        ];

                        echo json_encode($data);
            
        }else{

            $email = $this->input->post('email');
            $user = $this->db->get_where('user',['email' => $email,'is_active' => 1])->row_array();
            
            if ($user) {
                    $token = base64_encode(random_bytes(32));
                    $user_token = [
                        'email' => $email,
                        'token' => $token,
                        'date_created' => time()
                    ];
                    $this->db->insert('user_token',$user_token);
                    $this->_sendEmail($token,'forgot');



                $data = [
                'success'   => 'Please check your email to reset your password!',
                'csrf_token' => $csrf_token
                
                ];
                echo json_encode($data);

            }else{
                //  $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Email is not registered or activated!</div>');
                // redirect('auth/forgotpassword');



                        $data = [
                        'error'   => true,
                        'email_error' => 'Email is not registered or activated!',
                        'csrf_token' => $csrf_token
                        
                        ];

                        echo json_encode($data);
            }
        }
       }else{
        redirect('Notfound');
       }
    }else{
        redirect('Notfound');
    }
      
   } 

   public function resetPassword()
   {
     $email = $this->input->get('email');
     $token = $this->input->get('token');

     $user = $this->db->get_where('user',['email' => $email])->row_array();

     if ($user) {
         $user_token = $this->db->get_where('user_token',['token' => $token])->row_array();
         if ($user_token) {
              $this->session->set_userdata('reset_email',$email);
              $this->changePassword();
         }else{
             $this->session->set_flashdata('message','<div class="text-danger text-center" role="alert">Reset password failed! Wrong token.</div>');
             redirect('home');
         }
     }else{
         $this->session->set_flashdata('message','<div class="text-danger text-center" role="alert">Reset password failed! Wrong email.</div>');
         redirect('home');
     }

   }

   public function changePassword()
   {
         if (!$this->session->userdata('reset_email')) {
            redirect('notfound');
          }

         $this->form_validation->set_rules('password1','New Password','required|trim|min_length[3]|matches[password2]');
         $this->form_validation->set_rules('password2','Confirm Password','required|trim|min_length[3]|matches[password1]');
         if ($this->form_validation->run() == false) {
                 $data['title'] = 'Change Password';
                 $this->load->view('auth/header',$data);
                 $this->load->view('auth/change-password');
                 $this->load->view('auth/footer');
         }else{
              $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
              $email = $this->session->userdata('reset_email');
              

              $this->db->set('password',$password);
              $this->db->where('email',$email);
              $this->db->update('user');
              $this->db->delete('user_token',['email' => $email]);


             $this->session->unset_userdata('reset_email');
             $this->session->unset_userdata('email');
             $this->session->set_flashdata('message','<div class="text-success text-center" role="alert">Password has been changed! Please login.</div>');

             redirect('home');
         }

   }

}

