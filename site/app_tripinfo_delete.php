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
	settype($_GET['wnr'], 'integer');
	$sql = "DELETE FROM seapal.wegpunkte WHERE wnr = " . $_POST['wnr'] . ";";
	
	$result = mysql_query($sql, $conn);
	
	if (!$result) {
	    $err = array( "wnr" => 'Error: ' . mysql_error() );
	    echo json_encode($err);
	    exit;
	}
		
	$bnr = array( "wnr" => 'ok');
	
	echo json_encode($bnr);
		
	mysql_close($conn);

?>