$(function () {
    fetchStateList();
});

fetchStateList = () => {
	var url_var=getUrlVars(); 
	state=url_var['state'];
	district=url_var['district'];
	block=url_var['block'];
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
	var url = conf.vdvk_statewise.url;
    var method = conf.vdvk_statewise.method;
    var data = {
	    state : state,
	    district : district,
	    block : block,
	    status : status,
	};
    TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
        if (response) {
        	fillStateList(response.data);
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
	$.each(data, function(i, item){
		html +='<tr>';
			html +='<td>'+ ++sr_no +'</td>';
			html +='<td><a href="javascript:void(0)" onclick="get_states_districtwise('+ item.state +')">'+ item.state_name +'</a></td>';
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

function get_states_districtwise(state)
{
	var url_var=getUrlVars(); 
	//state=url_var['state'];
	/*district=url_var['district'];
	block=url_var['block'];*/
	status=url_var['status'];
    document.location="../auth/vdvk_districtwise.php?status="+status+'&state='+state;
}