
/**
 * @api {get} trainers/:id View One
 * @apiName TrainerViewOne
 * @apiGroup Trainer
 *
 * @apiParam (Parameter) {Number} id Resource ID
 *
 * @apiSuccess {Number} status Response Status
 * @apiSuccess {Object} data  JSON object for specified master resource.
 * @apiSuccess {Number} data.id Unique ID of Record
 * @apiSuccess {String} data.name Name of Record
 * @apiSuccess {String} data.gender Gender of Record
 * @apiSuccess {Date} data.dob Date of Birth of Record
 * @apiSuccess {String} data.address Address of Record
 * @apiSuccess {Number} data.mobile_no Mobile Number of Record
 * @apiSuccess {Number} data.landline_no Landline Number of Record
 * @apiSuccess {Number} data.state State of Record
 * @apiSuccess {Number} data.district District of Record
 * @apiSuccess {Number} data.block Block of Record
 * @apiSuccess {Number} data.yoe Year of Experience of Record
 * @apiSuccess {Number} data.education Education of Record
 * @apiSuccess {String} data.trained_from Trained From of Record
 * @apiSuccess {Number} data.specialisation Specilisation of Record
 *
 * @apiSuccessExample Success-Response:
    HTTP/1.1 200 OK
    {
        "status": 1,
        "data": {
            "id": 1,
            "name": "Trainer 1 Update",
            "gender": "M",
            "dob": "1994-12-09",
            "address": "G-diwe xw 43",
            "mobile_no": 5678901234,
            "landline_no": 5678901230,
            "state": 1,
            "state_title": "Haryana",
            "district": 1,
            "district_title": "Faridabad",
            "block": 1,
            "block_title": "D-Block",
            "education": 1,
            "education_title": "Illiterate",
            "yoe": 1,
            "trained_from": "cenu",
            "specialisation": 1
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
 * @api {POST} trainers Create
 * @apiName TrainerCreate
 * @apiGroup Trainer
 * @apiParam (Payload) {String{..100}} name Name of the Trainer
 * @apiParam (Payload) {String} gender Gender of the Trainer
 * @apiParam (Payload) {Date} dob Date of Birth.
 * @apiParam (Payload) {Number{..4}} state State of the Trainer
 * @apiParam (Payload) {Number{..4}} district District of the Trainer
 * @apiParam (Payload) {Number{..4}} block Block of the Trainer
 * @apiParam (Payload) {Number{..11}} mobile_no Mobile no. of the Trainer
 * @apiParam (Payload) {Number{..11}} landline_no Landline Number of the Trainer
 * @apiParam (Payload) {String{..255}} supervising_for Required If user_type=2. Multiple ID's can be provided as comma seperated values.
 * @apiParam (Payload) {String{..255}} survey_for If user type=1. This will be null in this form type.
 * @apiParam (Payload) {Number{..20}} education Education of the Trainer.
 * @apiParam (Payload) {Number{..20}} yoe Yoe of the Trainer.
 * @apiParam (Payload) {Number{..20}} specialisation Specialisation of the Trainer.
 * @apiParam (Payload) {String{..25}} trained_from Trained from.
 * @apiParamExample {json} Payload
 * {
 *     name:'Trainer 1 Update',
 *     gender:'M',
 *     dob:'12/09/1994',
 *     address:'G-diwe xw 43',
 *     mobile_no:5678901234,
 *     landline_no:5678901230,
 *     state:1,
 *     district:1,
 *     block:1,
 *     education:1,
 *     yoe:1,
 *     trained_from:'cenu',
 *     specialisation:1,
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
            "id": 1,
            "name": "Trainer 1 Update",
            "gender": "M",
            "dob": "1994-12-09",
            "address": "G-diwe xw 43",
            "mobile_no": 5678901234,
            "landline_no": 5678901230,
            "state": 1,
            "state_title": "Haryana",
            "district": 1,
            "district_title": "Faridabad",
            "block": 1,
            "block_title": "D-Block",
            "education": 1,
            "education_title": "Illiterate",
            "yoe": 1,
            "trained_from": "cenu",
            "specialisation": 1
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
* @api {PUT} trainers/:id Update
* @apiName TrainerUpdate
* @apiGroup Trainer
*  
* @apiParam (Parameter) {Number} id Resource ID
* @apiParam (Payload) {String{..100}} name Name of the Trainer
* @apiParam (Payload) {String} gender Gender of the Trainer
* @apiParam (Payload) {Date} dob Date of Birth.
* @apiParam (Payload) {Number{..4}} state State of the Trainer
* @apiParam (Payload) {Number{..4}} district District of the Trainer
* @apiParam (Payload) {Number{..4}} block Block of the Trainer
* @apiParam (Payload) {Number{..11}} mobile_no Mobile no. of the Trainer
* @apiParam (Payload) {Number{..11}} landline_no Landline Number of the Trainer
* @apiParam (Payload) {String{..255}} supervising_for Required If user_type=2. Multiple ID's can be provided as comma seperated values.
* @apiParam (Payload) {String{..255}} survey_for If user type=1. This will be null in this form type.
* @apiParam (Payload) {Number{..20}} education Education of the Trainer.
* @apiParam (Payload) {Number{..20}} yoe Yoe of the Trainer.
* @apiParam (Payload) {Number{..20}} specialisation Specialisation of the Trainer.
* @apiParam (Payload) {String{..25}} trained_from Trained from.
* @apiParamExample {json} Payload
* {
*     name:'Trainer 1 Update',
*     gender:'M',
*     dob:'12/09/1994',
*     address:'G-diwe xw 43',
*     mobile_no:5678901234,
*     landline_no:5678901230,
*     state:1,
*     district:1,
*     block:1,
*     education:1,
*     yoe:1,
*     trained_from:'cenu',
*     specialisation:1,
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
            "id": 1,
            "name": "Trainer 1 Update",
            "gender": "M",
            "dob": "1994-12-09",
            "address": "G-diwe xw 43",
            "mobile_no": 5678901234,
            "landline_no": 5678901230,
            "state": 1,
            "state_title": "Haryana",
            "district": 1,
            "district_title": "Faridabad",
            "block": 1,
            "block_title": "D-Block",
            "education": 1,
            "education_title": "Illiterate",
            "yoe": 1,
            "trained_from": "cenu",
            "specialisation": 1
        }
   }

   @apiError {Number} status Response Status
   @apiError {String} message Error Response Message specifiying the reason for failure.

   @apiErrorExample {JSON} Not Found
   HTTP/1.1 404 Not Found
   {
       "status": 0,
       "message": "Not found!"
   }
* 
*/
