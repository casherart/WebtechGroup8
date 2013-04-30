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
		  type: "GET",
		  url: "app_weather_insert.php",
		  data: $(formular).serialize(),
		  dataType: "html",
		  error: function(){}
		}).done(function( jsonData ) {
			try{
				jsonData = $.parseJSON(jsonData);
			}catch(e){
				console.error(jsonData);
			}
			if(jsonData.status != "ok"){
				showAlert("error", "Something went horrible wrong!");
			}else{
				addWeatherToTable(jsonData.id);
				showAlert("success", "Your weather data has been stored and are now visible in table below.");				
			}
		});
	}
	return false;
}


function addWeatherToTable(weather_id){
	var tr = document.getElementById("wTR_"+weather_id)
	if(!tr){
		tr = document.createElement("tr");
		tr.id = "wTR_"+weather_id;
		tr.className = "selectable";	
		$("#weather_entries").append(tr);	
	}else{
		$("#wTR_"+weather_id).empty();
		console.log(tr);
	}
	
	var td = document.createElement("td");
	td.style.colspan = weatherTableColCount;
	var img = document.createElement("img");
	img.src="../img/icons/ajax-loader.gif";
	
	td.appendChild(img);
	tr.appendChild(td);
	
	if($.isNumeric(weather_id)){
		$.ajax({
			type: "GET",
			url: "app_weather_load.php?wID="+weather_id		
		}).done(function(jsonData){	
			jsonData = $.parseJSON(jsonData);
			if(jsonData.status != "ok"){
				$("#wTR_"+jsonData.weather_id).html("<td colspan='"+weatherTableColCount+"'>Error when loading Data!</td>");
			}else{
				var tr = $("#wTR_"+weather_id);
				tr.html("");
				var td_temperatur= document.createElement("td");				
				td_temperatur.innerHTML = jsonData.temperature;
				tr.append(td_temperatur);
				
				var td_airpreasure = document.createElement("td");				
				td_airpreasure.innerHTML = jsonData.airpreasure;
				tr.append(td_airpreasure);
				
				var td_wind_strength = document.createElement("td");				
				td_wind_strength.innerHTML = jsonData.wind_strength;
				tr.append(td_wind_strength);
				
				var td_wind_direction = document.createElement("td");				
				td_wind_direction.innerHTML = jsonData.wind_direction;
				tr.append(td_wind_direction);
				
				var td_wave_height = document.createElement("td");				
				td_wave_height.innerHTML = jsonData.wave_height;
				tr.append(td_wave_height);
				
				var td_wave_direction = document.createElement("td");				
				td_wave_direction.innerHTML = jsonData.wave_direction;
				tr.append(td_wave_direction);
				
				var td_clouds = document.createElement("td");
				td_clouds.innerHTML = jsonData.clouds;
				tr.append(td_clouds);
				
				var td_rain = document.createElement("td");
				td_rain.innerHTML = jsonData.rain;
				tr.append(td_rain);
				
				var td_button = document.createElement("td");
				var buttonDiv = document.createElement("div");
				buttonDiv.className = "btn-group";
				
				var button_view = document.createElement("a");
				button_view.className = "btn btn-small view";
				button_view.id = "viewWeatherDetails_"+weather_id;
				var button_view_span = document.createElement("span");
				var button_view_i = document.createElement("i");
				button_view_i.className = "icon-eye-open";
				button_view_span.appendChild(button_view_i);
				button_view.appendChild(button_view_span);
				buttonDiv.appendChild(button_view);

				$(button_view).click(function(){
					weatherDataToForm(weather_id);
				});
				
				var button_remove = document.createElement("a");
				button_remove.className = "btn btn-small remove";
				button_remove.id = "removeWeatherDetails_"+weather_id;				
				var button_remove_span = document.createElement("span");
				var button_remove_i = document.createElement("i");
				button_remove_i.className = "icon-remove";
				button_remove_span.appendChild(button_remove_i);
				button_remove.appendChild(button_remove_span);
				buttonDiv.appendChild(button_remove);
				
				$(button_remove).click(function(){
					removeWeatherData(weather_id);
				});
				
				td_button.appendChild(buttonDiv)
				tr.append(td_button);
			}			
		});
	}
}

function weatherDataToForm(weather_id){
	$.ajax({
		type: "GET",
		url: "app_weather_load.php?wID="+weather_id		
	}).done(function(jsonData){	
		jsonData = $.parseJSON(jsonData);
		if(jsonData.status != "ok"){
			$("#wTR_"+jsonData.weather_id).html("<td colspan='"+weatherTableColCount+"'>Error when loading Data!</td>");
		}else{
			console.log(jsonData);
			var form = $("#appForm");
			$("#temp").val(jsonData.temperature);
			$("#airpress").val(jsonData.airpreasure);
			$("#whight").val(jsonData.wave_height);
			

			$("#windstr").val(jsonData.windStrId);
			$("#cloud").val(jsonData.cloudsId);
			$("#rain").val(jsonData.rainId);
			$("#winddir").val(jsonData.windDirId);
			$("#wavedir").val(jsonData.waveDirId);
			$("#wId").val(weather_id);
		}
	});
}


function removeWeatherData(weather_id){
	if(!confirm('Do you realy want to remove this entry')){
		return false;
	}
	
	if($.isNumeric(weather_id)){
		$.ajax({
			type: "GET",
			url: "app_weather_delete.php?wID="+weather_id		
		}).done(function(jsonData){	
			console.log(jsonData);
			jsonData = $.parseJSON(jsonData);
			if(jsonData.status != "ok"){
				showAlert("error", "The Entry may be deleted or may be not.")
			}else{
				$("#wTR_"+weather_id).remove();			
				showAlert("success", "The Entry has been deleted successfully.");
			}
		});
	}
}


function showAlert(className, text){
	
	$('#dialogTitle').text(className.toUpperCase());
	$('#dialogMessage').text(text);
	$('#messageBox').modal('show');
}
