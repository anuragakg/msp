<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php include('../parts/head-tag.php'); ?>
  <title>State Wise VDVK Count</title>
</head>

<body>
<div id="wrapper" class="w-bg">
  <?php include('../parts/side-menu.php'); ?>

  <div id="page-wrapper" class="gray-bg">
    <?php include('../parts/header.php'); ?>

    <div class="row wrapper border-bottom w-bg page-heading">
      <div class="col-lg-10">
        <h2>VDVK <span id="vdvk_status"></span> Count</h2>
        <ol class="breadcrumb">
          <li>Dashboard </li>
          <li><a herf="#">VDVK</a></li>
        </ol>
      </div>
      <div class="col-lg-2"> </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
      
      <!--  form start  -->
      <div class="row">
          <div class="ibox">
            <div class="ibox-content">
              <div class="row clear">
                <!-- <div class="col-md-2 pull-right">
                  <button class="btn btn-success btn-sm pull-right"><i class="fa fa-plus"></i> Add</button>
                </div> -->
              </div>
              <div class="row clear m-t-xs">
                  <div class="col-md-12">
                      <table class="table table-bordered" id="state-table">
                          <thead>
                          <tr>
                              <th>Sr. No.</th>                              
                              <th>Role</th>
                              <th>State Name</th>
                              <th ><span id="vdvk_count_head"></span></th>
                          </tr>
                          </thead>
                          <tbody>
                          
                          </tbody>
                      </table>
                  </div>
                </div>
                <a href="javascript:window.history.back()" class="btn btn-primary">Back</a>
            </div>
          </div>
      </div>
      
    </div>
  </div>
</div>


<?php include('../parts/js-files.php'); ?>
<script type="text/javascript" src="../assets/js/custom/dashboard/vdvk_role_statewise.js?v=<?php echo time();?>"></script>
</body>
</html>
