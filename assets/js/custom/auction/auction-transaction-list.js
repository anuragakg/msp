var auth = TRIFED.getLocalStorageItem();
var url_var = getUrlVars();
var type=1;
if (url_var['type'] != undefined) {
    type = url_var['type'];
    
}
if(type==1)
{
    type1=true;
    type2=false;
    
}else{
    type1=false;
    type2=true;
}
var auction_view_transaction_detail = TRIFED.checkPermissions("auction_view_transaction_detail");
var auction_create_transaction_detail = TRIFED.checkPermissions("auction_create_transaction_detail");
$(document).ready(function () {
    fetchState();
    $('.date').datepicker({
        todayBtn: "linked",
        
        format: 'dd/mm/yyyy',
        //startDate: new Date('2018-01-01'),
        endDate: new Date()

    });
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
                title: 'auction-committe-list',
                exportOptions: {
                    columns: [0,1, 2, 3, 4, 5, 6]
                }
            },
        ],

        "ajax": {
            "url": conf.getAuctionTransactionList.url,
            "dataType": "json",
            "type": "GET",
            "headers": {
                "Authorization": 'Bearer ' + auth.token
            },
            "data": function (d, settings) {
                var api = new $.fn.dataTable.Api(settings);
                d.page = api.page() + 1;
                d.state_id=$('#state_id').val();
                d.district_id=$('#district_id').val();
                d.warehouse_id=$('#warehouse_id').val();
                d.mfp_id=$('#mfp_id').val();
                d.from_date=$('#from_date').val();
                d.to_date=$('#to_date').val();
                d.type=type;
            },
            'error': function(error) {
                            if (error && error.status == 403) {
                                TRIFED.showError('error', 'You are not authorised');
                                
                            }
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
                    
                    
                    return  PageInfo.start + 1 + meta.row;;
                }
            },
            
            {
                "orderable": false,
                "render": function (data, type, row) {
                    return row.district_id_name;
                }
            },
            {
                "orderable": false,
                "render": function (data, type, row) {
                    return row.warehouse_name;
                }
            },
            {
                "visible": type1,
                "orderable": false,
                "render": function (data, type, row) {
                    return row.mfp_name;
                }
            },
            {
                "visible": type2,
                "orderable": false,
                "render": function (data, type, row) {
                    return row.value_added_product_name;
                }
            },
            {
                "orderable": false,
                "render": function (data, type, row) {
                    return row.qty;
                },
                "className": "text-right"
            },
            {
                "orderable": false,
                "render": function (data, type, row) {
                    return row.value;
                },
                "className": "text-right"
            },
            {
                "orderable": false,
                "render": function (data, type, row) {
                    return row.auction_date;
                }
            },
            {
                "orderable": false,
                "render": function (data, type, row) {
                    html='&nbsp;';
                    if(auction_create_transaction_detail)
                    {
                        html += '<a href="../auction/add-auction-transaction-detail.php?ref_id='+row.ref_id+'&type='+row.type+'" class="data-edit"><i class="fa fa-edit" title="Edit"></i></a>';       
                    }
                    
                    if(auction_view_transaction_detail)
                    {
                        html += ' |<a href="../auction/view-auction-transaction-details.php?ref_id='+row.ref_id+'" class="btn btn-primary">View Details</a>';      
                    }
                    
                    return html;
                }
            },
            
            
        
        ]

    });
   
    $('#reset_filter').on('click',function(){
            $('.filter').val('');
            oTable.ajax.reload();
    });
    $('#state_id').on('change',function(){
        if($(this).val()!='')
        {
            getStateMfp($(this).val());
        }
            //getDistricts();
            oTable.ajax.reload();
    });
    $('#district_id').on('change',function(){
            //getWarehouse();
            oTable.ajax.reload();
    });
    $('#warehouse_id,#from_date,#to_date,#mfp_id').on('change',function(){
            oTable.ajax.reload();
    });

    


});


fetchState = () => {
    var url = conf.getStates.url;
    var method = conf.getStates.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, 'GET', data, function (response, cb) {
        if (response) {
            addressData = response.data;
            fillStates(response.data);
        } else {
            TRIFED.showMessage('error', cb);
        }
    });
}

fillStates = (states) => {
    html = '<option value="">Select State</option>';
    $.each(states, function(i, state) {
        html += '<option value="'+state.id+'">'+state.title+'</option>';
    });
    $('#state_id').html(html);
}
$(document).on('change','#state_id', function (ev) {

    const v = $(this).val();
    var item_id = $(this).attr('state_id');
    fetchDistrict(v,item_id);
});

fetchDistrict = (id = 0) => {
    var url = conf.getDistricts.url;
    var method = conf.getDistricts.method;
    var data = {
        state_id : id
    };
    TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
        if (response) {
            fillDistrict(response.data);
        }
    });
}

fillDistrict = (districts) => {
    html = '<option value="">Select District</option>';
    $.each(districts, function(i, district) {
        html += '<option value="'+district.id+'">'+district.title+'</option>';
    });
    $('#district_id').html(html);
}
$(document).on('change','#district_id', function (ev) {

    const v = $(this).val();
    getDistrictWarehouse(v);
});
function getDistrictWarehouse(district_id)
{
    var url = conf.getDistrictWarehouse.url;
    var method = conf.getDistrictWarehouse.method;
    var data = {district_id:district_id};
    TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
        if (response) {
            
            fillDistrictWarehouse(response.data,'#warehouse_id')
        }
    });
}

fillDistrictWarehouse = (warehouses, item_id = 0) => {
    html = '<option value="">Select Warehouse</option>';
    $.each(warehouses, function (i, warehouse) {
        html += '<option value="' + warehouse.id + '">' + warehouse.warehouse_name + '</option>';
    });
    $(item_id).html(html);
}
getStateMfp = (id = 0) => {
    var url = conf.getStateMfp.url;
    var method = conf.getStateMfp.method;
    var data = {
        state_id : id
    };
    TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
        if (response) {
            fillMfp(response.data);
        }
    });
}

fillMfp = (mfps) => {
    html = '<option value="">Select MFP</option>';
    $.each(mfps, function (i, mfp) {
        html += '<option value="' + mfp.id + '">' + mfp.mfp_name + '</option>';
    });
    $('#mfp_id').html(html);
}
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