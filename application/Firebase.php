<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
* Name:  Inci_Firebase
*
* Version: 1.0
*
* Author: 
 * 
* Added Awesomeness: 
 * 
* Created:  2017
*
* Description:  
*
* Requirements: PHP5 or above
*
*/
/*
 | -------------------------------------------------------------------------
 | Authentication options.
 | -------------------------------------------------------------------------
 | 
 */
class Firebase {
   
    private $methos='GET';
    private $data='';
    private $URL='';
    
    function __construct()
    {
       
    }
    
    public function setMethod($method){
       $this->method=$method;
    }
    public function getMethod(){
        return $this->method;
    }
    public function setData($data=array()){
       $this->data=json_encode($data);
    }
    public function getData(){
        return $this->data;
    }
    public function setUrl($URL){
       $this->URL=$URL;
    }
    public function getUrl(){
        return $this->URL;
    }    
    public function run(){
         
                        $ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,$this->URL);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $this->method);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $this->data);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
				'Content-Type: application/json; charset=utf-8',
				'Accept: application/json')
                            );
			$response  = curl_exec($ch);
			curl_close($ch);
                        
                        print_r($response);
    }
    public function resetFV(){
        $this->URL="";
        $this->data="";
        $this->method="";
    }
    
}