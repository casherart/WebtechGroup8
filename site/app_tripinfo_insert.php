<?php
    require_once ('db_configuration.php');

	$conn = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PW);
	
	$db_selected = mysql_select_db(MYSQL_DB, $conn);
	
	if (!$db_selected) {
	    $err = array( "wnr" => 'Error: ' . mysql_error() );
	    echo json_encode($err);
	    exit;
	}

	/*
	 * Some SQL-Injektion Protection
	*/
	settype( $_POST['tnr'], 'integer');
	$sql = "INSERT INTO ". MYSQL_DB .".wegpunkte(tnr, name, btm, dtm, lat, lng, sog, cog, manoever, vorsegel, wdate, wtime, marker) VALUES (
				" . $_POST['tnr'] . ", 
				'" . $_POST['name'] . "',
				'" . $_POST['btm'] . "', 
				'" . $_POST['dtm'] . "',
				'" .$_POST['lat'] . "', 
				'" . $_POST['lng'] . "',
				'" . $_POST['sog'] . "', 
				'" . $_POST['cog'] . "', 
				'" . $_POST['manoever'] . "', 
				'" . $_POST['vorsegel'] . "', 
				'" . $_POST['wdate'] . "', 
				'" . $_POST['wtime'] . "', 
				'" . $_POST['marker'] . "');";
	
	$result = mysql_query($sql, $conn);
	
	if (!$result) {
	    $err = array( "wnr" => 'Error: ' . mysql_error() );
	    echo json_encode($err);
	    exit;
	}
	
	$result = mysql_query("SHOW TABLE STATUS LIKE 'wegpunkte'");
	
	if (!$result) {
	    $err = array( "wnr" => 'Error: ' . mysql_error() );
	    echo json_encode($err);
	    exit;
	}
	
	$row = mysql_fetch_array($result);
	
	$nextId = $row['Auto_increment'];
	
	$wnr = array( "wnr" => "" . ($nextId-1) );
	
	echo json_encode($wnr);
	
	mysql_free_result($result);
	
	mysql_close($conn);

?>