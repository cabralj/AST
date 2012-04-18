
<?php

require_once("utils.php");

$dest_dir = "../epub/";

if( isset($_POST['upload']) ){
    if ($_FILES["file"]["error"] > 0){
            echo("Error Uploading File: " . $_FILES["file"]["error"]);
    }
    else {
        $orig_path = $_FILES["file"]["tmp_name"];
        $dest_path = "../epub/".$_FILES["file"]["name"];
        $id = getIdFromfile($_FILES["file"]["name"]);
        move_uploaded_file($orig_path, $dest_path);
        system('unzip -q -o ' . $dest_path . ' -d ' . $dest_dir.$id);
    }
}
else if ( isset($_POST['create']) ){

    $epub_id = $_POST['id'];

    $epub_rootfile = transformDoc(EPUB_BASE.$epub_id.EPUB_MANIFEST, XSL_ROOTFILE, null);
    $epub_spine = transformDoc(EPUB_BASE.$epub_id."/".$epub_rootfile, XSL_SPINE, null);
    $epub_parts = explode(",",trim($epub_spine));


    $script = "";
    $html = "";

    // Build an Array of references to the Epub XHTML Pages
    for ($i=0; $i<count($epub_parts); $i++){ 
        $xhtml = EPUB_BASE.$epub_id."/".EPUB_DB.$epub_parts[$i];
        $comma = ($i==(count($epub_parts)-1)) ? "" : ",";
        if (file_exists($xhtml) && !empty( $xhtml )){
            $script .= "\"".removeFileExt($epub_parts[$i]) . "\"".$comma;
        }
    }    

    // Compile all External XHTML pages into a single docuemnt.
    for ($i=0; $i<count($epub_parts); $i++){ 
        $xhtml = EPUB_BASE.$epub_id."/".EPUB_DB.$epub_parts[$i];
        if (file_exists($xhtml) && !empty($xhtml)){
            $ref = removeFileExt($epub_parts[$i]);
            $result = transformDoc($xhtml, XSL_BODY, $ref);
            $html .= "<h1>".$i."</h1>";
            $html .= $result;
            $html .= "<hr size=1 />";
        }
    }

    // Add Scripts for processing the pages and configuring the book object. 
    $html .= "<script>var epub_file_contents = [".$script."];</script>\n";
    $html .= "<script src=\"logic.js\"></script>";

    // Create a new file in the epub db directory.
    $file_created = addFile($epub_id, $epub_id.".html", $html);

    // Print out Complete Message
    echo("<a href='".$file_created."'>File: <b>".$epub_id.".html</b> has been created.</a>");

}





?>
<html>
<style>
input   {font-size:16px;font-family:Arial;}
div     {padding:5px;}
</style>
<body>

<div>
    <form action="extract.php" method="POST"> 
    <div><?php
        $handler = opendir($dest_dir); 
        while ($file = readdir($handler)) {
            if (preg_match ("/.epub$/i", $file)){
                echo '<input type="radio" name="id" value="' . getIdFromfile($file) . '" onclick="document.getElementById(\'create_but\').style.display=\'inline\';"> ' . $file . '</input><br />';
                echo("\n");
            }
        }
        closedir($handler);
     ?></div> 
     <div id="menu_div" style="display:inline">
        <input id="create_but" type="submit" name="create" value="Create Book" style="display:none"/> 
        <input id="add_but" type="button" value="Add" onclick="document.getElementById('upload_div').style.display='inline';document.getElementById('menu_div').style.display='none';document.getElementById('upload_button').style.display='none';" > 
    </div>
    </form>
</div>


<div id="upload_div" style="display:none">
    <form action="extract.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="file" id="file" onchange="document.getElementById('upload_button').style.display='inline';"/><br />
        
        <div id="upload_button" style="display:none">
            <input type="submit" name="upload" value="Upload and Extract" />
            <input type="button" value="Cancel"   onclick="document.getElementById('upload_div').style.display='none';document.getElementById('menu_div').style.display='inline';" >
        </div>

    </form>
</div>

</body>
</html>

