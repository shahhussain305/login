<?php 
SG::startPanel2('<i class="fas fa-home"></i> Register New Case Details', array("card_bg"=>"bg-success","body_fgColor"=>"text-dark","body_bg"=>"bg-light","body_hight"=>"body-hight","fgColor"=>"text-white")); ?>
<form class="form_reg" id="frmReg">
    <!-- Person details who submitted the case file -->
    <fieldset>
        <legend>Case Instituted By</legend>
        <div class="row">
        <div class="col-sm-6 col-md-6">
            <div class="container">
                <div class="row">
                    <div class="col-sm-5 col-md-5">Instituted By [Name]</div>
                    <div class="col-sm-7 col-md-7"><input required tabindex="1" type="text" name="ins[insti_name]" id="insti_name" placeholder="Name of the person who submitted / instituted case file" class="form-control"></div>
                </div>

                <div class="row">
                    <div class="col-sm-5 col-md-5">Country</div>
                    <div class="col-sm-7 col-md-7">
                    <select required tabindex="3" name="ins[country_sno]" onChange="getProvinces(this,'.pr','1');" id="country_sno" class="form-control">
                    <?php echo($db->countriesCms()); ?>
                    </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-5 col-md-5">Division</div>
                    <div class="col-sm-7 col-md-7 dv">
                    <select required tabindex="5" name="ins[div_sno]" id="div_sno" onChange="getDistricts(this,'.ds','1');" class="form-control">
                    </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-5 col-md-5">Tehsils</div>
                    <div class="col-sm-7 col-md-7 teh">
                    <select required tabindex="7" name="ins[teh_sno]" id="teh_sno" class="form-control">
                    </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-5 col-md-5">Full Address</div>
                    <div class="col-sm-7 col-md-7"><textarea required tabindex="9" name="ins[full_address]" id="full_address" placeholder="Full Address of the person who instituted case file" rows="3" class="form-control"></textarea></div>
                </div>              

            </div>
            
        </div>
        <div class="col-sm-6 col-md-6">
            <div class="container">

                <div class="row">
                    <div class="col-sm-5 col-md-5">Father Name</div>
                    <div class="col-sm-7 col-md-7"><input tabindex="2" type="text" name="ins[father_name]" id="father_name" placeholder="Father name of the person who instituted case file" class="form-control"></div>
                </div>

                <div class="row">
                    <div class="col-sm-5 col-md-5">Province</div>
                    <div class="col-sm-7 col-md-7 pr">
                    <select required tabindex="4" name="ins[pr_sno]" id="pr_sno" onChange="getDivision(this,'.dv','1');" class="form-control">
                    </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-5 col-md-5">District</div>
                    <div class="col-sm-7 col-md-7 ds">
                    <select required tabindex="6" name="ins[d_sno]" id="d_sno" onChange="getTehsils(this,'.teh','1');" class="form-control">
                    </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-5 col-md-5">Cell Number</div>
                    <div class="col-sm-7 col-md-7"><input required tabindex="8" type="text" name="ins[cell_no]" id="cell_no" placeholder="Cell Number of the person" class="form-control"></div>
                </div>

                <div class="row">
                    <div class="col-sm-5 col-md-5">CNIC Number</div>
                    <div class="col-sm-7 col-md-7"><input tabindex="10" type="text" name="ins[cnic]" id="cnic" placeholder="CNIC Number of the person" class="form-control"></div>
                </div>

            </div>
        </div>
    </div>
    </fieldset>

    <fieldset>
        <legend>Case Information</legend>
        <div class="row">
        <div class="col-sm-6 col-md-6">
            <div class="container">
                <div class="row">
                    <div class="col-sm-5 col-md-5">First Party</div>
                    <div class="col-sm-7 col-md-7"><input required tabindex="11" type="text" name="case[first_party]" id="first_party" placeholder="First Party in the case title" class="form-control"></div>
                </div>                

                <div class="row">
                    <div class="col-sm-5 col-md-5">Received on</div>
                    <div class="col-sm-7 col-md-7">
                    <input required tabindex="13" type="text" name="case[received_date]" id="received_date" placeholder="Case Received on date" class="form-control"></div>
                </div>

                <div class="row">
                    <div class="col-sm-5 col-md-5">Number of Pages</div>
                    <div class="col-sm-7 col-md-7"><input required tabindex="15" type="text" name="case[num_pages]" id="num_pages" placeholder="Number of pages in case file" class="form-control"></div>
                </div>
                <div class="row">
                    <div class="col-sm-5 col-md-5">Purpose of the Case</div>
                    <div class="col-sm-7 col-md-7">
                        <?php if(NULL !== PURPOSE_OF_CASE && is_array(PURPOSE_OF_CASE)){ ?>
                                <select required tabindex="17" name="case[purpose]" class="form-control">
                                <option value=""></option>
                                <?php for($p=1; $p<=count(PURPOSE_OF_CASE); $p++){ ?>
                                    <option value="<?php echo($p);?>"><?php echo(PURPOSE_OF_CASE[$p]); ?></option>
                            <?php } ?>
                            </select>
                            <?php } ?>                        
                        </div>
                </div>

            </div>
            
        </div>
        <div class="col-sm-6 col-md-6">
            <div class="container">

                <div class="row">
                    <div class="col-sm-5 col-md-5">Second Party</div>
                    <div class="col-sm-7 col-md-7"><input tabindex="12" type="text" name="case[second_party]" id="second_party" placeholder="Second party in the case title" class="form-control"></div>
                </div>

                <div class="row">
                    <div class="col-sm-5 col-md-5">Case Nature</div>
                    <div class="col-sm-7 col-md-7"><select tabindex="14" name="case[case_nature]" id="case_nature" class="form-control">
                    <?php echo($db->fillCombo("SELECT sno,DPEPNature FROM dpepcat ORDER BY DPEPNature ASC","sno","DPEPNature")); ?>
                    </select></div>
                </div>

                <div class="row">
                    <div class="col-sm-5 col-md-5">Remarks</div>
                    <div class="col-sm-7 col-md-7"><textarea required tabindex="16" name="case[case_info_remarks]" id="case_info_remarks" placeholder="Case Information Remarks if any" rows="3" class="form-control"></textarea></div>
                </div>

            </div>
        </div>
    </div>
    </fieldset>
    
    <fieldset>
        <legend>Case File (To Whome it will be Returned)</legend>
        <div class="row">
        <div class="col-sm-6 col-md-6">
            <div class="container">
                <div class="row">
                    <div class="col-sm-5 col-md-5">Person Name</div>
                    <div class="col-sm-7 col-md-7"><input required tabindex="18" type="text" name="ret['r_name']" id="r_name" placeholder="Name of the person" class="form-control"></div>
                </div>

                <div class="row">
                    <div class="col-sm-5 col-md-5">Country</div>
                    <div class="col-sm-7 col-md-7">
                    <select required tabindex="20" name="ret['r_country_sno']" onChange="getProvinces(this,'.r_pr','r_');" id="r_country_sno" class="form-control">
                    <?php echo($db->countriesCms()); ?>
                    </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-5 col-md-5">Division</div>
                    <div class="col-sm-7 col-md-7 r_dv">
                    <select required tabindex="22" name="ret['r_div_sno']" id="r_div_sno" onChange="getDistricts(this,'.ds','r_');" class="form-control">
                    </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-5 col-md-5">Tehsils</div>
                    <div class="col-sm-7 col-md-7 r_teh">
                    <select required tabindex="24" name="ret['r_teh_sno']" id="r_teh_sno" class="form-control">
                    </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-5 col-md-5">Full Address</div>
                    <div class="col-sm-7 col-md-7"><textarea required tabindex="26" name="ret['r_full_address']" id="r_full_address" placeholder="Full Address of the person" rows="3" class="form-control"></textarea></div>
                </div>

            </div>
            
        </div>
        <div class="col-sm-6 col-md-6">
            <div class="container">

                <div class="row">
                    <div class="col-sm-5 col-md-5">Father Name</div>
                    <div class="col-sm-7 col-md-7"><input tabindex="19" type="text" name="ret['r_father_name']" id="r_father_name" placeholder="Father name of the person" class="form-control"></div>
                </div>

                <div class="row">
                    <div class="col-sm-5 col-md-5">Province</div>
                    <div class="col-sm-7 col-md-7 r_pr">
                    <select required tabindex="21" name="ret['r_pr_sno']" id="r_pr_sno" onChange="getDivision(this,'.dv','r_');" class="form-control">
                    </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-5 col-md-5">District</div>
                    <div class="col-sm-7 col-md-7 r_ds">
                    <select required tabindex="23" name="ret['r_d_sno']" id="r_d_sno" onChange="getTehsils(this,'.teh','r_');" class="form-control">
                    </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-5 col-md-5">Cell Number</div>
                    <div class="col-sm-7 col-md-7"><input required tabindex="25" type="text" name="ret['r_cell_no']" id="r_cell_no" placeholder="Cell Number of the person" class="form-control"></div>
                </div>

                <div class="row">
                    <div class="col-sm-5 col-md-5">CNIC Number</div>
                    <div class="col-sm-7 col-md-7"><input tabindex="27" type="text" name="ret['r_cnic']" id="r_cnic" placeholder="CNIC Number of the person" class="form-control"></div>
                </div>

            </div>
        </div>
    </div>
    </fieldset>

    <fieldset>
        <legend>Other</legend>
        <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-12">Discussion</div>
                    <div class="col-sm-12 col-md-12"><textarea required tabindex="28" name="discussion" id="discussion" placeholder="Discussion in case file" rows="3" class="form-control"></textarea></div>
                </div>

                <div class="row">
                    <div class="col-sm-12 col-md-12">Remarks [If any]</div>
                    <div class="col-sm-12 col-md-12"><textarea tabindex="29" name="remarks" id="remarks" rows="3" placeholder="Remarks" class="form-control"></textarea></div>
                </div>
            </div>
            
        </div>
        <div class="col-sm-12 col-md-12">
            <div class="container">

                <div class="row">
                    <div class="col-sm-5 col-md-5">Next date of appointment</div>
                    <div class="col-sm-7 col-md-7"><input required tabindex="30" type="text" name="next_appointment_date" id="next_appointment_date" placeholder="Next date of appointment" class="form-control"></div>
                </div>

                <div class="row">
                    <div class="col-sm-5 col-md-5">Signature/thumb impression</div>
                    <div class="col-sm-7 col-md-7"><input tabindex="31" type="text" name="signature" id="signature" placeholder="Signature / Thumb Impression" class="form-control"></div>
                </div>                

            </div>
        </div>
    </div>
    </fieldset>

    <input tabindex="32" type="submit" name="btnSave" id="btnSave" value="Save Information" class="btn btn-success btn-sm">
    <input tabindex="33" type="reset" name="clrBtn" id="clr" value="Clear Form" class="btn btn-danger btn-sm">
    <span id="rs" style="padding-left:10px;"></span>
</form>

<?php SG::endPanel2(); ?>