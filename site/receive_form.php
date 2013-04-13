<?php
include('database_library.php');

$query = "INSERT INTO seapal_main(templeratur, airpreasure, wind_strength, 
          wind_direction, wave_height, wave_direction, clouds, rain) VALUES(";

if (isset($_GET['temp'])) {
    $temperature = $_GET['temp'];
    $query = $query . "'" . $temperature . "'" . ",";
}

if (isset($_GET['airpress'])) {
    $air_pressure = $_GET['airpress'];
    $query = $query . "'" . $air_pressure . "'" . ",";
}

if (isset($_GET['wind_strength'])) {
    $wind_strength = $_GET['wind_strength'];
    $query = $query . "'" . $wind_strength . "'" . ",";
}

if (isset($_GET['wind_direction'])) {
    $wind_direction = $_GET['wind_direction'];
    $query = $query . "'" . $wind_direction . "'" . ",";
}

if (isset($_GET['whight'])) {
    $wave_hight = $_GET['whight'];
    $query = $query . "'" . $wave_hight . "'" . ",";
}

if (isset($_GET['wave_direction'])) {
    $wave_direction = $_GET['wave_direction'];
    $query = $query . "'" . $wave_direction . "'" . ",";
}

if (isset($_GET['clouds'])) {
    $clouds = $_GET['clouds'];
    $query = $query . "'" . $clouds . "'" . ",";
}

if (isset($_GET['rain'])) {
    $rain = $_GET['rain'];
    $query = $query . "'" . $rain . "'";
}

$query = $query . ");";

connect_database("localhost", "root", "root", "seapal");
mysql_query($query);
mysql_close();
?>
