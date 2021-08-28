<?php

namespace App\Traits\Payments;

use DOMDocument;
use DOMAttr;
use Illuminate\Http\Request;

trait DPOPayment
{

public function generateToken()
    {

        $token = env('DPO_COMPANY_TOKEN');

        $headers = ['Content-Type:application/xml; charset=utf8'];

        $url = 'https://secure.3gdirectpay.com/API/v6/';

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


    public function generateToken2($amount, $service, $serviceId, $bookingDetails)
    {

        $xml= $this->createXmlObject($amount, $service, $serviceId, $bookingDetails);
//        dd($xml);

        $url = "https://secure.3gdirectpay.com/API/v6/"; // URL to make some test
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/xml'));
        curl_setopt($ch, CURLOPT_POSTFIELDS,  $xml);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $data = curl_exec($ch);

        if (curl_errno($ch)){

            print curl_error($ch);

        }
        else{

             $xml_response = simplexml_load_string($data);
             $json_response = json_encode($xml_response);
             $array_response = json_decode($json_response,TRUE);

             curl_close($ch);


             if($array_response['Result'] == '000'){

                    return [
                         'data' => $array_response,
                         'success' => TRUE
                     ];
             } else{
                    return [
                         'data' => $array_response,
                          'success' => FALSE
                     ];

             }

        }
    }



    public function verifyToken(){

    $token = env('DPO_COMPANY_TOKEN');

    $xml = $this->createVerifyXmlObject();

    dd($xml);

    $url = "https://secure.3gdirectpay.com/API/v6/"; // URL to make some test
    $ch = curl_init($url);

                    curl_setopt($ch, CURLOPT_POST, true);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/xml'));
                    curl_setopt($ch, CURLOPT_POSTFIELDS,  $xml);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

                    $data = curl_exec($ch);

                    if (curl_errno($ch)){

                        print curl_error($ch);

                    }
                    else{

                         $xml_response = simplexml_load_string($data);
                         $json_response = json_encode($xml_response);
                         $array_response = json_decode($json_response,TRUE);

                         curl_close($ch);


                         if($array_response['Result'] == '000'){

                                return [
                                     'data' => $array_response,
                                     'success' => TRUE
                                 ];
                         } else{
                                return [
                                     'data' => $array_response,
                                      'success' => FALSE
                                 ];

                         }

                    }

    }





    public function createXmlObject($amount, $service, $serviceId, $bookingDetails)
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
        $child_node_amount = $dom->createElement('PaymentAmount', $amount);
        $transaction_node->appendChild($child_node_amount);

        $child_node_currency = $dom->createElement('PaymentCurrency', 'KES');
        $transaction_node->appendChild($child_node_currency);

        $child_node_ref = $dom->createElement('CompanyRef', $serviceId);
        $transaction_node->appendChild($child_node_ref);

        $child_node_email = $dom->createElement('customerEmail', $bookingDetails->email);
        $transaction_node->appendChild($child_node_email);

        $child_node_firstname = $dom->createElement('customerFirstName', $bookingDetails->firstname);
        $transaction_node->appendChild($child_node_firstname);

        $child_node_lastname = $dom->createElement('customerLastName', $bookingDetails->lastname);
        $transaction_node->appendChild($child_node_lastname);

        $child_node_phone = $dom->createElement('customerPhone', $bookingDetails->contact);
        $transaction_node->appendChild($child_node_phone);



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

        $second_level_child_node_service_description = $dom->createElement('ServiceDescription', $service);
        $child_node_service->appendChild($second_level_child_node_service_description);

        $second_level_child_node_service_date = $dom->createElement('ServiceDate', '2013/12/20 19:00');
        $child_node_service->appendChild($second_level_child_node_service_date);


        $root->appendChild($token_node);
        $root->appendChild($request_node);
        $root->appendChild($transaction_node);
        $root->appendChild($Services_node);

        $dom->appendChild($root);

//         dd($dom->saveXML());

        return  $dom->saveXML();

    }




    public function createVerifyXmlObject(){



                       $dom = new DOMDocument();

                              $dom->encoding = 'utf-8';

                              $dom->xmlVersion = '1.0';

                              $dom->formatOutput = true;

                              $root = $dom->createElement('API3G');

                              //API3G LEVEL
                              $token_node = $dom->createElement('CompanyToken', env('DPO_COMPANY_TOKEN'));
                              $request_node = $dom->createElement('Request', 'verifyToken');
                              $transaction_node = $dom->createElement('TransactionToken', 'weqweqwe');


                              $root->appendChild($token_node);
                              $root->appendChild($request_node);
                              $root->appendChild($transaction_node);

                              $dom->appendChild($root);

                      //         dd($dom->saveXML());

                              return  $dom->saveXML();




    }




}
