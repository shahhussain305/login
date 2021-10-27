<?php require_once("../../../../libs/classes/DB.php");
require_once("../../../../libs/classes/MyMethods.php");
require_once("../../../../libs/classes/icons.php");
$db = new DB(); $method = new MyMethods();$icon = new ICON();
if(isset($_GET['from_date']) && !empty($_GET['from_date']) && isset($_GET['to_date']) && !empty($_GET['to_date'])){
    $from_date = $_GET['from_date'];
    $to_date = $_GET['to_date'];
    $case_sno = '';
    $totalFee = 0;
    $totalCopies = 0;
    $sql = "SELECT 
                sno,case_sno,a_name,f_name,address,allowed_date,order_date,number_copies,fee,cell_no,page_lbl_sno,copy_date,emp_sno,entry_dated,is_free_of_cost 
            FROM
                copying_information 
            WHERE copy_date BETWEEN :from_date AND :to_date";
    $ary = array(':from_date'=>$from_date,':to_date'=>$to_date);
    $freeCost = 0;
        if($db->dbQuery($sql,$ary)){
            ?>
            <style>
                td,th{
                    text-align: left !important;
                    vertical-align: middle !important;
                }
            </style>
            <div style="text-align: center;padding:5px;">
                <strong>Report for Dated From: <?php echo($method->dateDMY($from_date)); ?> To <?php echo($method->dateDMY($to_date)); ?></strong>
            </div>
                <table class="table table-bordered">
                    <tr style="font-size:12px; font-family:'book antiqua';background:#f2f2f2; color:#000;white-space: nowrap;overflow: hidden;">
                        <th style="width:4% !important;">S.No</th>
                        <th style="width:17% !important;">Name</th>
                        <th style="width:17% !important;">Father Name</th>
                        <th style="width:23% !important;">Address</th>
                        <th style="width:7% !important;"># Copies</th>
                        <th style="width:7% !important;">Fee</th>
                        <th style="width:19% !important;">Pages Copy</th>
                        <th style="width:6% !important;">Order Date</th>
                    </tr>
                <?php $counter = 0; foreach($db->getRecordSet($sql,$ary) as $rpt){ 
                        $case_sno = $rpt['case_sno']; 
                        $totalFee += intval($rpt['fee']);
                        $totalCopies += intval($rpt['number_copies']);
                        ?>
                    <tr style="font-family: 'book antiqua'; font-size: 11px;">
                        <td rowspan="2" style="text-align:center !important;"><?php echo($counter += 1); ?></td>
                        <td><?php echo($rpt['a_name']); ?>
                        <?php if(isset($rpt['is_free_of_cost']) && !empty($rpt['is_free_of_cost']) && $rpt['is_free_of_cost'] == '1'){ 
                            $freeCost += $rpt['fee'];
                            ?> 
                            <br><strong class="text-danger">{Free of Cost}</strong>
                        <?php } ?>
                        </td>
                        <td><?php echo($rpt['f_name']); ?></td>
                        <td><?php echo($rpt['address']); ?>
                            <div style="white-space: nowrap;overflow: hidden;">
                                <strong style="color:#000;">&#128222;</strong> <?php echo($rpt['cell_no']); ?>
                            </div>
                        </td>
                        <td style="text-align:right !important;"><?php echo($rpt['number_copies']); ?></td>
                        <td style="text-align:right !important;"><?php echo($rpt['fee']); ?></td>
                        <td><ul style="padding-left:10px !important;"><?php
                                foreach($db->getRecordSet("SELECT page_lbl FROM case_pages_labels WHERE sno IN(".$rpt['page_lbl_sno'].")") as $lbl){
                                    echo('<li><span class="spn">'.$lbl['page_lbl'].'</span></li>'); 
                                    }
                                ?>
                            </ul>
                        </td>
                        <td style="white-space: nowrap;overflow: hidden;"><?php echo($method->dateDMY($rpt['order_date'])); ?></td>
                    </tr>
                    <tr>
                        <td colspan="8" style="font-family: 'book antiqua'; font-size: 10px;">
                                    <strong>Title:</strong> <?php echo($db->getCaseTitleByCaseSno($case_sno)); ?>
                                    <br>
                                    <strong>Case Number:</strong> <?php echo($db->getCaseCusNumber($case_sno)); ?> <?php echo(str_repeat("&nbsp;",3)); ?> 
                                    <strong>Auto Number:</strong> <?php echo($db->get_caseNumber("",$case_sno)); ?> <?php echo(str_repeat("&nbsp;",3)); ?>
                                    <strong>Issued On:</strong> <?php echo($method->dateDMY($rpt['copy_date'])); ?> <?php echo(str_repeat("&nbsp;",3)); ?> 
                                    <strong>Allowed On:</strong> <?php echo($method->dateDMY($rpt['allowed_date'])); ?>
                        </td>
                    </tr>
                <?php } ?>
                    <tr style="font-weight: bold !important;">
                        <td colspan="4" style="text-align: right !important; padding-right:5px;">
                            <strong class="text-primary">Grand Total Issued Copies & Price: </strong>
                        </td>
                        <td style="text-align:right !important;"><?php echo($totalCopies); ?></td>
                        <td style="text-align:right !important;"><?php echo($totalFee);?> </td>
                        <td colspan="2" style="text-align: left;font-size:12px;">Total Fee= <?php echo($totalFee); ?> - Free= <?php echo($freeCost); ?>: Grand Total: <?php echo($totalFee - $freeCost); ?> Pkr</td>
                    </tr>
                </table>
                <style>.modal-body{padding:0px !important;}</style>
                <link rel="stylesheet" type="text/css" href="<?php echo($method->baseUrl());?>/libs/printer/demo/css/normalize.min.css">
            <?php
            }
        else{
            echo($method->errorMsg("","Sorry, No record was found"));
        }
    }
else{
    echo($method->errorMsg("","Direct access to this page is not allowed"));
}