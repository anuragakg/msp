var auth = TRIFED.getLocalStorageItem();
var tab = TRIFED.getUrlParameters().tab;
role_id=auth.role;
var editInfra = TRIFED.checkPermissions("infrastructure_development_edit");
var viewProposal = TRIFED.checkPermissions("infrastructure_development_view");
var addInfra = TRIFED.checkPermissions("infrastructure_development_add");
var statusInfra = TRIFED.checkPermissions("infrastructure_development_status");
var approval_management_consolidate_proposals = TRIFED.checkPermissions("approval_management_consolidate_proposals");
var district_id=auth.district_id;
var blankdata=0;
$(document).ready(function () {
    $('.date').datepicker({
        todayBtn: "linked",
        
        format: 'dd/mm/yyyy',
        
        endDate: new Date()

    });

    if(role_id==6)
    {
        $('.tab4').hide();
    }
    if(role_id!=3)//ministry
    {
        $('.tab6').hide();
    }
    if(tab!=undefined)
    {
        $('.nav-tabs a[href="#tab'+tab+'"]').tab('show');  
        //$('.tab'+tab).trigger('click');
    }
    /*$('.tab1').on('click',function(){
        updateUrlParameter('tab',1);
    });
    $('.tab4').on('click',function(){
        updateUrlParameter('tab',4);
    });*/ 
    getTabTotalCounts();
    if(tab==1)
    {
        getPendingProposals();
    }
    if(tab==2)
    {
        getRecommended();
    }
    if(tab==3)
    {
        getRevertedProposals();
    }
    if(tab==4)
    {
        getConsolidatedProposals();
    }
     if(tab==5)
    {
        getRejectedProposals();
    }
    if(tab==6)
    {
        getApprovedProposals();
    }
    $('.tab1').on('click',function(){
        updateUrlParameter('tab',1);
        getPendingProposals();
    });
    $('.tab4').on('click',function(){
        updateUrlParameter('tab',4);
        getConsolidatedProposals();
    });
    $('.tab2').on('click',function(){
        updateUrlParameter('tab',2);
        getRecommended();
        
    });
    $('.tab3').on('click',function(){
        updateUrlParameter('tab',3);
        getRevertedProposals();
    });
    $('.tab5').on('click',function(){
        updateUrlParameter('tab',5);  
        getRejectedProposals();
    });

    $('.tab6').on('click',function(){
        updateUrlParameter('tab',6);
        getApprovedProposals();
    });

    fetchDistrict(district_id);
    //fetchProposalIds();
    function getPendingProposals()
{
        $('#list').DataTable().clear().destroy();
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
                title: 'Infrastructure Pending Proposal List',
                exportOptions: {
                    columns: [1, 2, 3, 4, 5, 6, 7,8,9],                  
                    format: {
                     body: function (data, row, column, node ) {
                            
                            if(column === 2 || column === 3|| column === 4)
                            {
                                return strToNumber(data);
                            }else{
                                return column === 1 ? "\u200C" + removeTags(data) : removeTags(data);
                            }
                            
                        }
                    },
                }
            },
        ],
        "ajax": {
            "url": conf.InfrastructuredevelopmentProposalListing.url,
            "dataType": "json",
            "type": "GET",
            "headers": {
                "Authorization": 'Bearer ' + auth.token
            },
            "data": function (d, settings) {
                var api = new $.fn.dataTable.Api(settings);

                d.page = api.page() + 1;
                d.block_id = $('#block_id').val();
                d.district_id = $('#district_id').val();
                d.proposal_id = $('#proposal_id').val();
                d.status = $('#status').val();
                d.from_date = $('#pending_from_date').val();
                d.to_date = $('#pending_to_date').val();

            },
            "dataSrc": function (json) {
                json.draw = json.data.draw;
                json.recordsTotal = json.data.recordsTotal;
                json.recordsFiltered = json.data.recordsFiltered;
                return json.data.data;

            }
        },
        "fnInitComplete" : function(oSettings, json) { 
            $('#count_pending').html(json.data.recordsTotal);
             if(auth.role==6)
            {
                $('#consolidate_submit').hide();
            }else{
                $('#consolidate_submit').show();
            }
        },
        "columns": [
            {
                "orderable": false,
                "render": function(data, type, row) {
                    if (row.current_status==1) 
                    {
                        return '<label class="pos-rel"><input type="checkbox" value="'+row.ref_id+'" class="proposals" name="proposals[]"  /><span class="lbl"> </span></label>';      
                    }else{
                        return '';
                    }
                    
                }	
        
            }, 
            {
                "render": function (data, type, full, meta) {
                    var PageInfo = $('#list').DataTable().page.info();
                    return  PageInfo.start + 1 + meta.row;;
                }
            },
            {
                "render": function (data, type, row) {
                    //return row.proposal_id;
					return ' <a href="../modification-infrastructure/view-infrastructure.php?id=' + row.ref_id + '&proposal_id='+row.proposal_id+'">'+row.proposal_id+'</a>';
                }
            },
             { 
            	"render": function(data, type, row) {
			      return utils.formatAmount(row.summary[0].estimated_requirement_funds);
			    },
                "className": "text-right"
            }, 
             { 
            	"render": function(data, type, row) {
			       return utils.formatAmount(row.summary[0].total_warehouse_facilities);
			    },
                "className": "text-right"
            }, 
             { 
                "render": function(data, type, row) {
                   return utils.formatAmount(row.summary[0].old_fund_available);
                },
                "className": "text-right"
            },
             { 
            	"render": function(data, type, row) {
			       return utils.formatAmount(row.summary[0].total_fund_require);
			    },
                "className": "text-right"
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
                    return row.added_by

                }
            },
            {
                "orderable": false,
                "render": function (data, type, row) {
                    let html='';
                    var class_name=proposal_status_colour(row.current_status);
                    html +='<span class="btn '+class_name+'">'+row.current_status_text+'</span>';
                    html +='<br><span ><i class="fa fa-line-chart" onclick="getInfrastructureStatusLogs('+row.id+')")"></i></span>';
                    return html;

                }
            },
            {
                "orderable": false,
                "render": function (data, type, row) {
                    return row.district

                }
            },
           
           
            {
                "orderable": false,
                "render": function (data, type, row) {
                    var html = '';
                   // if (viewProposal) {
                        html += ' <a href="../modification-infrastructure/verification-sia-level.php?id=' + row.ref_id + '" class="data-edit"><i class="fa fa-eye" title="View Detail"></i></a>';
                 //   }
                    return html;
                }
            },
        
        ]

    });


 $('#pending_search_btn').on('click', function () {
            oTable.ajax.reload();
        });  
    $('.dataTables_filter input').attr("placeholder", "Serach by Proposal Id");
}
function getConsolidatedProposals()
{ $('#consolidated_list').DataTable().clear().destroy();
    var ConsolidatedTable = $('#consolidated_list').DataTable({
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
                title: 'Infrastructure Consolidated List',
                exportOptions: {
                    columns: [1, 2, 3, 4,5],                    
                     format: {
                        body: function (data, row, column, node ) {
                        
                            if(column === 4)
                            {
                                return strToNumber(data);
                            }else{
                                return removeTags(data);
                            }
                        
                        }
                    },
                }
            },
        ],

        "ajax": {
            "url": conf.getInfraConsolidatedProposals.url,
            "dataType": "json",
            "type": "GET",
            "headers": {
                "Authorization": 'Bearer ' + auth.token
            },
            "data": function (d, settings) {
                var api = new $.fn.dataTable.Api(settings);

                d.page = api.page() + 1;
                d.block_id = $('#block_id').val();
                d.district_id = $('#district_id').val();
                d.proposal_id = $('#proposal_id').val();
                d.status = $('#status').val();
                d.from_date = $('#consolidate_from_date').val();
                d.to_date = $('#consolidate_to_date').val();

            },
            "dataSrc": function (json) {
                json.draw = json.data.draw;
                json.recordsTotal = json.data.recordsTotal;
                json.recordsFiltered = json.data.recordsFiltered;
                return json.data.data;

            }
        },
        "fnInitComplete" : function(oSettings, json) {
            $('#count_consolidated').html(json.data.recordsTotal);
        },
        "columns": [
            {
                "orderable": false,
                "render": function(data, type, row) {
                    var is_all_approved=1;
                    
                    proposals=row.proposals;
                    proposals.forEach(function(prop){
                        if(prop.current_status==0 || prop.current_status==2)
                        {
                            is_all_approved=0;
                        }
                        
                    });

                    /*if(is_all_approved==1)
                    {*/
                    return '<label class="pos-rel"><input type="checkbox" value="'+row.id+'" class="consolidated_proposals" name="consolidated_proposals[]"  /><span class="lbl"> </span></label>';                          
                  /*  }else
                    {
                        return '';
                    }*/
                }   
        
            }, 
            {
                "render": function (data, type, full, meta) {
                    var PageInfo = $('#list').DataTable().page.info();
                    
                    
                    return  PageInfo.start + 1 + meta.row;;
                }
            },
            {
                "render": function (data, type, row) {
               
                    return '<a href="../project-proposal/view-consolidated-infra-proposals-list.php?id='+row.id+'" title="view consolidated details">'+ row.reference_number+' ('+row.no_proposal+')</a>';
                }
            },
            {
                "render": function (data, type, row) {
                    return row.state_name;
                }
            },
            {
                "render": function (data, type, row) {
                    return row.year_name;
                }
            },
            {
                "render": function (data, type, row) {
                    return utils.formatAmount(row.total_fund_require);
                },
                    "className": "text-right"
            },
            {
                "orderable": false,
                "render": function (data, type, row) {
                    return '<a href="../proposal-verification/viewInfra-consolidated-proposal.php?id='+row.id+'" title="view consolidated details"><i class="fa fa-eye" aria-hidden="true"></i></a>';
                }
                /* "orderable": false,
                "render": function (data, type, row) {
                    proposals=row.proposals;
                    html='<table class="table table-striped table-bordered">';
                        html +='<tr>';
                            html +='<td>SR.NO.</td>';
                            html +='<td>Proposal Id</td>';
                            html +='<td>Total Fund of requirment for Haat</td>';
                            html +='<td>Total Fund of requirment for Warehouse</td>';
                            html +='<td>Total Value</td>';
                            html +='<td>Status</td>';
                            html +='<td>Action</td>';
                        html +='</tr>';
                    let sr_no=0;

                    proposals.forEach(function(prop){
                        ++sr_no;
                        html +='<tr>';
                            html +='<td>'+ sr_no +'</td>';
                            html +='<td>'+prop.proposal_id+'</td>';
                            html +='<td>'+prop.summary[0].estimated_requirement_funds;+'</td>';
                            html +='<td>'+prop.summary[0].total_warehouse_facilities;+'</td>'; 
                            html +='<td>'+prop.summary[0].total_fund_require+'</td>';

                            var class_name=proposal_status_colour(prop.current_status);

                            html +='<td><span class="btn '+class_name+'">'+prop.current_status_text+'</span><br><span ><i class="fa fa-line-chart" onclick="getInfrastructureStatusLogs('+prop.id+')")"></i></span>'  +'</td>';
                            html +='<td><a href="../modification-infrastructure/verification-sia-level.php?id='+prop.ref_id+'" title="view proposal summary"><i class="fa fa-eye" aria-hidden="true"></i></a></td>';
                        html +='</tr>';
                    });
                    html +='</table>';
                    return html;
                }*/
            },
            {
                "render": function (data, type, row) {
                    var html='';
                    var is_all_approved=1;
                    
                    proposals=row.proposals;
                    proposals.forEach(function(prop){
                        if(prop.current_status==0 || prop.current_status==2)
                        {
                            is_all_approved=0;
                        }
                        
                    });

                    if(is_all_approved==1)
                    {
                        html= '<a href="javascript:void(0)" onclick="send_consolidated('+row.id+')" class="btn btn-primary">Send to next Level</a>';
                        html+= '<a class="btn btn-warning" href="../proposal-verification/consolidated-infrastructure-verification.php?id='+row.id+'" title="view proposal summary">Verify</a>';
                        return html;
                    }else{
                        return '<a class="btn btn-warning" href="../proposal-verification/consolidated-infrastructure-verification.php?id='+row.id+'" title="view proposal summary">Verify</a>';
                    }
                }
            },
            
        
        ]

    });
}
   $('#consolidate_from_date,#consolidate_from_date').on('change', function () {
            ConsolidatedTable.ajax.reload();
        }); 
    $('#block_id,#district_id,#proposal_id,#status').on('change', function () {
        oTable.ajax.reload();
    });
    $('#reset_filter').on('click',function(){
        $('.filter').val('');
        oTable.ajax.reload();
    }); 
 });

