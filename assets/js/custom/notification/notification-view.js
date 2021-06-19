$(function() {
	fetchNotificationList();
});

fetchNotificationList = () => {
    var url = conf.getNotification.url;
    var method = conf.getNotification.method;
    var data = { };
    TRIFED.asyncAjaxHit(url, method, data, function(response, cb) {
        if (response) {
            var notifications = response.data;
            if(notifications.length == 0)
            {
                $(".mark-all-read").attr("disabled", true);
            }
            fillNotificationList(notifications);
        } else {
            TRIFED.showMessage('error', cb);
        }
    });
}

fillNotificationList = (notifications) => {
	var html = "";
	$.each(notifications, function(i, notification){
		html += '<tr><td id="row-data"><a href="#" data-url="' + notification.data.action + '" data-id="' + notification.id + '" class="mark-read-redirect">' + notification.data.message + '</a></td>'+
				'<td id="row-data">' + notification.created_at + '</td>'+
				'<td class="action-area"><a href="#" data-id="' + notification.id + '" class="data-edit mark-read" data-toggle="tooltip" data-placement="top" title="Mark As Read" data-original-title="Mark As Read"><i class="fa fa-check"></i></a></td></tr>';
	});
    $('#notification-list tbody').html(html);
    
    notificationTrigger();
}

function notificationTrigger(){

    $(".mark-read").on("click", function(){
        var notification_id = $(this).attr("data-id");        
        const data = {};
        var url = conf.markNotificationRead.url(notification_id);
        var method = conf.markNotificationRead.method;
        TRIFED.asyncAjaxHit(url, method, data, function(response, cb) {
        if (response) {
            TRIFED.showMessage(response.data.message, cb);  
            setTimeout(function() {
				location.reload();
			}, 500);          
        }
        });
    });

    $(".mark-read-redirect").on("click", function(){
        var notification_id = $(this).attr("data-id");
        var location = $(this).attr("data-url");
        const data = {};
        var url = conf.markNotificationRead.url(notification_id);
        var method = conf.markNotificationRead.method;
        TRIFED.asyncAjaxHit(url, method, data, function(response, cb) {
        if (response) {
            TRIFED.showMessage(response.data.message, cb);
            setTimeout(() => {
                window.location.href = location;
            }, 1000);
        }
        });
    });

    $(".mark-all-read").on("click", function(){     
        const data = {};
        var url = conf.MarkAllNotificationRead.url;
        var method = conf.MarkAllNotificationRead.method;
        TRIFED.asyncAjaxHit(url, method, data, function(response, cb) {
        if (response) {
            TRIFED.showMessage(response.data.message, cb);  
            setTimeout(function() {
				location.reload();
			}, 500);          
        }
        });
    });

}
