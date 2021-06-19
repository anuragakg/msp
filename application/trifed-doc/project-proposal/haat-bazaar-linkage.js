/**
 * @api {POST} project-proposal/haat-bazaar Create
 * @apiName ProjectProposalHaatMarketCreate
 * @apiGroup Project Proposal Haat Market
 * 
 * @apiParam (Payload) {Integer{..11}} haat_bazaar_id Haat Bazaar Id comes from Haat market one API
 * @apiParam (Payload) {String{..20}} address Address 
 * @apiParam (Payload) {Number{..20}} distance_vkvd Distance VKVD
 * @apiParam (Payload) {Integer{..11}} unit Unit  comes from Unit master

 * @apiParamExample {json} Payload
 * {
    "haat_bazaar_id": 1,
    "address": "Noida", 
    "distance_vkvd": "12", 
    "unit": 1, 
 * }
 * @apiSuccess {Number} status Response Status
 * @apiSuccess {Object} data  JSON object for specified master resource.
 * @apiSuccess {Number} data.id Unique ID of Record
 * @apiSuccess {Number} data.haat_bazaar_id Haat Bazaar Id
 * @apiSuccess {String} data.haat_bazaar_name Haat Bazaar Name
 * @apiSuccess {String} data.address Address
 * @apiSuccess {Number} data.distance_vkvd Distance VKVD
 * @apiSuccess {Number} data.unit Unit 
 * @apiSuccessExample Success-Response:
    HTTP/1.1 200 OK
    {
    "status": 1,
    "data": {
        "id": 3,
        "haat_bazaar_id": 1,
        "haat_bazaar_name": "Test",
        "address": "Noida",
        "distance_vkvd": "12",
        "unit": "1"
    }
}
 * 
 */

/**
 * @api {PUT} project-proposal/haat-bazaar/:id Update
 * @apiName ProjectProposalHaatMarketUpdate
 * @apiGroup Project Proposal Haat Market
 * @apiParam (Payload) {Integer{..11}} haat_bazaar_id Haat Bazaar Id comes from Haat market one API
 * @apiParam (Payload) {String{..20}} address Address 
 * @apiParam (Payload) {Number{..20}} distance_vkvd Distance VKVD
 * @apiParam (Payload) {Integer{..11}} unit Unit  comes from Unit master
 * @apiParamExample {json} Payload
 *  {
    "haat_bazaar_id": 1,
    "address": "Ghaziabaad", 
    "distance_vkvd": "12", 
    "unit": 1, 
 * }
 * @apiSuccess {Number} status Response Status
 * @apiSuccess {Object} data  JSON object for specified master resource.
 * @apiSuccess {Number} data.id Unique ID of Record
 * @apiSuccess {Number} data.haat_bazaar_id Haat Bazaar Id
 * @apiSuccess {String} data.haat_bazaar_name Haat Bazaar Name
 * @apiSuccess {String} data.address Address
 * @apiSuccess {Number} data.distance_vkvd Distance VKVD
 * @apiSuccess {Number} data.unit Unit 
 * @apiSuccessExample Success-Response:
    HTTP/1.1 200 OK
 {
    "status": 1,
    "data": {
        "id": 3,
        "haat_bazaar_id": 1,
        "haat_bazaar_name": "Test",
        "address": "Ghaziabaad",
        "distance_vkvd": "12",
        "unit": "1"
    }
}

* 
 */

 /**
 * @api {GET} project-proposal/haat-bazaar/:id View One
 * @apiName ProjectProposalHaatMarketViewOne
 * @apiGroup Project Proposal Haat Market
 * @apiParam (Parameters) {Number} id Resource ID
 *
 * @apiSuccess {Number} status Response Status
 * @apiSuccess {Object} data  JSON object for specified master resource.
 * @apiSuccess {Number} data.id Unique ID of Record
 * @apiSuccess {Number} data.haat_bazaar_id Haat Bazaar Id
 * @apiSuccess {String} data.haat_bazaar_name Haat Bazaar Name
 * @apiSuccess {String} data.address Address
 * @apiSuccess {Number} data.distance_vkvd Distance VKVD
 * @apiSuccess {Number} data.unit Unit

 * @apiSuccessExample Success-Response:
    HTTP/1.1 200 OK
 {
    "status": 1,
    "data": {
        "id": 3,
        "haat_bazaar_id": 1,
        "haat_bazaar_name": "Test",
        "address": "Ghaziabaad",
        "distance_vkvd": "12",
        "unit": "1"
    }
}

    @apiError (ERROR 4xx) {Number} status Response Status
    @apiError (Invalid Resource Id) {Number} message Error Response Message specifiying the reason for failure.
    @apiErrorExample {JSON} Invalid Resource Id
    HTTP/1.1 404 Not Found
    {
        "status": 0,
        "message": "Not found!"
    }


    }
 * 
 */

 