$("#consolidate").click(function(){
    var rows= $('#list tbody tr.active');
    var selected_proposal = '';
    /*take all employee id which are selected for promotion batch */
    $("#list").find('tbody tr.active').each(function () {
        selected_proposal += $(this).find('td:eq(2)').text() + ",";
    });
    selected_proposal = selected_proposal.slice(0, -1);
    if(rows.length > 0){
        //$("#employees").val(selected_proposal);
    }else{
        TRIFED.showMessage('error', 'Please select row to consolidate');
        return false;
    }
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
	fetchBlock(v);
});

fetchBlock = (id) => {
	var url = conf.getBlockByDistrict.url(id);
    var method = conf.getBlockByDistrict.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, method , data, function (response, cb) {
        if (response) {
            addressData = response.data;
            console.log(response.data);
            fillBlocks(response.data);
        } else {
            TRIFED.showMessage('error', cb);
        }
    });
}

fillBlocks = (blocks) => {
	html = '<option value="">Select Block</option>';
	$.each(blocks, function(i, block) {
		html += '<option value="'+block.id+'">'+block.title+'</option>';
	});
	$('#block_id').html(html);
}
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
	$('#proposal_id').html(html);
}
check_uncheck_checkbox=(isChecked) =>{
    if(isChecked) {
        $('input[name="proposals[]"]').each(function() { 
            this.checked = true; 
        });
    } else {
        $('input[name="proposals[]"]').each(function() {
            this.checked = false;
        });
    }
}

