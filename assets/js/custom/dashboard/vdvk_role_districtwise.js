$(function () {
    fetchDistrictList();
});

fetchDistrictList = () => {
	var url_var=getUrlVars(); 
	role_id=url_var['role_id'];
	state=url_var['state'];
	status=url_var['status'];
	 if(status==1)
	 {
	 	$('#vdvk_status').html('Approved');
	 	$('#vdvk_count_head').html('VDVKs Approved');
	 }else
	 {
	 	$('#vdvk_status').html('Pending');
	 	$('#vdvk_count_head').html('VDVKs pending for approval');
	 }
	var url = conf.vdvk_role_districtwise.url;
    var method = conf.vdvk_role_districtwise.method;
    var data = {
    	role_id : role_id,
	    state : state,
	    status : status,

	};
    TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
        if (response) {
        	fillDistrictList(response.data);
        	//console.log(response.data);
        } else {
            TRIFED.showMessage('error', cb);
        }
    });
}

fillDistrictList = (data) => {
	var html = "";
	var sr_no=0;
	var url_var=getUrlVars(); 
	state=url_var['state'];
	/*district=url_var['district'];
	block=url_var['block'];*/
	status=url_var['status'];
	$.each(data, function(i, item){
		html +='<tr>';
			html +='<td>'+ ++sr_no +'</td>';
			html +='<td>'+ item.role +'</td>';
			html +='<td>'+ item.state_name +'</td>';
			html +='<td><a href="javascript:void(0)" onclick="get_role_district_blockwise('+item.district_id+','+item.role_id+')">'+ item.district_name +'</a></td>';
			html +='<td>'+ item.total_count +'</td>';

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

function get_role_district_blockwise(district_id,role_id)
{
	var url_var=getUrlVars(); 
	state=url_var['state'];
	district=district_id;
	//block=url_var['block'];
	status=url_var['status'];
    document.location ="../auth/vdvk_role_blockwise.php?status="+status+'&state='+state+'&district='+district+'&role_id='+role_id,'_blank';
}