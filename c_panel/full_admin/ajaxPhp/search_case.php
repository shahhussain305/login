<?php require_once("../../../../libs/classes/DB.php");
require_once("../../../../libs/classes/MyMethods.php");
require_once("../../../../libs/classes/paginate.php");
$db = new DB(); $method = new MyMethods();
if(isset($_GET['keyword']) && !empty($_GET['keyword']) && isset($_GET['fld']) && !empty($_GET['fld'])){
    $keyword = trim($_GET['keyword']);
    $fld = intval($_GET['fld']);
    $param = array();
    switch ($fld){
        case '1':
            $fld = "i.first_party LIKE ";
            $param = array(':keyword'=>'%'.$keyword.'%'); 
            break;
        case '2':
            $fld = "i.second_party LIKE ";
            $param = array(':keyword'=>'%'.$keyword.'%'); 
            break;
        case '3':
            $fld = "c.cus_case_no LIKE ";
            $param = array(':keyword'=>'%'.$keyword.'%'); 
            break;
        case '4':
            $fld = "c.case_no = ";
            $param = array(':keyword'=>$keyword); 
            break;
        default :
            echo($method->errorMsg("","Please select searching criterion from the given list"));
            exit();
            break;
    }
    $sqlSearch = "SELECT DISTINCT c.sno,c.case_no,c.cus_case_no,c.institued_date,c.ins_sno,c.emp_sno,c.objections,c.dated_entry 
                    FROM  cases c,institution i
                    WHERE c.ins_sno = i.sno
                            AND ".$fld.":keyword
                    ORDER BY c.sno DESC";                    
	if($db->dbQuery($sqlSearch,$param)){ ?>        
	<div class="minHeight">
            <?php //echo($pagi->pagination);?>
            <table class="table table-bordered" style="padding:0xp !important;">
                <tr class="headingTr" style="background:#000000; color:#ffffff;">
                    <th class="w20">Case No.</th>
                    <th class="w30">Case Title</th>
                    <th class="w15">Instituted on</th>
                    <th class="w15">Attached Files</th>                    
                    <th class="w20">Councils</th>
                </tr>
                 <?php foreach($db->getRecordSet($sqlSearch,$param) as $p) {
                    $isCouncilAdded = $db->getValue("SELECT sno FROM case_councils WHERE case_sno = :case_sno",array(':case_sno'=>$p['sno']));
                    $isCouncilAdded = isset($isCouncilAdded) && !empty($isCouncilAdded) ? TRUE:FALSE;
                    ?>
                    <tr id="r<?php echo($p['sno']);?>">
                        <td>
                            <font style="color:#0000cc; font-size:13px;">Auto:</font> <?php echo($p['case_no']); ?><br>
                            <font style="color:#0000cc; font-size:13px;">Custom:</font> <?php echo($p['cus_case_no']); ?>
                        </td>
                        <td><?php echo($db->getCaseTitle($p['ins_sno'])); ?></td>       
                        <td class="no-wrap" style="text-align: center;"><?php echo($method->dateDMY($p['institued_date'])); ?></td>
                        <td style="text-align: center;"><?php 
                            $sqlCountFilesAttached = "SELECT COUNT(sno) AS total FROM cases_attach_files WHERE case_sno = :case_sno";
                            $totalFiles = $db->getValue($sqlCountFilesAttached,array(':case_sno'=>$p['sno']));
                            if(intval($totalFiles) > 0){ ?>
                            <?php echo($totalFiles); ?> Files Attached<hr>
                            <a href="javascript:void(0)" class="btn btn-primary btn-xs" onclick="showAttachedFiles('<?php echo($p['sno']); ?>');" title="Click to view attached document files">
                                View for Print                                
                            </a>
                        <?php } ?>
                        </td>
                        <td style="text-align: center;">
                           <?php if($isCouncilAdded === TRUE){ ?>
                             <?php echo($db->showCouncils($p['sno'],$method)); ?>
                           <?php }else{ ?>                            
                            <strong class="text-danger">No Counsel found</strong>
                           <?php } ?>
                        </td>
                    </tr>
                <?php					
		}//foreach()
		?>
                </table>
	</div> 
                <?php
			}
			else
			{
                            echo($method->errorMsg("","There is no case found"));
			}
			//echo($pagi->pagination);
}
else{
    echo($method->errorMsg("","Please provide searching keyword...."));
}
?>