<?php 
include('/_include/header.php');
include('./database_library.php');

$query = "INSERT INTO seapal_weather(bnr, temperatur, airpreasure, wind_strength, 
          wind_direction, wave_height, wave_direction, clouds, rain) VALUES(";

$query .= build_form_query("bnr", "'". 1 ."', ");
$query = build_form_query("temp", $query);
$query = build_form_query("airpress", $query);
$query = build_form_query("wind_strength", $query);
$query = build_form_query("wind_direction", $query);
$query = build_form_query("whight", $query);
$query = build_form_query("wave_direction", $query);
$query = build_form_query("clouds", $query);
$query = build_form_query("rain", $query, true);
$query .= ");";

connect_database("localhost", "root", "root", "seapal");
mysql_query($query);
mysql_close();

?>
{"status":"ok", "weather_id":"1"}