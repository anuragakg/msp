const wordDictionary = {
  shg: "SHG",
  pmvdy: "VDY",
  mo: "Mentoring Organisation",
  mis: "MIS",
  mfp: "MFP",
  vdvk: "VDVK",
};


window.utils = {
  /**
   * Get Notification
   * @param {callback} callback Function to be executed
   */
  getNotifications(clickEvent = false) {
    var url2 = conf.getNotificationCount.url;
    var method2 = conf.getNotificationCount.method;

    let data = {};

    TRIFED.asyncAjaxHit(url2, method2, data, function(response, cb) {
      if (response) {
        $(".notification-count").html(response.data.count);
        utils.setRoleInToken(response.data.role);
      }
      return true;
    });
  },

  setRoleInToken(role){
    var auth = TRIFED.getLocalStorageItem();
    auth.role = role;
    localStorage.setItem('authUser', JSON.stringify(auth));
  },
  /**
   * Get Districts based on state
   * @param {string} id State ID
   * @param {callback} callback Function to be executed
   */
  getDistricts(id, callback) {
    var url = conf.getDistricts.url;
    var method = conf.getDistricts.method;
    var data = {
      state_id: id,
    };
    TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
      if (response) {
        return callback(response);
      }
      callback(null);
    });
  },

  getBlocks(id, callback) {
    var url = conf.getBlocks.url;
    var method = conf.getBlocks.method;
    var data = {
      district_id: id,
    };
    TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
      if (response) {
        return callback(response);
      }
      callback(null);
    });
  },
  /**
   * Renders Options Element
   * @param {string} id Element ID/Class Name
   * @param {array} records Records
   * @param {string} field Title Field
   */
  renderOptionElements(id, records, field = "title") {
    const el = $("select" + id);
    el.html("");
    el.append($("<option>").text("Please Select").val(""));
    records.forEach((element) => {
      el.append($("<option>").val(element.id).text(element[field]));
    });
  },

  /**
   * Renders Options Category Element
   * @param {string} id Element ID/Class Name
   * @param {array} records Records
   * @param {string} field Title Field
   */
  renderOptionCategoryElements(id, records, field = "title") {
    const el = $("select" + id);
    el.html("");
    el.append($("<option>").text("Select Category").val(""));
    records.forEach((element) => {
      el.append($("<option>").val(element.id).text(element[field]));
    });
  },

  /**
   * Renders Options Vdvk Element
   * @param {string} id Element ID/Class Name
   * @param {array} records Records
   * @param {string} field Title Field
   */
  renderOptionVdvkElements(id, records, field = "kendra_name") {
    const el = $("select" + id);
    el.html("");
    el.append($("<option>").text("Select Vdvk Type").val(""));
    records.forEach((element) => {
      el.append($("<option>").val(element.id).text(element[field]));
    });
  },

  /**
   * Renders Options Category Element
   * @param {string} id Element ID/Class Name
   * @param {array} records Records
   * @param {string} field Title Field
   */
  renderOptionStateElements(id, records, field = "title") {
    const el = $("select" + id);
    el.html("");
    el.append($("<option>").text("Select State").val(""));
    records.forEach((element) => {
      el.append($("<option>").val(element.id).text(element[field]));
    });
  },

  /**
   * Renders Radio Element
   * @param {string} id Element ID/Class Name
   * @param {array} records Records
   * @param {string} field Title Field
   */
  renderInputElements(id, records, field = "title", type) {
    const el = $(id);
    el.html("");
    $.each(records, (index, element) => {
      el.append(
        $("<div class='i-checks radio-inline'>").append(
          $("<label>")
            .append(
              $("<input>")
                .attr("type", type)
                .attr("name", field)
                .val(element.id)
            )
            .append($("<i>"))
            .append(" " + element.title)
        )
      );
    });

    $(".i-checks").iCheck({
      checkboxClass: "icheckbox_square-green",
      radioClass: "iradio_square-green",
    });
  },

  /**
   * Shows no records found in table.
   * @param {Dom} el Table body element.
   * @param {*} colspan Amount of column spanning. Default is 8
   */
  noRecordsFound(el, colspan = 8) {
    const $tr = $("<tr>");
    const $td = $("<td>")
      .attr({
        colspan: colspan,
      })
      .css("text-align", "center");
    $td.text("No Records Found");
    return el.html($tr.html($td));
  },

  /**
   * Gets unit master
   * @param {function} callback Callback function to be executed.
   */
  getUnitMaster(callback) {
    var url = conf.getUnitsList.url;
    var method = conf.getUnitsList.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
      if (response) {
        return callback(response);
      }
      callback(null);
    });
  },
  /**
   * Gets state master
   * @param {function} callback Callback function to be executed.
   */
  getStateMaster(callback) {
    var url = conf.getStates.url;
    var method = conf.getStates.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
      if (response) {
        return callback(response);
      }
      callback(null);
    });
  },

  /**
   * Finds and process links to create absolute url to api.
   */
  processApiLinks() {
    const links = $(".apiLink");
    if (links.length) {
      links.each(function (i, el) {
        const href = $(el).attr("href");
        $(el).attr("href", endpoint + href);
      });
    }
  },

  /**
   * Resets selected records
   * @param {array} data
   */
  resetSelected(data) {
    data.forEach((v) => {
      v.sel = false;
    });
  },

  setSelected(data, field, value) {
    data.forEach((v) => {
      if (String(v[field]) == String(value)) {
        v.sel = true;
      }
    });
  },
  /*
   * Common ajax function
   * @param {string} conf Config Name
   * @param {string} query Config Url Parameter
   * @param {mixed} data Data to be passed
   * @param {function} callback callback function with data
   */
  commonAjax(confName, query = null, data = {}, callback) {
    var url = conf[confName].url;
    var method = conf[confName].method;

    if (typeof url == "function") {
      url = url(query);
    }

    TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
      if (response) {
        return callback(response);
      }
      callback(null);
    });
  },

  toggleStatus(id, toggleApi, element) {
    const el = $(element);
    utils.changeStatusApi(id, toggleApi, function (r) {
      utils.toggleElementState(r, el);
    });
  },

  changeStatusApi(id, toggleApi, callback) {
    let { url, method } = toggleApi;

    TRIFED.asyncAjaxHit(url(id), method, {}, function (response, cb) {
      if (response.status) {
        callback(response.data);
      } else {
        TRIFED.showMessage("error", cb);
      }
    });
  },

  toggleElementState(r, element) {
    if (r.status == 1) {
      element
        .attr({
          class: "data-active",
        })
        .text(" Active");
      return TRIFED.showMessage("success", r.message);
    }
    element
      .attr({
        class: "data-inactive",
      })
      .text(" Inactive");
    return TRIFED.showWarning("info", r.message);
  },

  /**
   * Generates query object
   */
  getQueryObj() {
    const queryParam = window.location.search.substr(1);
    return new URLSearchParams(queryParam);
  },

  generateLink(name, link) {
    return $("<a>").attr("href", link).text(name);
  },

  generateAbbreviation(rolename) {
    let split_names = rolename.trim().split(" ");
    let result = "";

    if (split_names.length > 1) {
      $.each(split_names, function (i, data) {
        result += split_names[i].charAt(0);
      });
      return rolename + " (" + result + ")";
    }

    return rolename;
  },

  /**
   * Processes mustache templates.
   * @param {object} mustacheTemplates
   */
  processMustacheTemplates(mustacheTemplates) {
    for (template in mustacheTemplates) {
      const source = $(mustacheTemplates[template]).html();
      mustacheTemplates[template] = source;
      Mustache.parse(source);
    }
  },
  openPdfInNewTab() {
    $(
      "a[target!='_blank'][href$='.pdf'], a[target!='_blank'][href$='.jpeg']"
    ).attr("target", "_blank");
  },

  /**
   * Formats currency
   * @param {number} amount
   */
  formatCurrency(amount) {
    let formattedAmount = new Intl.NumberFormat("en-IN", {
      currency: "INR",
      // style: "currency"
      minimumFractionDigits: 4,
    }).format(amount);

    return "Rs. " + formattedAmount;
  },

  formatAmount(amount) {
    let formattedAmount = new Intl.NumberFormat("en-IN", {
      currency: "INR",
      // style: "currency"
      minimumFractionDigits: 4,
    }).format(amount);

    return formattedAmount;
  },

  fetchVillage(value) {
    var minlength = 6;
    if (value.length == minlength) {
      var url = conf.getVillage.url + value;
      var method = conf.getVillage.method;
      var data = {};
      TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
        if (response.data) {
          if (response.data.length >= 1) {
            renderOptionElements(".village", response.data);
            return true;
          } else {
            renderOptionElements(".village", response.data);
            return TRIFED.showWarning(
              "info",
              "No village found for this Pin Code"
            );
          }
        }
      });
    }
  },

  /**
   * Renders simple pagination
   * @param {object[]} records
   * @param {string} selector
   * @param {function} callback
   */
  renderSimplePagination(records, selector, callback) {
    let { total, current_page, next, previous, per_page } = records;
    let ul = $("<ul>").attr("class", "pagination");
    let paginationAmount = $("#pagination-amount");

    let maxPages = Math.ceil(total / per_page);

    if (typeof callback != "function") {
      return;
    }

    if (previous) {
      let li = $("<li>").on("click", function () {
        callback.call(this, {
          page: current_page - 1,
          per_page: paginationAmount.val(),
        });
      });
      ul.append(li.html($("<a>").text("Previous")));

      let liFirst = $("<li>").on("click", function () {
        callback.call(this, {
          page: 1,
          per_page: paginationAmount.val(),
        });
      });
      // ul.append(liFirst.html($("<a>").text("First")));
    }

    let startPagination, maxLinks, showLastLinks;

    showLastLinks = true;

    if (current_page < 5) {
      startPagination = 1;
      maxLinks = 15;
      if (15 > maxPages) {
        maxLinks = maxPages;
        showLastLinks = false;
      }
    } else {
      startPagination = current_page - 5;
      if (startPagination == 0) {
        startPagination++;
      }
      maxLinks = current_page + 10;
      if (maxLinks > maxPages) {
        showLastLinks = false;
        maxLinks = maxPages;
      }
    }

    for (let i = startPagination; i <= maxLinks; i++) {
      let li = $("<li>");
      if (i == current_page) {
        li.addClass("active");
      }
      li.on("click", function () {
        callback.call(this, {
          page: i,
          per_page: paginationAmount.val(),
        });
      });
      ul.append(li.html($("<a>").text(i)));
    }

    if (showLastLinks) {
      let liDot = $("<li>");
      ul.append(liDot.html($("<a>").text("...")));

      let li = $("<li>");
      li.on("click", function () {
        callback.call(this, {
          page: maxPages,
          per_page: paginationAmount.val(),
        });
      });
      ul.append(li.html($("<a>").text(maxPages)));
    }

    if (next) {
      let li = $("<li>");
      li.on("click", function () {
        callback.call(this, {
          page: current_page + 1,
          per_page: paginationAmount.val(),
        });
      });
      ul.append(li.html($("<a>").text("Next")));
    }
    let totalPages = Math.ceil(total / per_page);
    let span = $('<span style="display:block">').text(
      `Page ${current_page} of ${totalPages}, Total Records : ${total}`
    );
    $(selector).html(span).append(ul);
  },

  /**
   * Renders per page listing.
   *
   * @param {function} callback
   */
  addPerPageListing(callback,custom_page='') {
    let start, step, max;
    let element = $("#per-page-pagination").attr({
      class: "dataTables_length",
    });
    let label = $("<label>");
    let select = $("<select>").attr({
      class: "form-control input-sm",
      id: "pagination-amount",
    });

    select.on("change", function () {
      let paramFilter = {
        per_page: this.value,
      };

      if (typeof paginatedFilter == "object") {
        Object.assign(paramFilter, paginatedFilter);
      }

      callback.call(this, paramFilter);
    });

    start = 20;
    step = 20;
    max = 1000;
    if(custom_page){
      start = custom_page;
      step = custom_page;
    }
    for (let i = start; i <= max; i += step) {
		var selected=i==start?'selected':'';
      let option = $("<option "+selected+">").val(i).text(i);
      select.append(option);
    }
    label.html('Show ');
    label.append(select);
    label.append(" entries")
    element.html(label);
  },

  /**
   * Set selected values for Icheck checkboxes.
   *
   * @param {string} selector
   * @param {mixed} value
   */
  setCheckedOption(selector, value) {
    $(selector).each(function (i, element) {
      $(element).iCheck("uncheck");
      if (String(value) == element.value) {
        $(element).iCheck("check");
      }
    });
  },

  titleCase(string) {
    var sentence = string.toLowerCase().split(" ");
    for (var i = 0; i < sentence.length; i++) {
      sentence[i] = sentence[i][0].toUpperCase() + sentence[i].slice(1);
    }
    document.write(sentence.join(" "));
    return sentence;
  },

  applyDictionary(string) {
    let pieces = string.split(" ");
    let wordArray = pieces.map(function (word) {
      let lowerCase = word.toLowerCase();
      return wordDictionary[lowerCase] ? wordDictionary[lowerCase] : word;
    });
    return wordArray.join(" ");
  },

  mustacheHelpers: {
    currency: function () {
      return function (text, render) {
        return utils.formatCurrency(render(text));
      };
    },
  },

  getIntValue(value) {
    let intValue = parseFloat(value).toFixed(2);
    return isNaN(intValue) ? 0 : parseFloat(intValue);
  },

  paginatedSelect2(element, confName, processRecords) {
    var auth = TRIFED.getLocalStorageItem();
    element.select2({
      ajax: {
        url: conf[confName].url,
        dataType: "json",
        delay: 250,
        headers: {
          Authorization: "Bearer " + auth.token,
        },
        processResults: function (response) {
          let t = {
            results: response.data.records.map(processRecords),
            pagination: {
              more: response.data.next != null,
            },
          };
          return t;
        },
      },
    });
  },
};

window.ajax = function (confName, query = null, data = {}) {
  const { url, method } = conf[confName];
  if (typeof url == "function") {
    url = url(query);
  }

  var auth = TRIFED.getLocalStorageItem();
  if (auth === null) {
    auth = {};
    auth.token = null;
  }

  return $.ajax({
    url: url,
    method: method,
    data: data,
    headers: {
      Authorization: "Bearer " + auth.token,
    },
  });
};
