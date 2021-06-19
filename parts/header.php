<style type="text/css">
  #loader-div{
       width: 100%;
    height: 100vh;
    background: #ffffff4a;
    position: fixed;
    z-index: 9999;
    text-align: center;
    margin-top: 40vh;


  }
</style>
<div id="disable-div"></div>
<div id="loader-div" style="display: none"></div>
<div class="row border-bottom">
  <nav class="navbar navbar-static-top nav-bg" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header"> <a class="navbar-minimalize minimalize-styl-2" href="#">
	<!--<i class="fa fa-bars text-white size-20"></i>--><img src="../assets/img/toggle-menu.png"> </a> </div>
    <div class="col-md-4 site-title">
      <img src="../assets/img/small_logo.jpg">
      <h1>MSP FOR MFP YOJANA <span>MSP FOR MFP, Govt. of India</span></h1>

    </div>
    <div class="col-md-4">  <div class="van-dhan-logo"><img src="../assets/img/pmydy-logo.png" alt="Trifed logo"><span class="sub-h">MSP FOR MFP INTEGRATED SYSTEM</span></div> </div>
    <div class="col-md-3 text-right">
      <div class="row">
        <ul class="nav navbar-top-links navbar-right">
          <!-- <li class="dropdown"> <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#"> <i class="fa fa-bell"></i> <span class="label label-primary">8</span> </a>
            <ul class="dropdown-menu dropdown-alerts">
              <li> <a href="#">
                  <div> <i class="fa fa-envelope fa-fw"></i> You have 16 messages </div>
                </a> </li>
              <li class="divider"></li>
              <li> <a href="#">
                  <div> <i class="fa fa-envelope fa-fw"></i> You have 16 messages </div>
                </a> </li>
            </ul>
          </li> -->
          <li>
            <a href="../notification-management/notification-view.php">
              <i class="fa fa-bell" style="font-size:20px" aria-hidden="true">
                <span class="badge badge-light notification-count"></span>
              </i>
            </a>
          </li>
          <li class="dropdown"> 
            <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#"> 
              <!-- <img src="../assets/img/profile_small.jpg" class="img-circle userimg" alt="User"> -->
              <label class="logged-in-user text-white">kamal Rawat </label>  <i class="fa fa-angle-down text-white"></i>
            </a>
            <ul class="dropdown-menu animated fadeInRight m-t-xs">
              <li><a href="../user/user-profile.php">Profile</a></li>
              <li><a href="#" data-toggle="modal" data-target="#forgot-password">Change Password</a></li>
              <li><a href="../user/activity-log.php">Activity Log</a></li>
              <li><a href="#" onclick="TRIFED.logout();">Logout</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</div>
<!--Forgot Password Window-->
<div class="modal" id="forgot-password" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content animated flipInX">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Change Password</h4>
      </div>
      <div class="modal-body clear">
        <div class="row">
          <div class="col-sm-12">
            <div class="form-group">
              <label class="col-sm-4 p-xs  control-label">Old Password</label>
              <div class="col-sm-8">
                <input 
 autocomplete="off" type="password" id="old_password" class="form-control mdt_feild required" placeholder="Old Password">
              </div>
            </div>
          </div>
          <div class="col-sm-12">
            <div class="form-group">
              <label class="col-sm-4 p-xs  control-label">New Password</label>
              <div class="col-sm-8">
                <input 
 autocomplete="off" type="password" id="password" class="form-control mdt_feild required" placeholder="New Password">
              </div>
            </div>
          </div>
          <div class="col-sm-12">
            <div class="form-group">
              <label class="col-sm-4 p-xs  control-label">Confirm New Password</label>
              <div class="col-sm-8">
                <input 
 autocomplete="off" type="password" id="confirm_password" class="form-control mdt_feild required" placeholder="Confirm New Password">
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
        <button type="button" id="changePassword" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<!--End Window-->
<div id="error_div" class="alert alert-danger" style="display:none">
</div>


<?php
//include(__DIR__ . '/../ajax_loader.php');
?>

<script type="text/javascript">
  let loggedUser = JSON.parse(localStorage.getItem('authUser'));
  let userDetails = { 
    'name'      : loggedUser['name'].length>15 ? loggedUser['name'].substr(0,15)+'...': loggedUser['name'],
    'role_name' : loggedUser['role_name'],
    'state'     : loggedUser['state'] ? loggedUser['state'] : '',
    'district'  : loggedUser['district'] ? loggedUser['district'] : '',
    'block'     : loggedUser['block'] ? loggedUser['block'] : '',
  };
  
  document.getElementById('role_name_sidebar').innerHTML = userDetails.role_name;
  if(loggedUser['role']!=1)
  {
	if(userDetails.state !== '')
		document.getElementById('state_sidebar').innerHTML = "State : " + userDetails.state;
	  
	  if(userDetails.district !== '')
		document.getElementById('district_sidebar').innerHTML = "District : " + userDetails.district;

	  if(userDetails.block !== '')
		document.getElementById('block_sidebar').innerHTML = "Block : " + userDetails.block;  
  }
  
  
  document.getElementsByClassName('logged-in-user')[0].innerHTML = userDetails.name;

</script>

