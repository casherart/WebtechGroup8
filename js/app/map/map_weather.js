var weatherLogIntervall = null;
var forecastBoxIntervall = null;
var inserTimeMin = 15 * 1000 * 60; //value in ms -> time x 6000 = Minut.
var currentTripToLog = 1;
//test for jenkins

function openWeatherLogWindow() {
    $.ajax({
        url: "app_weather_log_window.php",
        type: "GET",
        dataType: 'html'
    }).done(function(data) {
        $('#weatherLog').html(data);
        $("#trip_log").val(currentTripToLog);
        $('#weatherLog').css("zIndex", "999999999");
     //   $('#weatherLog').css("position", "absolute");
       // $('#weatherLog').css("top", $("#startLog").offset().top + 35);
//        $('#weatherLog').css("left", Math.max($("#startLog").offset().left - 250, 20));

       // $('#weatherLog').css("left", Math.max(($(".navbar").width() - $("#weatherLog").width() - 39), 20));
        $('#weatherLog').fadeIn('slow');
    });
}

function closeWeatherLog() {
    $('#weatherLog').fadeOut('slow');
}

function startWeatherlogging() {
    currentTripToLog = $("#trip_log").val();
    if (!currentTripToLog) {
        alert("Error getting Trip");
        return;
    }
    closeWeatherLog();
    $('#startLog').children().first().removeClass("icon-pencil");
    $('#startLog').children().first().addClass("icon-stop");
    $('#startLog').removeAttr("onclick");
    $('#startLog').unbind("click");
    $('#startLog').click(function() {
        endWeatherlogging();
    });
    handleWeather();// initial Log
    weatherLogIntervall = window.setInterval("handleWeather()", inserTimeMin);

}

function endWeatherlogging() {
    window.clearInterval(weatherLogIntervall);
    $('#startLog').children().first().removeClass("icon-stop");
    $('#startLog').children().first().addClass("icon-pencil");
    $('#startLog').removeAttr("onclick");
    $('#startLog').unbind("click");
    $('#startLog').click(function() {
        openWeatherLogWindow();
    });
}

function handleWeather(time, target, timespan) {
    /*
     * get Weather data from Position and create urlString with correct data.
     */
    var lat = map.getCenter().lat();
    var lon = map.getCenter().lng();
    var time = time || "weather"; //forcast (3h) //forecast/daily (x daxs max 14)
    var target = target || "log";
    var timespan = timespan || null;
    var timespanString = (timespan != null ? "&cnt=" + timespan : "");//if forecast && empty -> 3 hours else param in days
    $.ajax({
        url: "http://api.openweathermap.org/data/2.5/" + time + "?mode=json&units=metric&lat=" + lat + "&lon=" + lon + timespanString,
        type: "GET", dataType: 'jsonp',
        crossDomain: true
    }).done(function(data) {
        if (data) {
            data = correctWeatherData(data);
            if (time == "weather") {
                data = data.list[0];
                if (target == "log") {
                    var wave_direction = 1;
                    var whight = 0;
                    var urlString = "trip=" + currentTripToLog + "&wId=&temp=" + data.temp.day + "&airpress=" + data.pressure + "&wind_strength=" + data.speed
                            + "&whight=" + whight + "&clouds=" + data.clouds + "&rain=" + data.rain + "&wind_direction=" + data.deg + "&wave_direction=" + wave_direction;
                    handleWeatherForm(urlString, true);
                } else if (target == "box") {
                    $("#tempData").text(data.temp.day.toFixed(0) + "°");
                    $("#tempDataMax").text("H: " + data.temp.max.toFixed(0) + "°");
                    $("#tempDataMin").text("L: " + data.temp.min.toFixed(0) + "°");
                    $("#airPressData").text(data.pressure.toFixed(2) + " hPa");
                    $("#windStrData").text(bftIdToBftDescription(data.speed));
                    $("#windDirData").text(SkyDirToSkyDirDescription(data.deg));
                    $("#rainData").text(", " + rainIdTorainDescription(data.rain));
                    $("#cloudsData").text(CloudIdToDescription(data.clouds));
                    $("#nameData").text(data.name);
                    $("#time").text("");
                    $("#weatherDisplayTop").css("background-image", "url(../../../css/img/icons/weather_icons/" + getWeatherIcon(data.dt, data.temp.day.toFixed(0), CloudIdToDescription(data.clouds), rainIdTorainDescription(data.rain)) + ".png)");
                }
            } else {
                if ($("#today").hasClass("active"))
                {
                    getForecast(data.list[1]);
                    fillDetailForecast("today", data);
                }
                else if ($("#tomorrow").hasClass("active"))
                {
                    var buffer = false;
                    for (var i = 0; i < data.list.length; i++) {
                        buffer = checkForecast(data.list[i].dt, "tomorrow");
                        if (buffer === true) {
                            getForecast(data.list[i+4]);
                            break;
                        }
                    }
                    fillDetailForecast("tomorrow", data);
                }
                else if ($("#3days").hasClass("active"))
                {
                    getForecast(data.list[3]);
                    fillDetailForecast("3days", data);
                }
                else if ($("#7days").hasClass("active"))
                {
                    getForecast(data.list[7]);
                    fillDetailForecast("7days", data);
                }
            }

        }
    });
}
/*
 * set data from json to values used in app
 * 
 * 
 * data:{
 * 		list : [
 * 			dt: date,
 * 			clouds: int,
 * 			rain:int, 
 * 			deg: int,
 * 			speed: int,
 * 			pressure: int,
 * 			humidity: int,
 * 			temp: {
 * 				day: int,
 * 				min: int,
 * 				max: int,
 * 				eve: int, //opt
 * 				morning: int, //opt
 * 				night: int //opt
 * 			}
 * 			], []//opt
 * }
 * 
 * 
 */
