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
	settype($_POST['tnr'], 'integer');
	$sql = "DELETE FROM " . MYSQL_DB .".tripinfo WHERE tnr = " . $_POST['tnr'] . ";";
	
	$result = mysql_query($sql, $conn);
	
	if (!$result) {
	    $err = array( "tnr" => 'Error: ' . mysql_error() );
	    echo json_encode($err);
	    exit;
	}
		
	$bnr = array( "tnr" => 'ok');
	
	echo json_encode($bnr);
		
	mysql_close($conn);

?>