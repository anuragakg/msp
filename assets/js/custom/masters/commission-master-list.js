var auth = TRIFED.getLocalStorageItem();
var editCommission = TRIFED.checkPermissions("master_management_edit");
var statusCommission = TRIFED.checkPermissions("master_management_status");

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
				title: 'Commission Master List',
				exportOptions: {
					columns: [0, 1, 2,3,4,5]
				}
			},
			

			
		  ],
        "ajax": {
            "url": conf.getCommissionMasterList.url,
            "dataType": "json",
            "type": "GET",
            "headers": {
                "Authorization": 'Bearer ' + auth.token
            },
            "data": function (d, settings) {
                var api = new $.fn.dataTable.Api(settings);
                d.state = $("#state").val();
                d.role = $("#role").val();
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
            {  
                "orderable": false,
               "render": function(data, type, full, meta) {
						        var PageInfo = $('#user-list').DataTable().page.info();
						        return PageInfo.start+1+meta.row;
						        
						    }
            },
            {
                "orderable": false,
                "render": function(data, type, row) {
                    return row.state_name;
                }
            },
            {
                "orderable": false,
                "render": function(data, type, row) {
                    return row.role_name;
                }
            },
            {
                "orderable": false,
                "render": function(data, type, row) {
                    return row.commission;
                }
            },
            {
                "orderable": false,
                "render": function(data, type, row) {
                    return row.max_aggregate_commission;
                }
            },
            {
                "orderable": false,
                "render": function(data, type, row) {
                    var subHtml='';
                       
                        
                        if(statusCommission){
                            subHtml = (row.status == 1) ? '<a class="data-active" data-toggle="tooltip" data-placement="top" title="" data-original-title="Active" onClick="changeActiveStatus('+row.id+')">Active</a>' : '<a class="data-inactive" data-toggle="tooltip" data-placement="top" title="" data-original-title="Inactive" onClick="changeActiveStatus('+row.id+')">Inactive</a>';
                            return subHtml;
                        }else{
                            subHtml = (row.status == 1) ? '<a class="data-active" data-toggle="tooltip" data-placement="top" title="" data-original-title="Active" >Active</a>' : '<a class="data-inactive" data-toggle="tooltip" data-placement="top" title="" data-original-title="Inactive">Inactive</a>';
                            return subHtml;
                        }
                        
                }
            },

            {
                "orderable": false,
                "render": function (data, type, row) {
                    var action = '';
                    if (editCommission) {
                        action += '<a href="../masters/add-commission-master.php?id=' + row.id + '" class="data-edit" data-toggle="tooltip" data-role="update" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>'
                       
                    }else{
                        action = '<b>NA</b>';
                    }
                    return action;

                }
            }


        ]

    });

    $('#state,#role').on('change',function () {
        serial = 0;
        oTable.ajax.reload();
    });
    $('.dataTables_filter').css('display','none');
    
    $('#reset_filter').on('click',function(){
        $('.filter').val('');
        oTable.ajax.reload();
    });

});




changeActiveStatus = (id) => {

	if (confirm('Are you sure you want to change the status?')) {

		const _t = $(this);

		var url = conf.toggleCommissionMasterStatus.url(id);
        var method = conf.toggleCommissionMasterStatus.method;
      
		var data = {};
		data.id = id;
		TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
			if (response.status) {
				TRIFED.showMessage('success', response.data.message);
				setTimeout(function () {
					location.reload();
				}, 500);
			} else {
				TRIFED.showError('error', response.message);
			}

		});
	}
}