<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Paycoin\Paycoins\Paycoins;

class PaycoinController extends Controller
{


   public function exchangeRate(){

      return Paycoins::exchangeRate("USD");
   }


    public function invoices(){

       return Paycoins::getInvoices();
    }


    public function invoice_details(){

       return Paycoins::getInvoice("INV1626354432969");
    }



    public function createInvoice(){
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
