<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php include('../parts/head-tag.php'); ?>
  <title>Notification Management</title>
</head>

<body>
  <div id="wrapper" class="w-bg">
    <?php include('../parts/side-menu.php'); ?>

    <div id="page-wrapper" class="gray-bg">

      <?php include('../parts/header.php'); ?>

      <div class="row wrapper border-bottom w-bg page-heading">
        <div class="col-lg-10">
          <h2>Notification Listing</h2>
          <ol class="breadcrumb">
            <li>Dashboard </li>
            <li><a href="../notification-management/notification-view.php">Notification Listing</a></li>
          </ol>
        </div>
        <div class="col-lg-2"> </div>
      </div>
      <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
          <div class="col-lg-12">
            <div class="ibox">
              <div class="wrapper wrapper-content">
                <div class="row">
                  <div class="ibox float-e-margins">
                    <div class="ibox-content">  
                        <div class="row clear">     
                            <div class="col-md-10">    
                            </div>                   
                            <div class="col-md-2">
                            <button class="btn btn-success btn-sm pull-right mark-all-read">Mark All Read</button>
                            </div>
                        </div>                    
                      <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example" id="notification-list">
                          <thead>
                            <tr>
                              <th>Notification</th>
                              <th>Created At</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php include('../parts/js-files.php'); ?>
  <script type="text/javascript" src="../assets/js/custom/notification/notification-view.js"></script>
  <script>
    $(document).ready(function() {
      $('.dataTables-example').DataTable({
        pageLength: 10,
        responsive: true,
        "ordering": false,
        //dom: '<"html5buttons"B>lTfgitp',
        buttons: [
          //{ extend: 'copy'},
          //{extend: 'csv'},
          //{extend: 'excel', title: 'ExampleFile'},
          //{extend: 'pdf', title: 'ExampleFile'},

          // {
          //   extend: 'print',
          //   customize: function(win) {
          //     $(win.document.body).addClass('white-bg');
          //     $(win.document.body).css('font-size', '10px');

          //     $(win.document.body).find('table')
          //       .addClass('compact')
          //       .css('font-size', 'inherit');
          //   }
          // }
        ]

      });

    });
  </script>
</body>

</html>