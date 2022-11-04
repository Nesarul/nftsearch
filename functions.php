<?php
// Function to get the client IP address
    function get_client_ip() {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }
    
//JSON Records

function fileWriteAppend(){
		$current_data = file_get_contents('ipRecords.json');
		$array_data = json_decode($current_data, true);
		$extra = array(
			 'ip'               =>     get_client_ip(),
			 'date'             =>     date("Y-m-d h:i:s"),
			 'count'            =>     20,
		);
		$array_data[] = $extra;
		$final_data = json_encode($array_data);
		return $final_data;
}
function fileCreateWrite(){
    $file=fopen("ipRecords.json","w");
    $array_data=array();
    $extra = array(
        'ip'               =>     get_client_ip(),
        'date'             =>     date("Y-m-d h:i:s"),
        'count'            =>     20,
    );
    $array_data[] = $extra;
    $final_data = json_encode($array_data);
    fclose($file);
    return $final_data;
}