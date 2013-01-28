<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="screen.css" rel="stylesheet" type="text/css" media="screen"/>
    <link href="../style/design.css" rel="stylesheet" type="text/css" media="screen"/>
    <script type="text/javascript" src="jquery.js"></script>
    <?php 
   	   include_once 'connec.inc.php';
       include_once 'requetes.php';
       include_once 'fonction.php';
    ?>
<center><h1 style="color:#00F;">ENQUETES</h1>
</head>

<body style="width:100%" id="monbody">
<p><a href="../index.html">Retour au menu</a></p>
<div align="center" style="width:75%;" id="mondiv">

<div id="enqueteinfo">
    <a class="item" href="liste_enquetes.php"> 
        <img class="icon" height="16" width="16" alt="" src="../images/s_host.png" />
        Enqu&ecirc;tes
    </a>
    
    <span>
        <img class="icon" height="9" width="5" alt="-" src="../images/item_ltr.png"/>
    </span>
    <a class="item"> 
        Modification
    </a>
</div>

<div id="topmenucontainer">
    <ul id="topmenu">
        <li><a href="creer_enquete.php">Cr&eacute;er</a></li>
    </ul>
</div>
<hr />
<form id="tableForm" name="tableForm" action="#" method="POST" onsubmit="return valider_form();" class="form-inline well">
    
    <table>
            <tr>
				<?php
                $num = intval($_GET['id']);
                echo "<input type='hidden' name='ncod' value='$num'/>";
                $result = select_enquete($num);
	            $row = mysql_fetch_array($result);
				echo '<td><label for="categorie">Cat&eacute;gorie(*) </label></td><td><select name="categorie" id="categorie" style="width:75%">';
				echo "<option value='-1'>Choisir.....</option>";
					
					$res2=select_categories();
					$i=0;
					
					while($row2=mysql_fetch_row($res2))
					{	
							echo "<option value='".$row2[0]."'";
						      if (($row2[0]== $row['CAT_ID'])||(isset($_GET['categorie'])&& $row['CAT_ID']==$_GET['categorie']))
							echo "selected='selected'";
							echo">".htmlentities($row2[1])."</option>";	
							$i++;
					}
						echo '</select></td>';	
					?>
                    <td>
                    <a href="modif_categorie.php?prec=modif&id=<?php echo $num;?>" style="cursor: pointer;"><u>Modifier</u></a>
                    </td>
			</tr>
			<tr>
				<?php
				echo '<td><label for="societe">Soci&eacute;t&eacute; b&eacute;n&eacute;ficiaire </label></td><td><select name="societe" id="societe" style="width:75%">';
				echo "<option value='-1'>Choisir.....</option>";
					
					$res2=select_societes();
					$i=0;
					while($row2=mysql_fetch_row($res2))
					{	
							echo "<option value='".$row2[0]."'";
						if (($row2[0]== $row['SOC_ID'])||(isset($_GET['societe'])&& $row['SOC_ID']==$_GET['societe']))
							echo "selected='selected'";
							echo">".htmlentities($row2[1])."</option>";	
							$i++;
					}
						echo '</select></td>';
					?>
                <td>
                <a href="modif_societe.php?prec=modif&id=<?php echo $num;?>"><u>Modifier</u></a>
                    </td>
			</tr>
			
			
			<tr>
				<td>Intitul&eacute;(*) </td>
				<td><input type="text" name="enq_lib" id="enq_lib" value="<?php echo $row['LIB'];?>" style="width:75%;" /></td>
			</tr>
		</table>
    <br/>
	<input type="submit" class="btn btn-primary bouton"  name="mod" id="mod" value="ENREGISTRER"/>
	<input type="submit" class="btn btn-primary bouton" name="supp" id="supp" value="SUPPRIMER" onclick="if(!confirm('Attention! Voulez-vous vraiment supprimer cette enquete avec toutes ses rubriques? Cette action est irr&eacute;versible.')) return false;"/>
	<input type="submit" class="btn btn-primary bouton" name="genxml" id="genxml" value="<?php echo htmlentities("Exporter au format XML");?>"/>
    <a href="visualiser_enquete.php?id=<?php echo $row[0]; ?>">
    <input type="button" class="btn btn-primary bouton" name="visual" id="visual" value="<?php echo htmlentities("Visualiser l'enquête");?>" />
    <!--input type="button" class="btn btn-primary bouton" name="visual" id="visual" value="< ?php echo htmlentities("Visualiser l'enquête");?>" onclick="$('#mondiv').load('visualiser_enquete.php?id=< ?php echo $row[0]; ?>');"/-->
    </a>	
</form>
</div>
<div style="clear:both;"></div>
<p>
</p>
</center>
</body>
</html>
