$(function() {
  //getRoles();
  getPermissions();  
  getSetPermission();
  var url_var=getUrlVars(); 
  role_id=url_var['id'];
  if (role_id != undefined && role_id != '') {
    $("#role_id").val(role_id);
      fetchRole(role_id);
  }
});

 
fetchRole = (role_id) => {
  var url = conf.viewRole.url(role_id);
  var method = conf.viewRole.method;
  var data = {};
  TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
    if (response) {
      data = response.data;  
      $(".roleTitle").html(data.title);
    } else {
      TRIFED.showMessage('error', cb);
    }
  });
}
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
 function getSetPermission() { 
  $(".permissions").each(function() {
    this.checked = false;
  });
  var url_var=getUrlVars();  
  var role_id = url_var['id'];
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
        $("#permission-" + permission_id).prop("disabled", "disabled");
      });
      afterSettingPermissions();
    }
  });
} 

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
      $("#" + permission).prop("disabled", "disabled");
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