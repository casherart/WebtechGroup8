
var weatherLogIntervall = null;
var inserTimeMin = 15*1000*60; //value in ms -> time x 6000 = Minut.
var currentTripToLog = 1;


function openWeatherLogWindow(){
	$.ajax({
		url: "app_weather_log_window.php",
		type: "GET",
		dataType: 'html'
	}).done(function ( data ) {
		$('#weatherLog').html(data);
		$("#trip_log").val(currentTripToLog);
		$('#weatherLog').css("zIndex","999999999");
		$('#weatherLog').css("position","absolute");
		$('#weatherLog').css("top",$("#startLog").offset().top+35);
		$('#weatherLog').css("left",$("#startLog").offset().left-250);
		$('#weatherLog').fadeIn('slow');
	});
}

function closeWeatherLog(){
	 $('#weatherLog').fadeOut('slow');	
}

function startWeatherlogging(){
	currentTripToLog = $("#trip_log").val();
	if(!currentTripToLog){
		alert("Error getting Trip");
		return;
	}
	closeWeatherLog();
	$('#startLog').children().first().removeClass("icon-pencil");
	$('#startLog').children().first().addClass("icon-stop");
	$('#startLog').removeAttr("onclick");
	$('#startLog').unbind("click");
	$('#startLog').click(function(){
		endWeatherlogging();
	});
	addWeatherForPosition();// initial Log
	weatherLogIntervall = window.setInterval("addWeatherForPosition()", inserTimeMin);
	
}

function endWeatherlogging(){
	window.clearInterval(weatherLogIntervall);
	$('#startLog').children().first().removeClass("icon-stop");
	$('#startLog').children().first().addClass("icon-pencil");
	$('#startLog').removeAttr("onclick");
	$('#startLog').unbind("click");
	$('#startLog').click(function(){
		openWeatherLogWindow();
	});
}

function addWeatherForPosition(time){
	/*
	 * get Weather data from Position and create urlString with correct data.
	 */
	
	var lat = map.getCenter().lat();
	var lon = map.getCenter().lng();
	var time = time || "weather"; //history
		
	/*
	 * 		{
	 * 			"coord":{
	 * 				"lon":139,
	 * 				"lat":35
	 * 			},
	 * 			"sys":{
	 * 				"country":"JP",
	 * 				"sunrise":1367437897,
	 * 				"sunset":1367487016
	 * 			},
	 * 			"weather":[
	 * 				{
	 * 					"id":801,
	 * 					"main":"Clouds",
	 * 					"description":"few clouds",
	 * 					"icon":"02n"
	 * 				}
	 * 			],
	 * 			"base":"global stations",
	 * 			"main":{
	 * 				"temp":20.20,
	 * 				"humidity":68,
	 * 				"pressure":1007,
	 * 				"temp_min":279.26,
	 * 				"temp_max":287.04
	 * 			},
	 * 			"wind":{
	 * 				"speed":0,
	 * 				"gust":0.51,
	 * 				"deg":76
	 * 			},
	 * 			"clouds":{
	 * 				"all":12
	 * 			},
	 * 			"dt":1367496303,
	 * 			"id":1851632,
	 * 			"name":"Shuzenji",
	 * 			"cod":200}
	 * 
	 */
	$.ajax({
		url: "http://api.openweathermap.org/data/2.5/weather?units=metric&lat="+lat+"&lon="+lon,
		type: "GET",dataType: 'jsonp',
		crossDomain: true
	}).done(function ( data ) {
		if(data) {
			var temp = data.main.temp;
			var airpress = data.main.pressure; //hPa
			
			var wind_strength = data.wind.speed;
			var wind_direction = dagreeToSkyDir(data.wind.deg);//degree

			var clouds = percentToCloud(data.clouds.all);//Percent
			var rain = 1;
			if(data.rain){ //mm per 3 Hour
				rain = mm3ToMM(data.rain);
			}else if(data.snow){
				rain =  mm3ToMM(data.snow);
			}			
			
			var wave_direction = 1;
			var whight = 0;
			
			var urlString = "trip="+currentTripToLog+"&wId=&temp="+temp+"&airpress="+airpress+"&wind_strength="+wind_strength+"&whight="+whight+"&clouds="+clouds+"&rain="+rain+"&wind_direction="+wind_direction+"&wave_direction="+wave_direction;
			handleWeatherForm(urlString, true);
		}
	});
}

function dagreeToSkyDir(deg){
	if(deg > 337 || deg <= 22) return 2;
	else if(deg > 22 && deg <= 67) return 6;
	else if(deg > 67 && deg <= 112) return 3;
	else if(deg > 12 && deg <= 157) return 8;
	else if(deg > 157 && deg <= 202) return 4;
	else if(deg > 202 && deg <= 247) return 9;
	else if(deg > 247 && deg <= 292) return 5; 
	else if(deg > 292 && deg <= 337) return 7; 
	return 1;
}

function mm3ToMM(mm){
	mm /= 3;
	if(mm < 0.5) return 2;
	if(mm < 4) return 3;
	if(mm < 10) return 4;
	else return 5;
}

function percentToCloud(perc){
	return 1;
}