function correctWeatherData(data) {
    var newData = {};
    var list = [];
    newData.list = list;
    if (data.wind) {
        var listElement = {};
        var date = new Date(data.dt * 1000);
        listElement.dt = data.dt; //Format('%a %d %B %H'));
        listElement.name = data.name;
        listElement.clouds = percentToCloud(data.clouds.all);//Percent        
        if (data.rain) {
            listElement.rain = mm3ToMM(data.rain);
        } else if (data.snow) {
            listElement.rain = mm3ToMM(data.snow);
        } else {
            listElement.rain = 1;
        }
        listElement.deg = dagreeToSkyDir(data.wind.deg);//degree
        listElement.speed = kmhToBftId(data.wind.speed);
        listElement.pressure = data.main.pressure;
        listElement.humidity = data.main.humidity;
        listElement.temp = {};
        listElement.temp.day = data.main.temp;
        listElement.temp.min = data.main.temp_min;
        listElement.temp.max = data.main.temp_max;
        list.push(listElement);
    } else {
        // Heute
        for (var i in data.list) {
            var listElement = {};
            if (data.list[i].main) {
                listElement.clouds = percentToCloud(data.list[i].clouds.all);//Percent
                if (data.list[i].rain) {
                    listElement.rain = mm3ToMM(data.list[i].rain);
                } else if (data.snow) {
                    listElement.rain = mm3ToMM(data.list[i].snow);
                } else {
                    listElement.rain = 1;
                }
                listElement.deg = dagreeToSkyDir(data.list[i].wind.deg);//degree
                listElement.speed = kmhToBftId(data.list[i].wind.speed);
                listElement.pressure = data.list[i].main.pressure;
                listElement.humidity = data.list[i].main.humidity;
                listElement.temp = {};
                listElement.temp.day = data.list[i].main.temp;
                listElement.temp.min = data.list[i].main.temp_min;
                listElement.temp.max = data.list[i].main.temp_max;
                listElement.name = data.city.name;
                listElement.dt = data.list[i].dt;
                //forecast tomorrow - 7days
            } else {
                listElement.clouds = percentToCloud(data.list[i].clouds);//Percent
                if (data.list[i].rain) {
                    listElement.rain = mm3ToMM(data.list[i].rain);
                } else if (data.list[i].snow) {
                    listElement.rain = mm3ToMM(data.list[i].snow);
                } else {
                    listElement.rain = 1;
                }
                listElement.deg = dagreeToSkyDir(data.list[i].deg);//degree
                listElement.speed = data.list[i].speed;
                listElement.pressure = data.list[i].pressure;
                listElement.humidity = data.list[i].humidity;
                listElement.temp = {};
                listElement.temp.day = data.list[i].temp.day;
                listElement.temp.min = data.list[i].temp.min;
                listElement.temp.max = data.list[i].temp.max;
                listElement.name = data.city.name;
                listElement.dt = data.list[i].dt;
                if (data.list[i].temp.night && data.list[i].temp.eve && data.list[i].temp.morn) {
                    listElement.temp.night = data.list[i].temp.night;
                    listElement.temp.eve = data.list[i].temp.eve;
                    listElement.temp.morn = data.list[i].temp.morn;
                }
            }

            list.push(listElement);
        }

    }
    return newData;
}

