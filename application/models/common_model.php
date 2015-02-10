<?php
class Common_model extends CI_Model {
	function __construct() {
		parent::__construct();
	}
	
	function generateSalt($length = 32, $capital = FALSE) {
	    if ($capital) {
	        $str_characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    } else {
	        $str_characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    }
		
		
		$str_rndstring = '';
		for ($i = 0; $i < $length; $i ++) {
			$str_rndstring .= $str_characters[rand(0, strlen($str_characters) - 1)];
		}
		
		return $str_rndstring;
	}
	
	function phoneNo($phone) {
	    $phone = str_replace("(", "", $phone);
	    $phone = str_replace(")", "", $phone);
	    $phone = str_replace(" ", "", $phone);
	    $phone = str_replace("-", "", $phone);
	    
	    if(substr($phone, 0, 1) == '0') {
	        return substr($phone, 1);
	    } else {
	        return $phone;
	    }
	}
	
	function sendSMS($from, $to, $sms_body, $msg_id = '') {
	    if(substr($to, 0, 1) != "+" && strlen($to) != 5) {
	        $to = "+".$to;
	    }
	        
	    $msg_id = ($msg_id == '') ? time() : $msg_id;	    
	    $postUrl = "http://api.infobip.com/api/v3/sendsms/xml";
	    $infobip_username = INFOBIP_USERNAME;
	    $infobip_password = INFOBIP_PASSWORD;
	    
	    $no_of_sms_will_send=ceil(strlen($sms_body)/160);
	    for ($i = 0; $i < $no_of_sms_will_send; $i++) {
	        $sms_part = substr( $sms_body, 0, 160);
	        if (strlen($sms_body) > 160) {
	            $sms_body = substr($sms_body, 160);
	        }
	        
            $xmlString = "
            <SMS>
                <authentification>
                    <username>$infobip_username</username>
                    <password>$infobip_password</password>
                </authentification>
                <message>
                    <sender>$from</sender>
                    <text>$sms_part</text>
                    <flash></flash>
                    <type></type>
                    <wapurl></wapurl>
                    <binary></binary>
                    <datacoding></datacoding>
                    <esmclass></esmclass>
                    <srcton></srcton>
                    <srcnpi></srcnpi>
                    <destton></destton>
                    <destnpi></destnpi>
                    <ValidityPeriod>23:59</ValidityPeriod>
                </message>
                <recipients>
                    <gsm messageId=\"$msg_id\">$to</gsm>
                </recipients>
            </SMS>";
            $fields = "XML=".urlencode($xmlString);
            
            $ch  = curl_init();
            curl_setopt($ch, CURLOPT_URL, $postUrl);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
            curl_setopt($ch, CURLOPT_HEADER, true );
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
            
            $response  = curl_exec($ch);
            curl_close($ch);
	    }
	    return $msg_id;
	}
	
	function print_log($str_log) {
		$fd = fopen('print.log', "a");
		$str = "[" . date('Y-m-d H:i:s', time()) . "] : " . $str_log;
		fwrite($fd, $str . "\n");
		fclose($fd);
	}
	
	function httpPOST( $str_url, $ptr_params ) {
		$ch = curl_init();
		
		$str_params = '';
		if ( $ptr_params != null ) {
			$i = 0;
			foreach ( $ptr_params as $k => $v ) 
			{
				if ( $i == 0 ) 
				{
					$str_params .= $k."=".$v;
				}
				else 
				{
					$str_params .= "&$k=$v";			
				}
				$i ++;
			}
		}
		
		curl_setopt( $ch, CURLOPT_URL, $str_url );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER,true );
		curl_setopt( $ch, CURLOPT_HEADER, false );
		curl_setopt( $ch, CURLOPT_POST, true );
		curl_setopt( $ch, CURLOPT_POSTFIELDS, $str_params );
		
		$str_output = curl_exec($ch);
		
		curl_close($ch);
		
		return $str_output;
	}
	
	function httpGET( $str_url ) {
		$ch = curl_init();
		
		curl_setopt( $ch, CURLOPT_URL, $str_url );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER,true );
		curl_setopt( $ch, CURLOPT_HEADER, false );
		curl_setopt( $ch, CURLOPT_POST, false );
		
		$str_output =curl_exec($ch);
		
		curl_close($ch);
		
		return $str_output;
	}
	
	function writeCSV( $ptr_header, $ptr_data ) 
	{
		$ptr_date = new DateTime();
		$str_scvname = $this->GenerateSalt(3).'_'.$ptr_date->format('YmdHis').'.csv';
		$fp = fopen( ABS_EXPORT_PATH.$str_scvname, 'w');
		
		fputcsv($fp, $ptr_header);
		
		foreach ( $ptr_data as $line ) 
		{
			fputcsv( $fp, $line);
		}
		
		fclose ($fp);
		
		return $str_scvname;
	}
	
	function writeCSVFile( $ptr_header, $ptr_data )
	{
		$ptr_date = new DateTime();
		$str_scvname = $this->GenerateSalt(3).'_'.$ptr_date->format('YmdHis').'.csv';
		$fp = fopen( ABS_EXPORT_PATH.$str_scvname, 'w');

		fputcsv($fp, $ptr_header);
		
		foreach ( $ptr_data as $line ) 
		{
			fputcsv( $fp, $line);
		}
		
		fclose ($fp);
		
		header('Content-Type: application/download');
		header('Content-Disposition: attachment; filename="'. $str_scvname .'"');
		header("Content-Length: " . filesize( ABS_EXPORT_PATH.$str_scvname ));
		
		$fp = fopen( ABS_EXPORT_PATH.$str_scvname, "r");
		fpassthru($fp);
		fclose($fp);
	}
}
