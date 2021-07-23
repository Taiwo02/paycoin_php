<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Paycoin\Paycoins\Paycoins;

class PaycoinController extends Controller
{

    public function invoices()
    {
       return Paycoins::getInvoinces();
    }
    public function invoice_details()
    {
       return Paycoins::getInvoince("INV1626354432969");
    }

    public function test()
    {
        // return "Heloo";
       return Paycoins::create_invoice(
           (object)[
              "amount" => 1000000,
               "currency" => 'NGN',
              "redirect_url"=> 'https://abc.com',
                "customer" =>  ['firstname' => "adela",'lastname' => "samson",'email' => "adeola@gmail.com"],
              "customization" => ["title" => "Sales"]

           ]
        );
    }

}
