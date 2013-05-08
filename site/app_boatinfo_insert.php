<?php
require_once ('db_configuration.php');

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
	settype($_POST['registernummer'], 'integer');
	settype($_POST['laenge'], 'integer');
	settype($_POST['breite'], 'integer');
	settype($_POST['tiefgang'], 'integer');
	settype($_POST['verdraengung'], 'integer');
	settype($_POST['baujahr'], 'integer');
	settype($_POST['tankgroesse'], 'integer');
	settype($_POST['wassertankgroesse'], 'integer');
	settype($_POST['abwassertankgroesse'], 'integer');
	settype($_POST['grosssegelgroesse'], 'integer');
	settype($_POST['genuagroesse'], 'integer');
	settype($_POST['spigroesse'], 'integer');
		
	$sql = "INSERT INTO ". MYSQL_DB .".bootinfo (bootname, registernummer, segelzeichen, heimathafen, yachtclub, eigner, versicherung,
			rufzeichen, typ, konstrukteur, laenge, breite, tiefgang, masthoehe, verdraengung, rigart,	
			baujahr, motor, tankgroesse, wassertankgroesse, abwassertankgroesse, grosssegelgroesse,
			genuagroesse, spigroesse) VALUES(
			 	'" . $_POST['bootname'] . "',
				" . $_POST['registernummer'] . ",
				'" . $_POST['segelzeichen'] . "',
				'" . $_POST['heimathafen'] . "',
				'" . $_POST['yachtclub'] . "',
				'" . $_POST['eigner'] . "',
				'" . $_POST['versicherung'] . "',
				'" . $_POST['rufzeichen'] . "',
				'" . $_POST['typ'] . "',
				'" . $_POST['konstrukteur'] . "',
				" . $_POST['laenge'] . ",
				" . $_POST['breite'] . ",
				" . $_POST['tiefgang'] . ",
				" . $_POST['masthoehe'] . ",
				" . $_POST['verdraengung'] . ",
				'" . $_POST['rigart'] . "',
				" . $_POST['baujahr'] . ",
				'" . $_POST['motor'] . "',
				" . $_POST['tankgroesse'] . ",
				" . $_POST['wassertankgroesse'] . ",
				" . $_POST['abwassertankgroesse'] . ",
				" . $_POST['grosssegelgroesse'] . ",
				" . $_POST['genuagroesse'] . ",
				" . $_POST['spigroesse'] . ");";
	
	$result = mysql_query($sql, $conn);
	
	if (!$result) {
	    $err = array( "bnr" => 'Error: ' . mysql_error() );
	    echo json_encode($err);
	    exit;
	}
	
	$result = mysql_query("SHOW TABLE STATUS LIKE 'bootinfo'");
	
	if (!$result) {
	    $err = array( "bnr" => 'Error: ' . mysql_error() );
	    echo json_encode($err);
	    exit;
	}
	
	$row = mysql_fetch_array($result);
	
	$nextId = $row['Auto_increment'];		
	
	$bnr = array( "bnr" => "" . ($nextId-1) );
	
	echo json_encode($bnr);
	
	mysql_free_result($result);
		
	mysql_close($conn);

?>