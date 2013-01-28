<?php
    include_once 'connec.inc.php';
    include_once 'requetes.php';
    $ncod=intval($_GET['id']);
    $rese=select_enquete($ncod);
    $rowe=mysql_fetch_row($rese);
    $lib=$rowe[3];    
?>
<center>
<div id="enqueteinfo">
    <a class="item" href="liste_enquetes.php"> 
        <img class="icon" height="16" width="16" alt="" src="../images/s_host.png" />
        Enqu&ecirc;tes
    </a>
    <span>
        <img class="icon" height="9" width="5" alt="-" src="../images/item_ltr.png"/>
    </span>
    
    <a class="item"> 
        <?php echo $lib;?>
    </a>
    <span>
        <img class="icon" height="9" width="5" alt="-" src="../images/item_ltr.png"/>
    </span>
    
    <a class="item"> 
        Visualisation
    </a>
</div>
<hr />
<?php
       
        ?>
            <h4><span><?php echo $lib;?></span></h4>
		<?php
        //sélection des rubriques
         $resr=select_rubriques($ncod);
         while($rowr=mysql_fetch_row($resr)){
           $r_cod=$rowr[0];
           $r_lib=$rowr[2];
           ?>
           <hr />
            <table>
            <tr>
				<th><span><?php echo $rowr[2];?></span></th>
			</tr>
            <?php
           //sélection des questions
           $resq=select_questions($r_cod);
           //print_r($resq);
           while($rowq=mysql_fetch_row($resq)){
               // $i++;
                $q_cod=$rowq[0];
                $q_lib=$rowq[3];
                $q_type=$rowq[2];
                        
                ?>
                <tr>
                   	<th><span><?php echo $rowq[3]; ?></span></th>
                </tr>
				<?php        
                //vérifier le type de chaque question
                switch ($q_type){
                    case 1:
                        echo "<tr><td><input type='text' value='$rowq[3]' style='text-align: left;'/></td></tr>"; 
                        break;
                    case 2:
                        echo "<tr><td><input type='text' value='$rowq[3]' style='height:7em;width:35em'/></td></tr>";
                        break;
                    case 3:
                        echo "A venir";
                        break;
                    case 4:
                        echo "<tr><td><ul style='list-style-type: none;'>";
                        $resrep=select_reponses($q_cod);
                        while($rowrep=mysql_fetch_row($resrep)){
                            ?>
                            <li>
                            <input type="checkbox"/>
                            <label><?php echo $rowrep[2];?></label>
                            </li>
                        <?php
                        }//fin parcourt reponses
                        echo "</ul></td></tr>"; 
                        break;
                    case 5:
                    //Sélectionner dans une liste
                    echo "<tr><td><select>";
                        $resrep=select_reponses($q_cod);
                        echo "<option value='-1'>Choisir.....</option>";
                        while($rowrep=mysql_fetch_row($resrep)){
                            echo "<option>".htmlentities($rowrep[2])."</option>";	
						}//fin parcourt reponses
                        echo "</select></td></tr>";
                        break;
                    case 6:
                    //intervalle
                        break;
                    case 7:
                    //tableau
                        break;
                            
                    ?>
                    </td>
                 </tr>
                 
                    <?php
                if(($q_type==4)||($q_type==5)){
                    //$reqrep="select * from `reponse` where `reponse`.`QUES_ID` ='$q_cod' order by `REP_ID`";
                    
                  }
                } //fin parcourt questions
                   
           }//fin parcourt rubriques
        echo "</table>";        
        }
?>
</center>
