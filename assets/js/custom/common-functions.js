window.TRIFED = {
    /*
    ------------------------------------------------------------------------------
    |   This code block is used to store API token,
    |   and data related to user, these are global variable 
    |   to store user data and can be used in any pages.
    ------------------------------------------------------------------------------
    */
    excludedKeyCodes: [8, 9, 13, 16, 17, 20, 27, 33, 34, 37, 38, 39, 40, 46],

    siteManagementId: undefined,

    siteName: undefined,

    checkToken: function () {
        var auth = {};
        var auth = TRIFED.getLocalStorageItem();
        if (auth == null) {

            //window.location.href = "login.php";

           // window.location.href = "login.php";

        }
        return auth;
    },

    /*
    ------------------------------------------------------------------------------
    |   This code block is used to check response of API,
    |   to use this function we need to pass only one parameter 
    |   response in which we have our API response.
    ------------------------------------------------------------------------------
    */
    checkStatus: function (response) {
        if (response.status == 1) {
            return true;
        } else if (response.status == 0) {
            TRIFED.showMessage('error', response.message);
        }
    },

    /*
    ------------------------------------------------------------------------------
    |   This code block is used to retrieve session items,
    |   stored on local storage.
    ------------------------------------------------------------------------------
    */
    getLocalStorageItem: function () {
        return JSON.parse(localStorage.getItem('authUser'));
    },


    getCustomerId: function () {
        return TRIFED.getUrlParameters().customerId;
    },


    setCustomerId: function (id) {
        $('#customer-details-menu').attr('href', $('#customer-details-menu').attr('href') + '?customerId=' + id);
        $('#site-management-menu').attr('href', $('#site-management-menu').attr('href') + '?customerId=' + id);
        $('#insurance-menu').attr('href', $('#insurance-menu').attr('href') + '?customerId=' + id);;
        $('#case-list-menu').attr('href', $('#case-list-menu').attr('href') + '?customerId=' + id);;
        $('#audit-trail-menu').attr('href', $('#audit-trail-menu').attr('href') + '?customerId=' + id);;
    },

    setSiteInUrls: function (id) {
        // $('#customer-details-menu').attr('href', $('#customer-details-menu').attr('href') + '&siteId=' +id);
        site_management = $('#site-management-menu');
        case_list = $('#case-list-menu')
        insurance_menu = $('#insurance-menu')
        audit_trail = $('#audit-trail-menu')
        if (site_management.attr('href').indexOf('&') == -1) {
            // site_management.attr('href', site_management.attr('href') + '&siteId=' +id);
            insurance_menu.attr('href', insurance_menu.attr('href') + '&siteId=' + id);
            case_list.attr('href', case_list.attr('href') + '&siteId=' + id);
            audit_trail.attr('href', audit_trail.attr('href') + '&siteId=' + id);
        } else {
            // site_management.attr('href', site_management.attr('href').substr(0, site_management.attr('href').indexOf('&')) + '&siteId=' +id);
            insurance_menu.attr('href', insurance_menu.attr('href').substr(0, insurance_menu.attr('href').indexOf('&')) + '&siteId=' + id);
            case_list.attr('href', case_list.attr('href').substr(0, case_list.attr('href').indexOf('&')) + '&siteId=' + id);
            audit_trail.attr('href', audit_trail.attr('href').substr(0, audit_trail.attr('href').indexOf('&')) + '&siteId=' + id);
        }
        // $(site_management).attr('href', site_management.attr('href').substr(0, site_management.attr('href').indexOf('&')) + '&siteId=' +id);
    },

    reload: function (customerId, siteId) {
        path = window.location.href.substr(0, window.location.href.indexOf('?'));
        window.location.href = path + '?customerId=' + customerId + '&siteId=' + siteId;
    },

    /*
    ------------------------------------------------------------------------------
    |   This code block is used to logout the current user.
    ------------------------------------------------------------------------------
    */
    logout: function () {
        TRIFED.ajaxHit(conf.logout.url, conf.logout.method, null, function (response) {
            if (response.status) {
                localStorage.removeItem('authUser');
                window.location.href = "../auth/login.php";
            }
        });

    },

    /*
    ------------------------------------------------------------------------------
    |   This code block is used to remove session items,
    |   stored on local storage. 
    ------------------------------------------------------------------------------
    */
    removeLocalItem: function () {
        if (localStorage.removeItem('authUser')) {
            return true;
        } else {
            return false;
        }
    },

    /*
    ------------------------------------------------------------------------------
    |   This code block is used to show error message,
    |   to use this function we need to pass only one 
    |   parameter errorMessage in which we have our message.
    ------------------------------------------------------------------------------
    */
    showError: function (type, message) {
        toastr.error(message, "Error:");
    },

    /*
    ------------------------------------------------------------------------------
    |   This code block is used to show message,
    |   to use this function we need to pass only one 
    |   parameter errorMessage in which we have our message.
    ------------------------------------------------------------------------------
    */
    showMessage: function (type, message) {
        toastr.success(type, message);
    },

    /**
     * Show Warning
     * @param {string} type Type of message.
     * @param {string} message Message to display
     */
    showWarning: function (type, message) {
        toastr.warning(type, message);
    },
    /*
    ------------------------------------------------------------------------------
    |   This code block is used to find length of response data,
    |   to use this function we need to pass only one parameter 
    |   data in which we have our response data.
    ------------------------------------------------------------------------------
    */
    getDataLength: function (data) {
        if (data == undefined) {
            return false;
        } else {
            return Object.keys(data).length;
        }
    },

    /*
    ------------------------------------------------------------------------------
    |   This code block is used to get parameters from URL.
    ------------------------------------------------------------------------------
    */
    getUrlParameters: function () {
        var vars = [],
            hash;
        var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).replace('#', '').split('&');
        for (var i = 0; i < hashes.length; i++) {
            hash = hashes[i].split('=');
            vars.push(hash[0]);
            vars[hash[0]] = hash[1];
        }
        return vars;
    },

    /*
    ------------------------------------------------------------------------------
    |   This code block is used to check that a variable have 
    |   value or not.
    ------------------------------------------------------------------------------
    */
    checkVariableValue: function (value) {
        if (value) {
            return true;
        } else {
            return false;
        }
    },

    /*
    ------------------------------------------------------------------------------
    |   This code block is used to check for index page that 
    |   local storage have session or not;
    ------------------------------------------------------------------------------
    */
    checkForIndex: function () {
        var auth = {};
        var auth = JSON.parse(localStorage.getItem('authUser'));
        if (auth != null) {
            window.location.href = "assigned-ticket.php";
        }
    },

    /*
    ------------------------------------------------------------------------------
    |   This code block is used to for ajax hit to send or 
    |   retrieve data from given url. To use this function we
    |   we need three parameters url, method, data and cb for callback.
    ------------------------------------------------------------------------------
    */
    ajaxHit: function (url, method, data = null, cb) {
        var auth = TRIFED.getLocalStorageItem();
        var result;
        $.ajax({
            method: method,
            url: url,
            data: data,
            timeout: 30000,
            contentType: 'application/x-www-form-urlencoded',
            dataType: 'json',
            headers: {
                "Authorization": 'Bearer ' + auth.token
            },
            error: function (xmlhttprequest, textstatus, message) {
                if (textstatus === "timeout") {
                    TRIFED.showMessage('error', 'Request failed');
                }
            },
            statusCode: {
                401: function () {
                    localStorage.removeItem('authUser');
                    window.location.href = 'index.php';
                },
                404: function () {
                    cb(null, "No data found");
                },
                422: function (res) {
                    cb(res.responseJSON, res.responseJSON.message);
                },
                500: function () {
                    TRIFED.showMessage('error', 'Internal server error');
                },
            }
        }).done(function (res) {
            cb(res);
        });
    },

    asyncAjaxHit: function (url, method, data = null, cb) {
        var auth = TRIFED.getLocalStorageItem();
        if(auth===null){
            auth={};
            auth.token=null;
        }
        var result;
        $.ajax({
            method: method,
            url: url,
            data: data,
            timeout: 30000,
            async: false,
            contentType: 'application/x-www-form-urlencoded',
            dataType: 'json',
            headers: {
                "Authorization": 'Bearer ' + auth.token
            },
            beforeSend:function(){
               // $('#disable-div').addClass('overlay');
            },
            error: function (xmlhttprequest, textstatus, message) {
                if (textstatus === "timeout") {
                    TRIFED.showMessage('error', 'Request failed');
                }
                //$('#disable-div').removeClass('overlay');
            },
            statusCode: {
                401: function () {
                  //  $('#disable-div').removeClass('overlay');
                    localStorage.removeItem('authUser');
                    window.location.href = '../auth/login.php';
                },
                404: function (res) {
                    TRIFED.showError('error', 'Not Found');
                    //$('#disable-div').removeClass('overlay');
                    cb(res.responseJSON);
                },
                403: function (res) {
                    TRIFED.showError("error", res.responseJSON.message || 'Permission Denied.');
                    //$('#disable-div').removeClass('overlay');
                    cb(res.responseJSON);
                },
                422: function (res) {
                    //$('#disable-div').removeClass('overlay');
                    cb(res.responseJSON, res.responseJSON.message);
                },
                500: function (res) {
                    TRIFED.showError("error",  res.responseJSON.message || "Internal server error");
                    //$('#disable-div').removeClass('overlay');
                },
            }
        }).done(function (res) {
            //$('#disable-div').removeClass('overlay');
            cb(res);
        });
    },
    asyncAjaxHitLoader: function (url, method, data = null, cb) {
        $('.btn').prop('disabled', true);
        var auth = TRIFED.getLocalStorageItem();
        if(auth===null){
            auth={};
            auth.token=null;
        }
        var result;
        $.ajax({
            method: method,
            url: url,
            data: data,
            
            contentType: 'application/x-www-form-urlencoded',
            dataType: 'json',
            headers: {
                "Authorization": 'Bearer ' + auth.token
            },
            beforeSend:function(){
                $('.btn').prop('disabled', true);
                $('#loader-div').html('<i class="fa fa-spinner fa-spin" style="font-size:100px"></i>');
                $('#loader-div').show();
                
            },
            success: function(results) 
            {
                $('.btn').prop('disabled', false);
                $('#loader-div').html('');
                $('#loader-div').hide();
            },
            error: function (xmlhttprequest, textstatus, message) {
                if (textstatus === "timeout") {
                    TRIFED.showMessage('error', 'Request failed');
                }
                //$('#disable-div').removeClass('overlay');
            },
            statusCode: {
                401: function () {
                    $('.btn').prop('disabled', false);
                    $('#loader-div').html('');
                    $('#loader-div').hide();
                    localStorage.removeItem('authUser');
                    window.location.href = '../auth/login.php';
                },
                404: function (res) {
                    $('.btn').prop('disabled', false);
                    $('#loader-div').html('');
                    $('#loader-div').hide();
                    TRIFED.showError('error', 'Not Found');
                    
                    cb(res.responseJSON);
                },
                403: function (res) {
                    $('.btn').prop('disabled', false);
                    $('#loader-div').html('');
                    $('#loader-div').hide();
                    TRIFED.showError("error", res.responseJSON.message || 'Permission Denied.');
                    //$('#disable-div').removeClass('overlay');
                    cb(res.responseJSON);
                },
                422: function (res) {
                    $('.btn').prop('disabled', false);
                    $('#loader-div').html('');
                    $('#loader-div').hide();
                    cb(res.responseJSON, res.responseJSON.message);
                },
                500: function (res) {
                    $('.btn').prop('disabled', false);
                    $('#loader-div').html('');
                    $('#loader-div').hide();
                    TRIFED.showError("error",  res.responseJSON.message || "Internal server error");
                    //$('#disable-div').removeClass('overlay');
                },
            }
        }).done(function (res) {
            cb(res);
        });
    },
    /*
    ------------------------------------------------------------------------------
    |   This code block is used to for ajax hit to send files,
    |   we need three parameters url, method, data and cb for callback.
    ------------------------------------------------------------------------------
    */
    fileAjaxHit: function (url, method, data = null, cb) {
        $('#error_div').hide();
        $('.btn').prop('disabled', true);
        var auth = TRIFED.getLocalStorageItem();
        var result;
        $.ajax({
            method: method,
            //async:true,
            url: url,
            data: data,
            cache: false,
            dataType: 'json',
            processData: false, // Don't process the files
            contentType: false,
            headers: {
                "Authorization": 'Bearer ' + auth.token
            },
			beforeSend:function(){
                $('#error_div').empty();
                $('.btn').prop('disabled', true);
				$('#loader-div').html('<i class="fa fa-spinner fa-spin" style="font-size:100px"></i>');
                $('#loader-div').show();
				
			},
            success: function(results) 
            {
                $('.btn').prop('disabled', false);
                $('#loader-div').html('');
                $('#loader-div').hide();
            },
            statusCode: {
                401: function () {
                    $('.btn').prop('disabled', false);
                    $('#loader-div').html('');
                    $('#loader-div').hide();
                    localStorage.removeItem('authUser');
                    window.location.href = '../auth/login.php';
                },
                404: function () {
                    $('.btn').prop('disabled', false);
                    $('#loader-div').html('');
                    $('#loader-div').hide();
                    cb(null, "No data found");
                },
                422: function (res) {
                    $('#error_div').show();
                    $('#error_div').html(res.responseJSON.message);
                    $('#error_div').focus();
                    $('.btn').prop('disabled', false);
                    $('#loader-div').html('');
                    $('#loader-div').hide();
                    cb(res.responseJSON, res.responseJSON.message);
                },
                403: function (res) {
                    $('#error_div').show();
                    $('#error_div').html(res.responseJSON.message);
                    
                    $('.btn').prop('disabled', false);
                    $('#loader-div').html('');
                    $('#loader-div').hide();
                    TRIFED.showError("error",  res.responseJSON.message || "403 error");
                    $('#error_div').focus();
                },
                500: function (res) {
                    $('#error_div').show();
                    $('#error_div').html(res.responseJSON.message);
                    
                    $('.btn').prop('disabled', false);
                    $('#loader-div').html('');
                    $('#loader-div').hide();
                    TRIFED.showError("error",  res.responseJSON.message || "Internal server error");
                    $('#error_div').focus();
                },
            }
        }).done(function (res) {
			//$('#loader-div').html('');
            //$('#loader-div').hide();
            if (TRIFED.checkStatus(res)) {
                cb(res);
            }
        });
    },

    /*
    |   This code block will remove the hidden class for
    |   specified menus, buttons and other features whose permissions
    |   belongs to the logged in user.
    ------------------------------------------------------------------------------
    */
 
    showPermissions: function() {
        const authUser = JSON.parse(localStorage.getItem('authUser'));

        if(!authUser){
            window.location.href = '../auth/login.php';
        }

        if (authUser.role == 1) {
            $('.hidden').each(function(i,el) {
                $(el).removeClass('hidden');
            });
            var admin_not_have_permission=['mfp_procurement_plan_add','approval-management','infrastructure_development_add','fund_management'];
            admin_not_have_permission.forEach(function(permission){
                $('.'+permission).hide();
            })
            return;
        }
        

        let permissions = authUser['permissions'];
         
        $.each(permissions, function(key, value) {
            $('.' + value).removeClass('hidden');
        });

        // For DIA 
        if (authUser.role == 6) {
            
            
            $('#scrutinylevelrelease').hide();
            
            return;
        }
    },

    /*

    /*
    ------------------------------------------------------------------------------
    |   This code block is used to for validation of form field, 
    |   that can accepts only alphabets.To use this method, we need
    |   to pass only selector name on which we want to aplly filter.
    ------------------------------------------------------------------------------
    */
    alphabetFilter: function (selectorName) {
        var selector = selectorName;
        var regex = new RegExp("^[a-zA-Z]+$");
        var errorMessage = '* only alphabets are allowed';
        TRIFED.filter(selector, regex, errorMessage);
    },

    /*
    ------------------------------------------------------------------------------
    |   This code block is used to for validation of form field, 
    |   that can accepts only numbers.To use this method, we need
    |   to pass only selector name on which we want to aplly filter.
    ------------------------------------------------------------------------------
    */
    numberFilter: function (selectorName) {
        var selector = selectorName;
        var regex = new RegExp("[0-9]$");
        var errorMessage = '* only numbers are allowed';
        TRIFED.filter(selector, regex, errorMessage);
    },

    /*
    ------------------------------------------------------------------------------
    |   This code block is used to for validation on the basis of 
    |   selector type and data type of selector, to use this function
    |   we need to pass three parameters selector, regular expression,
    |   and error message to show error.
    ------------------------------------------------------------------------------
    */
    filter: function (selector, regex, errorMessage) {
        $(selector).keydown(function (e) {
            var code = e.keyCode || e,
                charCode;
            if (TRIFED.excludedKeyCodes.indexOf(code) != -1) {
                return;
            }
            var str = String.fromCharCode(e.keyCode || e.charCode);
            if (regex.test(str)) {
                return true;
            } else {
                e.preventDefault();
                TRIFED.showError(errorMessage, this);
                return false;
            }
        });
    },

    enableEdit: function (elements, entity, event) {
        var url;
        var method;
        var data;
        event.preventDefault();
        $inputExcept = "";
        $selectExcept = "";
        if (event.target.getAttribute('data-action') == "edit") {
            event.target.setAttribute('data-action', 'cancel-edit')
            event.target.text = 'Cancel';
            $(elements).attr('disabled', false);
            if (entity == "emergencyContact") {
                url = conf.unmaskEmergencyContact.url;
                method = conf.unmaskEmergencyContact.method;
                data = {};
                data.emergencyContactId = $("#emergencyContactId").val();
                TRIFED.ajaxHit(url, method, data, function (response, cb) {
                    if (response) {
                        var email = response.data.email;
                        var mobile = response.data.mobile;
                        var landline = response.data.landline;
                        $("#contactEmail").val(email);
                        $("#contactMobile").val(mobile);
                        $("#contactLandline").val(landline);
                        $('#save').show();
                    } else {
                        TRIFED.showMessage('error', cb);
                    }
                });
            } else if (entity == "familyMedical") {
                url = conf.unmaskFamilyMedical.url;
                method = conf.unmaskFamilyMedical.method;
                data = {};
                data.familyMedicalId = $("#familyMedicalId").val();
                TRIFED.ajaxHit(url, method, data, function (response, cb) {
                    if (response) {
                        var mobile = response.data.mobile;
                        $("#familyMemberMobile").val(mobile);
                        $("#familyMemberLandline").val(response.data.landline);
                        $('#save').show();
                    } else {
                        TRIFED.showMessage('error', cb);
                    }
                });
            } else if (entity == "profile") {
                url = conf.unmaskCustomerProfile.url;
                method = conf.unmaskCustomerProfile.method;
                data = {};
                data.customerId = customerId;
                TRIFED.ajaxHit(url, method, data, function (response, cb) {
                    if (response) {
                        $('#unmaskMob, #unmaskEmail, #unmasklandLine, #unmaskAlternateMob').hide();
                        $('#mobile').val(response.data.mobile).keyup();
                        $('#email').val(response.data.email);
                        if (response.data.contacts.length) {
                            var alternates = response.data.contacts.filter(function (contact) {
                                return contact.type == 'mobile';
                            })
                            var homeLandLine = response.data.contacts.filter(function (contact) {
                                return contact.type == 'home';
                            })
                            var officeLandLine = response.data.contacts.filter(function (contact) {
                                return contact.type == 'office';
                            })
                            var shopLandLine = response.data.contacts.filter(function (contact) {
                                return contact.type == 'shop';
                            })

                            if (alternates.length) {
                                $('#alternatePhoneNumber').val(alternates[0].number).keyup();
                            }
                            if (homeLandLine.length) {
                                $('#landlineNumber').val(homeLandLine[0].number);
                            } else if (officeLandLine.length) {
                                $('#landlineNumber').val(officeLandLine[0].number);
                            } else if (shopLandLine.length) {
                                $('#landlineNumber').val(shopLandLine[0].number);
                            }
                        }
                        $('#update-customer').show();
                    } else {
                        TRIFED.showMessage('error', cb);
                    }
                });
            } else if (entity == "insurance") {
                $('#save').show();
            } else if (entity == "siteinfo") {
                $('#save').show();
                if (TRIFED.getUrlParameters().add == 1) {
                    $('.reset-formdata').show();
                }
            } else if (entity == "subuser") {
                $('#save').show();
            } else if (entity == "schedule") {
                $('#scheduleDiv .save-schedule').show();
            }
        } else {
            if (entity == "insurance") {
                fetchDetails(TRIFED.getSiteManagementId());
            } else if (entity == "profile") {
                //actionOnPersonalInfoTab();
                $('a[href="#personal-information"]').trigger('click');
                event.target.setAttribute('data-action', 'edit');
                event.target.text = 'Edit';
                $(elements).attr('disabled', true);
            } else if (entity == "familyMedical") {
                showMemberDetails($("#familyMedicalRowId").val());
            } else if (entity == "subuser") {
                showUserDetails($("#subUserRowId").val());
                $(elements).attr('disabled', true);
            } else if (entity == "emergencyContact") {
                showConatctDetails($("#emergencyContactRowId").val());
            } else if (entity == "siteinfo") {
                if (TRIFED.getUrlParameters().add == 1) {
                    actionOnAddSiteButton();
                    $('.reset-formdata').hide();
                } else {
                    $('a[href="#site-info"]').trigger('click');
                    $(elements).attr('disabled', true);
                }
                event.target.setAttribute('data-action', 'edit');
                event.target.text = 'Edit';
            } else if (entity == "schedule") {
                fetchSchedule();
                event.target.setAttribute('data-action', 'edit');
                event.target.text = 'Edit';
            } else {
                event.target.setAttribute('data-action', 'edit');
                event.target.text = 'Edit';
                $(elements).attr('disabled', true);
                $('#save, #update-customer').hide();
            }
        }
    },
    /*
    ------------------------------------------------------------------------------
    |   This code block is used to for validation of mobile number. 
    ------------------------------------------------------------------------------
    */
    mobileNumberValidator: function (mobile) {
        if (parseInt(mobile)) {
            mobile = mobile.replace(/-/g, "");
            var len = TRIFED.getDataLength(mobile);
            if (len == 10) {
                return true;
            } else {
                TRIFED.showError('Please enter valid mobile number');
                return false;
            }
        } else {
            return true;
        }
    },

    mobileNumberFormat: function (elements) {
        $(elements).on("keyup", function (event) {
            event.preventDefault();

            var selection = window.getSelection().toString();
            if (selection !== '') {
                return;
            }

            if ($.inArray(event.keyCode, [38, 40, 37, 39]) !== -1) {
                return;
            }

            var $this = $(this);
            var input = $this.val();

            var input = input.replace(/[\D\s\._\-]+/g, "");
            // var input = input.replace(/[^\d\*-]+/g, "");

            var split = 3;
            var chunk = [];

            for (var i = 0, len = input.length; i < len; i += split) {
                split = (i == 6) ? 4 : 3;
                chunk.push(input.substr(i, split));
            }

            $this.val(function () {
                return chunk.join("-").toUpperCase().substr(0, 12);
            });

        });
    },

    /*
    ------------------------------------------------------------------------------
    |   This code block is used for validation of mobile number. 
    ------------------------------------------------------------------------------
    */
    pincodeValidator: function (pincode) {
        if (parseInt(pincode)) {
            var regex = /^[0-9]{6}$/;
            //var len = TRIFED.getDataLength(pincode);
            if (regex.test(pincode)) {
                return true;
            } else {
                TRIFED.showError('pincode must be 6 digit');
                return false;
            }
        } else {
            return true;
        }
    },

    /*
    ------------------------------------------------------------------------------
    |   This code block is used to for validation of email. 
    ------------------------------------------------------------------------------
    */
    validateEmail: function (email) {
        if (email) {
            var regex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            if (regex.test(email)) {
                return true;
            } else {
                TRIFED.showMessage('warning', 'Please enter valid email ID in the correct format.');
                return false;
            }
        } else {
            return true;
        }
    },

    /*
    ------------------------------------------------------------------------------
    |   This code block is used to for validation of date. 
    ------------------------------------------------------------------------------
    */
    validateDate: function (date) {
        if (date) {
            if (moment(date, 'DD/MM/YYYY', true) == 'Invalid date') {
                TRIFED.showMessage('warning', 'Please enter valid date');
                return false;
            } else {
                return true;
            }
        } else {
            return true;
        }
    },

    /*
    ------------------------------------------------------------------------------------
    |   This code block is used to fetch data from the form
    |   to use this method we need to pass only one paramter
    |   form ID or class.
    ------------------------------------------------------------------------------------
    */
    getFormData: function (form) {
        var formData = $(form).serializeArray();
        var data = {};
        jQuery.each(formData, function () {
            data[this.name] = this.value || '';
        });
        return data;
    },

    /*
    ------------------------------------------------------------------------------------
    |   This code block is used to validate a field is empty or not
    ------------------------------------------------------------------------------------
    */
    requiredValidator: function (selector) {
        if ($(selector).val() == '') {
            TRIFED.showError('mandatory field', selector);
            return false;
        } else {
            true;
        }
    },

    /*
    --------------------------------------------------------------------------------
    |   This code block is used to display user data in sidebar menu
    --------------------------------------------------------------------------------
    */
    sideBarData: function (data) {
        // localStorage.customerName = data.salutation + ' ' + data.firstName + ' ' + data.lastName;
        $('#userName').text(((data.salutation) ? data.salutation + ' ' : '') + data.firstName + ' ' + data.lastName);
        $('#userId').text('(' + data.id + ')');
        //$('#contactSpan').html("<span><b>Phone No :</b></span>+91 - "+data.mobile);
        //localStorage.customerNumber = data.mobile;
        // localStorage.customerNumber = data.mobile;
    },


    /* Site Id getter and setter */
    getSiteManagementId: function () {
        if (TRIFED.getUrlParameters().siteId != undefined && TRIFED.siteManagementId == undefined) {
            return TRIFED.getUrlParameters().siteId;
        }
        return TRIFED.siteManagementId;
    },

    setSiteManagementId: function (id) {
        TRIFED.siteManagementId = id;
    },

    /* Site Name getter and setter */
    getSiteName: function () {
        return TRIFED.siteName;
    },

    setSiteName: function (name) {
        TRIFED.siteName = name;
    },


    /*
    --------------------------------------------------------------------------------
    |   This code block is used to display user data in sidebar menu
    --------------------------------------------------------------------------------
    */
    sideBarAddress: function (data) {
        if (data.houseNumber == null || data.streetName == null || data.pincode == null) {
            return;
        }
        $('#sidebarAddress').html(((data.houseNumber) ? data.houseNumber + ', ' : '') + ((data.streetName) ? data.streetName + '<br/>' : '') + ((data.city.cityName) ? data.city.cityName + ', ' : '') + ((data.state.stateName) ? data.state.stateName + '- ' : '') + data.pincode + " <br />" + ((data.country.countryName) ? data.country.countryName : '') + "</span></p>");
    },

    /*
    --------------------------------------------------------------------------------
    |   This code block is used to get siteId stored on local storge
    --------------------------------------------------------------------------------
    */
    getter: function () {
        var siteManagementId;
        siteManagementId = localStorage.getItem('siteManagementId');
        return siteManagementId;
    },

    /*
    --------------------------------------------------------------------------------
    |   set a default row in case no data found
    --------------------------------------------------------------------------------
    */
    defaultRow: function (col) {
        return "<tr><td colspan='" + col + "'><center>no data found</center></td></tr>";
    },

    /*
    --------------------------------------------------------------------------------
    |   check customer in storage
    --------------------------------------------------------------------------------
    */
    // checkCustomerId : function(){
    //     if(localStorage.customerId!=undefined){
    //         return true;
    //     }
    //     else{
    //        return window.location = "customer-search.php";
    //     }
    // },
    /*
    --------------------------------------------------------------------------------
    |   set site list style
    --------------------------------------------------------------------------------
    */
    siteListStyle: function () {
        $('#siteListDropdown').each(function (i, elem) {
            if ($(elem).val() == $('#siteListDropdown').text()) {
                $(elem).html($(elem).val() + "<i class='fa fa-check' aria-hidden='true'></i>")
            } else {
                $(elem).html($(elem).val());
            }
        });
    },

    /*
    --------------------------------------------------------------------------------
    |   set scroll of page
    --------------------------------------------------------------------------------
    */
    setScroll: function (selector) {
        $('html, body').animate({
            scrollTop: $(selector).offset().top
        }, 500);
    },

    unmaskAjax: function (url, target, method, data) {
        TRIFED.ajaxHit(url, method, data, function (response, cb) {
            if (response) {
                $(target).text(response.data);
                $(target).val(response.data).keyup();
            } else {
                TRIFED.showMessage('error', cb);
            }
        });
    },

    unmaskCustomerMobile: function (id, event) {
        event.preventDefault();
        var target = event.target;
        var url = conf.unmaskCustomerMobile.url;
        var method = conf.unmaskCustomerMobile.method;
        var data = {};
        data.CustomerId = id;
        TRIFED.unmaskAjax(url, target, method, data);
    },

    unmaskCustomerEmail: function (id, event) {
        event.preventDefault();
        var target = event.target;
        var url = conf.unmaskCustomerEmail.url;
        var method = conf.unmaskCustomerEmail.method;
        var data = {};
        data.CustomerId = id;
        TRIFED.unmaskAjax(url, target, method, data);
    },

    unmaskEmergencyContactMobile: function (id, event) {
        event.preventDefault();
        var url = conf.unmaskEmergencyContactMobile.url;
        var target = event.target;
        var method = conf.unmaskEmergencyContactMobile.method;
        var data = {};
        data.emergencyContactId = id;
        TRIFED.unmaskAjax(url, target, method, data);
    },

    unmaskEmergencyContactLandline: function (id, event) {
        event.preventDefault();
        var url = conf.unmaskEmergencyContactLandline.url;
        var target = event.target;
        var method = conf.unmaskEmergencyContactLandline.method;
        var data = {};
        data.emergencyContactId = id;
        TRIFED.unmaskAjax(url, target, method, data);
    },

    unmaskEmergencyContactEmail: function (id, event) {
        event.preventDefault();
        var target = event.target;
        var url = conf.unmaskEmergencyContactEmail.url;
        var method = conf.unmaskEmergencyContactEmail.method;
        var data = {};
        data.emergencyContactId = id;
        TRIFED.unmaskAjax(url, target, method, data);
    },

    unmaskFamilyMedicalMobile: function (id, event) {
        event.preventDefault();
        var target = event.target;
        var url = conf.unmaskFamilyMedicalMobile.url;
        var method = conf.unmaskFamilyMedicalMobile.method;
        var data = {};
        data.familyMedicalId = id;
        TRIFED.unmaskAjax(url, target, method, data);
    },

    unmaskFamilyMedicalLandline: function (id, event) {
        event.preventDefault();
        var target = event.target;
        var url = conf.unmaskFamilyMedicalLandline.url;
        var method = conf.unmaskFamilyMedicalLandline.method;
        var data = {};
        data.familyMedicalId = id;
        TRIFED.unmaskAjax(url, target, method, data);
    },

    unmask: function (id, entity, i) {
        //event.preventDefault();
        if (entity == 1) {
            url = conf.unmaskAnswer.url;
            method = conf.unmaskAnswer.method;
            data = {};
            data.customerSecurityQuestionId = id;
            TRIFED.ajaxHit(url, method, data, function (response, cb) {
                if (response) {
                    $('.savedAnswer')[i].value = response.data;
                } else {
                    TRIFED.showMessage('error', cb);
                }
            });
        }
    },
    /*
    ------------------------------------------------------------------------------
    |   This code block is used for validation of age
    ------------------------------------------------------------------------------
    */
    ageValidator: function (dob) {
        var dateofbirth = new Date(dob);
        var today = new Date();
        var age = Math.floor((today - dateofbirth) / (365.25 * 24 * 60 * 60 * 1000));
        if (age > 18 && age < 100) {
            return true;
        } else {
            TRIFED.showError('Age must be greater than 18 Years OR valid age');
            return false;
        }
    },

    updateDisposition: function (event) {
        event.preventDefault();

        TRIFED.ajaxHit(conf.updateDisposition.url, conf.updateDisposition.method, null, function (response, cb) {
            if (response.data) {
                // socket.emit('generateAlert', response.data);
                TRIFED.showMessage('success', 'Disposition updated.');
                if (JSON.parse(localStorage.authUser).disposition == 'busy') {
                    localStorage.authUser = localStorage.authUser.replace('busy', 'free');
                    document.getElementById('navbarDropdown').innerHTML = JSON.parse(localStorage.authUser).name + ' (' + JSON.parse(localStorage.authUser).disposition + ')';
                }
                showAlertPopup();
            } else {
                TRIFED.showMessage('error', cb);
            }
        });
    },

    copyPasteInDigitField: function (fieldval, message) {
        if (fieldval && !fieldval.match(/^\d+$/)) {
            TRIFED.showMessage('error', message);
            return false;
        } else {
            return true;
        }
    },

    copyPasteInDigitAndCharsField: function (fieldval, message) {
        if (fieldval && !fieldval.match(/^[a-z A-Z0-9]+$/i)) {
            TRIFED.showMessage('error', message);
            return false;
        } else {
            return true;
        }
    },
    // ,
    // updateLastActive: function(){
    //     TRIFED.ajaxHit(conf.lastActiveUpdate.url, conf.lastActiveUpdate.method, null, function (response) {
    //     });
    // }

    checkPermissions: function(askPermission) {
        const authUser = JSON.parse(localStorage.getItem('authUser'));

        if(!authUser){
            window.location.href = '../auth/login.php';
        }

        if (authUser.role == 1) {
            return true;
        }

        let permissions = authUser['permissions'];
        if(permissions.includes(askPermission))
        {
            return true;
        }
        else
        {
            return false;
        }
    },
}

