<?php
    require_once ('db_configuration.php');

	$conn = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PW);
	
	$db_selected = mysql_select_db(MYSQL_DB, $conn);
	
	if (!$db_selected) {
	    $err = array( "tnr" => 'Error: ' . mysql_error() );
	    echo json_encode($err);
	    exit;
	}

	/*
	 * Some SQL-Injektion Protection
	*/
	settype($_POST['tank'], 'integer');
	$sql = "INSERT INTO " . MYSQL_DB . ".tripinfo (titel, von, nach, skipper, crew, tstart, tende, tdauer, motor, tank) VALUES (
				'" . $_POST['titel'] . "',
				'" . $_POST['von'] . "',
				'" . $_POST['nach'] . "',
				'" . $_POST['skipper'] . "',
				'" . $_POST['crew'] . "',
				'" . $_POST['tstart'] . "',
				'" . $_POST['tende'] . "',
				'" . $_POST['tdauer'] . "',
				'" . $_POST['motor'] . "',
				" . $_POST['tank'] . ");";
	
	$result = mysql_query($sql, $conn);
	
	if (!$result) {
	    $err = array( "tnr" => 'Error: ' . mysql_error() );
	    echo json_encode($err);
	    exit;
	}
	
	$result = mysql_query("SHOW TABLE STATUS LIKE 'tripinfo'");
	
	if (!$result) {
	    $err = array( "tnr" => 'Error: ' . mysql_error() );
	    echo json_encode($err);
	    exit;
	}
	
	$row = mysql_fetch_array($result);
	
	$nextId = $row['Auto_increment'];
	
	$tnr = array( "tnr" => "" . ($nextId-1) );
	
	echo json_encode($tnr);
	
	mysql_free_result($result);
	
	mysql_close($conn);

?>