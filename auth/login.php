<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php include('../parts/head-tag.php'); ?>
  <title>MSP For MFP | Login</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.0.0/crypto-js.min.js" integrity="sha256-6rXZCnFzbyZ685/fMsqoxxZz/QZwMnmwHg+SsNe+C/w=" crossorigin="anonymous"></script>
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <script type="text/javascript">
      var verifyCallback = function(response) {
        // We can Write Code For Callback When Captcha Success
      };
      var onloadCallback = function() {
        grecaptcha.render('capcha', {
          'sitekey' : '6LeGL98UAAAAAAvnPCKRvsY4_wmXDhGRUxFtqAb6',
          'callback' : verifyCallback,
          'theme' : 'light'
        });
      };
    </script>
</head>

<body class="w-bg">
<div class="container-fluid pl-0">
  <div class="row">
    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
      <div class="login-bg"></div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
      <div class="middle-box loginscreen animated fadeInDown">
        <div class="login-form">
         <div class="text-center">  <img src="../assets/img/logo.jpg" alt="Trifed logo"> 
          <div class="tribal-logo"><span>Ministry of Tribal Affairs</span> </div>
         </div>
          <header> <img src="../assets/img/pmydy-logo.png" alt="Trifed logo">

            <h1>
              <span>MSP for MFP Integrated System </span>
              <span class="sub-h">MSP for MFP Yojana  </span>
            </h1>
          </header>
          <h2>Login</h2>
          <form 
 autocomplete="off"  class="m-t-xl" id="formID">
            <div class="form-group">
              <label>Username</label>
              <input 
 autocomplete="off" type="text" class="form-control validate[required]" id="username">
            </div>
            <div class="form-group">
              <label>Password</label>
              <input 
 autocomplete="off" type="password" class="form-control validate[required]" id="password">
              </div>
              <div class="row">
                <div class="col-md-9">
                  <div id="capcha" data-sitekey="6LeGL98UAAAAAAvnPCKRvsY4_wmXDhGRUxFtqAb6git"></div>
              <span id="captcha-msg" style="color:red"></span>
                </div>
                 <div class="col-md-3">
                   <button type="submit" class="btn btn-danger bg-login pull-right m-t-md" id="login">Login</button>
                 </div>
              </div>
              
           <!--  <div class="form-group captcha">
              <label>Captcha</label>
              <input 
 autocomplete="off" type="text" class="form-control validate[required]">
              <img src="../assets/img/captcha.jpg"> <a href="#"><i class="fa fa-refresh"></i></a> </div> -->
              <a href="forgot-password.php" class="forgot-link"><small>Forgot Password?</small></a>
              
              <footer class="login-footer">
                <h3>Get TRIFED App on your Phone <span>You can Download the TRIFED App for free.</span></h3>
               <!-- <a href="#" id="apk_url"><img src="../assets/img/play-store.png" class="m-t" alt="Google Paly"></a>-->
                <a target="_blank" href="https://play.google.com/store/apps/details?id=com.trifed&hl=en"><img src="../assets/img/play-store.png" class="m-t" alt="Google Paly"></a>
              </footer>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include('../parts/login-js-files.php'); ?>
<script src="//code.jquery.com/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/forge/0.8.2/forge.all.min.js"></script>
<script type="text/javascript" src="../assets/js/custom/auth/Barrett.js"></script>
<script type="text/javascript" src="../assets/js/custom/auth/BigInt.js"></script>
<script type="text/javascript" src="../assets/js/custom/auth/rsa_min.js"></script>
<script type="text/javascript" src="../assets/js/custom/login.js?v=<?php echo time(); ?>"></script>

</body>
</html>