check_all_consolidate=(isChecked) =>{
    if(isChecked) {
        $('input[name="consolidated_proposals[]"]').each(function() { 
            this.checked = true; 
        });
        
    } else {
        $('input[name="consolidated_proposals[]"]').each(function() {
            this.checked = false;
        });
  
    }
} 

$('#next_level_btn').on('click',function(){
    
    var checked_proposals=[];
    $('.proposals').each(function() { 
        if ($(this).is(':checked')) 
        {
            checked_proposals.push($(this).val());   

        }
    }); 
    if(checked_proposals.length)
    {   
        if(confirm("Do you really want to send to next level?"))
        {        
            var url = conf.send_infrastructure_to_nextlevel.url;
            var method = conf.send_infrastructure_to_nextlevel.method;
            //var data = 'proposal_refids='+checked_proposals;
            var data = $('.proposals:checked').serialize();
            TRIFED.asyncAjaxHitLoader(url, method, data, function (response, cb) {
                
                if(response.status==1)
                {       
                    TRIFED.showMessage('success', 'Successfully assigned to next level');     
                    /*setTimeout(() => {
                            document.location = "infrastructure-development-verification.php";
                        }, 1000);  */
                         setTimeout(() => { 
                            location.reload();
                        }, 1000);           
                }else{
                    TRIFED.showError('error', response.message);
                }
            }); 
        }
    }else{
        alert('Please select proposals');
    }
    
});
$('#consolidate_submit_btn').on('click',function(){
    
    var checked_proposals=[];
    $('.proposals').each(function() { 
        if ($(this).is(':checked')) 
        {
            checked_proposals.push($(this).val());   

        }
    }); 
    if(checked_proposals.length)
    {   
        if(confirm("Do you really want to consolidate & Submit ?"))
        {        
            var url = conf.consolidate_infrastructure.url;
            var method = conf.consolidate_infrastructure.method;
            //var data = 'proposal_refids='+checked_proposals;
            var data = $('.proposals:checked').serialize();
            TRIFED.asyncAjaxHitLoader(url, method, data, function (response, cb) {
                $('#loader-div').html('<i class="fa fa-spinner fa-spin" style="font-size:100px"></i>');
				$('#loader-div').show();
                if(response.status==1)
                {   
					$('#loader-div').html('');
					$('#loader-div').hide();
                    TRIFED.showMessage('success', 'Successfully consolidated & submitted');     
                    setTimeout(() => {
                            //document.location = "infrastructure-development-verification.php";
                              location.reload();
                        }, 1000);           
                }else{
                    TRIFED.showError('error', response.message);
                }
            }); 
        }
    }else{
        alert('Please select proposals');
    }
    
});
$('#consolidate_reference_btn').on('click',function(){
    
    var checked_proposals=[];
    $('.consolidated_proposals').each(function() { 
        if ($(this).is(':checked')) 
        {
            checked_proposals.push($(this).val());   

        }
    }); 
    if(checked_proposals.length > 1)
    {   
        if(confirm("Do you really want to consolidate?"))
        {        
            var url = conf.Infraconsolidate_references.url;
            var method = conf.Infraconsolidate_references.method; 
            var data = $('.consolidated_proposals:checked').serialize();
            TRIFED.asyncAjaxHitLoader(url, method, data, function (response, cb) {
                
                if(response.status==1)
                {       
                    TRIFED.showMessage('success', 'Successfully consolidated');     
                    setTimeout(() => {
                            //document.location = "infrastructure-development-verification.php";
                              location.reload();
                        }, 1000);           
                }else{
                    TRIFED.showError('error', response.message);
                }
            }); 
        }
    }else{
        alert('Please select atleast two proposals for consolidation');
    }
    
});
send_consolidated=(consolidated_id)=>{
    if(consolidated_id && confirm("Are you sure to send this to next level?"))
    {
        var url = conf.sendInfra_consolidated_to_next_level.url;
        var method = conf.sendInfra_consolidated_to_next_level.method; 
        var data = {};
        data.consolidated_id=consolidated_id;
        TRIFED.asyncAjaxHitLoader(url, method, data, function (response, cb) {
            
            if(response.status==1)
            {       
                TRIFED.showMessage('success', 'Successfully Sent');     
                setTimeout(() => {
                        //document.location = "infrastructure-development-verification.php";
                          location.reload();
                    }, 1000);           
            }else{
                TRIFED.showError('error', response.message);
            }
        });
    }
}
function getRecommended()
{
    $('#recommended-list').DataTable().clear().destroy();
    $('#consolidated_recommended_list').DataTable().clear().destroy();
    if(role_id==6)
    {
        $('#recommended-list').show();
        $('#consolidated_recommended_list').hide();
    var rTable = $('#recommended-list').DataTable({
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
                title: 'Infrastructure Recommended List',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6,7,8],   
                    format: {
                     body: function (data, row, column, node ) {
                            
                            if(column === 3 || column === 4|| column === 5)
                            {
                                return strToNumber(data);
                            }else{
                                return column === 1 ? "\u200C" + removeTags(data) : removeTags(data);
                            }
                            
                        }
                    },
                }
            },
        ],
        "ajax": {
            "url": conf.InfrastructureRecommendedListing.url,
            "dataType": "json",
            "type": "GET",
            "headers": {
                "Authorization": 'Bearer ' + auth.token
            },
            "data": function (d, settings) {
                var api = new $.fn.dataTable.Api(settings);

                d.page = api.page() + 1;
                d.block_id = $('#block_id').val();
                d.district_id = $('#district_id').val();
                d.proposal_id = $('#proposal_id').val();
                d.status = $('#status').val();
                d.from_date = $('#recommend_from_date').val();
                d.to_date = $('#recommend_to_date').val();

            },
            "dataSrc": function (json) {
                json.draw = json.data.draw;
                json.recordsTotal = json.data.recordsTotal;
                json.recordsFiltered = json.data.recordsFiltered;
                return json.data.data;

            }
        },
        "fnInitComplete" : function(oSettings, json) {
                $('#count_recommended').html(json.data.recordsTotal);
            },
        "columns": [
            {
                "render": function (data, type, full, meta) {
                    var PageInfo = $('#recommended-list').DataTable().page.info();
                    
                    
                    return  PageInfo.start + 1 + meta.row;;
                }
            },
            {
                "render": function (data, type, row) {
                    //return row.proposal_id;
					return ' <a href="../modification-infrastructure/view-infrastructure.php?id=' + row.ref_id + '&proposal_id='+row.proposal_id+'">'+row.proposal_id+'</a>';
                }
            },
             {
                "render": function (data, type, row) {
                    return row.consolidated_id;
                }
            },
             { 
            	"render": function(data, type, row) {
			      return utils.formatAmount(row.summary[0].estimated_requirement_funds);
			    },
                "className": "text-right"
            }, 
             { 
            	"render": function(data, type, row) {
			       return utils.formatAmount(row.summary[0].total_warehouse_facilities);
			    },
                "className": "text-right"
            },
            { 
                "render": function(data, type, row) {
                   return utils.formatAmount(row.summary[0].old_fund_available);
                },
                "className": "text-right"
            },
             { 
            	"render": function(data, type, row) {
			       return utils.formatAmount(row.total_value);
			    },
                "className": "text-right"
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
                    let html='';
                    var class_name=proposal_status_colour(row.status);
                    html +='<span class="btn '+class_name+'">'+row.status_text+'</span>';
                    html +='<br><span ><i class="fa fa-line-chart" onclick="getInfrastructureStatusLogs('+row.id+')")"></i></span>';
                    return html;


                }
            },
            {
                "orderable": false,
                "render": function (data, type, row) {
                    return row.district

                }
            },
            
        ]
    });
  $('#recommend_search_btn').on('click', function () {
            rTable.ajax.reload();
        }); 
    }
    else
    {
        $('#recommended-list').hide();
        $('#consolidated_recommended_list').show();
          var ConsolidatedRecommendTable = $('#consolidated_recommended_list').DataTable({
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
                    title: 'Infrastructure Recommended List',
                    exportOptions: {
                        columns: [1, 2, 3, 4],
                         format: {
                            body: function (data, row, column, node ) {
                            
                                if(column === 3)
                                {
                                    return strToNumber(data);
                                }else{
                                    return removeTags(data);
                                }
                            
                            }
                        },
                    }
                },
            ],

            "ajax": {
                "url": conf.InfrastructureRecommendedListing.url,
                "dataType": "json",
                "type": "GET",
                "headers": {
                    "Authorization": 'Bearer ' + auth.token
                },
                "data": function (d, settings) {
                    var api = new $.fn.dataTable.Api(settings);

                    d.page = api.page() + 1;
                    d.block_id = $('#block_id').val();
                    d.district_id = $('#district_id').val();
                    d.proposal_id = $('#proposal_id').val();
                    d.status = $('#status').val();                    
                    d.from_date = $('#recommend_from_date').val();
                    d.to_date = $('#recommend_to_date').val();

                },
                "dataSrc": function (json) {
                    json.draw = json.data.draw;
                    json.recordsTotal = json.data.recordsTotal;
                    json.recordsFiltered = json.data.recordsFiltered;
                    return json.data.data;

                }
            },
            "fnInitComplete" : function(oSettings, json) {
                $('#count_recommended').html(json.data.recordsTotal);
            },
            "columns": [
                
                {
                    "render": function (data, type, full, meta) {
                        var PageInfo = $('#consolidated_recommended_list').DataTable().page.info();
                        
                        
                        return  PageInfo.start + 1 + meta.row;;
                    }
                },
                {
                    "render": function (data, type, row) {
                   
                        return '<a href="../project-proposal/view-consolidated-infra-proposals-recommended-list.php?id='+row.id+'" title="view consolidated details">'+ row.reference_number+' ('+row.no_proposal+')</a>';
                    }
                },
                {
                    "render": function (data, type, row) {
                        return row.state_name;
                    }
                },
                {
                    "render": function (data, type, row) {
                        return row.year_name;
                    }
                },
                {
                    "render": function (data, type, row) {
                        return utils.formatAmount(row.total_fund_require);
                    },
                    "className": "text-right"
                },
                {
                    "orderable": false,
                "render": function (data, type, row) {
                    return '<a href="../proposal-verification/viewInfra-consolidated-proposal.php?id='+row.id+'" title="view consolidated details"><i class="fa fa-eye" aria-hidden="true"></i></a>';
                }
                   /* "orderable": false,
                    "render": function (data, type, row) {
                        proposals=row.proposals;
                        html='<table class="table table-striped table-bordered">';
                        html +='<tr>';
                            html +='<td>SR.NO.</td>';
                            html +='<td>Proposal Id</td>';
                            html +='<td>Total Fund of requirment for Haat</td>';
                            html +='<td>Total Fund of requirment for Warehouse</td>';
                            html +='<td>Total Value</td>';
                            html +='<td>Status</td>';
                            html +='<td>Action</td>';
                        html +='</tr>';
                        let sr_no=0;

                        proposals.forEach(function(prop){
                            ++sr_no;
                            html +='<tr>';
                            html +='<td>'+ sr_no +'</td>';
                            html +='<td>'+prop.proposal_id+'</td>';
                            html +='<td>'+prop.summary[0].estimated_requirement_funds;+'</td>';
                            html +='<td>'+prop.summary[0].total_warehouse_facilities;+'</td>'; 
                            html +='<td>'+prop.summary[0].total_fund_require+'</td>';

                            var class_name=proposal_status_colour(prop.current_status);

                            html +='<td><span class="btn '+class_name+'">'+prop.status_text+'</span><br><span ><i class="fa fa-line-chart" onclick="getInfrastructureStatusLogs('+prop.id+')")"></i></span>'  +'</td>';
                            html +='<td><a href="../modification-infrastructure/view-infrastructure.php?id='+prop.ref_id+'" title="view proposal summary"><i class="fa fa-eye" aria-hidden="true"></i></a></td>';
                        html +='</tr>';
                        });
                        html +='</table>';
                        return html;
                    }*/
                },
                
            ]

        });
        $('#recommend_from_date,#recommend_to_date').on('change', function () {
            ConsolidatedRecommendTable.ajax.reload();
        }); 
    }
}
function getRevertedProposals()
{
    $('#reverted-list').DataTable().clear().destroy();
    var revertTable = $('#reverted-list').DataTable({
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
                title: 'Infrastructure Reverted List',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6,7], 
                    format: {
                     body: function (data, row, column, node ) {
                            
                            if(column === 2 || column === 3|| column === 4)
                            {
                                return strToNumber(data);
                            }else{
                                return column === 1 ? "\u200C" + removeTags(data) : removeTags(data);
                            }
                            
                        }
                    },
                }
            },
        ],
        "ajax": {
            "url": conf.InfrastructureRevertedListing.url,
            "dataType": "json",
            "type": "GET",
            "headers": {
                "Authorization": 'Bearer ' + auth.token
            },
            "data": function (d, settings) {
                var api = new $.fn.dataTable.Api(settings);

                d.page = api.page() + 1;
                d.block_id = $('#block_id').val();
                d.district_id = $('#district_id').val();
                d.proposal_id = $('#proposal_id').val();
                d.status = $('#status').val();
                d.from_date = $('#revert_from_date').val();
                d.to_date = $('#revert_to_date').val();

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
                    var PageInfo = $('#recommended-list').DataTable().page.info();
                    
                    
                    return  PageInfo.start + 1 + meta.row;;
                }
            },
            {
                "render": function (data, type, row) {
                    //return row.proposal_id;
					return ' <a href="../modification-infrastructure/view-infrastructure.php?id=' + row.ref_id + '&proposal_id='+row.proposal_id+'">'+row.proposal_id+'</a>';
                }
            },
             { 
            	"render": function(data, type, row) {
			      return utils.formatAmount(row.summary[0].estimated_requirement_funds);
			    },
                "className": "text-right"
            }, 
             { 
            	"render": function(data, type, row) {
			       return utils.formatAmount(row.summary[0].total_warehouse_facilities);
			    },
                "className": "text-right"
            }, 
            { 
                "render": function(data, type, row) {
                   return utils.formatAmount(row.summary[0].old_fund_available);
                },
                "className": "text-right"
            },
             { 
            	"render": function(data, type, row) {
			       return utils.formatAmount(row.summary[0].total_fund_require);
			    },
                "className": "text-right"
            },
            
            {
                "orderable": false,
                "render": function (data, type, row) {
                    
                    let html='';
                    var class_name=proposal_status_colour(row.status);
                    html +='<span class="btn '+class_name+'">'+row.status_text+'</span>';
                    html +='<br><span ><i class="fa fa-line-chart" onclick="getInfrastructureStatusLogs('+row.id+')")"></i></span>';
                    return html;

                    

                }
            },
            {
                "orderable": false,
                "render": function (data, type, row) {
                    return row.state

                }
            },
            {
                "orderable": false,
                "render": function (data, type, row) {
                    return row.district

                }
            },
            
        ]
    });
