<?php
	
	$typ_ques_id=isset($_GET['typ_ques_id'])? $_GET['typ_ques_id']:"";
	
?>
<!DOCTYPE html>
<html>
    <head>

        <meta http-equiv="Content-Type" content="text/html charset=utf-8">
		<meta name="ROBOTS" content="all">
		<title></title>
    	<script src="jquery-1.2.6.js"></script>
	</head>
	<body>
		<?php
		switch ($typ_ques_id){
			case 1:
				echo '1';
		}
		?>
	</body>
</html>
			