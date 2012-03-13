<?php

$dir = "./epub";


if (is_dir($dir)) {
    if ($dh = opendir($dir)) {
        while (($file = readdir($dh)) !== false) {           
			if ($file != "." && $file != ".."){
				echo($file . "<br />");
				//rename("./audio/".$file, "./audio/".$f);
			}
        }
        closedir($dh);
    }
}



?>

part02chapter02.xhtml

