/**
 * @api {get} masters/unit View All
 * @apiName UnitMasterViewAll
 * @apiGroup Unit Master
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
 * @api {get} masters/unit/:id View One
 * @apiName UnitMasterViewOne
 * @apiGroup Unit Master
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

/**
 * @api {POST} masters/unit Create
 * @apiName UnitMasterCreate
 * @apiGroup Unit Master
 * @apiParam (Payload) {String{..100}} title
 * @apiParamExample {json} Payload
 * {
 *     title : 'New Title',
 * }
 * 
 * @apiSuccess {Number} status Response Status
 * @apiSuccess {Object} data  JSON object for specified master resource.
 *
 * @apiSuccessExample Success-Response:
    HTTP/1.1 200 OK
    {
        "status": 1,
        "data": {
            "id": 10,
            "title": "Item 10"
        }
    }

    @apiError (Duplicate Title) {Number} status Response Status
    @apiError (Duplicate Title) {String} message Error Response Message specifiying the reason for failure.
    @apiErrorExample {JSON} Duplicate Title
    HTTP/1.1 422 Unprocessable Entity
    {
        "status": 0,
        "message": "The title has already been taken."
    }
 * 
 */

/**
* @api {PUT} masters/unit/:id Update
* @apiName UnitMasterUpdate
* @apiGroup Unit Master
*  
* @apiParam (Parameter) {Number} id Resource ID
* @apiParam (Payload) {String{..100}} title
* @apiParamExample {json} Payload
* {
*     title : 'Change Title',
* }
* 
* @apiSuccess {Number} status Response Status
* @apiSuccess {Object} data  JSON object for specified master resource.
*
* @apiSuccessExample Success-Response:
   HTTP/1.1 200 OK
   {
       "status": 1,
       "data": {
           "id": 10,
           "title": "Change Title"
       }
   }

   @apiError {Number} status Response Status
   @apiError {String} message Error Response Message specifiying the reason for failure.
   
   @apiErrorExample {JSON} Duplicate Title
   HTTP/1.1 422 Unprocessable Entity
   {
       "status": 0,
       "message": "The title has already been taken."
   }

   @apiErrorExample {JSON} Not Found
   HTTP/1.1 404 Not Found
   {
       "status": 0,
       "message": "Not found!"
   }
* 
*/

/**
 * @api {DELETE} masters/unit/:id Delete
 * @apiName UnitMasterDelete
 * @apiGroup Unit Master
 *
 * @apiParam (Parameter) {Number} id Resource ID
 * 
 * @apiSuccess {Number} status Response Status
 * @apiSuccess {String} data Message text specifying the resource has been deleted.
 *
 * @apiSuccessExample Success-Response:
    HTTP/1.1 200 OK
    {
        "status": 1,
        "data": "Item Deleted"
    }

  @apiErrorExample {JSON} Not Found
    HTTP/1.1 404 Not Found
    {
        "status": 0,
        "message": "Not found!"
    }
 * 
 */