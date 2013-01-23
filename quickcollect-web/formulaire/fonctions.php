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

