$(function () {
    fetchStateList();
});

fetchStateList = () => {
	var url_var=getUrlVars(); 
	state=url_var['state'];
	district=url_var['district'];
	block=url_var['block'];
	mobile=url_var['is_mobile'];
	$("#state").val(state);
	//status=url_var['status'];
	 /*if(status==1)
	 {
	 	//$('#haatbazaar_status').html('Approved');
	 	$('#haatbazaar_count_head').html('Count');
	 }else
	 {
	 	//$('#haatbazaar_status').html('Pending');
	 	$('#haatbazaar_count_head').html('Count');
	 }*/
	var url = conf.haatbazaar_statewise.url;
    var method = conf.haatbazaar_statewise.method;
    var data = {
	    state : state,
	    district : district,
	    block : block,
	    is_mobile : mobile
	    //status : status,
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
	mobile=url_var['is_mobile'];
	if(mobile!=null && mobile!=undefined)
  {
    $('#is_mobile').val(mobile).trigger('change')
  }
	$.each(data, function(i, item){
		html +='<tr>';
			html +='<td>'+ ++sr_no +'</td>';
			html +='<td><a href="../haat-market/haat-market-management.php?state='+item.state+'">'+ item.state_name +'</a></td>';
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