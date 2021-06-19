var auth = TRIFED.getLocalStorageItem();
var editMaster = TRIFED.checkPermissions("master_management_edit");
var statusMaster = TRIFED.checkPermissions("master_management_status");

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
        oLanguage: {
            sProcessing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
        },
        "ajax": {
            "url": conf.getScrutinyManagementList.url,
            "dataType": "json",
            "type": "GET",
            "headers": {
                "Authorization": 'Bearer ' + auth.token
            },
            "data": function (d, settings) {
                var api = new $.fn.dataTable.Api(settings);

                d.page = api.page() + 1;
                d.state = $('#state').val();
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
            { "data": "state" },
           
            { 
                "orderable": false,
                "render": function(data, type, row) 
                {
                    return get_state_level_roles(row.state_levels);
                       
                }
            },

            {
                "orderable": false,
                "render": function (data, type, row) {
                    var action = '';
                    //if (editPacking) {
                        action += '<a href="../role-mapping/role-mapping.php?state_id=' + row.state_levels[0]['state_id'] + '" class="data-edit" data-toggle="tooltip" data-role="update" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>'
                       
                    //}
                    return action;

                }
            }


        ]

    });
    $('#state').on('change',function () {
        serial = 0;
        oTable.ajax.reload();
    });
    $('.dataTables_filter').css('display','none');
    
    $('#reset_filter').on('click',function(){
        $('.filter').val('');
        oTable.ajax.reload();
    });

    function get_state_level_roles(data)
{

	//console.log(data)
	var td_data='';
	$.each(data, function(k, v) {
	    //display the key and value pair
	    
	    td_data +=' <div class="col-md-6">'+
                    '<div class="col-md-12"><b class="b-dark">'+v.level+'</b> <span>'+v.role_name+'</span></div>'
                                +'</div>';
	   
	});
	return td_data;
}

});


$('#btn_filter').click(function () {
    oTable.api().ajax.reload();
});

changeActiveStatus = (id) => {

	if (confirm('Are you sure you want to change the status?')) {

		const _t = $(this);

		var url = conf.togglePackingStatus.url(id);
        var method = conf.togglePackingStatus.method;
      
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