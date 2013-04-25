  <!-- 
  //TODO ID is url.id
  //TODO check id and incase send error
  //TODO return JSON String
  //TODO check user and incase send error
   -->
  <?php
	                        	/*
	                        		extract to php-function	                        		
	                        	*/
		                        $conn = mysql_connect("localhost", "root", "root");
		
		                        $db_selected = mysql_select_db('seapal', $conn);
		
		                        if (!$db_selected) {
		                            die('Can\'t use foo : ' . mysql_error());
		                        }
		
		                        $sql = "
		                        	SELECT sw.temperatur, 
		                        		sw.airpreasure, 
		                        		windStr.description as wind_strength, 
		                        		windDir.description as wind_direction,	
		                        		sw.wave_height,	                        		 
		                        		waveDir.description as wave_direction, 
		                        		clouds.description as clouds, 
		                        		rain.description as rain 
		                        	FROM seapal_weather as sw LEFT JOIN wind_strength as windStr ON (sw.wind_strength = windStr.id)
		                        							  LEFT JOIN wind_direction as windDir ON (sw.wind_direction = windDir.id)		                        							  	                        							  
		                        							  LEFT JOIN wave_direction as waveDir ON (sw.wave_direction = waveDir.id)		                        							  
		                        							  LEFT JOIN clouds ON (sw.clouds = clouds.id)
		                        							  LEFT JOIN rain ON (sw.rain = rain.id)
		                        ";
		
		                        $result = mysql_query($sql, $conn);
		
		                        if (!$result) {
		                            die('Invalid query: ' . mysql_error());
		                        }
		
		                        while ($row = mysql_fetch_array($result)) {
									
		                        	echo("
		                        		{
		                        			'status':'ok',
		                        			'id':'" . $row['id'] . "',
		                        			'XXXX':'" . $row['temperatur'] . "',
		                        			'airpreasure':'" . $row['airpreasure'] . "'',
		                        			'wind_strength':'" . $row['wind_strength'] . "',
		                        			'wind_direction':'" . $row['wind_direction'] . "'',
		                        			'wave_height':'" . $row['wave_height'] . "',
		                        			'wave_direction':'" . $row['wave_direction'] . "'',
		                        			'clouds':'" . $row['clouds'] . ",
		                        			'rain':'" . $row['rain'] . "',
		                        		}	
		                        	");
		                        }
		
		                        mysql_close($conn);
?>