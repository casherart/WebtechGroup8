<?php
include('/header.php');
include('/database_library.php');

$query = "INSERT INTO seapal_weather(templeratur, airpreasure, wind_strength, 
          wind_direction, wave_height, wave_direction, clouds, rain) VALUES(";

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
<div class="container-fluid">
    <div class="span6 offset3">
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Success!</strong> Your Formular was submitted to the database.
        </div>
        <div class="clearfix"></div>
        <div class="align-center">
            <a href="app_weather.php"><button type="" class="btn">Back to Seapal</button></a>
        </div>
    </div>
</div>
