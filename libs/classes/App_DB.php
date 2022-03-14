<?php
//-----------------------Do not edit the below ----------------------//
require_once('DB.php');
class App_DB extends DB{   
    public function __construct($db_details_ary = array()) {
        try{
            if(isset($db_details_ary) && !empty($db_details_ary)){
                parent::__construct($db_details_ary);                
            }else{
                echo("Invalid User Attempt To Database!");
                exit();
            }
        }catch(Exception $exc){
            $this->tempVar = $exc->getTraceAsString();
        }
    }
    //---------------------Do not edit the above --------------------//

   public function getUserInfoAry($sno){
	try{
		return $this->getRecordSetFilled("SELECT * FROM employees WHERE sno = :sno",array(":sno"=>$sno));
		}catch(Exception $exc){
			$this->tempVar = $exc->getMessage();
		}
	}
    

    public function countriesCmb(){
        try {
            $country = $this->getRecordSetFilled("SELECT sno,lbl FROM countries WHERE is_active = 1");
            if(count($country) > 0){
                echo('<option value=""></option>');
                foreach($country as $c){
                    echo("<option value='".$c['sno']."'>".$c['lbl']."</option>");
                }
            }
        } catch (Exception $exc) {
            $this->tempVar = $exc->getMessage();
        }
    }

    public function getProvinceCmb($c_sno){//country sno to filter
        try {
            $country = $this->getRecordSetFilled("SELECT sno,lbl FROM provinces WHERE c_sno = :c_sno AND is_active = 1",array(":c_sno"=>$c_sno));
            if(count($country) > 0){
                echo('<option value=""></option>');
                foreach($country as $c){
                    echo("<option value='".$c['sno']."'>".$c['lbl']."</option>");
                }
            }else{
                echo('<option value="">No Province found</option>');
            }
        } catch (Exception $exc) {
            $this->tempVar = $exc->getMessage();
        }
    }

    public function getDivisionsCmb($pr_sno){//province sno to filter
        try {
            $divisions = $this->getRecordSetFilled("SELECT sno,lbl FROM divisions WHERE pr_sno = :pr_sno AND is_active = 1",array(":pr_sno"=>$pr_sno));
            if(count($divisions) > 0){
                echo('<option value=""></option>');
                foreach($divisions as $d){
                    echo("<option value='".$d['sno']."'>".$d['lbl']."</option>");
                }
            }else{
                echo('<option value="">No Division found</option>');
            }
        } catch (Exception $exc) {
            $this->tempVar = $exc->getMessage();
        }
    }

    public function getDistrictCmb($div_sno){//division sno to filter
        try {
            $districts = $this->getRecordSetFilled("SELECT sno,lbl FROM districts WHERE div_sno = :div_sno AND is_active = 1",array(":div_sno"=>$div_sno));
            if(count($districts) > 0){
                echo('<option value=""></option>');
                foreach($districts as $d){
                    echo("<option value='".$d['sno']."'>".$d['lbl']."</option>");
                }
            }else{
                echo('<option value="" class="text-danger">No District found</option>');
            }
        } catch (Exception $exc) {
            $this->tempVar = $exc->getMessage();
        }
    }

    public function getTehsilsCmb($d_sno){//district sno to filter
        try {
            $tehsils = $this->getRecordSetFilled("SELECT sno,lbl FROM tehsils WHERE d_sno = :d_sno AND is_active = 1",array(":d_sno"=>$d_sno));
            if(count($tehsils) > 0){
                echo('<option value=""></option>');
                foreach($tehsils as $d){
                    echo("<option value='".$d['sno']."'>".$d['lbl']."</option>");
                }
            }else{
                echo('<option value="">No Tehsil found</option>');
            }
        } catch (Exception $exc) {
            $this->tempVar = $exc->getMessage();
        }
    } 
    

}//DB()
