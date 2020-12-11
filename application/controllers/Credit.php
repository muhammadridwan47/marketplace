<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Credit extends CI_Controller{
    
    function  __construct(){
        parent::__construct();
        if (!$this->session->userdata('email')) {
            redirect('auth/blocked');
        }
        // Load paypal library & product model
        // $this->load->library('paypal_transaksi'); 
        cekSaldo();
    }
    
    function index(){
        // $data = array();
        

        // pelengkap
          
        $this->session->unset_userdata('transaksi');
        $email = $this->session->userdata('email');
        $data['title'] = 'Credit';
        $data['user'] = $this->db->get_where('user',['email'=> $email ])->row_array();
        // Get products data from the database
        // $data['products'] = $this->product->getRows();
        
        // Pass products data to the view
        $this->load->view('templates/header_pages',$data);
        $this->load->view('credit/index', $data);
        // $this->load->view('produk/footer');

    }
    
    function buy(){
        // Set variables for paypal form
        if ($_SERVER['REQUEST_METHOD'] != 'POST')
        {
            redirect('Not-Found');
        }else{

            $this->session->unset_userdata('transaksi');
            $name = htmlspecialchars($this->input->post('price'));
            $returnURL = base_url('credit/success');
            $cancelURL = base_url('home');
            // $notifyURL = base_url();
            
            // Get product data from the database
            // $product = $this->product->getRows($id);
            $product = $this->db->get_where('products',['name' => $name ])->row_array();

            if (!$product) {
                redirect('Not-Found');
            }
            
            // Get current user ID from the session

            // nanti rubah dengan id pengguna hash
            $user = $this->db->get_where('user',['email' => $this->session->userdata('email')])->row_array();


            $random1 = strtoupper(base64_encode(random_bytes(16)));
            $random = preg_replace('/[^A-Za-z0-9\  ]/', '',$random1);


            $data = [
                        'username' => $user['username'],
                        'email' => $user['email'],
                        'id_transaksi' => $random,
                        'harga' => $product['name'],
                        'price' => $product['price'],
                        'nomor_item' => $product['id'],
                        'status' => 'pending',
                        'time' => time(),
                        'waktu' => date('d-m-Y'),
            ];

            $this->db->insert('konfirmasi_transaksi',$data);
            // $username_hash 

            $this->session->set_userdata(['transaksi' => $random]);
            // Lakukan transaksi
            $hasil = [
                'amount' => $product['price'],
                'transactionId'=>$random,
                'description' => $product['name'],
                'currency'=>'USD',
                'returnUrl'=> $returnURL,
                'cancelUrl'=> $cancelURL
            ];
            $purchaseProc = new Paypal_transaksi();
            $purchaseProc->sendPurchase($hasil);
        }
    }

    public function success() 
    {
        if ($this->session->userdata('transaksi')) {
            
            if (array_key_exists('paymentId', $_GET) && array_key_exists('PayerID', $_GET)) {


                    $transaction = $this->paypal_transaksi->gateway->completePurchase(array(
                        'payer_id'             => $_GET['PayerID'],
                        'transactionReference' => $_GET['paymentId'],
                    ));
                    $response = $transaction->send();
                
                    if ($response->isSuccessful()) {
                        // The customer has successfully paid.
                        $arr_body = $response->getData();
                
                        // $payment_id = $arr_body['id'];
                        // $payer_id = $arr_body['payer']['payer_info']['payer_id'];
                        $transaction_id = $arr_body['transactions'][0]['invoice_number'];
                        $total = $arr_body['transactions'][0]['amount']['total'];
                        $payer_email = $arr_body['payer']['payer_info']['email'];
                        $payment_status = $arr_body['state'];
                        
                        $user = $this->db->get_where('user',['email' => $this->session->userdata('email')])->row_array();

                        if ($payment_status == 'approved') {
                            if ($konfirmasi = $this->db->get_where('konfirmasi_transaksi',['id_transaksi' => $transaction_id,'status' => 'pending','price' => $total])->row_array()) {
                                    if ($this->db->get_where('konfirmasi_transaksi',['id_transaksi' => $transaction_id,'email' => $user['email']])->row_array()) {
                                
                                        if($konfirmasi['nomor_item'] == 1){
                                            $isi = 25;
                                        }
                                        if($konfirmasi['nomor_item'] == 2){
                                            $isi = 50;
                                        }                            
                                        if($konfirmasi['nomor_item'] == 3){
                                            if ($user['role_id']  != 1) {
                                                $isi = 100;
                                            }else{
                                                $isi = 110; 
                                            }
                                        } 


                                        // user saldo 
                                        $saldo = $user['saldo'];
                                        $email = $user['email'];
                                        $this->db->query("UPDATE user SET saldo = $saldo + $isi WHERE email= '{$email}'");
                                        
                                        // Konfirmasi status 
                                        $this->db->set('status','sukses');
                                        $this->db->set('email_paypal',$payer_email);
                                        $this->db->where('id_transaksi',$konfirmasi['id_transaksi']);
                                        $this->db->update('konfirmasi_transaksi');

                                        $this->session->unset_userdata('transaksi');
                                        redirect('credit');
                                    }
                            }else{
                                redirect('credit');
                            }   
                        }else{
                            redirect('credit');
                        }

                    } else {
                        echo $response->getMessage();
                    }
            } else {
                // echo 'Transaction is declined';
                redirect('notfound');
            }
        }else{
            redirect('auth/bloked');
        }
        
    }

}