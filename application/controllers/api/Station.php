<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
//require APPPATH . '/libraries/REST_Controller.php';

// use namespace
//use Restserver\Libraries\REST_Controller;

/**
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array
 *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 * @author          Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 * @link            https://github.com/chriskacerguis/codeigniter-restserver
 */
require('application/libraries/REST_Controller.php');
class Station extends REST_Controller {
    

    function __construct()
    {
        try 
        {
            // normal flow
        }
        catch( Exception $e )
        {
            log_message( 'error', $e->getMessage( ) . ' in ' . $e->getFile() . ':' . $e->getLine() );
            // on error
        }
        // Construct the parent class
        parent::__construct();

        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key  
        
         $response=array();
    }
public function get_get($id=0){
    $is_request=(isset($_REQUEST["save"]))?true:false;
    $notes_arr=array("Note"=>"if you want get the list of station so just add end of the url companyID ex: ".base_url()."/api/company/get/companyID.");
    $reqHeaders = $this->input->request_headers();  
    $set_data=array("msg"=>"Request not rqeuired.");
    $saveRequestToserver_arr=array("project_id"=>CUSTOMER_PROJECT_ID,"method"=>"Station-get","method_url"=>"station/get","method_type"=>"GET","is_request"=>$is_request,"request"=>$set_data,"notes"=>$notes_arr);
     if(!is_numeric($id) || !$id ){
        $response["error"][]=array("code"=>REST_Controller::HTTP_NOT_ACCEPTABLE,'message' => "Invalid company id pass in url.");
        $this->response($response, REST_Controller::HTTP_NOT_ACCEPTABLE,$saveRequestToserver_arr); // NOT_FOUND (404) being the HTTP response code   
        return;
    }
    $checkCompany=$this->company->checkCompanyByID($id);
   if(!$checkCompany){
        $response["error"][]=array("code"=>REST_Controller::HTTP_NOT_ACCEPTABLE,'message' => "This Company id not register.");
        $this->response($response, REST_Controller::HTTP_NOT_ACCEPTABLE,$saveRequestToserver_arr); // NOT_FOUND (404) being the HTTP response code   
        return;
   }
    $this->db->where("company_id", $id);
    $query=$this->db->get("station");
    $result =$query->result();

    $response["success"]=$result;
    $this->response($response, REST_Controller::HTTP_CREATED,$saveRequestToserver_arr);
    return;
}
public function add_post(){
    $is_request=(isset($_REQUEST["save"]))?true:false;
    $notes_arr=array();
    $reqHeaders = $this->input->request_headers();   
    $set_data=$this->post();
    $saveRequestToserver_arr=array("project_id"=>CUSTOMER_PROJECT_ID,"method"=>"Station-add","method_url"=>"station/add","method_type"=>"POST","is_request"=>$is_request,"request"=>$set_data,"notes"=>$notes_arr);
    if(!isset($reqHeaders["Content-Type"],$set_data["data"]) && strtolower($reqHeaders["Content-Type"]) != "application/json; charset=utf-8"){
                        $response["error"][]=array("code"=>REST_Controller::HTTP_BAD_REQUEST,'message' => "In header `Content-Type: application/json; charset=utf-8` Not set. OR Data object Not set in request.");
                        $this->response($response, REST_Controller::HTTP_BAD_REQUEST,$saveRequestToserver_arr); // NOT_FOUND (404) being the HTTP response code
                        return;
    }
                    $get_request_data=$set_data["data"][0];
                    $this->form_validation->set_data($get_request_data);
                    $this->form_validation->set_error_delimiters('', '');
                    $this->form_validation->set_rules("company_id","Company ID","required|trim");
                    $this->form_validation->set_rules("name","Station Name","required|trim");
                    $this->form_validation->set_rules("latitude","Station Latitude","required|trim");
                    $this->form_validation->set_rules("longitude","Station Longitude","required|trim");
                   
                    if ($this->form_validation->run() != true){
                        $response["error"][]=array("code"=>REST_Controller::HTTP_NOT_ACCEPTABLE,'message' => validation_errors());
                        $this->response($response, REST_Controller::HTTP_NOT_ACCEPTABLE,$saveRequestToserver_arr); // NOT_FOUND (404) being the HTTP response code   
                        return;
                    }
                  if(!$this->company->checkCompanyByID($get_request_data["company_id"])){
                        $response["error"][]=array("code"=>REST_Controller::HTTP_NOT_ACCEPTABLE,'message' => "Worng company id pass.");
                        $this->response($response, REST_Controller::HTTP_NOT_ACCEPTABLE,$saveRequestToserver_arr); // NOT_FOUND (404) being the HTTP response code   
                        return;
                    }
                    $checkStationName=$this->station->checkStationByName($get_request_data["name"],$get_request_data["company_id"]);
                    if($checkStationName){
                        $response["error"][]=array("code"=>REST_Controller::HTTP_NOT_ACCEPTABLE,'message' => "this station name already exist.");
                        $this->response($response, REST_Controller::HTTP_NOT_ACCEPTABLE,$saveRequestToserver_arr); // NOT_FOUND (404) being the HTTP response code   
                        return;
                    }
                        $data=array(
                            "company_id"=>$get_request_data["company_id"],
                            "name"=>$get_request_data["name"],
                            "latitude"=>$get_request_data["latitude"],
                            "longitude"=>$get_request_data["longitude"],                           
                            "created_on"=>time(),
                        );
                            if(!$this->db->insert("station",$data)){
                                $response["error"][]=array("code"=>REST_Controller::HTTP_NOT_ACCEPTABLE,"number"=> $this->db->_error_number(),'message' => $this->db->_error_message());
                                $this->response($response, REST_Controller::HTTP_NOT_ACCEPTABLE,$saveRequestToserver_arr); // NOT_FOUND (404) being the HTTP response code   
                                return;
                            }
                            $response["success"][]=array("msg"=>"Station successfully inserted");
                            $this->response($response, REST_Controller::HTTP_CREATED,$saveRequestToserver_arr);
                            return;
}
public function edit_put(){
    $is_request=(isset($_REQUEST["save"]))?true:false;
    $notes_arr=array();
    $reqHeaders = $this->input->request_headers();   
    $set_data=$this->put();
    $saveRequestToserver_arr=array("project_id"=>CUSTOMER_PROJECT_ID,"method"=>"Station-edit","method_url"=>"station/edit","method_type"=>"PUT","is_request"=>$is_request,"request"=>$set_data,"notes"=>$notes_arr);
    if(!isset($reqHeaders["Content-Type"],$set_data["data"]) && strtolower($reqHeaders["Content-Type"]) != "application/json; charset=utf-8"){
                        $response["error"][]=array("code"=>REST_Controller::HTTP_BAD_REQUEST,'message' => "In header `Content-Type: application/json; charset=utf-8` Not set. OR Data object Not set in request.");
                        $this->response($response, REST_Controller::HTTP_BAD_REQUEST,$saveRequestToserver_arr); // NOT_FOUND (404) being the HTTP response code
                        return;
    }
                    $get_request_data=$set_data["data"][0];
                    $this->form_validation->set_data($get_request_data);
                    $this->form_validation->set_error_delimiters('', '');
                    $this->form_validation->set_rules("station_id","Station ID","required|trim");
                    $this->form_validation->set_rules("company_id","Company ID","required|trim");
                    $this->form_validation->set_rules("name","Station Name","required|trim");
                    $this->form_validation->set_rules("latitude","Station Latitude","required|trim");
                    $this->form_validation->set_rules("longitude","Station Longitude","required|trim");
                   
                    if ($this->form_validation->run() != true){
                        $response["error"][]=array("code"=>REST_Controller::HTTP_NOT_ACCEPTABLE,'message' => validation_errors());
                        $this->response($response, REST_Controller::HTTP_NOT_ACCEPTABLE,$saveRequestToserver_arr); // NOT_FOUND (404) being the HTTP response code   
                        return;
                    }
                    if(empty($stationData=$this->station->checkStationByID($get_request_data["station_id"],true))){
                        $response["error"][]=array("code"=>REST_Controller::HTTP_NOT_ACCEPTABLE,'message' => "Worng Station id pass.");
                        $this->response($response, REST_Controller::HTTP_NOT_ACCEPTABLE,$saveRequestToserver_arr); // NOT_FOUND (404) being the HTTP response code   
                        return;
                    }
                    if(!$this->company->checkCompanyByID($get_request_data["company_id"])){
                        $response["error"][]=array("code"=>REST_Controller::HTTP_NOT_ACCEPTABLE,'message' => "Worng company id pass.");
                        $this->response($response, REST_Controller::HTTP_NOT_ACCEPTABLE,$saveRequestToserver_arr); // NOT_FOUND (404) being the HTTP response code   
                        return;
                    }                    
                    $is_check_name=($stationData->name == $get_request_data["name"])?0:1;   
                    $checkStationName=$this->station->checkStationByName($get_request_data["name"],$get_request_data["company_id"]);
                    if($checkStationName && $is_check_name){
                        $response["error"][]=array("code"=>REST_Controller::HTTP_NOT_ACCEPTABLE,'message' => "this station name already exist.");
                        $this->response($response, REST_Controller::HTTP_NOT_ACCEPTABLE,$saveRequestToserver_arr); // NOT_FOUND (404) being the HTTP response code   
                        return;
                    }
                         $data=array(
                            "company_id"=>$get_request_data["company_id"],
                            "name"=>$get_request_data["name"],
                            "latitude"=>$get_request_data["latitude"],
                            "longitude"=>$get_request_data["longitude"],                           
                            "updated_on"=>time(),
                        );
                           
                             if(!$this->db->update("station",$data,array("id"=>$get_request_data["station_id"]))){
                                $response["error"][]=array("code"=>REST_Controller::HTTP_NOT_ACCEPTABLE,"number"=> $this->db->_error_number(),'message' => $this->db->_error_message());
                                $this->response($response, REST_Controller::HTTP_NOT_ACCEPTABLE,$saveRequestToserver_arr); // NOT_FOUND (404) being the HTTP response code   
                                return;
                            }
                            $response["success"][]=array("msg"=>"Station data successfully updated");
                            $this->response($response, REST_Controller::HTTP_CREATED,$saveRequestToserver_arr);
                            return;
}
public function delete_delete($id=0){
    $is_request=(isset($_REQUEST["save"]))?true:false;
    $notes_arr=array("Note"=>"if you want delete the station so just add end of the url stationID ex: ".base_url()."api/station/delete/sationID.");
    $reqHeaders = $this->input->request_headers(); 
    $set_data=array("Msg"=>"Request Not Requried.");
    $saveRequestToserver_arr=array("project_id"=>CUSTOMER_PROJECT_ID,"method"=>"Station-Delete","method_url"=>"station/delete","method_type"=>"DELETE","is_request"=>$is_request,"request"=>$set_data,"notes"=>$notes_arr);
   if(!is_numeric($id) || !$id ){
        $response["error"][]=array("code"=>REST_Controller::HTTP_NOT_ACCEPTABLE,'message' => "Invalid Station id pass in url.");
        $this->response($response, REST_Controller::HTTP_NOT_ACCEPTABLE,$saveRequestToserver_arr); // NOT_FOUND (404) being the HTTP response code   
        return;
    }
   $checkCompany=$this->station->checkStationByID($id);
   if(!$checkCompany){
        $response["error"][]=array("code"=>REST_Controller::HTTP_NOT_ACCEPTABLE,'message' => "This Station id not register.");
        $this->response($response, REST_Controller::HTTP_NOT_ACCEPTABLE,$saveRequestToserver_arr); // NOT_FOUND (404) being the HTTP response code   
        return;
   }
   $this->db->delete("station",array("id"=>$id));  
    $response["success"]=array("msg"=>"station successfully delete");
    $this->response($response, REST_Controller::HTTP_CREATED,$saveRequestToserver_arr);
    return;
}

}
