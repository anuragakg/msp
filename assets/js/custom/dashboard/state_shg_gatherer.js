$(function () {
	var url_var=getUrlVars(); 
  state=url_var['state'];

	fetchState();
    fetchShgList();
});


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

fetchShgList = () => {
	var url_var=getUrlVars();  
	state=url_var['state'];
	var url = conf.state_shg_gatherer.url;
    var method = conf.state_shg_gatherer.method;
    var data = {
	    state : state,
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
			html +='<td><a href="javascript:void(0)" onclick="get_states_districtwise('+ item.state +')">'+ item.state_name +'</a></td>';
			html +='<td>'+ item.count +'</td>';
			

		html +='</tr>';
	});
	$('#state-table tbody').html(html);
}

function get_states_districtwise(state)
{
	var url_var=getUrlVars(); 
	//state=url_var['state'];
	/*district=url_var['district'];
	block=url_var['block'];*/
	//status=url_var['status'];
	document.location ="../auth/distric_shg_group.php?state="+state,'_blank';
    
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
 


