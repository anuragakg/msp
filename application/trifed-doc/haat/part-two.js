/**
 * @api {POST} haat-market/part-two Create
 * @apiName HaatMarketPartTwoCreate
 * @apiGroup Haat Market Part Two
 * 
 * @apiParam (Payload) {Integer{..11}} market_type Market Id Comes from master
 * @apiParam (Payload) {Number{..20}} market_charges Market Charges
 * @apiParam (Payload) {Number{..20}} market_fees Market Fees
 * @apiParam (Payload) {Number{..20}} broker_fees Broker fees
 * @apiParam (Payload) {Number{..20}} weighing_charges Weighing Charges
 * @apiParam (Payload) {Number{..20}} sitting_charges Sitting Charges 
 * @apiParam (Payload) {Number{..20}} user_charges User Charges
 * @apiParam (Payload) {String{..20}} other_charges other Charges
 * @apiParam (Payload) {Int{..11}} boundary_wall Boundry Wall Id comes from master
 * @apiParam (Payload) {Int{..11}} built_up_area Built up area Id comes from master

 * @apiParam (Payload) {Int{..11}} access_road Access Road Id comes from master
 * @apiParam (Payload) {Int{..11}} internal_road Internal Road ID comes from master
 * @apiParam (Payload) {Int{..1}} is_godown_secured 0=No,1=Yes
 * @apiParam (Payload) {String{..20}} tonnage Tonnage
 * @apiParam (Payload) {Number{..20}} godown_area Godown Area


 * @apiParam (Payload) {Int{..1}} weigbridge Weighbridge 0=No,1=Yes
 * @apiParam (Payload) {Int{..1}} electronic_weighing_scale Electronic Weighing Scale  0=No,1=Yes
 * @apiParam (Payload) {Int{..1}} manual_weighing_scale Manula Weigning Scale  0=No,1=Yes 
 * @apiParam (Payload) {Int{..1}} number Number 0=No,1=Yes
 * @apiParam (Payload) {Int{..11}} is_demarcated_area Demarcated Area  0=No,1=Yes
 * @apiParam (Payload) {AlphaNumeric{..20}} cleaning_area Cleaning Area
 * @apiParam (Payload) {AlphaNumeric{..20}} other_infrastructure Specify Other Infrastructure
 * @apiParam (Payload) {Int{..11}} transportation Transportation Id comes from master
 * @apiParam (Payload) {Int{..11}} part_one_id Part One Form Id

 * @apiParamExample {json} Payload
 * {
        "market_type":"1",
        "market_charges":"20",
        "market_fees":"18",
        "broker_fees":"20",
        "commission_agency_charges":"12",
        "weighing_charges":"12",
        "user_charges":"12",
        "other_charges":"Test",
        "boundary_wall":"1",
        "built_up_area":"1",
        "access_road":"1",
        "internal_road":"1",
        "is_godown_secured":"1",
        "tonnage":"Test",
        "godown_area":"12",
        "weigbridge":"1",
        "electronic_weighing_scale":"1",
        "manual_weighing_scale":"1",
        "number":"1",
        "is_demarcated_area":"1",
        "cleaning_area":"Test",
        "other_infrastructure":"Test",
        "transportation":"1",
        "sitting_charges":"20",
        "part_one_id":"2"
 * }

 * @apiSuccess {Number} status Response Status
 * @apiSuccess {Object} data  JSON object for specified master resource.
 * @apiSuccess {Number} data.id Unique ID of Record
 * @apiSuccess {Number} data.market_type Market Type
 * @apiSuccess {Number} data.market_charges Market Charges
 * @apiSuccess {Number} data.market_fees Market Fees
 * @apiSuccess {Number} data.broker_fees broker_fees Broker Fees
 * @apiSuccess {Number} data.sitting_charges Sitting Charges
 * @apiSuccess {Number} data.commission_agency_charges Commission Agency Charges
 * @apiSuccess {Number} data.weighing_charges Weighing Charges
 * @apiSuccess {Number} data.User Charges
 * @apiSuccess {Number} data.other_charges Other Charges
 * @apiSuccess {Number} data.boundary_wall Boundary Wall
 * @apiSuccess {String} data.boundary_wall_name Boundary Wall Details JSON Object
 * @apiSuccess {Number} data.built_up_area Built Up Area
 * @apiSuccess {JSON} data.built_up_area_name Built Up Area Details JSON Object
 * @apiSuccess {Number} data.access_road Access Road
 * @apiSuccess {Number} data.internal_road Internal Road
 * @apiSuccess {Number} data.is_godown_secured Is Godown Secured
 * @apiSuccess {String} data.tonnage Tonnage 
 * @apiSuccess {Number} data.godown_area Godown Area
 * @apiSuccess {Number} data.weigbridge Weigbridge
 * @apiSuccess {Number} data.electronic_weighing_scale Electronic Weighing Scale
 * @apiSuccess {Number} data.manual_weighing_scale Manual Weighing Scale
 * @apiSuccess {Number} data.number Number
 * @apiSuccess {Number} data.is_demarcated_area Is Demarcated Area
 * @apiSuccess {String} data.cleaning_area Cleaning Area
 * @apiSuccess {String} data.other_infrastructure Other Infrastructure 
 * @apiSuccess {Integer} data.transportation
 * @apiSuccess {JSON} data.transportation_name Json Object
 * @apiSuccess {Integer} data.created_by Created By
 * @apiSuccess {Integer} data.updated_by Updated By

 * @apiSuccessExample Success-Response:
    HTTP/1.1 200 OK
    {
    "status": 1,
    "data": {
        "id": 4,
        "market_type": "1",
        "market_charges": "20",
        "market_fees": "18",
        "broker_fees": "20",
        "sitting_charges": "20",
        "commission_agency_charges": "12",
        "weighing_charges": "12",
        "user_charges": "12",
        "other_charges": "Test",
        "boundary_wall": 1,
        "boundary_wall_name": "Proper Boundary Wall",
        "built_up_area": 1,
        "built_up_area_name": "Proper Covered Shed",
        "access_road": "1",
        "internal_road": "1",
        "is_godown_secured": "1",
        "tonnage": "asdas",
        "godown_area": "12",
        "weigbridge": "1",
        "electronic_weighing_scale": "1",
        "manual_weighing_scale": "1",
        "number": "1",
        "is_demarcated_area": "1",
        "cleaning_area": "Test",
        "other_infrastructure": "Test",
        "transportation": 1,
        "transportation_name": "Animal Cart",
        "created_by": 0,
        "updated_by": 0
    }
}
 * 
 */

