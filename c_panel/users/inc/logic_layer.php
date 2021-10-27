<?php //-------Display page errors------------------------------------------------
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
date_default_timezone_set("Asia/Karachi");
require_once('../../security/security.php');
//-----------------Importing Required Libraries-----------------------------
require_once("../../../libs/classes/App_DB.php");
require_once("../../../libs/classes/DbPathsArray.php");

require_once("../../../libs/classes/MyMethods.php");
require_once("../../../libs/classes/var_definitions.php");
require_once("../../../libs/classes/common_globals.php");
//-Creating Object and passing user info to the constructor of App_DB class-
$db = new App_DB(DBU::$dba_user);//passing database login details from DbPathArray.php file'
$method = new MyMethods();