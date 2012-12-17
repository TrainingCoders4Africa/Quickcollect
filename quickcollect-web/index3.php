<?php
session_start();//lancement de la session
session_destroy();
require_once('fonctions/connec.inc.php');
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>QuickCollect</title>
<link href="stylelog.css" rel="stylesheet" type="text/css" />

  <?php
  //Authentification
  if(isset($_POST['valider']))
	{
	$login=isset($_POST['login'])? $_POST['login']:"";
	$mdp=isset($_POST['mdp'])? $_POST['mdp']:"";
	//$mdp=md5($mdp_nh);
	$req="SELECT * FROM `utilisateur` WHERE `login` = '$login' AND `mdp` = '$mdp'";
	$res=mysql_query($req)or die('Erreur SQL!'.'$req'.'<br />'.mysql_error());
	if(mysql_num_rows($res)==0){
		?>
		<script type="text/javascript">
			alert("Identifiant ou mot de passe incorrect! Veuillez réessayer.");
		</script>
		<?php
	}else{ 
		$row=mysql_fetch_row($res);
		$typ_user=$row[2];
		if($typ_user==1){
			?>
			<script type='text/javascript'>
				nUrl='formulaire.php';
				var urlStr = nUrl + "?login=" + "<?php echo $login; ?>" + "&typ_user=" + "<?php echo $typ_user; ?>";	
				window.location.href= ''+urlStr+'';
			</script>
			<?php
		}
	}
	}
	?>

<!DOCTYPE html>
<html lang="en" class="page">
<head>
<title>Biz Time</title>
<meta charset="utf-8">
<link rel="stylesheet" href="css/reset.css" type="text/css" media="all">
<link rel="stylesheet" href="css/layout.css" type="text/css" media="all">
<link rel="stylesheet" href="css/style.css" type="text/css" media="all">
<script type="text/javascript" src="js/jquery-1.4.2.js" ></script>
<script type="text/javascript" src="js/cufon-yui.js"></script>
<script type="text/javascript" src="js/cufon-replace.js"></script>
<script type="text/javascript" src="js/Amaranth_400.font.js"></script>
<script type="text/javascript" src="js/script.js"></script>
<script type="text/javascript" src="js/scroll.js"></script>
<script type="text/javascript" src="js/jquery.nivo.slider.pack.js"></script>
<script type="text/javascript" src="js/atooltip.jquery.js"></script>
<!--[if lt IE 9]>
<script type="text/javascript" src="js/html5.js"></script>
<style type="text/css">
	.button1, #ContactForm a {behavior:url(js/PIE.htc)}
</style>
<![endif]-->
<!--[if lt IE 7]>
<div style=' clear:both;text-align:center;position:relative'>
	<a href="http://www.microsoft.com/windows/internet-explorer/default.aspx?ocid=ie6_countdown_bannercode"><img src="http://www.theie6countdown.com/images/upgrade.jpg" border="0" alt="" /></a>
</div>
<![endif]-->
</head>
<body class="body">
<div class="body1">
	<div class="body2">
		<div class="main">
<!-- header -->
			<header>
				<div class="wrapper">
					<nav>
						<ul id="top_nav">
							<li class="bg_none"><a href="#page_Home" class="icon1"></a></li>
							<li><a href="#page_Contacts" class="icon2"></a></li>
							<li><a href="#" class="icon3"></a></li>
						</ul>
					</nav>
				</div>
				<div class="wrapper">
					<h1><a href="index.html" id="logo">Biz Time Business Company</a></h1>
					<ul id="icons">
						<li><a href="#" class="normaltip" title="Facebook"><img src="images/icon_1.png" alt=""></a></li>
						<li><a href="#" class="normaltip" title="Rss"><img src="images/icon_2.png" alt=""></a></li>
						<li><a href="#" class="normaltip" title="Twitter"><img src="images/icon_3.png" alt=""></a></li>
					</ul>
				</div>
                
                <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
                
			</header>
<!-- / header -->
		</div>
	</div>
</div>
<div class="wrapper">
	<div class="main">
		<nav>
			<ul id="menu">
				<li class="menu_active nav1">
				  <form id="form1" class="form-inline well" name="form1" method="post" action="#">
		<p>&nbsp;</p>
		<table width="379" border="0" align="center">
			<tr>
				<td>
                  <label for="login"><span>Identifiant </span></label>
                </td>
                <td>
					<input required="true" name="login" type="text" id="login" />
				</td>
            </tr>
            <tr>
              <td>
                <label for="mdp"><span class="Style3">Mot de passe</span></label>
              </td>
              <td>
				<input required="true" type="password" name="mdp" id="mdp"/>
              </td>
            </tr>
			<tr align="center">
				<td>
                
					<input class="btn btn-primary btn-large" type="submit" name="valider" id="valider" value="SE CONNECTER" onClick="if(document.getElementById('<?php echo 'login';?>').value==''){alert('Veuillez saisir un Identifiant pour continuer ...');return false;}else if(document.getElementById('<?php echo 'mdp';?>').value==''){alert('Veuillez saisir un mot de passe pour continuer ...');return false;}">
				</td>
			</tr>
        </table>
    </form>
				</li>
			</ul>
		</nav>
<!-- content -->
<!-- / content -->
	</div>
</div>
<div class="body3">
	<div class="body4">
		<div class="main">
<!-- footer -->
			<footer>
				<a href="#page_Home" id="footer_logo">Biz Time</a>
				<div><a href="http://www.templatemonster.com/" target="_blank" rel="nofollow">www.i-dev.com</a></div>
			</footer>
<!-- / footer -->
		</div>
	</div>
</div>
<script type="text/javascript"> Cufon.now(); </script>
</body>
</html>