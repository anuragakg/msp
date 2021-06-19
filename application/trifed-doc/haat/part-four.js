/**
 * @api {POST} haat-market/part-four Create
 * @apiName HaatMarketPartFourCreate
 * @apiGroup Haat Market Part Four
 * 
 * @apiParam (Payload) {Integer{..1}} cleaning_and_sanitation Cleaning And Sanitation 0=No,1=Yes
 * @apiParam (Payload) {Integer{..1}} garbage_collection Garbage Collection 0=No,1=Yes
 * @apiParam (Payload) {Integer{..1}} waste_utilization Waste Utilization 0=No,1=Yes
 * @apiParam (Payload) {Integer{..1}} other_facility Other Facility 0=No,1=Yes
 * @apiParam (Payload) {Integer{..1}} remarks Remarks 0=No,1=Yes
 * @apiParam (Payload) {Number{..20}} annual_income Annual Income
 * @apiParam (Payload) {Number{..20}} latitude Latitude
 * @apiParam (Payload) {Number{..20}} longitude Longitude
 * @apiParam (Payload) {Number{..20}} nearest_apmc_distance Nearest Apmc Distance
 * @apiParam (Payload) {Integer{..1}} expenditure_no Expenditure No. 0=No,1=Yes

 * @apiParam (Payload) {String{..20}} head_of_expenditure Head Of Expenditure 
 * @apiParam (Payload) {Integer{..1}} amount Amount 0=No,1=Yes
 * @apiParam (Payload) {JSON} haat_bazaar_annual_expenditure Haat Bazaar Annual Expenditure Json Array
 * @apiParam (Payload) {JSON} haat_bazaar_mfp_commodities Haat Bazaar Mfp Commodities Json Array
 * @apiParam (Payload) {JSON} haat_bazaar_procurement_agent Haat Bazaar Procurement Agent Json Array
 * @apiParam (Payload) {Integer{..11}} part_one_id Part One Form Id


 * @apiParamExample {json} Payload
 * {
        "cleaning_and_sanitation": "0",
        "garbage_collection": "1",
        "waste_utilization": "1",
        "other_facility": "1",
        "remarks": "0",
        "annual_income": "19",
        "latitude": "26.21312",
        "longitude": "58.12323423",
        "haat_bazaar_annual_expenditure": {"haat_data" : [{"expenditure_no":"1","head_of_expenditure":"Ankit","amount":"10"},{"expenditure_no":"2","head_of_expenditure":"AK","amount":"10"}]},
        "haat_bazaar_mfp_commodities": {"haat_data" : [{"commodity":"1","annual_quantity":"10"},{"commodity":"2","annual_quantity":"11"}]},
        "haat_bazaar_procurement_agent": {"haat_data" : [{"name":"Ankit","mobile_no":"7488853532","landline_no":"011182828","address":"Delhi","category_ids":"1","state":"1","district":"1","block":"1"},{"name":"Ankit K","mobile_no":"7488853532","landline_no":"011182828","address":"Delhi","category_ids":"1","state":"1","district":"1","block":"1"}]}
*   }
 * @apiSuccess {Number} status Response Status
 * @apiSuccess {Object} data  JSON object for specified master resource.
 * @apiSuccess {Number} data.id Unique ID of Record
 * @apiSuccess {Number} data.cleaning_and_sanitation Cleaning And Sanitation
 * @apiSuccess {Number} data.garbage_collection Garbage Collection
 * @apiSuccess {Number} data.waste_utilization Waste Utilization
 * @apiSuccess {Number} data.other_facility Other Facility
 * @apiSuccess {Number} data.remarks Remarks
 * @apiSuccess {Number} data.annual_income Annual Income
 * @apiSuccess {Number} data.latitude Latitude
 * @apiSuccess {Number} data.longitude Longitude
 * @apiSuccess {JSON} data.haat_bazaar_annual_expenditure Haat Bazaar Annual Expenditure
 * @apiSuccess {JSON} data.haat_bazaar_mfp_commodities Haat Bazaar Mfp Commodities
 * @apiSuccess {JSON} data.haat_bazaar_procurement_agent Haat Bazaar Procurement Agent
 * @apiSuccess {Number} data.created_by Created By
 * @apiSuccess {String} data.updated_by Updated By
 * @apiSuccessExample Success-Response:
    HTTP/1.1 200 OK
    {
    "status": 1,
    "data": {
        "id": 23,
        "cleaning_and_sanitation": "0",
        "garbage_collection": "1",
        "waste_utilization": "1",
        "other_facility": "1",
        "remarks": "0",
        "annual_income": "19",
        "latitude": "26.21312",
        "longitude": "58.12323423",
        "haat_bazaar_annual_expenditure": {"haat_data":[
            {
                "id": 181,
                "form_id": 23,
                "expenditure_no": 1,
                "head_of_expenditure": "Ankit",
                "amount": 10
            },
            {
                "id": 182,
                "form_id": 23,
                "expenditure_no": 2,
                "head_of_expenditure": "AK",
                "amount": 10
            }
        ]},
        "haat_bazaar_mfp_commodities": {"haat_data":[
            {
                "id": 139,
                "form_id": 23,
                "type": 0,
                "entity_id": 0,
                "commodity": 1,
                "annual_quantity": 10
            },
            {
                "id": 140,
                "form_id": 23,
                "type": 0,
                "entity_id": 0,
                "commodity": 2,
                "annual_quantity": 11
            }
        ]},
        "haat_bazaar_procurement_agent": {"haat_data":[
            {
                "id": 131,
                "form_id": 23,
                "name": "Ankit",
                "mobile_no": 7488853532,
                "landline_no": 11182828,
                "address": "Delhi",
                "category_ids": "1",
                "state": 1,
                "district": 1,
                "block": 1
            },
            {
                "id": 132,
                "form_id": 23,
                "name": "Ankit K",
                "mobile_no": 7488853532,
                "landline_no": 11182828,
                "address": "Delhi",
                "category_ids": "1",
                "state": 1,
                "district": 1,
                "block": 1
            }
        ]},
        "created_by": 0,
        "updated_by": 0
    }
}
 * 
 */

