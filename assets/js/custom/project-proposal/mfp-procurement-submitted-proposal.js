var auth = TRIFED.getLocalStorageItem();
var editProposal = TRIFED.checkPermissions("mfp_procurement_plan_edit");
var viewProposal = TRIFED.checkPermissions("mfp_procurement_plan_view");
var addProposal = TRIFED.checkPermissions("mfp_procurement_plan_add");
var statusProposal = TRIFED.checkPermissions("mfp_procurement_plan_status");

$(document).ready(function () {
    fetchProposalIds();
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
                title: 'MFP Procurement List',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7],
					format: {
                     body: function (data, row, column, node ) {
                            return column === 1 ? "\u200C" + removeTags(data) : removeTags(data);
                        }
                    },
                }
            },
        ],
        "ajax": {
            "url": conf.mfpProcurementProposalListing.url,
            "dataType": "json",
            "type": "GET",
            "headers": {
                "Authorization": 'Bearer ' + auth.token
            },
            "data": function (d, settings) {
                var api = new $.fn.dataTable.Api(settings);

                d.page = api.page() + 1;
                d.state_id = $('#state_id').val();
                d.district_id = $('#district_id').val();
                d.year_id = $('#year_id').val();

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
                "render": function (data, type, full, meta) {
                    var PageInfo = $('#list').DataTable().page.info();
                    return PageInfo.start + 1 + meta.row;

                }
            },
            {
                "render": function (data, type, row) {
                    return row.proposal_id;
                }
            },
            {
                "orderable": false,
                "render": function (data, type, row) {
                    return row.mfps;
                }
            },

            {
                "orderable": false,
                "render": function (data, type, row) {
                    return row.quantity

                }
            },
            {
                "orderable": false,
                "render": function (data, type, row) {
                    return row.value

                }
            },
            {
                "orderable": false,
                "render": function (data, type, row) {
                    return row.submitted_on

                }
            },
          
            {
                "orderable": false,
                "render": function (data, type, row) {
                    return row.status_text

                }
            },
           
            {
                "render": function (data, type, row) {
                    var html = '';
                    if (viewProposal) {
                        html += ' <a href="../project-proposal/view-mfp-procurement.php?id=' + row.ref_id + '" class="data-edit"><i class="fa fa-eye" title="View Detail"></i></a>';
                    }
                    return html;
                }
            },
            {
                "orderable": false,
                "render": function (data, type, row) {
                    return row.remarks

                }
            },
            {
                "orderable": false,
                "render": function (data, type, row) {
                    return row.fund_release

                }
            },

        ]

    });

    $('#state_id,#district_id,#proposal_ids,#status').on('change', function () {
        oTable.ajax.reload();
    });
    
    $('#reset_filter').on('click',function(){
        $('.filter').val('');
        oTable.ajax.reload();
    });

});

fetchProposalIds = () => {
	var url = conf.getAllProposalIds.url;
    var method = conf.getAllProposalIds.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, method , data, function (response, cb) {
        if (response) {
            addressData = response.data;
            fillProposalIds(response.data);
        } else {
            TRIFED.showMessage('error', cb);
        }
    });
}


fillProposalIds = (states) => {
	html = '<option value="">Select Proposal</option>';
	$.each(states, function(i, state) {
		html += '<option value="'+state.proposal_id+'">'+state.proposal_id+'</option>';
	});
	$('#proposal_ids').html(html);
}