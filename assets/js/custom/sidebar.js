$(function() {
  TRIFED.checkToken();
  utils.processApiLinks();
  TRIFED.showPermissions();
  utils.openPdfInNewTab();
  // getUserDetails();
});

// function getUserDetails(query = null) {
// 	const url = conf.getUserDetails.url;
// 	const method = conf.getUserDetails.method;
//   const data = {};
// }

$('#exportAreaMasterExcel').on('click', function (e) {
	e.preventDefault();
	var url = conf.exportAreaMasterData.url;
	var method = conf.exportAreaMasterData.method;
  downloadExcel(url, method);	
});



$('#exportShgMasterExcel').on('click', function (e) {
	e.preventDefault();
	var url = conf.exportShgMasterData.url;
	var method = conf.exportShgMasterData.method;
  downloadExcel(url, method);	
});

$('#exportWarehouseMasterExcel').on('click', function (e) {
	e.preventDefault();
	var url = conf.exportWarehouseMasterData.url;
	var method = conf.exportWarehouseMasterData.method;
  downloadExcel(url, method);	
});

$('#exportHaatMasterExcel').on('click', function (e) {
	e.preventDefault();
	var url = conf.exportHaatMasterData.url;
	var method = conf.exportHaatMasterData.method;
  downloadExcel(url, method);	
});

function downloadExcel(url, method, data = {}){
  TRIFED.asyncAjaxHit(url, method, data, function(response, cb) {
		window.location.href = endpoint+''+response.data.file;
	});
}