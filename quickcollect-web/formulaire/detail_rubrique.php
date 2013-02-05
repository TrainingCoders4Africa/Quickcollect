<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="screen.css" rel="stylesheet" type="text/css" media="screen"/>
    <link href="../style/design.css" rel="stylesheet" type="text/css" media="screen"/>
    <script type="text/javascript" src="jquery.js"></script>
    <?php 
   	   include_once 'connec.inc.php';
       include_once 'requetes.php';
       include_once 'fonction.php';
       $ecod=intval($_GET['id']);
    $rese=select_enquete($ecod);
    $rowe=mysql_fetch_row($rese);
    $lib=$rowe[3];   
    $rcod=intval($_GET['idr']);
    $resr=select_rubrique($rcod);
    $row=mysql_fetch_row($resr);
    $libr=$row[2];
    
    include_once 'enregistrement_rubrique.php';
    
   ?>

<center>
</head>

<body style="width:100%" id="monbody">
<p><a href="../index.html">Retour au menu</a></p>
<a class="item" href="liste_enquetes.php"> 
        <img class="icon" height="16" width="16" alt="" src="../images/s_host.png" />
        Enqu&ecirc;tes
    </a>
    <span>
        <img class="icon" height="9" width="5" alt="-" src="../images/item_ltr.png"/>
    </span>
    <a class="item" href="detail_enquete.php?id=<?php echo $ecod;?>&lib=<?php echo $lib;?>"> 
        <?php echo $lib;?>
    </a>
    <span>
        <img class="icon" height="9" width="5" alt="-" src="../images/item_ltr.png"/>
    </span>
    <a class="item"> 
        <?php echo $libr;?>
    </a>
<div align="center" style="width:75%;" id="mondiv">
<div id="topmenucontainer">
    <ul id="topmenu">
        <li><!--a onclick="$('#mondiv').load('creer_enquete.php');" style="cursor: pointer;"-->
            <!--a href="nouvelle_rubrique.php?id=< ?php echo $ecod;?>">Nouvelle Rubrique</a></li-->
    </ul>
