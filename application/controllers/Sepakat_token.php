<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sepakat_token extends Front	
{
	
	public function __construct()
	{
		parent::__construct();

// 		$this->load->model('model_disabilitas');
	}

	public function minta_token()
    {
          $param = uniqid();

         $key = 'gzyUu1L54Aa79BNVHmWvYtMRFje';
         $execute = $this->reqtoken($key, $param);
         print_r($execute);
        
    }

    function reqtoken($key, $param){
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://sepakat.bappenas.go.id/dmd/api/v1/token',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => 'rekues_id='.$param,
          CURLOPT_HTTPHEADER => array(
            'X-SEPAKAT-KEY: '.$key,
          ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        echo $response;

        exit();

        $opts = array(
          'ssl' => array(
            'verify_peer' => false,
          ),
          'http'=>array(
            'ignore_errors' => true,
            'method'=>  "POST",
            'header'=>  "Accept: application/json\r\n" .
                  "X-SEPAKAT-KEY: {$key}\r\n" .
                  "Content-Type: application/json\r\n",
            //'content' => ''
          )
        );
    
        $context = stream_context_create($opts);
        $result = file_get_contents('https://sepakat.bappenas.go.id/dmd/api/v1/token?rekues_id='.$param, false, $context);
        // $result = json_encode($http_response_header,JSON_FORCE_OBJECT|JSON_PRETTY_PRINT)."\n".$result;
        return $result;
      }  


      public function terima_token(){
        //$json = $request->getContent();
         $json = file_get_contents('php://input') ;
         $data  = json_decode($json);
         $TOKEN =  $data->data->token;
         echo 'OK-token diterima TOKEN=> '. $TOKEN;
      }
}