var alertSound;
var alerts = [];
var currentAlertId;
var invitaionAcceptedFlag = false;

function generateAlert(data) {
    alerts.push(data.id);
    if (alerts.length >= 1) {
        showAlertPopup();
    }

}

function showAlertPopup(data) {
    if (!alerts.length) {
        return false;
    }
    var agent = TRIFED.getLocalStorageItem();
    if (agent.disposition != 'free') {
        return false;
    }
    if (invitaionAcceptedFlag) {
        return;
    }
    currentAlertId = alerts[0];

    $('.alert-dialog h4 span').html('Alert Id ' + currentAlertId);
    $('#alertInvitaion').show();
    // $('#alertId').attr('data-alert', data.id);
    alertSound = $("#alert-sound")[0];
    alertSound.loop = true;
    alertSound.play();
}

$('#alertId').click(function (event) {
    event.preventDefault();
    invitaionAcceptedFlag = true;
    data = {
        'siteId': alertData[currentAlertId].siteId,
        'customerId': alertData[currentAlertId].customerId,
        'alertId': currentAlertId
    }
    alertSound.pause();
    $('#alertInvitaion').hide();
    TRIFED.ajaxHit(conf.acceptAlert.url, conf.acceptAlert.method, data, function (response, cb) {
        if (response.data != null) {
            localStorage.authUser = localStorage.authUser.replace('free', 'busy');
            window.location.href = 'ticket.php?customerId=' + response.data.customerId + '&siteId=' + response.data.siteId + '&ticketId=' + response.data.id + '&alert=true';
        } else {
            TRIFED.showMessage('error', cb);
            socket.emit('acceptInvitation', [{
                agentId: 0,
                alertId: currentAlertId
            }])
            alerts.shift();
            invitaionAcceptedFlag = false;
            showAlertPopup();
        }
    });
})


