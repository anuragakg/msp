$(function () {
    fetchShgList();
});

fetchShgList = () => {
	var url_var=getUrlVars(); 
	district=url_var['district'];
	var url = conf.block_shg_group.url;
    var method = conf.block_shg_group.method;


    var data = {
    	district : district,
	};
    TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
        if (response.status) {
        	fillList(response.data);
        } else {
            TRIFED.showError('error', response.message);
        }
    });
}

fillList = (data) => {
	var html = "";
	var sr_no=0;
	var url_var=getUrlVars(); 
	
	$.each(data, function(i, item){
		html +='<tr>';
			html +='<td>'+ ++sr_no +'</td>';
			html +='<td>'+ item.state_name +'</td>';
			html +='<td><a href="javascript:void(0)" onclick="get_states_blockwise('+ item.district +')">'+ item.district_name +'</a></td>';
			html +='<td><a href="javascript:void(0)" onclick="get_states_blockwise('+ item.block +')">'+ item.block_name +'</a></td>';
			html +='<td>'+ item.count +'</td>';
			

		html +='</tr>';
	});
	$('#state-table tbody').html(html);
}

function get_states_blockwise(district)
{
	var url_var=getUrlVars(); 
	//state=url_var['state'];
	/*district=url_var['district'];
	block=url_var['block'];*/
	//status=url_var['status'];
    window.open("../auth/block_shg_group.php?district="+district,'_blank');
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