// convert unix timestamp to different date formats (box show, forecast show and for calculation)
function timeConverter(UNIX_timestamp, option) {
    var a = new Date(UNIX_timestamp * 1000);
    var months = ['Januar', 'Februar', 'März', 'April', 'Mai', 'Juni', 'Juli', 'August', 'September', 'Oktober', 'November', 'Dezember'];
    var days = ['Sonntag', 'Montag', 'Dienstag', 'Mittwoch', 'Donnerstag', 'Freitag', 'Samstag'];
    var daysShort = ['So.', 'Mo.', 'Di.', 'Mi.', 'Do.', 'Fr.', 'Sa.'];
    var year = a.getFullYear();
    var month = months[a.getMonth()];
    var day = days[a.getDay()];
    var dayShort = daysShort[a.getDay()];
    var date = a.getDate();
    var hour = a.getHours();
    var min = a.getMinutes();
    if (option === "box")
    {
        var time = day + ' ' + date + '. ' + month;
    }
    else if (option === "forecast") {
        var time = day + ' ' + date + '. ' + month + ' ' + hour + ':0' + min + ' Uhr';
    }
    else if (option === "calculation") {
        var time = date + '-' + month + '-' + year;
    }
    return time;

}

function dagreeToSkyDir(deg) {
    if (deg > 337 || deg <= 22)
        return 2;
    else if (deg > 22 && deg <= 67)
        return 6;
    else if (deg > 67 && deg <= 112)
        return 3;
    else if (deg > 12 && deg <= 157)
        return 8;
    else if (deg > 157 && deg <= 202)
        return 4;
    else if (deg > 202 && deg <= 247)
        return 9;
    else if (deg > 247 && deg <= 292)
        return 5;
    else if (deg > 292 && deg <= 337)
        return 7;
    return 1;
}

function SkyDirToSkyDirDescription(id) {
    switch (id) {
        case 1:
            return "undefiniert";
            break;
        case 2:
            return "Norden";
            break;
        case 3:
            return "Osten";
            break;
        case 4:
            return "Süden";
            break;
        case 5:
            return "Westen";
            break;
        case 6:
            return "Nordost";
            break;
        case 7:
            return "Nordwest";
            break;
        case 8:
            return "Südost";
            break;
        case 9:
            return "Südwest";
            break;
        default:
    }
}

function mm3ToMM(mm) {
	if (mm.hasOwnProperty("1h")) {
        mm = mm["1h"];
    } else if (mm.hasOwnProperty("3h")) {
        mm = mm["3h"]/3;//definition is rain/1h
    } else if (mm === null) {
        return 1;
    }
    mm /= 3;
	if(mm == 0){
		return 1;
	}
    if (mm < 0.5)
        return 2;
    if (mm < 4)
        return 3;
    if (mm < 10)
        return 4;
    if (mm > 10)
        return 5;
}

function rainIdTorainDescription(id) {
    switch (id) {
        case 1:
            return "Kein Regen";
            break;
        case 2:
            return "Leichter Regen";
            break;
        case 3:
            return "Gemäßigter Regen";
            break;
        case 4:
            return "Starker Regen";
            break;
        case 5:
            return "Heftiger Regen";
            break;
        default:
    }
}

function percentToCloud(perc) {
    if (perc === 0)
        return 2;
    else if (perc > 0 && perc <= 12)
        return 3;
    else if (perc > 12 && perc <= 25)
        return 4;
    else if (perc > 25 && perc <= 37)
        return 5;
    else if (perc > 37 && perc <= 50)
        return 6;
    else if (perc > 50 && perc <= 62)
        return 7;
    else if (perc > 62 && perc <= 75)
        return 8;
    else if (perc > 75 && perc <= 87)
        return 9;
    else if (perc > 87 && perc <= 100)
        return 10;
    else if (perc > 100)
        return 11;
    return 1;
}

