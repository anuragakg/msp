 <!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php include('../parts/head-tag.php'); ?>
  <title>View Role Permission </title>
</head>

<body>
  <div id="wrapper" class="w-bg">
    <?php include('../parts/side-menu.php'); ?>

    <div id="page-wrapper" class="gray-bg">
      <?php include('../parts/header.php'); ?>
      <div class="row wrapper border-bottom w-bg page-heading">
        <div class="col-lg-10">
          <h2>View Role Permission</h2>
          <ol class="breadcrumb">
              <li><a href="../auth/dashboard.php">Dashboard</a></li>
            <li><a href="#"  onclick="window.history.back(-1);">View Role Permission</a></li>
          </ol>
        </div>
        <div class="col-lg-2"> </div>
      </div>
      <div class="wrapper wrapper-content animated fadeInRight">
        <!--  form start  -->
        <div class="ibox float-e-margins">
          <div class="ibox-content">
            <form 
 autocomplete="off"  id="formId">
              <fieldset class="form-horizontal">
                 <div class="form-group">                  
                <h2 class="col-md-2 roleTitle"></h2>
                  <!-- <div class=" col-md-4">
                    <select class="form-control " name="role_id" id="role_id">
                      
                    </select>
                  </div> -->
                </div> 
                <div class="table-responsive">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>Sr. No.</th>
                        <th>Permission</th>
                        <th>Selected Permissions </th>
                      </tr>
                    </thead>
                    <tbody id="permission_container">

                    </tbody>
                  </table>
                </div>
              </fieldset>
              <!--Footer--> 
              <div class="modal-footer clear_both">
                <a href="#" onclick="window.history.back(-1);" class="btn btn-white btn-sm">Cancel</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script id="listPermissionHeading" type="x-tmpl-mustache">
    <tr>
      <th> {{ index }} </th>
      <th> {{ name }} </th>
      <td>
        <input 
 autocomplete="off" type="checkbox" onchange="selectGroup('{{group}}', this.checked)" value="{{ id }}" id="{{ group }}" class="permissions">
      </td>
    </tr>
  </script>
  <script id="listPermission" type="x-tmpl-mustache">
    <tr>
      <td></td>
      <td> {{ name }} </td>
      <td>
        <input 
 autocomplete="off" type="checkbox" name="permission_id[]"  value="{{ id }}" class="permissions {{ group }}" id="permission-{{ id }}">
      </td>
    </tr>
  </script>
  <?php include('../parts/js-files.php'); ?>
  <script type="text/javascript" src="../assets/js/custom/view-role-permission.js"></script>

</body>

</html>