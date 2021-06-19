var auth = TRIFED.getLocalStorageItem();
var statusHaatMaster = TRIFED.checkPermissions("master_managment_status");
var editHaatMaster = TRIFED.checkPermissions("master_managment_edit");

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
    fetchState();
    fetchBlockList(0,0);
    var serial = 0;
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
                title: 'Haat Bazaar Master List',
                exportOptions: {
                    columns: [0, 1, 2,3,4,5,6,7]
                }
            },
          ],
        "ajax": {
            "url": conf.getHaatMasterList.url,
            "dataType": "json",
            "type": "GET",
            "headers": {
                "Authorization": 'Bearer ' + auth.token
            },
            "data": function (d, settings) {
                var api = new $.fn.dataTable.Api(settings);

                d.page = api.page() + 1;
             
                d.state = $('#states0').val();
                d.district = $('#district0').val();
                d.haat = $('#hatts0').val();
                d.operating_days = $('#operating_days0').val();
                d.nature_of_operation = $('#nature_of_operation0').val();
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
                return row.district_name;
                }
            },
            { 
                "orderable": false,
                "render": function(data, type, row) {
                return row.haat_bazaar_name;
                }
            },
            { 
                "orderable": false,
                "render": function(data, type, row) {
                    return row.block_ids.map(v => v.block_name).join(",")
                    return row.blocks_name;
                }
            },
            { 
                "orderable": false,
                "render": function(data, type, row) {
                    return row.operating_days;
                }
            },
            
            {
                "orderable": false,
                "render": function(data, type, row) {
                    return row.nature_of_operation;
                }
               
            },
            {
                "orderable": false,
                "render": function(data, type, row) {
                        if(row.status==1)
                        {
                            var status='Active';
                        }else{
                            var status='In-Active';
                        }
                        
                        if(statusHaatMaster){
                            subHtml = (row.status == 1) ? '<a class="data-active" data-toggle="tooltip" data-placement="top" title="" data-original-title="Active" onClick="changeActiveStatus('+row.id+')">Active</a>' : '<a class="data-inactive" data-toggle="tooltip" data-placement="top" title="" data-original-title="Inactive" onClick="changeActiveStatus('+row.id+')">Inactive</a>';
                            return subHtml
                        }
                        return status;
                        
                }
            },

            {
                "orderable": false,
                "render": function (data, type, row) {
                    var action = '';
                    if (editHaatMaster) {
                        action += '<a href="../masters/add-haat-bazaar.php?id=' + row.id + '" class="data-edit" data-toggle="tooltip" data-role="update" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>'
                    }
                    else{
                        action = '<b>NA</b>'
                    }
                    return action;

                }
            }


        ]

    });
    

    $('#states0,#district0,#hatts0,#blocks0,#operating_days0,#nature_of_operation0').on('change',function () {
        serial = 0;
        oTable.ajax.reload();
    });
    $('.dataTables_filter').css('display','none');
    
    $('#reset_filter').on('click',function(){
        $('#states0').val('');
        $('#district0').val('');
        $('#hatts0').val('');
        $('#nature_of_operation0').val('');
        $('#operating_days0').val('');
        $('#operating_days0').select2().trigger('change');
        $('#blocks0').select2().trigger('change');
        oTable.ajax.reload();
    });
});

$('#blocks0').select2();
$('#operating_days0').select2();

changeActiveStatus = (id) => {

	if (confirm('Are you sure you want to change the status?')) {

		const _t = $(this);

		var url = conf.toggleHaatMasterStatus.url(id);
		var method = conf.toggleHaatMasterStatus.method;
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

