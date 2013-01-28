<?php

/**
 * @author QuickCollect
 * @copyright 2013
 */
?>
<?php
//début
//enregistrement nouvelle enquete
//import des fonctions
include_once 'fonctions.php';
if(isset($_POST['enr']))
	{	
	    $enq_lib=isset($_POST['enq_lib'])? $_POST['enq_lib']:"";
        $categorie=isset($_POST['categorie'])? $_POST['categorie']:"";
        $societe=isset($_POST['societe'])? $_POST['societe']:"";
        if(($enq_lib=="")||($categorie == '-1')){
				//echo "Vous n'avez pas rempli tous les champs obligatoires.";
                ?>
                    <script type="text/javascript">alert("Vous n'avez pas rempli tous les champs obligatoires.");
                    </script>
                <?php
	       }else{
	   	      //insertion
              if(insert_enquete($categorie, $societe, $enq_lib)){
		          ?>
                    <script type="text/javascript">alert("Enregistrement r\351ussi!");</script>
                <?php
              }
	       }
    }
    
//Modification d'une enquête
if(isset($_POST['mod']))
{	
    $enq_lib=isset($_POST['enq_lib'])? $_POST['enq_lib']:"";
    $categorie=isset($_POST['categorie'])? $_POST['categorie']:"";
    $societe=isset($_POST['societe'])? $_POST['societe']:"";
    $ncod=isset($_POST['ncod'])? $_POST['ncod']:"$ncod";
		
    $resr=select_enquete($ncod);
    $nb_reqr=mysql_num_rows($resr);
	if(($enq_lib=="")||($categorie == '-1')){
		echo "Vous n'avez pas rempli tous les champs obligatoires.";
	}else{
        //mis à jour
		if(update_enquete($ncod, $enq_lib, $societe, $categorie)){
		  ?>
                    <script type="text/javascript">alert("Modification r\351ussie!");</script>
                <?php
		}
    }
	
}
//enregistrement des catégories d'enquetes 
if(isset($_POST['enrcat']))
{
	$initial=isset($_POST['codt'])? $_POST['codt']:"";
	$final=isset($_POST['cod'])? $_POST['cod']:"";
    for($k=1;$k<$initial;$k++){
		$cod_c=$_POST['code'.$k];
        $lib_c=$_POST['cat'.$k];
        
        
        $eta_c=isset($_POST['etat'.$k])? $_POST['etat'.$k]:"";
        if(empty($eta_c)) 
        {
            $etat_c=0;
        }else{
            $etat_c=1;
        } 
        update_categorie($cod_c,$lib_c,$etat_c);
	}
	for($k=$initial;$k<$final;$k++){
	   $eta_c=isset($_POST['etat'.$k])? $_POST['etat'.$k]:"";
        if(empty($eta_c)) 
        {
            $etat_c=0;
        }else{
            $etat_c=1;
        } 
		$lib_c=$_POST['cat'.$k];
        insert_categorie($lib_c,$etat_c);
	}
?>
<script type="text/javascript">alert("Modifications r\351ussies!");</script>
<?php

}
if(isset($_POST['supp'])){
    $ncod=isset($_POST['ncod'])? $_POST['ncod']:"$ncod";
    supprimer_enquete($ncod);
}    
if(isset($_POST['genxml'])){
    $ncod=isset($_POST['ncod'])? $_POST['ncod']:"$ncod";
    exporter_enquete($ncod);
}

?>
<?php

/*if(isset($_GET['action']) && ($_GET['action']=='supprimer') && (isset($_GET['id'])))
{
    $num = intval($_GET['id']);
    supprimer_enquete($num);
}*/
if(isset($_GET['action']) && ($_GET['action']=='visualiser') && (isset($_GET['id'])))
{
    $num = intval($_GET['id']);
    visualiser_enquete($num);
}

