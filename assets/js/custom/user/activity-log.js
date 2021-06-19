$(function() {
	fetchUserActivityList();
});

fetchUserActivityList = (data={}) => {
	var url = conf.getUserActivityLog.url;
    var method = conf.getUserActivityLog.method;
    var data = data;
    TRIFED.asyncAjaxHit(url, 'GET', data, function (response, cb) {
        if (response) {
            //addressData = response.data;
            fillLogs(response.data);
        } else {
            TRIFED.showMessage('error', cb);
        }
    });
}

fillLogs = (records) => {
	renderSimplePagination(records, "#pagination");
	var html = "";
	var i = 0;

	i = records.current_page > 1 ? (records.current_page - 1) * records.per_page : i;
	$.each(records.data, function(v, user){
		
		html += '<tr  >'+
				'<td id="row-data">' + ++i + '</td>'+
				'<td id="row-data">' + user.user_name + '</td>'+
				'<td id="row-data">' + user.ip_address + '</td>'+
				'<td id="row-data">' + user.activity + '</td>'+
				'<td id="row-data">' + user.created_at + '</td>';
	});
	$('#user-list tbody').html(html);
}
function renderSimplePagination (records,selector) {

	let { total, current_page, next, previous, per_page } = records;
	let ul = $("<ul>").attr("class", "pagination");
	
	if (previous) {
		let li = $("<li>").on('click', function () {
			fetchUserActivityList({
				page: current_page - 1
			});
		});
		ul.append(li.html($('<a>').text('Previous')))
	}
	if (next) {
		let li = $("<li>");
		li.on("click", function() {
			fetchUserActivityList({
				page: current_page + 1
			});
		});
		ul.append(li.html($('<a>').text('Next')));
	}
	let totalPages = Math.ceil(total / per_page);	
	let span = $('<span style="display:block">').text(`Page ${current_page} of ${totalPages}, Total Records : ${total}`);
	$(selector).html(span).append(ul);	
}