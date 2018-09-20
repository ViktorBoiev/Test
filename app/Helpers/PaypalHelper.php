<?php

namespace App\Helpers;


trait PaypalHelper
{
    protected $url = 'https://svcs.sandbox.paypal.com/AdaptivePayments/Pay';

    public function makePay($email, $amount)
    {
        $data = [
            "actionType" =>"PAY", // Payment action type
            "currencyCode" =>"USD", // Payment currency code
            "receiverList" =>json_encode([
                "receiver" =>[json_encode([
                    "amount" => $amount .".00",
                    "email" => $email,
                    ])]
                ]),
            "returnUrl" => route('lottery'), // Redirect URL after approval
            "cancelUrl" =>route('lottery'), // Redirect URL after cancellation
            "requestEnvelope" =>json_encode([
                "errorLanguage" =>"en_US", // Language used to display errors
                "detailLevel" =>"ReturnAll" // Error detail level
            ])
        ];


        $curl = curl_init();

        //curl headers are for test use only
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => [
                "X-PAYPAL-SECURITY-USERID: " . env('PAYPAL_USERID', 'caller_1312486258_biz_api1.gmail.com'),
                "X-PAYPAL-SECURITY-PASSWORD: " . env('PAYPAL_PASSWORD', '1312486294') ,
                "X-PAYPAL-SECURITY-SIGNATURE: " . env('PAYPAL_SIGNATURE', 'AbtI7HV1xB428VygBUcIhARzxch4AL65.T18CTeylixNNxDZUu0iO87e') ,
                "X-PAYPAL-REQUEST-DATA-FORMAT: JSON" ,
                "X-PAYPAL-RESPONSE-DATA-FORMAT: JSON" ,
                "X-PAYPAL-APPLICATION-ID: " . env('PAYPAL_APPID', 'APP-80W284485P519543T') ,
            ],
        ));

        $data = [];
        $data['response'] = curl_exec($curl);
        $data['err'] = curl_error($curl);

        curl_close($curl);

        return $data;
    }
}