$(function () {
    fetchRoleList();
});

fetchRoleList = () => {
	var url_var=getUrlVars(); 
	state=url_var['state'];
	district=url_var['district'];
	block=url_var['block'];
	status=url_var['status'];
	 if(status==1)
	 {
	 	$('#vdvk_status').html('Pending');
	 	$('#vdvk_count_head').html('VDVKs Pending');
	 }else
	 {
	 	$('#vdvk_status').html('Pending');
	 	$('#vdvk_count_head').html('VDVKs pending for approval');
	 }
	var url = conf.vdvk_rolewise.url;
    var method = conf.vdvk_rolewise.method;
    var data = {
	    state : state,
	    district : district,
	    block : block,
	    status : status,
	};
    TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
        if (response) {
        	fillRoleList(response.data);
        } else {
            TRIFED.showMessage('error', cb);
        }
    });
}

fillRoleList = (data) => {
	var html = "";
	var sr_no=0;
	var url_var=getUrlVars(); 
	state=url_var['state'];
	district=url_var['district'];
	block=url_var['block'];
	status=url_var['status'];
	$.each(data, function(i, item){
		html +='<tr>';
			html +='<td>'+ ++sr_no +'</td>';
			html +='<td><a href="javascript:void(0)" onclick="get_roles_statewise('+ item.role_id +')">'+ item.role +'</a></td>';
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

function get_roles_statewise(role_id)
{
	var url_var=getUrlVars(); 
	//state=url_var['state'];
	/*district=url_var['district'];
	block=url_var['block'];*/
	status=url_var['status'];
    document.location ="../auth/vdvk_roles_statewise.php?status="+status+'&role_id='+role_id,'_blank';
}