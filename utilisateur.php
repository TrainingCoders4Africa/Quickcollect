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

<body>
<form class="form-inline well" id="form1" name="form1" method="post" action="fichier.php?action=insertionutilisateur">
  <table width="411" border="0" align="center">
    <tr>
      <td colspan="2"><div align="center">Enregistrement Compte Utilisateur</div></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><?php if($_GET['valid'] != null){if($_GET['valid'] == 'vrai'){ echo "Insertion reussie"; } else{ echo "Insertion non reussie"; } }?></td>
    </tr>
    <tr>
      <td width="108">Personne <span class="rouge">*</span></td>
      <td width="293"><span class="shehese">
        <?php
	$resultat=$con->Execute("Select PERS_ID as id, PERS_PRENOM as libelle1, PERS_NOM as libelle2 from personnel ",$con);
    $con->AfficheZoneListe2('personnel',$resultat)//or mysql_error();
	  ?>
      </span></td>
    </tr>
    <tr>
      <td>Login <span class="rouge">*</span></td>
      <td><input  required= "true" name="login" type="text" id="login" /></td>
    </tr>
    <tr>
      <td>Mot de passe <span class="rouge">*</span></td>
      <td><input  required= "true" name="pwd" type="text" id="pwd" /></td>
    </tr>
    <tr>
      <td>Profile <span class="rouge">*</span></td>
      <td><span class="shehese">
        <?php
	$resultat=$con->Execute("Select FONC_ID as id,  FONC_LIB  as libelle from fonction",$con);
    $con->AfficheZoneListe('fonction',$resultat);
	  ?>
      </span></td>
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
<table width="778" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="5" align="center" bgcolor="#CCCCCC">Liste des utilisateur</td>
  </tr>
  <tr bgcolor="#5398FF">
    <td width="167" bgcolor="#5398FF"><span class="sxsqxsqx">Nom</span></td>
    <td width="144" bgcolor="#5398FF">Login</td>
    <td width="191" bgcolor="#5398FF">Mot de passe</td>
    <td width="198" bgcolor="#5398FF">Profile</td>
    <td width="198" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr>
    <?php
	
	

	$resultat=$con->Execute("Select id_utilisateur, login , mdp, PERS_ID, profile   from  utilisateur where profile != '127'");


    while($info = mysql_fetch_array($resultat))
	{
	 
	  ?>
    <td><?php  $pers=$con->Execute("Select PERS_ID, PERS_NOM, PERS_PRENOM, PERS_TEL, PERS_ADDR from personnel where PERS_ID  = '".$info['PERS_ID']."'"); $rst = mysql_fetch_array($pers); echo $rst['PERS_PRENOM'] ?> <?php echo $rst['PERS_NOM']; ?></td>
    <td><?php  echo $info['login']; ?></td>
    <td><?php  echo $info['mdp']; ?></td>
    <td><?php  $prof=$con->Execute("Select FONC_ID, FONC_LIB from fonction where FONC_ID  = '".$info['profile']."'"); $prors = mysql_fetch_array($prof); echo $prors['FONC_LIB'] ?> </td>
    <td><a href="modifier-utilisateur.php?iduser=<?php echo $info['id_utilisateur']; ?>"><img src="images/modifier.JPG" width="22" height="25" /></a></td>
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
