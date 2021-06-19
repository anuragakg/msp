$(function () {
	 var url_var=getUrlVars(); 
  state=url_var['state_id'];
	fetchState();
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
$('#state').on('change', function (ev) {
    const v = $(this).val();
    state = $('#state option:selected').val();
    district_id=null;

    if (v.length == 0) {
      clearSelect('#district');
      clearSelect('#block');
      return;
    }

    fetchDistrict(v);
  });


  fetchDistrict = (id = 0) => {
    var url = conf.getDistricts.url;
    var method = conf.getDistricts.method;
   // var seleced_state
    var data = {
      state_id : $('#state').val(),
    };
    TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
      if (response) {
        fillDistrict(response.data);
      }
    });
  }

  $('#district').on('change', function (ev) {
    district= $('#district option:selected').val();
    const v = $(this).val();
    block_id=null;
    fetchBlock(v);
  })
  fillDistrict = (districts) => {
    html = '<option value="">Select District</option>';
    $.each(districts, function(i, district) {
      html += '<option value="'+district.id+'">'+district.title+'</option>';
    });
    $('#district').html(html);
    if(district_id!=undefined && district_id!=null && district_id!=0)
    {
        $('#district').val(district_id);
    }
  }

  

  fetchBlock = (id = 0) => {
    var url = conf.getBlocks.url;
    var method = conf.getBlocks.method;
    var data = {
      district_id : $('#district').val()
    };
    TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
      if (response) {
        fillBlock(response.data);
      }
    });
  }

    fillBlock = (blocks) => {
    html = '<option value="">Select Block</option>';
    $.each(blocks, function(i, block) {
      html += '<option value="'+block.id+'">'+block.title+'</option>';
    });
    $('#block').html(html);
    if(block_id!=undefined && block_id!=null && block_id!=0)
    {
        $('#block').val(block_id);
    }
  }

fetchSndList = () => {
	var url_var=getUrlVars(); 
	state=url_var['state_id'];
  district=url_var['district'];
  block=url_var['block'];
	var url = conf.statewise_supervisor.url;
    var method = conf.statewise_supervisor.method;
    var data = {
	    state_id : state,
      district : district,
      block : block,
	};
    TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
        if (response) {
        	fetchSupervisorList(response.data);
        } else {
            TRIFED.showMessage('error', cb);
        }
    });
}

fetchSupervisorList = (data) => {
	var html = "";
	var sr_no=0;
	var url_var=getUrlVars(); 
	state=url_var['state_id'];
  district=url_var['district'];
  block=url_var['block'];
 
  if(state!=null && state!=undefined)
  {
    $('#state').val(state).trigger('change');
    $('#district').val(district).trigger('change');
    $('#block').val(block).trigger('change');
  }
  

	$.each(data, function(i, item){
		html +='<tr>';
			html +='<td>'+ ++sr_no +'</td>';
      html +='<td>'+ item.name +'</td>';
			html +='<td>'+ item.state_name +'</td>';
			html +='<td>'+ item.district_name +'</td>';	
      html +='<td>'+ item.block_name +'</td>'; 		
      html +='<td>'+ item.count +'</td>';
		html +='</tr>';
		
		
	});
	$('#state-table tbody').html(html);
}

function clearSelect (id) {
  return $(id).html(
    $('<option>').text('Please Select').val('')
  );
}
