<?php
	include('database_library.php');
    require_once ('db_configuration.php');
?>

	<div class="control-group">
	<select name="trip_log" id="trip_log" class="select-long">
    	<?php
        	get_select_options(MYSQL_HOST, MYSQL_USER, MYSQL_PW, MYSQL_DB, "SELECT tnr as id, titel as description FROM tripinfo ORDER BY tnr asc;");
        ?>
	</select>
	<div id="logTimer"></div>
	</div>
	<div class="control-group">
    	<input type="reset" class="btn" id="closeWeatherLog" value="Close" class="button" onclick="closeWeatherLog()"/>
        <input type="submit" class="btn" id="startStopWeatherLog" name="submit" value="Start Logging" class="button" onclick="startWeatherlogging();"/>
    </div>