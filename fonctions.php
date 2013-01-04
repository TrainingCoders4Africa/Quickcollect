<?php 
error_reporting(~E_NOTICE);

class health{
// Creation d'une fonction qui retourne la source de connexion
 private $serveur='localhost';
 private  $utilisateur='root';
private  $motpasse='';
private  $base='bd_quick_collect';
private $handler;
	 function Connexion()
	{
	/*$this->serveur=$serveur;
	$this->utilisateur=$utilisateur;
	$this->motpasse=$motpasse;
	$this->base=$base;
	*/
		// connexion au serveuris
				$this->handler=mysql_pconnect($this->serveur,$this->utilisateur,$this->motpasse)or die(mysql_error());
                $con=$this->handler;
		//Controle et notification d'erreur en cas d'echec de la connexion

		if(!$con)
		{
		echo " La connexion au serveur ".$this->serveur." a échoué \n";
		exit;
		}/*else{
		echo 'connection  au serveur ok !<br />';
		}*/

		#Connexion à la base

		if(!mysql_select_db($this->base,$con))
		{
		echo " Impossible d'acceder a la base ".$this->base." \n Les erreurs suivantes se sont produites: \n".mysql_error($con);
		exit;
		}/*else{
		echo 'connection à la db '.$this->base.' ok !';
		}*/

		/* Si on arrive jusqu'ici c'est que tout s'est bien passé
		On retourne donc la connexion */

		return $con;

    }//fin de la fonction
	
	
public	function Execute($sql)
	{
	$this->Connexion();
		// Execution de la requete
		$resultat=mysql_query($sql);

		#Controle et notification d'erreur en cas d'echec
		if(!$resultat)
		{
		echo "/n Erreur dans l'execution de la requete ".$sql." /n Message de la base : /n";
		exit;
		}else{
		// Si tout se passe bien on retourne le resultat de la requete

		return $resultat;
}
    }//fin de la fonction
	
	
	
	
function AfficheZoneListe($type,$resultat)
	{
	// Cette fonction est consideree comme une procedure car elle ne retourne pas de resultat
	/* On cree dynamiquement une zone de liste $type a partir d un resultat $rs comprenant les champs 'id' et 'libelle'
	'id' represente la valeur du choix
	'libelle' represente la description du choix visible dans la zone de liste
	*/
		echo "<select Name='".$type."' >";

		while($objet=mysql_fetch_object($resultat))
		{
		   echo "<option value=".$objet->id." >".$objet->libelle."</option>";
        }

		echo "</select>";
	}


function AfficheZoneListe2($type,$resultat)
	{
	// Cette fonction est consideree comme une procedure car elle ne retourne pas de resultat
	/* On cree dynamiquement une zone de liste $type a partir d un resultat $rs comprenant les champs 'id' et 'libelle'
	'id' represente la valeur du choix
	'libelle' represente la description du choix visible dans la zone de liste
	*/
		echo "<select Name='".$type."' >";

		while($objet=mysql_fetch_object($resultat))
		{
		   echo "<option value=".$objet->id." >".$objet->libelle1. " ".$objet->libelle2."</option>";
        }

		echo "</select>";
	}


	
}

?>