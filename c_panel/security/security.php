<?php session_start();
if(!isset($_SESSION['userid']) || empty($_SESSION['userid']) ||
   !isset($_SESSION['userkey']) || empty($_SESSION['userkey']) ||
   !isset($_SESSION['role']) || empty($_SESSION['role']) || intval($_SESSION['role']) <= 0 ||
   !isset($_SESSION['emp_sno']) || empty($_SESSION['emp_sno'])){
		   header("Location: ../../index.php?msg=session_out");
		   }
?>