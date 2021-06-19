<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php include('../parts/head-tag.php'); ?>
  <?php $heading = isset($_REQUEST['state_id']) ? 'Edit' : 'Add' ?>
  <title><?php echo $heading; ?> Scrutiny Level</title>

</head>

<body>
  <div id="wrapper" class="w-bg">
    <?php include('../parts/side-menu.php'); ?>

    <div id="page-wrapper" class="gray-bg">
      <?php include('../parts/header.php'); ?>

      <div class="row wrapper border-bottom w-bg page-heading">
        <div class="col-lg-10">
          <h2>Add Scrutiny Level</h2>
          <ol class="breadcrumb">
            <li><a href="../auth/dashboard.php">Dashboard</a></li>
            <li><a href="../role-mapping/view-role-mapping.php">Scrutiny Management List</a></li>
            <li><a href="../role-mapping/role-mapping.php"><?php echo $heading; ?> Scrutiny Level</a></li>
          </ol>
        </div>
        <div class="col-lg-2"> </div>
      </div>
      <div class="wrapper wrapper-content animated fadeInRight">
        <form autocomplete="off" id="formID" class="form-horizontal">
          <div class="row">
            <div class="col-lg-12">
              <div class="ibox">
                <div class="ibox-content">

                  <fieldset class="p-sm">
                    <div class="form-group">
                      <label class="col-md-2 control-label">Select State</label>
                      <div class="col-md-5">
                        <?php $readonly = isset($_REQUEST['state_id']) ? 'readonly' : '' ?>
                        <select class="mdt_feild form-control dropdown validate[required]" id="state" name="state_id" <?php echo $readonly; ?>>
                          <option value="">Select State</option>

                        </select>
						<style>
						select[readonly] {
						  background: #eee;
						  pointer-events: none;
						  touch-action: none;
						}
						</style>
                      </div>
                    </div>
                  </fieldset>

                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="ibox">
                <div class="wrapper wrapper-content">
                  <div class="row">
                    <div class="ibox float-e-margins">
                      <div class="ibox-content">
                        <div class="table-responsive">
                          <table class="table table-striped table-bordered table-hover ">
                            <thead>
                              <tr>
                                <th>Sr. No.</th>
                                <th>Select Level</th>
                                <th>Select Role Type</th>
                                <th>Select Sub Levels</th>
                                <th><span class="add-item" id="add_items"><i class="fa fa-plus-circle" aria-hidden="true"></i></span></th>
                              </tr>
                            </thead>
                            <tbody id="items_container">


                            </tbody>
                          </table>
                          <!--Footer-->
                          <div class="modal-footer clear_both">
                            <button type="button" id="save" class="btn btn-primary btn-sm">Save</button>
                            <a href="../role-mapping/view-role-mapping.php" class="btn btn-white btn-sm">Cancel</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <?php include('../parts/js-files.php'); ?>
  <script type="text/javascript" src="../assets/js/custom/roll-mapping/add_rollmapping_project_proposal.js"></script>
  <script id="items_template" type="x-tmpl-mustache">

    <tr id="delete_items{{random_items_id}}" class="delete_items">
  <td class="item_no">1</td>
  <td>
    <div class="form-group">
    <div class="col-md-8">
      <select class="mdt_feild form-control dropdown validate[required] levels" id="levels{{random_items_id}}" name="level_id[{{random_items_id}}]">
        <option value="">State Label</option>
        
      </select>
    </div>  
    </div>
    </td>
    <td>
          <div class="form-group">
          <div class="col-md-8">
            <select class="mdt_feild form-control dropdown validate[required] roles" id="roles{{random_items_id}}" name="role_id[{{random_items_id}}]">
            <option value="">State Role Type</option>
            </select>
          </div>  
          </div>
    </td>   
    <td>
          <div class="form-group">
          <div class="col-md-8">
            <input type="checkbox" value="1" name="sublevel[{{random_items_id}}][1]"> &nbsp; Level 1<br>
            <input type="checkbox" value="2" name="sublevel[{{random_items_id}}][2]"> &nbsp; Level 2<br>
            <input type="checkbox" value="3" name="sublevel[{{random_items_id}}][3]"> &nbsp; Level 3<br>
          </div>  
          </div>
    </td>   
    <td>
    <button class="btn btn-danger btn-sm remove_items" id="remove_items{{random_items_id}}" data_id="{{item.id}}" type="button" title="Delete"> <i class="fa fa-trash"></i></i> </button>
  </td>                           
