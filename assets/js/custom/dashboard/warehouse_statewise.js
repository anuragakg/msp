$(function () {
    fetchStateList();
});

fetchStateList = () => {
	var url_var=getUrlVars(); 
	state=url_var['state'];
	district=url_var['district'];
	block=url_var['block'];
	status=url_var['status'];
	mobile=url_var['is_mobile'];
	 if(status==1)
	 {
	 	$('#warehouse_status').html('Approved');
	 	$('#warehouse_count_head').html('warehouse Approved');
	 }else
	 {
	 	$('#warehouse_status').html('Pending');
	 	$('#warehouse_count_head').html('warehouse pending for approval');
	 }
	 $("#status").val(status);
	 $("#state").val(state);
	var url = conf.warehouse_statewise.url;
    var method = conf.warehouse_statewise.method;
    var data = {
	    state : state,
	    district : district,
	    block : block,
	    status : status,
	    is_mobile : mobile
	};
    TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
        if (response) {
        	if(response.data != ''){
        	fillStateList(response.data);
        }else
        {
        	return $("#state-table tbody").html(
        "<tr><td colspan='11' class='text-center'>No Data Found !!</td></tr>");
        }

        } else {        	
            TRIFED.showMessage('error', cb);
        }


    });
}

fillStateList = (data) => {
	var html = "";
	var sr_no=0;
	var url_var=getUrlVars(); 
	state=url_var['state'];
	district=url_var['district'];
	block=url_var['block'];
	status=url_var['status'];
	mobile=url_var['is_mobile'];
	if(mobile!=null && mobile!=undefined)
  {
    $('#is_mobile').val(mobile).trigger('change')
  }
	$.each(data, function(i, item){
		html +='<tr>';
			html +='<td>'+ ++sr_no +'</td>';
			html +='<td><a href="../survey-forms/warehouse-management.php?status='+status+'&state='+item.state+'">'+ item.state_name +'</a></td>';
			html +='<td>'+ item.count +'</td>';

		html +='</tr>';
		
		
	});
	$('#state-table tbody').html(html);

}

function getUrlVars()
{
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for(var i = 0; i < hashes.length; i++)
    {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
}

function get_states_districtwise()
{
	var url_var=getUrlVars(); 
	state=url_var['state'];
	/*district=url_var['district'];
	block=url_var['block'];*/
	status=url_var['status'];
    window.open("../auth/vdvk_districtwise.php?status="+status+'&state='+state,'_blank');
}