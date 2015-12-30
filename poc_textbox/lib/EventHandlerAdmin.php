<?php 

/*
	authenticate admin
*/

if(isset($_POST['request'])){
	$sessionId = $_POST['sessionId'];
	$request   = $_POST['request'];
}
else{
	$session_file = session_save_path().DIRECTORY_SEPARATOR."sess_".$_POST['sessionId'];
	$session_data = unserialize_php(){

	}	
	header('Content-Type: text/event-stream');
	header('Cache-Control: no-cache');

	//send request to browser
	echo "data: ".json_encode($data)." \n\n";
}

function unserialize_php($session_data) {
    $return_data = array();
    $offset = 0;
    while ($offset < strlen($session_data)) {
        if (!strstr(substr($session_data, $offset), "|")) {
            throw new Exception("invalid data, remaining: " . substr($session_data, $offset));
        }
        $pos = strpos($session_data, "|", $offset);
        $num = $pos - $offset;
        $varname = substr($session_data, $offset, $num);
        $offset += $num + 1;
        $data = unserialize(substr($session_data, $offset));
        $return_data[$varname] = $data;
        $offset += strlen(serialize($data));
    }
    return $return_data;
}


?>