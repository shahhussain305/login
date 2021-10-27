<?php SG::startPanel('p','Change Your Account Login Password','list','pageBody'); ?>
<div class="col-md-6">
        <table class="table table-responsive">
                <tr>
                    <td> Your Old Password </td>
                    <td><input type="password" required="required" id="oKey" name="oKey" placeholder="Enter Old Password" class="form-control"></td>
                </tr>
                <tr>
                    <td> New Password </td>
                    <td><input type="password" required="required" id="nKey" name="nKey" placeholder="Enter New Password" class="form-control"></td>
                </tr>
                <tr>
                    <td> Your Old Password </td>
                    <td><input type="password" required="required" id="cKey" name="cKey" placeholder="Confirm New Password" class="form-control"></td>
                </tr>
                <tr>
                    <td colspan="2"><input onclick="changePassword();" type="button" id="btnUpdate" name="btnUpdate" class="btn btn-danger" value="Change Your Password"></td>
                </tr>
	</table>
</div>
<div class="col-md-6">
    <div class="locker-bg" style="width:346px; height: 268px;">&nbsp;</div>
</div>
<span class="clearfix"></span>
<div id="msg" style="padding-left:10px;"></div>
<?php SG::endPanel(); ?>
<script language="javascript" type="text/javascript" src="<?php echo(SG::getBaseUrl());?>/mod/mod_js/hvc/functions_hvc.js"></script>