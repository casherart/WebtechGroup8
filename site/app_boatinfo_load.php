<?php
require_once ('db_configuration.php');

	$conn = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PW);
	
	$db_selected = mysql_select_db(MYSQL_DB, $conn);
	
	if (!$db_selected) {
	    die('Error: ' . mysql_error());
	}

	/*
	 * Some SQL-Injektion Protection
	*/
	settype($_GET['bnr'], 'integer');
	$sql = "SELECT * FROM seapal.bootinfo WHERE bnr = '" . $_GET['bnr'] . "';";
	
	$result = mysql_query($sql, $conn);
	
	if (!$result) {
	    die('Error: ' . mysql_error());
	}
	
	$row = mysql_fetch_array($result);
	
	echo json_encode($row);
	
	mysql_free_result($result);
	
	mysql_close($conn);

?>