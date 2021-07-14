<?php

namespace Paycoin\Paycoins;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Http;

class Paycoins 
{
    public static function getInvoinces()
    {
        try {
          $headers = [
            'X-SEC-KEY' => config('paycoinConfig.X-SEC-KEY'),
            'X-PBK-KEY' => config('paycoinConfig.X-PBK-KEY')
    
          ];
           $response = Http::withHeaders(
             $headers
         )->get('https://africa-crypto.herokuapp.com/api/invoices');

           return response()->json( json_decode($response->body() ));

       } catch (GuzzleException $e) {
           return response()->json([
                    'error' => $e->getMessage()
           ],500);
       }
    }

    public static function getInvoince(string $id, ?string $dimension = null)
    {
        if ($dimension) {
            $json['dimension'] = $dimension;
        }
       try {
        $headers = [
            'X-SEC-KEY' => config('paycoinConfig.X-SEC-KEY'),
            'X-PBK-KEY' => config('paycoinConfig.X-PBK-KEY')
    
          ];
           $response = Http::withHeaders(
             $headers
         )->get('https://africa-crypto.herokuapp.com/api/invoice_details/'.$id);

           return response()->json( json_decode($response->body() ));

       } catch (GuzzleException $e) {
           return response()->json([
                    'error' => $e->getMessage()
           ],500);
       }
    }
 public static function create_invoice(float $amount,string $currency,string $redirect_url, object $customer,object $customization, ?string $dimension = null)
    {
       $client = new Client([
           'base_uri' => 'https://africa-crypto.herokuapp.com/'
       ]); 
        $json = (object) [
            

        ];
        if ($dimension) {
            $json['dimension'] = $dimension;
        }
       try {
        $headers = [
            'X-SEC-KEY' => config('paycoinConfig.X-SEC-KEY'),
            'X-PBK-KEY' => config('paycoinConfig.X-PBK-KEY')
    
          ];
           $response = Http::withHeaders(
             $headers
         )->post('https://africa-crypto.herokuapp.com/api/invoice',[
            'amount' => $amount,
            'currency' => $currency,
            'redirect_url' => $redirect_url,
             'customer' => $customer,
             'customization'  => $customization,
            ]
         );
           return response()->json( json_decode($response->body()));
       } catch (GuzzleException $e) {
           return response()->json([
                    'error' => $e->getMessage()
           ],500);
       }
    }
}