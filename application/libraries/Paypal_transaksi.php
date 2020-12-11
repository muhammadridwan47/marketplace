<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

include("./vendor/autoload.php"); 

use Omnipay\Omnipay;

class Paypal_transaksi extends Omnipay {

	public $gateway = null;

	public function __construct(){
		$this->gateway = Omnipay::create('PayPal_Rest');
		$this->gateway->setClientId('AakmQLGXOPNQJ-UCYcAWE9iZDrq99XY0jDjG6r3YcFMac4YwhueVOrIT-jQxy4zqrDHYZWcJPiFqym8R');
		$this->gateway->setSecret('EBYEEqK4XWvHnBH6AcRMEgYiSNP2aN179OY2SZataqHNMykl0SHHbTJipQX7pcmhLIZvP6TQDPP8srRp');
		$this->gateway->setTestMode(true); //set it to 'false' when go live
	}

	public function sendPurchase($data){
		$payArray = array(
			'amount'=> $data['amount'],
			'transactionId' => $data['transactionId'],
			'description'=> $data['description'],
			'currency'=>'USD',
			'returnUrl'=> $data['returnUrl'],
			'cancelUrl'=> $data['cancelUrl'],
			);

		$response = $this->gateway->purchase($payArray)->send();
        if ($response->isRedirect()) {
            $response->redirect(); // this will automatically forward the customer
        } else {
            // not successful
            echo $response->getMessage();
        }
		return $response;
	}
}