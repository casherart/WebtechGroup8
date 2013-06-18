/*
 * checks and sends form
 */
var weatherTableColCount = 10;
function validate_handleWeatherForm(formularData){

    var datas = formularData.split("&"); 
    var formOK = true;
    datas.shift();
    datas.shift();
    var i = 1;    
    while(datas.length !== 0 ){

       var check = true;
       var tmp = datas.shift();
       var CheckNaN = parseFloat(tmp.substring(tmp.indexOf("=")+1,tmp.length));
       var id = tmp.substring(0,tmp.indexOf("="));
       
       //if empty          or nothing selected
       if(isNaN(CheckNaN) || (CheckNaN === 1 && i>2 && i !== 6 && i !== 4) ){
            check = false;
            
        }
        //no neg. numbers and no 0 pascal
        if((i>1 && i<5 && CheckNaN < 0  )|| (i ===2 && CheckNaN<=0 )){ 
                check = false;
        }
         // transform name to id
        switch (id) {
            case "wind_strength":
                id = "windstr";
                break;
            case "clouds":
                id = "cloud";
                break;
            case "wind_direction":
                id = "winddir";
                break;
            case "wave_direction":
                id = "wavedir";
                break;

            default:
                //do nothing
                break;
        }
        
        
        // alert
        if(check){
            console.log(i,true,id);
        	$("#"+id).parents(".control-group").removeClass("error");
        }else{
             console.log(i, false,id);
        	formOK = false;
        	$("#"+id).parents(".control-group").addClass("error");
        }
        i++;

    }
    return formOK;
}

function handleWeatherForm(formularData, showMessage) {
    $("#save").val("Speichern");
    var showMessage = showMessage || true;
    //TODO check entries
   
        $.ajax({
            type: "GET",
            url: "app_weather_insert.php",
            data: formularData,
            dataType: "html",
            error: function() {
            }
        }).done(function(jsonData) {
            try {
                jsonData = $.parseJSON(jsonData);
            } catch (e) {
                console.error(jsonData);
            }
            if (showMessage) {
                if (jsonData.status != "ok") {
                    showAlert("error", "OHHHH Entschuldigung! Da lief wohl etwas gewaltig schief");
                } else {
                    addWeatherToTable(jsonData.id, true);
                    showAlert("Erfolgreich", "Ihre Wetterdaten wurden gespeichert und in die untere Tabelle aufgenommen.");
                }
            }
        });
    
    return false;
}



function addWeatherToTable(weather_id, newItem) {
    var newItem = newItem || false;
    var tr = document.getElementById("wTR_" + weather_id)
    if (!tr) {
        tr = document.createElement("tr");
        tr.id = "wTR_" + weather_id;
        tr.className = "selectable";
        $("#weather_entries").append(tr);
    } else {
        $("#wTR_" + weather_id).empty();
    }
    
        if(newItem){
	    $(tr).mouseover(function() {
	        $(this).removeClass("success");
	    });
	    $(tr).addClass("success");
	}

    var td = document.createElement("td");
    td.style.colspan = weatherTableColCount;
    var img = document.createElement("img");
    img.src = "../img/icons/ajax-loader.gif";

    td.appendChild(img);
    tr.appendChild(td);

    if ($.isNumeric(weather_id)) {
        $.ajax({
            type: "GET",
            url: "app_weather_load.php?wID=" + weather_id
        }).done(function(jsonData) {
            jsonData = $.parseJSON(jsonData);
            if (jsonData.status != "ok") {
                $("#wTR_" + jsonData.weather_id).html("<td colspan='" + weatherTableColCount + "'>Fehler beim laden der Daten!</td>");
            } else {
                var tr = $("#wTR_" + weather_id);
                tr.html("");

                var td_trip = document.createElement("td");
                td_trip.innerHTML = jsonData.trip;
                tr.append(td_trip);

                var td_temperatur = document.createElement("td");
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
                button_view.id = "viewWeatherDetails_" + weather_id;
                var button_view_span = document.createElement("span");
                var button_view_i = document.createElement("i");
                button_view_i.className = "icon-eye-open";
                button_view_span.appendChild(button_view_i);
                button_view.appendChild(button_view_span);
                buttonDiv.appendChild(button_view);

                $(button_view).click(function() {
                    weatherDataToForm(weather_id);
                });

                var button_remove = document.createElement("a");
                button_remove.className = "btn btn-small remove";
                button_remove.id = "removeWeatherDetails_" + weather_id;
                var button_remove_span = document.createElement("span");
                var button_remove_i = document.createElement("i");
                button_remove_i.className = "icon-remove";
                button_remove_span.appendChild(button_remove_i);
                button_remove.appendChild(button_remove_span);
                buttonDiv.appendChild(button_remove);

                $(button_remove).click(function() {
                    removeWeatherData(weather_id);
                });

                td_button.appendChild(buttonDiv)
                tr.append(td_button);
            }
        });
    }
}

function weatherDataToForm(weather_id) {
    $.ajax({
        type: "GET",
        url: "app_weather_load.php?wID=" + weather_id
    }).done(function(jsonData) {
        jsonData = $.parseJSON(jsonData);
        if (jsonData.status != "ok") {
            $("#wTR_" + jsonData.weather_id).html("<td colspan='" + weatherTableColCount + "'>Fehler beim laden der Daten!</td>");
        } else {
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
            $("#save").val("Aktualisieren");
        }
    });
}


function removeWeatherData(weather_id) {

    if ($.isNumeric(weather_id)) {
        $.ajax({
            type: "GET",
            url: "app_weather_delete.php?wID=" + weather_id
        }).done(function(jsonData) {
            console.log(jsonData);
            jsonData = $.parseJSON(jsonData);
            if (jsonData.status != "ok") {
                showAlert("error", "Der Eintrag wurde vielleicht gelöscht, vielleicht auch nicht.")
            } else {
                $("#wTR_" + weather_id).remove();
                showAlert("Erfolgreich", "Der Eintrag wurde erfolgreich gelöscht");
            }
        });
    }
}


function showAlert(className, text) {

    $('#dialogTitle').text(className.toUpperCase());
    $('#dialogMessage').text(text);
    $('#messageBox').modal('show');
}
