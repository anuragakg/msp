<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php include('../parts/head-tag.php'); ?>
  <title>Trifed | Reset Password</title>
  <link href="css/plugins/validation/validationEngine.jquery.css" rel="stylesheet">
</head>

<body class="gray-bg">
<div class="passwordBox animated fadeInDown">
  <div class="row">
    <div class="col-md-12">
      <div class="ibox-content">
        <h2 class="font-bold">Reset Password</h2>
        <div class="row">
          <div class="col-lg-12">
            <form 
 autocomplete="off"  class="m-t" id="resetPassword">
              <div class="form-group otp" style="display: none;">
                <input 
 autocomplete="off" type="password" id="otp" placeholder="OTP" class="form-control validate[required]">
               </div>
              <div class="form-group">
               	<input 
 autocomplete="off" type="password" id="password" placeholder="Password" class="form-control validate[required]">
               </div>
              <div class="form-group">
               	<input 
 autocomplete="off" type="password" id="confirm_password" placeholder="Confirm Password" class="form-control validate[required]">
               </div>
               <button type="submit" class="btn btn-primary full-width m-b" id="setPassword">Set New Password</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include('../parts/login-js-files.php'); ?>

<script>

  $(function () {
    resetPassword();
  });

  resetPassword = () => {

      if(!TRIFED.getUrlParameters().token){
        $('.otp').css('display', 'block');
      }
      
      $('#resetPassword').on('submit', function(e) {
          e.preventDefault();

          var token = TRIFED.getUrlParameters().token;

          var url = conf.resetPassword.url;
          var method = conf.resetPassword.method;
          var data = {};
	      data.password          = $('#password').val().trim();
	      data.confirm_password  =$('#confirm_password').val().trim();

        if(!token){
          data.token           = $('#otp').val().trim();
        }
        else{
          data.token= token;
        }

        if (validateForm(data)) {
          TRIFED.asyncAjaxHit(url, method, data, function (response) {
              if (response.status == 1) {
                  $('#resetPassword')[0].reset();
                  setTimeout(function() {
                      document.location="login.php";
                  }, 3000);
                  TRIFED.showMessage('success', response.data.message);
              }
              else {
                  TRIFED.showError('error', response.message);
              }
          });
	       }
          
      });
  }

  function validateForm(data) {
      if (data.password !=  data.confirm_password) {
          TRIFED.showError('error', 'Password and Confirm Password should be same.');
          return false;
      }
      return true;
  }

</script>
</body>
</html>
