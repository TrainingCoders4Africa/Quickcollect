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
       include_once '../script/fonction3.php';
       include_once 'gestion_enquete.php';
       $ncod = intval($_GET['id']);
       $nlib=$_GET['lib'];
    ?>
</head>

<body style="width:100%" id="monbody">
<center><h1 style="color:#00F;">ENQUETES</h1>
<p><a href="../index.html">Retour</a></p>
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
        <?php echo $nlib;?>
    </a>
    <span>
        <img class="icon" height="9" width="5" alt="-" src="../images/item_ltr.png"/>
    </span>
    <a class="item"> 
        D&eacute;tail
    </a>
</div>

<hr />
<div id="topmenucontainer">
    <ul id="topmenu">
        <li>
           <a onclick="creer_rubrique(<?php echo $ncod;?>);" style="cursor: pointer;">Nouvelle rubrique</a>
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
    <table border>
        <thead>
            <tr>
                <th></th>
                <th><a onmouseout="if(document.getElementById('sort_arrow')){ document.getElementById('sort_arrow').src='../images/s_desc.png'; }" onmouseover="if(document.getElementById('sort_arrow')){ document.getElementById('sort_arrow').src='../images/s_asc.png'; }" title="Tri" href="liste_enquetes.php?sort_order=DESC">Libell&eacute;</a></th>
                <th colspan="6" align="center">Action</th>
            </tr>
        </thead>
        <tbody id="tbody">
            <?php
            $res = select_rubriques($ncod);
            $nbr_rubriques=mysql_num_rows($res);
            
            //r&eacute;cup&eacute;rer les enqu&ecirc;tes dans la base de donn&eacute;es
            if($nbr_rubriques==0){
                echo "Aucune rubrique trouv&eacute;e";
            }else{
                $i=1;
                while($row=mysql_fetch_row($res)){
                   ?>
                    <tr class="<?php if($i%2) {echo "even";}else{echo "odd";}?>">
                   <td align="center">
                            <input type="checkbox"/>
                            
                        </td>
                        <th style="width: 50%;">
                            <label><?php echo $row[2]; ?></label>        
                        </th>
                        <td align="center">
                            <a href="detail_rubrique.php?id=<?php echo $ncod; ?>&idr=<?php echo $row[0]; ?>&lib=<?php echo $row[3]; ?>">
                            <img class="icon" alt="D&eacute;tail" title="D&eacute;tail" src="../images/b_edit.png"/>
                            D&eacute;tail
                            </a>
                        </td>
                        <td align="center">
                            <a onclick="return confirmLink2(<?php echo $row[0]; ?>, 'Attention! Voulez-vous vraiment supprimer cette enquete avec toutes ses rubriques? Cette action est irr&eacute;versible.')" style="cursor: pointer;">
                            <img class="icon" alt="Supprimer" title="Supprimer" src="../images/supprime.gif" />
                            Supprimer
                            </a>
                        </td>
                        <td align="center">
                            <a href="visualiser_rubrique.php?id=<?php echo $row[0]; ?>">
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

</form>
</div>
<div style="clear:both;"></div>
<p>
</p>
</center>

</div>
<div style="clear:both;"></div>
<p>
</p>
</center>
</body>
</html>
