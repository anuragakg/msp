$(function () {
	 var url_var=getUrlVars(); 
  state=url_var['state_id'];
	fetchState();
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


  fetchState = () => {
      var url = conf.getStates.url;
      var method = conf.getStates.method;
      var data = {};
      TRIFED.asyncAjaxHit(url, 'GET', data, function (response, cb) {
          if (response) {
              addressData = response.data;
              fillStates(response.data);
          } else {
              TRIFED.showMessage('error', cb);
          }
      });
  }

  fillStates = (states) => {
    html = '<option value="">Select State</option>';
    $.each(states, function(i, state) {
      html += '<option value="'+state.id+'">'+state.title+'</option>';
    });
    $('#state').html(html);
    if(state!=undefined && state!=null && state!=0)
    {
        $('#state').val(state);
    }
  }


fetchReleasList = () => {
	var url_var=getUrlVars(); 
	state=url_var['state_id'];
	var url = conf.sanctioned_releasewise.url;
    var method = conf.sanctioned_releasewise.method;
    var data = {
	    state_id : state,
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
	state=url_var['state_id'];
 
  if(state!=null && state!=undefined)
  {
    $('#state').val(state).trigger('change')
  }
	$.each(data, function(i, item){
		html +='<tr>';
			html +='<td>'+ ++sr_no +'</td>';
			html +='<td>'+ item.state_name +'</td>';
			html +='<td>'+ item.name +' '+ item.last_name+'</td>';
			html +='<td><a href="sanctioned_releasewise-detail.php?s_id='+item.state+'">'+item.no_vdvk+'</a></td>';
			html +='<td>'+ item.released_amount +'</td>';

		html +='</tr>';
		
		
	});
	$('#state-table tbody').html(html);
}

