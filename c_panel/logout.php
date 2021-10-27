<?php session_start(); 
$_SESSION['userid'] = '';
$_SESSION['userkey'] = '';
$_SESSION['role'] = '';
$_SESSION['emp_sno'] = '';
header("Location: ../index.php");