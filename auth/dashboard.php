<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php include('../parts/head-tag.php'); ?>
  <title>Dashboard</title>
  <!-- orris -->
  <link href="../assets/css/plugins/morris/morris-0.4.3.min.css" rel="stylesheet">
  <style type="text/css">
  	.counter-area a {
    color: #fff;
}
  </style>
</head>

<body>
<div id="wrapper" class="w-bg">

  <?php include('../parts/side-menu.php'); ?>

  <div id="page-wrapper" class="gray-bg">

    <?php include('../parts/header.php'); ?>

    <div class="row wrapper border-bottom w-bg page-heading">
      <div class="col-lg-10">
        <h2 class="font-normal">Dashboard</h2>
      </div>
      <div class="col-lg-2"> </div>
    </div>
    <div class="wrapper wrapper-content"  style="display:none;">
      <div class="row">
        <div class="col-lg-12 col-md-12">
          <div class="row ibox custom-select">
            <div class="col-md-3">
              <select class="form-control" id="state">
                <option>State</option>
              </select>
            </div>
            <div class="col-md-3">
              <select class="form-control" id="district">
                <option value="">District</option>
              </select>
            </div>
            <div class="col-md-3">
              <select class="form-control" id="block">
                <option value="">Block wise data</option>
              </select>
            </div>
            <div class="col-md-3">
              <button type="button" class="btn btn-primary">Search</button>
            </div>
          </div>
		  <!-- card layout starts here -->
          <div class="row">
            <div class="card-row">
              <div class="dash-card color-4 shaow-wid" onclick="get_vdvk_rolewise_count(0)">
                <img src="../assets/img/menuicon/clock-white.png">
        <div class="center-part"><h3>VDVK <br>Proposals Pending for Approval</h3></div>
        <div class="counter-area"><span class="counter pending_count">0</span></div>
              </div>
            
              <div class="dash-card color-5 shaow-wid" onclick="get_vdvk_statewise_count(1)">
                <img src="../assets/img/menuicon/approved-icon.png">
        <div class="center-part"><h3>VDVK <br>Proposals Approved </h3></div>
        <div class="counter-area"><span class="counter approved_count">0</span></div>
              </div>
               <div class="dash-card color-5 shaow-wid" onclick="sanctioned_sndwise()">
                <img src="../assets/img/menuicon/amount_sanctioned.png">
        <div class="center-part"><h3>VDVK <br> Funds Sanctioned </h3></div>
        <div class="counter-area"> <span class="counter sanction_amount">0</span></div>
              </div>

               <div class="dash-card color-5 shaow-wid" onclick="sanctioned_releasewise()">
                <img src="../assets/img/menuicon/fund_release.png">
        <div class="center-part"><h3>VDVK <br> Funds Released </h3></div>
        <div class="counter-area"><span class="counter released_amount">0</span></div>
              </div>
<div class="dash-card" style="background: transparent;"> </div>

              

</div></div>
<div class="row">
            <div class="card-row">
              <div class="dash-card color-1 shaow-wid" onclick="window.location='../survey-forms/shg-statewise.php'">
                <img src="../assets/img/menuicon/tribal-a.png">
				<div class="center-part"><h3>Tribal Beneficiaries</h3></div>
				<div class="counter-area"><span class="counter tribal_gatherers">0</span></div>
              </div>
              <div class="dash-card color-3 shaow-wid" onclick="window.location='../auth/state_shg_gatherer.php'">
                <img src="../assets/img/menuicon/shg_gatherer_dashboard.png">
        <div class="center-part"><h3>SHG Groups</h3></div>
        <div class="counter-area"><span class="counter shg_group">0</span></div>
              </div>
              <div class="dash-card color-2 shaow-wid" onclick="get_warehouse_statewise_count(1)">
                <img src="../assets/img/menuicon/warehouses-white.png">
				<div class="center-part"><h3>No. of Warehouses</h3></div>
				<div class="counter-area"><span class="counter ware_houses">0</span></div>
              </div>
            
              <div class="dash-card color-3 shaow-wid" onclick="get_haatbazaar_statewise_count()">
                <img src="../assets/img/menuicon/haat-bazaars-white.png">
				<div class="center-part"><h3>No. of Haat Bazaar</h3></div>
				<div class="counter-area"><span class="counter haat_market">0</span></div>
              </div>
             <div class="dash-card" style="background: transparent;"> </div>
              
            </div>
          </div>
          <div class="row">
            <div class="card-row">
              <div class="dash-card color-1 shaow-wid" onclick="window.location='../auth/statewise-surveyor.php'">
                <img src="../assets/img/menuicon/surveyor.png">
                <div class="center-part"><h3>No. of Surveyor</h3></div>
                <div class="counter-area">
                  <span class="counter surveyor">0</span>
                </div>
              </div>

              <div class="dash-card color-1 shaow-wid" onclick="window.location='../auth/statewise-supervisor.php'">
                <img src="../assets/img/menuicon/supervisor.png">
                <div class="center-part"><h3>No. of Supervisor</h3></div>
                <div class="counter-area">
                  <span class="counter supervisor">0</span>
                </div>
              </div>

            </div>
          </div>
          <div class="row"> 
            <!--Graph Section 1-->
            <div class="col-lg-6">
              <div class="ibox float-e-margins">
                <div class="ibox-title"> <!-- <img class="img-responsive" src="../assets/img/line-graph.jpg">  -->
               
                  <div class="row"><div class="col-md-12" id="vdvk_approved" ></div></div>
                </div>
                <div class="ibox-content">
                  <div id="morris-bar-chart"></div>
                </div>
              </div>
            </div>
            <!--Graph Section 2-->
            <div class="col-lg-6">
              <div class="ibox float-e-margins">
                <div class="ibox-title"> <!-- <img class="img-responsive" src="../assets/img/line-graph.jpg">  -->
               
                  <div class="row"><div class="col-md-12" id="amount_sanctioned" ></div></div>
                </div>
                <div class="ibox-content">
                  <div id="morris-bar-chart"></div>
                </div>
              </div>
            </div>
          </div>

          

        </div>
      </div>
    </div>
  </div>
</div>
<style type="text/css">
  .dash-card {
    cursor: pointer;
}
</style>
<?php include('../parts/js-files.php'); ?>

<!-- Jvectormap --> 
<script src="../assets/js/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js"></script> 
<script src="../assets/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script> 


<!-- EayPIE --> 
<script src="../assets/js/plugins/easypiechart/jquery.easypiechart.js"></script> 

<!-- Sparkline --> 
<script src="../assets/js/plugins/sparkline/jquery.sparkline.min.js"></script> 

<!-- Morris --> 

<!-- Sparkline demo data  --> 
<script src="../assets/js/demo/sparkline-demo.js"></script>

<!-- Chart Js -->
<script src="../assets/js/plugins/chartJs/Chart.min.js"></script>
<script src="../assets/js/highchart/highcharts.js"></script>
<script src="../assets/js/highchart/exporting.js"></script>
<script src="../assets/js/highchart/export-data.js"></script>
<script src="../assets/js/highchart/no-data-to-display.js"></script>
<!-- <script src="../assets/js/custom/dashboard.js?v=<?php echo time(); ?>"></script> -->
<script src="../assets/js/waypoints.min.js"></script>
<script src="../assets/js/jquery.counterup.min.js"></script>
<script src="../assets/js/dashboard-counter.js"></script>
</body>
</html>
