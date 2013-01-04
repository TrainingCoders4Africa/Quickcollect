<?php 
session_start();
require('fonctions.php');
$mode = $_GET['action'];

// Etablir la connexion au serveur de la base de donnes
$con= new health();
$con->Connexion();

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//Identification compte
if($mode == 'connexion')
{
	//recuperation login et mot de passe
$login=isset($_POST['lg'])? $_POST['lg']:"";
	$mdp=isset($_POST['pwd'])? $_POST['pwd']:"";
	

	
	//$mdp=md5($mdp_nh);
	$req="SELECT * FROM utilisateur WHERE login = '".$login."' AND mdp = '".$mdp."' and profile= '127'";
	$res=mysql_query($req)or die('Erreur SQL!'.'$req'.'<br />'.mysql_error());
	if(mysql_num_rows($res)>0)
{
	header("location: index.html?valid=3276&dgggf=87&dff=fg65");
 
}
else
{
header("location: index2.php?valid=faut&dgggf=87&dff=fg65"); 
}
}


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//insertion fonction fonction
if($mode == 'insertionfct')
{
$nomfonction=$_POST['fct'];



$requete = "insert into fonction(FONC_LIB) values ('".$nomfonction."')";
$test = $con->Execute($requete);
if($test>0)
{
	header("location: fonction.php?valid=vrai&dgggf=87&dff=fg65");
 
}
else
{
header("location: fonction.php?valid=faut&dgggf=87&dff=fg65"); 
}
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//insertion fonction utilisateur
if($mode == 'insertionutilisateur')
{
$lg=$_POST['login'];
$pwd=$_POST['pwd'];
$idperson=$_POST['personnel'];
$profile=$_POST['fonction'];



$requete = "insert into utilisateur(login, mdp, PERS_ID, profile) values ('".$lg."', '".$pwd."', '".$idperson."', '".$profile."')";
$test = $con->Execute($requete);
if($test>0)
{
	header("location: utilisateur.php?valid=vrai");
 
}
else
{
header("location: utilisateur.php?valid=faut"); 
}
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//Modification utilisateur
if($mode == 'modifierutilisateur')
{
$lg=$_POST['login'];
$pwd=$_POST['pwd'];
$idperson=$_POST['idperson'];
$profile=$_POST['fonction'];



 $requete = "update  utilisateur set login = '".$lg."', mdp = '".$pwd."', PERS_ID = '".$idperson."', profile = '".$profile."' WHERE id_utilisateur = ".$_POST['idutil']."";
 
 $test = $con->Execute($requete);
if($test>0)
{
	header("location: modifier-utilisateur.php?valid=vrai&dghhf=54g&iduser=".$_POST['idutil']."");
 
}
else
{
header("location: modifier-utilisateur.php?valid=faut&dghhf=54g&".$_POST['idutil'].""); 
}
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//insertion fonction personnel
if($mode == 'insertionpersonnel')
{
	
	$nom=$_POST['nom'];
	$prenom=$_POST['prenom'];
	$tel=$_POST['tel'];
	$idfonction=$_POST['fonction'];
	$adresse=$_POST['adresse'];



$requete = "insert into personnel(PERS_NOM, PERS_PRENOM, PERS_TEL, PERS_ADDR) values ('".$nom."', '".$prenom."', '".$tel."', '".$adresse."')";
$test = $con->Execute($requete);
if($test>0)
{
	header("location: personnel.php?valid=Login");
 
}
else
{
header("location: personnel.php?valid=out"); 
}
	
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//Modification personnel
if($mode == 'modificationpersonnel')
{
	
	
	$nom=$_POST['nom'];
	$prenom=$_POST['prenom'];
	$tel=$_POST['tel'];
	$adresse=$_POST['adresse'];



    $requete = "update  personnel set PERS_NOM = '".$nom."', PERS_PRENOM = '".$prenom."', PERS_TEL = '".$tel."', PERS_ADDR = '".$adresse."' WHERE PERS_ID = ".$_GET['idperson']."";
$test = $con->Execute($requete);
if($test>0)
{
	header("location: modifier-personnel.php?valid=ok&idfour=".$_GET['idperson']."");
 
}
else
{
header("location: modifier-personnel.php?valid=non&idfour=".$_GET['idperson'].""); 
}
	
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>