?>
<?php
 if(isset($_POST['suppq'])){
        $temoin=isset($_POST['temoin'])? $_POST['temoin']:""; 
        $ques_cod=isset($_POST['qid_'.$temoin])? $_POST['qid_'.$temoin]:"";
        
        //$req_rep="select * from `reponse` where `reponse`.`QUES_ID`='$ques_cod'";
           $res_rep=select_reponses($ques_cod);
	  	   while($row_rep=mysql_fetch_row($res_rep)){
			 $rep_cod=$row_rep[0];
             //suppression des réponses
			 //$req_del="DELETE FROM `reponse` WHERE `reponse`.`REP_ID` ='$rep_cod'";
             //mysql_query($req_del)or die('Erreur SQL !'.$req_del.'<br>'.mysql_error());
             delete_reponse($rep_cod);
	       }
          //suppression des questions
          //$ques_del="DELETE FROM `question` WHERE `question`.`QUES_ID` ='$ques_cod'";
          //mysql_query($ques_del)or die('Erreur SQL !'.$ques_del.'<br>'.mysql_error());
          delete_reponses($ques_cod);
          //header("location: treeview.php?id1=$ncod");
          //echo "<script type='text/javascript'>document.location.href = 'treeview.php?id1=$ncod';</script>";
    }
    
	if(isset($_POST['nouvq']))
	{
        $ques_lib="Nouvelle Question";
		$ques_rg=mysql_num_rows(select_questions($rcod))+1;
        //$req_i="insert into `question`(CHILD_ID,QUES_LIB,QUES_RANG) VALUES('$ncod','$ques_lib','$ques_rg')";
		//$res_i=mysql_query($req_i)or die('Erreur SQL !'.$req_i.'<br>'.mysql_error());
        $res_i=insert_question('$rcod','$ques_lib','$ques_rg');
		if($res_i){
		  //$lastid=mysql_insert_id();
		  //echo "<script type='text/javascript'>alert('Nouvelle rubrique cr&eacute;&eacute;e !');</script>";	
          //header("location: treeview.php?id1=$lastid");
          //header("location: treeview.php?id1=$ncod");
          //echo "<script type='text/javascript'>document.location.href = 'treeview.php?id1=$ncod';</script>";
       	  
		}
	}
    
	if(isset($_POST['suppr']))
	{	//on v&eacute;rifie s'il n'y a pas de sous niveau d&eacute;pendant
		//$reqverif="select * from `question` WHERE `question`.`CHILD_ID` ='$ncod'";
		$resverif=select_questions($ecod); 
		
		$nbverif=mysql_num_rows($resverif);
		if($nbverif == 0){
              //on supprime l'enregistrement en cours de la base
		      //$enq_del="DELETE FROM `enquete` WHERE `enquete`.`CHILD_ID` ='$ncod' LIMIT 1;";
		      //mysql_query($enq_del)or die('Erreur SQL !'.$enq_del.'<br>'.mysql_error());
		      delete_rubrique($ecod);
		      echo '<script type="text/javascript">
			     alert("Suppression effectu\351e avec succ\350s!");
                 document.location.href = "detail_enquete.php";
			     </script>';
         }else{
		      while($row_ques=mysql_fetch_row($resverif)){
					$ques_cod=$row_ques[0];
					//="select * from `reponse` where `reponse`.`QUES_ID`='$ques_cod'";
					$res_rep=select_reponses($ques_cod);
					while($row_rep=mysql_fetch_row($res_rep)){
						$rep_cod=$row_rep[0];
                        //suppression des réponses
						//$req_del="DELETE FROM `reponse` WHERE `reponse`.`REP_ID` ='$rep_cod'";
						//mysql_query($req_del)or die('Erreur SQL !'.$req_del.'<br>'.mysql_error());
                        delete_reponse($rep_cod);
					}
                    //suppression des questions
                    //$ques_del="DELETE FROM `question` WHERE `question`.`QUES_ID` ='$ques_cod'";
					//mysql_query($ques_del)or die('Erreur SQL !'.$ques_del.'<br>'.mysql_error());
                    delete_question($ques_cod);
		      }
              //suppression de la rubrique
              //$rub_del="DELETE FROM `enquete` WHERE `enquete`.`CHILD_ID` ='$ncod' LIMIT 1";
			  //mysql_query($rub_del)or die('Erreur SQL !'.$rub_del.'<br>'.mysql_error());
				delete_rubrique($rcod);
 		      echo '<script type="text/javascript">
			     alert("Suppression effectu\351e avec succ\350s!");
                 document.location.href = "detail_enquete.php";
			     </script>';
             
          }
	   }   //fin traitemant suppression
		
        //pour cr&eacute;er une nouvelle rubrique
		if(isset($_POST['nouvr']))
		{	
		   $reqpar="select `PAR_ID` from `enquete` where `enquete`.`CHILD_ID`='$ncod'";
            $respar=mysql_query($reqpar);
			$rowpar=mysql_fetch_row($respar);
			
		
		$par_id=$rowpar[0];
        $rub_lib="Nouvelle rubrique";
		$req_i="insert into `enquete`(PAR_ID,LIB) VALUES('$par_id','$rub_lib')";
		//echo '<br />';
		$res_i=mysql_query($req_i)or die('Erreur SQL !'.$req_i.'<br>'.mysql_error());
		if($res_i){
		  $lastid=mysql_insert_id();
		  echo "<script type='text/javascript'>alert('Nouvelle rubrique cr&eacute;&eacute;e !');</script>";	
            header("location: treeview.php?id1=$lastid");
       	  
		}
	    }
