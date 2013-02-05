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
  
</head>

<body style="width:100%" id="monbody">
<center>
<h1 style="color:#00F;">ENQUETES</h1>
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
        Cr&eacute;ation
    </a>
</div>

<div id="topmenucontainer">
    <ul id="topmenu">
        <!--li> <a href="creer_enquete.php">Cr&eacute;er</a></li-->
    </ul>
</div>
<hr />

<form id="tableForm" name="tableForm" action="#" onsubmit="return valider_form();" method="POST" class="form-inline well">
    <center>
    <table>
        <tr>
				<?php
				echo '<td><label for="categorie">Cat&eacute;gorie(*) </label></td><td><select name="categorie" id="categorie" style="width:75%">';
				echo "<option value='-1'>Choisir.....</option>";
					
					$res2=select_categories_actifs();
					$i=-1;
					
					while($row2=mysql_fetch_row($res2))
					{	     $i++;
							echo "<option value='".$row2[0]."'";
                            echo">".$row2[1]."</option>";	
							
					}
						echo '</select></td>';	
					?>
                    <td>
                    <a href="modif_categorie.php?prec=creation"><u>Modifier</u></a>
                    <!--a onclick="$('#mondiv').load('../fonctions/modif_categorie.php');" style="cursor: pointer;"><u>Modifier</u></a-->
                    </td>
			</tr>
			<tr>
				<?php
				echo '<td><label for="societe">Soci&eacute;t&eacute; b&eacute;n&eacute;ficiaire </label></td><td><select name="societe" id="societe" style="width:75%" onchange="mis_a_jour_value2(this.id)">';
				echo "<option value='-1'>Choisir.....</option>";
					
					$res2=select_societes_actifs();
					$i=0;
					
					while($row2=mysql_fetch_row($res2))
					{	
							echo "<option value='".$row2[0]."'";
							echo">".$row2[1]."</option>";	
							$i++;
					}
						echo '</select></td>';	
					?>
                <td>
                    <a href="modif_societe.php?prec=creation><u>Modifier</u></a>
                    <!--a onclick="$('#mondiv').load('../fonctions/modif_societe.php');" style="cursor: pointer;"><u>Modifier</u></a-->
                </td>
			</tr>
			
			
			<tr>
				<td>Intitul&eacute;(*) </td>
				<td><input type="text" name="enq_lib" id="enq_lib" value="" style="width:75%;" onchange="mis_a_jour_value(this.id);"/></td>
			</tr>
		</table>
        </center>
	<br/>
	<input type="submit" class="btn btn-primary bouton"  name="enr" id="enr" value="ENREGISTRER"/>
</form>

</div>
<div style="clear:both;"></div>
<p>
</p>
</center>
</body>
</html>
