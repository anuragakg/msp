var auth = TRIFED.getLocalStorageItem();
const proposal_id = TRIFED.getUrlParameters().proposal_id;
$('#proposal_id').val(proposal_id);
$(document).ready(function () {

    var oTable = $('#list').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [[0, "DESC"]],
        "dom": 'lBfrtip',
        oLanguage: {
            sProcessing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
        },
        "buttons": [
            {
                extend: 'excel',
                text: '<i class="fa fa-file-excel-o"></i> Export to Excel',
                titleAttr: 'EXCEL',
                title: 'Actual Overhead Detail',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6]
                }
            },
        ],

        "ajax": {
            "url": conf.getOverheadActualDetail.url,
            "dataType": "json",
            "type": "GET",
            "headers": {
                "Authorization": 'Bearer ' + auth.token
            },
            "data": function (d, settings) {
                var api = new $.fn.dataTable.Api(settings);
                d.page = api.page() + 1;
                d.proposal_id = $('#proposal_id').val();
                

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
                    return PageInfo.start + 1 + meta.row;;
                }
            },
            {
                "orderable": false,
                "render": function (data, type, row) {

                    return row.proposal_id;
                }
            },
            {
                "orderable": false,
                "render": function (data, type, row) {

                    return '2';
                }
            },
            {
                "className": "text-right",
                "orderable": false,
                "render": function (data, type, row) {
                    return utils.formatAmount(row.haat_amount_spent);
                }
            },
            {
                "className": "text-right",
                "orderable": false,
                "render": function (data, type, row) {
                    return utils.formatAmount(row.warehouse_amount_spent);
                }
            },
            {
                "className": "text-right",
                "orderable": false,
                "render": function (data, type, row) {
                    return '<a href="javascript:void(0)" onClick="getSpentDetails(\''+row.ref_id+'\')">'+utils.formatAmount(row.total_amount_spent)+'</a>';
                }
            },
            {
                "orderable": false,
                "render": function (data, type, row) {
                    return row.date;
                }
            },
            // {
            //     "orderable": false,
            //     "render": function(data, type, row) {
            //             if(row.status==1)
            //             {
            //                 var status='Active';
            //             }else{
            //                 var status='In-Active';
            //             }

            //             //if(statusPacking){
            //                 subHtml = (row.status == 1) ? '<a class="data-active" data-toggle="tooltip" data-placement="top" title="" data-original-title="Active" onClick="changeActiveStatus('+row.id+')">Active</a>' : '<a class="data-inactive" data-toggle="tooltip" data-placement="top" title="" data-original-title="Inactive" onClick="changeActiveStatus('+row.id+')">Inactive</a>';
            //                 return subHtml
            //             // }else{
            //             //     return status;
            //             // }

            //     }
            // },
            {
                "orderable": false,
                "render": function (data, type, row) {
                    //return '<a href="../actual-details/view-actual-overhead-details.php?id=' + row.ref_id + '" class="btn btn-primary">View</a>|<a href="../actual-details/overhead-details.php?id=' + row.ref_id + '" class="btn btn-primary">Edit</a>';
                    return '<a href="../actual-details/view-actual-overhead-details.php?id=' + row.ref_id + '" class="btn btn-primary">View</a>';

                }
            },


        ]

    });
    $('#proposal_id').on('keyup', function () {
        oTable.ajax.reload();
    });

    $('#reset_filter').on('click', function () {
        $('.filter').val('');
        oTable.ajax.reload();
    });
    $(".dataTables_filter").hide();

});
function getSpentDetails(id){
    
    var url = conf.getActualOverheadSpentDetail.url(id);
    var method = conf.getActualOverheadSpentDetail.method;

    var data = {};

    TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
        if (response.status) {
            result=response.data;
            html='';
            html +='<tr>';
                html +='<td>Actual Overhead Collection Level</td>';
                html +='<td class="textval-right">'+decimalValues(result.ActualOverheadCollectionLevel)+'</td>';
            html +='</tr>';
            html +='<tr>';
                html +='<td>Actual Overhead Estimated Wastages</td>';
                html +='<td class="textval-right">'+decimalValues(result.ActualOverheadEstimatedWastages)+'</td>';
            html +='</tr>';
            html +='<tr>';
                html +='<td>Actual Overhead Labour Charges</td>';
                html +='<td class="textval-right">'+decimalValues(result.ActualOverheadLabourCharges)+'</td>';
            html +='</tr>';
            html +='<tr>';
                html +='<td>Actual Overhead Other Costs</td>';
                html +='<td class="textval-right">'+decimalValues(result.ActualOverheadOtherCosts)+'</td>';
            html +='</tr>';
            html +='<tr>';
                html +='<td>Actual Overhead Service Charges</td>';
                html +='<td class="textval-right">'+decimalValues(result.ActualOverheadServiceCharges)+'</td>';
            html +='</tr>';
            html +='<tr>';
                html +='<td>Actual Overhead Service Charges DIA</td>';
                html +='<td class="textval-right">'+decimalValues(result.ActualOverheadServiceChargesDIA)+'</td>';
            html +='</tr>';
            html +='<tr>';
                html +='<td>Actual Overhead Transportation Charges</td>';
                html +='<td class="textval-right">'+decimalValues(result.ActualOverheadTransportationCharges)+'</td>';
            html +='</tr>';
            html +='<tr>';
                html +='<td>Actual Overhead Warehouse Charges</td>';
                html +='<td class="textval-right">'+decimalValues(result.ActualOverheadWarehouseCharges)+'</td>';
            html +='</tr>';
            html +='<tr>';
                html +='<td>Actual Overhead Warehouse Labour Charges</td>';
                html +='<td class="textval-right">'+decimalValues(result.ActualOverheadWarehouseLabourCharges)+'</td>';
            html +='</tr>';
            html +='<tr>';
                html +='<td>Actual Overhead Weightment Charges</td>';
                html +='<td class="textval-right">'+decimalValues(result.ActualOverheadWeightmentCharges)+'</td>';
            html +='</tr>';
            $('#details_tab').append(html);
            $('#spentModal').modal('show');
       } else {
            TRIFED.showError('error', response.message);
        }

    }); 
}

changeActiveStatus = (id) => {

    if (confirm('Are you sure you want to change the status?')) {

        const _t = $(this);

        var url = conf.toggleOverheadStatus.url(id);
        var method = conf.toggleOverheadStatus.method;

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
