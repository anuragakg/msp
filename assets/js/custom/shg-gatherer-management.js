var paginatedFilter = {};
$(function() {
  var url_var=getUrlVars(); 
  state=url_var['state'];
  district=url_var['district'];
  block=url_var['block'];

  utils.getStateMaster(function(res) {
    utils.renderOptionElements("#stateMaster", res.data);
    utils.renderOptionElements("#shg_group_states", res.data);
    utils.renderOptionElements("#stateMasterBulk", res.data);
    searchEvent();
  });

  if(state!=null && state!=undefined)
  {
    $('#stateMasterBulk').val(state).trigger('change');
  }
  if(district!=null && district!=undefined)
  {
    $('#districtList').val(district).trigger('change');
  }
  if(block!=null && block!=undefined)
  {
    $('#blocksList').val(block);
  }
  var data = {
      state: isNaN(state) ? null : state,
      district: isNaN(district) ? null : district,
      block: isNaN(block) ? null : block
    };
  
  getShgGatherersList(data);
 // fetchCoordinatingAgency();
  addShgGroup();
  importExcelFile();
  
  filterHideEvent();
  utils.addPerPageListing(getShgGatherersList);
});

var editShg = TRIFED.checkPermissions("shg_management_edit");
var viewShg = TRIFED.checkPermissions("shg_management_view");
var StatusShg = TRIFED.checkPermissions("shg_management_status");

$("#OrderBy").on('change',function(){
  var per_page = $('#pagination-amount').val();
  var state = $('#stateMasterHaat').val();
  var district = $('#districtList').val();
  var block = $('#blocksList').val();
  var village = $("#villageID").val();
  var pincode = $("#pincode").val();
  var surveyor = $("#surveyorID").val();
  var q = $('#queryTerm').val();
  var OrderBy = $('#OrderBy').val();
  var data = {
      per_page: isNaN(per_page) ? null : per_page,
      state: isNaN(state) ? null : state,
      district: isNaN(district) ? null : district,
      block: isNaN(block) ? null : block,
      village: isNaN(village) ? null : village,
      surveyor: isNaN(surveyor) ? null : surveyor,
      pincode: isNaN(pincode) ? null : pincode,
      'q': q,
     // 'OrderBy': OrderBy,
    };
    getShgGatherersList(data);
});

/*$("#OrderBy").click(function(){
  id=$(this).attr("data-order");
  if(id=='ASC')
  { 
    $('#OrderBy').attr( 'data-order','DESC');
   var state = $('#stateMasterHaat').val();
  var district = $('#districtList').val();
  var block = $('#blocksList').val();
    var q = $('#queryTerm').val();
   

  }else{ 
    $('#OrderBy').attr( 'data-order','ASC');
    var state = $('#stateMasterHaat').val();
  var district = $('#districtList').val();
  var block = $('#blocksList').val();
    var q = $('#queryTerm').val();
   var data = {
      state: isNaN(state) ? null : state,
      district: isNaN(district) ? null : district,
      block: isNaN(block) ? null : block,
      'q': q,
      'OrderBy': id,
    };
  getShgGatherersList(data);
  }
});*/
/**
 * Hits api and get the necessary records.
 * @param {String} type Type of the list it needs to get
 */


$(document).ready(function(){
$("#pincode").keyup(function(){
     var url = conf.SearchPincode.url;
    var method = conf.SearchPincode.method;
    var data = {'keyword':$(this).val()};
    TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
        if (response) {
         // utils.renderOptionElements('#villageList', response.data);
         //console.log(response.data);
          $("#pincode-box").show();
          html='';
           html='<ul id="pincode-list">';
          $.each(response.data, function(i, element) {
           html +="<li onclick=selectPincode('"+element.pincode+"')>"+element.pincode+"</li>";
          });
          html+='</ul>' 
          $("#pincode-box").html(html);
          $("#pincode").css("background","#FFF");
        }
    });
  });
});

function selectPincode(val) {
$("#pincode").val(val);
$("#pincode-box").hide();
}

$(document).ready(function(){
$("#village").keyup(function(){
 
     var url = conf.SearchVillage.url;
    var method = conf.SearchVillage.method;
    var data = {'keyword':$(this).val()};
    if($(this).val()=='')
    {
        $("#villageID").val('');
        $("#village-box").hide();
    }
    TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
        if (response) {
          $("#village-box").show();
          html='';
           html='<ul id="village-list">';
          $.each(response.data, function(i, element) {
  html +="<li  onclick='selectVillage("+element.id+",\""+element.title+"\");'>"+element.title+"</li>";
          });
          html+='</ul>' 
          $("#village-box").html(html);
          $("#village").css("background","#FFF");
        }
    });
  });
