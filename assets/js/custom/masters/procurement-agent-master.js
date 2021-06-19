var editMaster = TRIFED.checkPermissions("master_management_edit");
var viewMaster = TRIFED.checkPermissions("master_management_view");
var addMaster = TRIFED.checkPermissions("master_management_add");
var statusMaster = TRIFED.checkPermissions("master_management_status");

$(function() {
  // TRIFED.checkToken();
  if(viewMaster){
     fetchProcurementAgentList();
  }
  addProcurementAgent();
  editProcurementAgent();
  updateData();
  utils.getStateMaster(function(res) {
    utils.renderOptionElements("#stateMaster", res.data);
    utils.renderOptionElements(".stateMaster", res.data);
  });

  attachEventHandlers();
});

fetchProcurementAgentList = () => {
  var url = conf.getProcurementAgentListMaster.url;
  var method = conf.getProcurementAgentListMaster.method;
  var data = {};
  TRIFED.asyncAjaxHit(url, "GET", data, function(response, cb) {
    if (response) {
      addressData = response.data;
      fillProcurementAgentList(response.data);
    } else {
      TRIFED.showMessage("error", cb);
    }
  });
};

fillProcurementAgentList = data => {
  var html = "";
  $.each(data, function(i, data) {
    html +=
      '<tr id="' +
      data.id +
      '" ><td data-id="' +
      data.id +
      '">' +
      ++i +
      '</td><td id="row-data">' +
      data.name +
      "</td>" +
      '<td id="row-data">' +
      data.mobile_no +
      "</td>" +
      '<td id="row-data">' +
      data.landline_no +
      "</td>" +
      '<td id="row-data">' +
      data.address +
      "</td>" +
      '<td id="row-data">' +
      data.state_name +
      "</td>" +
      '<td id="row-data">' +
      data.district_name +
      "</td>" +
      '<td id="row-data">' +
      data.block_name +
      '<td class="action-area">';
      if(editMaster){
       html += '<a href="#" class="data-edit" data-toggle="tooltip" data-role="update" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>';
      }
     html += "</td><tr>";
  });
  $("#procurement-agent-table tbody").html(html);
};

addProcurementAgent = () => {
  $("#formID").on("submit", function(e) {
    $("#submitButton").attr("disabled", true);
    e.preventDefault();
    let data = {};

    data = new FormData(this);

    var url = conf.addProcurementAgent.url;
    var method = conf.addProcurementAgent.method;

    makeAjaxRequest(method, data, url, "Successfully Added");
  });
};

editProcurementAgent = () => {
  $(".data-edit").on("click", function(e) {
    e.preventDefault();
    var id = "";
    id = $(this)
      .parents("tr")
      .attr("id");
    var url = conf.getProcurementAgentData.url + id;
    var method = conf.getProcurementAgentData.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, method, data, function(response, cb) {
      if (response) {
        addressData = response.data;
        fillProcurementAgentData(addressData);
      } else {
        TRIFED.showMessage("error", cb);
      }
    });
  });
};

fillProcurementAgentData = data => {
  $("#editModal").modal("show");
  fillInputBoxes(data);

  $("#updateID").val(data["id"]);
};

function attachEventHandlers() {
  /** creating */
  $("#stateMaster").on("change", function () {
    utils.getDistricts(this.value, function (records) {
      utils.renderOptionElements("#districtMaster", records.data);
    });
  });
  $("#districtMaster").on("change", function () {
    utils.getBlocks(this.value, function (records) {
      utils.renderOptionElements("#blockMaster", records.data);
    });
  });

  /** updating */

  $(".stateMaster.update").on("change", function() {
    utils.getDistricts(this.value, function(records) {
      utils.renderOptionElements(".districtMaster.update", records.data);
    });
  });
  $(".districtMaster.update").on("change", function() {
    utils.getBlocks(this.value, function(records) {
      utils.renderOptionElements(".blockMaster.update", records.data);
    });
  });
  
}

function makeAjaxRequest(method, data, url, message = "Success") {
  $.ajax({
    method: method,
    data: data,
    url: url,
    contentType: false,
    processData: false,
    headers: {
      "Authorization": 'Bearer ' + TRIFED.getLocalStorageItem().token
    },
    success: function(response) {
      if (response.status == 1) {
        $("#formID")[0].reset();
        TRIFED.showMessage("success", message);
        setTimeout(function() {
          document.location = "procurement-agent-master.php";
        }, 500);
      } else {
        TRIFED.showError("error", response.message);
        $("#submitButton").attr("disabled", false);
      }
    },
    error: function(err) {
      TRIFED.showError("error", err.responseJSON.message);
      $("#submitButton").attr("disabled", false);
    }
  });
}

function fillInputBoxes(data) {
  let whiteList = ["name", "mobile_no", "landline_no", "address"];
  whiteList.forEach(v => {
    $('input.update[name="' + v + '"]').val(data[v]);
  });



  setCheckboxSelection(".stateMaster.update", data.state);
  setCheckboxSelection(".districtMaster.update", data.district);
  setCheckboxSelection(".blockMaster.update", data.block);
}

function setCheckboxSelection(id, value) {
  if (Array.isArray(value)) {
    value.forEach(v => {
      let item = $(id).find('option[value="' + v + '"]');
      item.attr("selected", "selected");
    });
    $(id).trigger("change");
    return;
  }
  $(id)
    .find('option[value="' + value + '"]')
    .attr("selected", "selected");
  $(id).trigger('change');
}

updateData = () => {
  $("#updateForm").on("submit", function(e) {
    e.preventDefault();
    const id = $("#updateID").val();
    if (!id) {
      return;
    }

    const { url } = conf.updateProcurementAgentData;

    const data = new FormData(this);
    data.append('_method', 'PUT')
    makeAjaxRequest("POST", data, url + id, "Successfully Updated");
  });
};
