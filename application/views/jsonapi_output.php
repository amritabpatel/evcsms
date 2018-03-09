<?php
ob_start();
header('Content-Type: application/json;charset=utf-8');
print_r($this->basic_func->isJson(json_encode($api_data)));
exit;

if(!empty($this->basic_func->isJson(json_encode($api_data)))){
echo json_encode($api_data,true);
}  else {
echo "internal error";
}

?>