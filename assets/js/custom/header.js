/*
------------------------------------------------------------------------------------
|   This code block is used to submit data on login
|   and test that session have values or not
------------------------------------------------------------------------------------
*/

$(function () {
    changePassword();
});

changePassword = () => {
    let token = TRIFED.getLocalStorageItem().token;
    $('#changePassword').on('click', function(e) {
        e.preventDefault();

        var url = conf.changePassword.url;
        var method = conf.changePassword.method;
        var data = {};
        data.old_password     = $('#old_password').val().trim();
        data.password         = $('#password').val().trim();
        data.confirm_password = $('#confirm_password').val().trim();
        if (validateForm(data)) {
                $.ajax({
                    method: method,
                    url: url,
                    data: data,
                    contentType: 'application/x-www-form-urlencoded',
                    dataType: 'json',
                    headers: {
                        "Access-Control-Allow-Origin": "*",
                        "Access-Control-Allow-Headers": "access-control-allow-origin, access-control-allow-headers",
                        "Authorization":"Bearer "+token
                    },
                    statusCode: {
                        422: function (response) {
                            console.log(response);
                            TRIFED.showError('error', response.responseJSON.message);
                        }
                    }
                }).done(function (response) {       
                    if (TRIFED.checkStatus(response) == true) {
                        TRIFED.showMessage('success',response.data.message);
                        setTimeout(function () {
                            window.location.reload();
                        }, 1000);
                    }
                });
        } 
    });
}

function validateForm(data) {
    if (data.password  !=  data.confirm_password) {
        TRIFED.showError('error', 'New Password and Confirm Password should be same.');
        return false;
    }
    return true;
}

$('[data-toggle=modal]').on('click', function (e) {
    $('#old_password').val('');
    $('#password').val('');
    $('#confirm_password').val('');
});