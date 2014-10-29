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