$("#surveyor").keyup(function(){ 
    var url = conf.SearchSurveyor.url;
    var method = conf.SearchSurveyor.method;
    var data = {'keyword':$(this).val()};
    if($(this).val()=='')
    {
        $("#surveyorID").val('');
        $("#surveyor-box").hide();
    }
    TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
        if (response) {
          $("#surveyor-box").show();
          html='';
           html='<ul id="surveyor-list">';
          $.each(response.data, function(i, element) {
  html +="<li  onclick='selectSurveyor("+element.id+",\""+element.name+"\");'>"+element.name+"</li>";
          });
          html+='</ul>' 
          $("#surveyor-box").html(html);
          $("#surveyor").css("background","#FFF");
        }
    });
  });
});

function selectVillage(id,val) {
$("#village").val(val);
$("#villageID").val(id);
$("#village-box").hide();
}

function selectSurveyor(id,val) {
$("#surveyor").val(val);
$("#surveyorID").val(id);
$("#surveyor-box").hide();
}

function getShgGatherersList(data = {}) {
  var url = conf.getShgGatherers.url;
  var method = conf.getShgGatherers.method;
  let filterData = getFilterData();

  Object.assign(data, filterData, paginatedFilter);
  data.OrderBy=$('#OrderBy').val();
  TRIFED.asyncAjaxHit(url, method, data, function(response, cb) {
    if (response.status) {
      if (response.data.gatherers.length) {
        $("#village-box").hide();
        $("#pincode-box").hide();
        $("#surveyor-box").hide();
        renderUsersList("#shg-gatherer-list", response.data);
        return TRIFED.showPermissions();
      }
      $('#pagination').html('');
      $('#pagination-top').html('');
      return $("#shg-gatherer-list").html(
        "<tr><td colspan='15' class='text-center'>No Data Found !!</td></tr>"
      );
    }
  });
}

function check_uncheck(isChecked) {
	if(isChecked) {
		$('.selected_ids').each(function() { 
			//this.checked = true;
			if (!this.disabled) 
			this.checked = true; 
		});
	} else {
		$('.selected_ids').each(function() {
			this.checked = false;
		});
	}
}
function check_download(isChecked) {
  if(isChecked) {
    $('.select_ids').each(function() { 
      //this.checked = true;
      if (!this.disabled) 
      this.checked = true; 
    });
  } else {
    $('.select_ids').each(function() {
      this.checked = false;
    });
  }
}
/**
 * Renders the mo list.
 * @param {Number|String} id
 * @param {Array} records Array of records.
 * @param {String} type Type of list to render.
 */
function renderUsersList(id, records) {
  utils.renderSimplePagination(records, "#pagination", getShgGatherersList);
   //utils.renderSimplePagination(records, "#pagination-top", getShgGatherersList);
  var perPage = parseInt(records.per_page);
  var currentPage = parseInt(records.current_page);
  const el = $("tbody" + id);
  el.html("");
  var i = ((currentPage-1)*perPage)+1;

  records.gatherers.forEach(element => {
    var group_name =
      element.group_name && element.group_name.length
        ? element.group_name[0].title
        : "-";
    const row = $("<tr>");

    const checkboxOptions = {
      type: "checkbox",
      name: "selected_ids[]",
      class: "selected_ids"
    };

    const checkbox = $("<input>")
      .attr(checkboxOptions)
      .val(element.id);

const downloadOptions = {
      type: "checkbox",
      name: "select_ids[]",
      class: "select_ids"
    };
 const checkboxdownload = $("<input>")
      .attr(downloadOptions)
      .val(element.id);

    if (element.group_name.length) {
      checkbox.prop("disabled", true);
    }

    //row.append($("<td>").html(checkbox));
    //row.append($("<td>").html(checkboxdownload));
    row.append($("<td>").text(i));
    row.append($("<td>").text(element.name_of_tribal));
    row.append($("<td>").text(element.vdvks));
    row.append($("<td>").text(element.name_of_proposed));
    row.append(
      $('<input class="category" type="hidden">').val(element.category)
    );
    row.append($("<td>").text(element.id_value));
    row.append($("<td>").text(element.gender));
    row.append($("<td>").text(group_name));
    row.append($("<td>").text(element.shg_name));
    row.append($("<td>").text(element.state_name));
    row.append($("<td>").text(element.district_name));
    row.append($("<td>").text(element.block_name));
    row.append($("<td>").text(element.village_name));
    row.append($("<td>").text(element.surveyor));
    const $td = $("<td>").addClass("action-area");
    if(element.pproposed_status=='')
          { 
    if (editShg) {
      var action = "../survey-forms/shg-gatherer-forms.php";
      var editLink = generateEditButton(action + "?id=" + element.id);
      $td.append(editLink);
    }
  }
    //if (viewShg) {
      var action2 = "../survey-forms/shg-gatherer-view.php";
      var viewLink = generateViewButton(action2 + "?id=" + element.id);
      $td.append(viewLink);
   // }
    if(element.pproposed_status=='')
          { 
    if (StatusShg) {
      var deleteLink = generateDeleteButton(element.id);
      $td.append(deleteLink);
    }
  }
    row.append($td);

    el.append(row);
    i++;
  });
}

