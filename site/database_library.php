<?php

// get select options for form
function get_select_options($host, $username, $password, $database_name, $query) {
    connect_database($host, $username, $password, $database_name);
    $result = mysql_query($query);
    while ($row = mysql_fetch_array($result)) {
        echo "<option value=\"" . $row[0] . "\">" . $row[1] . "</option>";
    }
}

// connect to database
function connect_database($host, $username, $password, $database_name) {
    $con = mysql_connect($host, $username, $password) or die("Connection Error: " . mysql_error());
    mysql_select_db($database_name, $con);
}
?>

