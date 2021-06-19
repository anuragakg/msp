var auth = TRIFED.getLocalStorageItem();
var editProposal = TRIFED.checkPermissions("mfp_procurement_plan_edit");
var viewProposal = TRIFED.checkPermissions("mfp_procurement_plan_view");
var addProposal = TRIFED.checkPermissions("mfp_procurement_plan_add");
var statusProposal = TRIFED.checkPermissions("mfp_procurement_plan_status");
var url_var = getUrlVars();

$(document).ready(function () {
	
	var oTable = $('#list').DataTable({
		"processing": true,
		"serverSide": true,
		"order": [[0, "DESC"]],
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
				title: 'MFP List',
				exportOptions: {
					columns: [0, 1, 2,3]
				}
			},
		  ],
            "ajax":{
                     "url": conf.ProcurementMfpListing.url(url_var['id']),
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
                            "orderable": false,
		                	"render": function(data, type, full, meta) {
						        var PageInfo = $('#list').DataTable().page.info();
						        return PageInfo.start+1+meta.row;
						    }
						},
		               { 
							"orderable": false,
		                	"render": function(data, type, row) {
		                		return row.mfp_name
						       
						    }
						},
						{ 
							"orderable": false,
		                	"render": function(data, type, row) {
		                		return decimalValues(row.qty)
						       
						    }
						},
						{ 
							"orderable": false,
		                	"render": function(data, type, row) {
		                		return decimalValues(row.value)
						       
						    }
						}
						
						
					]

      });
$(".dataTables_filter").hide();
oTable.on('xhr', function() {
        var ajaxJson = oTable.ajax.json();
        //console.log(ajaxJson.data.data[0].proposal_id);
        $(".proposal_id").html("Proposal Id: "+ajaxJson.data.data[0].proposal_id+'<a href="javascript:window.history.back()" class="btn btn-primary btn-sm pull-right">Back</a>');
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