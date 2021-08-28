<?php

namespace App\Http\Controllers;

use DOMDocument;
use DOMAttr;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function generateToken()
    {

        $token = env('DPO_COMPANY_TOKEN');

        $headers = ['Content-Type:application/xml; charset=utf8'];

        $url = 'https://secure1.sandbox.directpay.online/API/v6/';

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_HEADER, FALSE);
//        curl_setopt($curl, CURLOPT_USERPWD, $consumerKey . ':' . $consumerSecret);
        $result = curl_exec($curl);
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $result = json_decode($result);

        $access_token = $result->access_token;

        return $access_token;

        // curl_close($curl);
    }


    public function generateToken2()
    {

        $xml= $this->createXmlObject();

//        dd($xml);

        $url = "https://secure1.sandbox.directpay.online/API/v6/"; // URL to make some test
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/xml'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, "xml=" . $xml);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $data = curl_exec($ch);

        dd($data);


        echo '<pre>';
        echo htmlentities($data);
        echo '</pre>';

        if (curl_errno($ch))
            print curl_error($ch);
        else
            curl_close($ch);
    }


    public function createXmlObject()
    {

        $dom = new DOMDocument();

        $dom->encoding = 'utf-8';

        $dom->xmlVersion = '1.0';

        $dom->formatOutput = true;

        $root = $dom->createElement('API3G');

        //API3G LEVEL
        $token_node = $dom->createElement('CompanyToken', env('DPO_COMPANY_TOKEN'));
        $request_node = $dom->createElement('Request', 'createToken');
        $transaction_node = $dom->createElement('Transaction');
        $Services_node = $dom->createElement('Services');


        //TRANSACTION LEVEL
        $child_node_amount = $dom->createElement('PaymentAmount', '300.00');
        $transaction_node->appendChild($child_node_amount);

        $child_node_currency = $dom->createElement('PaymentCurrency', 'USD');
        $transaction_node->appendChild($child_node_currency);

        $child_node_ref = $dom->createElement('CompanyRef', 'XXHYTES');
        $transaction_node->appendChild($child_node_ref);

//        $child_node_redirectUrl = $dom->createElement('RedirectURL', 'https://youtube.com');
//        $transaction_node->appendChild($child_node_redirectUrl);
//
//        $child_node_backUrl = $dom->createElement('BackURL', 'https://youtube.com');
//        $transaction_node->appendChild($child_node_backUrl);

        //SERVICES LEVEL
        $child_node_service = $dom->createElement('Service');
        $Services_node->appendChild($child_node_service);

        $second_level_child_node_service_type = $dom->createElement('ServiceType', 5525);
        $child_node_service->appendChild($second_level_child_node_service_type);

        $second_level_child_node_service_description = $dom->createElement('ServiceDescription', 'Flight from Nairobi to Diani');
        $child_node_service->appendChild($second_level_child_node_service_description);

        $second_level_child_node_service_date = $dom->createElement('ServiceDate', '2013/12/20 19:00');
        $child_node_service->appendChild($second_level_child_node_service_date);


        $root->appendChild($token_node);
        $root->appendChild($request_node);
        $root->appendChild($transaction_node);
        $root->appendChild($Services_node);

        $dom->appendChild($root);

        return  $dom->saveXML();
        dd($dom);


        echo " has been successfully created";
    }
}
