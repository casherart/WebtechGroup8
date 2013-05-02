
var weatherLogIntervall = null;
var inserTimeMin = 15*1000*60; //value in ms -> time x 6000 = Minut.

var startWeatherlogging(){
	weatherLogIntervall = window.setInterval("addWeatherForPosition()", inserTimeMin);
}

var endWeatherlogging(){
	window.clearInterval(weatherLogIntervall);
}

function addWeatherForPosition(time){
	/*
	 * get Weather data from Position and create urlString with correct data.
	 */
	
	var lat = 0;
	var lon = 0;
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
		url: "api.openweathermap.org/data/2.5/weather?units=metric&lat=+"lat"+&lon="+lon,
	}).done(function ( data ) {
		if(data) {
			
			var temp = data.main.temp;
			var airpress = data.main.pressure; //hPa
			
			var wind_strength = data.wind.speed;
			var wind_direction = dagreeToSkyDir(data.wind.deg);//degree

			var clouds = percentToCloud(data.clouds.all);//Percent	
			var rain = mm3ToMM(data.rain && data.rain.3h || data.snow && data.snow.3h);//mm per 3 Hour
			
			var wave_direction = 0;
			var whight = 0;
			
			var urlString = "wId=&temp="+temp+"&airpress="+airpress+"&wind_strength="+wind_strength+"&whight="+whight+"&clouds="+clouds+"&rain="+rain+"&wind_direction="+wind_direction+"&wave_direction="+wave_direction;
			handleWeatherForm(urlString, false);
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
	return 0;
}

function mm3ToMM(mm){
	mm /= 3;
	if(mm < 0.5) return 2;
	if(mm < 4) return 3;
	if(mm < 10) return 4;
	else return 5;
}

function percentToCloud(perc){
	return 0;
}