function CloudIdToDescription(id) {
    switch (id) {
        case 1:
            return "undefiniert";
            break;
        case 2:
            return "wolkenlos";
            break;
        case 3:
            return "sonnig";
            break;
        case 4:
            return "heiter";
            break;
        case 5:
            return "leicht bewölkt";
            break;
        case 6:
            return "wolkig";
            break;
        case 7:
            return "bewölkt";
            break;
        case 8:
            return "stark bewölkt";
            break;
        case 9:
            return "fast bedeckt";
            break;
        case 10:
            return "bedeckt";
            break;
        case 11:
            return "Himmel nicht erkennbar";
            break;
        default:
    }
}

function kmhToBftId(kmh) {
    if (kmh > 0 && kmh <= 2)
        return 2;
    else if (kmh > 2 && kmh <= 5)
        return 3;
    else if (kmh > 5 && kmh <= 11)
        return 4;
    else if (kmh > 11 && kmh <= 19)
        return 5;
    else if (kmh > 19 && kmh <= 28)
        return 6;
    else if (kmh > 28 && kmh <= 38)
        return 7;
    else if (kmh > 38 && kmh <= 49)
        return 8;
    else if (kmh > 49 && kmh <= 61)
        return 9;
    else if (kmh > 61 && kmh <= 74)
        return 10;
    else if (kmh > 74 && kmh <= 88)
        return 11;
    else if (kmh > 88 && kmh <= 102)
        return 12;
    else if (kmh > 102 && kmh <= 117)
        return 13;
    else if (kmh >= 117)
        return 14;
    return 1;
}

function bftIdToBftDescription(id) {
    switch (id) {
        case 1:
            return "undefiniert";
            break;
        case 2:
            return "0 bft (0 - 2 km/h)";
            break;
        case 3:
            return "1 bft (2 - 5 km/h)";
            break;
        case 4:
            return "2 bft (6 - 11 km/h)";
            break;
        case 5:
            return "3 bft (12 - 19 km/h)";
            break;
        case 6:
            return "4 bft (20 - 28 km/h)";
            break;
        case 7:
            return "5 bft (29 - 38 km/h)";
            break;
        case 8:
            return "6 bft (39 - 49 km/h)";
            break;
        case 9:
            return "7 bft (50 - 61 km/h)";
            break;
        case 10:
            return "8 bft (62 - 74 km/h)";
            break;
        case 11:
            return "9 bft (75 - 88 km/h)";
            break;
        case 12:
            return "10 bft (89 - 102 km/h)";
            break;
        case 13:
            return "11 bft (103 - 117 km/h)";
            break;
        case 14:
            return "12 bft ≥ 117 km/h";
            break;
        default:
    }
}

function getWeatherIcon(dt, temp, cloud, rain) {
     var date = new Date(dt*1000);
     var hours = date.getHours();
    //rain = "Leichter Regen";
    var icon = "";
    switch (cloud) {
        case "wolkenlos":
            icon = "_1";
            icon = checkRain(icon, rain);
            break;
        case "sonnig":
            icon = "_1";
            icon = checkRain(icon, rain);
            break;
        case "heiter":
            icon = "_1";
            icon = checkRain(icon, rain);
            break;
        case "leicht bewölkt":
            icon = "_2";
            icon = checkRain(icon, rain);
            break;
        case "wolkig":
            icon = "_3";
            icon = checkRain(icon, rain);
            break;
        case "bewölkt":
            icon = "_4";
            icon = checkRain(icon, rain);
            break;
        case "stark bewölkt":
            icon = "_4";
            icon = checkRain(icon, rain);
            break;
        case "fast bedeckt":
            icon = "_4";
            icon = checkRain(icon, rain);
            break;
        case "bedeckt":
            icon = "_4";
            icon = checkRain(icon, rain);
            break;
        case "Himmel nicht erkennbar":
            icon = "_4";
            icon = checkRain(icon, rain);
            break;
        default:
    }
    if(hours === 23 || hours === 0 || hours === 1 || hours === 2 || hours === 3 || hours === 4 || hours === 5 || hours === 6) {
        icon = "N" + icon;
    } else {
        icon = "D" + icon;
    }
    return icon;
}

