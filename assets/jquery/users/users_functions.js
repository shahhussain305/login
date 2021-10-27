$(document).ready(function(){
  try{
    setDatePicker("#received_date");
    setDatePicker("#next_appointment_date");
    //--submit registration form ----------
    $(".form_reg").bind("submit",function(e){
        e.preventDefault();
        $("#rs").html('<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>');
        saveCaseInfo();
    });

  }catch(e){
      console.log(e)
      }
  });
  function setDatePicker(el){//el could be id or class name- send parem like: setDatePicker(".Dt") or setDatePicker("#Dt")
    try{
      $( el ).datepicker({dateFormat: "yy-mm-dd"});
    }catch(e){
      console.log(e);
    }
  }
var xhttp = null;
function getXhttp() {
  try{
    if (window.XMLHttpRequest) {
      // code for modern browsers
      xhttp = new XMLHttpRequest();
      } else {
      // code for IE6, IE5
      xhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
  }catch(e){
    console.log(e);
  }
}
//-------------------------Location combos ---------------------------
function getProvinces(c_sno,holder,opt){
  try{
    if(c_sno.value != ""){
    getXhttp();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
          $(holder).html(this.responseText);
      }else{
        //loader inside option tag
        $(holder).html('<select class="form-control"><option>Loading...</option></select>');
      }
    };
      xhttp.open("GET",'../../common_ajax/getProvinces.php?c_sno='+c_sno.value+'&opt='+opt, true);
      xhttp.send();
      }
  }catch(e){
    console.log(e);
  }
}
function getDivision(pr_sno,holder,opt){
  try{
    if(pr_sno.value != ""){
    getXhttp();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        $(holder).html(this.responseText);
      }else{
        //loader inside option tag
        $(holder).html('<select class="form-control"><option>Loading...</option></select>');
      }
    };
       xhttp.open("GET",'../../common_ajax/getDivisions.php?pr_sno='+pr_sno.value+'&opt='+opt, true);
       xhttp.send();
      }
    }catch(e){
      console.log(e);
    }
}

function getDistricts(div_sno,holder,opt){
  try{  
  if(div_sno.value != ""){
    getXhttp();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        $(holder).html(this.responseText);
      }else{
        //loader inside option tag
        $(holder).html('<select class="form-control"><option>Loading...</option></select>');
      }
    };
      xhttp.open("GET",'../../common_ajax/getDistricts.php?div_sno='+div_sno.value+'&opt='+opt, true);
      xhttp.send();
    }
  }catch(e){
    console.log(e);
  }
}

function getTehsils(dis_sno,holder,opt){
  try{
    if(dis_sno.value != ""){
    getXhttp();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        $(holder).html(this.responseText);
      }else{
        //loader inside option tag
        $(holder).html('<select class="form-control"><option>Loading...</option></select>');
      }
    };
      xhttp.open("GET",'../../common_ajax/getTehsils.php?dis_sno='+dis_sno.value+'&opt='+opt, true);
      xhttp.send();
    }
  }catch(e){
    console.log(e);
  }
}

function emptyCmb(cmdId){alert(cmdId);
  try{
    $('#'+cmdId).empty();
  }catch(e){
    console.log(e);
  }
}
//----------------------------------End Location Combos------------------------
//----submit registration form ------------------------------------------------
function saveCaseInfo(){
  try{
    var frm = $("form.form_reg")[0];
    $.ajax({
        url: "ajaxPhp/save_case_info.php",
        data: new FormData(frm),
        type:"POST",
        contentType:false,
        processData:false,
        success: function(r){
          if(r == '1'){
              window.location.href = "../../../index.php?msg=Session out";
          }else if(r == 2){
                $("#rs").html(errorMsg('Empty form fields are not allowed'));
          }else if(r == 3){
                $("#rs").html(errorMsg('Same case information has already been found in our database'));
          }else if(r == 4){
                $("#rs").html(sucMsg('Case information saved successfully'));
          }else if(r == 5){
                $("#rs").html(errorMsg('Due to some internal server error, case information failed to save!'));
          }else{
            console.log(r);
          }
          },
        error: function(xhr){
          console.log(xhr);
        }
    });
  }catch(e){
    console.log(e);
  }
}
//---------------Alerts------------------------------------------
function errorMsg(msg){
  try{
        return '<strong class="text-danger"><i class="fa fa-info-circle" aria-hidden="true"></i> '+msg+'</strong>';
  }catch(e){
    console.log(e);
  }
}
function sucMsg(msg){
  try{
        return '<strong class="text-success"><i class="fa fa-check-circle" aria-hidden="true"></i> '+msg+'</strong>';
  }catch(e){
    console.log(e);
  }
}
//--------------End Alerts---------------------------------------