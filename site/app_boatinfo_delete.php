<?php
require_once ('db_configuration.php');
?>
<?php

	$conn = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PW);
	
	$db_selected = mysql_select_db(MYSQL_DB, $conn);
	
	if (!$db_selected) {
	    $err = array( "bnr" => 'Error: ' . mysql_error() );
	    echo json_encode($err);
	    exit;
	}
	/*
	 * Some SQL-Injektion Protection
	 */
	settype($_POST['bnr'], 'integer');
	$sql = "DELETE FROM ". MYSQL_DB .".bootinfo WHERE bnr = " . $_POST['bnr'] . ";";
	
	$result = mysql_query($sql, $conn);
	
	if (!$result) {
	    $err = array( "bnr" => 'Error: ' . mysql_error() );
	    echo json_encode($err);
	    exit;
	}
	
	$bnr = array( "bnr" => 'ok');
	
	echo json_encode($bnr);
	
	mysql_close($conn);

?>
                       