function checkRain(icon, rain) {
    if (rain === "Leichter Regen")
        return icon = "_5";
    else if (rain === "Gemäßigter Regen")
        return icon = "_6";
    else if (rain === "Starker Regen")
        return icon = "_7";
    else if (rain === "Heftiger Regen")
        return icon = "_8";
    else
        return icon;
}

function getForecast(data) {
    $("#tempData").text(data.temp.day.toFixed(0) + "°");
    $("#tempDataMax").text("H: " + data.temp.max.toFixed(0) + "°");
    $("#tempDataMin").text("L: " + data.temp.min.toFixed(0) + "°");
    $("#airPressData").text(data.pressure.toFixed(2) + " hPa");
    $("#windStrData").text(bftIdToBftDescription(data.speed));
    $("#windDirData").text(SkyDirToSkyDirDescription(data.deg));
    $("#rainData").text(", " + rainIdTorainDescription(data.rain));
    $("#cloudsData").text(CloudIdToDescription(data.clouds));
    $("#nameData").text(data.name);
    $("#time").text(timeConverter(data.dt, "box"));
    $("#weatherDisplayTop").css("background-image", "url(../../../css/img/icons/weather_icons/" + getWeatherIcon(data.dt, data.temp.day.toFixed(0), CloudIdToDescription(data.clouds), rainIdTorainDescription(data.rain)) + ".png)");
}


function getWeatherWarning() {
    var timestamp = timestamp || new Date().getTime();
    $.ajax({
        type: 'get',
        url: "../server/getWeatherWarning.php",//app_weather_warning.html for play
        dataType: 'json',
        data: {'timestamp': timestamp},
        success: function(response) {
            $('#weatherWarningWindow').html(response.msg);
            $('#weatherWarningWindow').css("left", Math.max(($(".navbar").width()/2 - $("#weatherWarningWindow").width()/2), 20));
            timestamp = response.timestamp;
            if (response.warningLevel > 90) {
                $("#showWeatherWarning").removeClass("btn-warning").addClass("btn-danger");
                $("#weatherWarningWindow").removeClass("btn-inverse").removeClass("btn-warning").addClass("btn-danger");
            } else if (response.warningLevel > 75) {
                $("#showWeatherWarning").removeClass("btn-danger").addClass("btn-warning");
                $("#weatherWarningWindow").removeClass("btn-inverse").removeClass("btn-danger").addClass("btn-warning");
            } else {
                $("#showWeatherWarning").removeClass("btn-warning btn-danger");
                $("#weatherWarningWindow").removeClass("btn-danger").removeClass("btn-warning").addClass("btn-inverse");
            }
            noerror = true;
        },
        complete: function(response) {
            // send a new ajax request when this request is finished
            if (!self.noerror) {
// if a connection problem occurs, try to reconnect each 5 seconds
                setTimeout(function() {
                    getWeatherWarning();
                }, 5000);
            } else {
// persistent connection
                getWeatherWarning();
            }
            noerror = false;
        }
    });
}

function openWeatherWarnings() {
    if ($('#weatherWarningWindow').css("display") == "none") {
        $('#weatherWarningWindow').css("zIndex", "999999999");
        //$('#weatherWarningWindow').css("position", "absolute");
        //$('#weatherWarningWindow').css("top", $("#showWeatherWarning").offset().top + 35);
        //$('#weatherWarningWindow').css("left", Math.max(($(".navbar").width()/2 - $("#weatherWarningWindow").width()/2), 20));
        $('#weatherWarningWindow').fadeIn('slow');
    } else {
        $('#weatherWarningWindow').fadeOut('slow');
    }
}

// iterate through data list and check the date
function fillDetailForecast(art, data) {
    var buffer;
    $("#forecastBox").html("");
    for (var i = 0; i < data.list.length; i++) {
        buffer = checkForecast(data.list[i].dt, art);
        if (buffer === true)
            fillForecastRows(i, data.list[i]);
    }
}

