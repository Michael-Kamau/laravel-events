<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MpesaPaymentController extends Controller
{

    function generateToken()
    {
//        $consumerKey = 'tVFrOrX4NEhXdgo8F0EKTFqIhbiqSrPt'; //Fill with your app Consumer Key
//        $consumerSecret = '8vxt1LEPlKpQoE9p'; // Fill with your app Secret


        $consumerKey = env('CONSUMER_KEY'); //Fill with your app Consumer Key
        $consumerSecret = env('CONSUMER_SECRET'); // Fill with your app Secret

        $headers = ['Content-Type:application/json; charset=utf8'];

        $url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_HEADER, FALSE);
        curl_setopt($curl, CURLOPT_USERPWD, $consumerKey . ':' . $consumerSecret);
        $result = curl_exec($curl);
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $result = json_decode($result);

        $access_token = $result->access_token;

        return $access_token;

        // curl_close($curl);
    }

//function to register the confirmation and validation urls

    function registerURLS()
    {
        $register_url = 'https://sandbox.safaricom.co.ke/mpesa/c2b/v1/registerurl';

        //$access_token = $access_token; // check the mpesa_accesstoken.php file for this. No need to writing a new file here, just combine the code as in the tutorial.
        $shortCode = '600000'; // provide the short code obtained from your test credentials

        /* This two files are provided in the project. */
        $confirmationUrl = 'https://star-events.000webhostapp.com/mp2/confirmation/'; // path to your confirmation url. can be IP address that is publicly accessible or a url
        $validationUrl = 'https://star-events.000webhostapp.com/mp2/validation/'; // path to your validation url. can be IP address that is publicly accessible or a url


        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $register_url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Authorization:Bearer VZ628p6rVdqVzWa7MpNLAYwDZLy6')); //setting custom header


        $curl_post_data = array(
            //Fill in the request parameters with valid values
            'ShortCode' => $shortCode,
            'ResponseType' => 'Completed',
            'ConfirmationURL' => $confirmationUrl,
            'ValidationURL' => $validationUrl
        );

        $data_string = json_encode($curl_post_data);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

        $curl_response = curl_exec($curl);
// 	print_r($curl_response);

        return $curl_response;
    }


//Simulate Transaction
    function simulateC2B($amount, $phone)
    {
        $url = 'https://sandbox.safaricom.co.ke/mpesa/c2b/v1/simulate';

        // $access_token = $access_token; // check file mpesa_accesstoken.php.
        $ShortCode = '600000'; // Shortcode. Same as the one on register_url.php
        // $amount     = '100'; // amount the client/we are paying to the paybill
        // $msisdn     = '254708374149'; // phone number paying
        $billRef = 'test'; // This is anything that helps identify the specific transaction. Can be a clients ID, Account Number, Invoice amount, cart no.. etc

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Authorization:Bearer ' . generateToken()));


        $curl_post_data = array(
            'ShortCode' => $ShortCode,
            'CommandID' => 'CustomerPayBillOnline',
            'Amount' => $amount,
            'Msisdn' => $phone,
            'BillRefNumber' => $billRef
        );

        $data_string = json_encode($curl_post_data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
        $curl_response = curl_exec($curl);
        // print_r($curl_response);

        return $curl_response;
    }


    function stkPush()
    {
        $url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';

        $BusinessShortCode = env('BUSINESS_SHORTCODE');
        $Timestamp = date('YmdGis');
        $PartyA = '254727242802';
        $CallBackUrl = 'http://star-events.000webhostapp.com/mp2/callBack';
        $AccountReference = 'Cart3';
        $TransactionDesc = ' Cart Payment for online service';
        $Amount = '2';
        $passkey = env('PASSKEY');

        $password = base64_encode($BusinessShortCode . $passkey . $Timestamp);

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Authorization:Bearer ' . generateToken())); //setting custom header


        $curl_post_data = array(
            //Fill in the request parameters with valid values
            'BusinessShortCode' => $BusinessShortCode,
            'Password' => $password,
            'Timestamp' => $Timestamp,
            'TransactionType' => 'CustomerPayBillOnline',
            'Amount' => $Amount,
            'PartyA' => $PartyA,
            'PartyB' => $BusinessShortCode,
            'PhoneNumber' => $PartyA,
            'CallBackURL' => $CallBackUrl,
            'AccountReference' => $AccountReference,
            'TransactionDesc' => $TransactionDesc
        );

        $data_string = json_encode($curl_post_data);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

        $curl_response = curl_exec($curl);
        print_r($curl_response);

        return $curl_response;
    }


    function STK_Push()
    {
        date_default_timezone_set('Africa/Nairobi');

        # access token
        $consumerKey = env('CONSUMER_KEY'); //Fill with your app Consumer Key
        $consumerSecret = env('CONSUMER_SECRET'); // Fill with your app Secret

        # define the variales
        # provide the following details, this part is found on your test credentials on the developer account
        $BusinessShortCode = env('BUSINESS_SHORTCODE');
        $Passkey = env('PASSKEY');

        /*
          This are your info, for
          $PartyA should be the ACTUAL clients phone number or your phone number, format 2547********
          $AccountRefference, it maybe invoice number, account number etc on production systems, but for test just put anything
          TransactionDesc can be anything, probably a better description of or the transaction
          $Amount this is the total invoiced amount, Any amount here will be
          actually deducted from a clients side/your test phone number once the PIN has been entered to authorize the transaction.
          for developer/test accounts, this money will be reversed automatically by midnight.
        */

        $PartyA = '254727242802'; // This is your phone number,
        $AccountReference = 'style manager';
        $TransactionDesc = 'Nohtingness';
        $Amount = '2';

        # Get the timestamp, format YYYYmmddhms -> 20181004151020
        $Timestamp = date('YmdHis');

        # Get the base64 encoded string -> $password. The passkey is the M-PESA Public Key
        $Password = base64_encode($BusinessShortCode . $Passkey . $Timestamp);

        # header for access token
        $headers = ['Content-Type:application/json; charset=utf8'];

        # M-PESA endpoint urls
        $access_token_url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
        $initiate_url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';

        # callback url
        $CallBackURL = 'http://star-events.000webhostapp.com/mp2/callBack/index.php';

        $curl = curl_init($access_token_url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_HEADER, FALSE);
        curl_setopt($curl, CURLOPT_USERPWD, $consumerKey . ':' . $consumerSecret);
        $result = curl_exec($curl);
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $result = json_decode($result);
        $access_token = $result->access_token;
        curl_close($curl);

        # header for stk push
        $stkheader = ['Content-Type:application/json', 'Authorization:Bearer ' . $access_token];

        # initiating the transaction
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $initiate_url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $stkheader); //setting custom header

        $curl_post_data = array(
            //Fill in the request parameters with valid values
            'BusinessShortCode' => $BusinessShortCode,
            'Password' => $Password,
            'Timestamp' => $Timestamp,
            'TransactionType' => 'CustomerPayBillOnline',
            'Amount' => $Amount,
            'PartyA' => $PartyA,
            'PartyB' => $BusinessShortCode,
            'PhoneNumber' => $PartyA,
            'CallBackURL' => $CallBackURL,
            'AccountReference' => $AccountReference,
            'TransactionDesc' => $TransactionDesc
        );

        $data_string = json_encode($curl_post_data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
        $curl_response = curl_exec($curl);
        //print_r($curl_response);

        return $curl_response;
    }


}
