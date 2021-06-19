$(function () {
    fetchBlockList();
});

fetchBlockList = () => {
	var url_var=getUrlVars(); 
	state=url_var['state'];
	district=url_var['district'];
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
	var url = conf.vdvk_blockwise.url;
    var method = conf.vdvk_blockwise.method;
    var data = {
	    state : state,
	    district : district,
	    status : status,
	};
    TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
        if (response) {
        	fillBlockList(response.data);
        	//console.log(response.data);
        } else {
            TRIFED.showMessage('error', cb);
        }
    });
}

fillBlockList = (data) => {
	var html = "";
	var sr_no=0;
	var url_var=getUrlVars(); 
	state=url_var['state'];
	district=url_var['district'];
	//block=url_var['block'];
	status=url_var['status'];
	$.each(data, function(i, item){
		html +='<tr>';
			html +='<td>'+ ++sr_no +'</td>';
			html +='<td> >'+ item.state_name +'</td>';
			html +='<td>'+ item.district_name +'</td>';
			html +='<td><a href="../approval-management/proposed-vdvks-list.php?status='+status+'&state='+item.state+'&district='+item.district_id+'&block='+item.block_id+'" >'+ item.block_name +'</a></td>';
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

function get_blockwise_count()
{
	var url_var=getUrlVars(); 
	state=url_var['state'];
	/*district=url_var['district'];
	block=url_var['block'];*/
	status=url_var['status'];
    window.open("../auth/vdvk_blockwise.php?status="+status+'&state='+state,'_blank');
}