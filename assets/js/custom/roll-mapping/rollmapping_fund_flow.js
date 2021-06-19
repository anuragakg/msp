$(function () {
	// TRIFED.checkToken();
    fetchMappingList();
	//editRollmapping();	
});
var editFundFlowLevel = TRIFED.checkPermissions("fund_flow_level_mapping_edit");

fetchMappingList = () => {
	var url = conf.getRollMappingFundFlowList.url;
    var method = conf.getRollMappingFundFlowList.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, 'GET', data, function (response, cb) {
        if (response) {
            addressData = response.data;
            //console.log(addressData)
            //return false;
            fillMappingList(response.data);
        } else {
            TRIFED.showMessage('error', cb);
        }
    });
}

fillMappingList = (data) => {
	var html = "";
	var count=0;

	$.each(data, function(k, subdata){ 
		++count;
		//console.log(subdata[0]['state'])
		html +='<tr >'+
		'<td>'+count+'</td>'+
		'<td>'+k+'</td>'+
		'<td>'+get_state_level_roles(subdata)+'</td>';
		if(editFundFlowLevel){
			html += '<td ><a href="role-mapping-fund-flow.php?state_id='+subdata[0]['state_id']+'" class="data-edit" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fa fa-edit"></i></a></td>';
		}
		html +='</tr>';
		
	});
	
	$('#mapping-table tbody').html(html);
}



function get_state_level_roles(data)
{

	//console.log(data)
	var td_data='';
	$.each(data, function(k, v) {
	    //display the key and value pair
	    
	    td_data +=' <div class="col-md-6">'+
                                  '<div class="col-md-12"><b class="b-dark">'+v.level+'</b> <span>'+v.role_name+'</span></div>'
                                +'</div>';
	    //options +='<option value="'+v+'">'+v+'</option>';
	});
	return td_data;
}