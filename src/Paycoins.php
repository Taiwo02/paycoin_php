<?php

namespace Paycoin\Paycoins;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class Paycoins 
{
    public static function getInvoinces()
    {
       $client = new Client([
           'base_uri' => 'https://africa-crypto.herokuapp.com/'
       ]); 
       try {
           $res = $client->request('GET','api/invoices',[
                "headers" =>[
                    'X-SEC-KEY' => config('paycoinConfig.X-SEC-KEY'),
                    'X-PBK-KEY' => config('paycoinConfig.X-PBK-KEY')

                ]
                ]);
                echo response()->json([$res]);
                return response()->json([
                    'code' => $res->getStatusCode(),
                    'message' => $res->getReasonPhrase(),
                    'datas' => $res->getBody(),

                ]);
       } catch (GuzzleException $e) {
           return response()->json([
                    'error' => $e->getMessage()
           ],500);
       }
    }

    public static function getInvoince(string $id, ?string $dimension = null)
    {
       $client = new Client([
           'base_uri' => 'https://africa-crypto.herokuapp.com/'
       ]); 
        if ($dimension) {
            $json['dimension'] = $dimension;
        }
       try {
           $res = $client->request('GET','api/invoice_details/'.$id,[
                "headers" =>[
                    'X-SEC-KEY' => config('paycoinConfig.X-SEC-KEY'),
                    'X-PBK-KEY' => config('paycoinConfig.X-PBK-KEY')

                ]
                ]);
                echo response()->json([$res]);
                return response()->json([
                    'code' => $res->getStatusCode(),
                    'message' => $res->getReasonPhrase(),
                    'datas' => $res->getBody(),

                ]);
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
        $json = [
            'amount' => $amount,
            'currency' => $currency,
            'redirect_url' => $redirect_url,
             'customer' => $customer,
             'customization'  => $customization,

        ];
        if ($dimension) {
            $json['dimension'] = $dimension;
        }
       try {
           $res = $client->request('POST','api/invoice',[
                'json'=>$json,
                "headers" =>[
                    'X-SEC-KEY' => config('paycoinConfig.X-SEC-KEY'),
                    'X-PBK-KEY' => config('paycoinConfig.X-PBK-KEY')

                ]
                ]);
                return response()->json([
                    'code' => $res->getStatusCode(),
                    'message' => $res->getReasonPhrase(),


                ]);
       } catch (GuzzleException $e) {
           return response()->json([
                    'error' => $e->getMessage()
           ],500);
       }
    }
}