// fill the forecast box
function fillForecastRows(index, data) {
    var str = '<div id="row' + index + '" class="BoxRow"><div class="Boxleft"><span id="boxDate' + index + '" class="BoxDate"></span><div id="boxIcon' + index + '" class="BoxIcon"></div></div><div class="BoxMiddle"><div id="boxTemp' + index + '" class="BoxTemp"></div><div id="boxCloud' + index + '" class="BoxCloud"></div></div><div class="BoxRight"><div id="boxRain' + index + '"></div><div id="boxAirPress' + index + '"></div><div id="boxWindStr' + index + '"></div><div id="boxWindDir' + index + '"></div></div></div>';
    $("#forecastBox").append(str);
    $("#boxDate" + index).text(timeConverter(data.dt, "forecast"));
    $("#boxTemp" + index).text(data.temp.day.toFixed(0) + "°");
    $("#boxCloud" + index).text(CloudIdToDescription(data.clouds));
    $("#boxIcon" + index).css("background-image", "url(../../../css/img/icons/weather_icons/" + getWeatherIcon(data.dt, data.temp.day.toFixed(0), CloudIdToDescription(data.clouds), rainIdTorainDescription(data.rain)) + ".png)");
    $("#boxAirPress" + index).text(data.pressure.toFixed(2) + " hPa");
    $("#boxWindStr" + index).text(bftIdToBftDescription(data.speed));
    $("#boxWindDir" + index).text(SkyDirToSkyDirDescription(data.deg));
    $("#boxRain" + index).text(rainIdTorainDescription(data.rain));

}

function checkForecast(data, art) {
    var date = new Date(data * 1000);
    switch (art) {
        case "today":
            var currDate = new Date();
            if (date.getDay() == currDate.getDay() && date.getMonth() == currDate.getMonth() && date.getFullYear() == currDate.getFullYear()) {
                $('#dialogTitle').text("Das Wetter für Heute");
                return true;
            }
            break;
        case "tomorrow":
            // tomorrow
            var currDate = new Date();
            currDate.setHours(0);
            currDate.setMinutes(0);
            currDate.setSeconds(0);
            currDate.setMilliseconds(0);
            currDate.setHours(currDate.getHours() + 24);
            if (date.getDay() == currDate.getDay() && date.getMonth() == currDate.getMonth() && date.getFullYear() == currDate.getFullYear()) {
                $('#dialogTitle').text("Das Wetter für Morgen");
                return true;
            }
            break;
        case "3days":
            var nextDate = new Date();
            var lastDate = new Date();
            nextDate.setHours(0);
            nextDate.setMinutes(0);
            nextDate.setSeconds(0);
            nextDate.setMilliseconds(0);
            lastDate.setHours(0);
            lastDate.setMinutes(0);
            lastDate.setSeconds(0);
            lastDate.setMilliseconds(0);
            nextDate.setHours(nextDate.getHours() + 24);
            lastDate.setHours(lastDate.getHours() + (4 * 24));
            if (nextDate <= date && date <= lastDate) {
                $('#dialogTitle').text("Das Wetter für die nächsten 3 Tage");
                return true;
            }
            break;
        case "7days":
            var nextDate = new Date();
            var lastDate = new Date();
            nextDate.setHours(0);
            nextDate.setMinutes(0);
            nextDate.setSeconds(0);
            nextDate.setMilliseconds(0);
            lastDate.setHours(0);
            lastDate.setMinutes(0);
            lastDate.setSeconds(0);
            lastDate.setMilliseconds(0);
            nextDate.setHours(nextDate.getHours() + 24);
            lastDate.setHours(lastDate.getHours() + (8 * 24));
            if (nextDate <= date && date <= lastDate) {
                $('#dialogTitle').text("Das Wetter für die nächsten 7 Tage");
                return true;
            }
            break
    }
    return false;
}

function toTimestamp(strDate) {
    var datum = Date.parse(strDate);
    return datum / 1000;
}


//tabs for weatherbox
$('#now').click(function() {
    handleWeather(null, "box");
});
$("#today").click(function() {
    handleWeather("forecast", "box");
});
$("#tomorrow").click(function() {
    handleWeather("forecast", "box");
});
$("#3days").click(function() {
    handleWeather("forecast/daily", "box");
});
$("#7days").click(function() {
    handleWeather("forecast/daily", "box", 14);
});

//get detailed forecast
$('#detail').click(function() {
	if(!$("#now").hasClass("active")){
	    $('#forecastMessageBox').modal('show');		
	}
});

$('#detail').mouseover(function() {
    if($("#now").hasClass("active")) {
        $("#detail").css("cursor", "default");
    } else {
        $("#detail").css("cursor", "pointer");
    }
});