/**
 * @api {get} masters/procurement-agent View All
 * @apiName ProcurementAgentViewAll
 * @apiGroup Procurement Agent Master
 *
 * @apiSuccess {Number} status Response Status
 * @apiSuccess {Array} data  Array containing all the records of specified master.
 * @apiSuccess {Number} data.id Unique ID of Record
 * @apiSuccess {String} data.name Name of procurement agent.
 * @apiSuccess {Number} data.mobile_no Mobile number of procurement agent.
 * @apiSuccess {Number} data.landline_no Landline number of procurement agent.
 * @apiSuccess {String} data.address Address of procurement agent.
 * @apiSuccess {Number} data.state State of procurement agent.
 * @apiSuccess {Number} data.district District of procurement agent.
 * @apiSuccess {Number} data.block Block of procurement agent.
 *
 * @apiSuccessExample Success-Response:
    HTTP/1.1 200 OK
    {
        "status": 1,
        "data": [{
            "id": 2,
            "name": "Pankaj",
            "mobile_no": 2134445679,
            "landline_no": 12122124,
            "address": "Ashok Nagar, U.P",
            "state": 1,
            "district": 56,
            "block": 89
        }]
    }
 * 
 */



/**
 * @api {get} masters/procurement-agent/:id View One
 * @apiName ProcurementAgentViewOne
 * @apiGroup Procurement Agent Master
 *
 * @apiParam (Parameter) {Number} id Resource ID
 *
 * @apiSuccess {Number} status Response Status
 * @apiSuccess {Object} data  JSON object for specified master resource.
 * @apiSuccess {Number} data.id Unique ID of Record
 * @apiSuccess {String} data.name Name of procurement agent.
 * @apiSuccess {Number} data.mobile_no Mobile number of procurement agent.
 * @apiSuccess {Number} data.landline_no Landline number of procurement agent.
 * @apiSuccess {String} data.address Address of procurement agent.
 * @apiSuccess {Number} data.state State of procurement agent.
 * @apiSuccess {Number} data.district District of procurement agent.
 * @apiSuccess {Number} data.block Block of procurement agent.
 *
 * @apiSuccessExample Success-Response:
    HTTP/1.1 200 OK
    {
        "status": 1,
        "data": {
            "id": 1,
            "name": "Ramesh",
            "mobile_no": 2134445678,
            "landline_no": 12122123,
            "address": "Rajiv Chowk, Delhi",
            "state": 1,
            "district": 56,
            "block": 89
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
 * @api {POST} masters/procurement-agent Create
 * @apiName ProcurementAgentCreate
 * @apiGroup Procurement Agent Master
 * @apiParam (Payload) {String{..20}} name Name of Agent.
 * @apiParam (Payload) {Number{..20}} mobile_no Mobile no. of agent.
 * @apiParam (Payload) {Number{..20}} landline_no Mobile no. of agent.
 * @apiParam (Payload) {String{..250}} address Address of Agent.
 * @apiParam (Payload) {Number} state State of Agent.
 * @apiParam (Payload) {Number} district District of Agent.
 * @apiParam (Payload) {Number} block Block of Agent.
 * @apiParamExample {json} Payload
    {
        "name": "Rajesh",
        "mobile_no": 2134445674,
        "landline_no": 12122122,
        "address": "Chandni Chowk, Delhi",
        "state": 1,
        "district": 56,
        "block": 89
    }
 * 
 * @apiSuccess {Number} status Response Status
 * @apiSuccess {Object} data  JSON object for specified master resource.
 *
 * @apiSuccessExample Success-Response:
    HTTP/1.1 200 OK
    {
        "status": 1,
        "data": {
            "id": 5,
            "name": "Rajesh",
            "mobile_no": 2134445674,
            "landline_no": 12122122,
            "address": "Chandni Chowk, Delhi",
            "state": 1,
            "district": 56,
            "block": 89
        }
    }

    @apiError (Duplicate Mobile Number) {Number} status Response Status
    @apiError (Duplicate Mobile Number) {String} message Error Response Message specifiying the reason for failure.
    @apiErrorExample {JSON} Duplicate Mobile number
    HTTP/1.1 422 Unprocessable Entity
    {
        "status": 0,
        "message": "The mobile no has already been taken."
    }

    @apiError (Duplicate Landline Number) {Number} status Response Status
    @apiError (Duplicate Landline Number) {String} message Error Response Message specifiying the reason for failure.
    @apiErrorExample {JSON} Duplicate Landline number
    HTTP/1.1 422 Unprocessable Entity
    {
        "status": 0,
        "message": "The landline no has already been taken."
    }
 * 
 */

/**
* @api {PUT} masters/procurement-agent/:id Update
* @apiName ProcurementAgentUpdate
* @apiGroup Procurement Agent Master
*  
* @apiParam (Parameter) {Number} id Resource ID

* @apiParam (Payload) {String{..20}} name Name of Agent.
* @apiParam (Payload) {Number{..20}} mobile_no Mobile no. of agent.
* @apiParam (Payload) {Number{..20}} landline_no Mobile no. of agent.
* @apiParam (Payload) {String{..250}} address Address of Agent.
* @apiParam (Payload) {Number} state State of Agent.
* @apiParam (Payload) {Number} district District of Agent.
* @apiParam (Payload) {Number} block Block of Agent.

* @apiParamExample {json} Payload
* {
        "status": 1,
        "data": {
            "name": "Rajesh",
            "mobile_no": 2134445674,
            "landline_no": 12122122,
            "address": "Chandni Chowk, Delhi",
            "state": 1,
            "district": 56,
            "block": 89
        }
    }
* @apiSuccess {Number} status Response Status
* @apiSuccess {Object} data  JSON object for specified master resource.
*
* @apiSuccessExample Success-Response:
   HTTP/1.1 200 OK
   {
       "status": 1,
       "data": {
           "id": 5,
           "name": "Rajesh",
           "mobile_no": 2134445674,
           "landline_no": 12122122,
           "address": "Chandni Chowk, Delhi",
           "state": 1,
           "district": 56,
           "block": 89
       }
   }

   @apiError {Number} status Response Status
   @apiError {String} message Error Response Message specifiying the reason for failure.
   
   @apiError (Duplicate Mobile Number) {Number} status Response Status
    @apiError (Duplicate Mobile Number) {String} message Error Response Message specifiying the reason for failure.
    @apiErrorExample {JSON} Duplicate Mobile Number
    HTTP/1.1 422 Unprocessable Entity
    {
        "status": 0,
        "message": "The mobile no has already been taken."
    }

    @apiError (Duplicate Landline Number) {Number} status Response Status
    @apiError (Duplicate Landline Number) {String} message Error Response Message specifiying the reason for failure.
    @apiErrorExample {JSON} Duplicate Landline Number
    HTTP/1.1 422 Unprocessable Entity
    {
        "status": 0,
        "message": "The landline no has already been taken."
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
 * @api {DELETE} masters/procurement-agent/:id Delete
 * @apiName ProcurementAgentDelete
 * @apiGroup Procurement Agent Master
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