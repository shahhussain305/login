<?php //-------Display page errors------------------------------------------------
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
date_default_timezone_set("Asia/Karachi");
//-----------------Importing Required Libraries-----------------------------
require_once("../../../libs/classes/App_DB.php");
require_once("../../../libs/classes/DbPathsArray.php");

require_once("../../../libs/classes/MyMethods.php");
//-Creating Object and passing user info to the constructor of App_DB class-
$db = new App_DB(DBU::$dba_user);//passing database login details from DbPathArray.php file'
$method = new MyMethods();
if($method->is_session_started() === FALSE){session_start();}
if(!isset($_SESSION['role']) || empty($_SESSION['role']) || intval($_SESSION['role']) != 2){echo('1');exit();}
if(isset($_POST['ins']) && !empty($_POST['ins']) && isset($_POST['case']) && !empty($_POST['case']) && 
   isset($_POST['ret']) && !empty($_POST['ret']) && isset($_POST['discussion']) && !empty($_POST['discussion']) && 
   isset($_POST['next_appointment_date']) && !empty($_POST['next_appointment_date'])){
        $ins = json_encode($_POST['ins']);
        $case = json_encode($_POST['case']);
        $ret = json_encode($_POST['ret']);
        $discussion = $_POST['discussion'];
        $next_appointment_date = $_POST['next_appointment_date'];
        $remarks = isset($_POST['remarks']) && !empty($_POST['remarks']) ? trim($_POST['remarks']):'';
        $signature = isset($_POST['signature']) && !empty($_POST['signature']) ? trim($_POST['signature']):'';
        //search the same case details before saving...
        $sql_search = "SELECT * FROM case_information 
                       WHERE case_info->>'$.first_party' = :first_party 
                            AND case_info->>'$.second_party' = :second_party 
                            AND case_info->>'$.case_nature' = :case_nature
                            AND case_info->>'$.received_date' = :received_date";
        $parem_search = array(':first_party'=>$_POST['case']["first_party"],
                              ':second_party'=>$_POST['case']["second_party"],
                              ':case_nature'=>$_POST['case']["case_nature"],
                              ':received_date'=>$_POST['case']["received_date"]);
            if($db->dbQuery($sql_search,$parem_search)){
                echo('3');
            }else{
                //insert new record
                $sql_insert = "INSERT INTO case_information (
                    case_info,
                    instituted_by,
                    returned_to,
                    discussion,
                    remarks,
                    next_date_apt,
                    person_signature,
                    entry_made_on
                  )
                  VALUES
                    (
                    :case_info,
                    :instituted_by,
                    :returned_to,
                    :discussion,
                    :remarks,
                    :next_date_apt,
                    :person_signature,
                    :entry_made_on  
                    )";
                $param = array(
                            ':case_info'=>$case,
                            ':instituted_by'=>$ins,
                            ':returned_to'=>$ret,
                            ':discussion'=>$discussion,
                            ':remarks'=>$remarks,
                            ':next_date_apt'=>$next_appointment_date,
                            ':person_signature'=>$signature,
                            ':entry_made_on'=>date('Y-m-d')
                            );
                    //echo($sql_insert);
                    if($db->dbQuery($sql_insert,$param)){
                            echo('4');
                    }else{
                        echo('5');
                    }
            }
   }else{
       echo('2');
   }