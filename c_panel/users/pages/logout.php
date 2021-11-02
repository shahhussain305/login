<?php if($method->is_session_started === FALSE){session_start();}
$_SESSION['role'] = NULL;
$_SESSION['emp_sno'] = NULL;
$_SESSION['userid'] = NULL;
$_SESSION['userkey'] = NULL;
header("Location: ../../../index.php?msg=logout");