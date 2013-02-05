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
<?php 
if(isset($_GET['action']) && ($_GET['action']=='exporter') && (isset($_GET['id'])))
{   $num = intval($_GET['id']);
    exporter_enquete($num);
}
?>
<p><a href="../index.html">Retour au menu</a></p>
<div align="center" style="width:75%;" id="mondiv">
<div id="enqueteinfo">
    <a class="item" href="#"> 
        <img class="icon" height="16" width="16" alt="" src="../images/s_host.png" />
        Enqu&ecirc;tes
    </a>
</div>
<div id="topmenucontainer">
    <ul id="topmenu">
        <li><!--a onclick="$('#mondiv').load('creer_enquete.php');" style="cursor: pointer;"-->
            <a href="creer_enquete.php">Cr&eacute;er</a></li>
    </ul>
</div>
<hr />
<form id="tableForm" name="tableForm" action="#" method="POST" class="form-inline well">
    <center>
    <table border>
        <thead>
            <tr>
                <!--th></th-->
                <th><a onmouseout="if(document.getElementById('sort_arrow')){ document.getElementById('sort_arrow').src='../images/s_desc.png'; }" onmouseover="if(document.getElementById('sort_arrow')){ document.getElementById('sort_arrow').src='../images/s_asc.png'; }" title="Tri" href="liste_enquetes.php?sort_order=DESC">Libell&eacute;</a></th>
                <th colspan="6" align="center">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $res=select_enquetes();
            $nbr_enquetes=mysql_num_rows($res);
            
            //r&eacute;cup&eacute;rer les enqu&ecirc;tes dans la base de donn&eacute;es
            if($nbr_enquetes==0){
                echo "Aucune enqu&ecirc;te trouv&eacute;e";
            }else{
                $i=1;
                while($row=mysql_fetch_row($res)){
                   ?>
                   <tr class="<?php if($i%2) {echo "even";}else{echo "odd";}?>">
                        <!--td align="center">
                            <input type="checkbox"/>
                            
                        </td-->
                        <th style="width: 50%;">
                            <label><?php echo $row[3]; ?></label>        
                        </th>
                        <td align="center">
                            <!--a onclick="$('#mondiv').load('modifier_enquete.php?id=< ?php echo $row[0]; ?>');" style="cursor: pointer;"-->
                            <a href="modifier_enquete.php?id=<?php echo $row[0]; ?>">
                            <img class="icon" alt="Modifier" title="Modifier" src="../images/modifie.gif" />Modifier</a></td>
                        <td align="center">
                            <!--a onclick="$('#mondiv').load('detail_enquete.php?id=< ?php echo $row[0]; ?>');" style="cursor: pointer;"-->
                            <a href="detail_enquete.php?id=<?php echo $row[0]; ?>">
                            <img class="icon" alt="D&eacute;tail" title="D&eacute;tail" src="../images/b_edit.png"/>
                            D&eacute;tail
                            </a>
                        </td>
                        <td align="center">
                            <!-- onclick="return confirmLink(this, 'Attention! Voulez-vous vraiment supprimer cette enquete avec toutes ses rubriques? Cette action est irr&eacute;versible.');$('#mondiv').load('supprimer_enquete.php?id=< ?php echo $row[0]; ?>')" style="cursor: pointer;"-->
                            <a onclick="return confirmLink(<?php echo $row[0]; ?>, 'Attention! Voulez-vous vraiment supprimer cette enquete avec toutes ses rubriques? Cette action est irr&eacute;versible.')" style="cursor: pointer;">
                            <img class="icon" alt="Supprimer" title="Supprimer" src="../images/supprime.gif" />
                            Supprimer
                            </a>
                        </td>
                        <td align="center">
                            <a href="liste_enquetes.php?action=exporter&id=<?php echo $row[0]; ?>">
                            <img class="icon" alt="Exporter au format XML" title="Exporter au format XML" src="../images/export.png" />
                            Exporter
                            </a>
                        </td>
                        <td align="center">
                            <!-- onclick="$('#mondiv').load('visualiser_enquete.php?id=< ?php echo $row[0]; ?>');" style="cursor: pointer;"-->
                            <a href="visualiser_enquete.php?id=<?php echo $row[0]; ?>">
                            <img class="icon" alt="Visualiser l'enquete" title="visualiser l'enquete" src="../images/afficher.png" />
                            Visualiser
                            </a>
                        </td>
                   </tr>
                   <?php 
                 $i++;     
                }
            }      
            ?>
        </tbody>
    </table>
    </center>
</form>
</div>
<div style="clear:both;"></div>
<p>
</p>
</center>
</body>
</html>
