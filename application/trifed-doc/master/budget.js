/**
 * @api {get} masters/budget-master View All
 * @apiName BudgetMasterViewAll
 * @apiGroup Budget Master
 *
 * @apiSuccess (Payload) {Number} financial year 
 * @apiSuccess (Payload) {Number} amount 
 * @apiSuccess (Payload) {String} description 
 * @apiSuccess (Payload) {Date} sanction_order_date
 * @apiSuccess (Payload) {File} sanction_order_copy
 *
 * @apiSuccessExample Success-Response:
    HTTP/1.1 200 OK
    {
    "status": 1,
    "data": [
        {
            "id": 2,
            "financial_year": {
                "id": 1,
                "title": "2016"
            },
            "amount": 1,
            "description": "1",
            "sanction_order_date": "2019-11-02",
            "sanction_order_copy": "BudgetMaster/sanction_order_copy/Coupons.csv",
            "fund_released_date": "2019-12-02"
        }
      ]
    }
 * 
 */



/**
 * @api {get} masters/budget-master/:id View One
 * @apiName BudgetMasterViewOne
 * @apiGroup Budget Master
 *
 * @apiParam (Parameter) {Number} id Resource ID
 *
 * @apiSuccessExample Success-Response:
    HTTP/1.1 200 OK
    {
    "status": 1,
    "data": {
        "id": 2,
        "financial_year": {
            "id": 1,
            "title": "2016"
        },
        "amount": 1,
        "description": "1",
        "sanction_order_date": "2019-11-02",
        "sanction_order_copy": "BudgetMaster/sanction_order_copy/Coupons.csv",
        "fund_released_date": "2019-12-02"
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
 * @api {POST} masters/budget-master Create
 * @apiName BudgetMasterCreate
 * @apiGroup Budget Master
 *
 * @apiParam (Payload) {Number} financial year 
 * @apiParam (Payload) {Number} amount 
 * @apiParam (Payload) {String} description 
 * @apiParam (Payload) {Date} sanction_order_date
 * @apiParam (Payload) {File} sanction_order_copy
 *
 * @apiParamExample {json} Payload
   {
        financial_year:1
        amount:1
        description:1
        sanction_order_date:2019-11-2
        sanction_order_copy:file
        fund_released_date:2019-12-2
   }
 * 
 * @apiSuccessExample Success-Response:
    HTTP/1.1 200 OK
    {
        "status": 1,
        "data": {
            "id": 11,
            "financial_year": {
                "id": 1,
                "title": "2016"
            },
            "amount": "1",
            "description": "1",
            "sanction_order_date": "2019-11-2",
            "sanction_order_copy": "BudgetMaster/sanction_order_copy/Coupons.csv",
            "fund_released_date": "2019-12-2"
        }
    }
 * 
 */

/**
 * @api {PUT} masters/budget-master/:id Update
 * @apiName BudgetMasterUpdate
 * @apiGroup Budget Master
 *
 * @apiParam (Payload) {Number} financial year 
 * @apiParam (Payload) {Number} amount 
 * @apiParam (Payload) {String} description 
 * @apiParam (Payload) {Date} sanction_order_date
 * @apiParam (Payload) {File} sanction_order_copy
 *
 * @apiParamExample {json} Payload
   {
        financial_year:1
        amount:1
        description:1
        sanction_order_date:2019-11-2
        sanction_order_copy:file
        fund_released_date:2019-12-2
   }
 * 
 * @apiSuccessExample Success-Response:
    HTTP/1.1 200 OK
    {
      "status": 1,
      "data": {
          "id": 11,
          "financial_year": {
              "id": 1,
              "title": "2016"
          },
          "amount": "1",
          "description": "1",
          "sanction_order_date": "2019-11-2",
          "sanction_order_copy": "BudgetMaster/sanction_order_copy/Coupons.csv",
          "fund_released_date": "2019-12-2"
      }
    }
 * 
 */

/**
 * @api {DELETE} masters/budget-master/:id Delete
 * @apiName BudgetMasterDelete
 * @apiGroup Budget Master Master
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