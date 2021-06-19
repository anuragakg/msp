var auth = TRIFED.getLocalStorageItem(); 
var editPermission = TRIFED.checkPermissions("master_management_edit");
var statusPermission= TRIFED.checkPermissions("master_management_status");
function getUrlVars() {
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for (var i = 0; i < hashes.length; i++) {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
}
$(document).ready(function () {
    var oTable = $('#user-list').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [[0, "ASC"]],
        "dom": 'lBfrtip',
        oLanguage: {
            sProcessing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
        },
        "buttons": [

            {
                extend: 'excel',
                text: '<i class="fa fa-file-excel-o"></i> Export to Excel',
                titleAttr: 'EXCEL',
                title: 'Warehouse master items List',
                exportOptions: {
                    columns: [0, 1, 2,3,4,5]
                }
            },
            

            
          ],
        "ajax": {
            "url": conf.getWarehouseItem.url, 
            "type": "GET",
            "headers": {
                "Authorization": 'Bearer ' + auth.token
            },
            "data": function (d, settings) {
                var api = new $.fn.dataTable.Api(settings);
                d.page = api.page() + 1;
            },
            "dataSrc": function (json) {
                json.draw = json.data.draw;
                json.recordsTotal = json.data.recordsTotal;
                json.recordsFiltered = json.data.recordsFiltered;
                return json.data.data;

            }
        },
        "columns": [
            { "data": "id" },
            { "data": "item_name" },
            { "data": "specification" },
            { "data": "unit" },
            { "data": "cost" },
            {
                "orderable": false,
                "render": function (data, type, row) {
                    var action = '';
                    if (editPermission) {
                        action += '<a href="../masters/add-warehouse-item.php?id=' + row.id + '"><i class="fa fa-pencil" title="Edit"></i></a>';
                    }  
                    if(statusPermission){
                        action += (row.status == 1) ? '<a class="data-active" data-toggle="tooltip" data-placement="top" title="" data-original-title="Active" onClick="changeActiveStatus('+row.id+')">Active</a>' : '<a class="data-inactive" data-toggle="tooltip" data-placement="top" title="" data-original-title="Inactive" onClick="changeActiveStatus('+row.id+')">Inactive</a>';
                    }
                     action += ' | <a href="#" class="data-delete" onClick="DeleteAction('+row.id+')" data-toggle="tooltip" data-role="Delete" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>';
                    return action;

                }
            }


        ]

    });

});


changeActiveStatus = (id) => {

    if(confirm('Are you sure you want to change the status?')){

        const _t = $(this);

        var url = conf.toggleWarehouseItemStatus.url(id);
        var method = conf.toggleWarehouseItemStatus.method;
        var data = {};
        data.user_id = id;
        TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
            if (response.status) {
                if (response.data.status=='1') {
                    _t.attr('class', 'data-active');
                    TRIFED.showMessage('success', response.data.message);
                        /*setTimeout(function () {
                        location.reload();
                    }, 500);*/
                    $('#user-list').DataTable().ajax.reload();
                }
                if (response.data.status=='0') {
                _t.attr('class', 'data-inactive');
                TRIFED.showWarning('info', response.data.message);
                $('#user-list').DataTable().ajax.reload();
            }
                
                return;
            }
            TRIFED.showError('error', response.message);
        });
    }
}


function DeleteAction(id){ 
        if (!confirm('Are you sure you want to delete.')) {
            return;
        }

        var url = conf.deleteWarehouseItemData.url + id;
        var method = conf.deleteWarehouseItemData.method;
        var data = {};
        TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
          if (response.status) {
            if (response.status) {
              setTimeout(function(){ location.reload(); }, 1000);  //Refresh page
              return TRIFED.showMessage("success", "Warehouse Item Master successfully Removed"); 
            }
            return TRIFED.showWarning('info', response.data.message);
          }
          TRIFED.showError('error', response.message);
        });
    }

$('#btn_filter').click(function () {
    oTable.api().ajax.reload();
});

