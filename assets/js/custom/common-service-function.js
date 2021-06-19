$(function () {alert()
    /*setInterval(function(){alert()
      updateLastActive()  
        $('#wait').hide();
  }, 60000);
});*/

function updateLastActive(){
	TRIFED.ajaxHit(conf.lastActiveUpdate.url, conf.lastActiveUpdate.method, null, function (response) {
        });
}