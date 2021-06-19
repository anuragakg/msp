/**
 * @api {get} masters/role/ View All
 * @apiName RoleMasterViewAll
 * @apiGroup Role Master
 *
 * @apiSuccess {Number} status Response Status
 * @apiSuccess {Array} data  Array containing all the records of specified master.
 * @apiSuccess {Number} data.id Unique ID of Record
 * @apiSuccess {String} data.title Unique Title of Record
 *
 * @apiSuccessExample Success-Response:
    HTTP/1.1 200 OK
    {
        "status": 1,
        "data": [{
            "id": 1,
            "title": "Item"
        }, {
            "id": 2,
            "title": "Item 2"
        }]
    }
 * 
 */



/**
 * @api {get} masters/role/:id View One
 * @apiName roleMasterViewOne
 * @apiGroup role Master
 *
 * @apiParam (Parameter) {Number} id Resource ID
 *
 * @apiSuccess {Number} status Response Status
 * @apiSuccess {Object} data  JSON object for specified master resource.
 * @apiSuccess {Number} data.id Unique ID of Record
 * @apiSuccess {String} data.title Unique Title of Record
 *
 * @apiSuccessExample Success-Response:
    HTTP/1.1 200 OK
    {
        "status": 1,
        "data": {
            "id": 1,
            "title": "Item"
        }
    }

    @apiError {Number} status Response Status
    @apiError {String} message Error Response Message specifiying the reason for failure.
    @apiErrorExample Resource Not Found
    HTTP / 1.1 404 Not Found
    {
        "status": 0,
        "message": "Not found"
    }
 * 
 */
