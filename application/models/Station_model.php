<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
        


class Station_model extends CI_Model
{
    public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper('cookie');
		$this->load->helper('date');
		$this->load->helper('url');
	}
public function checkStationByID($company_id=0,$is_fulldata=false){          
            
            $this->db->where("id", $company_id);
            $query=$this->db->get("station");
            if($query->num_rows()){
                if($is_fulldata){
                    return $query->row();   
                }else{
                return true;
                }
            }else{
                return false;
            }
           
}
public function checkStationByName($station_name="",$company_id=0){
          
            
    $this->db->where("company_id", $company_id);            
    $this->db->where("name", $station_name);
    $query=$this->db->get("station");
    if($query->num_rows()){
        return true;
    }else{
        return false;
    }

}
     
}