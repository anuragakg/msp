var auth = TRIFED.getLocalStorageItem();
var tab = TRIFED.getUrlParameters().tab;

role_id=auth.role;
var editProposal = TRIFED.checkPermissions("mfp_procurement_plan_edit");
var viewProposal = TRIFED.checkPermissions("mfp_procurement_plan_view");
var addProposal = TRIFED.checkPermissions("mfp_procurement_plan_add");
var statusProposal = TRIFED.checkPermissions("mfp_procurement_plan_status");
var viewMfpDetails = TRIFED.checkPermissions("mfp_details_view");
var addMfpDetails = TRIFED.checkPermissions("mfp_details_add");
var approval_management_consolidate_proposals = TRIFED.checkPermissions("approval_management_consolidate_proposals");
var district_id=auth.district_id;
var blankdata=0;
var consolidated_reference_proposals=[];
$(document).ready(function () {
    $('.from_date').datepicker({
        todayBtn: "linked",
        format: 'dd/mm/yyyy',
        endDate: new Date()
    }).on('changeDate', function (selected) {
        var minDate = new Date(selected.date.valueOf());
        $('.to_date').datepicker('setStartDate', minDate);
    });
    $('.to_date').datepicker({
        todayBtn: "linked",
        format: 'dd/mm/yyyy',
        endDate: new Date()
    });

    $('#pending_from_date').datepicker({
        todayBtn: "linked",
        format: 'dd/mm/yyyy',
        endDate: new Date()
    }).on('changeDate', function (selected) {
        var minDate = new Date(selected.date.valueOf());
        $('#pending_to_date').datepicker('setStartDate', minDate);
    });
    $('#pending_to_date').datepicker({
        todayBtn: "linked",
        format: 'dd/mm/yyyy',
        endDate: new Date()
    });
    
    $('#recommend_from_date').datepicker({
        todayBtn: "linked",
        format: 'dd/mm/yyyy',
        endDate: new Date()
    }).on('changeDate', function (selected) {
        var minDate = new Date(selected.date.valueOf());
        $('#recommend_to_date').datepicker('setStartDate', minDate);
    });
    $('#recommend_to_date').datepicker({
        todayBtn: "linked",
        format: 'dd/mm/yyyy',
        endDate: new Date()
    });


    $('#revert_from_date').datepicker({
        todayBtn: "linked",
        format: 'dd/mm/yyyy',
        endDate: new Date()
    }).on('changeDate', function (selected) {
        var minDate = new Date(selected.date.valueOf());
        $('#revert_to_date').datepicker('setStartDate', minDate);
    });
    $('#revert_to_date').datepicker({
        todayBtn: "linked",
        format: 'dd/mm/yyyy',
        endDate: new Date()
    });


    $('#rejected_from_date').datepicker({
        todayBtn: "linked",
        format: 'dd/mm/yyyy',
        endDate: new Date()
    }).on('changeDate', function (selected) {
        var minDate = new Date(selected.date.valueOf());
        $('#rejected_to_date').datepicker('setStartDate', minDate);
    });
    $('#rejected_to_date').datepicker({
        todayBtn: "linked",
        format: 'dd/mm/yyyy',
        endDate: new Date()
    });



    $('#approved_from_date').datepicker({
        todayBtn: "linked",
        format: 'dd/mm/yyyy',
        endDate: new Date()
    }).on('changeDate', function (selected) {
        var minDate = new Date(selected.date.valueOf());
        $('#approved_to_date').datepicker('setStartDate', minDate);
    });
    $('#approved_to_date').datepicker({
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
        //$('#recommended_tab_title').html("Approved Proposals ");
    }
    if(tab!=undefined)
    {
        $('.nav-tabs a[href="#tab'+tab+'"]').tab('show');  

        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
           $($.fn.dataTable.tables(true)).DataTable()
              .columns.adjust();
        });
        //$('.tab'+tab).trigger('click');
        //updateUrlParameter('tab',tab);
    }
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
    //
    //fetchProposalIds();
    // submitted_user_id = auth.user;
    // console.log(submitted_user_id);
    fetchDistrict(district_id);
    
    
    

    $('#pending_search_btn').on('click', function () {
            oTable.ajax.reload();
        });  
    $('.dataTables_filter input').attr("placeholder", "Serach by Proposal Id");

    
    

    
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
    //getRevertedProposals();
    //getRecommended();
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
            var ref_id=$(this).val();
            if ( $.inArray(ref_id, consolidate_checked_proposals) == -1)
            {
                consolidate_checked_proposals.push(ref_id);    
            }
            
        });
    } else {
        $('input[name="proposals[]"]').each(function() {
            this.checked = false;
            var ref_id=$(this).val();
            const index = consolidate_checked_proposals.indexOf(ref_id);
            if (index > -1) {
              consolidate_checked_proposals.splice(index, 1);
            }
        });
    }
    //console.log(consolidate_checked_proposals)
}
/*
$(document).on('change','.proposals',function() {
    
    if(this.checked) {
       if(approval_management_consolidate_proposals)
        {
            $('#consolidate_submit').show();
            $('#send_next_level').hide();
        }else{
            $('#send_next_level').show();
            $('#consolidate_submit').hide();
        }
    }else{
        $('#send_next_level').hide();
        $('#consolidate_submit').hide();
    }
});*/
check_all_consolidate=(isChecked) =>{
    if(isChecked) {
        $('input[name="consolidated_proposals[]"]').each(function() { 
            this.checked = true; 
            var consolidated_id=parseInt($(this).val());
            if ( $.inArray(consolidated_id, consolidated_reference_proposals) == -1)
            {
                consolidated_reference_proposals.push(consolidated_id);    
            }
        });
        
    } else {
        $('input[name="consolidated_proposals[]"]').each(function() {
            this.checked = false;
            var consolidated_id=parseInt($(this).val());
            const index = consolidated_reference_proposals.indexOf(consolidated_id);
            if (index > -1) {
              consolidated_reference_proposals.splice(index, 1);
            }
        });
  
    }
}
/*$(document).on('change','.consolidated_proposals',function() {
    
    if(this.checked) {
       if(approval_management_consolidate_proposals)
        {
            $('#consolidate_reference').show();
            
        }else{
            $('#consolidate_reference').hide();
        }
    }else{
        $('#consolidate_reference').hide();
        
    }
});*/

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
        if(confirm("Are you sure,you want to send to next level?"))
        {        
            var url = conf.send_mfpprocurement_to_nextlevel.url;
            var method = conf.send_mfpprocurement_to_nextlevel.method;
            //var data = 'proposal_refids='+checked_proposals;
            var data = $('.proposals:checked').serialize();
            TRIFED.asyncAjaxHitLoader(url, method, data, function (response, cb) {
                
                if(response.status==1)
                {       
                    TRIFED.showMessage('success', 'Successfully assigned to next level');     
                    setTimeout(() => {
                            //document.location = "mfp-procurement-verification.php";
                            //history.go(-1)
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

var consolidate_checked_proposals=[];

$(document).on('change','.proposals',function(){
    var ref_id=$(this).val();
    if($(this).is(':checked'))
    {
        consolidate_checked_proposals.push(ref_id);   
    }else{
        const index = consolidate_checked_proposals.indexOf(ref_id);
        if (index > -1) {
          consolidate_checked_proposals.splice(index, 1);
        }
       
    }
    //console.log(consolidate_checked_proposals)
});

$('#consolidate_submit_btn').on('click',function(){
    if(consolidate_checked_proposals.length)
    {   
        var total_proposals=consolidate_checked_proposals.length
        if(confirm("You have selected "+total_proposals+" proposals.Do you really want to consolidate & submit?"))
        {        
            var url = conf.consolidate_mfpprocurement.url;
            var method = conf.consolidate_mfpprocurement.method;
            
            var proposals=[];
           
            consolidate_checked_proposals.forEach(function(row){
              proposals.push(row);
            });
            data={proposals};
            
            TRIFED.asyncAjaxHitLoader(url, method, data, function (response, cb) {
                
                if(response.status==1)
                {       
                    TRIFED.showMessage('success', 'Successfully consolidated & submitted');     
                    setTimeout(() => {
                            //document.location = "mfp-procurement-verification.php";
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
/*$('#consolidate_submit_btn').on('click',function(){
    
    var checked_proposals=[];
    $('.proposals').each(function() { 
        if ($(this).is(':checked')) 
        {
            checked_proposals.push($(this).val());   

        }
    }); 
    if(checked_proposals.length)
    {   
        if(confirm("Do you really want to consolidate & submit?"))
        {        
            var url = conf.consolidate_mfpprocurement.url;
            var method = conf.consolidate_mfpprocurement.method;
            //var data = 'proposal_refids='+checked_proposals;
            var data = $('.proposals:checked').serialize();
            TRIFED.asyncAjaxHitLoader(url, method, data, function (response, cb) {
                
                if(response.status==1)
                {       
                    TRIFED.showMessage('success', 'Successfully consolidated & submitted');     
                    setTimeout(() => {
                            //document.location = "mfp-procurement-verification.php";
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
    
});*/

$(document).on('change','.consolidated_proposals',function(){
    var consolidated_id=parseInt($(this).val());
    if($(this).is(':checked'))
    {
        consolidated_reference_proposals.push(consolidated_id);   
    }else{
        const index = consolidated_reference_proposals.indexOf(consolidated_id);
        if (index > -1) {
          consolidated_reference_proposals.splice(index, 1);
        }
       
    }
    //console.log(consolidate_checked_proposals)
});
$('#consolidate_reference_btn').on('click',function(){
    
    /*var checked_proposals=[];
    $('.consolidated_proposals').each(function() { 
        if ($(this).is(':checked')) 
        {
            checked_proposals.push($(this).val());   

        }
    }); */
    if(consolidated_reference_proposals.length > 1)
    {   
        var total_proposals=consolidated_reference_proposals.length
        if(confirm("You have selected "+total_proposals+" records.Do you really want to consolidate ?"))
        {        
            var url = conf.consolidate_references.url;
            var method = conf.consolidate_references.method;
            //var data = 'proposal_refids='+checked_proposals;
            //var data = $('.consolidated_proposals:checked').serialize();

            var consolidated_proposals=[];
           
            consolidated_reference_proposals.forEach(function(row){
              consolidated_proposals.push(row);
            });
            data={consolidated_proposals};


            TRIFED.asyncAjaxHitLoader(url, method, data, function (response, cb) {
                
                if(response.status==1)
                {       
                    TRIFED.showMessage('success', 'Successfully Consolidated');     
                    setTimeout(() => {
                            //document.location = "mfp-procurement-verification.php";
                            //history.go(-1)
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
        var url = conf.send_consolidated_to_next_level.url;
        var method = conf.send_consolidated_to_next_level.method;
        //var data = 'proposal_refids='+checked_proposals;
        var data = {};
        data.consolidated_id=consolidated_id;
        TRIFED.asyncAjaxHitLoader(url, method, data, function (response, cb) {
            
            if(response.status==1)
            {       
                TRIFED.showMessage  ('success', 'Successfully Sent');     
                setTimeout(() => {
                        //history.go(-1)
                        location.reload();
                    }, 1000);           
            }else{
                TRIFED.showError('error', response.message);
            }
        });
    }
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
    var url = conf.getProcurementCountsStatusWise.url;
    var method = conf.getProcurementCountsStatusWise.method;
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
function getPendingProposals()
{
    $('#list').DataTable().clear().destroy();
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
                title: 'MFP Procurement Pending List',
                exportOptions: {
                    columns: [1, 2, 3, 4, 5, 6, 7,8,9],                  
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
            //if(auth.role==6 ||auth.role==2||auth.role==3 )
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
                        var proposal_checked='checked';    
                        if ( $.inArray(row.ref_id, consolidate_checked_proposals) == -1)
                        {
                            proposal_checked='';    
                        }                       
                        return '<label class="pos-rel"><input '+proposal_checked+' type="checkbox" value="'+row.ref_id+'" class="proposals" name="proposals[]"  /><span class="lbl"> </span></label>';      
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
                    return '<a href="../project-proposal/view-mfp-procurement.php?id='+row.ref_id+'&proposal_id='+row.proposal_id+'">'+row.proposal_id+'</a>';
                }
            },
            {
                "orderable": false,
                "render": function (data, type, row) {
                    return row.mfps;
                },
                    "className": "text-right"
            },

            {
                "orderable": false,
                "render": function (data, type, row) {
                    return row.quantity.toFixed(4)

                },
                    "className": "text-right"
            },
            {
                "orderable": false,
                "render": function (data, type, row) {
                    return utils.formatAmount(row.value)

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
                    return row.submitted_by

                }
            },
			{
				"orderable": false,
				"visible":auth.role==2?'true':false,
				"render": function (data, type, row) {
					if (viewMfpDetails) {
					return '<a href="../proposal-verification/last_five_years_mfp_details_by_proposal.php?id='+row.ref_id+'" title="View MFP Details">View</a>';
					}else{
						return 'NA';
					}

				}
            },
            {
                "orderable": false,
                "render": function (data, type, row) {
                    let html='';
                    var class_name=proposal_status_colour(row.current_status);
                    html +='<span class="btn '+class_name+'">'+row.current_status_text+'</span>';
                    html +='<br><span ><i class="fa fa-line-chart" onclick="getMfpProcurementStatusLogs('+row.id+')")"></i></span>';
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
                    //if (viewProposal) {
                        html += ' <a href="../proposal-verification/verification-details.php?id=' + row.ref_id + '" class="data-edit"><i class="fa fa-eye" title="View Detail"></i></a>';
                    //}
                    return html;
                }
            },
        
        ]

    });
}
function getConsolidatedProposals()
{
    $('#consolidated_list').DataTable().clear().destroy();
    var ConsolidatedTable = $('#consolidated_list').DataTable({
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
                title: 'MFP Procurement Consolidated List',
                exportOptions: {
                    columns: [1, 2, 3, 4, 5, 6,7,8,9]
                }
            },
        ],

        "ajax": {
            "url": conf.getConsolidatedProposals.url,
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
            /*if(approval_management_consolidate_proposals)
            {
                $('#consolidate_reference').show();
            
            }else{
            
                $('#consolidate_reference').hide();
            }*/
          
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
                    var consolidated_checked_proposal='checked'; 
                    if ( $.inArray(row.id, consolidated_reference_proposals) == -1)
                    {
                        consolidated_checked_proposal='';    
                    }
                    /*if(is_all_approved==1)
                    {*/
                       return '<label class="pos-rel"><input type="checkbox" '+consolidated_checked_proposal+'  value="'+row.id+'" class="consolidated_proposals" name="consolidated_proposals[]"  /><span class="lbl"> </span></label>';                               
                    /*}else{
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
               
                    return '<a href="../project-proposal/view-consolidated-proposals-list.php?id='+row.id+'" title="view Proposals">'+ row.reference_number+' ('+row.no_proposal+')</a>';
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
                        return row.mfps;
                },
                    "className": "text-right"
            },
            {
                "render": function (data, type, row) {
                    return row.quantity.toFixed(4);
                },
                    "className": "text-right"
            },
            {
                "render": function (data, type, row) {
                    return utils.formatAmount(row.value);
                },
                "className": "text-right"
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
                    return '<a href="../project-proposal/view-consolidated-proposal.php?id='+row.id+'" title="view consolidated details"><i class="fa fa-eye" aria-hidden="true"></i> </a>';
                }
                
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
                        //html+= '<a href="../project-proposal/view-consolidated-proposal.php?id='+row.id+'" title="View consolidated summary" class="btn btn-primary">View</a>';
                        //return html;
                    }
                    else{
                        html += '<a class="btn btn-warning" href="../proposal-verification/consolidated-proposal-verification.php?id='+row.id+'" title="view proposal summary">Verify</a>';
                    }
                    return html;
                }
            },
            
        
        ]

    });
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
                title: 'MFP Reverted List',
                exportOptions: {
                    columns: [0,1, 2, 3, 4,5,6,7],                  
                    format: {
                     body: function (data, row, column, node ) {
                            return column === 1 ? "\u200C" + removeTags(data) : removeTags(data);
                        }
                    },
                }
            },
        ],
        "ajax": {
            "url": conf.mfpProcurementRevertedListing.url,
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
        "fnInitComplete" : function(oSettings, json) {
            $('#count_reverted').html(json.data.recordsTotal);
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
                    return row.proposal_id;
                }
            },
            {
                "orderable": false,
                "render": function (data, type, row) {
                    return row.mfps;
                },
                    "className": "text-right"
            },

            {
                "orderable": false,
                "render": function (data, type, row) {
                    return row.quantity.toFixed(4)

                },
                    "className": "text-right"
            },
            {
                "orderable": false,
                "render": function (data, type, row) {
                    return utils.formatAmount(row.value)

                },
                "className": "text-right"
            },
            
            {
                "orderable": false,
                "render": function (data, type, row) {
                    
                    let html='';
                    var class_name=proposal_status_colour(row.status);
                    html +='<span class="btn '+class_name+'">'+row.status_text+'</span>';
                    html +='<br><span ><i class="fa fa-line-chart" onclick="getMfpProcurementStatusLogs('+row.id+')")"></i></span>';
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
            {
                "orderable": false,
                "render": function (data, type, row) {
                    return '<a title="view proposal detail" href="../project-proposal/view-mfp-procurement.php?id='+row.ref_id+'&proposal_id='+row.proposal_id+'"><i class="fa fa-eye" aria-hidden="true"></i></a> </a>'

                }
            },
            
        ]
    });
    $('#revert_search_btn').on('click', function () {
            revertTable.ajax.reload();
        });
}

function getRecommended()
{
    $('#recommended-list').DataTable().clear().destroy();
    $('#consolidated_recommended_list').DataTable().clear().destroy();
    // If DIA or SIA
    if(role_id==6 || role_id==4 || role_id==2 )
    {
        $('#recommended-list').show();
        $('#consolidated_recommended_list').hide();
        
        $('#_recommended_list').hide();
        var recommendTable = $('#recommended-list').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [[0, "DESC"]],
            "dom": 'lBfrtip',
            "scrollX": true,
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
                        columns: [0,1, 2, 3, 4, 5, 6, 7,8,9,10,11,12,13],                  
                    format: {
                     body: function (data, row, column, node ) {
                            return column === 1 ? "\u200C" + removeTags(data) : removeTags(data);
                        }
                    },
                    }
                },
            ],
            "ajax": {
                "url": conf.mfpProcurementRecommendedListing.url,
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
                        return '<a href="../project-proposal/view-mfp-procurement.php?id='+row.ref_id+'&proposal_id='+row.proposal_id+'">'+row.proposal_id+'</a>';
                    }
                },
                {
                    "render": function (data, type, row) {
                        return row.consolidated_id;
                    }
                },
                {
                    "orderable": false,
                    "render": function (data, type, row) {
                        return '<a href="../proposal-verification/mfp-list.php?id='+row.ref_id+'" title="View MFP List">'+row.mfps+'</a>';
                        
                    }
                },

                {
                    "orderable": false,
                    "render": function (data, type, row) {
                        
                        return row.quantity.toFixed(4)

                    },
                    "className": "text-right"
                },
                {
                    "orderable": false,
                    "render": function (data, type, row) {
                        return utils.formatAmount(row.value)

                    },
                    "className": "text-right"
                },
                {
                    "orderable": false,
                    "render": function (data, type, row) {
                        return utils.formatAmount(row.total_value)

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
                        return row.submitted_by

                    }
                },
                {
                    "orderable": false,
                    "render": function (data, type, row) {
                        let html='';
                        var class_name=proposal_status_colour(row.status);
                        html +='<span class="btn '+class_name+'">'+row.status_text+'</span>';
                        html +='<br><span ><i class="fa fa-line-chart" onclick="getMfpProcurementStatusLogs('+row.id+')")"></i></span>';
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
                        return '<a href="../project-proposal/view-mfp-procurement.php?id='+row.ref_id+'&proposal_id='+row.proposal_id+'" title="View MFP List">View</a>';

                    }
                },
                {
                    "orderable": false,
                    "render": function (data, type, row) {
                        if (viewMfpDetails) {
                        return '<a href="../proposal-verification/last_five_years_mfp_details_by_proposal.php?id='+row.ref_id+'" title="View MFP Details">View</a>';
                        }else{
                            return 'NA';
                        }

                    }
                },
                {
                    "orderable": false,
                    "render": function (data, type, row) {
                       return '-';

                    }
                },
                {
                    "orderable": false,
                    "render": function (data, type, row) {
                       return '-';

                    }
                },
                
            ]
        });  
        $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
        //recommendTable.columns.adjust().draw();
        $('#recommend_search_btn').on('click', function () {
            recommendTable.ajax.reload();
        });  
    }
    else{
        $('#recommended-list').hide();
        $('#consolidated_recommended_list').show();
        $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
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
                    title: 'MFP Procurement Recommended List',
                    exportOptions: {
                        columns: [0,1, 2, 3, 4,5,6,7]
                    }
                },
            ],

            "ajax": {
                "url": conf.mfpProcurementRecommendedListing.url,
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
                   
                        return '<a href="../project-proposal/view-consolidated-proposals-recommended-list.php?id='+row.id+'" title="view consolidated details">'+ row.reference_number+' ('+row.no_proposal+')</a>';
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
                        return row.mfps;
                    },
                    "className": "text-right"
                },
                {
                    "render": function (data, type, row) {
                        return row.quantity.toFixed(4);
                    },
                    "className": "text-right"
                },
                {
                    "render": function (data, type, row) {
                        return utils.formatAmount(row.value);
                    },
                    "className": "text-right"
                },
                {
                    "render": function (data, type, row) {
                        return utils.formatAmount(row.total_fund_require);
                    },
                    "className": "text-right"
                },
                {
                    "render": function (data, type, row) {
                    return '<a href="../project-proposal/view-consolidated-proposal.php?id='+row.id+'" title="view consolidated details"><i class="fa fa-eye" aria-hidden="true"></i> </a>';
                }
                   
                },
                
            ]

        });
        //ConsolidatedRecommendTable.columns.adjust().draw();
        $('#recommend_from_date,#recommend_to_date').on('change', function () {
            ConsolidatedRecommendTable.ajax.reload();
        }); 
    }
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
            //sProcessing: "<div class='listing-loader'></div>"
            sProcessing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
        },
        "buttons": [
            {
                extend: 'excel',
                text: '<i class="fa fa-file-excel-o"></i> Export to Excel',
                titleAttr: 'EXCEL',
                title: 'MFP Procurement Approved List',
                exportOptions: {
                    columns: [0,1, 2, 3, 4,5,6,7]
                }
            },
        ],

        "ajax": {
            "url": conf.mfpProcurementApprovedListing.url,
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
               
                    return '<a href="../project-proposal/view-consolidated-proposals-recommended-list.php?id='+row.id+'" title="view consolidated details">'+ row.reference_number+' ('+row.no_proposal+')</a>';
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
                    return row.mfps;
                },
                "className": "text-right"
            },
            {
                "render": function (data, type, row) {
                    return row.quantity.toFixed(4);
                },
                "className": "text-right"
            },
            {
                "render": function (data, type, row) {
                    return utils.formatAmount(row.value);
                },
                "className": "text-right"
            },
            {
                "render": function (data, type, row) {
                    return utils.formatAmount(row.total_fund_require);
                },
                "className": "text-right"
            },
            {
                "render": function (data, type, row) {
                return '<a href="../project-proposal/view-consolidated-proposal.php?id='+row.id+'" title="view consolidated details"><i class="fa fa-eye" aria-hidden="true"></i> </a>';
            }
               
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
                title: 'MFP Rejected List',
                exportOptions: {
                    columns: [0,1, 2, 3, 4,5,6,7],                  
                    format: {
                     body: function (data, row, column, node ) {
                            return column === 1 ? "\u200C" + removeTags(data) : removeTags(data);
                        }
                    },
                }
            },
        ],
        "ajax": {
            "url": conf.mfpProcurementRejectedListing.url,
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
                    var PageInfo = $('#rejected-list').DataTable().page.info();
                    
                    
                    return  PageInfo.start + 1 + meta.row;;
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
                },
                    "className": "text-right"
            },

            {
                "orderable": false,
                "render": function (data, type, row) {
                    return row.quantity.toFixed(4)

                },
                    "className": "text-right"
            },
            {
                "orderable": false,
                "render": function (data, type, row) {
                    return utils.formatAmount(row.value)

                },
                "className": "text-right"
            },
            
            {
                "orderable": false,
                "render": function (data, type, row) {
                    
                    let html='';
                    var class_name=proposal_status_colour(row.status);
                    html +='<span class="btn '+class_name+'">'+row.status_text+'</span>';
                    html +='<br><span ><i class="fa fa-line-chart" onclick="getMfpProcurementStatusLogs('+row.id+')")"></i></span>';
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
            {
                "orderable": false,
                "render": function (data, type, row) {
                    return '<a title="view proposal detail" href="../project-proposal/view-mfp-procurement.php?id='+row.ref_id+'&proposal_id='+row.proposal_id+'"><i class="fa fa-eye" aria-hidden="true"></i></a> </a>'

                }
            },
            
        ]
    });
    $('#reject_search_btn').on('click', function () {
            revertTable.ajax.reload();
        });
}