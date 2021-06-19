var auth = TRIFED.getLocalStorageItem();
var editCommission = TRIFED.checkPermissions("master_management_edit");
var statusCommission = TRIFED.checkPermissions("master_management_status");
var viewCommission = TRIFED.checkPermissions("master_management_view");
$(function () {
	// TRIFED.checkToken();
	// if(viewMaster){
	// 	fetchDesignationList();
	//   }
    
	
	//editCommissionLimit();
});	

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
    //editCommissionLimit();
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
					columns: [0, 1, 2,3,4]
				}
			},
			

			
		  ],
        "ajax": {
            "url": conf.getCommissionLimitList.url,
            "dataType": "json",
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
            { "data": "state_name" },
            { "data": "state_name"},
            { "data": "commission"},
            { "data": "max_aggregate_commission" },
            {
                "orderable": false,
                "render": function(data, type, row) {
                        
                        if(statusCommission){
                            subHtml = (row.status == 1) ? '<a class="data-active" data-toggle="tooltip" data-placement="top" title="" data-original-title="Active" onClick="changeActiveStatus('+row.id+')">Active</a>' : '<a class="data-inactive" data-toggle="tooltip" data-placement="top" title="" data-original-title="Inactive" onClick="changeActiveStatus('+row.id+')">Inactive</a>';
                            return subHtml;
                        }
                        
                }
            },

            {
                "orderable": false,
                "render": function (data, type, row) {
                    var action = '';
                    if (editCommission) {
                        // action += '<a href="../masters/add-commission-master.php?id=' + row.id + '" class="data-edit" data-toggle="tooltip" data-role="update" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>'
                        action+='<a class="data-edit" data-toggle="tooltip" data-role="update" data-placement="top" title="Edit" data-id="'+row.id+'"><i class="fa fa-edit"></i></a>'; 
                       
                    }
                    return action;

                }
            }


        ]

    });



    $('#user-list').on('click','.data-edit',function(e){
       
		e.preventDefault();
		var id = '';
        id = $(this).attr('data-id');
        //console.log($(this));
		var url = conf.viewCommissionLimitMaster.url(id);
		var method = conf.viewCommissionLimitMaster.method;
		var data = {};
		TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
			if (response.status == 1) {
                console.log(response.data);
				fillCommissionLimitData(response.data);
			} else {
				TRIFED.showMessage('error', cb);
			}
		});
    });
    
    $(".dataTables_filter").css('display','none');

});

fillCommissionLimitData = (data) =>{
	$('#editModal').modal('show');
    $('#edit_state').val(data.state_id);
    $('#edit_commission').val(data.commission);
    $('#edit_max_aggregate_commission').val(data.max_aggregate_commission);
	$('#updateID').val(data.id);
	
}

$('#btn_filter').click(function () {
    oTable.api().ajax.reload();
});

changeActiveStatus = (id) => {

	if (confirm('Are you sure you want to change the status?')) {

		const _t = $(this);

		var url = conf.toggleCommissionLimitMasterStatus.url(id);
        var method = conf.toggleCommissionLimitMasterStatus.method;
      
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

var commission_limit_id = TRIFED.getUrlParameters().id;

$('#form_submit').on('click', function (e) {

	if ($("#formID").validationEngine()) {
 		if (commission_limit_id != undefined && commission_limit_id != null) {
			var url = conf.updateCommissionLimitMaster.url(commission_limit_id);
			var method = conf.updateCommissionLimitMaster.method;
		} else {
			var url = conf.addCommissionLimitMaster.url;
			var method = conf.addCommissionLimitMaster.method;
		}
		const data = $('#formID').serialize();
		TRIFED.asyncAjaxHit(url, method, data, function (response) {
			if (response.status == 1) {
				$('#formID')[0].reset();
				
				TRIFED.showMessage('success', 'Successfully Added');
				setTimeout(function () { window.location = 'commission-limit-list.php' }, 500);
			} else {
				TRIFED.showError('error', response.message);
			}
		});
	} 
	
});

$('#updateButton').on('click', function (e) {

	if ($("#formID").validationEngine()) {
        commission_limit_id = $("#updateID").val();
        var url = conf.updateCommissionLimitMaster.url(commission_limit_id);
        var method = conf.updateCommissionLimitMaster.method;
        const data = $('#updateFormId').serialize();
		TRIFED.asyncAjaxHit(url, method, data, function (response) {
			if (response.status == 1) {
				$('#formID')[0].reset();
				TRIFED.showMessage('success', 'Successfully Updated');
				setTimeout(function () { window.location = 'commission-limit-list.php' }, 500);
			} else {
				TRIFED.showError('error', response.message);
			}
		});
	} 
	
});


	// alert('sadasdasdasd')


	

