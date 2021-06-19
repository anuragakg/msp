<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php include('../parts/head-tag.php'); ?>
  <title>Trifed | Set Password</title>
  <link href="css/plugins/validation/validationEngine.jquery.css" rel="stylesheet">
</head>

<body class="gray-bg">
<div class="passwordBox animated fadeInDown">
  <div class="row">
    <div class="col-md-12">
      <div class="ibox-content">
        <h2 class="font-bold">Set Password</h2>
        <div class="row">
          <div class="col-lg-12">
            <form 
 autocomplete="off"  class="m-t" id="formID">
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

<?php include('../parts/js-files.php'); ?>
<script type="text/javascript" src="../assets/js/custom/set-password.js"></script>


</body>
</html>
