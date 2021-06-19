$(function () {
    getVdvkList();
});
var editProposal = TRIFED.checkPermissions("pmvdy_proposal_management_edit");
var viewProposal = TRIFED.checkPermissions("pmvdy_proposal_management_view");
var markDemo = TRIFED.checkPermissions("vdvk_demo_unit_add");
/**
 * Hits api and get the necessary records.
 * @param {String} type Type of the list it needs to get
 */
function getVdvkList(query = null) {
	var url_var=getUrlVars(); 
	const { url, method } = conf.getRolewiseVdvk;
    const data = {};
    
    
    var role_id=url_var['role'];
    var status_val=url_var['status'];
    var state_val=url_var['state'];
    var district=url_var['district'];
    var block=url_var['block'];
    if(state_val!=null && state_val!=undefined)
    {
    	$('#stateList').val(state_val).trigger('change');
    }
    if(district!=null && district!=undefined)
    {
    	$('#districtList').val(district).trigger('change');
    }
    if(block!=null && block!=undefined)
    {
    	$('#blocksList').val(block);
    }
    
    if(status_val!=null && status_val!=undefined)
    {
    	data.status = status_val;
    }
    if(role_id!=null && role_id!=undefined)
    {
    	data.role_id = role_id;
    }
	let action = url(query);
	if ($('#stateList').val().trim().length != 0) {
        data.state = $('#stateList').val().trim();
    }
	if ($('#districtList').val().trim().length != 0) {
        data.district = $('#districtList').val().trim();
    }
    if ($('#blocksList').val().trim().length != 0) {
        data.block = $('#blocksList').val().trim();
    }
    TRIFED.asyncAjaxHit(action, method, data, function(response, cb) {
	    if (response.status) {
	      renderList('#vdvk-list', response.data);
	      TRIFED.showPermissions();
	    } else {
	      TRIFED.showError("error", response.message);
	    }
  });
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
/**
 * Renders the mo list.
 * @param {Number|String} id 
 * @param {Array} records Array of records.
 * @param {String} type Type of list to render.
 */
function renderList(id, records) {
	const el = $('tbody' + id);
	el.html('');
	var i = 1;
	var status='';
	var demo = 1;
	
	if(records.length !== 0) {
		records.forEach(element => {
			const row = $('<tr>');
			if(element.status==0){
				status='Pending';
			}else if(element.status==1){
				status='Approved';
			}else if(element.status==2){
				status='Revert';
			}else if(element.status==3){
				status='Rejected';
			}else{
				status='Pending';
			}
			if(element.demo_unit == 1)
			{
				demo = 0;
			}else{
				demo = 1;
			}
			row.attr('data-id', element.vdvk_id);
			row.append($('<td>').text(i));
			row.append($('<td>').text(element.role));
			row.append($('<td>').text(element.kendra_name));
			row.append($('<td>').text(element.leader));
			row.append($('<td>').text(element.leader_mobile));
			row.append($('<td>').text(element.leader_email));
			row.append($('<td>').text(element.submission_date));
			row.append($('<td>').text(status));
			
			if(editProposal && (element.status==2 || element.submission_status==0)){
				var editAction = '../project-proposal/project-proposal-location-form.php';
				var editLink = generateEditButton(editAction + '?id=' + element.vdvk_id);
			}
			if(viewProposal){
				var viewAction = '../project-proposal/proposal-detail-view.php';
				var viewLink = generateViewButton(viewAction + '?id=' + element.vdvk_id);
			}
			//const demoUnit = generateDemoUnitButton(element.id, element.demo_unit);

			const $td = $('<td>').addClass('action-area');		
			/**
			 * Append edit link only if the status is 0(Pending),2(Reverted).
			 */
			if(editProposal){ 
				//if ([0,2].indexOf(element.status) != -1) {
					$td.append(editLink);
				//} 
			}
			
			$td.append(" ");
			if(viewProposal){ $td.append(viewLink); }

			const button = $('<a>');

		let btnClass = 'bg-danger data-delete';
		let btnToolTip = 'Remove Demo Unit';
		let btnText = '<i class="fa fa-close"></i>';
		if (element.demo_unit == 0) {
			btnClass = 'bg-success data-view';
			btnText = '<i class="fa fa-check"></i>';
			btnToolTip = 'Mark Demo Unit';
		}

		button.attr('class', btnClass).html(btnText);
		button.attr('data-id', demo);
		button.attr({
			'data-toggle' : 'tooltip',
			'data-placement': 'top',
			'title' : btnToolTip,
			'data-original-title': btnToolTip,
		})
		if(markDemo){ button.click(markDemoUnit); }
		$td.append(button);

			//$td.append(demoUnit);


			row.append($td);
			
			el.append(row);
			i++;
		});
	} else {
		utils.noRecordsFound(el, 8);
	}
}

function generateEditButton (href) {
	return $('<a>')
	.attr({
		'data-toggle' : 'tooltip',
		'data-placement': 'top',
		'title' : 'Edit',
		'data-original-title': 'Edit',
		'class': 'data-view',
		'href' : href
	})
	.html($('<i>').addClass('fa fa-edit'));
}

function generateViewButton (href) {
	return $('<a>')
	.attr({
		'data-toggle' : 'tooltip',
		'data-placement': 'top',
		'title' : 'View',
		'data-original-title': 'View',
		'class': 'data-view',
		'href' : href
	})
	.html($('<i>').addClass('fa fa-eye'));
}

function generateDemoUnitButton (id,demo_unit) {
	return $('<button>')
	.attr({
		'data-toggle' : 'tooltip',
		'data-placement': 'top',
		'title' : 'Demo Unit',
		'data-original-title': 'Demo Unit',
		'class': 'data-view hidden demo-unit',
		'onClick': markDemoUnit(id,demo_unit)
	})
	.html($('<i>').addClass('fa fa-check'));
}

function markDemoUnit() {
	if (!confirm('Are you sure you want to Change The Status.')) {
		return;
	}

	var demo_unit = $(this).attr('data-id');
	var id = $(this).closest('tr').attr('data-id');
	const {
		url,
		method
	} = conf.vdvkDemoUnit;

	const action = url(id);
	//if(demo_unit == '1') {demo_unit = '0'; } else { demo_unit = '1'; }
	var data = { "demo_unit" : demo_unit };

	TRIFED.asyncAjaxHit(action, method, data, function (response, cb) {
		if (response.status) {
			TRIFED.showMessage("success", "VDVK Successfully Add To Demo Unit");
			location.reload();
		}
		TRIFED.showError("error", response.message);
	});
}
utils.getStateMaster(function(records) {
  utils.renderOptionElements("#stateList", records.data);
});
$("#stateList").on("change", function() {
  utils.getDistricts(this.value, function(records) {
    utils.renderOptionElements("#districtList", records.data);
  });
});
/*utils.getDistricts(1, function(records) {
    utils.renderOptionElements("#districtList", records.data);
  });*/
  
$("#districtList").on("change", function() {
    utils.getBlocks(this.value, function(records) {
      utils.renderOptionElements("#blocksList", records.data);
    });
});

$("#filterRecords").on("submit", function(e) {
    e.preventDefault();
    const data = $(this).serialize();
    getVdvkList(data);
});