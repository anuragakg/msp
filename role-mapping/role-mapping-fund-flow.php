<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php include('../parts/head-tag.php'); ?>
  <title>Role Mapping Fund Flow</title>
  
</head>

<body>
<div id="wrapper" class="w-bg">
  <?php include('../parts/side-menu.php'); ?>
  
  <div id="page-wrapper" class="gray-bg">
    <?php include('../parts/header.php'); ?>
	  
    <div class="row wrapper border-bottom w-bg page-heading">
      <div class="col-lg-10">
        <h2>Role Mapping Fund Flow</h2>
        <ol class="breadcrumb">
          <li><a href="../auth/dashboard.php">Dashboard</a></li>
          <li><a href="../role-mapping/role-mapping-fund-flow.php">Role Mapping Fund Flow</a></li>
        </ol>
      </div>
      <div class="col-lg-2"> </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
      <form 
 autocomplete="off"  id="formId">
	<div class="row">
        <div class="col-lg-12">
          <div class="ibox">
            <div class="ibox-content">
             
                <fieldset class="p-sm">
                  <div class="form-group">
                    <label class="col-md-2 control-label">Select State</label>
                    <div class="col-md-5">
                      <select class="mdt_feild form-control dropdown " required id="state" name="state_id">
                        <option value="">Select State</option>
                        
                      </select>
                    </div>  
                  </div>
                </fieldset>
             
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <div class="ibox">
              <div class="wrapper wrapper-content">
                <div class="row">
                  <div class="ibox float-e-margins">
                    <div class="ibox-content">					
                      <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover " >
                          <thead>
                            <tr>
                              <th>Sr. No.</th>
                              <th>Select Level</th>
                              <th>Select Role Type</th>                              
                              <th><span class="add-item" id="add_items"><i class="fa fa-plus-circle" aria-hidden="true"></i></span></th>                              
                            </tr>
                          </thead>
                          <tbody id="items_container">
                            
												
                          </tbody>
                        </table>
            						<!--Footer-->
            						<div class="modal-footer clear_both">
            							<button type="button" id="save" class="btn btn-primary btn-sm">Save</button>
            							<a href="../auth/dashboard.php" class="btn btn-white btn-sm">Cancel</a>   
            						</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        </form>
    </div>
  </div>
</div>

<?php include('../parts/js-files.php'); ?>
<script type="text/javascript" src="../assets/js/custom/roll-mapping/add_rollmapping_fund_flow.js"></script>
<script id="items_template" type="x-tmpl-mustache">

<tr id="delete_items{{random_items_id}}" class="delete_items">
  <td class="item_no">1</td>
  <td>
    <div class="form-group">
    <div class="col-md-6">
      <select class="mdt_feild form-control dropdown required levels" id="levels{{random_items_id}}" name="level_id[]">
        <option value="">State Label</option>
        
      </select>
    </div>  
    </div>
    </td>
      <td>
          <div class="form-group">
          <div class="col-md-8">
            <select class="mdt_feild form-control dropdown required roles" id="roles{{random_items_id}}" name="role_id[]">
            <option value="">State Role Type</option>
            </select>
          </div>  
          </div>
    </td>   
    <td>
    <button class="btn btn-danger btn-sm remove_items" id="remove_items{{random_items_id}}" data_id="{{item.id}}" type="button" title="Delete"> <i class="fa fa-trash"></i></i> </button>
  </td>                           
</tr>
</script>
</body>
</html>
