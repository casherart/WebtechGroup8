

<?php

/* NOT WORKING !!



error_display(1);
display_errors = On;
error_reporting = E_ALL & ~E_NOTICE;
php_flag  display_errors        on;
php_value error_reporting       2039;
function checkNumber($valueName, $type = int) {
	
	$_POST[$valueName] = makeNum(trim($_POST[$valueName]));
	
	
	if($_POST[$valueName] == ""){
		return RETURN_FALSE;
	}
	
	if(is_numeric($_POST[$valueName]) == FALSE){
		return RETURN_FALSE;
	}
	if($type == "float"){
		if(is_float(floatval($_POST[$valueName])) == FALSE){
			return RETURN_FALSE;
		}
	}else{
		if(is_int(intval($_POST[$valueName])) == FALSE){
			return RETURN_FALSE;
		}
	
	}
	
	RETURN_TRUE;
}

function makeNum($value) { 
     return preg_replace('#^([-]*[0-9\.,\' ]+?)((\.|,){1}([0-9-]{1,2}))*$#e', "str_replace(array('.', ',', \"'\", ' '), '', '\\1') . '.\\4'", $value); 
} 


$ok = true;
$intArray = array(0 => "wind_strength", 1 => "clouds", 2 => "rain", 3 => "wind_direction", 4 => "wave_direction");
$floatArray = array(0 => "temp", 1 => "airpress", 2 => "whight");

print_r($intArray);
print_r($floatArray);

if($_SERVER[REQUEST_METHOD] == "POST"){
	for ($i=0; $i<count($intArray); $i++){		
		if(checkNumber($intArray[$i]) == false){
			$ok = false;
		}
	}
	
	
	for ($i=0; $i<count($floatArray); $i++){		
		if(checkNumber($floatArray[$i], "float") == false){
			$ok = false;
		}
	}
	if($ok == TRUE){
		$con = mysql_connect($host, $username, $password) or die("Connection Error: " . mysql_error());
		mysql_select_db($database_name, $con);
    	$result = mysql_query("
    		INSERT INTO seapal_main ('templeratur', 'airpreasure', 'wind_strength', 'wind_direction', 'wave_height', 'wave_direction', 'clouds', 'rain')
    		VALUES (
    			Val($_POST[temp]),
    			Val($_POST[airpress]),
    			Val($_POST[wind_strength]),
    			Val($_POST[wind_direction]),
    			Val($_POST[whight]),
    			Val($_POST[wave_direction]),
    			Val($_POST[clouds]),
    			Val($_POST[rain])
    		)
    	");
    	if (!mysql_query($sql,$con)){
 			die('Error: ' . mysql_error());
 		}
		echo "1 record added“;
		mysql_close($con);
	}else{
		echo "Wrong input error";
	}
	
}else{	

}

*/
?>