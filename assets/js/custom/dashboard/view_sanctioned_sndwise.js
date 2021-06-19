$(function () {
	 var url_var=getUrlVars(); 
  state=url_var['s_id'];
    fetchSndList();
    
});

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

fetchSndList = () => {
	var url_var=getUrlVars(); 
	state=url_var['s_id'];
	var url = conf.view_sanctioned_sndwise.url;
    var method = conf.view_sanctioned_sndwise.method;
    var data = {
	    s_id : state,
	};
    TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
        if (response) {
        	fillSndList(response.data);
        } else {
            TRIFED.showMessage('error', cb);
        }
    });
}

fillSndList = (data) => {
	var html = "";
	var sr_no=0;
	var url_var=getUrlVars(); 
	state=url_var['s_id'];
	$.each(data, function(i, item){
		html +='<tr>';
			html +='<td>'+ ++sr_no +'</td>';
			html +='<td>'+ item.kendra_name +'</td>';
			html +='<td>'+ item.sanctioned_amount +'</td>';
		html +='</tr>';
		
		
	});
	$('#state-table tbody').html(html);
}