?>
<script type="text/javascript">
function confirmLink(ecod, theSqlQuery) {
    confirmMsg='Confirmation';
    var is_confirmed = confirm(confirmMsg + ' :\n' + theSqlQuery);
    if (is_confirmed) {
        //theLink.href += '&is_js_confirmed=1';
        //Supprimer enquête
        $.get("../fonctions/supp_enquete.php", { ecod: ecod},
        function(data){
            alert("Suppression: " + data);
            document.location.href = "liste_enquetes.php";
       });
    }
    return is_confirmed;
} // end of the 'confirmLink()' function
//creer_rubrique
function creer_rubrique(ecod) {
    //theLink.href += '&is_js_confirmed=1';
    //Supprimer enquête
    $.get("../fonctions/nouvelle_rubrique.php", { ecod: ecod},
    function(data){
        //alert("Suppression: " + data);
        document.location.href = 'detail_rubrique.php?id='+ecod+'&idr='+data;
        
    });
}
</script>
<script type="text/javascript">
function fnClickOpenEnq(code) {
   
    //liste des enqueteurs
   $.get("../formulaire/liste_enqueteur.php", { code: code},
    function(data){
        //alert("Data Loaded: " + data);
        document.getElementById("tab1").innerHTML="";
        var idtb="#tab1";
         $(''+idtb+'').append(data);
    });
   //liste des résultats
   $.get("../formulaire/liste_resultat.php", { code: code},
    function(data){
        document.getElementById("tab2").innerHTML="";
        var idtb="#tab2";
         $(''+idtb+'').append(data);
    });
}
</script>
<?php
function supprimer_enquete($ncod){
    //on v&eacute;rifie s'il n'y a pas de sous niveau d&eacute;pendant
		$resverif=select_rubriques($ncod);
		$nbverif=mysql_num_rows($resverif);
		if($nbverif == 0){
              //on supprime l'enregistrement en cours de la base
		      delete_enquete($ncod);
		      ?>
              <script type="text/javascript">
			     alert("Suppression effectu\351e avec succ\350s!");
                 document.location.href = "liste_enquetes.php";
			  </script>
              <?php 
         }else{
			while($rowverif=mysql_fetch_row($resverif)){
				$rub_cod=$rowverif[0];
				$res_ques=select_questions($rub_cod);
				while($row_ques=mysql_fetch_row($res_ques)){
					$ques_cod=$row_ques[0];
					$res_rep=select_reponses($ques_cod);
					while($row_rep=mysql_fetch_row($res_rep)){
						$rep_cod=$row_rep[0];
                        //suppression des réponses
						delete_reponse();
					}
                    //suppression des questions
                    delete_question($ques_cod);
				}
                //suppression des rubriques
                delete_rubrique($rub_cod);
			}	
 		    //on supprime l'enregistrement en cours de la base
		      delete_enquete($ncod);
		      ?>
                <script type="text/javascript">
			     alert("Suppression effectu\351e avec succ\350s!");
                 document.location.href = "liste_enquetes.php";
			     </script>
              <?php  
          }
    
}
?>

