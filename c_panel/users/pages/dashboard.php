<?php 
SG::startPanel2('<i class="fas fa-home"></i> '.TITLE, array("card_bg"=>"bg-success","body_fgColor"=>"text-dark","body_bg"=>"bg-light","body_hight"=>"body-hight","fgColor"=>"text-white")); ?>
<div class="container">
    <div class="row">
        <div class="col-sm-4 col-md-4">
            <div class="card">
                <div class="card-body small-box bg-small-box">Register New Case</div>
                <div class="card-footer bg-light text-white">
                <a href="<?php echo($method->baseUrl().PATH_USER);?>/register_new_case" title="Click here to register new case details">
                <span class="fa fa-address-card"></span> Click Here
                </a>
                </div>
            </div>
        </div>

        <div class="col-sm-4 col-md-4">
            <div class="card">
                <div class="card-body small-box bg-small-box">District Courts</div>
                <div class="card-footer bg-light text-white">
                <a href="<?php echo($method->baseUrl()); ?>/c_panel/users/register_new_case" title="Click here to register new case details">
                <span class="fa fa-home"></span> Click Here
                </a>
                </div>
            </div>
        </div>

        <div class="col-sm-4 col-md-4">
            <div class="card">
                <div class="card-body small-box bg-small-box">Peshawar High Court</div>
                <div class="card-footer bg-light text-white">
                <a href="<?php echo($method->baseUrl()); ?>/c_panel/users/register_new_case" title="Click here to register new case details">
                <span class="fa fa-home"></span> Click Here
                </a>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<div class="container">
    <div class="row">
        <div class="col-sm-4 col-md-4">
            <div class="card">
                <div class="card-body small-box bg-small-box">Comming Appointments</div>
                <div class="card-footer bg-light text-white">
                <a href="<?php echo($method->baseUrl()); ?>/c_panel/users/register_new_case" title="Click here to register new case details">
                <i class='far fa-comment-dots'></i> Click Here
                </a>
                </div>
            </div>
        </div>
        <div class="col-sm-4 col-md-4">
            <div class="card">
                <div class="card-body small-box bg-small-box">Need Help?</div>
                <div class="card-footer bg-light text-white">
                <a href="<?php echo($method->baseUrl()); ?>/c_panel/users/register_new_case" title="Click here to register new case details">
                <i class='fa fa-info-circle'></i> Click Here
                </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php SG::endPanel2(); ?>