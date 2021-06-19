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
        <h2>User View</h2>
        <ol class="breadcrumb">
          <li><a href="../auth/dashboard.php">Dashboard</a></li>
          <li><a herf="#">User View</a></li>
        </ol>
      </div>
      <div class="col-lg-2"> </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
      
      <!--  form start  -->
      
      <div class="row">
          <div class="ibox">
            <div class="ibox-content ">
              <form 
 autocomplete="off"  id="formID">
                <fieldset class="p-sm form-horizontal">
                  <div class="form-group">
                    <label class="col-md-2 control-label">User Type</label>
                    <label for="user-type" class="col-md-4 control-label font-weight-normal"> </label>
                    <label class="col-md-2 control-label">State</label>
                    <label for="state" class="col-md-4 control-label font-weight-normal"></label>
                  </div>
                  <!--Group Change-->
                  <div class="form-group">
                    <label class="col-md-2 control-label">District</label>
                    <label for="district" class="col-md-4 control-label font-weight-normal"></label>
                    <label class="col-md-2 control-label">User Name</label>
                    <label for="user_name" class="col-md-4 control-label font-weight-normal"> </label>
                  </div>
                  <!--Group Change-->
                  <div class="form-group">
                    <label class="col-md-2 control-label">Name</label>
                    <label for="name" class="col-md-4 control-label font-weight-normal"></label>
                    <label class="col-md-2 control-label ">Middle Name</label>
                    <label for="middle_name" class="col-md-4 control-label font-weight-normal"> </label>
                  </div>
                  <!--Group Change-->
                  <div class="form-group">
                    <label class="col-md-2 control-label">Last Name</label>
                    <label for="last_name" class="col-md-4 control-label font-weight-normal">  </label>
                    <label class="col-md-2 control-label">Date of Birth</label>
                    <label for="dob" class="col-md-4 control-label font-weight-normal">  </label>
                  </div>
                  <!--Group Change-->
                  <div class="form-group">
                    <label class="col-md-2 control-label">Email</label>
                    <label for="email" class="col-md-4 control-label font-weight-normal"> </label>
                    <label class="col-md-2 control-label">Mobile</label>
                    <label for="mobile" class="col-md-4 control-label font-weight-normal"> </label>
                  </div>
                  <!--Group Change-->
                  <div class="form-group">
                    <label class="col-md-2 control-label">Landline</label>
                    <label for="landline" class="col-md-4 control-label font-weight-normal"> </label>
                  </div>

                  <!--Group Change-->
                  <div class="form-group">
                    <label class="col-md-2 control-label">ID Proof</label>
                    <label for="id_proof_type" class="col-md-4 control-label font-weight-normal">  </label>
                    <label class="col-md-2 control-label">ID Proof No</label>
                    <label for="id_proof_value" class="col-md-4 control-label font-weight-normal">  </label>
                  </div>

                  <!--Group Change-->
                  <div class="form-group">
                    <label class="col-md-2 control-label">Department</label>
                    <label for="department" class="col-md-4 control-label font-weight-normal"> </label>
                    <label class="col-md-2 control-label">Designation</label>
                    <label for="designation" class="col-md-4 control-label font-weight-normal"> </label>
                  </div>

                  <!--Group Change-->
                  <div class="form-group">
                    <label class="col-md-2 control-label">Official Address</label>
                    <label for="official_address" class="col-md-4 control-label font-weight-normal">  </label>
                  </div>
                  
                    <!--Group Change-->
                    <div class="form-group">
                        <div class="ibox-title">
                            <h5>Bank Details of the Department</h5>
                        </div>
                    </div>
                  	<!--Group Change-->
                  <div class="form-group">
                    <label class="col-md-2 control-label">A/C Holder Name</label>
                    <label for="holder_name" class="col-md-4 control-label font-weight-normal">/C  </label>
                    <label class="col-md-2 control-label">Bank Name</label>
                    <label for="bank_name" class="col-md-4 control-label font-weight-normal"> </label>
                  </div>
                  <!--Group Change-->
                  <div class="form-group">
                    <label class="col-md-2 control-label">Bank A/C No</label>
                    <label for="bank_ac_no" class="col-md-4 control-label font-weight-normal"></label>
                    <label class="col-md-2 control-label">IFSC Code</label>
                    <label for="ifsc_code" class="col-md-4 control-label font-weight-normal"> </label>
                  </div>

                </fieldset>
              </form>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>

<?php include('../parts/js-files.php'); ?>
<script type="text/javascript" src="../assets/js/custom/user/user-management-view.js"></script>
<script type="text/javascript">
  $(function() {
      // viewDetails('');
  });
</script>
</body>
</html>
