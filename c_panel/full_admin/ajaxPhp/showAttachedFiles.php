<?php date_default_timezone_set("Asia/Karachi");
require_once("../../../../libs/classes/DB.php");
require_once("../../../../libs/classes/MyMethods.php");
require_once("../../../../libs/classes/common_globals.php");
require_once("../../../../libs/classes/icons.php");
$db = new DB(); $method = new MyMethods();$icon = new ICON();
if(isset($_GET['case_sno']) && !empty($_GET['case_sno'])){
    $case_sno = intval($_GET['case_sno']);
    $sqlGetFileList = "SELECT sno,case_sno,file_name,file_hash,date_attached,page_lbl_sno,no_of_pages,emp_sno "
                        . "FROM cases_attach_files "
                        . "WHERE case_sno = :case_sno "
                        . "ORDER BY page_lbl_sno ASC";
    $ary = array(':case_sno'=>$case_sno);
    $case_title = $db->getCaseTitle($db->getInsSno($case_sno));
    $cus_case_no = $db->getCaseCusNumber($case_sno);
    if($db->dbQuery($sqlGetFileList,$ary)){
        ?>
        <div style="text-align: center;">
            Case Title: <strong><?php echo($case_title); ?></strong>
        </div>
        <?php //check if this file has not been requisitioned by supreme court of Pakistan or anyone else
        $is_requisitioned = $db->is_requisitioned($case_sno);//0=allow print echo $is_requisitioned;
        if($is_requisitioned === '1'){
            echo($method->errorMsg('&#x26D4; '," This Case has been requisitioned by Supreme Court of Pakistan or someone else, it is therefore, issuance of copy for this case files are not allowed."));
            exit();
        }
        ?>
        <div class="copying-register">
            Enter Applicant Details: 
            <form method="post" action="<?php echo($method->baseUrl()); ?>/mod/branches/copying/search_cases" id="saveCopyInfoFrm">
                <input type="hidden" name="caseTitle" value="<?php echo($case_title); ?>">
                <input type="hidden" name="cus_case_no" value="<?php echo($cus_case_no); ?>">
            <table class="table table-bordered">
                <tr>
                    <td class="w15">Applicant's Name</td>
                    <td class="w35">
                        <input type="hidden" name="case_sno" id="case_sno" value='<?php echo($case_sno); ?>'>
                        <input type="text" required name="a_name" id="a_name" placeholder="Applicant Name" class="form-control">
                    </td>
                    <td class="w15" style="text-align: right;">Father Name</td>
                    <td class="w35"><input type="text" required name="f_name" id="f_name" placeholder="Applicant's Father Name" class="form-control"></td>
                </tr>
                <tr>
                    <td>Address</td>
                    <td><textarea type="text" rows="2" cols="20" required name="address" id="address" placeholder="Applicant's Address" class="form-control"></textarea></td>
                    <td style="text-align: right;">Date</td>
                    <td><input type="text" required name="allowed_date" id="allowed_date" placeholder="Date on which application was allowed" class="form-control">
                    <font class="hints">[Allowed Application by Assistant Registrar yyyy-mm-dd]</font>
                    </td>
                </tr>
                <tr>
                    <td>Date</td>
                    <td><input type="text" required name="order_date" id="order_date" placeholder="Date of Order sheet/Comments or any other document" class="form-control">
                    <font class="hints">[Order sheet / Judgment etc yyyy-mm-dd]</font>
                    </td>
                    <td style="text-align: right;" class="int-only">Number of Copies</td>
                    <td><input type="text" required onkeyup="setFee($(this).val());" onblur="setFee($(this).val());" name="number_copies" id="number_copies" placeholder="Total Number of Pages / Copies Required" class="form-control">
                    <font class="hints">[Total copies of pages]</font>
                    </td>
                </tr>
                <tr>
                    <td class="int-only">Total Fee 
                        <hr>
                        <input type="checkbox" id="is_free_of_cost" name="is_free_of_cost" value="1" class="chkBox1" style="position: relative; top:-1px;"> 
                        <label for="is_free_of_cost" style="position:relative;top: -5px;border-radius: 0 10px 10px 0px !important;">
                        <span class="badge bg-rw">Free of Cost?</span> </label>
                    </td>
                    <td><input type="text" required name="fee" id="fee" placeholder="Total Paid Fee for copies" class="form-control">
                    <font class="hints">[Total Payment for Copying]</font>
                    </td>
                    <td style="text-align: right;">Recipient Number </td>
                    <td><input type="text" required name="cell_no" id="cell_no" placeholder="Cell / Mobile Number of the recipient for SMS" class="form-control">
                    <font class="hints">[Mobile Number of Recipient]</font>
                    </td>
                </tr>
                <tr>
                    <td>Issuance Date of Copy</td>
                    <td><input type="text" required name="copy_date" id="copy_date" value="<?php echo(date('Y-m-d')); ?>)" placeholder="Issuance of Copy to applicant on dated" class="form-control">
                    <font class="hints">[Order sheet / Judgment Issuance Date yyyy-mm-dd]</font>
                    </td>
                    <td style="text-align: right;">Copy of File Type</td>
                    <td>
                        <select name="page_lbl_sno[]" id="page_lbl_sno[]" multiple="multiple" style="min-height: 200px;" class="form-control">
                            <?php echo($db->fillCombo("SELECT sno,page_lbl FROM case_pages_labels ORDER BY page_lbl ASC,priority_no ASC","sno","page_lbl",array(),'0')); ?>
                        </select>
                        <font class="hints">[Order sheet / Judgment OR Name of Document Required]</font>
                    </td>
                </tr>
                <tr>
                    <td colspan="4"><input type="submit" class="btn btn-success" value="Save Information"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <span id='save_msg'></span>
                    </td>
                </tr>
            </table>
        </form>
        </div>
                <link rel="stylesheet" type="text/css" href="<?php echo(SG::getBaseUrl());?>/bootstrap/css/jquery-ui.css">
                <script language="javascript" type="text/javascript">
//                        $( function(){
//                              $("#tabs").tabs();
//                            });
                            $(function() {
                                  $('#fee,#number_copies').on('keydown', function(e){-1!==$.inArray(e.keyCode,[46,8,9,27,13,110,190])||(/65|67|86|88/.test(e.keyCode)&&(e.ctrlKey===true||e.metaKey===true))&&(!0===e.ctrlKey||!0===e.metaKey)||35<=e.keyCode&&40>=e.keyCode||(e.shiftKey||48>e.keyCode||57<e.keyCode)&&(96>e.keyCode||105<e.keyCode)&&e.preventDefault()});
                                  });
                           function setFee(number_of_copies){
                               number_of_copies = number_of_copies || 0;
                               var amount = parseInt(number_of_copies) * 2;
                               $("#fee").val(amount);
                           }
                           
//                        $( function(){
//                              $("#tabs").tabs({
//                                          show: { effect: "bounce", duration: 1000 },
//                                          active:1
//                                          }
//                                      );
//                            });    
                  $(document).ready(function(){
                        $("td").css({"font-weight":"bold","font-size":"13px"});
                        $("input,select,textarea").css({"font-weight":"normal","font-size":"12px"});
                        calendar('allowed_date')
                        $("#allowed_date").mask("9999-99-99");
                        calendar('order_date');
                        $("#order_date").mask("9999-99-99");                   
                        calendar('copy_date');
                        $("#copy_date").mask("9999-99-99");
                        $("#cell_no").mask("0399-9999999");
                        //save copy issuancee information
                        $("form#saveCopyInfoFrm").bind("submit",function(e){
                                e.preventDefault();
                                $("#save_msg").html("<img src='/sys_images/loaders/ajax-loader.gif' alt='Saving...'>");
                                    $.ajax({
                                            url: 'ajaxPhp/save_copying_information.php',
                                            data:new FormData(this),
                                            type: "POST",
                                            cache: false,
                                            processData: false,
                                            contentType:false,
                                            success: function(txt){                                                       
                                                        $("#save_msg").html(txt);
                                                        },
                                            error: function(xhr){
                                                    $("#save_msg").html("<strong class='text-danger'>Error: - "+xhr.status+" "+xhr.statusText+'</strong>');
                                            }
                                    });
                                });
              });
              function calendar(inputFld){
                    $('#'+inputFld).datepicker({dateFormat: 'yy-mm-dd',
                                    beforeShowDay: function(date) {
                                    var day = date.getDay();
                                    return [(day != 0), ''];
                                    }
                                });

                }                
        </script>
        <div id="tabs">            
            <div id="tab2" style="padding:0 !important;">
                <div class="col-md-12 col-lg-12 col-sm-12">
                    <div class="col-md-4 col-lg-2 col-sm-3">
                        <div class="indexTitle" style="margin-bottom:3px;">Index</div>
                        <ul class="indexTitle" style="overflow: auto; min-height: 390px;">
                        <?php $counter1=0; foreach($db->getRecordSet($sqlGetFileList,$ary) as $index){ ?>
                            <li style="margin-bottom: 3px !important;font-size: 14px"> 
                                <a href="javascript:void(0);" title="Click here to view this file" onclick="readFile('<?php echo($index['sno']); ?>'); return false;">
                                    <?php echo($db->getValue("SELECT page_lbl FROM case_pages_labels WHERE sno = :sno",array(":sno"=>$index['page_lbl_sno']))); ?></a>
                            </li>
                        <?php } ?>
                        </ul>
                    </div>
                    <div class="col-md-8 col-lg-10 col-sm-9">
                        <div class="pageViewer"> 
                            <h2 class="text-primary"><?php echo($icon->fa_search); ?> To View File, Click on the Index from left side Menu Bar.</h2>
                        </div>
                    </div>
                </div>
                <span class="clearfix"></span>
            </div>
        </div>
    <?php
    }
    else{
        echo($method->errorMsg("","There is no file attached to this case file or all the attached files might have been deleted"));
    }
}
else{
    echo($method->errorMsg("","Direct access to this page is not allowed"));
}