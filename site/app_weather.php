<?php
require_once ('db_configuration.php');
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
					$conn = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PW);
					$db_selected = mysql_select_db(MYSQL_DB, $conn);
		
		        	if (!$db_selected) {
		        		die('Can\'t use foo : ' . mysql_error());
		        	}
		
		        	$sql = "SELECT id FROM seapal_weather WHERE bnr = 1 OR bnr = 2 order by id";/*TODO USER*/
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
                 <form id="appForm" class="form-horizontal" onsubmit="if(validate_handleWeatherForm( $(this).serialize()) ){	handleWeatherForm($(this).serialize());	return false;}else{	showAlert('Fehlerhafte Eingabe','Das Formular ist fehlerhaft. Überprüfen Sie bitte Ihre Eingabe.');	return false;}">
                 	<input type="hidden" id="wId" name="wId" value="">
                    <div class="container-fluid">
                    	<div class="row well" style="margin-left: 15%; height: 30px;">
                            <div class="span4">
                                <div class="control-group">
                                	<label class="control-label padding-right10">Reise</label> 
                                    <select name="trip" id="trip" class="select-long">
                                    	<?php
                                            get_select_options(MYSQL_HOST, MYSQL_USER, MYSQL_PW, MYSQL_DB, "SELECT tnr as id, titel as description FROM tripinfo ORDER BY tnr asc;");
                                        ?>
                                    </select>
                                </div>
                        	</div>                        	
                        </div>
                        <div class="row well" style="margin-left: 15%;">
                            <div class="span4">
                                <div class="control-group">
                                    <label class="control-label padding-right10">Temperatur</label> 								 
                                    <div class="input-append">
                                        <input class="input-medium" type="text" id="temp" name="temp" /> 
                                        <span title="Celsius" style="cursor: pointer" class="add-on">C°</span>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label padding-right10">Luftdruck</label>  
                                    <div class="input-append">
                                        <input class="input-medium" type="text" id="airpress" name="airpress" /> 
                                        <span title="Pascal" style="cursor: pointer" class="add-on">hPa</span>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label padding-right10">Windstärke</label> 
                                    <div class="input-append">
                                        <select	name="wind_strength" id="windstr" class="select-medium">
                                            <?php
                                            get_select_options(MYSQL_HOST, MYSQL_USER, MYSQL_PW, MYSQL_DB, "SELECT id, description FROM wind_strength ORDER BY id asc;");
                                            ?>
                                        </select> 
                                        <span title="Beaufort Scale" style="cursor: pointer;" class="add-on">bft</span>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label padding-right10">Wellenh&ouml;he</label> 
                                    <div class="input-append">
                                        <input class="input-medium" type="text" id="whight" name="whight"/> 
                                        <span title="Meter" style="cursor: pointer" class="add-on">m</span>
                                    </div>
                                </div>

                            </div>
                            <div class="span4">
                                <div class="control-group">

                                    <div class="control-group">
                                        <label class="control-label padding-right10">Bew&ouml;lkung</label> 
                                        <div class="input-append">
                                            <select name="clouds" id="cloud" class="select-medium">
                                                <?php
                                                get_select_options(MYSQL_HOST, MYSQL_USER, MYSQL_PW, MYSQL_DB, "SELECT id, description FROM clouds ORDER BY id asc;");
                                                ?>
                                            </select> 
                                            <span title="Octa" style="cursor: pointer" class="add-on">Octa</span>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label padding-right10">Regen</label> 
                                        <select name="rain" id="rain" class="select-medium">
                                            <?php
                                            get_select_options(MYSQL_HOST, MYSQL_USER, MYSQL_PW, MYSQL_DB, "SELECT id, description FROM rain ORDER BY id asc;");
                                            ?>
                                        </select>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label padding-right10">Windrichtung</label> 
                                        <select name="wind_direction" id="winddir" class="select-medium">
                                            <?php
                                            get_select_options(MYSQL_HOST, MYSQL_USER, MYSQL_PW, MYSQL_DB, "SELECT wd.id as id, d.description as description FROM wind_direction as wd left join direction as d on wd.direction_id = d.id ORDER BY id asc;");
                                            ?>
                                        </select>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label padding-right10">Wellenrichtung</label> 
                                        <select name="wave_direction" id="wavedir" class="select-medium">
                                            <?php
                                            get_select_options(MYSQL_HOST, MYSQL_USER, MYSQL_PW, MYSQL_DB, "SELECT wd.id as id, d.description as description FROM wave_direction as wd left join direction as d on wd.direction_id = d.id ORDER BY id asc;");
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="control-group">
                            <input type="reset" class="btn" id="delete" value="Zur&uuml;cksetzen" class="button"/>
                            <input type="submit" class="btn" id="save" name="submit" value="Speichern" class="button"/>
                        </div>
                    </div>
                </form>
            </div>
            <div class="appTableDiv" align="center">
	                <table class="appTable table table-hover" cellspacing="0px" cellpadding="5px">
	                    <thead>
	                        <tr>
	                            <th>Reise</th>
	                            <th>Temperatur</th>
	                            <th>Luftdruck</th>
	                            <th>Windst&auml;rke</th>
	                            <th>Windrichtung</th>
	                            <th>Wellenh&ouml;he</th>
	                            <th>Wellenrichtung</th>
	                            <th>Bew&ouml;lkung</th>
	                            <th>Regen</th>
	                            <th></th>
	                        </tr>
	                    </thead>
		                <tbody id="weather_entries">
	                    </tbody>
	                </table>
	                <br /><br />
	            </div>
        </div>
        
		<!-- Menu Modal -->
		<div class="modal hide fade" id="messageBox">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 id="dialogTitle"></h3>
			</div>
			<div class="modal-body">
				<p id="dialogMessage"></p>
			</div>
			<div class="modal-footer">
				<a href="#" class="btn" data-dismiss="modal"><i class="icon-ok"></i> ok</a>
			</div>
		</div>
                
        <!-- Footer -->
        <?php /* include("./_include/footer.php") */?><!-- Java-Script -->
	    <script src="../js/bootstrap/bootstrap-modal.js"></script>
    </body>
</html>
