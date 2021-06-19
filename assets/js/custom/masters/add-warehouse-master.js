var auth = TRIFED.getLocalStorageItem();
//var editRole = TRIFED.checkPermissions("role_status");
//var statusRole = TRIFED.checkPermissions("role_edit");
var states={};
var blocks={};
$(function () {
	fetchState();
});
fetchState = (item_id=0) => {
	var url = conf.getStates.url;
    var method = conf.getStates.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, 'GET', data, function (response, cb) {
        if (response) {
            states = response.data;
            //fillStates(response.data,item_id);
        } else {
            TRIFED.showMessage('error', cb);
        }
    });
}

fillStates = (states,item_id=0) => {
	html = '<option value="">Select State</option>';
	$.each(states, function(i, state) {
		html += '<option value="'+state.id+'">'+state.title+'</option>';
	});
	$('#states'+item_id).html(html);
}

$(document).on('change','.states', function (ev) {

	const v = $(this).val();
	var item_id = $(this).attr('state_id');
	fetchDistrict(v,item_id);
});

fetchDistrict = (id = 0,item_id=0) => {
	var url = conf.getDistricts.url;
	var method = conf.getDistricts.method;
	var data = {
		state_id : id
	};
	TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
		if (response) {
			fillDistrict(response.data,item_id);
		}
	});
}

fillDistrict = (districts,item_id=0) => {
	html = '<option value="">Select District</option>';
	$.each(districts, function(i, district) {
		html += '<option value="'+district.id+'">'+district.title+'</option>';
	});
	$('#district'+item_id).html(html);
}

$(document).on('change','.district', function (ev) {
	const v = $(this).val();
	var item_id = $(this).attr('district_id');
	fetchWarehouseHaatmarketBlock(v,item_id);
});

fetchWarehouseHaatmarketBlock = (id = 0,item_id=0) => {
	var url = conf.getWarehouseHaatmarket.url;
	var method = conf.getWarehouseHaatmarket.method;
	var data = {
		district_id : id,
		state_id : $('#states'+item_id).val()
	};
	TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
	
		if (response) {
			fillHaatmarket(response.data.haat_data,item_id);
			fillWarehouse(response.data.warehouse_data,item_id);
			fillBlocklist(response.data.block_data,item_id);
		}
	});
}

fillWarehouse = (haats,item_id=0) => {
	
	html = '<option value="">Select Warehouse</option>';
	
	haats.forEach(function(row){
		html += '<option value="'+row.id+'">'+row.get_part_one.name+'</option>';
	});
	$('#warehouse'+item_id).html(html);
}
fillHaatmarket = (haats,item_id=0) => {
	
	html = '<option value="">Select Warehouse</option>';
	
	haats.forEach(function(row){
		html += '<option value="'+row.id+'">'+row.get_part_one.rpm_name+'</option>';
	});
	$('#corresponding_hats'+item_id).html(html);
}



fetchBlockList = (id = 0,item_id=0) => {
	var url = conf.getBlocks.url;
	var method = conf.getBlocks.method;
	var data = {
		district_id : id
	};
	TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
		if (response) {
			blocks=response.data;
			//fillBlocklist(response.data,item_id);
		}
	});
}

fillBlocklist = (blocks,item_id) => {
	html = '<option value="">Select Block</option>';
	$.each(blocks, function(i, block) {
		html += '<option value="'+block.id+'">'+block.title+'</option>';
	});
	$('#blocks'+item_id).html(html);
}




var labels_no = 0;
var url_var = getUrlVars();