<?php
function exporter_enquete($ncod){
    //Code pour générer le fichier xml
    $dom = new DomDocument();
  
    // Definition du prologue :  la version et l'encodage
    $dom -> version = '1.0';
    $dom -> encoding = 'UTF-8';
    $dom -> formatOutput = 'TRUE';

    // Ajout d'un commentaire a la racine
    $commentaire = $dom->createComment('Généré a l\'aide de php5');
    $dom->appendChild($commentaire);
    $i=0;   //compte le nombre de questions
    //on récupère les infos dans la base de données
    $rese=select_enquete($ncod);
    while($rowe=mysql_fetch_row($rese)){
        $lib=$rowe[3];
        $data=$dom->createElement("data");
        $data->setAttribute("nameenquete",$lib);
        //sélection des rubriques
         $resr=select_rubriques($ncod);
         while($rowr=mysql_fetch_row($resr)){
           $r_cod=$rowr[0];
           $r_lib=$rowr[2];
           //rien pour l'instant
                    
           //sélection des questions
           //$reqq="select * from `question` where `question`.`CHILD_ID` ='$r_cod' order by `QUES_RANG`";
           $resq=select_questions($r_cod);
           //print_r($resq);
           while($rowq=mysql_fetch_row($resq)){
                $i++;
                $q_cod=$rowq[0];
                $q_lib=$rowq[3];
                $q_type=$rowq[2];
                        
                $input=$dom->createElement("input");
                $idr=$dom->createElement("idr");
                $idr2=$dom->createTextNode($r_cod);
                $idr->appendChild($idr2);
                $labelr=$dom->createElement("labelr");
                $labelr2=$dom->createTextNode($r_lib);
                $labelr->appendChild($labelr2);
                $id=$dom->createElement("id");
                $id2=$dom->createTextNode($q_cod);
                $id->appendChild($id2);
                        
                $type=$dom->createElement("type");
                        
                //vérifier le type de chaque question
                if($q_type==1){
                    $type2=$dom->createTextNode("texte");
                }else if($q_type==2){
                    $type2=$dom->createTextNode("paragraphe");
                }else if($q_type==3){
                    $type2=$dom->createTextNode("choix multiple");
                }else if($q_type==4){
                    $type2=$dom->createTextNode("case a cocher");
                }else if($q_type==5){
                    $type2=$dom->createTextNode("spinner");
                }else if($q_type==6){
                    $type2=$dom->createTextNode("intervalle");
                    
                }else if($q_type==7){
                    $type2=$dom->createTextNode("tableaux");
                    
                }
                       $type->appendChild($type2);    
                        
                        $label=$dom->createElement("label");
                        $label2=$dom->createTextNode($q_lib);
                        $label->appendChild($label2);
                        
                        $input->appendChild($idr);
                        $input->appendChild($labelr);
                        $input->appendChild($id);
                        $input->appendChild($type);
                        
                        
                        //sélectionner les réponses
                        if(($q_type==4)||($q_type==5)){
                            $options=$dom->createElement("options");
                            
                            //$reqrep="select * from `reponse` where `reponse`.`QUES_ID` ='$q_cod' order by `REP_ID`";
                            $resrep=select_reponses($q_cod);
                            while($rowrep=mysql_fetch_row($resrep)){
                                $value=$dom->createElement("value");
                                $value->appendChild($dom->createTextNode($rowrep[2]));
                                $options->appendChild($value);
                            }//fin parcourt reponses
                             $options->setAttribute("nbre",mysql_num_rows($resrep));
                        }
                        $input->appendChild($label);
                        $input->appendChild($label);
                        $data->appendChild($input);
                    } //fin parcourt questions
                   
                }//fin parcourt rubriques
                
              }//fin parcourt enquete en cours
             $data->setAttribute("count",$i);
              $dom->appendChild($data);
              $dom->save('fichier.xml');
                
              //export du fichier xml
             //
            header("location: download.php?fichier=fichier.xml");
             //fin
}
?>
<?php

/**
 * @author quickCollect
 * @copyright 2012
 */

