<?php
header("Content-type: application/javascript");

$fn = "data/Practical_Demonkeeping_Ch01.txt";

$f = file($fn);

echo("timeline = [");
for($i=1;$i<count($f);$i++){
	list($start,$end,$dur) = explode("\t",trim($f[$i]));
	$comma = ($i==count($f)-1) ? "" : ",";
	echo("{start:'" . $start . "',end:'" . $end . "',dur:'" . $dur . "'}" . $comma);
}
echo("]");



?>