$("#rejectBtn").click(function (event) {
    event.preventDefault();
    alertSound.pause();
    var currentAlert = alerts[0];
    alerts.splice(alerts.indexOf(alerts[0]), 1);
    $("#alertInvitaion").hide();
    socket.emit('rejectInvitation', {
        alertId: currentAlert,
        agentId: TRIFED.getLocalStorageItem().id
    });
    localStorage.setItem('alert-rejected-event', currentAlertId);
    showAlertPopup();
})


function rejected(data) {
    alertSound.pause();
    alerts.splice(alerts.indexOf(parseInt(data.alertId)), 1);

    $('#alertInvitaion').hide();
    showAlertPopup();
}


function invitaionAccepted(data) {
    //console.log('invitaionAccepted :'+ data[0]);
    alerts.splice(alerts.indexOf(parseInt(data[0].alertId)), 1);

    if (data[0].alertId == currentAlertId) {
        $('#alertInvitaion').hide();
        alertSound.pause();
    }
    if (TRIFED.getLocalStorageItem().disposition != "busy") {
        showAlertPopup();
    }
}

function print_div(div_id)
{
    var contents = $('#'+div_id).html();
    var frame1 = $('<iframe />');
    frame1[0].name = "frame1";
    frame1.css({ "position": "absolute", "top": "-1000000px" });
    $("body").append(frame1);
    var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
    frameDoc.document.open();
    //Create a new HTML document.
    frameDoc.document.write('<html><head><title>Print</title>');
    
    frameDoc.document.write('<style>.no_print{display:none;}</style></head><body>');
    //Append the external CSS file.
    base_url=$('#base_url').val();
    frameDoc.document.write('<link href="../assets/css/style.css" rel="stylesheet">');
    frameDoc.document.write('<link href="../assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">');
    //Append the DIV contents.
    frameDoc.document.write(contents);
    frameDoc.document.write('</body></html>');
    frameDoc.document.close();
    setTimeout(function () {
        window.frames["frame1"].focus();
        window.frames["frame1"].print();
        frame1.remove();
    }, 500);
}