?>
   <script type="text/javascript">
            //***FHI********old content of js file.js********************************************
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
            function charger(nbr_ques){
			     //	var nbr_ques = parseInt(document.getElementById('nbr_ques').value);
				var chaine_last_sel='sel_'+nbr_ques;
				var typ_ques_id=parseInt(document.getElementById(chaine_last_sel).value); 
                var last_tr_typ_ques='#div_typ_ques_'+nbr_ques+'';
                
				$(last_tr_typ_ques).load('../../fonctions/typ_ques.php?typ_ques_id='+typ_ques_id+'&nbr_ques='+nbr_ques+'');
		   }

            
        </script>
		<script type="text/javascript">
            function ajouter_question(){
                
                //var j = i+1;
                //augmenter le nombre de questions de 1
                document.getElementById('nbr_ques').value =  parseInt(document.getElementById('nbr_ques').value) + 1;
                var nbr_ques = parseInt(document.getElementById('nbr_ques').value);
                
                //on ajoute la div 
                var mon_div='<br /><div id="div_ques_'+nbr_ques+'">';
                mon_div+='<table><tr>';
                mon_div+='<th><span>Titre de la question</span></th>';
                mon_div+='<td><input id="ques_'+nbr_ques+'" name="ques_'+nbr_ques+'" placeholder="Nouvelle Question" style="text-align: left; " dir="ltr"/></td>';
                mon_div+='<td></td></tr>';
                mon_div+='<tr><th><span>Aide</span></th>';
                mon_div+='<td><input id="aide_'+nbr_ques+'" name="aide_'+nbr_ques+'" placeholder="Consignes d\'aide" style="text-align: left; " dir="ltr"/></td>';
                mon_div+='</tr><tr><th><span>Type de Question</span></th>';
                mon_div+='<td><select id="sel_'+nbr_ques+'" name="sel_'+nbr_ques+'" onchange="mis_a_jour_value2(\'sel_'+nbr_ques+'\');charger(\''+nbr_ques+'\');"></select>';
                mon_div+='</td><td></td></table><div id="div_typ_ques_'+nbr_ques+'"></div></div>';
                document.getElementById('tab_rub').innerHTML +=mon_div;
                charge('sel_'+nbr_ques);
                
                //modification du lien dans le div lign_supp_
                //document.getElementById('lien_lign_supp').innerHTML = '<a href="javascript:ajouter_ligne('+j+')"><img src="elus_locaux/new_hover.png" title="Ajouter un élu"/></a>';
            }

            function mis_a_jour_value(id_champ){
                var valeur = document.getElementById(''+id_champ+'').value;
                document.getElementById(''+id_champ+'').setAttribute('value',''+valeur+'');
            }
            function mis_a_jour_value2(id_champ){
                var i=document.getElementById(''+id_champ+'').selectedIndex;
                document.getElementById(''+id_champ+'').options[i].setAttribute('selected','selected');
            }

        </script>
                
        <script type="text/javascript">
        //charge les types de questions dans le select
        function charge(loc_html_id){
            xhr.onreadystatechange = function(){
            if(xhr.readyState == 4){
              var retour = xhr.responseText;
              document.getElementById(''+loc_html_id+'').innerHTML = retour;
              }
            }
            xhr.open("GET","../../fonctions/type_question.php?arid="+loc_html_id,true);
            xhr.send(null);
            }
        </script>
       
<script type="text/javascript">
function supprimer_option(nbr_q,p){
    var monli='#li_'+nbr_q+'_'+p;
    $(monli).remove();
    document.getElementById('cod'+nbr_q).value=parseInt(document.getElementById('cod'+nbr_q).value)-1; 
    alert("Suppression ok");
}
</script>

