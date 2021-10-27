<?php
$cmd = 'dashboard';
if(isset($_GET['cmd']) && !empty($_GET['cmd']) && !ctype_space($_GET['cmd'])){
	$cmd = htmlentities($_GET['cmd']);
	}
//--------------------- Use $cmd Here ------------------------
if(file_exists("pages/".$cmd.".php")){
	require_once("pages/".$cmd.".php");
	}
else{
	require_once("inc/error_page.php");
}