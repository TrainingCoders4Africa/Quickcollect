<?php
    session_start();
	
	//require_once 'fonctions/connec.inc.php';
	
	require('./fonctions.php');
	
	//include('./fonctions.php');
	
	//Etablissons la connexion au serveur de base de donnees
	$con=new health();
	$con->Connexion();

?>
<!DOCTYPE html>
<html>
    <head>
    
  
    
    
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="ROBOTS" content="all">
		<title>Personnel</title>
		<script src="fonctions/jquery-1.2.6.js"></script>
		<script type="text/javascript">
            //***FHI********old content of js file zone.js********************************************
            //declaration d'une reference qui va contenir l'objet XMLHttprequest
            var xhr = null;
            //on verifie que l'objet  window.XMLHttpRequest existe si oui on instancie xhr, sinon on virifie que ActiveX existe
            //deux cas: celui des autres navigateurs et celui de microsoft

            //$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
             function createXhrObject()
                        {
                            if (window.XMLHttpRequest)
                                return new XMLHttpRequest();

                            if (window.ActiveXObject)
                            {
                                var names = [
                                    "Msxml2.XMLHTTP.6.0",
                                    "Msxml2.XMLHTTP.3.0",
                                    "Msxml2.XMLHTTP",
                                    "Microsoft.XMLHTTP"
                                ];
                                for(var i in names)
                                {
                                    try{return new ActiveXObject(names[i]);}
                                    catch(e){}
                                }
                            }
                            window.alert("Votre navigateur ne prend pas en charge l'objet XMLHTTPRequest.");
                            return null; // non support?
                        }
             xhr = createXhrObject();
            //$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
            //fonction qui permet de charger les zones enfants d'une zone donnee
            function charger(){
				/*var nbr_ques = parseInt(document.getElementById('nbr_ques').value);
				var chaine_last_sel='sel_'+nbr_ques;
				var typ_ques_id=parseInt(document.getElementById(chaine_last_sel).value); 
				
				xhr.onreadystatechange = function(){
					if(xhr.readyState == 4){
						var retour = xhr.responseText;
						var last_tr_typ_ques='tr_typ_ques_'+nbr_ques;
						//document.getElementById('last_tr_typ_ques').innerHTML = "" ;
					}
                }
						
                   xhr.open("GET","fonctions/typ_ques.php?typ_ques_id="+typ_ques_id,true);
				   xhr.send(null);*/
				   
				var nbr_ques = parseInt(document.getElementById('nbr_ques').value);
				var chaine_last_sel='sel_'+nbr_ques;
				var typ_ques_id=parseInt(document.getElementById(chaine_last_sel).value); 
				var last_tr_typ_ques="<?php echo '#tr_typ_ques_1'; ?>";
				alert(last_tr_typ_ques);
				alert("ok");
			
				$('#tr_typ_ques_1').load('fonctions/typ_ques.php?typ_ques_id='+typ_ques_id+'');
		   }

        </script>
		<script type="text/javascript">
            function ajouter_question(i){
                var j = i+1;
                //augmenter le nombre de questions de 1
                var nbr_ques = parseInt(document.getElementById('nbr_ques').value);
                document.getElementById('nbr_ques').value = nbr_ques + 1;

                //on ajoute la div 
                //document.getElementById('div_rub').innerHTML += '<div id="num_ord_'+i+'_1"><td><input type="text" id="num_ord_'+i+'_1" name="num_ord_'+i+'_1" value="'+i+'" size="2" onchange="mis_a_jour_value(\'num_ord_'+i+'_1\')" /> </td><td><input type="text" id="prenom_'+i+'_2" name="prenom_'+i+'_2" value="" size="10" onchange="mis_a_jour_value(\'prenom_'+i+'_2\')" /></td><td><input type="text" id="nom_'+i+'_3" name="nom_'+i+'_3" value="" size="10" onchange="mis_a_jour_value(\'nom_'+i+'_3\')" /></td><td><input type="text" id="fonction_'+i+'_4" name="fonction_'+i+'_4" value="" size="10" onchange="mis_a_jour_value(\'fonction_'+i+'_4\')" /></td><td><input type="text" id="commiss_'+i+'_5" name="commiss_'+i+'_5" value="" size="11" onchange="mis_a_jour_value(\'commiss_'+i+'_5\')" /></td><td><input type="text" id="sexe_'+i+'_6" name="sexe_'+i+'_6" value="" size="3" onchange="mis_a_jour_value(\'sexe_'+i+'_6\')" /></td><td><input type="text" id="age_'+i+'_7" name="age_'+i+'_7" value="" size="2" onchange="mis_a_jour_value(\'age_'+i+'_7\')" /></td><td><input type="text" id="vill_quart_'+i+'_8" name="vill_quart_'+i+'_8" value="" size="10" onchange="mis_a_jour_value(\'vill_quart_'+i+'_8\')" /></td><td><input type="text" id="profess_'+i+'_9" name="profess_'+i+'_9" value="" size="10" onchange="mis_a_jour_value(\'profess_'+i+'_9\')" /></td><td><input type="text" id="nbr_mandat_'+i+'_10" name="nbr_mandat_'+i+'_10" value="" size="6" onchange="mis_a_jour_value(\'nbr_mandat_'+i+'_10\')" /></td><td><input type="text" id="niv_instruc_'+i+'_11" name="niv_instruc_'+i+'_11" value="" size="10" onchange="mis_a_jour_value(\'niv_instruc_'+i+'_11\')" /></td><td><input type="text" id="alphab_'+i+'_12" name="alphab_'+i+'_12" value="" size="7" onchange="mis_a_jour_value(\'alphab_'+i+'_12\')" /></td></tr>';
                //modification du lien dans le div lign_supp_
                //document.getElementById('lien_lign_supp').innerHTML = '<a href="javascript:ajouter_ligne('+j+')"><img src="elus_locaux/new_hover.png" title="Ajouter un �lu"/></a>';


            }

             function mis_a_jour_value(id_champ){
                var valeur = document.getElementById(''+id_champ+'').value;
                document.getElementById(''+id_champ+'').setAttribute('value',''+valeur+'');
            }
        </script>
	
		</script>
        
          <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        
    <style type="text/css">
