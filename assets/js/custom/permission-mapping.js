$(function() {
  getRoles();
  
});
$('#role_id').on('change',function(){
    getPermissions();
});
const mustacheTemplates = {
  permission: "#listPermission",
  permissionHeading: "#listPermissionHeading"
};

const permissionGroups = [];

function processMustacheTemplates() {
  for (template in mustacheTemplates) {
    const source = $(mustacheTemplates[template]).html();
    mustacheTemplates[template] = source;
    Mustache.parse(source);
  }
}

processMustacheTemplates();

getRoles = () => {
  var url = conf.getRolesList.url;
  var method = conf.getRolesList.method;
  var data = {};
  var options = "";
  options +='<option value="">Select Role</option>';
  TRIFED.asyncAjaxHit(url, method, data, function(response, cb) {
    if (response) {
      $.each(response.data, function(i, data) {
        
        options +=
          '<option value="' +
          data.id +
          '" >' +
          utils.generateAbbreviation(data.title) +
          "</option>";
      });
      $("#role_id").html(options);
    }
  });
};
getPermissions = () => {
  var url = conf.getPermissionList.url;
  var method = conf.getPermissionList.method;
  var data = {};
  var options = "";
  TRIFED.asyncAjaxHit(url, method, data, function(response, cb) {
    if (response) {
      renderPermissions(response.data);
      return;
    }
  });
};

function renderPermissions(data) {
  $("#permission_container").html("");
  let index = 1;
  for (const group in data) {
    permissionGroups.push(group);
    const _data = {
      index: index,
      type: "th",
      name: utils.applyDictionary(ucFirstAllWords(group)),
      group: group
    };
    appendRow(mustacheTemplates.permissionHeading, _data);
    if (Array.isArray(data[group])) {
      data[group].forEach(v => {
        const data = {
          name: v.name,
          group: group,
          type: "td",
          id: v.id
        };
        appendRow(mustacheTemplates.permission, data);
      });
    }
    index++;
  }
}

function ucFirstAllWords( str )
{
    var pieces = str.split("_");
    for ( var i = 0; i < pieces.length; i++ )
    {
        var j = pieces[i].charAt(0).toUpperCase();
        pieces[i] = j + pieces[i].substr(1);
    }
    return pieces.join(" ");
}

function appendRow(template, _data) {
  const rendered = Mustache.render(template, _data);
  $("#permission_container").append(rendered);
}

function check_uncheck_checkbox(isChecked) {
  if (isChecked) {
    $('input[name="permission_id[]"]').each(function() {
      this.checked = true;
    });
  } else {
    $('input[name="permission_id[]"]').each(function() {
      this.checked = false;
    });
  }
}

/**
 * Renders option element
 * @param {string} id ID
 * @param {Array} records
 */
function renderOptionElements(id, records) {
  const el = $("select" + id);
  el.html("");
  el.append($('<option value="">').text("Please Select"));
  records.forEach(element => {
    el.append(
      $("<option>")
        .val(element.id)
        .text(element.title)
    );
  });
}
$("#role_id").on("change", function() {
  $(".permissions").each(function() {
    this.checked = false;
  });

  var role_id = $(this).val();
  var url = conf.getRolesMapping.url(role_id);
  var method = conf.getRolesMapping.method;
  var data = {};
  var options = "";
  TRIFED.asyncAjaxHit(url, method, data, function(response, cb) {
    if (response) {
      response_data = response.data;
      $.each(response_data, function(i, item) {
        var permission_id = response_data[i].permission_id;
        $("#permission-" + permission_id).prop("checked", true);
      });
      afterSettingPermissions();
    }
  });
});
$(document).ready(function() {
  $("#formId").validate({
    rules: {
      role_id: "required"
    },
    messages: {
      role_id: "Please select role"
    }
  });

  $("#save").click(function() {
    if ($("#formId").valid()) {
      var url = conf.addRolesMapping.url;
      var method = conf.addRolesMapping.method;
      var data = $("#formId").serializeArray();
      TRIFED.asyncAjaxHit(url, method, data, function(response) {
        if (response.status == 1) {
          response_data = response.data;

          TRIFED.showMessage("success", "Successfully Added");

          setTimeout(() => {}, 1000);
        } else {
          TRIFED.showError("error", response.message);
          z = false;
        }
      });
    }
  });
});

function ucFirst(s) {
  if (typeof s !== "string") return "";
  return s.charAt(0).toUpperCase() + s.slice(1);
}

function selectGroup(group, checked) {
  $("." + group).each(function(i, v) {
    v.checked = checked;
  });
}

function afterSettingPermissions() {
  toggleMasterPermissions();
}

function toggleMasterPermissions() {
  permissionGroups.forEach(permission => {
    const all = $(".permissions." + permission).length;
    const checked = $(".permissions." + permission + ":checked").length;
    if (all == checked) {
      $('#' + permission).prop("checked", true);
    }
  });
}
