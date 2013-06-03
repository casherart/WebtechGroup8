<?php $filename = str_replace(".php", "", basename($_SERVER["SCRIPT_NAME"])); ?>

<!-- App Navigation -->
<div class="navbar">
	<div class="navbar-inner">
		<div class="container">		
			<ul class="nav">
				<li <?php if ($filename == "app_map") echo("class='active'"); ?>><a href="/site/app_map.php">Map</a></li>
				<li <?php if ($filename == "app_boatinfo") echo("class='active'"); ?>><a href="/site/app_boatinfo.php">Logbuch</a></li>
				<li <?php if ($filename == "app_trip" || $filename == "app_tripinfo") echo("class='active'"); ?>><a href="/site/app_trip.php">Routen</a></li>
                                <li <?php if ($filename == "app_weather") echo("class='active'"); ?>><a href='/site/app_weather.php'>Wetter</a></li>
			</ul>
			<ul class="navbar-form pull-right" style="list-style-type: none;">
				<li><a class="btn" id="startSimulation" title="start Simulation"><i class="icon-play"></i></a><li>
			</ul>
			<ul class="navbar-form pull-right" style="list-style-type: none;">
				<li><a class="btn" id="showWeatherWarning" title="show Weather Warning" onclick="openWeatherWarnings();"><i class="icon-warning-sign"></i></a><li>
			</ul>
			<ul class="navbar-form pull-right" style="list-style-type: none;">
				<li><a class="btn" id="startLog" title="start weather log" onclick="openWeatherLogWindow();"><i class="icon-pencil"></i></a><li>
			</ul>
		</div>
	</div>
</div>