$('#revert_search_btn').on('click', function () {
            revertTable.ajax.reload();
        });
}

function removeTags(str) {
      if ((str===null) || (str===''))
      return false;
      else
      str = str.toString();
      return str.replace( /(<([^>]+)>)/ig, '');
   }


function getTabTotalCounts()
{
    var url = conf.getInfrastructureCountsStatusWise.url;
    var method = conf.getInfrastructureCountsStatusWise.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, method , data, function (response, cb) {
        if (response) {
            response=response.data;
            
            $('#count_pending').html(response.pending);
            $('#count_consolidated').html(response.consolidated);
            $('#count_recommended').html(response.recommended);
            $('#count_reverted').html(response.reverted);
            $('#count_rejected').html(response.rejected);            
            $('#count_approved').html(response.approved);
            
        } else {
            TRIFED.showMessage('error', cb);
        }
    });
}

 
function getApprovedProposals()
{
    $('#approved_list').DataTable().clear().destroy();
    
    var approved_listTable = $('#approved_list').DataTable({
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
                title: 'Infrastructure Approved List',
                exportOptions: {
                    columns: [0,1, 2, 3, 4,5,6,7]
                }
            },
        ],

        "ajax": {
            "url": conf.infrastructureApprovedListing.url,
            "dataType": "json",
            "type": "GET",
            "headers": {
                "Authorization": 'Bearer ' + auth.token
            },
            "data": function (d, settings) {
                var api = new $.fn.dataTable.Api(settings);

                d.page = api.page() + 1;
                d.block_id = $('#block_id').val();
                d.district_id = $('#district_id').val();
                d.proposal_id = $('#proposal_id').val();
                d.status = $('#status').val();
                d.from_date = $('#approved_from_date').val();
                d.to_date = $('#approved_to_date').val();
            },
            "dataSrc": function (json) {
                json.draw = json.data.draw;
                json.recordsTotal = json.data.recordsTotal;
                json.recordsFiltered = json.data.recordsFiltered;
                return json.data.data;

            }
        },
        "fnInitComplete" : function(oSettings, json) {
            $('#count_approved').html(json.data.recordsTotal);
          
          
        },
         "columns": [
                
                {
                    "render": function (data, type, full, meta) {
                        var PageInfo = $('#approved_list').DataTable().page.info();
                        
                        
                        return  PageInfo.start + 1 + meta.row;;
                    }
                },
                {
                    "render": function (data, type, row) {
                   
                        return '<a href="../project-proposal/view-consolidated-infra-proposals-recommended-list.php?id='+row.id+'" title="view consolidated details">'+ row.reference_number+' ('+row.no_proposal+')</a>';
                    }
                },
                {
                    "render": function (data, type, row) {
                        return row.state_name;
                    }
                },
                {
                    "render": function (data, type, row) {
                        return row.year_name;
                    }
                },
                {
                    "render": function (data, type, row) {
                        return utils.formatAmount(row.total_fund_require);
                    },
                    "className": "text-right"
                },
                {
                    "orderable": false,
                "render": function (data, type, row) {
                    return '<a href="../proposal-verification/viewInfra-consolidated-proposal.php?id='+row.id+'" title="view consolidated details"><i class="fa fa-eye" aria-hidden="true"></i></a>';
                }
                   /* "orderable": false,
                    "render": function (data, type, row) {
                        proposals=row.proposals;
                        html='<table class="table table-striped table-bordered">';
                        html +='<tr>';
                            html +='<td>SR.NO.</td>';
                            html +='<td>Proposal Id</td>';
                            html +='<td>Total Fund of requirment for Haat</td>';
                            html +='<td>Total Fund of requirment for Warehouse</td>';
                            html +='<td>Total Value</td>';
                            html +='<td>Status</td>';
                            html +='<td>Action</td>';
                        html +='</tr>';
                        let sr_no=0;

                        proposals.forEach(function(prop){
                            ++sr_no;
                            html +='<tr>';
                            html +='<td>'+ sr_no +'</td>';
                            html +='<td>'+prop.proposal_id+'</td>';
                            html +='<td>'+prop.summary[0].estimated_requirement_funds;+'</td>';
                            html +='<td>'+prop.summary[0].total_warehouse_facilities;+'</td>'; 
                            html +='<td>'+prop.summary[0].total_fund_require+'</td>';

                            var class_name=proposal_status_colour(prop.current_status);

                            html +='<td><span class="btn '+class_name+'">'+prop.status_text+'</span><br><span ><i class="fa fa-line-chart" onclick="getInfrastructureStatusLogs('+prop.id+')")"></i></span>'  +'</td>';
                            html +='<td><a href="../modification-infrastructure/view-infrastructure.php?id='+prop.ref_id+'" title="view proposal summary"><i class="fa fa-eye" aria-hidden="true"></i></a></td>';
                        html +='</tr>';
                        });
                        html +='</table>';
                        return html;
                    }*/
                },
                
            ]

    });
    $('#approved_from_date,#approved_to_date').on('change', function () {
        approved_listTable.ajax.reload();
    });
    $('#approved_search_btn').on('click', function () {
        approved_listTable.ajax.reload();
    }); 
    
}

