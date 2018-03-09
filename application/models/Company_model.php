<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
        


class Company_model extends CI_Model
{
    public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper('cookie');
		$this->load->helper('date');
		$this->load->helper('url');
	}
            public function checkCompanyByID($company_id=0, $is_full_data=false){          
            
            $this->db->where("id", $company_id);
            $query=$this->db->get("company");
            if($query->num_rows()){
                if($is_full_data){
                    return $query->row();   
                }else{
                    return true;
                }                
            }else{
                return false;
            }
           
        }
        public function checkCompanyByName($company_name="", $parent_id = 0){
          
            if($parent_id){
                $this->db->where("parent_id", $parent_id);
            }           
            $this->db->where("name", $company_name);           
            $query=$this->db->get("company");
            if($query->num_rows()){
                return true;
            }else{
                return false;
            }
           
        }
       
}