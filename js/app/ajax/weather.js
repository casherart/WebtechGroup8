/*
 * checks and sends form
 */
var weatherTableColCount = 10;


function handleWeatherForm(formular){
	var isOK = true;
	//TODO check entries
	
	
	if(!isOK){
		alert("please verify entered Data");
	}else{
		$.ajax({
		  type: "POST",
		  url: "app_weather_insert.php",
		  data: $(formular).serialize(),
		  dataType: "html",
		  error: function(){}
		}).done(function( jsonData ) {
			jsonData = $.parseJSON(jsonData);
			if(jsonData.status != "ok"){
				showAlert("error", "<strong>ERROR!</strong> Something went horrible wrong!")
			}else{
				addWeatherToTable(jsonData.weather_id);
				showAlert("success", "<strong>Success!</strong> Your weather data has been stored and are now visible in table below.")
				
			}
		});
	}
	return false;
}


function addWeatherToTable(weather_id){
	var tr = document.createElement("tr");
	tr.id = "wTR_"+weather_id;
	tr.className = "selectable";
	
	var td = document.createElement("td");
	td.style.colspan = weatherTableColCount;
	var img = document.createElement("img");
	img.src="load";//TODO
	
	td.appendChild(img);
	tr.appendChild(td);
	$("#weather_entries").append(tr);
	
	if($.isNumeric(weather_id)){
		$.ajax({
			type: "GET",
			url: "app_weather_load.php?wID="+weather_id		
		}).done(function(jsonData){
			//jsonData = $.parseJSON(jsonData);
			console.log(jsonData);
			if(jsonData.status != "ok"){
				$("#wTR_"+jsonData.weather_id).html("<td colspan='"+weatherTableColCount+"'>Error when loading Data!</td>");
			}else{
				var tr = $("#wTR_"+weather_id);
				tr.children.remove();
				var td_temperatur= document.createElement("td");				
				td_temperatur.innerText = json.temperatur;
				tr.append(td_temperatur);
				
				var td_airpreasure = document.createElement("td");				
				td_airpreasure.innerText = json.airpreasure;
				tr.append(td_airpreasure);
				
				var td_wind_strength = document.createElement("td");				
				td_wind_strength.innerText = json.wind_strength;
				tr.append(td_wind_strength);
				
				var td_wind_direction = document.createElement("td");				
				td_wind_direction.innerText = json.wind_direction;
				tr.append(td_wind_direction);
				
				var td_wave_height = document.createElement("td");				
				td_wave_height.innerText = json.wave_height;
				tr.append(td_wave_height);
				
				var td_wave_direction = document.createElement("td");				
				td_wave_direction.innerText = json.wave_direction;
				tr.append(td_wave_direction);
				
				var td_clouds = document.createElement("td");
				td_clouds.innerText = json.clouds;
				tr.append(td_clouds);
				
				var td_rain = document.createElement("td");
				td_rain.innerText = json.rain;
				tr.append(td_rain);
				
				var td_button = document.createElement("td");
				var buttonDiv = document.createElement("div");
				buttonDic.className = "btn-group";
				
				var button_view = document.createElement("a");
				button_view.className = "btn btn-small view";
				button_view.id = "viewWeatherDetails_"+weather_id;
				var button_view_span = document.createElement("span");
				var button_view_i = document.createElement("i");
				button_view_i.className = "icon-eye-open";
				button_view_span.appendChild(button_view_i);
				button_view.appendChild(button_view_span);
				buttonDiv.appendChild(button_view);
				
				
				var button_remove = document.createElement("a");
				button_remove.className = "btn btn-small view";
				button_remove.id = "viewWeatherDetails_"+weather_id;
				var button_remove_span = document.createElement("span");
				var button_remove_i = document.createElement("i");
				button_remove_i.className = "icon-eye-open";
				button_remove_span.appendChild(button_remove_i);
				button_view.appendChild(button_remove_span);
				buttonDiv.appendChild(button_view);
				
				td_button.appendCild(buttonDiv)
				tr.append(td_button);
			}			
		});
	}
}

function showAlert(className, text){
	var alertDiv = document.getElementById("alertDiv") || document.createElement("div");
	alertDiv.id = "alertDiv";
	alertDiv.className = "alert alert-"+className;
	alertDiv.innerHTML = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button><span>"+text+"</span></div>";
	$("#appForm").prepend(alertDiv);
}