function getRejectedProposals()
{
    $('#rejected-list').DataTable().clear().destroy();
    var rejectedTable = $('#rejected-list').DataTable({
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
                title: 'Infrastructure Rejected List',
                exportOptions: {
                    columns: [0,1, 2, 3, 4,5,6,7],                       
                    format: {
                     body: function (data, row, column, node ) {
                            
                            if(column === 2 || column === 3|| column === 4)
                            {
                                return strToNumber(data);
                            }else{
                                return column === 1 ? "\u200C" + removeTags(data) : removeTags(data);
                            }
                            
                        }
                    },
                }
            },
        ],
        "ajax": {
            "url": conf.InfrastructureRejectedListing.url,
            "dataType": "json",
            "type": "GET",
            "headers": {
                "Authorization": 'Bearer ' + auth.token
            },
            "data": function (d, settings) {
                var api = new $.fn.dataTable.Api(settings);

                d.page = api.page() + 1;
                d.block_id = $('#block_id').val();
                d.district_id = $('#district_id').val();
                d.proposal_id = $('#proposal_id').val();
                d.status = $('#status').val();
                d.from_date = $('#rejected_from_date').val();
                d.to_date = $('#rejected_to_date').val();
            },
            "dataSrc": function (json) {
                json.draw = json.data.draw;
                json.recordsTotal = json.data.recordsTotal;
                json.recordsFiltered = json.data.recordsFiltered;
                return json.data.data;

            }
        },
        "fnInitComplete" : function(oSettings, json) {
            $('#count_rejected').html(json.data.recordsTotal);
        },
        "columns": [
          {
                "render": function (data, type, full, meta) {
                    var PageInfo = $('#recommended-list').DataTable().page.info();
                    
                    
                    return  PageInfo.start + 1 + meta.row;;
                }
            },
            {
                "render": function (data, type, row) {
                    //return row.proposal_id;
                    return ' <a href="../modification-infrastructure/view-infrastructure.php?id=' + row.ref_id + '&proposal_id='+row.proposal_id+'">'+row.proposal_id+'</a>';
                }
            },
             { 
                "render": function(data, type, row) {
                  return utils.formatAmount(row.summary[0].estimated_requirement_funds);
                },
                "className": "text-right"
            }, 
             { 
                "render": function(data, type, row) {
                   return utils.formatAmount(row.summary[0].total_warehouse_facilities);
                },
                "className": "text-right"
            },
            { 
                "render": function(data, type, row) {
                   return utils.formatAmount(row.summary[0].old_fund_available);
                },
                "className": "text-right"
            },
             { 
                "render": function(data, type, row) {
                   return utils.formatAmount(row.summary[0].total_fund_require);
                },
                "className": "text-right"
            },
            
            {
                "orderable": false,
                "render": function (data, type, row) {
                    
                    let html='';
                    var class_name=proposal_status_colour(row.status);
                    html +='<span class="btn '+class_name+'">'+row.status_text+'</span>';
                    html +='<br><span ><i class="fa fa-line-chart" onclick="getInfrastructureStatusLogs('+row.id+')")"></i></span>';
                    return html;

                    

                }
            },
            {
                "orderable": false,
                "render": function (data, type, row) {
                    return row.state

                }
            },
            {
                "orderable": false,
                "render": function (data, type, row) {
                    return row.district

                }
            },
            
        ]
    });
    $('#reject_search_btn').on('click', function () {
            rejectedTable.ajax.reload();
        });
}