$(function () {
	// TRIFED.checkToken();
    fetchStatesList();

    
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
		
		if (response.status){

			

			
			var data=response.data;
			options = '<option value="">Select Level</option>';
			options +='<option value="'+data['id']+'" selected>'+data['title']+'</option>';
			
			
			
		}
		//TRIFED.showError('error', response.message);
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


function get_state_level_role_data(state_id)
{
	var url = conf.getRollMappingFundFlowData.url(state_id);
	
	var method = conf.getRollMappingFundFlowData.method;
	var data = {};
	
	TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
		
		if(response.status){
			data=response.data;
		}
		
	});

	return data;
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
var labels_no=0;
    
$(document).ready(function(){ 
    var url_var=getUrlVars(); 
    
    state_id=url_var['state_id'];
    //console.log(state_id)
    var random_items_id = Date.now();
    roles_options=get_roles_options();                
	$('#add_items').click(function (){
		random_items_id = Date.now();
		RenderPre(random_items_id);   
    });

    
    var items_data = '';
    if(state_id!=null && state_id!=undefined )
    {  
        var state_data=get_state_level_role_data(state_id);   
        var items_row=0;
        $.each(state_data,function(key,itemdata){
            ++items_row;
            random_items_id = items_row;

            RenderPre(random_items_id,itemdata);
        });
    }else
    {
      itemdata={};
      RenderPre(random_items_id,itemdata);
    } 

    function RenderPre(random_items_id,itemdata) 
    {
        var labels_no = $(".delete_items").length;
        ++labels_no;
        var source = $("#items_template").html();
        Mustache.parse(source);
        var rendered = Mustache.render(source, {
            random_items_id: random_items_id,
            itemdata: itemdata,
        });
        console.log(itemdata)
        var levels_options=get_levels_options(labels_no,);      
        if(levels_options!='')
        {
        	$("#items_container").append(rendered);
        
	        $('#levels'+random_items_id).html(levels_options);
	        $('#roles'+random_items_id).html(roles_options);
	        if(itemdata){
	          $('#roles'+random_items_id).val(itemdata.role_id).trigger('change');
	        }
	        pr_no_inc();
	        delete_item(random_items_id);	
        }else{
        	TRIFED.showError('error', 'No More Levels Found');
        }
        
    }
    
    
    function pr_no_inc(){
        var item_no=0;
        $('.item_no').each(function(){
          ++item_no;
          $(this).html(item_no);
        });
    
        var count = $(".delete_items").length;
    
        //$('.remove_items').first().hide();   
        $('.remove_items').show();
        if(count==1){
          $('.remove_items').hide();
        }else{
          $('.remove_items').not(':last').hide();  
        }
    }
    
    function delete_item(random_items_id) 
    {
      $("#remove_items"+random_items_id).click(function () {
                var count = $(".delete_items").length;
                if (count > 1) {
                    $("#delete_items" + random_items_id).remove();
                    pr_no_inc();
                }
      }); 
    }
	$("#formId").validate({
        rules: {
            state_id: "required"
        },
        messages: {
            state_id: "Please select state"
		}
    });

    $('#save').click(function() {
        if($("#formId").valid()){
			var url = conf.addRollmappingFundFlow.url;
			var method = conf.addRollmappingFundFlow.method;
			var data = $('#formId').serializeArray();
			TRIFED.asyncAjaxHit(url, method, data, function (response) {
					if (response.status == 1) {
						response_data=response.data;
						
						var url_var=getUrlVars(); 
    
						state_id=url_var['state_id'];
						
						if(state_id!=null && state_id!=undefined )
						{
							TRIFED.showMessage('success', 'Successfully Updated');	
						}else{
							TRIFED.showMessage('success', 'Successfully Added');
						}
						

						setTimeout(function() {document.location = "view-role-mapping-fund-flow.php";}, 500);
						
					} else {
						TRIFED.showError('error', response.message);
						z= false;
					}
			});
		}
    });
});