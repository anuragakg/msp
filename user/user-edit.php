<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php include('../parts/head-tag.php'); ?>
  <title>User Management - Update</title>
</head>

<body>
<div id="wrapper" class="w-bg">
  <?php include('../parts/side-menu.php'); ?>

  <div id="page-wrapper" class="gray-bg">
    <?php include('../parts/header.php'); ?>
    
    <div class="row wrapper border-bottom w-bg page-heading">
      <div class="col-lg-10">
        <h2>User Management - Update</h2>
        <ol class="breadcrumb">
          <li><a href="../auth/dashboard.php">Dashboard</a></li>
          <li><a href="../user/user-listing.php">User Listing</a></li>
          <li><a herf="#">User Management - Update</a></li>
        </ol>
      </div>
      <div class="col-lg-2"> </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
      <div class="row">
        <div class="col-lg-12">
          <div class="ibox">
            <div class="ibox-content">
              <form 
 autocomplete="off"  id="formID">
                <fieldset class="p-sm">
                  <div class="form-group">
                    <label class="col-md-2 control-label">User Type</label>
                    <div class="col-md-2">
                      <select name="role" class="mdt_feild form-control dropdown validate[required]" disabled="true" id="user-type">
                      </select>
                    </div>
                    <div id="state-div" style="display: none;">
                      <label class="col-md-2 control-label">State</label>
                      <div class="col-md-2">
                        <select name="state" class="mdt_feild form-control dropdown" id="state" disabled >

                        </select>
                      </div>
                    </div>
                    <div id="district-div" style="display: none;">
                      <label class="col-md-2 control-label">District</label>
                      <div class="col-md-2">
                        <select name="district" class="mdt_feild form-control dropdown" id="district" disabled>

                        </select>
                      </div>
                    </div>
                    <div id="levels">
                      <label class="col-md-2 control-label">Level</label>
                      <div class="col-md-2">
                        <select name="level_id" class="form-control dropdown" id="level_id">
                            <option value="">Select Level</option>
                            <option value="1">Level 1</option>
                            <option value="2">Level 2</option>
                            <option value="3">Level 3</option>
                        </select>
                      </div>
                    </div>
                    <div id="haat_market" style="display: none">
                          <label class="col-md-2 control-label">Haat Bazar</label>
                          <div class="col-md-2">
                            <select data-tags="true" data-placeholder="Select haat bazaar" data-allow-clear="true" class="form-control states" id="haat_bazaar" name="haat_bazaar[]" multiple="">
                              <option value="">Select haat bazaar</option>
                            </select>
                          </div>
                        </div>
                        <div id="warehouse-master" style="display: none">
                          <label class="col-md-2 control-label">Warehouse</label>
                          <div class="col-md-2">
                            <select  class="form-control states" id="warehouse" name="warehouse" >
                              <option value="">Select Warehouse</option>
                            </select>
                          </div>
                        </div>
                  </div>
                </fieldset>
              <!-- </form> -->
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <div class="ibox">
            <div class="ibox-content">
              <!-- <form 
 autocomplete="off"  id="formID"> -->
                <fieldset class="p-sm form-horizontal">
                  <div class="form-group">
                    <label class="col-md-2 control-label">User Name</label>
                    <div class="col-md-4">
                      <input 
 autocomplete="off" name='user_name' class="form-control mdt_feild validate[required]" type="text" id="user_name">
                    </div>
                    <label class="col-md-2 control-label">Name</label>
                    <div class="col-md-4">
                      <input 
 autocomplete="off" name="name" class="form-control mdt_feild" type="text" id="name">
                    </div>
                  </div>
                  <!--Group Change-->
                  <div class="form-group">
                    <label class="col-md-2 control-label">Middle Name</label>
                    <div class="col-md-4">
                      <input 
 autocomplete="off" name="middle_name" class="form-control" type="text" id="middle_name">
                    </div>
                    <label class="col-md-2 control-label">Last Name</label>
                    <div class="col-md-4">
                      <input 
 autocomplete="off" name="last_name" class="form-control  txtOnly" type="text" id="last_name">
                    </div>
                  </div>
                  <!--Group Change-->
                  <div class="form-group">
                    <label class="col-md-2 control-label">Date of Birth</label>
                    <div class="col-md-4" id="dob-calendar">
                      <div class="input-group date mdt_feild"> <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <input autocomplete="off" name="dob" type="text" class="form-control validate[required]" value="" id="dob">
                      </div>
                    </div>
                    <label class="col-md-2 control-label">Email id</label>
                    <div class="col-md-4">
                      <input autocomplete="off" name="email" class="form-control mdt_feild validate[required,custom[email]]" type="email" id="email">
                    </div>
                  </div>
                  <!--Group Change-->
                  <div class="form-group">
                    <label class="col-md-2 control-label">Mobile number</label>
                    <div class="col-md-4">
                      <input autocomplete="off" name="mobile" class="form-control validate[minSize[10], maxSize[10]]" type="text" id="mobile">
                    </div>
                    <label class="col-md-2 control-label">Landline Number</label>
                    <div class="col-md-4">
                      <input autocomplete="off" name="landline_no" class="form-control validate[minSize[10], maxSize[10]]" type="text" id="landline">
                    </div>
                  </div>
                  <!--Group Change-->
                  <div class="form-group">
                    <label class="col-md-2 control-label">ID Proof</label>
                    <div class="col-md-4">
                      <select name="id_proof_type" class="form-control mdt_feild validate[required]" id="id_proof_type">
                      </select>
                    </div>
                    <label class="col-md-2 control-label">ID Proof Number</label>
                    <div class="col-md-4">
                      <input autocomplete="off" name="id_proof_value" class="form-control mdt_feild validate[required]" type="text" id="id_proof_value">
                      <span id="errorProof"></span>
                    </div>
                  </div>
                  <!--Group Change-->
                  <div class="form-group">
                    <label class="col-md-2 control-label">Department</label>
                    <div class="col-md-4">
                      <select name="department" class="form-control mdt_feild validate[required]" id="department">
                      </select>
                    </div>
                    <label class="col-md-2 control-label">Designation</label>
                    <div class="col-md-4">
                      <select name="designation" class="form-control mdt_feild validate[required]" id="designation">
                      </select>
                    </div>
                  </div>
                  <!--Group Change-->
                  <div class="form-group">
                    <label class="col-md-2 control-label">Offical Address</label>
                    <div class="col-md-4">
                      <textarea name="official_address" class="form-control mdt_feild validate[required]" rows="3" id="official_address"></textarea>
                    </div>
                    <div id="allowed_states_div" style="display: none;">
                    <label class="col-md-2 control-label">States Allowed</label>
                    <div class="col-md-4">
                      <select data-tags="true" data-placeholder="Select state" data-allow-clear="true" class="form-control states" id="allowed_states" name="allowed_states[]" multiple="" >
                        <option value="">Select</option>
                      </select>
                    </div>
                  </div>
                  </div>
                  
                  <!--Bank Details-->
                  <div class="form-group">
                    <div class="checkbox checkbox-info checkbox-circle ">
                      <input 
 autocomplete="off" name="bankDept" id="BankDept" type="checkbox">
                      <label for="bankDept"><strong>Bank Details of the Department</strong></label>
                    </div>
                  </div>
                  
                  <div id="BankDeptArea" style="display: none;">
                      <!--Group Change-->
                    <div class="form-group">
                      <label class="col-md-2 control-label">A/C Holder Name</label>
                      <div class="col-md-4">
                        <input 
 autocomplete="off" name="holder_name" class="mdt_feild form-control validate[maxSize[100]] txtOnly" type="text" id="holder_name" required>
                      </div>
                      <label class="col-md-2 control-label">Bank Name</label>
                      <div class="col-md-4">
                        <input 
 autocomplete="off" name="bank_name" class="mdt_feild form-control validate[maxSize[50]] txtOnly" type="text" id="bank_name" required>
                      </div>
                    </div>
                    <!--Group Change-->
                    <div class="form-group">
                      <label class="col-md-2 control-label">Bank A/C Number</label>
                      <div class="col-md-4">
                        <input 
 autocomplete="off" name="bank_ac_no" class="mdt_feild form-control validate[minSize[6], maxSize[18]] numericOnly" type="text" id="bank_ac_no" required>
                      </div>
                      <label class="col-md-2 control-label">IFSC Code</label>
                      <div class="col-md-4">
                        <input 
 autocomplete="off" name="ifsc_code" class="mdt_feild form-control validate[minSize[6], maxSize[12]]" type="text" id="ifsc_code" required>
                      </div>
                    </div>
                  </div>
                </fieldset>
                <!--Footer-->
              <div class="modal-footer clear_both">
                <button type="submit"  class="btn btn-primary btn-sm">Submit</button>
                <!--<a href="../auth/dashboard.php" class="btn btn-white btn-sm">Cancel</a>  --> 
				<a href="javascript:window.history.back()" class="btn btn-white btn-sm">Cancel</a>
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
<script type="text/javascript" src="../assets/js/custom/user/user-edit.js?v=<?php echo time();?>"></script>
</html>
