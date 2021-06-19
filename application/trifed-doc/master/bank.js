/**
 * @api {get} masters/bank View All
 * @apiName BankMasterViewAll
 * @apiGroup Bank Master
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
            "title": "Sample Bank 1",
            "ifsc_code" : "SBOI000012"
        }, {
            "id": 2,
            "title": "General Bank",
            "ifsc_code": "GBOI000012"
        }]
    }
 * 
 */



/**
 * @api {get} masters/bank/:id View One
 * @apiName BankMasterViewOne
 * @apiGroup Bank Master
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
            "title": "General Bank Of India",
            "ifsc_code": "GBOI000012"
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
 * @api {POST} masters/bank Create
 * @apiName BankMasterCreate
 * @apiGroup Bank Master
 * @apiParam (Payload) {String{..100}} title Bank Name
 * @apiParam (Payload) {String{..11}} ifsc_code IFSC Code of Bank.
 * @apiParamExample {json} Payload
 * {
 *     "title": "General Bank Of India",
       "ifsc_code": "GBOI000012"
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
            "title": "General Bank Of India",
            "ifsc_code": "GBOI000012"
        }
    }

    @apiError (Duplicate IFSC Code) {Number} status Response Status
    @apiError (Duplicate IFSC Code) {String} message Error Response Message specifiying the reason for failure.
    @apiErrorExample {JSON} Duplicate IFSC Code
    HTTP/1.1 422 Unprocessable Entity
    {
        "status": 0,
        "message": "The ifsc code has already been taken."
    }
 * 
 */

/**
* @api {PUT} masters/bank/:id Update
* @apiName BankMasterUpdate
* @apiGroup Bank Master
*  
* @apiParam (Parameter) {Number} id Resource ID
* @apiParam (Payload) {String{..100}} title Bank Name
* @apiParam (Payload) {String{..11}} ifsc_code IFSC Code of Bank.
* @apiParamExample {json} Payload
* {
    "title": "State Bank Of India",
    "ifsc_code": "SBOI000012"
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
           "title": "State Bank Of India",
           "ifsc_code": "SBOI000012"
       }
   }

   @apiError {Number} status Response Status
   @apiError {String} message Error Response Message specifiying the reason for failure.
   
   @apiErrorExample {JSON} Duplicate IFSC Code
    HTTP/1.1 422 Unprocessable Entity
    {
        "status": 0,
        "message": "The ifsc code has already been taken."
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
 * @api {DELETE} masters/bank/:id Delete
 * @apiName BankMasterDelete
 * @apiGroup Bank Master
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