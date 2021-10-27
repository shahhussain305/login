<?php
require_once("../../../../libs/classes/DB.php");
require_once("../../../../libs/classes/MyMethods.php");
require_once("../../../../libs/classes/common_globals.php");
require_once("../../../../libs/classes/icons.php");
$db = new DB(); $method = new MyMethods();$icon=new ICON();
if(isset($_GET['sno']) && !empty($_GET['sno'])){
    $sno = intval($_GET['sno']);
    $sqlGetFiles = "SELECT file_name,file_hash FROM cases_attach_files WHERE sno = :sno";
    $ary = array(':sno'=>$sno);
    if($db->dbQuery($sqlGetFiles,$ary)){
       foreach($db->getRecordSet($sqlGetFiles,$ary) as $files){ 
            $check_file = $db->check_ducment_hash($files['file_name'],$sno);
            $is_file_authentic = $check_file == 1 ? '<strong class="text-success">Ok '.$icon->gl_ok.'<strong>': '<strong class="text-danger">File Not Authentic '.$icon->gl_remove.'</strong>'; ?>
                <h3 style="text-decoration: underline; font-family:Book Antiqua">Document File Genuine / Validity Test Result: <?php echo($is_file_authentic); ?></h3>
                <?php if($check_file == 1){ ?>
                <object data="<?php echo(SG::getBaseUrl()); ?>/case_files/<?php echo($files['file_name']); ?>" type="application/pdf" style="width:100%; min-height:700px;">
                    <a href="<?php echo(SG::getBaseUrl()); ?>/case_files/<?php echo($files['file_name']); ?>">Download File</a>
                </object>
                <?php }else{ ?>
                <h1 class="text-danger"><?php echo($icon->gl_warning_sign); ?> Please contact to the system administrator to verify the selected document file.</h1>
        <?php
                }//check document validity
       }//foreach()
    }
    else{
        echo($method->errorMsg("","The page you are looking for is no longer existing."));
    }
}
else{
    echo($method->errorMsg("","Direct access to this page is not allowed"));
}