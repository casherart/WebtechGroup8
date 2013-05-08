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
		DELETE FROM seapal_weather
		WHERE id = " . $_GET["wID"];
		
	mysql_query($sql);
		
	if (mysql_error() != "") {
		echo("{\"status\":\"ERROR\",\"text\":\"".mysql_error()."\"}");
	}else{
		echo("{\"status\":\"ok\"}");
	}
		
	mysql_close($conn);
?>