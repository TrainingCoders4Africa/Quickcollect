<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="screen.css" rel="stylesheet" type="text/css" media="screen"/>
    <link href="../style/design.css" rel="stylesheet" type="text/css" media="screen"/>
    <script type="text/javascript" src="../script/jquery.js"></script>
    <?php 
   	   include_once '../fonctions/connec.inc.php';
       include_once '../fonctions/requetes.php';
       include_once '../script/fonction.php';
       include_once '../formulaire/gestion_enquete.php';
       
    ?>
</head>

<body style="width:100%" id="monbody">
<center><h1 style="color:#00F;">RESULTATS</h1>
<p><a href="../index.html">Retour</a></p>
<div align="center" style="width:75%;" id="mondiv">

<div id="enqueteinfo">
    <a class="item" href=""> 
        <img class="icon" height="16" width="16" alt="" src="../images/s_host.png" />
        R&eacute;sultats
    </a>
</div>

<hr />
<div id="topmenucontainer">
    <ul id="topmenu" >
        <li>
           <!--a onclick="creer_rubrique(< ?php echo $ncod;?>);" style="cursor: pointer;">Nouvelle rubrique</a-->
        </li>
    </ul>

</div>
<?php
    include_once '../script/fonction.php';
    
    //<!-- début -->
    if(isset($_POST['enrr']))
	{	
		 include '../fonctions/enregistrement_rubrique.php';
	}
    ?>
   

<div align="center" style="width:75%;" id="mondiv">

<form id="tableForm" name="tableForm" action="#" method="POST" class="form-inline well">
<table style="width:95%;">
<tr>
	<td style="width:20%;">
        <ul>
		<?php
			//$query = "SELECT DISTINCT `CHILD_ID` FROM `valeur`";
            $result=select_valeurs();
            $nb_enq=mysql_num_rows($result);
            if($nb_enq==0){
                echo "Aucune enquête disponible";
            }else{
                $cpt_enq=1;
                while ($line = mysql_fetch_assoc($result)) {
               	    $code = $line["ENQ_ID"];
                    $rowq=mysql_fetch_row(select_enquete($code));
                    $text = $rowq[3];
                    ?>
                    <li><a onclick='fnClickOpenEnq(<?php echo $code; ?>);' style="cursor: pointer;"><?php echo $text; ?></a></li>
                    
                    <?php
                   $cpt_enq++; 
                }
            }
            
		?>
		</ul>
	</td>
	<td id="tab1" align="center" style="width:30%;border: 1px solid chocolate;">
	</td>
    <td id="tab2" style="width:60%;border: 1px solid chocolate;">
    </td>
	</tr></table>    
</form>
</div>
<div style="clear:both;"></div>
<p>
</p>
</center>

</body>
</html>
