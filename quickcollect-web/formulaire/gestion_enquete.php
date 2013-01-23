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
