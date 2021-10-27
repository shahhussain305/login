<?php 
//-------Display page errors------------------------------------------------
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
date_default_timezone_set("Asia/Karachi");
require_once('../security/security.php');
//-----------------Importing Required Libraries-----------------------------
require_once("../../libs/classes/App_DB.php");
require_once("../../libs/classes/DbPathsArray.php");

require_once("../../libs/classes/MyMethods.php");
require_once("../../libs/classes/var_definitions.php");
require_once("../../libs/classes/common_globals.php");
//-Creating Object and passing user info to the constructor of App_DB class-
$db = new App_DB(DBU::$dba_user);//passing database login details from DbPathArray.php file'
$method = new MyMethods();
if(!isset($_SESSION['role']) || empty($_SESSION['role']) || intval($_SESSION['role']) != 2){header("Location: ../../../index.php?msg=invalid request!");exit();}
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo($method->baseUrl()); ?>/assets/bootstrap4/css/bootstrap.min.css">
    <link href="<?php echo($method->baseUrl()); ?>/assets/fontawesome/css/all.css" rel="stylesheet">
    <!-- Jquery Calendar -->
    <link href="<?php echo($method->baseUrl()); ?>/assets/bootstrap4/css/jquery-ui.css" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo($method->baseUrl()); ?>/assets/bootstrap4/css/users/custom.css">
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="<?php echo($method->baseUrl()); ?>/assets/jquery/jquery-3.5.1.min.js"></script>
    <script src="<?php echo($method->baseUrl()); ?>/assets/jquery/popper.min.js"></script>
    <script src="<?php echo($method->baseUrl()); ?>/assets/bootstrap4/js/bootstrap.min.js"></script>
    <!-- jQuery Calendar -->
    <script src="<?php echo($method->baseUrl()); ?>/assets/jquery/jquery-ui.js"></script>

    <script src="<?php echo($method->baseUrl()); ?>/assets/jquery/users/Users.js" ></script>
    <script src="<?php echo($method->baseUrl()); ?>/assets/jquery/users/users_functions.js" ></script>

    <title><?php echo(TITLE); ?></title>
</head>
<body>
<!-- Header of the page Start -->
<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1><?php echo(TITLE); ?></h1>      
    <p><?php echo(CONTACT); ?></p>
    <div class="emp-info">
    <?php $user = $db->getUserInfoAry($_SESSION["emp_sno"]); 
          if(count($user) > 0){
            echo('Welcome '.$user[0]["name"].'! <span class="spacer"></span>Email: '.$user[0]["email"].'<span class="spacer"></span>Mobile No: '.$user[0]["cell_no"]);
          }
    ?>
    </div>
  </div>
</div>
<!-- Header Ends -->
<div style="width:100%;"> 
  <div class="col-md-3 col-md-3 col-lg-3 col-xl-3 float-left">
             <?php require_once("inc/menu.php"); ?>
  </div>
  <div class="col-md-9 col-md-9 col-lg-9 col-xl-9 float-right">
        <div class="container-fluid">
            <?php require_once("inc/logic.php"); ?>
        </div>
  </div>
</div>
  <div style="clear:both;margin-bottom:8px;"></div>
<div class="foote">
    <div class="card-footer text-right">
        <p><?php echo(SG::footer(FOOTER)); ?></p>
    </div>
</div>
<?php echo($method->modelBox(TITLE,"box","2",AUTHER)); ?>
</body>
</html>