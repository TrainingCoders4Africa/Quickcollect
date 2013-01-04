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
<title>Utilisateur</title>

<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">



<style type="text/css">
<!--
.rouge {
	color: #F00;
}
-->
</style>
</head>
 <?php  
  //recuperation id du compte
  $iduser = $_GET['iduser'];
    //Recupere les valeurs a modifier
   $sql = "select id_utilisateur, login, mdp, PERS_ID, profile from utilisateur where  id_utilisateur ='".$iduser."'";
   
   $resultat1 = $con->Execute($sql)or @die(mysql_error());
   
    $info = mysql_fetch_array($resultat1)
	
    ?>
<body>
<form class="form-inline well" id="form1" name="form1" method="post" action="fichier.php?action=modifierutilisateur">
  <p><a href="utilisateur.php"><img src="images/upcoming-work.png" width="32" height="32" /></a></p>
  <p>&nbsp; </p>
  <table width="411" border="0" align="center">
    <tr>
   <?php  
     $sql2 = "select * from personnel where  PERS_ID ='".$info['PERS_ID']."'";
   
   $resultat2 = $con->Execute($sql2)or @die(mysql_error());
   
    $info2 = mysql_fetch_array($resultat2)
  ?>
    
      <td colspan="2"><div align="center">Modification compte <span id="bleu"><?php echo $info2['PERS_PRENOM']; ?></span><?php echo " "; ?><?php echo $info2['PERS_NOM']; ?></div></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><?php if($_GET['valid'] != null){if($_GET['valid'] == 'vrai'){ echo "Modification reussie"; } else{ echo "Modificationy non reussie"; } }?></td>
    </tr>
    <tr>
      <td width="108">Login <span class="rouge">*</span></td>
      <td width="293"><input name="login" type="text" id="login" value="<?php  echo $info['login']; ?>"  required= "true" /></td>
    </tr>
    <tr>
      <td>Mot de passe <span class="rouge">*</span></td>
      <td><input name="pwd" type="text" id="pwd" value="<?php  echo $info['mdp']; ?>"  required= "true" /></td>
    </tr>
    <tr>
      <td>Profile <span class="rouge">*</span></td>
      <td><span class="shehese">
        <?php
	$resultat3=$con->Execute("Select FONC_ID as id,  FONC_LIB  as libelle from fonction where FONC_ID='".$info['profile']."'",$con);
    $con->AfficheZoneListe('fonction',$resultat3);
	  ?>
      </span></td>
    </tr>
    <tr>
      <td colspan="2"><div align="center">
        <input class="btn btn-primary btn-large" type="submit" value="Modifier" name="valider" id="valider"/>
        <input name="idutil" type="hidden" id="idutil" value="<?php  echo $info['id_utilisateur']; ?>" />
        <input name="idperson" type="hidden" id="idperson" value="<?php  echo $info['PERS_ID']; ?>" />
      </div></td>
    </tr>
  </table>
</form>
<p><a href="utilisateur.php"></a></p>
<p>&nbsp;</p>
</body>
</html>
