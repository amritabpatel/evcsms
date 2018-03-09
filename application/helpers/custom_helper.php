<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('inci_json_decode'))
{
    function inci_json_decode($array=array())
    {
         
        return json_decode($array,true);
    }   
}

?>