<?php 
	sleep ( 10 );
	$rand = rand(0, 100);
	$msg = "<b>Aktuell keine Wetterwarnungen</b>";
	if($rand > 90){
		$msg = "<b>Starke Gewitter:</b> In Verbindung mit Sturmböen, schweren Sturmböen, Starkregen oder Hagel";
	}else if($rand > 80){
		$msg = "<b>Eisglätte:</b> Durch überfrierende Nässe nach starker Taubildung, durch sehr starke Reifablagerungen oder bei vorhandener frischer Schneedecke";
	}else if($rand > 75){
		$msg = "<b>Warnung vor Dauerregen:</b> In Teilen Süddeutschlands noch schauerartige Regenfälle. ";
	}else if($rand > 70){
		$msg = "<b>Warnung vor Wind- und Sturmböen:</b> Überlinger und Untersee starke bis stürmische Böen aus Nordwesten bis Norden. Dabei Böen 7 Bft (um 55 km/h), am Untersee und in Hochlagen auch 8 Bft (um 70 km/h). ";
	}
	echo '{"warningLevel":'.$rand.',"msg":"'.$msg.'","timestamp":"'.date('U').'"}'
?>