<?php require_once("../../../../libs/classes/DB.php");
require_once("../../../../libs/classes/MyMethods.php");
require_once("../../../../libs/classes/paginate.php");
require_once("../../../../libs/classes/Telenor_SMS.php");
$db = new DB(); $method = new MyMethods();$sms = new Telenor();
if($method->is_session_started() === FALSE ){ session_start();}
    if($method->isOk($_POST['a_name']) && $method->isOk($_POST['f_name']) && $method->isOk($_POST['case_sno']) &&
       $method->isOk($_POST['address']) && $method->isOk($_POST['allowed_date']) &&
       $method->isOk($_POST['caseTitle']) && $method->isOk($_POST['cus_case_no']) &&
       $method->isOk($_POST['order_date']) && $method->isOk($_POST['number_copies']) &&
       $method->isOk($_POST['fee']) && $method->isOk($_POST['cell_no']) &&
       $method->isOk($_POST['copy_date']) && $method->isOk($_POST['page_lbl_sno'])){
            $case_sno = intval($_POST['case_sno']);
            $a_name = trim($_POST['a_name']);
            $f_name = trim($_POST['f_name']);
            $address = trim($_POST['address']);
            $allowed_date = $_POST['allowed_date'];
            $order_date = $_POST['order_date'];
            $number_copies = intval($_POST['number_copies']);
            $fee = intval($_POST['fee']);
            $cell_no = $_POST['cell_no'];
            $page_lbl_sno = $_POST['page_lbl_sno'];
            $copy_date = $_POST['copy_date'];
            $entry_dated = date('Y-m-d h:i:s a');
            $cus_case_no = $_POST['cus_case_no'];
            $caseTitle = $_POST['caseTitle'];
            $is_free_of_cost = isset($_POST['is_free_of_cost']) && !empty($_POST['is_free_of_cost']) ? '1':'0';
            $pageLabels = "";
            if(is_array($page_lbl_sno )){
                foreach($page_lbl_sno as $page_lbl){
                    $pageLabels .= $page_lbl.',';
                    }
                    $pageLabels = rtrim($pageLabels,",");
                }            
            $sqlSearch = "SELECT * FROM copying_information WHERE
                                case_sno = :case_sno AND
                                a_name = :a_name AND 
                                f_name = :f_name AND 
                                address = :address AND 
                                allowed_date = :allowed_date AND 
                                order_date = :order_date AND
                                number_copies = :number_copies AND 
                                fee = :fee AND 
                                cell_no = :cell_no AND 
                                page_lbl_sno = :page_lbl AND 
                                copy_date = :copy_date
                          ORDER BY sno DESC";
            $paramSearch = array(':case_sno'=>$case_sno,':a_name'=>$a_name,':f_name'=>$f_name,':address'=>$address,
                                 ':allowed_date'=>$allowed_date,':order_date'=>$order_date,':number_copies'=>$number_copies,':fee'=>$fee,
                                 ':cell_no'=>$cell_no,':page_lbl'=>$pageLabels,':copy_date'=>$copy_date);
            if($db->dbQuery($sqlSearch,$paramSearch)){
                echo($method->errorMsg("","You just saved this information"));
                }
            else{
                $sqlInsert = "INSERT INTO copying_information 
                                    (case_sno,a_name,f_name,address,allowed_date,order_date,number_copies,fee,cell_no,page_lbl_sno,copy_date,emp_sno,entry_dated,is_free_of_cost)
                              VALUES(:case_sno,:a_name,:f_name,:address,:allowed_date,:order_date,:number_copies,:fee,:cell_no,:page_lbl_sno,:copy_date,:emp_sno,:entry_dated,:is_free_of_cost)";
                $params = array(':case_sno'=>$case_sno,':a_name'=>$a_name,':f_name'=>$f_name,':address'=>$address,
                                 ':allowed_date'=>$allowed_date,':order_date'=>$order_date,':number_copies'=>$number_copies,':fee'=>$fee,
                                 ':cell_no'=>$cell_no,':page_lbl_sno'=>$pageLabels,':copy_date'=>$copy_date,':emp_sno'=>$_SESSION['emp_sno'],':entry_dated'=>$entry_dated,':is_free_of_cost'=>$is_free_of_cost);
                //save information
                if($db->dbQuery($sqlInsert,$params)){
                    echo($method->sucMsg("","Information saved successfully- Please wait until SMS cot to the recipient"));  
                    $sms_msg = "PHC Alert:\nAttested copies in case titled: \n\n".$caseTitle."\n\nCase No:\n".$cus_case_no." \n\nhave been prepared by copying branch in PHC, Mingora Bencn\nCollect your copies from the said branch.\n\nIncharge Copying Branch";
                    if(isset($cell_no) && !empty($cell_no)){
                        $recipient_cell_no = str_replace("-","",$cell_no);//remove "-" from the cell number
                        $recipient_cell_no = ltrim($recipient_cell_no,'0');
                        $recipient_cell_no = '92'.$recipient_cell_no;
                        if($sms->sendSmsMessage($sms_msg, $recipient_cell_no)){
                            echo($method->sucMsg("","SMS Alert sent to ".$recipient_cell_no));
                        }else{
                            echo($method->errorMsg("","SMS Alert not sent to ".$cell_no));
                        }
                    }
                }
                else{
                    echo($method->errorMsg("","Due to some internal server error, information of application did not save."));   
                }
           }
       }
       else{
           echo($method->errorMsg("","Direct access to this page is not allowed"));
       }