<?php 

function sendsms($mobileno,$message,$return = '0'){
        
        $sender = 'EUGOCab';

        $smsGatewayUrl = 'http://control.msg91.com';

        $apikey = '162937A2lhS8P42gY759528d0b'; 

        $textmessage = urlencode($message);

        $api_element = '/api/web/send/';

        $api_params = $api_element.'?apikey='.$apikey.'&sender='.$sender.'&to='.$mobileno.'&message='.$textmessage;
        $smsgatewaydata = $smsGatewayUrl.$api_params;

        $url = $smsgatewaydata;

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_POST, false);

        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($ch);

        curl_close($ch);

        if(!$output){ $output = file_get_contents($smsgatewaydata); }

        if($return == '1'){ return $output; }else{ echo "sent"; }
    }
?>