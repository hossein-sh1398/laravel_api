<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SoapClient;
class PayController extends Controller
{
   public function pay(){
$MerchantID = 'f83cc956-f59f-11e6-889a-005056a205be'; //Required
$Amount = 1000; //Amount will be based on Toman - Required
$Description = 'توضیحات تراکنش تستی'; // Required
$Email = 'UserEmail@Mail.Com'; // Optional
$Mobile = '09123456789'; // Optional
$CallbackURL = 'http://http://localhost:8000/calback/pay'; // Required
 
 
$client = new \SoapClient('https://www.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);

$result = $client->PaymentRequest(
[
'MerchantID' => $MerchantID,
'Amount' => $Amount,
'Description' => $Description,
'Email' => $Email,
'Mobile' => $Mobile,
'CallbackURL' => $CallbackURL,
]
);

//Redirect to URL You can do it also by creating a form
if ($result->Status == 100) {
redirect('https://www.zarinpal.com/pg/StartPay/'.$result->Authority);
} else {
echo'ERR: '.$result->Status;
}
   }

   public function call_backpay(){
   $MerchantID = 'XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX';
$Amount = 1000; //Amount will be based on Toman
$Authority = $_GET['Authority'];

if ($_GET['Status'] == 'OK') {

$client = new SoapClient('https://www.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);

$result = $client->PaymentVerification(
[
'MerchantID' => $MerchantID,
'Authority' => $Authority,
'Amount' => $Amount,
]
);

if ($result->Status == 100) {
echo 'Transaction success. RefID:'.$result->RefID;
} else {
echo 'Transaction failed. Status:'.$result->Status;
}
} else {
echo 'Transaction canceled by user';
}
   }
}
