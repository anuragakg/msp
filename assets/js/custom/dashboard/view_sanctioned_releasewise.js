$(function () {
	 var url_var=getUrlVars(); 
  state=url_var['s_id'];
    fetchReleasList();
    
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

fetchReleasList = () => {
	var url_var=getUrlVars(); 
	state=url_var['s_id'];
	var url = conf.view_sanctioned_releasewise.url;
    var method = conf.view_sanctioned_releasewise.method;
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
			html +='<td>'+ item.released_amount +'</td>';
		html +='</tr>';	
		
	});
	$('#state-table tbody').html(html);
}

