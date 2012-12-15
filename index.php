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
</head>

<body>
	<div align="center">
	<form id="form1" name="form1" method="post" action="#">
		<table width="329" border="0">
			<tr>
				<td>
                  <label><span>Identifiant </span></label>
                </td>
                <td>
					<input name="login" type="text" id="login" />
				</td>
            </tr>
            <tr>
              <td>
                <label><span class="Style3">Mot de passe</span></label>
              </td>
              <td>
				<input type="password" name="mdp" id="mdp"/>
              </td>
            </tr>
			<tr align="center">
				<td>
					<input type="submit" name="valider" id="valider" value="SE CONNECTER" onclick="if(document.getElementById('<?php echo 'login';?>').value==''){alert('Veuillez saisir un Identifiant pour continuer ...');return false;}else if(document.getElementById('<?php echo 'mdp';?>').value==''){alert('Veuillez saisir un mot de passe pour continuer ...');return false;}">
				</td>
			</tr>
        </table>
    </form>
	</div>
<div align="center">Copyright © 2012, Coders4Africa </div>
</body>
</html>