<?php

/**
 * @author kouta
 * @copyright 2013
 */

include_once '../fonctions/connec.inc.php';
include_once '../fonctions/requetes.php';	
    //recuperation de la données envoyée en parametre
    $code = isset($_GET['code'])?$_GET['code']:""; 
	//$select = "SELECT DISTINCT `PERS_ID` FROM `valeur` where `ENQ_ID`='$code'";
    $result=select_enqueteur($code);
    if($result){
        echo "<ul>";
        while($row=mysql_fetch_row($result)){
            $pcod=$row[0];
            $rowp=mysql_fetch_row(select_personnel($pcod));
            $nom = $rowp[2];
            $prenom= $rowp[3];
            ?>
            <li><a onclick='fnClickOpen(<?php echo $pcod; ?>)' style="cursor: pointer;"><?php echo "$nom $prenom"; ?></a></li>
            <?php
        }
        echo "</ul>";
    }else{
        echo "Aucun Résultat";
    }

?>