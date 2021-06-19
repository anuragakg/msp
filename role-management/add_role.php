<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include('../parts/head-tag.php'); ?>
    <?php $heading = isset($_REQUEST['id'])?'Edit':'Add'?>
    <title><?php echo $heading;?> Role</title>
    <style type="text/css">
    #errorProof {   color: red; }
    </style>
</head>

<body>
<div id="wrapper" class="w-bg">
    <?php include('../parts/side-menu.php'); ?>

    <div id="page-wrapper" class="gray-bg">
    <?php include('../parts/header.php'); ?>
    
    <div class="row wrapper border-bottom w-bg page-heading">
      <div class="col-lg-10">
        <h2><?php echo $heading;?> Role</h2>
        <ol class="breadcrumb">
        <li><a href="../auth/dashboard.php">Dashboard</a></li>
          <li><a href="../role-management/role-listing.php">Role Listing</a></li>
          <li><a href="../role-management/add-role.php"><?php echo $heading;?> Role</a></li>
        </ol>
      </div>
      <div class="col-lg-2"> </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
     
      <div class="row">
        <div class="col-lg-12">
          <div class="ibox">
            <div class="ibox-content">
              <form autocomplete="off"  id="formID" class="form-horizontal">
                <fieldset class="p-sm form-horizontal">
                  <div class="form-group">
                    <label class="col-md-2 control-label">Role Name</label>
                    <div class="col-md-4">
                      <input autocomplete="off" name="title" class="form-control mdt_feild validate[required, maxSize[150]]" type="text" id="title" maxlength="150">
                    </div>
                    <label class="col-md-2 control-label">Status</label>
                    <div class="col-md-4">
                      <select name="status" required class="form-control" id="status">
                        <option value="1">Active</option>
                        <option value="0">In-Active</option>
                      </select>
                    </div>

                   
                  </div>
                  
                  <div class="form-group">
                    <label class="col-md-2 control-label">Description</label>
                    <div class="col-md-4">
                    <textarea autocomplete="off" name="description" class="form-control mdt_feild validate[required, maxSize[150]]" type="text" id="description" maxlength="150"></textarea>
                    </div>
                  </div>
                  
                </fieldset>
                <!--Footer-->
              <div class="modal-footer clear_both">
                <a href="javascript:void(0)" id="add_role"  class="btn btn-primary btn-sm">Submit</a>
                <a href="../role-management/role-listing.php" class="btn btn-white btn-sm">Cancel</a>
              </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include('../parts/js-files.php'); ?>

</body>

<script type="text/javascript" src="../assets/js/custom/role/role-listing.js?v=<?php echo time();?>"></script> 

</html>
