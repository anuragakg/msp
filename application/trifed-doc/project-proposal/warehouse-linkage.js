/**
 * @api {POST} project-proposal/warehouse Create
 * @apiName ProjectProposalWareHouseCreate
 * @apiGroup Project Proposal Warehouse
 * 
 * @apiParam (Payload) {Integer{..11}} warehouse_id Warehouse Id comes from Ware House one API
 * @apiParam (Payload) {String{..20}} address Address 
 * @apiParam (Payload) {Number{..20}} distance_vkvd Distance VKVD
 * @apiParam (Payload) {Integer{..11}} unit Unit  comes from Unit master

 * @apiParamExample {json} Payload
 * {
    "warehouse_id": 1,
    "address": "Noida", 
    "distance_vkvd": "12", 
    "unit": 1, 
 * }
 * @apiSuccess {Number} status Response Status
 * @apiSuccess {Object} data  JSON object for specified master resource.
 * @apiSuccess {Number} data.id Unique ID of Record
 * @apiSuccess {Number} data.warehouse_id Warehouse Id
 * @apiSuccess {String} data.warehouse_name Warehouse Name
 * @apiSuccess {String} data.address Address
 * @apiSuccess {Number} data.distance_vkvd Distance VKVD
 * @apiSuccess {Number} data.unit Unit
 * @apiSuccessExample Success-Response:
    HTTP/1.1 200 OK
    {
    "status": 1,
    "data": {
        "id": 3,
        "warehouse_id": 1,
        "warehouse_name": "Test",
        "address": "Noida",
        "distance_vkvd": "12"
        "unit": "1"
    }
}
 * 
 */

/**
 * @api {PUT} project-proposal/warehouse/:id Update
 * @apiName ProjectProposalWareHouseUpdate
 * @apiGroup Project Proposal Warehouse
 * @apiParam (Payload) {Integer{..11}} haat_bazaar_id Haat Bazaar Id comes from Haat market one API
 * @apiParam (Payload) {String{..20}} address Address 
 * @apiParam (Payload) {Number{..20}} distance_vkvd Distance VKVD
 * @apiParam (Payload) {Integer{..11}} unit Unit  comes from Unit master
 * @apiParamExample {json} Payload
 * {
    "warehouse_id": 1,
    "address": "Noida", 
    "distance_vkvd": "12", 
    "unit": 1, 
 * }
 * @apiSuccess {Number} status Response Status
 * @apiSuccess {Object} data  JSON object for specified master resource.
 * @apiSuccess {Number} data.id Unique ID of Record
 * @apiSuccess {Number} data.warehouse_id Warehouse Id
 * @apiSuccess {String} data.warehouse_name Warehouse Name
 * @apiSuccess {String} data.address Address
 * @apiSuccess {Number} data.distance_vkvd Distance VKVD
 * @apiSuccess {Number} data.unit Unit
 * @apiSuccessExample Success-Response:
    HTTP/1.1 200 OK
 {
    "status": 1,
    "data": {
        "id": 3,
        "warehouse_id": 1,
        "warehouse_name": "Test",
        "address": "Noida",
        "distance_vkvd": "12",
        "unit": "1"
    }
}

* 
 */

 /**
 * @api {GET} project-proposal/warehouse/:id View One
 * @apiName ProjectProposalWareHouseViewOne
 * @apiGroup Project Proposal Warehouse
 * @apiParam (Parameters) {Number} id Resource ID
 *
 * @apiSuccess {Number} status Response Status
 * @apiSuccess {Object} data  JSON object for specified master resource.
 * @apiSuccess {Number} data.id Unique ID of Record
 * @apiSuccess {Number} data.warehouse_id Warehouse Id
 * @apiSuccess {String} data.warehouse_name Warehouse Name
 * @apiSuccess {String} data.address Address
 * @apiSuccess {Number} data.distance_vkvd Distance VKVD

 * @apiSuccessExample Success-Response:
    HTTP/1.1 200 OK
 {
    "status": 1,
    "data": {
        "id": 3,
        "warehouse_id": 1,
        "warehouse_name": "Test",
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

 