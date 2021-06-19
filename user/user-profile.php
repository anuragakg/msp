<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php include('../parts/head-tag.php'); ?>
  <title>User Profile</title>
</head>

<body>
<div id="wrapper" class="w-bg">
  <?php include('../parts/side-menu.php'); ?>

  <div id="page-wrapper" class="gray-bg">
    <?php include('../parts/header.php'); ?>
    
    <div class="row wrapper border-bottom w-bg page-heading">
      <div class="col-lg-10">
        <h2>User Profile</h2>
        <ol class="breadcrumb">
          <li><a href="../auth/dashboard.php">Dashboard</a></li>
          <li><a herf="#">User Profile</a></li>
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
                <fieldset class="p-sm form-horizontal">
                  <div class="form-group">
                    <label class="col-md-2 control-label">Name</label>
                    <div class="col-md-4">
                      <input 
 autocomplete="off" class="form-control mdt_feild" type="text" id="name">
                    </div>
                    <label class="col-md-2 control-label">Middle Name</label>
                    <div class="col-md-4">
                      <input 
 autocomplete="off" class="form-control" type="text" id="middle_name">
                    </div>
                  </div>
                  <!--Group Change-->
                  <div class="form-group">
                    <label class="col-md-2 control-label">Last Name</label>
                    <div class="col-md-4">
                      <input 
 autocomplete="off" class="form-control  txtOnly" type="text" id="last_name">
                    </div>
                    <label class="col-md-2 control-label">Email id</label>
                    <div class="col-md-4">
                      <input 
 autocomplete="off" class="form-control mdt_feild validate[required,custom[email]]" type="text" id="email">
                    </div>
                  </div>
                  <!--Group Change-->
                  <div class="form-group">
                    <label class="col-md-2 control-label">Mobile Number</label>
                    <div class="col-md-4">
                      <input 
 autocomplete="off" class="form-control mdt_feild validate[required,minSize[10], maxSize[10]] numericOnly" type="text" id="mobile_no" maxlength="10">
                    </div>

                    <!-- Supervisor Surveyor Template -->
                    <div id="supervisor_surveyor">
                    </div>

                  </div>

                  <!-- User -->
                  <!--Group Change-->
                  <div class="form-group" id="address">
                  </div>

                  <!--Bank Details-->
                  <div class="form-group" id="bank_details">
                    <div class="checkbox checkbox-info checkbox-circle">
                      <input 
 autocomplete="off" id="BankDept" type="checkbox">
                      <label for="checkbox8"><strong>Bank Details of the Department</strong></label>
                    </div>
                  </div>

                  <div id="BankDeptArea" style="display: none;">
                      <!--Group Change-->
                    <div class="form-group">
                      <label class="col-md-2 control-label">A/C Holder Name</label>
                      <div class="col-md-4">
                        <input 
 autocomplete="off" class="form-control  txtOnly" type="text" id="ac_holder_name">
                      </div>
                      <label class="col-md-2 control-label">Bank Name</label>
                      <div class="col-md-4">
                        <input 
 autocomplete="off" class="form-control txtOnly" type="text" id="bank_name">
                      </div>
                    </div>
 
                    <!--Group Change-->
                    <!-- <div class="form-group">
                      <label class="col-md-2 control-label">Branch Name</label>
                      <div class="col-md-4">
                        <input 
 autocomplete="off" class="form-control mdt_feild validate[required] txtOnly" type="text" id="branch_name">
                      </div>
                      <label class="col-md-2 control-label">Mobile No.</label>
                      <div class="col-md-4">
                        <input 
 autocomplete="off" class="form-control mdt_feild validate[required,minSize[10], maxSize[10]] numericOnly mobile_no" type="text" maxlength="10">
                      </div>
                    </div> -->

                    <!--Group Change-->
                    <div class="form-group">
                      <label class="col-md-2 control-label">Bank A/C Number</label>
                      <div class="col-md-4">
                        <input 
 autocomplete="off" class="form-control numericOnly" type="text" id="bank_ac_no">
                      </div>
                      <label class="col-md-2 control-label">IFSC Code</label>
                      <div class="col-md-4">
                        <input 
 autocomplete="off" class="form-control" type="text" id="ifsc_code" maxlength="11">
                      </div>
                    </div>
                  </div>
                </fieldset>

                <!-- Mentoring Organisation -->
                <fieldset class="p-sm form-horizontal" id="mentoring-org-template-binding">
                </fieldset>

                <!-- Mentoring Organisation Template-->
                <script id="mentoring-org-tmplate" type="text/template">

                  <!--Group Change-->
                  <div class="form-group">
                      <div class="ibox-title">
                          <h5>Mentoring Organisation Member Details</h5>
                      </div>
                  </div>

                  <!--Group Change-->
                  <div class="form-group">
                    <label class="col-md-2 control-label">Chairman/CEO Name</label>
                    <div class="col-md-2">
                        <input 
 autocomplete="off" class="form-control mdt_feild validate[required] txtOnly" type="text" id="chairman_name" value="{{chairman_name}}">
                    </div>
                    <label class="col-md-2 control-label">Chairman/CEO Mobile No</label>
                    <div class="col-md-2">
                      <input 
 autocomplete="off" class="form-control mdt_feild validate[required] numericOnly" maxlength="10" type="text" id="chairman_mobile" value="{{chairman_mobile}}">
                    </div>
                    <label class="col-md-2 control-label">Chairman/CEO Email Id</label>
                    <div class="col-md-2">
                      <input 
 autocomplete="off" class="form-control validate[required,custom[email]]" type="text" id="chairman_email" value="{{chairman_email}}">
                    </div>
                  </div>

                   <!--Group Change-->
                   <div class="form-group">
                      <label class="col-md-2 control-label">Secretary Name</label>
                      <div class="col-md-2">
                          <input 
 autocomplete="off" class="form-control mdt_feild validate[required] txtOnly" type="text" id="secretary_name" value="{{secretary_name}}">
                      </div>
                      <label class="col-md-2 control-label">Secretary Mobile No</label>
                      <div class="col-md-2">
                        <input 
 autocomplete="off" class="form-control mdt_feild validate[required] numericOnly" maxlength="10" type="text" id="secretary_mobile" value="{{secretary_mobile}}">
                      </div>
                      <label class="col-md-2 control-label">Secretary Email Id</label>
                      <div class="col-md-2">
                        <input 
 autocomplete="off" class="form-control validate[required,custom[email]]" type="text" id="secretary_email" value="{{secretary_email}}">
                      </div>
                    </div>
                  
                   <!--Group Change-->
                  <div class="form-group">
                      <div class="ibox-title">
                          <h5>Registration Details</h5>
                      </div>
                  </div>
                  
                    <!--Group Change-->
                  <div class="form-group">
                    <label class="col-md-2 control-label">Date of Registration</label>
                    <div class="col-md-4 data-calendar">
                        <div class="input-group date"> <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                          <input 
 autocomplete="off" type="text" class="form-control" id="registration_date" value="{{registration_date}}">
                        </div>
                      </div>
                      <label class="col-md-2 control-label">Registration Valid Till</label>
                      <div class="col-md-4 data-calendar">
                          <div class="input-group date"> <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            <input 
 autocomplete="off" type="text" class="form-control" id="registration_expiry" value="{{registration_expiry}}">
                          </div>
                        </div>
                  </div>
                  <!--Group Change-->
                  <div class="form-group">
                    <label class="col-md-2 control-label">GST TAN No</label>
                    <div class="col-md-4">
                      <input 
 autocomplete="off" class="form-control numericOnly" maxlength="25" type="text" id="gst_or_tan" value="{{gst_or_tan}}">
                    </div>
                  </div>
                </script>

                <div class="wrapper wrapper-content animated fadeInRight registration-certificate" style="display: none;">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="ibox">
                      <div class="ibox-content">
                        <fieldset class="p-sm form-horizontal" id="registration-certificate">

                        </fieldset>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

                <!--Footer-->
              <div class="modal-footer clear_both">
                <button type="submit"  class="btn btn-primary btn-sm">Submit</button>
                <a href="../auth/dashboard.php" class="btn btn-white btn-sm">Cancel</a>   
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

<script type="text/javascript" src="../assets/js/custom/user/user-profile.js?v=<?php echo time(); ?>"></script>
<script>
    $(document).ready(function(){
      $('.data-calendar .input-group.date').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true
       });
    });
</script>
</body>
</html>
