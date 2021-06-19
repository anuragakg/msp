/**
 * @api {get} warehouse/part-one View All
 * @apiName WarehousePartOneViewAll
 * @apiGroup Warehouse
 *
 * @apiParam (Query Parameters) {number} district District id to filter records by district (Optional)
 * @apiParam (Query Parameters) {number} block Block id to filter records by Block (Optional)
 * 
 * @apiSuccess {Number} status Response
 * @apiSuccess {Array} data Data Response
 * @apiSuccess {Number} data.id Unique ID of the resource.
 * @apiSuccess {String} data.name Warehouse Name
 * @apiSuccess {String} data.address Address of the warehouse.
 * @apiSuccess {String} data.state State Title coming from master table.
 * @apiSuccess {String} data.district District Name coming from master table.
 * @apiSuccess {String} data.block Block Name coming from master table.
 * @apiSuccess {String} data.village Village Name coming from master table.
 *
 * @apiSuccessExample Success-Response:
    HTTP/1.1 200 OK
    {
    "status": 1,
    "data": [
        {
            "id": 1,
            "name": "My Warehouse",
            "address": "noida sector 62",
            "state": "Haryana",
            "district": "Gurgaon",
            "block": "A-Block",
            "village": "Village 1"
        },
    ]
}
 * 
 */
