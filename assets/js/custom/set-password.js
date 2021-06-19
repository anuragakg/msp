/*
------------------------------------------------------------------------------------
|   This code block is used to submit data on login
|   and test that session have values or not
------------------------------------------------------------------------------------
*/

$(function () {
    setPassword();
});

setPassword = () => {
    var emailVerifyToken = TRIFED.getUrlParameters().email_verify_token;
    $('#setPassword').on('click', function(e) {
        e.preventDefault();

        var url = conf.generatePassword.url;
        var method = conf.generatePassword.method;
       
        var data = {};
        data.email_verify_token   = emailVerifyToken;
        data.password             = $('#password').val().trim();
        data.confirm_password     = $('#confirm_password').val().trim();

        if (validateForm(data)) {
            TRIFED.asyncAjaxHit(url, method, data, function (response) {
                if (response.status == 1) {
                    $('#formID')[0].reset();
                    setTimeout(function() {
                        document.location="login.php";
                    }, 3000);
                    TRIFED.showMessage('success', response.data.message);
                }
                else {
                    TRIFED.showError('error', response.message);
                }
            });
        }
    });
}

function validateForm(data) {
    if (data.password !=  data.confirm_password) {
        TRIFED.showError('error', 'Password and Confirm Password should be same.');
        return false;
    }
    return true;
}