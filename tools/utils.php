<?php

ini_set('display_errors', 1); 

define("EPUB_EXT",			".epub");
define("EPUB_BASE", 		"../epub/");
define("EPUB_DB", 			"OEBPS/");
define("EPUB_MANIFEST", 	"/META-INF/container.xml" );
define("XSL_ROOTFILE", 		"./get_rootfile.xsl");
define("XSL_SPINE", 		"./get_spine.xsl");
define("XSL_SPINEOBJ", 		"./get_spine.xsl");
define("XSL_BODY", 			"./get_body.xsl");


function getIdFromFile($str){
	return trim(preg_replace("/".EPUB_EXT."/", "", $str));
}

function convert2Ref($str){
	return preg_replace("/\./","_",$str);
}

function removeFileExt($str){
	return preg_replace("/(\.).+/","",$str);
}

function transformDoc($xml_filename,$xsl_filename, $param){
	if (file_exists($xml_filename) && file_exists($xsl_filename)){
		$xp = new XsltProcessor();
		$xsl = new DomDocument;
		$xsl->load($xsl_filename);
		$xp->importStylesheet($xsl);
		$xml_dom = new DomDocument;
		@$xml_dom->load($xml_filename);

		if(isset($param)) $xp->setParameter('', 'ref', $param);
		return trim($xp->transformToXML($xml_dom));
	}
	else return null;
}

function addFile($id,$filename,$contents){
	$location = EPUB_BASE.$id."/".EPUB_DB.$filename;

	$f = fopen($location, 'w+');
	fwrite($f, $contents);

	return $location;
}


?>