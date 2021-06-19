<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php include('../parts/head-tag.php'); ?>
  <title>User Management</title>
</head>

<body>
  <div id="wrapper" class="w-bg">
    <?php include('../parts/side-menu.php'); ?>

    <div id="page-wrapper" class="gray-bg">

      <?php include('../parts/header.php'); ?>

      <div class="row wrapper border-bottom w-bg page-heading">
        <div class="col-lg-10">
          <h2>User Listing</h2>
          <ol class="breadcrumb">
            <li><a href="../auth/dashboard.php">Dashboard</a></li>
            <li><a href="../user/user-listing.php">User Listing</a></li>
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
                      <div class="row clear" style="margin-bottom:10px;">
                        <div class="col-md-9">
                         <!--  <a href="user/downloadExcel" class="btn btn-success btn-sm apiLink hidden user_management_add" id="downloadSample"><i class="fa fa-download"></i> &nbsp;Download Bulk File Format</a> -->
                          
                          <!--<button class="btn btn-success btn-sm hidden user_management_add" data-toggle="modal" data-target="#user-upload-dialog"><i class="fa fa-upload"></i> &nbsp;Upload in Bulk</button>-->

                          <!-- <a href="#" class="btn btn-success btn-sm apiLink hidden user_management_view" id="exportExcel"><i class="fa fa-download"></i> &nbsp;Download Excel</a> -->
                          <div class="col-md-3">
							<select id="state_id" name="state_id" class="filter form-control"></select>
						  </div>
						  <div class="col-md-3">
							<select id="district_id" class="district_id filter form-control"><option value="">Select District</option></select>
						  </div>
						  <div class="col-md-4">
							<select id="user-type" class="filter form-control"></select>
						  </div>
                          <button type="button" id="reset_filter" class="btn btn-primary">Reset Filter</button>
                        </div>
						<div class="col-md-1 hidden user_management_add">
                          <a href="#" class="btn btn-success btn-sm pull-right" onclick="window.history.back();"> Back</a>
                        </div>
                        <div class="col-md-2 hidden user_management_add">
                          <a href="user-management.php" class="btn btn-success btn-sm pull-right hidden user_management_add"><i class="fa fa-plus"></i> &nbsp;Add User</a>
                        </div>
						
                      </div>
                      <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example" id="user-list">
                          <thead>
                            <tr>
                              <th>Sr. No.</th>
                              
                              <th>User Name</th>
                              <th>Name</th>
                              <th>Email Id</th>
                              <th>Mobile No.</th>
                              
                             <!--  <th>Address</th> -->
                              <th>Role</th>
                              <th>Level</th>
                              <th>Designation</th>
                              <th>Department</th>
                              <th style="width:140px;">Action</th>
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

  <!--User Upload Window-->
  <div class="modal" id="user-upload-dialog" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
      <form 
 autocomplete="off"  method="post" enctype=multipart/form-data> <div class="modal-content animated flipInX">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <h4 class="modal-title">Upload</h4>
        </div>
        <div class="modal-body clear">
          <div class="row">
            <input 
 autocomplete="off" type="file" id="import_file">
          </div>
        </div>
        <div class="modal-footer">
          <button id="importExcel" class="btn btn-green">Submit</button>
          <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
        </div>
    </div>
    </form>
  </div>
  </div>
  <!--End Window-->

  <?php include('../parts/js-files.php'); ?>
  <script type="text/javascript" src="../assets/js/custom/user/user-listing.js?v=<?php echo time();?>"></script>
  <script>
    
  </script>
  <style type="text/css">
    .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
    border: 1px solid #97b8ff;
    line-height: 1.42857;
    padding: 6px !important;
    vertical-align: top;
}
  </style>
</body>

</html>