/**
 * @api {PUT} haat-market/part-two/:id Update
 * @apiName HaatMarketPartTwoUpdate
 * @apiGroup Haat Market Part Two
 * @apiParam (Parameters) {Number} id Resource ID
 * 
  * @apiParam (Payload) {Integer{..11}} market_type Market Id Comes from master
 * @apiParam (Payload) {Number{..20}} market_charges Market Charges
 * @apiParam (Payload) {Number{..20}} market_fees Market Fees
 * @apiParam (Payload) {Number{..20}} broker_fees Broker fees
 * @apiParam (Payload) {Number{..20}} weighing_charges Weighing Charges
 * @apiParam (Payload) {Number{..20}} sitting_charges Sitting Charges 
 * @apiParam (Payload) {Number{..20}} user_charges User Charges
 * @apiParam (Payload) {String{..20}} other_charges other Charges
 * @apiParam (Payload) {Int{..11}} boundary_wall Boundry Wall Id comes from master
 * @apiParam (Payload) {Int{..11}} built_up_area Built up area Id comes from master

 * @apiParam (Payload) {Int{..11}} access_road Access Road Id comes from master
 * @apiParam (Payload) {Int{..11}} internal_road Internal Road ID comes from master
 * @apiParam (Payload) {Int{..1}} is_godown_secured 0=No,1=Yes
 * @apiParam (Payload) {String{..20}} tonnage Tonnage
 * @apiParam (Payload) {Number{..20}} godown_area Godown Area


 * @apiParam (Payload) {Int{..1}} weigbridge Weighbridge 0=No,1=Yes
 * @apiParam (Payload) {Int{..1}} electronic_weighing_scale Electronic Weighing Scale  0=No,1=Yes
 * @apiParam (Payload) {Int{..1}} manual_weighing_scale Manula Weigning Scale  0=No,1=Yes 
 * @apiParam (Payload) {Int{..1}} number Number 0=No,1=Yes
 * @apiParam (Payload) {Int{..11}} is_demarcated_area Demarcated Area  0=No,1=Yes
 * @apiParam (Payload) {AlphaNumeric{..20}} cleaning_area Cleaning Area
 * @apiParam (Payload) {AlphaNumeric{..20}} other_infrastructure Specify Other Infrastructure
 * @apiParam (Payload) {Int{..11}} transportation Transportation Id comes from master
 * @apiParamExample {json} Payload
 * {
        "market_type":"1",
        "market_charges":"20",
        "market_fees":"18",
        "broker_fees":"20",
        "commission_agency_charges":"12",
        "weighing_charges":"12",
        "user_charges":"12",
        "other_charges":"Test",
        "boundary_wall":"1",
        "built_up_area":"1",
        "access_road":"1",
        "internal_road":"1",
        "is_godown_secured":"1",
        "tonnage":"Test",
        "godown_area":"12",
        "weigbridge":"1",
        "electronic_weighing_scale":"1",
        "manual_weighing_scale":"1",
        "number":"1",
        "is_demarcated_area":"1",
        "cleaning_area":"Test",
        "other_infrastructure":"Test",
        "transportation":"1",
        "sitting_charges":"20"
 * }

 * @apiSuccess {Number} status Response Status
 * @apiSuccess {Object} data  JSON object for specified master resource.
 * @apiSuccess {Number} data.id Unique ID of Record
 * @apiSuccess {Number} data.market_type Market Type
 * @apiSuccess {Number} data.market_charges Market Charges
 * @apiSuccess {Number} data.market_fees Market Fees
 * @apiSuccess {Number} data.broker_fees broker_fees Broker Fees
 * @apiSuccess {Number} data.sitting_charges Sitting Charges
 * @apiSuccess {Number} data.commission_agency_charges Commission Agency Charges
 * @apiSuccess {Number} data.weighing_charges Weighing Charges
 * @apiSuccess {Number} data.User Charges
 * @apiSuccess {Number} data.other_charges Other Charges
 * @apiSuccess {Number} data.boundary_wall Boundary Wall
 * @apiSuccess {String} data.boundary_wall_name Boundary Wall Name
 * @apiSuccess {Number} data.built_up_area Built Up Area
 * @apiSuccess {String} data.built_up_area_name Built Up Area Name
 * @apiSuccess {Number} data.access_road Access Road
 * @apiSuccess {Number} data.internal_road Internal Road
 * @apiSuccess {Number} data.is_godown_secured Is Godown Secured
 * @apiSuccess {String} data.tonnage Tonnage 
 * @apiSuccess {Number} data.godown_area Godown Area
 * @apiSuccess {Number} data.weigbridge Weigbridge
 * @apiSuccess {Number} data.electronic_weighing_scale Electronic Weighing Scale
 * @apiSuccess {Number} data.manual_weighing_scale Manual Weighing Scale
 * @apiSuccess {Number} data.number Number
 * @apiSuccess {Number} data.is_demarcated_area Is Demarcated Area
 * @apiSuccess {String} data.cleaning_area Cleaning Area
 * @apiSuccess {String} data.other_infrastructure Other Infrastructure 
 * @apiSuccess {Integer} data.transportation Transportation
 * @apiSuccess {String} data.transportation_name Transportation Name
 * @apiSuccess {Integer} data.created_by Created By
 * @apiSuccess {Integer} data.updated_by Updated By
 * @apiSuccessExample Success-Response:
    HTTP/1.1 200 OK
       {
    "status": 1,
    "data": {
        "id": 4,
        "market_type": "1",
        "market_charges": "20",
        "market_fees": "18",
        "broker_fees": "20",
        "sitting_charges": "20",
        "commission_agency_charges": "12",
        "weighing_charges": "12",
        "user_charges": "12",
        "other_charges": "Test",
        "boundary_wall": 1,
        "boundary_wall_name": "Proper Boundary Wall",
        "built_up_area": 1,
        "built_up_area_name": "Proper Covered Shed",
        "access_road": "1",
        "internal_road": "1",
        "is_godown_secured": "1",
        "tonnage": "asdas",
        "godown_area": "12",
        "weigbridge": "1",
        "electronic_weighing_scale": "1",
        "manual_weighing_scale": "1",
        "number": "1",
        "is_demarcated_area": "1",
        "cleaning_area": "Test",
        "other_infrastructure": "Test",
        "transportation": 1,
        "transportation_name": "Animal Cart",
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

 /**
 * @api {GET} haat-market/part-two View All
 * @apiName HaatMarketPartTwoViewAll
 * @apiGroup Haat Market Part Two
 * 
 
* @apiSuccess {Number} status Response Status
 * @apiSuccess {Object} data  JSON object for specified master resource.
 * @apiSuccess {Number} data.id Unique ID of Record
 * @apiSuccess {Number} data.market_type Market Type
 * @apiSuccess {Number} data.market_charges Market Charges
 * @apiSuccess {Number} data.market_fees Market Fees
 * @apiSuccess {Number} data.broker_fees broker_fees Broker Fees
 * @apiSuccess {Number} data.sitting_charges Sitting Charges
 * @apiSuccess {Number} data.commission_agency_charges Commission Agency Charges
 * @apiSuccess {Number} data.weighing_charges Weighing Charges
 * @apiSuccess {Number} data.User Charges
 * @apiSuccess {Number} data.other_charges Other Charges
 * @apiSuccess {Number} data.boundary_wall Boundary Wall
 * @apiSuccess {JSON} data.boundary_wall_details Boundary Wall Details JSON Object
 * @apiSuccess {Number} data.built_up_area Built Up Area
 * @apiSuccess {JSON} data.built_up_area_details Built Up Area Details JSON Object
 * @apiSuccess {Number} data.access_road Access Road
 * @apiSuccess {Number} data.internal_road Internal Road
 * @apiSuccess {Number} data.is_godown_secured Is Godown Secured
 * @apiSuccess {String} data.tonnage Tonnage 
 * @apiSuccess {Number} data.godown_area Godown Area
 * @apiSuccess {Number} data.weigbridge Weigbridge
 * @apiSuccess {Number} data.electronic_weighing_scale Electronic Weighing Scale
 * @apiSuccess {Number} data.manual_weighing_scale Manual Weighing Scale
 * @apiSuccess {Number} data.number Number
 * @apiSuccess {Number} data.is_demarcated_area Is Demarcated Area
 * @apiSuccess {String} data.cleaning_area Cleaning Area
 * @apiSuccess {String} data.other_infrastructure Other Infrastructure 
 * @apiSuccess {Integer} data.transportation
 * @apiSuccess {JSON} data.transportation_details Json Object
 * @apiSuccess {Integer} data.created_by Created By
 * @apiSuccess {Integer} data.updated_by Updated By

 * @apiSuccessExample Success-Response:
    HTTP/1.1 200 OK
    {
    "status": 1,
    "data": [
        {
            "id": 2,
            "market_type": 1,
            "market_charges": 20,
            "market_fees": 18,
            "broker_fees": 20,
            "sitting_charges": 20,
            "commission_agency_charges": 12,
            "weighing_charges": 12,
            "user_charges": 12,
            "other_charges": "asdspp",
            "boundary_wall": 1,
            "boundary_wall_name": "Proper Boundary Wall",
            "built_up_area": 1,
            "built_up_area_name": "Proper Covered Shed",
            "access_road": 1,
            "internal_road": 1,
            "is_godown_secured": 1,
            "tonnage": "asdas",
            "godown_area": 12,
            "weigbridge": 1,
            "electronic_weighing_scale": 1,
            "manual_weighing_scale": 1,
            "number": "1",
            "is_demarcated_area": 1,
            "cleaning_area": "aass",
            "other_infrastructure": "aaa",
            "transportation": 1,
            "transportation_name": "Animal Cart",
            "created_by": 0,
            "updated_by": 0
        },
        {
            "id": 3,
            "market_type": 1,
            "market_charges": 20,
            "market_fees": 18,
            "broker_fees": 20,
            "sitting_charges": 20,
            "commission_agency_charges": 12,
            "weighing_charges": 12,
            "user_charges": 12,
            "other_charges": "asds",
            "boundary_wall": 1,
            "boundary_wall_name": "Proper Boundary Wall",
            "built_up_area": 1,
            "built_up_area_name": "Proper Covered Shed",
            "access_road": 1,
            "internal_road": 1,
            "is_godown_secured": 1,
            "tonnage": "asdas",
            "godown_area": 12,
            "weigbridge": 1,
            "electronic_weighing_scale": 1,
            "manual_weighing_scale": 1,
            "number": "1",
            "is_demarcated_area": 1,
            "cleaning_area": "aass",
            "other_infrastructure": "aaa",
            "transportation": 1,
            "transportation_name": "Animal Cart",
            "created_by": 0,
            "updated_by": 0
        },
        {
            "id": 4,
            "market_type": 1,
            "market_charges": 20,
            "market_fees": 18,
            "broker_fees": 20,
            "sitting_charges": 20,
            "commission_agency_charges": 12,
            "weighing_charges": 12,
            "user_charges": 12,
            "other_charges": "asds",
            "boundary_wall": 1,
            "boundary_wall_name": "Proper Boundary Wall",
            "built_up_area": 1,
            "built_up_area_name": "Proper Covered Shed",
            "access_road": 1,
            "internal_road": 1,
            "is_godown_secured": 1,
            "tonnage": "asdas",
            "godown_area": 12,
            "weigbridge": 1,
            "electronic_weighing_scale": 1,
            "manual_weighing_scale": 1,
            "number": "1",
            "is_demarcated_area": 1,
            "cleaning_area": "aass",
            "other_infrastructure": "aaa",
            "transportation": 1,
            "transportation_name": "Animal Cart",
            "created_by": 0,
            "updated_by": 0
        }
    ]
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


 /**
 * @api {GET} haat-market/part-two/:id View One
 * @apiName HaatMarketPartOneViewTwo
 * @apiGroup Haat Market Part Two
 * @apiParam (Parameters) {Number} id Resource ID
 *
 * @apiSuccess {Number} status Response Status
 * @apiSuccess {Object} data  JSON object for specified master resource.
 * @apiSuccess {Number} data.id Unique ID of Record
 * @apiSuccess {Number} data.market_type Market Type
 * @apiSuccess {Number} data.market_charges Market Charges
 * @apiSuccess {Number} data.market_fees Market Fees
 * @apiSuccess {Number} data.broker_fees broker_fees Broker Fees
 * @apiSuccess {Number} data.sitting_charges Sitting Charges
 * @apiSuccess {Number} data.commission_agency_charges Commission Agency Charges
 * @apiSuccess {Number} data.weighing_charges Weighing Charges
 * @apiSuccess {Number} data.User Charges
 * @apiSuccess {Number} data.other_charges Other Charges
 * @apiSuccess {Number} data.boundary_wall Boundary Wall
 * @apiSuccess {JSON} data.boundary_wall_details Boundary Wall Details JSON Object
 * @apiSuccess {Number} data.built_up_area Built Up Area
 * @apiSuccess {JSON} data.built_up_area_details Built Up Area Details JSON Object
 * @apiSuccess {Number} data.access_road Access Road
 * @apiSuccess {Number} data.internal_road Internal Road
 * @apiSuccess {Number} data.is_godown_secured Is Godown Secured
 * @apiSuccess {String} data.tonnage Tonnage 
 * @apiSuccess {Number} data.godown_area Godown Area
 * @apiSuccess {Number} data.weigbridge Weigbridge
 * @apiSuccess {Number} data.electronic_weighing_scale Electronic Weighing Scale
 * @apiSuccess {Number} data.manual_weighing_scale Manual Weighing Scale
 * @apiSuccess {Number} data.number Number
 * @apiSuccess {Number} data.is_demarcated_area Is Demarcated Area
 * @apiSuccess {String} data.cleaning_area Cleaning Area
 * @apiSuccess {String} data.other_infrastructure Other Infrastructure 
 * @apiSuccess {Integer} data.transportation
 * @apiSuccess {JSON} data.transportation_details Json Object
 * @apiSuccess {Integer} data.created_by Created By
 * @apiSuccess {Integer} data.updated_by Updated By

 * @apiSuccessExample Success-Response:
    HTTP/1.1 200 OK
    {
    "status": 1,
    "data": {
        "id": 2,
        "market_type": 1,
        "market_charges": 20,
        "market_fees": 18,
        "broker_fees": 20,
        "sitting_charges": 20,
        "commission_agency_charges": 12,
        "weighing_charges": 12,
        "user_charges": 12,
        "other_charges": "asdspp",
        "boundary_wall": {
            "id": 1,
            "title": "Proper Boundary Wall"
        },
        "built_up_area": {
            "id": 1,
            "title": "Proper Covered Shed"
        },
        "access_road": 1,
        "internal_road": 1,
        "is_godown_secured": 1,
        "tonnage": "asdas",
        "godown_area": 12,
        "weigbridge": 1,
        "electronic_weighing_scale": 1,
        "manual_weighing_scale": 1,
        "number": "1",
        "is_demarcated_area": 1,
        "cleaning_area": "aass",
        "other_infrastructure": "aaa",
        "transportation": {
            "id": 1,
            "title": "Animal Cart"
        },
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

