$(function() {

    function loadEntry(id) {

        jQuery.get("app_weather_load.php", {'id': id}, function(data) {

            $('#temperatur').val(data['temperatur']);
            $('#airpreasure').val(data['airpreasure']);
            $('#wind_strength').val(data['wind_strength']);
            $('#wind_direction').val(data['wind_direction']);
            $('#wave_height').val(data['wave_height']);
            $('#wave_direction').val(data['wave_direction']);
            $('#clouds').val(data['clouds']);
            $('#rain').val(data['rain']);
        }, "json");
    }

    function addEntry(id, json) {

        var entry = "";

        entry += "<tr class='selectable' id='" + id + "'>";
        entry += "<td>" + json.temperatur + "</td>";
        entry += "<td>" + json.airpreasure + "</td>";
        entry += "<td>" + json.wind_strength + "</td>";
        entry += "<td>" + json.wind_direction + "</td>";
        entry += "<td>" + json.wave_height + "</td>";
        entry += "<td>" + json.wave_direction + "</td>";
        entry += "<td>" + json.clouds + "</td>";
        entry += "<td>" + json.rain + "</td>";
        entry += "<td style='width:30px; text-align:left;'><div class='btn-group'>";
        entry += "<a class='btn btn-small view' id='" + id + "'><span><i class='icon-eye-open'></i></span></a>";
        entry += "<a class='btn btn-small remove' id='" + id + "'><span><i class='icon-remove'></i></span></a>";
        entry += "</div></td>";
        entry += "</tr>";

        $('#entries').append(entry);
    }

    $('a.view').live("click", function(event) {
        loadEntry($(this).attr('id'));
    });

    $('a.remove').live("click", function(event) {
        var buttonID = this;
        var boatnr = $(this).attr('id');
        jQuery.post("app_weather_delete.php", {"bnr": boatnr}, function(data) {

            if (data['bnr'].match(/Error/)) {

                $('#dialogTitle').text('Error');
                $('#dialogMessage').text(data['bnr'].replace(/Error: /, ""));

            } else {

                $(buttonID).parents('tr').remove();

                $('#dialogTitle').text('Succes');
                $('#dialogMessage').text("Eintrag wurde erfolgreich gelöscht.");
            }

            $('#messageBox').modal('show');
        }, "json");
    });

    $('#save').click(function(event) {

        event.preventDefault();

        var json = {
            "temperatur": $('#temperatur').val(),
            "airpreasure": $('#airpreasure').val(),
            "wind_strength": $('#wind_strength').val(),
            "wind_direction": $('#wind_direction').val(),
            "wave_height": $('#wave_height').val(),
            "wave_direction": $('#wave_direction').val(),
            "clouds": $('#clouds').val(),
            "rain": $('#rain').val(),
        };

        jQuery.post("app_weather_insert.php", json, function(data) {

            if (data['bnr'].match(/Error/)) {

                $('#dialogTitle').text('Error');
                $('#dialogMessage').text(data['bnr'].replace(/Error: /, ""));

            } else {

                addEntry(data['bnr'], json);

                $('#dialogTitle').text('Success');
                $('#dialogMessage').text("Eintrag wurde erfolgreich gespeichert.");
            }

            $('#messageBox').modal('show');

        }, "json");

    });

});