function getSelectedIdsList(id) {
  const ids = [];
  $(id).each(function(i, el) {
    if ($(el).is(":checked")) {
      ids.push(el.value);
    }
  });
  return ids;
}

function getSTMemberCount(id) {
  var count = 0;
  $(id).each(function(i, el) {
    if ($(el).is(":checked")) {
      var cat = $(this)
        .parents("tr")
        .find(".category")
        .val();
      if (cat == 1) {
        count = count + 1;
      }
    }
  });
  return count;
}

function generateEditButton(href) {
  return $("<a>")
    .attr({
      "data-toggle": "tooltip",
      "data-placement": "top",
      title: "Edit",
      "data-original-title": "Edit",
      class: "data-view",
      href: href
    })
    .html($("<i>").addClass("fa fa-edit"));
}

function generateViewButton(href) {
  return $("<a>")
    .attr({
      "data-toggle": "tooltip",
      "data-placement": "top",
      title: "View",
      "data-original-title": "View",
      class: "data-view",
      href: href
    })
    .html($("<i>").addClass("fa fa-eye"));
}

function generateDeleteButton(id) {
  return $("<a>")
    .attr({
      "data-toggle": "tooltip",
      "data-placement": "top",
      title: "Delete",
      "data-original-title": "Delete",
      class: "data-view delete_shg_gatherers",
      id: id
    })
    .click(deleteShgHandler)
    .html($("<i>").addClass("fa fa-trash"));
}

function deleteShgHandler () {
  var id = this.id;
  if (!confirm("Are you sure you want to delete.")) {
    return;
  }

  var url = conf.deleteShgGathererData.url + id;
  //alert(url);
  var method = conf.deleteShgGathererData.method;
  var data = {};
  TRIFED.asyncAjaxHit(url, method, data, function(response, cb) {
    if (response.status) {
      if (response.status) {
        setTimeout(function() {
          location.reload();
        }, 1000); //Refresh page
        return TRIFED.showMessage(
          "success",
          "Shg Gatherers successfully Removed"
        );
        //return TRIFED.showMessage('success', response.data.message);
      }
      return TRIFED.showWarning("info", response.data.message);
    }
    TRIFED.showError("error", response.message);
  });
}

addShgGroup = () => {
  $("#create-sgh-group-form").on("submit", function(e) {
    e.preventDefault();

    var data = {};

    const ids = getSelectedIdsList(".selected_ids");

    data.title = $("#sgh-group-name")
      .val()
      .trim();
    data.bank_ac_no = $("#bank-ac-no")
      .val()
      .trim();
    data.ifsc_code = $("#ifcs_code")
      .val()
      .trim();
    data.total_corpus = $("#total_corpus")
      .val()
      .trim();
    data.coordinating_agency = $("#coordinating-agency").val();
    data.st_members = $("#num-st-member")
      .val()
      .trim();
    data.corpus_to_invest = $("#corpus-agreed-invent")
      .val()
      .trim();
    data.contact_person = $("#contact-person-coordating")
      .val()
      .trim();
    data.contact_person_mobile = $("#contact-person-mobile")
      .val()
      .trim();
    data.is_ajeevika = $("#is_ajeevika input:radio:checked").val();
    data.ajeevika_value = $("#ajeevika-id-number")
      .val()
      .trim();
    data.shg_group_no = $("#shg-group-no")
      .val()
      .trim();
    data.shgIds = ids;
    data.state = $('#shg_group_states').val();
    data.district = $('#shg_group_districtList').val();
    data.block = $('#shg_group_blocksList').val();

    var url = conf.addShgGroup.url;
    var method = conf.addShgGroup.method;

    TRIFED.asyncAjaxHit(url, method, data, function(response) {
      if (response.status == 1) {
        // $('#create-sgh-group-form')[0].reset();
        // $('#create-sgh-group').modal('hide');
        TRIFED.showMessage("success", "Successfully Added");
        setTimeout(() => {
          window.location = "../survey-forms/create-shg-group.php";
        }, 1000);
      } else {
        TRIFED.showError("error", response.message);
      }
    });
  });
};

fetchCoordinatingAgency = () => {
  var url = conf.getCoordinatingAgencyList.url;
  var method = conf.getCoordinatingAgencyList.method;
  var data = {};
  TRIFED.asyncAjaxHit(url, method, data, function(response, cb) {
    if (response) {
      addressData = response.data;
      fillCoordinatingAgency(response.data);
    } else {
      TRIFED.showMessage("error", cb);
    }
  });
};

