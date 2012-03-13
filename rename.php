<?php

$dir = "./audio";

if (is_dir($dir)) {
    if ($dh = opendir($dir)) {
        while (($file = readdir($dh)) !== false) {         
		if ($file != "." && $file != ".."){
			$f = preg_replace("/(Ch_)/","Ch",$file);
			$f = preg_replace("/,/","",$f);
			//rename("./".$dir."/".$file, "./".$dirls."/".$f);
		}
        }
        closedir($dh);
    }
}


?>

