<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php include('../parts/head-tag.php'); ?>
  <title>View Release Wise Sanctioned Amount</title>
</head>

<body>
<div id="wrapper" class="w-bg">
  <?php include('../parts/side-menu.php'); ?>

  <div id="page-wrapper" class="gray-bg">
    <?php include('../parts/header.php'); ?>

    <div class="row wrapper border-bottom w-bg page-heading">
      <div class="col-lg-10">
        <h2>View Release Wise Sanctioned Amount </h2>
        <ol class="breadcrumb">
          <li><a href="../auth/dashboard.php">Dashboard</a></li>
          <li><a herf="#">View Release Wise Sanctioned Amount</a></li>
        </ol>
      </div>
      <div class="col-lg-2"> </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
      
      <!--  form start  -->
      <div class="row">
          <div class="ibox">
            <div class="ibox-content">
              <div class="row clear"></div>
              <div class="row clear m-t-xs">
                  <div class="col-md-12">
                      <table class="table table-bordered" id="state-table">
                          <thead>
                          <tr>
                              <th>Sr. No.</th> 
                              <th>VDVK Name</th>     
                              <th>Released Amount (Rs.)</th>
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
<script type="text/javascript" src="../assets/js/custom/dashboard/view_sanctioned_releasewise.js?v=2.0"></script>
</body>
</html>