/**
 * @api {PUT} haat-market/part-four/:id Update
 * @apiName HaatMarketPartFourUpdate
 * @apiGroup Haat Market Part Four
 * @apiParam (Payload) {Integer{..1}} cleaning_and_sanitation Cleaning And Sanitation 0=No,1=Yes
 * @apiParam (Payload) {Integer{..1}} garbage_collection Garbage Collection 0=No,1=Yes
 * @apiParam (Payload) {Integer{..1}} waste_utilization Waste Utilization 0=No,1=Yes
 * @apiParam (Payload) {Integer{..1}} other_facility Other Facility 0=No,1=Yes
 * @apiParam (Payload) {Integer{..1}} remarks Remarks 0=No,1=Yes
 * @apiParam (Payload) {Number{..20}} annual_income Annual Income
 * @apiParam (Payload) {Number{..20}} latitude Latitude
 * @apiParam (Payload) {Number{..20}} longitude Longitude
 * @apiParam (Payload) {Number{..20}} nearest_apmc_distance Nearest Apmc Distance
 * @apiParam (Payload) {Integer{..1}} expenditure_no Expenditure No. 0=No,1=Yes
 * @apiParam (Payload) {String{..20}} head_of_expenditure Head Of Expenditure 
 * @apiParam (Payload) {Integer{..1}} amount Amount 0=No,1=Yes
 * @apiParam (Payload) {String} haat_bazaar_annual_expenditure Haat Bazaar Annual Expenditure  JSON Array
 * @apiParam (Payload) {String} haat_bazaar_mfp_commodities Haat Bazaar Mfp Commodities JSON Array
 * @apiParam (Payload) {String} haat_bazaar_procurement_agent Haat Bazaar Procurement Agent JSON Array
 * @apiParamExample {json} Payload
   * {
        "cleaning_and_sanitation": "0",
        "garbage_collection": "1",
        "waste_utilization": "1",
        "other_facility": "1",
        "remarks": "0",
        "annual_income": "19",
        "latitude": "26.21312",
        "longitude": "58.12323423",
        "haat_bazaar_annual_expenditure": {"haat_data" : [{"expenditure_no":"1","head_of_expenditure":"Ankit","amount":"10"},{"expenditure_no":"2","head_of_expenditure":"AK","amount":"10"}]},
        "haat_bazaar_mfp_commodities": {"haat_data" : [{"commodity":"1","annual_quantity":"10"},{"commodity":"2","annual_quantity":"11"}]},
        "haat_bazaar_procurement_agent": {"haat_data" : [{"name":"Ankit","mobile_no":"7488853532","landline_no":"011182828","address":"Delhi","category_ids":"1","state":"1","district":"1","block":"1"},{"name":"Ankit K","mobile_no":"7488853532","landline_no":"011182828","address":"Delhi","category_ids":"1","state":"1","district":"1","block":"1"}]}
 *   }
 * @apiSuccess {Number} status Response Status
 * @apiSuccess {Object} data  JSON object for specified master resource.
 * @apiSuccess {Number} data.id Unique ID of Record
 * @apiSuccess {Number} status Response Status
 * @apiSuccess {Object} data  JSON object for specified master resource.
 * @apiSuccess {Number} data.id Unique ID of Record
 * @apiSuccess {Number} data.cleaning_and_sanitation Cleaning And Sanitation
 * @apiSuccess {Number} data.garbage_collection Garbage Collection
 * @apiSuccess {Number} data.waste_utilization Waste Utilization
 * @apiSuccess {Number} data.other_facility Other Facility
 * @apiSuccess {Number} data.remarks Remarks
 * @apiSuccess {Number} data.annual_income Annual Income
 * @apiSuccess {Number} data.latitude Latitude
 * @apiSuccess {Number} data.longitude Longitude
 * @apiSuccess {String} data.haat_bazaar_annual_expenditure Haat Bazaar Annual Expenditure JSON Array
 * @apiSuccess {String} data.haat_bazaar_mfp_commodities Haat Bazaar Mfp Commodities JSON Array
 * @apiSuccess {String} data.haat_bazaar_procurement_agent Haat Bazaar Procurement Agent JSON Array
 * @apiSuccess {Number} data.created_by Created By
 * @apiSuccess {String} data.updated_by Updated By
 * @apiSuccessExample Success-Response:
    HTTP/1.1 200 OK
 {
    "status": 1,
    "data": {
        "id": 19,
        "cleaning_and_sanitation": "0",
        "garbage_collection": "1",
        "waste_utilization": "1",
        "other_facility": "1",
        "remarks": "1",
        "annual_income": "19",
        "latitude": "26.21312",
        "longitude": "58.12323423",
        "haat_bazaar_annual_expenditure": {"haat_data":[
            {
                "id": 183,
                "form_id": 19,
                "expenditure_no": 1,
                "head_of_expenditure": "Ankit",
                "amount": 10
            },
            {
                "id": 184,
                "form_id": 19,
                "expenditure_no": 2,
                "head_of_expenditure": "AK",
                "amount": 10
            }
        ]},
        "haat_bazaar_mfp_commodities": {"haat_data":[
            {
                "id": 141,
                "form_id": 19,
                "type": 0,
                "entity_id": 0,
                "commodity": 1,
                "annual_quantity": 10
            },
            {
                "id": 142,
                "form_id": 19,
                "type": 0,
                "entity_id": 0,
                "commodity": 2,
                "annual_quantity": 11
            }
        ]},
        "haat_bazaar_procurement_agent": {"haat_data":[
            {
                "id": 133,
                "form_id": 19,
                "name": "Ankit",
                "mobile_no": 7488853532,
                "landline_no": 11182828,
                "address": "Delhi",
                "category_ids": "1",
                "state": 1,
                "district": 1,
                "block": 1
            },
            {
                "id": 134,
                "form_id": 19,
                "name": "Ankit K",
                "mobile_no": 7488853532,
                "landline_no": 11182828,
                "address": "Delhi",
                "category_ids": "1",
                "state": 1,
                "district": 1,
                "block": 1
            }
        ]},
        "created_by": 0,
        "updated_by": 0
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

 