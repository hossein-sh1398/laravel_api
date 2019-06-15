<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Buy;
use App\Http\Resources\v1\Course as CourseResource;
class PayController extends Controller
{
  public function buy(Request $request,Course $course){
      require_once('../app/lib/nusoap.php');
      $order = Buy::create([
        'user_id'=>auth()->user()->id,
        'course_id'=>$course->id,
        'price'=>$course->price
      ]);
session()->put('order',$order);
$MerchantID = 'f83cc956-f59f-11e6-889a-005056a205be';  
$Amount =  $order->price;  
$Description = 'توضیحات تراکنش تستی'; // 
$Email = auth()->user()->email;  
$Mobile = '09123456789';  
$CallbackURL = 'https://localhost:8000/pay/callback';  
 
 // $client = new NuSOAP_Client('https://pgws.bpm.bankmellat.ir/pgwchannel/services/pgw?wsdl', 'wsdl');
$client =new \SoapClient('https://www.zarinpal.com/pg/services/WebGate/wsdl','wsdl' );

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

  
if ($result->Status == 100) {
redirect('https://www.zarinpal.com/pg/StartPay/'.$result->Authority);
} else {
return'خطا در درخواست برای پرداخت';
}
      
  }
 
  public function call_back(Request $request){
$order= session('order');
$MerchantID = 'XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX';
$Amount = $order->price;  
$Authority = request('Authority');

if (request('Status') == 'OK') {

$client = new \SoapClient('https://www.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);

$result = $client->PaymentVerification(
[
'MerchantID' => $MerchantID,
'Authority' => $Authority,
'Amount' => $Amount,
]
);

if ($result->Status == 100) {

$order->ref_id=$result->RefID;
$order->authority=$result->Authority;
$order->pay_status=true;
$order->update();
} else {
return 'خطا در پرداخت';
}
} else {
return  'خطا در ارتباط با درگاه پرداخت';
}
  }
}

