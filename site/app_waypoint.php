<!DOCTYPE html>

<html lang="de">
    <head>
        <!-- Headerinformation -->
        <?php include("header.php")?>
    </head>
    <body>
        
                <!-- Navigation -->
        <?php include("navigation.php")?>
        <!-- Container -->
        <div class="container-fluid">

            <!-- Content -->
            <div id="appWrapper">
                <div class="align-center">
                    <br>
                    <h2>LogBook</h2>
                    <br>
                </div>
                <form class="form-horizontal">
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
                                        <input class="input-medium" type="text" id="temp" /> 
                                        <span title="C°" style="cursor: pointer" class="add-on">C°</span>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label padding-right10">Air Pressure</label>  
                                    <div class="input-append">
                                        <input class="input-medium" type="text" id="airpress" /> 
                                        <span title="Pa" style="cursor: pointer" class="add-on">Pa</span>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label padding-right10">Wind Strength</label> 
                                    <div class="input-append">
                                        <select	name="wind_strength" id="windstr" class="select-medium">
                                            <option value="default"></option>
                                            <option value="bft 0">0 (0 - 2 km/h)</option>
                                            <option value="bft 1">1 (2 - 5 km/h)</option>
                                            <option value="bft 2">2 (6 - 11 km/h)</option>
                                            <option value="bft 3">3 (12 - 19 km/h)</option>
                                            <option value="bft 4">4 (20 - 28 km/h)</option>
                                            <option value="bft 5">5 (29 - 38 km/h)</option>
                                            <option value="bft 6">6 (39 - 49 km/h)</option>
                                            <option value="bft 7">7 (50 - 61 km/h)</option>
                                            <option value="bft 8">8 (62 - 74 km/h)</option>
                                            <option value="bft 9">9 (75 - 88 km/h)</option>
                                            <option value="bft 10">10 (89 - 102 km/h)</option>
                                            <option value="bft 11">11 (103 - 117 km/h)</option>
                                            <option value="bft 12">12 (≥ 117 km/h)</option>
                                        </select> 
                                        <span title="Beaufort Scale" style="cursor: pointer;" class="add-on">bft</span>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label padding-right10">Wave Hight</label> 
                                    <div class="input-append">
                                        <input class="input-medium" type="text" id="whight" /> 
                                        <span title="meter" style="cursor: pointer" class="add-on">m</span>
                                    </div>
                                </div>

                            </div>
                            <div class="span4">
                                <div class="control-group">

                                    <div class="control-group">
                                        <label class="control-label padding-right10">Clouds</label> 
                                        <div class="input-append">
                                            <select name="clouds" id="clou" class="select-medium">
                                                <option value="default"></option>
                                                <option value="okta 0">0/8 (sky completely clear)</option>
                                                <option value="okta 1">1/8 (sunny)</option>
                                                <option value="okta 2">2/8 (mainly clear)</option>
                                                <option value="okta 3">3/8 (partly cloudy)</option>
                                                <option value="okta 4">4/8 (sky half cloudy)</option>
                                                <option value="okta 5">5/8 (cloudy)</option>
                                                <option value="okta 6">6/8 (strong cloudy)</option>
                                                <option value="okta 7">7/8 (almost overcast)</option>
                                                <option value="okta 8">8/8 (completely overcast)</option>
                                                <option value="okta 9">9/8 (sky not visible)</option>
                                            </select> 
                                            <span title="Octa" style="cursor: pointer" class="add-on">Octa</span>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label padding-right10">Rain</label> 
                                        <select name="rain" id="rai" class="select-medium">
                                            <option value="default"></option>
                                            <option value="Value 1">Light rain &lt 0.5 mm/h</option>
                                            <option value="Value 2">Moderate rain &lt 4 mm/h</option>
                                            <option value="Value 3">Heavy rain &lt 10 mm/h</option>
                                            <option value="Value 4">Violent rain &gt 8 mm/min</option>
                                        </select>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label padding-right10">Wind Direction</label> 
                                        <select name="wind_direction" id="winddir" class="select-medium">
                                            <option value="default"></option>
                                            <option value="Value 1">North</option>
                                            <option value="Value 2">East</option>
                                            <option value="Value 3">South</option>
                                            <option value="Value 4">West</option>
                                            <option value="Value 5">North-East</option>
                                            <option value="Value 6">North-West</option>
                                            <option value="Value 7">South-East</option>
                                            <option value="Value 8">South-West</option>
                                        </select>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label padding-right10">Wave Direction</label> 
                                        <select name="wave_direction" id="wavedir" class="select-medium">
                                            <option value="default"></option>
                                            <option value="Value 1">North</option>
                                            <option value="Value 2">East</option>
                                            <option value="Value 3">South</option>
                                            <option value="Value 4">West</option>
                                            <option value="Value 5">North-East</option>
                                            <option value="Value 6">North-West</option>
                                            <option value="Value 7">South-East</option>
                                            <option value="Value 8">South-West</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
            <form></form>
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
        <?php include("footer.php")?>
    </body>
</html>