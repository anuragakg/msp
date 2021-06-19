var auth = TRIFED.getLocalStorageItem();


// If logged in user is DIA
if(auth.role == 6){ 
    //check loogged in DIA is lowest level of scrutiny
    fetchLoggedInState();
}
if(auth.role == 7){
    $(".approval-management").hide()
}

if(auth.role == 1){
    $(".proposal-action").hide();
}



function fetchLoggedInState(){
    var url = conf.getStatelevel.url;
    var method = conf.getStatelevel.method;
    var data = {};
    TRIFED.asyncAjaxHit(url, method , data, function (response, cb) {
        if (response) {
            addressData = response.data;
           
            if(auth.level == addressData.level_id){
                $(".approval-management").hide();
            }
        } else {
            TRIFED.showMessage('error', cb);
        }
    });
}

$(document).ready(function () {

});