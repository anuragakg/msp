<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php include('../parts/head-tag.php'); ?>
  <title>Role Management</title>
</head>

<body>
  <div id="wrapper" class="w-bg">
    <?php include('../parts/side-menu.php'); ?>

    <div id="page-wrapper" class="gray-bg">

      <?php include('../parts/header.php'); ?>

      <div class="row wrapper border-bottom w-bg page-heading">
        <div class="col-lg-10">
          <h2>Role Listing</h2>
          <ol class="breadcrumb">
            <li><a href="../auth/dashboard.php">Dashboard</a></li>
            <li><a href="../user/user-listing.php">Role Listing</a></li>
          </ol>
        </div>
        <div class="col-lg-2"> </div>
      </div>
      <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
          <div class="col-lg-12">
            <div class="ibox">
              <div class="wrapper wrapper-content">
                <div class="row">
                  <div class="ibox float-e-margins">
                    <div class="ibox-content">
                      <div class="row clear">
                        <div class="col-md-9">
                         <!--  <a href="user/downloadExcel" class="btn btn-success btn-sm apiLink hidden user_management_add" id="downloadSample"><i class="fa fa-download"></i> &nbsp;Download Bulk File Format</a> -->
                          
                          <!--<button class="btn btn-success btn-sm hidden user_management_add" data-toggle="modal" data-target="#user-upload-dialog"><i class="fa fa-upload"></i> &nbsp;Upload in Bulk</button>-->

                          <!-- <a href="#" class="btn btn-success btn-sm apiLink hidden user_management_view" id="exportExcel"><i class="fa fa-download"></i> &nbsp;Download Excel</a> -->
                        </div>
						<div class="col-md-1 hidden user_management_add">
                          <a href="#" class="btn btn-success btn-sm pull-right" onclick="window.history.back();"> Back</a>
                        </div>
                        <div class="col-md-2 hidden user_management_add">
                          <a href="add_role.php" class="btn btn-success btn-sm pull-right hidden user_management_add"><i class="fa fa-plus"></i> &nbsp;Add Role</a>
                        </div>
						
						
						
                      </div>
                      <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example" id="user-list">
                          <thead>
                            <tr>
                              <th>Sr. No.</th>
                              <th>Role</th>
                              <th>Description</th>
                              <th>Status</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  

  <?php include('../parts/js-files.php'); ?>
  <script type="text/javascript" src="../assets/js/custom/role/role-listing.js?v=<?php echo time();?>"></script>
  <script>
    
  </script>
</body>

</html>