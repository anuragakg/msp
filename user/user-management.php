<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php include('../parts/head-tag.php'); ?>
  <title>User Entry</title>
  <style type="text/css">
    #errorProof {
      color: red;
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
          <h2>User Entry</h2>
          <ol class="breadcrumb">
            <li><a href="../auth/dashboard.php">Dashboard</a></li>
            <li><a href="../user/user-listing.php">User Listing</a></li>
            <li><a href="../user/user-management.php">User Entry</a></li>
          </ol>
        </div>
        <div class="col-lg-2"> </div>
      </div>
      <div class="wrapper wrapper-content animated fadeInRight">
      <span class="error"><strong>* Mandatory fields marked as red</strong></span>
        <div class="row">
          <div class="col-lg-12">
            <div class="ibox">
              <div class="ibox-content">
                <form autocomplete="off" id="formID" class="form-horizontal">
                  <fieldset class="p-sm">
                    <div class="form-group">
                      <label class="col-md-2 control-label">User Type</label>
                      <div class="col-md-6">
                        <select name="role" class="mdt_feild form-control dropdown validate[required]" id="user-type">

                        </select>
                      </div>
                      <div id="state-div" style="display: none;">
                        <label class="col-md-2 control-label">State</label>
                        <div class="col-md-2">
                          <select name="state" class="mdt_feild form-control dropdown" id="state">

                          </select>
                        </div>
                      </div>
                      <div style="margin-top:5%">
                        <div id="district-div" style="display: none;">
                          <label class="col-md-2 control-label">District</label>
                          <div class="col-md-2">
                            <select name="district" class="mdt_feild form-control dropdown" id="district">

                            </select>
                          </div>
                        </div>
                        <div id="levels">
                          <label class="col-md-2 control-label">Level</label>
                          <div class="col-md-2">
                            <select name="level_id" class="form-control dropdown mdt_feild" id="level_id">
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
                            <select  class="form-control states" id="haat_bazaar" name="haat_bazaar[]" multiple="">
                           
                              <option value="">Select haat bazaar</option>
                            </select>
                          </div>
                        </div>
                        <div id="warehouse-master" style="display: none">
                          <label class="col-md-2 control-label">Warehouse</label>
                          <div class="col-md-2">
                            <select  class="form-control mdt_feild" id="warehouse" name="warehouse" >
                              <option value="">Select Warehouse</option>
                            </select>
                          </div>
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
                      <input autocomplete="off" name="user_name" class="form-control mdt_feild validate[required, maxSize[150]]" type="text" id="user_name" maxlength="150">
                    </div>
                    <label class="col-md-2 control-label">Name</label>
                    <div class="col-md-4">
                      <input autocomplete="off" name="name" class="form-control mdt_feild validate[required, maxSize[250]] txtOnly" type="text" id="name" maxlength="250">
                    </div>
                  </div>
                  <!--Group Change-->
                  <div class="form-group">
                    <label class="col-md-2 control-label">Middle Name</label>
                    <div class="col-md-4">
                      <input autocomplete="off" name="middle_name" class="form-control txtOnly" type="text" id="middle_name" maxlength="250">
                    </div>
                    <label class="col-md-2 control-label">Last Name</label>
                    <div class="col-md-4">
                      <input autocomplete="off" name="last_name" class="form-control  txtOnly" type="text" id="last_name" maxlength="250">
                    </div>
                  </div>
                  <!--Group Change-->
                  <div class="form-group">
                    <label class="col-md-2 control-label">Date of Birth</label>
                    <div class="col-md-4" id="dob-calendar">
                      <div class="input-group numericOnly mdt_feild date"> <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <input autocomplete="off" type="text" name="dob" id="dob" class="form-control" placeholder="dd/mm/yyyy" readonly required>
                      </div>
                    </div>
                    <label class="col-md-2 control-label">Email id</label>
                    <div class="col-md-4">
                      <input autocomplete="off" name="email" class="form-control mdt_feild validate[required,custom[email]]" maxlength="191" type="email" id="email">
                    </div>
                  </div>
                  <!--Group Change-->
                  <div class="form-group">
                    <label class="col-md-2 control-label">Mobile Number</label>
                    <div class="col-md-4">
                      <input autocomplete="off" name="mobile" class="form-control validate[minSize[10], maxSize[11]] numericOnly mdt_feild" type="text" id="mobile" maxlength="12">
                    </div>
                    <label class="col-md-2 control-label">Landline Number</label>
                    <div class="col-md-4">
                      <input autocomplete="off" name="landline_no" class="form-control validate[minSize[10], maxSize[10]] numericOnly" type="text" id="landline" maxlength="11">
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
                      <input autocomplete="off" name="id_proof_value" class="form-control mdt_feild validate[required, maxSize[17]]" type="text" id="id_proof_value" maxlength="18">
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
                    <label class="col-md-2 control-label">Official Address</label>
                    <div class="col-md-4">
                      <textarea name="official_address" class="form-control mdt_feild validate[required, maxSize[250]]" rows="3" id="official_address" maxlength="251"></textarea>
                    </div>
                    <div id="allowed_states_div" style="display: none;">
                      <label class="col-md-2 control-label">States Allowed</label>
                      <div class="col-md-4">
                        <select data-tags="true" data-placeholder="Select state" data-allow-clear="true" class="form-control states" id="allowed_states" name="allowed_states[]" multiple="">
                          <option value="">Select</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <!--Bank Details-->
                  <div class="form-group">
                    <div class="checkbox checkbox-info checkbox-circle">
                      <input autocomplete="off" name="bankDept" id="BankDept" type="checkbox">
                      <label for="bankDept"><strong>Bank Details of the Department</strong></label>
                    </div>
                  </div>

                  <div id="BankDeptArea" style="display: none;">
                    <!--Group Change-->
                    <div class="form-group">
                      <label class="col-md-2 control-label">A/C Holder Name</label>
                      <div class="col-md-4">
                        <input autocomplete="off" name="holder_name" class="mdt_feild form-control validate[maxSize[100]] txtOnly" type="text" id="holder_name" maxlength="100" required="">
                      </div>
                      <label class="col-md-2 control-label">Bank Name</label>
                      <div class="col-md-4">
                        <input autocomplete="off" name="bank_name" class="mdt_feild form-control validate[maxSize[100]] txtOnly" type="text" id="bank_name" maxlength="100" required>
                      </div>
                    </div>
                    <!--Group Change-->
                    <div class="form-group">
                      <label class="col-md-2 control-label">Bank A/C Number</label>
                      <div class="col-md-4">
                        <input autocomplete="off" name="bank_ac_no" class="mdt_feild form-control validate[minSize[6], maxSize[18]] numericOnly" type="text" id="bank_ac_no" minlength="6" maxlength="18" required>
                      </div>
                      <label class="col-md-2 control-label">IFSC Code</label>
                      <div class="col-md-4">
                        <input autocomplete="off" name="ifsc_code" class="mdt_feild form-control validate[minSize[6], maxSize[12]]" type="text" id="ifsc_code" minlength="6" maxlength="12" required>
                      </div>
                    </div>
                  </div>
                </fieldset>
                <!--Footer-->
                <div class="modal-footer clear_both">
                  <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                  <a href="#" onclick="window.history.back(-1);" class="btn btn-white btn-sm">Cancel</a>
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

<script type="text/javascript" src="../assets/js/custom/user/user-management.js?v=<?php echo time(); ?>"></script>

</html>