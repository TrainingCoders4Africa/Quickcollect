<?php
    session_start();

	//require_once 'fonctions/connec.inc.php';
	
	require('./fonctions.php');
	
	//include('./fonctions.php');
	
	//Etablissons la connexion au serveur de base de donnees
	$con=new health();
	$con->Connexion();

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Fonction</title>

<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">



<style type="text/css">
<!--
.rouge {	color: #F00;
}
-->
</style>
</head>

<body>
<form class="form-inline well" id="form1" name="form1" method="post" action="fichier.php?action=insertionfct">
  <table width="411" border="0" align="center">
    <tr>
      <td colspan="2"><div align="center">Enregistrement Fonction</div></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><?php if($_GET['valid'] != null){if($_GET['valid'] == 'vrai'){ echo "Insertion reussie"; } else{ echo "Insertion non reussie"; } }?></td>
    </tr>
    <tr>
      <td width="108"> <label for="fct">Nom fonction <span class="rouge">*</span></label></td>
      <td width="293"><input  required= "true" name="fct" type="text" id="fct" /></td>
    </tr>
    <tr>
      <td colspan="2"><div align="center">
        <input class="btn btn-primary btn-large" type="submit" value="Enregistrer" name="valider" id="valider"/>
        <input class="btn btn-primary btn-large" type="reset" value="Effacer" name="effacer" id="effacer"/>
      </div></td>
    </tr>
  </table>
</form>
<p><a href="index.html"><img src="images/upcoming-work.png" width="32" height="32" /></a></p>
<table width="456" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" align="center" bgcolor="#CCCCCC">Liste des fonction</td>
  </tr>
  <tr bgcolor="#5398FF">
    <td width="175"><span class="sxsqxsqx">Nom Fonction</span></td>
    <td width="281" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr>
    <?php
	
	

	$resultat=$con->Execute("Select FONC_ID, FONC_LIB from  fonction");


    while($info = mysql_fetch_array($resultat))
	{
	 
	  ?>
    <td><?php  echo $info['FONC_LIB']; ?></td>
    <td>modifier</td>
  </tr>
  <?php
		 }	

		/* mysql_free_result($resultat); 
	    mysql_close(); 
		*/
		?>
</table>
<p>&nbsp;</p>
</body>
</html>
