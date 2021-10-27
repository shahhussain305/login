<?php
require_once("../../libs/classes/MyMethods.php");
$method = new MyMethods();
if($method->is_session_started() === FALSE){session_start();}
if(isset($_SESSION['role']) && !empty($_SESSION['role']) && 
   isset($_SESSION['emp_sno']) && !empty($_SESSION['emp_sno']) &&
   isset($_SESSION['userid']) && !empty($_SESSION['userid']) && 
   isset($_SESSION['userkey']) && !empty($_SESSION['userkey'])){
    switch(intval($_SESSION["role"])){
        case 1:
            //reserved user- do nothing yet
        break;
        case 2:
            header("Location: ../users/");
        break;
        case 3:
            header("Location: ../full_admin/");
        break;
        default:
            header("Location: ../../index.php?msg=invalid try!");
    break;
    }
}else{
    header("Location: ../../index.php?msg=invalid try!");
}