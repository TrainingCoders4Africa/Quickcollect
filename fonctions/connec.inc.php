<?php
	$req_connection=mysql_connect('127.0.0.1','root','');
	if($req_connection){ 
		mysql_select_db('bd_quick_collect');
	}
?>