warehouse_master_id = url_var['id'];
$(document).ready(function() {
    
    var random_items_id = Date.now();
    //roles_options = get_roles_options();
    $('#add_items').click(function() {
        random_items_id = Date.now();
        RenderPre(random_items_id);
        $('#blocks'+random_items_id).select2();
        $('#operating_days'+random_items_id).select2();
        fillStates(states,random_items_id);
        
        //fetchDistrict(0,random_items_id);
        fillBlocklist(blocks,random_items_id);
        pr_no_inc();
    });


    var items_data = '';
    if (warehouse_master_id != null && warehouse_master_id != undefined) {
        var warehouse_data=[];
        warehouse_data = get_warehouse_data(warehouse_master_id);
        var items_row = 0;
        // $.each(haat_master_data, function(key, itemdata) {
        //     ++items_row;
            random_items_id = 1;
            RenderPre(random_items_id, warehouse_data);
        //});
    } else {
        itemdata = [];
        RenderPre(random_items_id, itemdata);
        
        $('#blocks'+random_items_id).select2();
        fillStates(states,random_items_id);
        //fetchDistrict(0,random_items_id);
        fillBlocklist(blocks,random_items_id);
    }

    $("#formID").submit(function(e) {
		    e.preventDefault();
		}).validate({
	    rules: {
            
            
        },
	    submitHandler: function(form) { 
	        var form = $('#formID')[0];   
    		var data = new FormData(form);	
    		var url = conf.addWarehouseMaster.url;
			var method = conf.addWarehouseMaster.method;
			if (warehouse_master_id != undefined && warehouse_master_id != '') 
			{
				data.append('form_id', warehouse_master_id );
			}
			TRIFED.fileAjaxHit(url, method, data, function (response) {
				if (response.status == 1) {
					TRIFED.showMessage('success', 'Successfully Added');
					setTimeout(function() { window.location = 'warehouse-master.php'}, 500);
				} else {
					TRIFED.showError('error', response.message);
				}
			});
	        //submit via ajax
	        return false;  //This doesn't prevent the form from submitting.
	    }
	});
    
});
function RenderPre(random_items_id, itemdata) {
    
    var labels_no = $(".delete_items").length;
    ++labels_no;
    var source = $("#items_template").html();
    Mustache.parse(source);
    var rendered = Mustache.render(source, {
        random_items_id: random_items_id,
        itemdata: itemdata,
    });
    $("#items_container").append(rendered);
    if (itemdata!=null && itemdata!='') {
        fillStates(states,random_items_id);
        $('#states'+random_items_id).val(itemdata.state_id).trigger('change');
        $('#district' + random_items_id).val(itemdata.district_id).trigger('change');
        $('#warehouse' + random_items_id).val(itemdata.warehouse_id);
        
        $('#corresponding_hats' + random_items_id).val(itemdata.corresponding_hats_id);
        $('#storage_type' + random_items_id).val(itemdata.storage_type);
        $('#storage_capacity_' + random_items_id).val(itemdata.storage_capacity);
        
        $.each(itemdata.WarehouseBlocksDetails, function( i, v ){
              $("#blocks"+random_items_id +" option[value='" + v.block_id + "']").prop("selected", true);
        });

        $('#blocks'+random_items_id).select2();
        
        pr_no_inc();
        //delete_item(random_items_id);
    } 
    pr_no_inc();
}
function getUrlVars() {
    var vars = [],
        hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for (var i = 0; i < hashes.length; i++) {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
}

function get_warehouse_data(id) {
    var url = conf.getWarehouseFormDetail.url(id);
    var method = conf.getWarehouseFormDetail.method;
    var data = {};

    TRIFED.asyncAjaxHit(url, method, data, function(response, cb) {
        if (response.status) {
            data = response.data;
            
        } else {
            TRIFED.showMessage('error', cb);
        }
    });
    return data;
}
function delete_item(random_items_id) 
{
    var count = $(".delete_items").length;
    if (count > 1) {
        $("#delete_items" + random_items_id).remove();
        pr_no_inc();
    }
}
function pr_no_inc() {
        var item_no = 0;
        $('.item_no').each(function() {
            ++item_no;
            $(this).html(item_no);
        });

        var count = $(".delete_items").length;

        //$('.remove_items').first().hide();   
        $('.remove_items').show();
        $('.remove_items').first().hide();   
        
}