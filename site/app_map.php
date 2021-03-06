<!DOCTYPE html>

<html lang="de">
    <head>

        <!-- Header -->
        <?php
        include('_include/header.php');
        include('_include/header_app.php');
        ?>

    </head>
    <body onload="initialize();">

        <!-- Navigation -->
        <?php include('_include/navigation.php'); ?>

        <!-- Container -->
        <div class="container-fluid">

            <!-- App Navigation -->
            <?php include('_include/navigation_app.php'); ?>

            <!-- Route Menu -->
            <div id="routeMenuContainer">
                <div id="routeMenu" class="well">
                    <h4>Routen Menü</h4>
                    <div class="btn-group btn-group-vertical">
                        <input type="button" class="btn" value="l&ouml;schen" id="deleteRouteButton" class="routeButton" onclick="javascript: deleteRoute()" />
                        <input type="button" class="btn" value="speichern" id="saveRouteButton" class="routeButton" onclick="javascript: saveRoute()" />
                        <input type="button" class="btn" value="beenden" id="stopRouteButton" class="routeButton" onclick="javascript: stopRouteMode()" />
                    </div>
                    <br><br>
                    <div id="route_distance">Routen-L&auml;nge: <span id="route_distance_number"></span> m</div>
                </div>
            </div>

            <!-- Distance Menu -->
            <div id="distanceToolContainer">
                <div id="distanceToolMenu" class="well">
                    <h4>Distanztool</h4>
                    <input type="button" class="btn" value="beenden" id="stopDistanceToolButton" class="distanceToolbutton" onclick="javascript: stopDistanceToolMode()" />
                    <br><br>
                    <div id="distanceTool_distance">Distanz: <span id="distanceTool_number"></span> m</div>
                </div>
            </div>

            <!-- Navigation Menu -->
            <div id="navigationContainer">
                <div id="navigationMenu" class="well">
                    <h4>Navigation</h4>
                    <input type="button" class="btn" value="beenden" id="stopNavigationButton" class="distanceToolbutton" onclick="javascript: stopNavigationMode()" />
                    <br><br>
                    <div id="navigation_distance">Distanz: <span id="navigation_number"></span> m</div>
                </div>
            </div>

            <!-- Current Position -->
            <div id="followCurrentPositionContainer" style="display:none;">
                <div id="followCurrentPosition_button" class="well">
                    <input type="button" class="btn" value="Eigener Position folgen" id="followCurrentPositionbutton" onclick="javascript: toggleFollowCurrentPosition()" />
                </div>
            </div>

            <!-- Weather Display Box-->
            <div id="weatherDisplayBox" class="well well-small btn-inverse disabled container" style="display: none;">
                <div id="navDisplayBox" data-toggle="buttons-radio" class="btn-group row-fluid">
	                <div class="span12">
	                    <button id="now" class="btn btn-info span1 active weatherButton">Aktuell</button>
	                    <button id="today" class="btn btn-info span1 weatherButton">Heute</button>
	                    <button id="tomorrow" class="btn btn-info span1 weatherButton">Morgen</button>
	                    <button id="3days" class="btn btn-info span1 weatherButton">3 Tage</button>
	                    <button id="7days" class="btn btn-info span1 weatherButton">7 Tage</button>
	                </div>
                </div>
                <div class="clearfix"></div>
                <a id ="detail" style="" href="#">
                    <div id="weatherDisplayTop">
                        <div id="weatherTopTemp" align="center">
                            <div id="tempDataMax" class="data" style=""></div>
                            <div id="nameData" class="data" style="">
                            <img id="weatherLoader" src="/img/icons/ajax-loader-black.gif">
                            </div>
                            <div id="tempDataMin" class="data" style=""></div>
                        </div>
                        <div id="tempData" class="data" style=""></div>
                        <div id="time" class="data"></div>
                    </div>
                    <div class="clearfix"></div>
                    <div id="weatherDisplayBottom">
                        <div align="center" id="state">
                            <span id="cloudsData" class="data"></span>
                            <span id="rainData" class="data"></span>
                        </div>
                        <span class="span2">
                            Luftdruck:
                        </span>
                        <span id="airPressData" class="data span2" style="text-align: right;"></span>
                        <span class="span2">
                            Windstärke:
                        </span>
                        <span id="windStrData" class="data span2" style="text-align: right;"></span>
                        <span class="span2">
                            Windrichtung:
                        </span>
                        <span id="windDirData" class="data span2" style="text-align: right;"></span>
                    </div>
                </a>
            </div>

            <!-- Weather Bar -->
            <div id="weatherBar" style="display:none;">
                <label class="checkbox inline">
                    <input type="checkbox" class="weat" id="rainOverlay" value="3"> Niederschlag
                </label>
                <label class="checkbox inline">
                    <input type="checkbox" class="weat" id="airOverlay" value="2"> Luftdruck
                </label>
                <label class="checkbox inline">
                    <input type="checkbox" class="weat" id="waveOverlay" value="4"> Wellenhöhe
                </label>
                <label class="checkbox inline">
                    <input type="checkbox" class="weat" id="tempOverlay" value="1"> Temperatur
                </label>
                <label class="checkbox inline">
                    <input type="checkbox" class="weat" id="cloudsOverlay" value="0"> Wind
                </label>
            </div>

            <!-- bft scale -->
            <div id="bft_scale" class="well well-large btn-inverse disabled" style="display: none;">
                <span style="padding-left:5px;">12</span>
                <span style="padding-left:13px;">11</span>
                <span style="padding-left:13px;">10</span>
                <span style="padding-left:17px;">9</span>
                <span style="padding-left:20px;">8</span>
                <span style="padding-left:20px;">7</span>
                <span style="padding-left:20px;">6</span>
                <span style="padding-left:20px;">5</span>
                <span style="padding-left:21px;">4</span>
                <span style="padding-left:20px;">3</span>
                <span style="padding-left:21px;">2</span>
                <span style="padding-left:20px;">1</span>
                <span class="add-on" title="Beaufort Scale">bft</span>
            </div>

            <!-- Menu Modal -->
            <div class="modal hide fade" id="forecastMessageBox">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3 id="dialogTitle"></h3>
                </div>
                <div class="modal-body btn-inverse" id="forecastBox"></div>
                <div class="modal-footer">
                    <a href="#" class="btn" data-dismiss="modal"><i class="icon-ok"></i> O.K</a>
                </div>
            </div>

            <!-- Weather log -->
            <div id="weatherLog" class="well well-small btn-inverse disabled" style="display:none;"></div>
            <!-- Weather Warning -->
            <div id="weatherWarningWindow" class="well well-small btn-inverse disabled" style="display:none;">Keine Meldungen</div>
            <!-- Map -->
            <div id="appWrapper">
                <div id="map_canvas"></div>
            </div>

            <!-- Context Menus -->
            <div id="temporaryMarkerContextMenu"></div>
            <div id="fixedMarkerContextMenu"></div>
            <div id="routeContextMenu_active"></div>
            <div id="routeContextMenu_inactive"></div>	
            <div id="chat" align="center">
                <div id="chat-area" style="height:200px; width:200px; background-color: white; overflow: auto;"></div>
            </div>

        </div><!-- Container -->

        <!-- Java-Script -->

        <script src="../js/app/ajax/weather.js" type="text/javascript"></script>

        <script src="../js/bootstrap/bootstrap-dropdown.js"></script>
        <script src="../js/bootstrap/bootstrap-modal.js"></script>
        <script src="../js/bootstrap/bootstrap-transition.js"></script>
        <script src="../js/bootstrap/bootstrap-button.js"></script>
        <script src="../js/bootstrap/bootstrap-collapse.js"></script>
        <script src="../js/bootstrap/bootstrap-affix.js"></script>

        <!-- Additional Java-Script -->
        <script src="../js/app/map/fancywebsocket.js" type="text/javascript" ></script>
        <script src="../js/app/map/chat.js" type="text/javascript" ></script>
        <script src="../js/app/map/labels.js" type="text/javascript"></script>
        <script src="../js/app/map/map.js" type="text/javascript"></script>
        <script src="../js/app/map/map_routes.js" type="text/javascript"></script>
        <script src="../js/app/map/map_weather.js" type="text/javascript"></script>
        <script src="../js/app/map/validation.js" type="text/javascript"></script>
        <script src="../js/app/map/contextMenu.js" type="text/javascript"></script>
        <script src="../js/app/map/TxtOverlay.js" type="text/javascript"></script>
    </body>
</html>