<script type="text/javascript">
function supprimer_option2(nbr_q,p){
    var monli='#li_'+nbr_q+'_'+p;
    var monul='ul_'+nbr_q;
    var optid='#optid_'+nbr_q+'_'+p;
    
    var opt_id=$(optid).val();
    
    $.get("../../fonctions/supp_option.php", { optid: opt_id},
    function(data){
        alert("Data Loaded: " + data);
        $(monli).remove();
        document.getElementById('cod'+nbr_q).value=parseInt(document.getElementById('cod'+nbr_q).value)-1;
	});
}
//ajout de question
/*funtion fnClickAddques(cpt_ques){

    $.get("../../fonctions/ajout_question.php", {},
    function(data){
        alert("Data Loaded: " + data);
        //on incrémente le compteur des questions
        if(data=="ok"){
            var newcptq=parseInt(document.getElementById(nbr_ques).value)+1
           document.getElementById(nbr_ques).value=newcptq;
           var chaine='<div id="div_ques_".newcptq></div>';
    
        }
        
	});
}*/
//cases à cocher
function fnClickAddOpt(cptq) {
    var nbr_q=cptq;
    var cod='cod'+nbr_q;
    var p=document.getElementById(cod).value;
    var myid='ul_'+nbr_q;
    //identifiant de l'UL
    /*var myid='#ul_'+nbr_q;
    $(''+myid+'').append(
    //$('#monbody').append(
          $('<li>')
            .append(
                $('<input>').attr('type','checkbox')
            )
            .append($('<input>')
                .attr('type','text')
                .attr('id', 'opt_'+nbr_q+'_'+p)
            )
        );*/
    var chaine='<li id="li_'+nbr_q+'_'+p+'"><input type="checkbox"/>';
    chaine+='<input type="text" id="opt_'+nbr_q+'_'+p+'" name="opt_'+nbr_q+'_'+p+'" placeholder="Option '+p+'" style="text-align:left" onchange="mis_a_jour_value(this.id);"/>';
    chaine+='<span> <a href="javascript:supprimer_option('+nbr_q+', '+p+')">Supprimer</a></span>';
    document.getElementById(myid).innerHTML+=chaine+'</li>';
    document.getElementById('cod'+nbr_q).value=parseInt(document.getElementById('cod'+nbr_q).value)+1;
    document.getElementById('opt_'+nbr_q+'_'+p).focus();
}
//sélectionner dans une liste
function fnClickAddOpt2(cptq) {
    var nbr_q=cptq;
    var cod='cod'+nbr_q;
    var p=document.getElementById(cod).value;
    var myid='ul_'+nbr_q;
    ²
    var chaine='<li id="li_'+nbr_q+'_'+p+'"><span>'+p+'. </span>';
    chaine+='<input type="text" id="opt_'+nbr_q+'_'+p+'" name="opt_'+nbr_q+'_'+p+'" placeholder="Option '+p+'" style="text-align:left" onchange="mis_a_jour_value(this.id);"/>';
    chaine+='<span> <a href="javascript:supprimer_option('+nbr_q+', '+p+')">Supprimer</a></span>';
    document.getElementById(myid).innerHTML+=chaine+'</li>';
    document.getElementById('cod'+nbr_q).value=parseInt(document.getElementById('cod'+nbr_q).value)+1;
    document.getElementById('opt_'+nbr_q+'_'+p).focus();
}
//validation formulaire création d'enquete

</script>
<script type="text/javascript">
 function valider_form(){
			var categorie=document.getElementById('categorie').value;
			if (categorie== -1){
				alert("Veuillez renseigner une categorie pour continuer ...");
				return false;
			}else{
			     var societe=document.getElementById('societe').value;
			     if (societe== -1){
				    alert("Veuillez renseigner une societe pour continuer ...");
				    return false;
			     }else{
			         var enq_lib=document.getElementById('enq_lib').value;
                     if (enq_lib== ""){
				        alert("Veuillez renseigner le libellé de l'enquête pour continuer ...");
				        return false;
			         }else{
			             return true; 
			         }         
			     }
			}
            
		}
 
</script> 
<script type="text/javascript">
function supprimer_categorie(idcat){
    //alert("ok");
    $.get("supp_categorie.php", { idcat: idcat},
    function(data){
        alert("Reponse: " + data);
        
	});
    
}

function fnClickAddRow() {
var p=document.getElementById('cod').value;
var chaine='<tr><td><input type="hidden" name="code'+p+'" id="code'+p+'" value="'+p+'" readonly/>'+p+'</td>';
chaine+='<td>';
chaine+='<input id="etat'+p+'" name="etat'+p+'" type="checkbox" value="1" checked="checked"/> Actif </td>';
chaine+='<td><input type="text" id="cat'+p+'" name="cat'+p+'"/></td>';
//chaine+='<td><button name="sup'+p+'" id="sup'+p+' onclick="if(!confirm(\'Attention! Voulez-vous vraiment supprimer cette categorie?\')) {return false;}else {alert();};">Supprimer</button></td>';
   
document.getElementById('tbody').innerHTML+=chaine+'</tr>';
document.getElementById('cod').value=parseInt(document.getElementById('cod').value)+1;
}
function valider_categories(){
    var inputs= document.getElementById("example1").getElementsByTagName('INPUT');
	var val_node=0;
	for(i=0, taille=inputs.length; i < taille; i++){
	   var node=inputs[i];
       if(node.getAttribute("type") == "text") {
	       val_node=node.getAttribute("value");
	   	   if (val_node==""){
                alert ( "Veuillez remplir toutes les cases du tableau ou supprimer les cases vides." );
		        return false;
	       }
		}
	}
}


</script>
       

