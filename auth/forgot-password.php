<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php include('../parts/head-tag.php'); ?>
  <title>Trifed | Forgot password</title>
</head>

<body class="gray-bg">
<div class="passwordBox animated fadeInDown">
  <div class="row">
    <div class="col-md-12">
      <div class="ibox-content">
        <h2 class="font-bold">Forgot Password</h2>
        <p> Enter your email address and your password will be reset and emailed to you. </p>
        <div class="row">
          <div class="col-lg-12">
            <form 
 autocomplete="off"  class="m-t" id="forgotPassword">
              <div class="form-group">
                <select class="form-control validate[required]"  name="otp_option" id="otp_option">
                  <option value="">Select Option</option>
                    <option value="mobile">Enter Mobile No.</option>
                    <option value="email">Enter E-mail id.</option>
                </select>
              </div>
              <div class="form-group mobile" style="display: none;">
                <input 
 autocomplete="off" type="text" placeholder="Enter Mobile No." class="form-control validate[custom[phone],required,minSize[10], maxSize[10]] first_digit_zero_not_allow numericOnly" maxlength="10" id="mobile">
               </div>
               <div class="form-group email" style="display: none;">
                <input 
 autocomplete="off" type="email" placeholder="Enter Email Id. " class="form-control validate[required,custom[email]]" id="email">
               </div>
               <button type="submit" class="btn btn-primary full-width m-b">Send New Password</button>
            </form>
            <a href="../auth/login.php">Login</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include('../parts/login-js-files.php'); ?>

<script>

  $(function () {
    dropdownEvent();
    forgotPassword();
  });

  forgotPassword = () => {
      
      $('#forgotPassword').on('submit', function(e) {
          e.preventDefault();

          var url = conf.forgotPassword.url;
          var method = conf.forgotPassword.method;
          var data = {};
          if ($(this).validationEngine('validate')) {
          data.otp_option=$('#otp_option').val() 
          if($('#mobile').val().length){
            data.mobile_no = $('#mobile').val().trim();
          }
          if($('#email').val().length){
            data.email  = $('#email').val().trim();
          }

          TRIFED.asyncAjaxHit(url, method, data, function (response) {
              if (response.status == 1) {
                  //$('#forgotPassword')[0].reset();
                  TRIFED.showMessage('success', response.data.message);
                  if($('#otp_option').val()=='mobile')
                  {
                      setTimeout(function() {
                        document.location="reset-password.php";
                      }, 1000);
                  }
              }
              else {
                  TRIFED.showError('error', response.message);
              }
          });
          }
            
      });
  }

  dropdownEvent=()=>{
    $('#forgotPassword select').on('change', function(e){
      if($(this).val()==='mobile'){
        $('.email').css('display', 'none');
      }
      if($(this).val()==='email'){
        $('.mobile').css('display', 'none');
      }
      $('.'+$(this).val()).css('display', '');
    })
    
  }
</script>

</body>
</html>
