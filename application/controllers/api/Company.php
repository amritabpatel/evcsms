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
class Company extends REST_Controller {
    

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
public function get_get($parent_id=0){
    $is_request=(isset($_REQUEST["save"]))?true:false;
    $notes_arr=array("Note"=>"if you want get the list of child company so just add end of the url companyparentID ex: example.com/company/get/companyID.");
    $reqHeaders = $this->input->request_headers();
    $set_data=array("Note"=> "Request Not Requried.");
    $saveRequestToserver_arr=array("project_id"=>CUSTOMER_PROJECT_ID,"method"=>"Company-get","method_url"=>"company/get","method_type"=>"GET","is_request"=>$is_request,"request"=>$set_data,"notes"=>$notes_arr);
    if($parent_id){
                    if(!$this->company->checkCompanyByID($parent_id)){
                        $response["error"][]=array("code"=>REST_Controller::HTTP_FORBIDDEN,'message' => "Worng Parent id pass.");
                        $this->response($response, REST_Controller::HTTP_FORBIDDEN,$saveRequestToserver_arr); // NOT_FOUND (404) being the HTTP response code   
                        return;
                    }
                    }
    
    if($parent_id){
       $this->db->where("parent_id", $parent_id);
   }else{
         $this->db->where("parent_id", 0);
   }   
   $query=$this->db->get("company");
   $result =$query->result();
   
    $response["success"]=$result;
    $this->response($response, REST_Controller::HTTP_CREATED,$saveRequestToserver_arr);
    return;
}
public function add_post(){
    $is_request=(isset($_REQUEST["save"]))?true:false;
    $notes_arr=array("parent_id"=>"if parent company add then not send the `parent_id` in request.");
    $reqHeaders = $this->input->request_headers();   
    $set_data=$this->post();
    $saveRequestToserver_arr=array("project_id"=>CUSTOMER_PROJECT_ID,"method"=>"Company-add","method_url"=>"company/add","method_type"=>"POST","is_request"=>$is_request,"request"=>$set_data,"notes"=>$notes_arr);
    if(!isset($reqHeaders["Content-Type"],$set_data["data"]) && strtolower($reqHeaders["Content-Type"]) != "application/json; charset=utf-8"){
                        $response["error"][]=array("code"=>REST_Controller::HTTP_BAD_REQUEST,'message' => "In header `Content-Type: application/json; charset=utf-8` Not set. OR Data object Not set in request.");
                        $this->response($response, REST_Controller::HTTP_BAD_REQUEST,$saveRequestToserver_arr); // NOT_FOUND (404) being the HTTP response code
                        return;
    }
                    $get_request_data=$set_data["data"][0];
                    $this->form_validation->set_data($get_request_data);
                    $this->form_validation->set_error_delimiters('', '');
                    $this->form_validation->set_rules("name","Company Name","required|trim");
                   
                    if ($this->form_validation->run() != true){
                        $response["error"][]=array("code"=>REST_Controller::HTTP_NOT_ACCEPTABLE,'message' => validation_errors());
                        $this->response($response, REST_Controller::HTTP_NOT_ACCEPTABLE,$saveRequestToserver_arr); // NOT_FOUND (404) being the HTTP response code   
                        return;
                    }
                    $parent_id=(isset($get_request_data["parent_id"]))?$get_request_data["parent_id"]:0;
                    if($parent_id){
                    if(!$this->company->checkCompanyByID($parent_id)){
                        $response["error"][]=array("code"=>REST_Controller::HTTP_FORBIDDEN,'message' => "Worng Parent id pass.");
                        $this->response($response, REST_Controller::HTTP_FORBIDDEN,$saveRequestToserver_arr); // NOT_FOUND (404) being the HTTP response code   
                        return;
                    }
                    }
                    $checkCompanyName=$this->company->checkCompanyByName($get_request_data["name"],$parent_id);
                    if($checkCompanyName){
                        $response["error"][]=array("code"=>REST_Controller::HTTP_BAD_REQUEST,'message' => "this company name already exist.");
                        $this->response($response, REST_Controller::HTTP_BAD_REQUEST,$saveRequestToserver_arr); // NOT_FOUND (404) being the HTTP response code   
                        return;
                    }
                        $data=array(
                            "name"=>$get_request_data["name"],
                            "parent_id"=>$parent_id,
                            "created_on"=>time(),
                        );
                            $this->db->insert("company",$data);
                            $response["success"][]=array("msg"=>"Company successfully inserted");
                            $this->response($response, REST_Controller::HTTP_CREATED,$saveRequestToserver_arr);
                            return;
}
public function edit_put(){
    $is_request=(isset($_REQUEST["save"]))?true:false;
    $notes_arr=array();
    $reqHeaders = $this->input->request_headers();   
    $set_data=$this->put();
    $saveRequestToserver_arr=array("project_id"=>CUSTOMER_PROJECT_ID,"method"=>"Company-edit","method_url"=>"company/edit","method_type"=>"PUT","is_request"=>$is_request,"request"=>$set_data,"notes"=>$notes_arr);
    if(!isset($reqHeaders["Content-Type"],$set_data["data"]) && strtolower($reqHeaders["Content-Type"]) != "application/json; charset=utf-8"){
        $response["error"][]=array("code"=>REST_Controller::HTTP_BAD_REQUEST,'message' => "In header `Content-Type: application/json; charset=utf-8` Not set. OR Data object Not set in request.");
        $this->response($response, REST_Controller::HTTP_BAD_REQUEST,$saveRequestToserver_arr); // NOT_FOUND (404) being the HTTP response code
        return;
    }
                    $get_request_data=$set_data["data"][0];
                    $this->form_validation->set_data($get_request_data);
                    $this->form_validation->set_error_delimiters('', '');
                    $this->form_validation->set_rules("company_id","Company ID","required|trim");
                    $this->form_validation->set_rules("name","Company Name","required|trim");
                   
                    if ($this->form_validation->run() != true){
                        $response["error"][]=array("code"=>REST_Controller::HTTP_NOT_ACCEPTABLE,'message' => validation_errors());
                        $this->response($response, REST_Controller::HTTP_NOT_ACCEPTABLE,$saveRequestToserver_arr); // NOT_FOUND (404) being the HTTP response code   
                        return;
                    }
                    if(empty($companyData=$this->company->checkCompanyByID($get_request_data["company_id"],true))){
                        $response["error"][]=array("code"=>REST_Controller::HTTP_BAD_REQUEST,'message' => "Worng company id pass.");
                        $this->response($response, REST_Controller::HTTP_BAD_REQUEST,$saveRequestToserver_arr); // NOT_FOUND (404) being the HTTP response code   
                        return;
                    }                                      
                    $is_check_name=($companyData->name == $get_request_data["name"])?0:1;   
                    if($parent_id){
                    if(!$this->company->checkCompanyByID($parent_id)){
                        $response["error"][]=array("code"=>REST_Controller::HTTP_FORBIDDEN,'message' => "Worng Parent id pass.");
                        $this->response($response, REST_Controller::HTTP_FORBIDDEN,$saveRequestToserver_arr); // NOT_FOUND (404) being the HTTP response code   
                        return;
                    }
                    }
                    $parent_id=(isset($get_request_data["parent_id"]))?$get_request_data["parent_id"]:0;  
                    
                    $checkCompanyName=$this->company->checkCompanyByName($get_request_data["name"],$parent_id);                
                    if($checkCompanyName && $is_check_name){
                        $response["error"][]=array("code"=>REST_Controller::HTTP_METHOD_NOT_ALLOWED,'message' => "this company name already exist.");
                        $this->response($response, REST_Controller::HTTP_METHOD_NOT_ALLOWED,$saveRequestToserver_arr); // NOT_FOUND (404) being the HTTP response code   
                        return;
                    }                   
                        $data=array(
                            "name"=>$get_request_data["name"],
                            "parent_id"=>$parent_id,
                            "updated_on"=>time(),
                        );
                            $this->db->update("company",$data,array("id"=>$get_request_data["company_id"]));
                            $response["success"][]=array("msg"=>"Company data successfully updated");
                            $this->response($response, REST_Controller::HTTP_CREATED,$saveRequestToserver_arr);
                            return;
}
public function delete_delete($id=0){
    $is_request=(isset($_REQUEST["save"]))?true:false;
    $notes_arr=array("Note"=>"if you want delete the company so just add end of the url companyparentID ex: ".base_url()."api/company/delete/companyID.");
    $reqHeaders = $this->input->request_headers(); 
    $set_data=array("Msg"=>"Request Not Requried.");
    $saveRequestToserver_arr=array("project_id"=>CUSTOMER_PROJECT_ID,"method"=>"Company-Delete","method_url"=>"company/delete","method_type"=>"DELETE","is_request"=>$is_request,"request"=>$set_data,"notes"=>$notes_arr);
   if(!is_numeric($id) || !$id ){
        $response["error"][]=array("code"=>REST_Controller::HTTP_NOT_ACCEPTABLE,'message' => "Invalid Company id pass in url.");
        $this->response($response, REST_Controller::HTTP_NOT_ACCEPTABLE,$saveRequestToserver_arr); // NOT_FOUND (404) being the HTTP response code   
        return;
    }
   $checkCompany=$this->company->checkCompanyByID($id);
   if(!$checkCompany){
        $response["error"][]=array("code"=>REST_Controller::HTTP_BAD_REQUEST,'message' => "This Company id not register.");
        $this->response($response, REST_Controller::HTTP_BAD_REQUEST,$saveRequestToserver_arr); // NOT_FOUND (404) being the HTTP response code   
        return;
   }
   $this->db->delete("station",array("company_id"=>$id));
   $this->db->delete("company",array("id"=>$id));
   $this->db->update("company",array("parent_id"=>0),array("parent_id"=>$id));   
    $response["success"]=array("msg"=>"compnay successfully delete");
    $this->response($response, REST_Controller::HTTP_CREATED,$saveRequestToserver_arr);
    return;
}

}
