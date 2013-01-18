<?php
    $typ_ques_id=isset($_GET['typ_ques_id'])? $_GET['typ_ques_id']:"";
	$nbr_ques=isset($_GET['nbr_ques'])? $_GET['nbr_ques']:"";
    
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html charset=iso-8859-1">
		<meta name="ROBOTS" content="all">
		<title></title>
    	<script src="../script/jquery.js"></script>
	</head>
	<body>
		<?php
		
		switch ($typ_ques_id){
			case 1:
			    include_once 'rep_texte.php'; 
				break;
			case 2:
                include_once 'rep_paragraphe.php';
				break;
			case 3:
				//include_once 'rep_choix_multiple.php';
                // echo $typ_ques_id;
                echo "Choix multiple";
                echo "<br />";
                echo "A venir";
                
				break;
			case 4:
				include_once 'rep_case.php';
                break;
			case 5:
				include_once 'rep_liste.php';
				break;
			case 6:
				//include_once 'rep_intervalle.php';
                echo "Intervalle";
                echo "<br />";
                echo "A venir";
                break;
			case 7:
				//include_once 'rep_tableau.php';
                echo "Tabeaux";
                echo "<br />";
                echo "A venir";
				break;
		}
		?>
	</body>
</html>
			