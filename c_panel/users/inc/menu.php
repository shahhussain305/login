<div class="container-fluid">
  <div class="card bg-success text-white">
      <div class="card-header">Menu</div>
      <div class="card-body bg-white">
        <ul class="nav-bar">
            <li><a href="<?php echo($method->baseUrl().PATH_USER);?>"><i class="fa fa-home"></i> Home</a></li>
            <li><a href="<?php echo($method->baseUrl().PATH_USER);?>/new_page_name_without_extention"><span class="fa fa-address-card"></span> Link to new page </a></li>
            <li><a href="<?php echo($method->baseUrl().PATH_USER);?>/logout"><span class="fa fa-address-card"></span> Logout</a></li>
        </ul>
      </div>
  </div>
</div>