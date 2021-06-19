<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php include('../parts/head-tag.php'); ?>
  <title>Release Wise Sanctioned Amount</title>
</head>

<body>
<div id="wrapper" class="w-bg">
  <?php include('../parts/side-menu.php'); ?>

  <div id="page-wrapper" class="gray-bg">
    <?php include('../parts/header.php'); ?>

    <div class="row wrapper border-bottom w-bg page-heading">
      <div class="col-lg-10">
        <h2>Release Wise Sanctioned Amount </h2>
        <ol class="breadcrumb">
          <li><a href="../auth/dashboard.php">Dashboard</a></li>
          <li><a herf="#">Release Wise Sanctioned Amount</a></li>
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
                <form method="GET">
                        <div class="row ibox">
                          <div class="col-md-2">
                            <select class="form-control" id="state" name="state_id">
                              <option>State</option>
                            </select>
                          </div>
                            <div class="col-md-2">
                            <button type="submit" class="btn btn-primary btn-sm">Search</button>
                          </div>
                        </div>
                      </form>
              </div>
              <div class="row clear m-t-xs">
                  <div class="col-md-12">
                      <table class="table table-bordered" id="state-table">
                          <thead>
                          <tr>
                              <th>Sr. No.</th> 
                              <th>State Name</th>                             
                              <th>SND User Name</th>
                              <th >Number of VDVKs</th>
                              <th >Total Sanctioned Amount (Rs.)</th>
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
<script type="text/javascript" src="../assets/js/custom/dashboard/sanctioned_releasewise.js?v=2.0"></script>
</body>
</html>
