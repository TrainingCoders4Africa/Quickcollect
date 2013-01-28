<?php

/**
 * @author QuickCollect
 * @copyright 2013
 */

include_once 'connec.inc.php';
include_once 'requetes.php';
include_once 'PHPExcel/Classes/PHPExcel.php';
include_once 'PHPExcel/Classes/PHPExcel/Writer/Excel2007.php';
	
    //recuperation de la données envoyée en parametre
    $code = isset($_GET['code'])?$_GET['code']:""; 
	//$select = "SELECT * FROM `valeur` where `CHILD_ID`='$code' order by `PERS_ID`";
    $result=select_valeurs2($code);
    if(mysql_num_rows($result)!=0){
        //– Go !
        $objPHPExcel = new PHPExcel();
        //– Quelques propriétées phpexcel
        $objPHPExcel->getProperties()->setCreator("DevZone");
        $objPHPExcel->getProperties()->setLastModifiedBy("DevZone");
        $objPHPExcel->getProperties()->setTitle("Office 2007 XLSX");
        $objPHPExcel->getProperties()->setSubject("Office 2007 XLSX");
        $objPHPExcel->getProperties()->setDescription("Office 2007 XLSX – By DevZone – With PHPExel");
        //– Les Données
        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'RUBRIQUES');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'QUESTIONS');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'REPONSES');
        
        $col=0; //colonnes dans le fichier Excel
        $lig=2; //lignes dans le fichier Excel
        
        ?>
        <table border>
            <thead>
                <tr>
                    <td>Rubrique</td>
                    <td>Question</td>
                    <td>R&eacute;ponse</td>
                </tr>
            </thead>
        <?php
        
        while($row=mysql_fetch_row($result)){
            //$pcod=$row[3];  //code de l'enquêteur
            //$valid=$row[0];
            $val=$row[5];
            $ques_id=$row[2];
            $row_qlib=mysql_fetch_row(select_question($ques_id));
            $qlib=$row_qlib[3];
            $rub_id=$row_qlib[1];
            $row_rlib=mysql_fetch_row(select_rubrique($rub_id));
            $rlib=$row_rlib[2];
            
            
            
            //Ecriture dans le fichier Excel
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col,$lig,$rlib);
            $col=$col+1;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col,$lig,$qlib);
            $col=$col+1;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col,$lig,$val);
            $col=0;
            $lig=$lig+1;
     
           ?>
            <tr>
                <!--td>< ?php echo "$nom $prenom"; ?></td-->
                <td><?php echo $rlib; ?></td>
                <td><?php echo $qlib; ?></td>
                <td><?php echo $val; ?></td>
            </tr>
            <?php
            
            //– On nomme notre feuillet
            $objPHPExcel->getActiveSheet()->setTitle('Exemple');
            $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
            $objWriter->save('Resultat.xlsx');
        }
        echo "</table>";
        echo "<br />";
        echo "<a href='download.php?fichier=Resultat.xlsx'><span>Exporter sous format Excel</span></a>";
    }else{
        echo "Aucun Résultat";
    }
?>
