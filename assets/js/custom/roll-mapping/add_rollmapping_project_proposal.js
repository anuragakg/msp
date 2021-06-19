$(function () {
	// TRIFED.checkToken();
    fetchStatesList();
    //addRollmapping();
    
});

fetchStatesList = () => {
	var url = conf.getStates.url;
    var method = conf.getStates.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, 'GET', data, function (response, cb) {
        if (response) {
            addressData = response.data;
            
            fillStatesList(response.data);
        } else {
            TRIFED.showMessage('error', cb);
        }
    });
}

fillStatesList = (data) => {
	var html = '<option value="">Select State</option>';
	var count=0;
	var url_var=getUrlVars(); 
	
	state_id=url_var['state_id'];
    
	$.each(data, function(k, subdata){ 
		++count;
		if(state_id!=null && state_id!=undefined)
		{
			if(subdata['id']==state_id)
			{
				html +='<option value="'+subdata['id']+'" selected>'+subdata['title']+'</option>';		
			}
			
		}else{
			html +='<option value="'+subdata['id']+'">'+subdata['title']+'</option>';
		}
		
		
	});
	
	$('#state').html(html);
}


function get_levels_options(level_id) {
	var url = conf.getLevel.url(level_id);
	var method = conf.getLevel.method;
	var data = {};
	var options = '';
	TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
		
		if (response.status == 1){
			var data=response.data;
			options = '<option value="">Select Level</option>';
			options +='<option value="'+data['id']+'" selected>'+data['title']+'</option>';
		}
		else{
			TRIFED.showError('error', response.message);
		}
		
	});

	return options;
}

function get_roles_options() {
	var url = conf.getRole.url;
	var method = conf.getRole.method;
	var data = {};
	var options = '<option value="">Select Role</option>';
	TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
		if (response.status){
			var data=response.data;
			
			$.each(data, function(i, data){ 
				options +='<option value="'+data.id+'" >'+ utils.generateAbbreviation(data.title)+'</option>';
				
			});
			
		}
		//TRIFED.showError('error', response.message);
	});

	return options;
}
function get_state_data(state_id)
{
	var url = conf.getRollMappingProjectStateDate.url;
	var method = conf.getRollMappingProjectStateDate.method;
	var data = {};
	var options = '<option value="">Select Role</option>';
	TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
		
		if (response.status){

			var data=response.data;
			
			$.each(data, function(i, data){ 
				options +='<option value="'+data.id+'" >'+ data.title+'</option>';
				
			});
			
		}
		//TRIFED.showError('error', response.message);
	});

	return options;
}

function get_state_level_role_data(state_id)
{
	var url = conf.editViewScrutiny.url(state_id);
	
	var method = conf.editViewScrutiny.method;
	var data = {};
	
	TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
		
		if(response.status){
			data=response.data;
		}
		
	});

	return data;
}
