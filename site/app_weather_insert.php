<?php 
include('./database_library.php');
require_once ('db_configuration.php');

/*
 * Some SQL-Injektion Protection
*/
settype( $_GET["wId"], 'integer');
settype( $_GET["bnr"], 'integer');
settype( $_GET["wind_strength"], 'integer');
settype( $_GET["wind_direction"], 'integer');
settype( $_GET["wave_direction"], 'integer');
settype( $_GET["clouds"], 'integer');
settype( $_GET["rain"], 'integer');
settype( $_GET["temp"], 'integer');
settype( $_GET["airpress"], 'integer');
settype( $_GET["whight"], 'integer');
settype( $_GET["trip"], 'integer');


if($_GET["wId"] != ""){
	$query = "UPDATE seapal_weather SET";	
	$query .= " temperatur = " . $_GET["temp"];
	$query .= ", airpreasure = " . $_GET["airpress"];
	$query .= ", wind_strength = " . $_GET["wind_strength"];
	$query .= ", wind_direction = " . $_GET["wind_direction"];
	$query .= ", wave_height = " . $_GET["whight"];
	$query .= ", wave_direction = " . $_GET["wave_direction"];
	$query .= ", clouds = " . $_GET["clouds"];
	$query .= ", rain = " . $_GET["rain"];
	$query .= " WHERE ID = " . $_GET["wId"] . " AND (bnr = 1 OR bnr = 2);";
}else{	
	$query = "INSERT INTO seapal_weather(temperatur, airpreasure, wind_strength, 
	          wind_direction, wave_height, wave_direction, clouds, rain, tnr, bnr) VALUES(";
	
	$query = build_form_query("temp", $query);
	$query = build_form_query("airpress", $query);
	$query = build_form_query("wind_strength", $query);
	$query = build_form_query("wind_direction", $query);
	$query = build_form_query("whight", $query);
	$query = build_form_query("wave_direction", $query);
	$query = build_form_query("clouds", $query);
	$query = build_form_query("rain", $query);
	$query = build_form_query("trip", $query, true);
	$query .= ",1);";
}

connect_database(MYSQL_HOST, MYSQL_USER, MYSQL_PW, MYSQL_DB);
mysql_query($query);
if($_GET["wId"] != ""){
	$lastid = $_GET["wId"];
}else{
	$lastid = mysql_insert_id();
}
if ($lastid == 0 || mysql_error() != "") {
	echo("{\"status\":\"ERROR\",\"text\":\"".mysql_error()."\"}");
}else{
	echo("{\"status\":\"ok\",\"id\":\"".$lastid."\"}");
}


mysql_close();
?>