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
            <div id="weatherDisplayBox" class="well well-small btn-inverse disabled" style="display: none;">
                <div id="navDisplayBox" data-toggle="buttons-radio" class="btn-group span4">
                    <button id="now" class="btn btn-info span1 active">Aktuell</button>
                    <button id="today" class="btn btn-info span1">Heute</button>
                    <button id="tomorrow" class="btn btn-info span1">Morgen</button>
                    <button id="3days" class="btn btn-info span1">3 Tage</button>
                    <button id="7days" class="btn btn-info span1">7 Tage</button>
                </div>
                <a id ="detail" style="" href="#">
                    <div id="weatherDisplayTop">
                        <div align="center" style="width: 140px; height: 80px; float: left;">
                            <div id="tempDataMax" class="data" style=""></div>
                            <div id="nameData" class="data" style=""></div>
                            <div id="tempDataMin" class="data" style=""></div>
                        </div>
                        <div id="tempData" class="data" style=""></div>
                        <div id="time" class="data" style="padding-top: 18px; text-align: right; float: right;"></div>
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
            <div class="modal hide fade" id="messageBox">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3 id="dialogTitle"></h3>
                </div>
                <div class="modal-body" id="forecastBox">
                    <div id="row1" class="BoxRow">
                        <div class="left">
                            <span id="boxDate1" class="BoxDate">
                            </span>
                            <div id="boxIcon1" class="BoxIcon">
                            </div>
                        </div>
                        <div class="BoxMiddle">
                            <div id="boxTemp1" class="BoxTemp"></div>
                            <div id="boxCloud1" class="BoxCloud"></div>
                        </div>
                        <div class="BoxRight">
                            <div id="boxRain1"></div>
                            <div id="boxAirPress1"></div>
                            <div id="boxWindStr1"></div>
                            <div id="boxWindDir1"></div>
                        </div>
                    </div>
                    <div id="row2" class="BoxRow">
                        <div class="left">
                            <span id="boxDate2" class="BoxDate">
                            </span>
                            <div id="boxIcon2" class="BoxIcon"></div>
                        </div>
                        <div class="BoxMiddle">
                            <div id="boxTemp2" class="BoxTemp"></div>
                            <div id="boxCloud2" class="BoxCloud"></div>
                        </div>
                        <div class="BoxRight">
                            <div id="boxRain2"></div>
                            <div id="boxAirPress2"></div>
                            <div id="boxWindStr2"></div>
                            <div id="boxWindDir2"></div>
                        </div>
                    </div>
                    <div id="row3" class="BoxRow">
                        <div class="left">

                            <span id="boxDate3" class="BoxDate">
                            </span>
                            <div id="boxIcon3" class="BoxIcon"></div>
                        </div>
                        <div class="BoxMiddle">
                            <div id="boxTemp3" class="BoxTemp"></div>
                            <div id="boxCloud3" class="BoxCloud"></div>
                        </div>
                        <div class="BoxRight">
                            <div id="boxRain3"></div>
                            <div id="boxAirPress3"></div>
                            <div id="boxWindStr3"></div>
                            <div id="boxWindDir3"></div>
                        </div>
                    </div>
                    <div id="row4" class="BoxRow">
                        <div class="left">

                            <span id="boxDate4" class="BoxDate">
                            </span>
                            <div id="boxIcon4" class="BoxIcon"></div>
                        </div>
                        <div class="BoxMiddle">
                            <div id="boxTemp4" class="BoxTemp"></div>
                            <div id="boxCloud4" class="BoxCloud"></div>
                        </div>
                        <div class="BoxRight">
                            <div id="boxRain4"></div>
                            <div id="boxAirPress4"></div>
                            <div id="boxWindStr4"></div>
                            <div id="boxWindDir4"></div>
                        </div>
                    </div>
                    <div id="row5" class="BoxRow">
                        <div class="left">
                            <span id="boxDate5" class="BoxDate">
                            </span> 
                            <div id="boxIcon5" class="BoxIcon"></div>
                        </div>
                        <div class="BoxMiddle">
                            <div id="boxTemp5" class="BoxTemp"></div>
                            <div id="boxCloud5" class="BoxCloud"></div>
                        </div>
                        <div class="BoxRight">
                            <div id="boxRain5"></div>
                            <div id="boxAirPress5"></div>
                            <div id="boxWindStr5"></div>
                            <div id="boxWindDir5"></div>
                        </div>
                    </div>
                    <div id="row6" class="BoxRow">
                        <div class="left">

                            <span id="boxDate6" class="BoxDate">
                            </span>  
                            <div id="boxIcon6" class="BoxIcon"></div>
                        </div>
                        <div class="BoxMiddle">
                            <div id="boxTemp6" class="BoxTemp"></div>
                            <div id="boxCloud6" class="BoxCloud"></div>
                        </div>
                        <div class="BoxRight">
                            <div id="boxRain6"></div>
                            <div id="boxAirPress6"></div>
                            <div id="boxWindStr6"></div>
                            <div id="boxWindDir6"></div>
                        </div>
                    </div>
                    <div id="row7" class="BoxRow">
                        <div class="left">

                            <span id="boxDate7" class="BoxDate">
                            </span>
                            <div id="boxIcon7" class="BoxIcon"></div>
                        </div>
                        <div class="BoxMiddle">
                            <div id="boxTemp7" class="BoxTemp"></div>
                            <div id="boxCloud7" class="BoxCloud"></div>
                        </div>
                        <div class="BoxRight">
                            <div id="boxRain7"></div>
                            <div id="boxAirPress7"></div>
                            <div id="boxWindStr7"></div>
                            <div id="boxWindDir7"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn" data-dismiss="modal"><i class="icon-ok"></i> O.K</a>
                </div>
            </div>

            <!-- Weather log -->
            <div id="weatherLog" class="well well-large" style="display:none;"></div>
            <!-- Weather Warning -->
            <div id="weatherWarningWindow" class="well well-large" style="display:none;">Keine Meldungen</div>
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