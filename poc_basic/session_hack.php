<?php  
// session_id("fis795n7ce8cvkech1npa80as2");
// session_start();
// echo print_r($_SESSION, true);

define("SESSION_DELIM", "|");

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

$files = scandir(session_save_path());
foreach ($files as $file){
	if(substr($file, 0, 5) == "sess_" && $file != "sess_4rih4e5l9d115jimcil2jj60k71gdndk"){
		$session_id = substr($file, 5);
		$session_file = session_save_path().DIRECTORY_SEPARATOR.$file;
		$session_data = unserialize_php(file_get_contents($session_file), true);
		echo print_r($session_data, true);

	}
}


?>