  <?php
    require_once ('db_configuration.php');
	/*
		extract to php-function	                        		
	*/
	$conn = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PW);
		
	$db_selected = mysql_select_db(MYSQL_DB, $conn);
		
	if (!$db_selected) {
    	die('Can\'t use foo : ' . mysql_error());
	}
	/*
	 * Some SQL-Injektion Protection
	*/
	settype( $_GET["wID"], 'integer');
	$sql = "
		SELECT  sw.id,
        	sw.temperatur, 
			sw.airpreasure, 
			windStr.description as wind_strength, 
			windDesc.description as wind_direction,	
			sw.wave_height,	                        		 
			waveDesc.description as wave_direction, 
			clouds.description as clouds, 
			rain.description as rain,

			windDir.id as windDirId,
			windStr.id as windStrId,
			waveDir.id as waveDirId,
			clouds.id as cloudsId,
			rain.id as rainId,
			trip.titel as trip
		FROM seapal_weather as sw LEFT JOIN wind_strength as windStr ON (sw.wind_strength = windStr.id)
			LEFT JOIN wind_direction as windDir ON (sw.wind_direction = windDir.id)							  	                        							  
			LEFT JOIN wave_direction as waveDir ON (sw.wave_direction = waveDir.id)							  
			LEFT JOIN clouds ON (sw.clouds = clouds.id)
			LEFT JOIN rain ON (sw.rain = rain.id)
            LEFT JOIN direction as windDesc ON (windDesc.id = windDir.direction_id)
            LEFT JOIN direction as waveDesc ON (waveDesc.id = waveDir.direction_id)
            LEFT JOIN tripinfo as trip ON (sw.tnr = trip.tnr)
		WHERE sw.id = " . $_GET["wID"];
		
	$result = mysql_query($sql, $conn);
		
	if (!$result) {
    	die('Invalid query: ' . mysql_error());
	}
		
	while ($row = mysql_fetch_array($result)) {
									
		echo("{
			\"status\":\"ok\",
			\"id\":\"" . $row['id'] . "\",
			\"temperature\":\"" . $row['temperatur'] . "\",
			\"airpreasure\":\"" . $row['airpreasure'] . "\",
			\"wind_strength\":\"" . $row['wind_strength'] . "\",
			\"wind_direction\":\"" . $row['wind_direction'] . "\",
			\"wave_height\":\"" . $row['wave_height'] . "\",
			\"wave_direction\":\"" . $row['wave_direction'] . "\",
			\"clouds\":\"" . $row['clouds'] . "\",
			\"windDirId\":\"" . $row['windDirId'] . "\",
			\"windStrId\":\"" . $row['windStrId'] . "\",
			\"waveDirId\":\"" . $row['waveDirId'] . "\",
			\"cloudsId\":\"" . $row['cloudsId'] . "\",
			\"rainId\":\"" . $row['rainId'] . "\",					
			\"rain\":\"" . $row['rain'] . "\",					
			\"trip\":\"" . $row['trip'] . "\"
		}");
	}
		
	mysql_close($conn);
?>