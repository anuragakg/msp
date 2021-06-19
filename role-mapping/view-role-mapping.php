<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php include('../parts/head-tag.php'); ?>
  <title>Scrutiny Management List</title>
  <link href="../assets/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
</head>

<body>
<div id="wrapper" class="w-bg">
  <?php include('../parts/side-menu.php'); ?>
  
  <div id="page-wrapper" class="gray-bg">
    <?php include('../parts/header.php'); ?>
	  
    <div class="row wrapper border-bottom w-bg page-heading">
      <div class="col-lg-10">
        <h2>Scrutiny Management List</h2>
        <ol class="breadcrumb">
          <li><a href="../auth/dashboard.php">Dashboard</a></li>
          <li><a href="../role-mapping/view-role-mapping.php">Scrutiny Management List</a></li>
        </ol>
      </div>
      <div class="col-lg-2"> </div>
    </div>

    <div class="ibox m-b-none">
            <div class="ibox-content">
             <div class="row clear">
                
                <div class="col-md-12 haat_bazaar_management_add">
				<div class="col-md-1 hidden user_management_add">
                          <a href="#" class="btn btn-success btn-sm pull-right" onclick="window.history.back();"> Back</a>
                        </div>  
				<div class="col-md-11 haat_bazaar_management_add">
                  <a href="../role-mapping/role-mapping.php" class="btn btn-success btn-sm pull-right"><i class="fa fa-plus"></i> &nbsp;Add Scrutiny </a>
				  </div>
				  
						
                
				</div>
                <fieldset class="p-sm">
                  <div class="form-group col-md-12">

                    <label class="col-md-1 control-label">State</label>
                    <div class="col-md-3">
                      <select name="state" class="form-control mdt_feild states filter" id="state"><option value="">Please Select</option></select>
                    </div>

           

                    <div class="col-md-2">
                    <button type="button" id="reset_filter" class="btn btn-warning pull-right"><i class="fa fa-refresh"></i> Reset Filter</button>
                      <!-- <button class="btn btn-sm btn-primary" id="search">Search</button> -->
                    </div>

                  </div>
                </fieldset>
              <!-- </form> -->
            </div>
          </div>
        </div>
    <div class="wrapper wrapper-content animated fadeInRight">	
      <div class="row">
        <div class="col-lg-12">
          <div class="ibox">
              <div class="wrapper wrapper-content">
                <div class="row">
                  <div class="ibox float-e-margins">
                    <div class="ibox-content">					
                      <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example" id="user-list" >
                          <thead>
                            <tr>
                              <th>Sr. No.</th>
                              <th>State Name</th>
                              <th>Role Type</th>
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
<!-- <div class="modal" id="editModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content animated flipInX">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Update Designation</h4>
      </div>
      <div class="modal-body clear">
      <div class="row">
        <div class="col-sm-12">
          <div class="form-group">
            <label class="col-sm-4 p-xs  control-label">Designation Name</label>
            <div class="col-sm-8">
              <input 
 autocomplete="off" type="text" id="updateTitle" class="form-control mdt_feild validate[required] txtOnly" maxlength="100">   
            </div>
          </div>
        </div>
        <div class="col-sm-12">
          <div class="form-group">
            <div class="col-sm-8">
              <input 
 autocomplete="off" type="hidden" id="updateID" class="form-control mdt_feild required"  >
            </div>
          </div>
        </div>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
        <button type="button" id="updateButton" class="btn btn-primary">Update</button>
      </div>
    </div>
  </div>
</div> -->

<?php include('../parts/js-files.php'); ?>
<script type="text/javascript" src="../assets/js/custom/roll-mapping/scrutiny-management-list.js"></script>
<script type="text/javascript" src="../assets/js/custom/roll-mapping/add_rollmapping_project_proposal.js"></script>




</body>
</html>
