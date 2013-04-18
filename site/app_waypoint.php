<?php
include('database_library.php');
?>

<!DOCTYPE html>
<html lang="de">
    <head>
        <!-- Headerinformation -->
        <?php include("header.php") ?>        
    </head>
    <body>

        <!-- Navigation -->
        <?php include("navigation.php") ?>
        <!-- Container -->
        <div class="container-fluid">

            <!-- Content -->
            <div id="appWrapper">
                <div class="align-center">
                    <br>
                    <h2>LogBook</h2>
                    <br>
                </div>
                <form id="appForm" class="form-horizontal" onsubmit="return false;">
                    <div class="container-fluid">
                        <div class="row well" style="margin-left: 15%;">
                            <div class="">
                                <br />
                                <h4>Wegpunkt</h4>
                                <br />
                            </div>
                            <div class="span4">
                                <div class="control-group">
                                    <label class="control-label padding-right10">Name</label> 
                                    <input class="input-medium" type="text" id="name" />
                                </div>
                                <div class="control-group">
                                    <label class="control-label padding-right10">Time</label> 
                                    <input class="input-medium" type="time" id="wdate" />
                                </div>
                                <div class="control-group">
                                    <label class="control-label padding-right10">Date</label> 
                                    <input class="input-medium" type="date" id="wtime" />
                                </div>
                            </div>
                            <div class="span4">
                                <div class="control-group">
                                    <label class="control-label padding-right10">Latitude</label> 
                                    <input class="input-medium" type="text" id="lat" />
                                </div>
                                <div class="control-group">
                                    <label class="control-label padding-right10">Longitude</label> 
                                    <input class="input-medium" type="text" id="lng" />
                                </div>
                                <div class="control-group">
                                    <label class="control-label padding-right10">Fahrt nach</label> 
                                    <select name="fahrtziel" id="marker" class="select-medium"></select>
                                </div>
                            </div>
                            <div class="span4">
                                <div class="control-group">
                                    <label class="control-label padding-right10">COG</label> 
                                    <input class="input-medium" type="text" id="cog" />
                                </div>
                                <div class="control-group">
                                    <label class="control-label padding-right10">SOG</label> 
                                    <input class="input-medium" type="text" id="sog" />
                                </div>

                                <div class="control-group">
                                    <label class="control-label padding-right10">Manoever</label>  
                                    <select name="manoever" id="manoever" class="select-medium"></select>
                                </div>
                            </div>
                            <div class="span4">
                                <div class="control-group">
                                    <label class="control-label padding-right10">BTM</label> 
                                    <input class="input-medium" type="text" id="btm" />
                                </div>
                                <div class="control-group">
                                    <label class="control-label padding-right10">DTM</label> 
                                    <input class="input-medium" type="text" id="dtm" />
                                </div>
                                <div class="control-group">
                                    <label class="control-label padding-right10">Vorsegel</label>
                                    <select	name="vorsegel" id="vorsegel" class="select-medium"></select>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <hr style="color: #cccccc; background: #cccccc; height: 3px;" />

                            <!--Weather Formular-->
                            <div class="clearfix"></div>
                            <div class="">
                                <h4>Wetterdaten</h4>
                                <br />
                            </div>

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
                            <div class="align-center">
                                <button class="btn btn-large btn-inverse" onclick="submitForm();">Submit</button>
                                <button type="reset" class="btn">Reset</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div></div>
        <div class="container" align="center">
            <div class="row" style="margin-left: 5%;">
                <div class="span4" id="appNotes">
                    <h4>Notes</h4>
                    <textarea style="width: 96%; height: 360px;"></textarea>
                </div>
                <div class="span4" id="markerMap">
                    <h4>Map</h4>
                    <img src="../img/icons/marker_map.png" id="appInfoPhoto"
                         style="width: 100%; heigt: 100%;" />
                </div>
                <div class="span4" id="appPhotos">
                    <h4>Photos</h4>
                    <img src="../img/icons/no_image.jpg" id="appInfoPhoto"
                         style="width: 100%; heigt: 100%;" />
                </div>
            </div>
        </div>
        <!-- Content -->
        <!-- Footer -->
        <?php include("footer.php") ?>
    </body>
</html>
