var editMaster = TRIFED.checkPermissions("master_management_edit");
var viewMaster = TRIFED.checkPermissions("master_management_view");
var addMaster = TRIFED.checkPermissions("master_management_add");
var statusMaster = TRIFED.checkPermissions("master_management_status");


$(function() {
  var url_var=getUrlVars(); 
  state_id=url_var['state'];
  queryTerm=url_var['q'];
  // TRIFED.checkToken();

 
  addCommodity();
  editCommodity();
  updateData();
  utils.getUnitMaster(function(res) {
    utils.renderOptionElements("#unitMaster", res.data);
    utils.renderOptionElements(".unitMaster", res.data);
  });
  utils.getStateMaster(function(res) {
    utils.renderOptionElements("#stateMaster", res.data);
    utils.renderOptionElements("#state", res.data);
    utils.renderOptionElements(".stateMaster", res.data);
  });
   if(viewMaster){
      fetchCommodityList();
  }
  renderSessions();
});

fetchCommodityList = () => {
  var url = conf.getCommodityList.url;
  var method = conf.getCommodityList.method;
  const data = {};    
    var state = $('#state').val();
    data.status=1;
    data.state=isNaN(state) ? null : state;
    data.queryTerm=$('#queryTerm').val(); 
    data.common=$('#common').val(); 
  TRIFED.asyncAjaxHit(url, "GET", data, function(response, cb) {
    if (response) {
      addressData = response.data;
      fillCommodityList(response.data);
    } else {
      TRIFED.showMessage("error", cb);
    }
  });
};

fillCommodityList = data => {
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
      data.title +
      "</td>" +
      '</td><td id="row-data">' +
      data.state_name +
      "</td>" +
      '</td><td id="row-data">' +
      data.unit_name +
      "</td>" +
      '</td><td id="row-data">' +
      data.common_name +
      "</td>" +
      '</td><td id="row-data">' +
      data.lab_name +
      "</td>" +
      '<td class="action-area">';
      if(editMaster){
         html += '<a href="#" class="data-edit" data-toggle="tooltip" data-role="update" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>';
      }
     html += "</td><tr>";
  });
  $("#commodity-table tbody").html(html);
};

addCommodity = () => {
  $("#formID").on("submit", function(e) {
    $("#submitButton").attr("disabled", true);
    e.preventDefault();
    let data = {};

    data = new FormData(this);

    var url = conf.addCommodity.url;
    var method = conf.addCommodity.method;

    makeAjaxRequest(method, data, url, "Successfully Added");
  });
};

editCommodity = () => {
  $(".data-edit").on("click", function(e) {
    e.preventDefault();
    var id = "";
    id = $(this)
      .parents("tr")
      .attr("id");
    var url = conf.getCommodityData.url + id;
    var method = conf.getCommodityData.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, method, data, function(response, cb) {
      if (response) {
        addressData = response.data;
        fillCommodityData(addressData);
      } else {
        TRIFED.showMessage("error", cb);
      }
    });
  });
};

fillCommodityData = data => {
  $("#editModal").modal("show");
  fillInputBoxes(data);

  $("#updateID").val(data["id"]);
};

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
          document.location = "commodity-master.php";
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
  let whiteList = ["title", "common_name", "lab_name", "msp"];
  whiteList.forEach(v => {
    $('input.update[name="' + v + '"]').val(data[v]);
  });

  setCheckboxSelection(".stateMaster.update", data.state);
  setCheckboxSelection(".unitMaster.update", data.unit);
  setCheckboxSelection(".sessionMaster.update", data.session);
}

function setCheckboxSelection(id, value) {
  if (Array.isArray(value)) {
    value.forEach(v => {
      let item = $(id).find('option[value="' + v + '"]');
      item.attr("selected", "selected");
    });
    return;
  }
  $(id)
    .find('option[value="' + value + '"]')
    .attr("selected", "selected");
}

updateData = () => {
  $("#updateForm").on("submit", function(e) {
    e.preventDefault();
    const id = $("#updateID").val();
    if (!id) {
      return;
    }

    const { url } = conf.updateCommodityData;

    const data = new FormData(this);

    data.append("_method", "PUT");

    makeAjaxRequest("POST", data, url + id, "Successfully Updated");
  });
};


$('#search').on('click',function(){    
       
    fetchCommodityList();
    
  })
 

const yearMonths = [
  "January",
  "February",
  "March",
  "April",
  "May",
  "June",
  "July",
  "August",
  "September",
  "October",
  "Nov",
  "December"
];
function renderSessions() {
  const sessions = yearMonths;
  let sessionObj = sessions.map(function(v, i) {
    return {
      id: i + 1,
      title: v
    };
  });
  utils.renderOptionElements("#sessionMaster", sessionObj);
  utils.renderOptionElements(".sessionMaster", sessionObj);
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