function getSupervisorSurveyorFor(role_id) {
    if(role_id == 11)
    {
        var url = conf.getSurveyorData.url;
        var method = conf.getSurveyorData.method;
    }
    if(role_id == 12)
    {
        var url = conf.getSupervisorData.url;
        var method = conf.getSupervisorData.method;
    }

    var data = { };
    TRIFED.ajaxHit(url, method, data, function(response, cb) {
        if (response) {
            if(role_id == 11)
                showPermissions(response.data.additional_details.survey_for);
            if(role_id == 12)
                showPermissions(response.data.additional_details.supervising_for);
        }
    });
}

function formType(type) {
	let types = {
		1: 'view_shg_gatherers',
		2: 'access_haat_bazaar_form',
		3: 'access_warehouse_form'
	}
	return types[type];
}

function arrayDiff(a1, a2) {

    var a = [], diff = [];

    for (var i = 0; i < a1.length; i++) {
        a[a1[i]] = true;
    }

    for (var i = 0; i < a2.length; i++) {
        if (a[a2[i]]) {
            delete a[a2[i]];
        } else {
            a[a2[i]] = true;
        }
    }

    for (var k in a) {
        diff.push(k);
    }

    return diff;
}

function showPermissions(showFor)
{
    var showFor = arrayDiff(showFor, ["1","2","3"]);
    let showedPermission = showFor.map(v => {
        return formType(v);
    });
    $.each(showedPermission, function(key, value) {
        $('.' + value).addClass('hidden');
    });

}
function numDifferentiation(val) {
    if(val >= 10000000)
    {
      val = (val/10000000).toFixed(2) ;
      val =parseFloat(val)+ ' Cr';   
      return val;       
    }else if(val >= 100000){
      val = (val/100000).toFixed(2) ;   
      val =parseFloat(val)+ ' Lac';  
      return val;
    }else if(val >= 1000){
       val = (val/1000).toFixed(2);  
       val =parseFloat(val)+ ' K'; 
       return val;
    }else{
       return 'Rs. '+val;     
    }
}
function proposal_status_colour(status){
    switch(status) {
      case 1:
        var class_name='btn-success';
        break;
      case 2:
        var class_name='btn-warning';
        break;
      case 3:
        var class_name='btn-danger';
        break;
      default:
        var class_name='btn-primary';
    }
    return class_name;
}
function updateUrlParameter(param,value){
    var queryParams = new URLSearchParams(window.location.search);
 
    // Set new or modify existing parameter value. 
    queryParams.set(param, value);
     
    // Replace current querystring with the new one.
    history.replaceState(null, null, "?"+queryParams.toString());
}
function decimalValues(value)
{
    if ((value===null) || (value==='') || (value===undefined))
      return '';
      else
      return parseFloat(value).toFixed(4);
}
function strToNumber(str)
{
    data=str.replace(/,/g, '');
    return  decimalValues(data);
}

$(function() {
  $(document).on('keyup keydown','.numberPattern', function() {
    this.value = this.value
      .replace(/[^\d.]/g, '')             // numbers and decimals only
      .replace(/(^[\d]{6})[\d]/g, '$1')   // not more than 6 digits at the beginning
     .replace(/(\..*)\./g, '$1')         // decimal can't exist more than once
      .replace(/(\.[\d]{4})./g, '$1');    // not more than 4 digits after decimal
  });
});
$(function() {
  $(document).on('keyup keydown','.qtyPattern', function() {
    this.value = this.value
      .replace(/[^\d.]/g, '')             // numbers and decimals only
      .replace(/(^[\d]{4})[\d]/g, '$1')   // not more than 9 digits at the beginning
      .replace(/(\..*)\./g, '$1')         // decimal can't exist more than once
      .replace(/(\.[\d]{4})./g, '$1');    // not more than 4 digits after decimal
  });
});