</tr>
</script>
  <script type="text/javascript">
    fetchStatesList();
    var labels_no = 0;

    $(document).ready(function() {
      var url_var = getUrlVars();

      state_id = url_var['state_id'];
      //console.log(state_id)
      var random_items_id = Date.now();
      roles_options = get_roles_options();
      $('#add_items').click(function() {
        random_items_id = Date.now();
        RenderPre(random_items_id);

      });


      var items_data = '';
      if (state_id != null && state_id != undefined) {
        var state_data = get_state_level_role_data(state_id);
        var items_row = 0;
        $.each(state_data, function(key, itemdata) {
          ++items_row;
          random_items_id = items_row;

          RenderPre(random_items_id, itemdata);
        });
      } else {
        itemdata = {};
        RenderPre(random_items_id, itemdata);
      }

      function RenderPre(random_items_id, itemdata) {
        var labels_no = $(".delete_items").length;
        ++labels_no;
        var source = $("#items_template").html();
        Mustache.parse(source);
        var rendered = Mustache.render(source, {
          random_items_id: random_items_id,
          itemdata: itemdata,
        });

        var levels_options = get_levels_options(labels_no);
        if (levels_options != '') {
          $("#items_container").append(rendered);
          $('#levels' + random_items_id).html(levels_options);
          $('#roles' + random_items_id).html(roles_options);
          if (itemdata) {
            $('#roles' + random_items_id).val(itemdata.role_id).trigger('change');
            $.each(itemdata.Sublevel, function(key, itemdata) {
                $("input[name='sublevel["+random_items_id+"]["+itemdata.sublevel_id+"]']:checkbox").prop('checked',true);
            });
          }
          pr_no_inc();
          delete_item(random_items_id);
        } 
        // else {
        //   TRIFED.showError('error', 'No More Levels Found');
        // }

      }


      function pr_no_inc() {
        var item_no = 0;
        $('.item_no').each(function() {
          ++item_no;
          $(this).html(item_no);
        });

        var count = $(".delete_items").length;

        //$('.remove_items').first().hide();   
        $('.remove_items').show();
        if (count == 1) {
          $('.remove_items').hide();
        } else {
          $('.remove_items').not(':last').hide();
        }



      }

      function delete_item(random_items_id) {
        $("#remove_items" + random_items_id).click(function() {
          var count = $(".delete_items").length;
          if (count > 1) {
            $("#delete_items" + random_items_id).remove();
            pr_no_inc();
          }
        });
      }


      // $("#formID").validate({
      //     ignore: [],
      //     rules: {
      //         state_id: "required",
      //       //   'category[]': {
      //       //   required: true
      //       // }

      //     },
      //     messages: {
      //         state_id: "Please select state"
      //     }

      // });

    $('#save').on('click', function(e) {
      if($("#formID").validationEngine('validate')){
        var url_var = getUrlVars();
        state_id = url_var['state_id'];
        if (state_id != null && state_id != undefined) {
            var url = conf.updateScrutiny.url(state_id);
            var method = conf.updateScrutiny.method;
        } else {
            var url = conf.addScrutiny.url;
            var method = conf.addScrutiny.method;
        }

     
        var data = $('#formID').serializeArray();
        TRIFED.asyncAjaxHit(url, method, data, function(response) {
          if (response.status == 1) {
            response_data = response.data;

            var url_var = getUrlVars();
            state_id = url_var['state_id'];
            if (state_id != null && state_id != undefined) {
              TRIFED.showMessage('success', 'Successfully Updated');
            } else {
              TRIFED.showMessage('success', 'Successfully Added');
            }


            setTimeout(function() {
              document.location = "view-role-mapping.php";
            }, 500);

          } else {
            TRIFED.showError('error', response.message);
            return false;
          }
        });
      }
      });

    });

    function getUrlVars() {
      var vars = [],
        hash;
      var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
      for (var i = 0; i < hashes.length; i++) {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
      }
      return vars;
    }
  </script>
</body>

</html>