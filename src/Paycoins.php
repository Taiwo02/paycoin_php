<?php

namespace Paycoin\Paycoins;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Http;

class Paycoins 
{
 public static $url = 'https://africa-crypto.herokuapp.com/api';

    public static function exchangeRate(?string $currency = null)
    {
        try {
            $currency = $currency ? $currency : "USD";
          $headers = [
            'X-SEC-KEY' => config('paycoinConfig.X-SEC-KEY')
    
          ];
           $response = Http::withHeaders(
             $headers
         )->get(self::$url.'/exchange-rates/'.$currency );

           return response()->json( json_decode($response->body() ));

       } catch (GuzzleException $e) {
           return response()->json([
                    'error' => $e->getMessage()
           ],500);
       }
    }



    public static function getInvoices()
    {
        try {
          $headers = [
            'X-SEC-KEY' => config('paycoinConfig.X-SEC-KEY')
    
          ];
           $response = Http::withHeaders(
             $headers
         )->get(self::$url.'/invoices');

           return response()->json( json_decode($response->body() ));

       } catch (GuzzleException $e) {
           return response()->json([
                    'error' => $e->getMessage()
           ],500);
       }
    }

    public static function getInvoice(string $id, ?string $dimension = null)
    {
        if ($dimension) {
            $json['dimension'] = $dimension;
        }
       try {
        $headers = [
            'X-SEC-KEY' => config('paycoinConfig.X-SEC-KEY')
    
          ];
           $response = Http::withHeaders(
             $headers
         )->get(self::$url.'/invoice_details/'.$id);

           return response()->json( json_decode($response->body() ));

       } catch (GuzzleException $e) {
           return response()->json([
                    'error' => $e->getMessage()
           ],500);
       }
    }
 public static function create_invoice($data, ?string $dimension = null)
 {
        // return response()->json($data);
 
        if ($dimension) {
            $json['dimension'] = $dimension;
        }
       try {
        $headers = [
            'X-SEC-KEY' => config('paycoinConfig.X-SEC-KEY')
    
          ];
           $response = Http::withHeaders(
             $headers
         )->post(self::$url.'/invoice',
             $data
         );
           return response()->json( json_decode($response->body()));
       } catch (GuzzleException $e) {
           return response()->json([
                    'error' => $e->getMessage()
           ],500);
       }
    }
}