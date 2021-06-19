<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php include('../parts/head-tag.php'); ?>
  <title>State Wise Haat Bazaar Count</title>
</head>

<body>
<div id="wrapper" class="w-bg">
  <?php include('../parts/side-menu.php'); ?>

  <div id="page-wrapper" class="gray-bg">
    <?php include('../parts/header.php'); ?>

    <div class="row wrapper border-bottom w-bg page-heading">
      <div class="col-lg-10">
        <h2>Haat Bazaar <span id="haatbazaar_status"></span> Count</h2>
        <ol class="breadcrumb">
          <li><a href="../auth/dashboard.php">Dashboard</a></li>
          <li><a herf="#">Haat Bazaar Counts</a></li>
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
                               <form method="GET">
                                       <div class="row ibox">
                                         <div class="col-md-2">
                                          <input type="hidden" name="state" id="state">
                                           <select class="form-control" id="is_mobile" name="is_mobile">
                                             <option value="">Type</option>
                                             <option value="1">Mobile</option>
                                             <option value="0">Web</option>
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
                              <th ><span id="haatbazaar_count_head"></span></th>
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
<script type="text/javascript" src="../assets/js/custom/dashboard/haatbazaar_statewise.js?v=1.0"></script>
</body>
</html>
