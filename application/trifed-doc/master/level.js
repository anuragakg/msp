/**
 * @api {get} masters/state/ View All
 * @apiName LevelMasterViewAll
 * @apiGroup Level Master
 *
 * @apiSuccess {Number} status Response Status
 * @apiSuccess {Array} data  Array containing all the records of specified master.
 * @apiSuccess {Number} data.id Unique ID of Record
 * @apiSuccess {String} data.title Unique Title of Record
 * @apiSuccess {String} data.slug Slug of Record
 * @apiSuccess {Text} data.description Description of Record
 *
 * @apiSuccessExample Success-Response:
    HTTP/1.1 200 OK
    {
        "status": 1,
        "data": [{
            "id"         : 1,
            "title"      : "Item"
            "slug"       : "Slug"
            "description": "Some Text"
        }, {
            "id"         : 2,
            "title"      : "Item2"
            "slug"       : "Slug"
            "description": "Some Text"
        }]
    }
 * 
 */



/**
 * @api {get} masters/state/:id View One
 * @apiName LevelMasterViewOne
 * @apiGroup Level Master
 *
 * @apiParam (Parameter) {Number} id Resource ID
 *
 * @apiSuccess {Number} status Response Status
 * @apiSuccess {Object} data  JSON object for specified master resource.
 * @apiSuccess {Number} data.id Unique ID of Record
 * @apiSuccess {String} data.title Unique Title of Record
 * @apiSuccess {String} data.slug Slug of Record
 * @apiSuccess {Text} data.description Description of Record
 *
 * @apiSuccessExample Success-Response:
    HTTP/1.1 200 OK
    {
        "status": 1,
        "data": {
            "id": 1,
            "title": "Item"
            "slug": "Slug"
            "description": "Some Text"
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
 * @api {POST} masters/state Create
 * @apiName LevelMasterCreate
 * @apiGroup Level Master
 *
 * @apiParam (Payload) {String{..100}} title
 * @apiParam (Payload) {String{..100}} slug
 * @apiParam (Payload) {TEXT} description
 *
 * @apiParamExample {json} Payload
 * {
 *     title       : 'New Title',
 *     slug        :  'Slug',
 *     description :  'Some Text',
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
            "title"      : "Item 10"
            "slug"       : "Slug"
            "description": "Some Text"
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
* @api {PUT} masters/state/:id Update
* @apiName LevelMasterUpdate
* @apiGroup Level Master
*  
* @apiParam (Parameter) {Number} id Resource ID
* @apiParam (Payload) {String{..100}} title
* @apiParam (Payload) {String{..100}} slug
* @apiParam (Payload) {Text} description
*
* @apiParamExample {json} Payload
* {
*     title       : 'Change Title',
*     slug        :  'Slug',
*     description :  'Some Text',
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
           "title"      : "Change Title"
           "slug"      : "Slug"
           "description": "Some Text"
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
 * @api {DELETE} masters/level/:id Delete
 * @apiName LevelMasterDelete
 * @apiGroup Level Master
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