<!--
.rouge {	color: #F00;
}
-->
    </style>
    </head>
<body>
<form name="form_ques" method="POST" action="fichier.php?action=modificationpersonnel&idperson=<?php echo $_GET['idfour']; ?>&dggd=76" class="form-inline well">
  <a href="personnel.php"><img src="images/upcoming-work.png" width="32" height="32"></a>
  <div id="div_rub">
    <p></p>
  <?php  
  //recuperation idpersonne
  $idperson = $_GET['idfour'];
    //Recupere les valeurs a modifier
   $sql = "select PERS_ID, PERS_NOM, PERS_PRENOM, PERS_TEL, PERS_ADDR from personnel where  PERS_ID ='".$idperson."'";
   
   $resultat1 = $con->Execute($sql)or @die(mysql_error());
   
    $info = mysql_fetch_array($resultat1)
	
    ?>
    <div id="questions">
      <div id="div_ques_1">
        <table width="39%" align="center">
          <tr>
            <th colspan="2"><p>Modification  <?php echo $info['PERS_PRENOM']; echo " "; echo $info['PERS_NOM']; ?></p>
            <p><?php if($_GET['valid'] != null){if($_GET['valid'] == 'ok'){ echo "Modification reussie"; } else{ echo "Modification non reussie"; } }?></p></th>
          </tr>
          <tr>
            <th width="24%"><label for="nom">Nom <span class="rouge">*</span></label></th>
            <td width="76%"><input name="nom" id="nom" style="text-align: left; " dir="ltr" value="<?php  echo $info['PERS_NOM']; ?>" required="true" placeholder="Nom"></td>
          </tr>
          <tr>
            <th><label for="prenom">Prénom <span class="rouge">*</span></label></th>
            <td><input name="prenom" id="prenom" style="text-align: left; " dir="ltr" value="<?php  echo $info['PERS_PRENOM']; ?>" required="true" placeholder="Prénom"></td>
          </tr>
          <tr>
            <th><label for="tel">Téléphone <span class="rouge">*</span></label></th>
            <td><input name="tel" id="tel" style="text-align: left; " dir="ltr" value="<?php  echo $info['PERS_TEL']; ?>" required="true" placeholder="Téléphone"></td>
          </tr>
          <tr>
            <th><span>Adresse</span></th>
            <td><input name="adresse" id="adresse" style="text-align: left; " dir="ltr" value="<?php  echo $info['PERS_ADDR']; ?>" placeholder="Adresse">
            <input name="idperson" type="hidden" id="idperson" value="<?php  $info['PERS_ID'] ?>"></td>
            
          </tr>
          
        </table>
        <p>
          <input class="btn btn-primary btn-large" type="submit" value="Modifier" name="valider" id="valider"/>
        </p>
      </div>
    </div>
    
  </div>
  <a href="index.html"></a>
</form>
<tr>
<td class="sxsqxsqx">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
</tr>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>
