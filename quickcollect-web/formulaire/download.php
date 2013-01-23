<?php
/**
 * @author QuickCollect
 * @copyright 2012
 */
?>
<?php  
//$file = "fichier.xml";
$file = $_GET['fichier'];
// Test to ensure that the file exists. 
if(!file_exists($file)) die("Désolé, le fichier n'existe pas.");
header("Content-disposition: attachment; filename=$file");
header("Content-Type: application/force-download");
header("Content-Transfer-Encoding: binary");
header("Content-Length: ".filesize($file));
header("Pragma: no-cache");
header("Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0");
header("Expires: 0");
set_time_limit(0);
readfile($file); 

?>