fillCoordinatingAgency = coordinating => {
  html = '<option value="0">Select Coordinating</option>';
  $.each(coordinating, function(i, coor) {
    html += '<option value="' + coor.id + '">' + coor.title + "</option>";
  });
  $("#coordinating-agency").html(html);
};

function importExcelFile() {
  $("#importExcel").on("click", function(e) {
    e.preventDefault();
    var url = conf.importShgGathererExcel.url;
    var method = conf.importShgGathererExcel.method;
    const state = $("#stateMaster").val();
    var file = $("#import_file").prop("files")[0];
    var data = new FormData();
    if (isNaN(state) == false && state.length) {
      data.append("state", state);
    } else {
      alert("Please select State.");
      return;
    }
    data.append("import_file", file, file.name);

    TRIFED.fileAjaxHit(url, method, data, function(r) {
      if (r.status == 1) {
        TRIFED.showMessage("success", "Successfully Added");
        setTimeout(function() {
          location.reload();
        }, 500);
      } else {
        $("#file_errors")
          .html(r.message)
          .css("color", "red");
          $(".fa-spinner").hide();
        TRIFED.showError("error", r.message);
      }
    });
  });
}

$("#shg-group").on("click", function(e) {
  e.preventDefault();

  var st_members_count = getSTMemberCount(".selected_ids");
  $("#num-st-member").val(st_members_count);
  $("#create-sgh-group").modal();
});

$("#stateMasterBulk").on("change", function() {
  if($(this).val()==''){
    $('#districtList').val('');
    $('#blocksList').val('');
  }

  utils.getDistricts(this.value, function(records) {
    utils.renderOptionElements("#districtList", records.data);
  });
});


$("#districtList").on("change", function() {
  if($(this).val()==''){
    $('#blocksList').val('');
  }
  utils.getBlocks(this.value, function(records) {
    utils.renderOptionElements("#blocksList", records.data);
  });
});

$("#shg_group_states").on("change", function() {
  if($(this).val()==''){
    $('#shg_group_districtList').val('');
    $('#shg_group_blocksList').val('');
  }

  utils.getDistricts(this.value, function(records) {
    utils.renderOptionElements("#shg_group_districtList", records.data);
  });
});
$("#shg_group_districtList").on("change", function() {
  if($(this).val()==''){
    $('#shg_group_blocksList').val('');
  }
  utils.getBlocks(this.value, function(records) {
    utils.renderOptionElements("#shg_group_blocksList", records.data);
  });
});
filterHideEvent = () => {
  var authUser = TRIFED.getLocalStorageItem();

  if (authUser && authUser.role === 7) {
    /*SIO*/
    $("#stateMasterBulk")
      .val(authUser.state_id)
      .trigger("change");
    $("#stateMasterBulk").prop("disabled", true);
  }

  if (authUser && authUser.role === 13) {
    /*DIO*/
    $("#stateMasterBulk")
      .val(authUser.state_id)
      .trigger("change");
    $("#stateMasterBulk").prop("disabled", true);

    $("#districtList")
      .val(authUser.district_id)
      .trigger("change");
    $("#districtList").prop("disabled", true);
  }
};

var searchEvent = () => {
  $("#search").on("click", function() {
    var data = getFilterData();
    getShgGatherersList(data);
  });
};

$("#exportExcel").on("click", function(e) {
  e.preventDefault();
 var myCheckboxes = new Array();
        $('.select_ids:checked').each(function() {
          if ($(this).val()!='') {
           myCheckboxes.push($(this).val());
         }
        });
       // alert(myCheckboxes); return false;
if(myCheckboxes !=''){
  var url = conf.exportShgGathererData.url;
  var method = conf.exportShgGathererData.method;
  var data = {'myCheckboxes':myCheckboxes};

  TRIFED.asyncAjaxHit(url, method, data, function(response, cb) {
    window.location.href = endpoint + "" + response.data.file;
  });
}
else
{
  alert('Please Select SHG Gatherer Listing');
}
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


function getFilterData() {
  var state = $("#stateMasterBulk").val();
  var district = $("#districtList").val();
  var block = $("#blocksList").val();
  var village = $("#villageID").val();
  var surveyor = $("#surveyorID").val();
  var pincode = $("#pincode").val();
  var data = {
    state: isNaN(state) ? null : state,
    district: isNaN(district) ? null : district,
    block: isNaN(block) ? null : block,
    village: isNaN(village) ? null : village,
    surveyor: isNaN(surveyor) ? null : surveyor,
    pincode: isNaN(pincode) ? null : pincode,
  };
  return data;
}


function searchItems() {
  let term = $("#queryTerm").val();
  paginatedFilter.q = term;
  getShgGatherersList();
}