<?php //-----------------Importing Required Libraries-----------------------------
require_once("../../libs/classes/App_DB.php");
require_once("../../libs/classes/DbPathsArray.php");
require_once("../../libs/classes/MyMethods.php");
//-Creating Object and passing user info to the constructor of App_DB class-
$db = new App_DB(DBU::$dba_user);//passing database login details from DbPathArray.php file'
$method = new MyMethods();
//--------------------------------------------------------------------------------
if(isset($_SERVER['REQUEST_URI']) && !empty($_SERVER['REQUEST_URI']) && explode("?",$_SERVER['REQUEST_URI'])[0] == '/c_panel/ajaxPhp/check_authentication.php'){
    if(isset($_GET['user_id']) && !empty($_GET['user_id']) && isset($_GET['user_key']) && !empty($_GET['user_key'])){
        $userid = $_GET['user_id'];
        $userkey = $_GET['user_key'];
        //first find user id in login table
        $sq1Search = "SELECT * FROM login WHERE userid = :userid AND user_status = :user_status";
        $param = array(':userid'=>$userid,':user_status'=>'1');
        $role=0;$user_sno=0;$user_password="";
        //collect all information from login table
        $login_info = $db->getRecordSetFilled($sq1Search,$param);
        //check if user is valid with his/her user_id or not
        if(count($login_info) > 0){
            //assign values from login table
            foreach($login_info as $user){
                $role = intval($user['role']);
                $user_sno = intval($user['emp_sno']);
                $user_password = trim($user['userkey']);
            }
            //user id found lets check / compare user password (hash generated by password_hash method) MyMethods::make_hash() with varify_user() method
            if($method->varify_user($userkey,$user_password)){
                if($method->is_session_started() === FALSE){session_start();}
                $_SESSION['role'] = $role;
                $_SESSION['emp_sno'] = $user_sno;
                $_SESSION['userid'] = $userid;
                $_SESSION['userkey'] = $user_password;
                echo(json_encode(array("msg"=>'1')));
            }
            else{
                echo(json_encode(array("msg"=>'2')));
                //echo($method->errorMsg("","Authentication Failed"));//wrong password
            }
        }//no record was found
        else{
            echo(json_encode(array("msg"=>'3')));
            //echo($method->errorMsg("","Authentication Failed"));//user id did no found
        }
    }//empty or null param were sent
    else{
        echo(json_encode(array("msg"=>'4')));
        //echo($method->errorMsg("","Prohibited Access"));
    }
}//accessed from wrong url
else{
    echo(json_encode(array("msg"=>'5')));
    //echo($method->errorMsg("","Unauthorized Access!"));
}

