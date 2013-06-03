<?php 
	sleep ( 10 );
	$rand = rand(0, 100);
	$msg = "Keine Meldungen";
	if($rand > 90){
		$msg = "Heilige Sch...";
	}else if($rand > 75){
		$msg = "Windig";
	}
	echo '{"warningLevel":'.$rand.',"msg":"'.$msg.'","timestamp":"'.date('U').'"}'
?>