</div>
<hr />
<form class="form-inline well" method="POST" action="">
	<center>
	   	<table>
            <!--Le champ temoin est Utilisé pour supprimer une question de la rubrique en cours-->
			<!--input type="hidden" name="temoin" id="temoin" value=""/-->
            <tr>
				<th>Libell&eacute; de la rubrique:(*) </th>
				<td><input type="text" name="rub_lib" id="rub_lib" value="<?php echo $libr;?>" style="width:75%;" placeholder="Libell&eacute; de votre rubrique" /></td>
			</tr>
            <tr>
				<th>Rang de la rubrique dans le questionnaire;(*) </th>
				<td><input type="text" name="rub_rang" id="rub_rang" value="<?php echo $row[3];?>" style="width:75%;" placeholder="Libell&eacute; de votre rubrique" /></td>
			</tr>
         </table>
        <hr WIDTH="100%" SIZE="3" color="#0000CC" />
            
        <div id="div_rub">
            <?php 
                $res_ques=select_questions($rcod);
                $cpt_ques=0;
				while($row_ques=mysql_fetch_row($res_ques)){
					$ques_cod=$row_ques[0];
                    $cpt_ques+=1;
                    //affichage de la question
                    ?>
                    <hr SIZE="3" color="#4682B4"/>
    
                    <div id="<?php echo 'div_ques_'.$cpt_ques;?>">
                    <table>
				        <tr>
                           <span><?php echo "Question $cpt_ques";?> </span> 
                           <input type="hidden" id="<?php echo 'qid_'.$cpt_ques; ?>" name="<?php echo 'qid_'.$cpt_ques; ?>" value="<?php echo $ques_cod; ?>"/> 
					       <th><span>Intitul&eacute; de la question</span></th>
					       <td><input type="text" value="<?php echo $row_ques[3]; ?>" id="<?php echo 'ques_'.$cpt_ques; ?>" name="<?php echo 'ques_'.$cpt_ques; ?>" placeholder="Nouvelle Question" style="text-align: left; " dir="ltr"/></td>
                            <td></td>
				        </tr>
				        <tr>
					       <th><span>format</span></th>
					       <td><select id="<?php echo 'format_'.$cpt_ques; ?>" name="<?php echo 'format_'.$cpt_ques; ?>" placeholder="Consignes d'aide" style="text-align: left; " dir="ltr">
                                    <option value="text" <?php if(($row_ques[6]=="text")||(isset($_GET['format_'.$cpt_ques]))) echo "selected='selected'"; ?> >Texte</option>
                                    <option value="numeric" <?php if(($row_ques[6]=="numeric")||(isset($_GET['format_'.$cpt_ques]))) echo "selected='selected'"; ?> >Num&eacute;rique</option>
                                </select>
                           </td>
				        </tr>
                        <tr>
					       <th><span>Rang</span></th>
					       <td><input type="text" value="<?php echo $row_ques[4]; ?>"id="<?php echo 'rang_'.$cpt_ques; ?>" name="<?php echo 'rang_'.$cpt_ques; ?>" placeholder="Rang de la question dans la rubrique" style="text-align: left; " dir="ltr"/></td>
				        </tr>
				        <tr>
					       <th><span>Type de Question</span></th>
					       <td>
						      <select id="<?php echo 'sel_'.$cpt_ques; ?>" name="<?php echo 'sel_'.$cpt_ques; ?>" onChange="charger2(<?php echo $cpt_ques;?>);">
							  <?php 
								$res=select_type_questions();
								$i=0;
								
								echo "<option value='-1'>--Choisir--</option>";	
								while($row=mysql_fetch_row($res))
								{	$lib_typ_ques=$row[1];
						
									echo "<option value='".$row[0]."'";
									if (($row[0]==$row_ques[2])||(isset($_GET['sel_'.$cpt_ques])))
									echo "selected='selected'";
									echo">".htmlentities($lib_typ_ques)."</option>";
									$i++;
                          		}
							?>
						</select>
					</td>
				</tr>
			</table>
			<div id="<?php echo 'div_typ_ques_'.$cpt_ques; ?>">
				<?php
                $typques=$row_ques[2];
                switch ($typques){
                    case 1:
                        include 'rep_texte2.php'; 
                        break;
                    case 2:
                        include 'rep_paragraphe2.php';
                        break;
                    case 3:
                        echo "A venir";
                        echo "choix multiple";
                        echo "<br />";
                        break;
                    case 4:
                        include 'rep_case2.php';
                        break;
                    case 5:
                        include 'rep_liste2.php';
                        break;
                    case 6:
                        echo "Intervalle";
                        echo "<br />";
                        echo "A venir";
                        break;
                    case 7:
                        echo "Tableaux";
                         echo "<br />";
                        echo "A venir";
                        break;
                }
                ?>
			</div>
            <br />
            <div>
                <a class="btn btn-primary bouton" onclick="if(confirm('Attention! Voulez-vous vraiment supprimer cette question?')){supprimer_question(<?php echo $cpt_ques; ?>);}" style="cursor: pointer;">Supprimer question</a>
                <input type="checkbox" name="<?php echo "chk_".$cpt_ques; ?>" <?php if($row_ques[7]=='1') echo "checked='checked'";?>/>
	            <label>Rendre la question obligatoire.</label>
           
            </div>
            
            <br />
            
            <?php
            }      
            ?>
          </div>       
        </div>
	<br/>
    <hr SIZE="3" color="#4682B4"/>
    <input type="hidden" name="nbr_ques" id="nbr_ques" value="<?php echo $cpt_ques; ?>"/>
    <input class="btn btn-primary bouton" type="submit" name="enrr" id="enrr" value="ENREGISTRER"/>
	<a class="btn btn-primary bouton" onclick="return confirmLink2(<?php echo $ecod;?>,<?php echo $rcod; ?>, 'Attention! Voulez-vous vraiment supprimer cette rubriques? Cette action est irr&eacute;versible.')" style="cursor: pointer;">
    SUPPRIMER RUBRIQUE
    </a>
    <a class="btn btn-primary bouton" onclick="ajouter_question();" style="cursor: pointer;">NOUVELLE QUESTION</a>
	
	</center>
	</form>

</div>
<div style="clear:both;"></div>
<p>
</p>
</center>
</body>
</html>
