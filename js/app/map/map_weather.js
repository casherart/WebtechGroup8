
var weatherLogIntervall = null;
var inserTimeMin = 15 * 1000 * 60; //value in ms -> time x 6000 = Minut.
var currentTripToLog = 1;


function openWeatherLogWindow() {
    $.ajax({
        url: "app_weather_log_window.php",
        type: "GET",
        dataType: 'html'
    }).done(function(data) {
        $('#weatherLog').html(data);
        $("#trip_log").val(currentTripToLog);
        $('#weatherLog').css("zIndex", "999999999");
        $('#weatherLog').css("position", "absolute");
        $('#weatherLog').css("top", $("#startLog").offset().top + 35);
        $('#weatherLog').css("left", $("#startLog").offset().left - 250);
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
    var timespanString = (timespan!=null?"cnt="+timespan:"");//if forecast && empty -> 3 hours else param in days
    
    $.ajax({
        url: "http://api.openweathermap.org/data/2.5/"+time+"?mode=json&units=metric&lat=" + lat + "&lon=" + lon+ timespanString,
        type: "GET", dataType: 'jsonp',
        crossDomain: true
    }).done(function(data) {
        if (data) {
        	data = correctWeatherData(data);
        	if(time == "weather"){
        		data = data.list[0];
                if(target == "log"){
                    var wave_direction = 1;
                    var whight = 0;                	
    		        var urlString = "trip=" + currentTripToLog + "&wId=&temp=" + data.temp.day + "&airpress=" + data.pressure + "&wind_strength=" + data.speed
    		        + "&whight=" + whight + "&clouds=" + data.clouds + "&rain=" + data.rain + "&wind_direction=" +  data.deg + "&wave_direction=" + wave_direction;
    		        handleWeatherForm(urlString, true);
                }else if(target  == "box"){
	               	 $("#tempData").text(data.temp.day.toFixed(0));
	                 $("#airPressData").text(data.pressure.toFixed(2));
	                 $("#windStrData").text(bftIdToBftDescription(data.speed));
	                 $("#windDirData").text(SkyDirToSkyDirDescription(data.deg));
	                 $("#rainData").text(rainIdTorainDescription(data.rain));
	                 $("#cloudsData").text(CloudIdToDescription(data.clouds));
	            }
        	}else{
        		//fill forecast box;
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
function correctWeatherData(data){
	var newData = {};
	var list = [];
	newData.list = list;
	if(data.wind){
		var listElement = {};
		listElement.dt = data.dt;
		listElement.clouds = percentToCloud(data.clouds.all);//Percent
		var rain = 1;
		if (data.rain) {
			listElement.rain = mm3ToMM(data.rain);
		} else if (data.snow) {
			listElement.rain = mm3ToMM(data.snow);
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
	}else{
		for(var i in data.list){
			var listElement = {};
			if(data.list[i].main){
				listElement.clouds = percentToCloud(data.list[i].clouds.all);//Percent
				var rain = 1;
				if (data.list[i].rain) {
					listElement.rain = mm3ToMM(data.list[i].rain);
				} else if (data.snow) {
					listElement.rain = mm3ToMM(data.list[i].snow);
				}
				listElement.deg = dagreeToSkyDir(data.list[i].wind.deg);//degree
				listElement.speed = kmhToBftId(data.list[i].wind.speed);
				listElement.pressure = data.list[i].main.pressure;
				listElement.humidity = data.list[i].main.humidity;
				listElement.temp = {};
				listElement.temp.day = data.list[i].main.temp;
				listElement.temp.min = data.list[i].main.temp_min;
				listElement.temp.max = data.list[i].main.temp_max;
			}else{
				listElement.clouds = percentToCloud(data.list[i].clouds);//Percent
				var rain = 1;
				if (data.list[i].rain) {
					listElement.rain = mm3ToMM(data.list[i].rain);
				} else if (data.list[i].snow) {
					listElement.rain = mm3ToMM(data.list[i].snow);
				}
				listElement.deg = dagreeToSkyDir(data.list[i].deg);//degree
				listElement.speed = data.list[i].speed;
				listElement.pressure = data.list[i].pressure;
				listElement.humidity = data.list[i].humidity;
				listElement.temp.day = data.list[i].temp.day;
				listElement.temp.min = data.list[i].temp.min;
				listElement.temp.max = data.list[i].temp.max;
				if(data.list[i].temp.night && data.list[i].temp.eve && data.list[i].temp.morn){
					listElement.temp.night = data.list[i].temp.night;
					listElement.temp.eve = data.list[i].temp.eve;
					listElement.temp.morn = data.list[i].temp.morn;
				}
			}

			list.push(listElement);
		}
	}console.log(newData);
	return newData;
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
    switch(id) {
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
    mm /= 3;
    if (mm < 0.5)
        return 2;
    if (mm < 4)
        return 3;
    if (mm < 10)
        return 4;
    else
        return 5;
}

function rainIdTorainDescription(id) {
            switch(id) {
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
        switch(id) {
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
            switch(id) {
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