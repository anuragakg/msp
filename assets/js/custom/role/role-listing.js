var auth = TRIFED.getLocalStorageItem();
var editRole = TRIFED.checkPermissions("role_edit");
var statusRole = TRIFED.checkPermissions("role_status");
var role_id = TRIFED.getUrlParameters().id;

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
	if (role_id != undefined && role_id != '') {
		fetchRole(role_id);

	}

	var oTable = $('#user-list').DataTable({
		"processing": true,
		"serverSide": true,
		"order": [[0, "ASC"]],
		"dom": 'lBfrtip',
		oLanguage: {
			//sProcessing: "<div class='listing-loader'></div>"
			sProcessing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
		},
		"buttons": [

			{
				extend: 'excel',
				text: '<i class="fa fa-file-excel-o"></i> Export to Excel',
				titleAttr: 'EXCEL',
				title: 'Roles List',
				exportOptions: {
					columns: [0, 1, 2]
				}
			},
			

			
		  ],
            "ajax":{
                     "url": conf.getRolesListing.url,
                     "dataType": "json",
                     "type": "GET",
                     "headers": {
		                "Authorization": 'Bearer ' + auth.token
		            },
		            "data": function(d, settings){
				         var api = new $.fn.dataTable.Api(settings);
				         
				         d.page = api.page()+1;
				      },
		            "dataSrc": function(json) {
		            		json.draw = json.data.draw;
							json.recordsTotal = json.data.recordsTotal;
							json.recordsFiltered = json.data.recordsFiltered;			
	       					return json.data.data;
	       						
	    			}
                   },
		            "columns": [
		                { 
		                	"render": function(data, type, full, meta) {
						        var PageInfo = $('#user-list').DataTable().page.info();
						        return PageInfo.start+1+meta.row;
						        
						    }



		                },
		                { "data": "title" },
						{ "data": "description" },
						{
							"orderable": false,
							"render": function(data, type, row) {
									if(row.status==1)
									{
										var status='Active';
									}else{
										var status='In-Active';
									}
									
									if(statusRole){
										subHtml = (row.status == 1) ? '<a class="data-active" data-toggle="tooltip" data-placement="top" title="" data-original-title="Active" onClick="changeActiveStatus('+row.id+')">Active</a>' : '<a class="data-inactive" data-toggle="tooltip" data-placement="top" title="" data-original-title="Inactive" onClick="changeActiveStatus('+row.id+')">Inactive</a>';
										return subHtml
									}
									
							}
						},

						{
							"orderable": false,
							"render": function(data, type, row) {
									var action='';
									if(editRole){
										// action +='<a href="../role-management/add_role.php?id='+row.id+'"><i class="fa fa-pencil" title="Edit"></i></a>';
										action += '<a href="../role-management/add_role.php?id=' + row.id + '" class="data-edit" data-toggle="tooltip" data-role="update" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a> '
										action += '<a href="../role-management/view_role_permission.php?id=' + row.id + '" class="data-edit" data-toggle="tooltip" data-role="update" data-placement="top" title="View Permission"><i class="fa fa-eye"></i></a> '
										action += '<a href="../role-management/edit_role_permission.php?id=' + row.id + '" class="data-edit" data-toggle="tooltip" data-role="update" data-placement="top" title="Edit Permission"><i class="fa fa-lock"></i></a>'
									}
									return action;
									
							}
						}
		                
		                
		            ]

      });

    

		

	});




fetchRole = (role_id) => {

	var url = conf.viewRole.url(role_id);
	var method = conf.viewRole.method;
	var data = {};


	TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
		if (response) {
			data = response.data;
			fillRole(data);

		} else {
			TRIFED.showMessage('error', cb);
		}
	});
}
fillRole = (data) => {
	$('#title').val(data.title);
	$('#description').html(data.description);
	$('#status').val(data.status);

}


changeActiveStatus = (id) => {

	if (confirm('Are you sure you want to change the status?')) {

		const _t = $(this);

		var url = conf.toggleRoleStatus.url(id);
		var method = conf.toggleRoleStatus.method;
		var data = {};
		data.user_id = id;
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



$('#btn_filter').click(function () {
	oTable.api().ajax.reload();
});

$('#add_role').on('click', function (e) {

	var id = TRIFED.getUrlParameters().id;
	if (id != undefined && id != null) {
		var url = conf.updateRole.url(id);
		var method = conf.updateRole.method;
	} else {
		var url = conf.addRole.url;
		var method = conf.addRole.method;
	}


	const data = $('#formID').serialize();
	TRIFED.asyncAjaxHit(url, method, data, function (response) {
		if (response.status == 1) {
			$('#formID')[0].reset();
			TRIFED.showMessage('success', 'Successfully Added');

			setTimeout(function() { window.location = 'role-listing.php'}, 500);



		} else {
			TRIFED.showError('error', response.message);
		}
	});
});