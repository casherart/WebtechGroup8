<?php
include('database_library.php');
?>

<!DOCTYPE html>
<html lang="de">
    <head>
        <!-- Headerinformation -->
        <?php include("./_include/header.php") ?>  
        
	    <!-- Additional Java-Script -->
	    <script src="../js/app/ajax/weather.js" type="text/javascript"></script>      
	    
	    <!-- when doc ready start loading weatherdatatable content -->
		<script>
			$(document).ready(function() {//
				<?php
					$conn = mysql_connect("localhost", "root", "root");
					$db_selected = mysql_select_db('seapal', $conn);
		
		        	if (!$db_selected) {
		        		die('Can\'t use foo : ' . mysql_error());
		        	}
		
		        	$sql = "SELECT id FROM seapal_weather WHERE bnr = 1 OR bnr = 2";/*TODO USER*/
					$result = mysql_query($sql, $conn);
		
		            if (!$result) {
		            	die('Invalid query: ' . mysql_error());
		            }
		
		            while ($row = mysql_fetch_array($result)) {		
		            	echo("addWeatherToTable(" . $row['id'] . ");");
		            }
	 			?>
			});
		</script>

    </head>
    <body>

        <!-- Navigation -->
        <?php include("./_include/navigation.php") ?>
        <!-- Container -->
        <div class="container-fluid">

            <!-- App Navigation -->
            <?php include('_include/navigation_app.php'); ?>

            <!-- Content -->
            <div id="appWrapper" align="center">
                <div class="align-center">
                    <br>
                    <h2>Wetter Informationen</h2>
                    <br>
                </div>
                 <!--  -->
                 <form id="appForm" class="form-horizontal" action="app_weather_insert.php"><!--onsubmit="return handleWeatherForm(this);"-->
                    <div class="container-fluid">
                        <div class="row well" style="margin-left: 15%;">
                            <div class="span4">
                                <div class="control-group">
                                    <label class="control-label padding-right10">Temperature</label> 								 
                                    <div class="input-append">
                                        <input class="input-medium" type="text" id="temp" name="temp" /> 
                                        <span title="C°" style="cursor: pointer" class="add-on">C°</span>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label padding-right10">Air Pressure</label>  
                                    <div class="input-append">
                                        <input class="input-medium" type="text" id="airpress" name="airpress" /> 
                                        <span title="Pa" style="cursor: pointer" class="add-on">Pa</span>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label padding-right10">Wind Strength</label> 
                                    <div class="input-append">
                                        <select	name="wind_strength" id="windstr" class="select-medium">
                                            <?php
                                            get_select_options("localhost", "root", "root", "seapal", "SELECT id, description FROM wind_strength ORDER BY id asc;");
                                            ?>
                                        </select> 
                                        <span title="Beaufort Scale" style="cursor: pointer;" class="add-on">bft</span>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label padding-right10">Wave Hight</label> 
                                    <div class="input-append">
                                        <input class="input-medium" type="text" id="whight" name="whight"/> 
                                        <span title="meter" style="cursor: pointer" class="add-on">m</span>
                                    </div>
                                </div>

                            </div>
                            <div class="span4">
                                <div class="control-group">

                                    <div class="control-group">
                                        <label class="control-label padding-right10">Clouds</label> 
                                        <div class="input-append">
                                            <select name="clouds" id="cloud" class="select-medium">
                                                <?php
                                                get_select_options("localhost", "root", "root", "seapal", "SELECT id, description FROM clouds ORDER BY id asc;");
                                                ?>
                                            </select> 
                                            <span title="Octa" style="cursor: pointer" class="add-on">Octa</span>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label padding-right10">Rain</label> 
                                        <select name="rain" id="rain" class="select-medium">
                                            <?php
                                            get_select_options("localhost", "root", "root", "seapal", "SELECT id, description FROM rain ORDER BY id asc;");
                                            ?>
                                        </select>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label padding-right10">Wind Direction</label> 
                                        <select name="wind_direction" id="winddir" class="select-medium">
                                            <?php
                                            get_select_options("localhost", "root", "root", "seapal", "SELECT wd.id as id, d.description as description FROM wind_direction as wd left join direction as d on wd.direction_id = d.id ORDER BY id asc;");
                                            ?>
                                        </select>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label padding-right10">Wave Direction</label> 
                                        <select name="wave_direction" id="wavedir" class="select-medium">
                                            <?php
                                            get_select_options("localhost", "root", "root", "seapal", "SELECT wd.id as id, d.description as description FROM wave_direction as wd left join direction as d on wd.direction_id = d.id ORDER BY id asc;");
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="control-group">
                            <input type="reset" class="btn" id="delete" value="L&ouml;schen" class="button"/>
                            <input type="submit" class="btn" id="save" name="submit" value="Speichern" class="button"/>
                        </div>
                    </div>
                </form>
            </div>
            <div class="appTableDiv" align="center">
	                <table class="appTable table table-hover" cellspacing="0px" cellpadding="5px">
	                    <thead>
	                        <tr>
	                            <th>Temperature</th>
	                            <th>Air Pressure</th>
	                            <th>Wind Strength</th>
	                            <th>Wind Direction</th>
	                            <th>Wave Hight</th>
	                            <th>Wave Direction</th>
	                            <th>Clouds</th>
	                            <th>Rain</th>
	                            <th></th>
	                        </tr>
	                    </thead>
		                <tbody id="weather_entries">
	                    </tbody>
	                </table>
	                <br /><br />
	            </div>
        </div>

        <!-- Footer -->
        <?php /* include("./_include/footer.php") */?>
    </body>
</html>
