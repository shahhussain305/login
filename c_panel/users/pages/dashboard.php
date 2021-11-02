<?php 
SG::startPanel2('<i class="fas fa-home"></i> '.TITLE, array("card_bg"=>"bg-success","body_fgColor"=>"text-dark","body_bg"=>"bg-light","body_hight"=>"body-hight","fgColor"=>"text-white")); ?>
<div class="container">
    <div class="row">
        
        <div class="col-sm-4 col-md-4">
            <div class="card">
                <div class="card-body small-box bg-small-box">Need Help?</div>
                <div class="card-footer bg-light text-white">
                <a href="<?php echo($method->baseUrl()); ?>/c_panel/users/help" title="Click here to register new case details">
                <i class='fa fa-info-circle'></i> Click Here
                </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php SG::endPanel2(); ?>