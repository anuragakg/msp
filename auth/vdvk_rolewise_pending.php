<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php include('../parts/head-tag.php'); ?>
  <title>List of Proposed VDVKs</title>
</head>

<body>
<div id="wrapper" class="w-bg">
  <?php include('../parts/side-menu.php'); ?>

<div id="page-wrapper" class="gray-bg">
  <?php include('../parts/header.php'); ?>
  
  <div class="row wrapper border-bottom w-bg page-heading">
    <div class="col-lg-10">
      <h2>List of Proposed VDVKs</h2>
      <ol class="breadcrumb">
        <li>Dashboard </li>
        <li><a href="../approval-management/proposed-vdvks-list.php">List of Proposed VDVKs</a></li>
      </ol>
    </div>
    <div class="col-lg-2"> </div>
  </div>

 <div class="wrapper wrapper-content animated fadeInRight">
     <div class="row">
        <div class="col-lg-12">
          <div class="ibox m-b-none">
            <div class="ibox-content form-horizontal">
            <form 
 autocomplete="off"  id="filterRecords" class="form-horizontal">
              <fieldset class="p-sm">
              <div class="form-group">
                <label class="col-md-1 control-label">State</label>
                    <div class="col-md-2">
                      <select class="form-control" name="state" id="stateList">
                        <option>Please select</option>
                      </select>
                    </div>
               <label class="col-md-1 control-label">District</label>
               <div class="col-md-2">
                 <select class="form-control" id="districtList">
                   <option value="">Please Select</option>
                 </select>
               </div>
               <label class="col-md-1 control-label">Block/Tehsil</label>
               <div class="col-md-2">
                  <select class="form-control" id="blocksList">
                      <option value="">Please Select</option>
                    </select>
               </div>
               <div class="col-md-3">
                <input 
 autocomplete="off" type="submit" value="Search" class="btn btn-primary">
               </div> 

               <!-- <div class="col-md-3">
                   <h4 class="text-right"><a href=""> <i class="fa fa-download"></i> Download in Excel</a></h4>
               </div>    -->     
               </div>
               </fieldset>
              </form>
                <!-- <div class="col-md-12">
                <h4 class="text-left"><a href="#">  <u>Implementation Agencies-ABC</u></a></h4>
               </div>   
                
                
          -->
                <div class="form-group">
                    <div class="col-md-12">
                      <table class="table table-striped table-bordered table-hover dataTables-example">
                          <thead>
                          <tr>
                            
                            <th>Sr. No.</th>
                            <th>Role</th>
                            <th>Name of VDVK</th>
                            <th>Leader Name</th>
                            <th>Contact Number</th>
                            <th>E-mail Id</th>
                            <th>Proposal Submission Date</th>
                            <th>Status</th>
                            <th>Action</th>
                          
                          </tr>
                          </thead>
                          <tbody id="vdvk-list">
                          </tbody>
                        </table>
                        </div>
                  </div>

          </div>
        </div>
      </div>
    </div>
  </div>    
  

<?php include('../parts/js-files.php'); ?>

<script type="text/javascript" src="../assets/js/custom/dashboard/vdvk-list.js?v=1.1"></script>
<script>
$(document).ready(function(){
$('#data-calendar2 .input-group.date').datepicker({
  todayBtn: "linked",
  keyboardNavigation: false,
  forceParse: false,
  calendarWeeks: true,
  autoclose: true
 });  
});
</script>
<script>
     $(document).ready(function () {
         $('.i-checks').iCheck({
             checkboxClass: 'icheckbox_square-green',
             radioClass: 'iradio_square-green',
         });
     });
 </script> 
<script>
   $('.custom-file-input').on('change', function() {
   //let fileName = $(this).val().split('\\').pop();
   $(this).next('.custom-file-label').addClass("selected").html(fileName);
}); 
 </script> 
<script>
$(document).ready(function(){
  $("#wizard").steps();
  $("#form").steps({
    bodyTag: "fieldset",
  });
  });
</script> 
<script>
 $(document).ready(function () {
   $('.i-checks').iCheck({
     checkboxClass: 'icheckbox_square-green',
     radioClass: 'iradio_square-green',
   });
 });
 </script>
<script>
    $(document).ready(function() {
      $('.dataTables-example').DataTable({
        pageLength: 10,
        responsive: true,
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [
          //{ extend: 'copy'},
          //{extend: 'csv'},
          {
            extend: 'excel',
            title: 'ExampleFile'
          },
          //{extend: 'pdf', title: 'ExampleFile'},
        ]
      });

    });
  </script>
</body>
</html>