/**
 * @api {POST} haat-market/part-one Create
 * @apiName HaatMarketPartOneCreate
 * @apiGroup Haat Market Part One
 * 
 * @apiParam (Payload) {String{..100}} rpm_name RPM Name
 * @apiParam (Payload) {String{..11}} rpm_location RPM Location
 * @apiParam (Payload) {String{..20}} address Address
 * @apiParam (Payload) {Int{..11}} state Unique ID of State
 * @apiParam (Payload) {Int{..11}} district Unique ID of District
 * @apiParam (Payload) {Int{..11}} block Unique ID of Block
 * @apiParam (Payload) {String{..25}} gram_panchayat Gram Panchayat
 * @apiParam (Payload) {Int{..11}} village Unique ID of Village
 * @apiParam (Payload) {Int{..11}} pin_code PIN Code
 * @apiParam (Payload) {Int{..1}} rpm_ownership RPM Ownership
 * @apiParam (Payload) {String{..11}} operating_rpm Operating RPM
 * @apiParam (Payload) {Int{..11}} premises_rpm Unique ID of Premises RPM
 * @apiParam (Payload) {Int{..11}} is_on_rent 0=No,1=Yes
 * @apiParam (Payload) {Number{..20}} rate_per_annum Rent Per Annum
 * @apiParam (Payload) {Int{..11}} market_regulation Unique ID of Market Regulation
 * @apiParam (Payload) {Int{..1}} regulation_type
 * @apiParam (Payload) {Int{..11}} periodicity Unique ID of Periodicity
 * @apiParam (Payload) {Int{..11}} working_days Number of working days
 * @apiParam (Payload) {Int{..11}} sale_start_time Sale Start Time
 * @apiParam (Payload) {Int{..11}} sale_end_time Sale End Time
 * @apiParam (Payload) {Int{..11}} staff_size Staff size
 * @apiParam (Payload) {AlphaNumeric{..20}} nearest_railway_station Nearest Railway Station
 * @apiParam (Payload) {Numeric{..20}} railway_distance Railway Distance
 * @apiParam (Payload) {AlphaNumeric{..20}} nearest_highway Nearest Highway
 * @apiParam (Payload) {Numeric{..20}} highway_distance Highway Distance
 * @apiParam (Payload) {AlphaNumeric{..20}} nearest_apmc_market Nearest Apmc Market
 * @apiParam (Payload) {Numeric{..20}} apmc_distance Apmc Distance
 * @apiParam (Payload) {AlphaNumeric{..20}} nearest_bus_stand Nearest Bus Stand
 * @apiParam (Payload) {Numeric{..20}} apmc_distance Apmc Distance
 * @apiParam (Payload) {JSON} other_haat_bazaar
 * @apiParamExample {json} Payload
 * {
        "rpm_name": "Test",
        "rpm_location": "Test Location",
        "address": "Test Address",
        "state": "1",
        "district": "1",
        "block": "1",
        "gram_panchayat": "Gram Panchayat Name",
        "village": "1",
        "pin_code": "201301",
        "rpm_ownership": "1",
        "operating_rpm": "Lorem Ipsum",
        "premises_rpm": "1",
        "is_on_rent": "1",
        "rate_per_annum": "20",
        "market_regulation": "1",
        "regulation_type": "1",
        "periodicity": "1",
        "working_days": "18",
        "sale_start_time": "10",
        "sale_end_time": "10",
        "staff_size": "20",
        "nearest_railway_station": "Test",
        "railway_distance": "18",
        "nearest_highway": "Test",
        "highway_distance": "18",
        "nearest_apmc_market": "Test",
        "apmc_distance": "18",
        "agmarknet_node": "8",
        "nearest_bus_stand": "Test",
        "other_haat_bazaar": {"haat_data" : [{"name":"ohb1","distance":"10"},{"name":"ohb2","distance":"11"}]}
 * }

 * @apiSuccess {Number} status Response Status
 * @apiSuccess {Object} data  JSON object for specified master resource.
 * @apiSuccess {Number} data.id Unique ID of Record
 * @apiSuccess {String} data.rpm_name RPM Name
 * @apiSuccess {String} data.rpm_location RPM Location
 * @apiSuccess {String} data.address Address
 * @apiSuccess {Number} data.state Unique ID of State
 * @apiSuccess {String} data.state_name Name of State
 * @apiSuccess {Number} data.district Unique ID of District
 * @apiSuccess {String} data.district_name Name of District
 * @apiSuccess {Number} data.block Unique ID of Block
 * @apiSuccess {String} data.block_name Name of Block
 * @apiSuccess {String} data.gram_panchayat Gram Panchayat
 * @apiSuccess {Number} data.village Unique ID of Village
 * @apiSuccess {String} data.village_name Name of Village
 * @apiSuccess {Number} data.pin_code PIN Code
 * @apiSuccess {Number} data.rpm_ownership RPM Ownership
 * @apiSuccess {String} data.operating_rpm Operating RPM
 * @apiSuccess {Number} data.premises_rpm Unique ID of Premises RPM
 * @apiSuccess {Number} data.is_on_rent 0=No,1=Yes
 * @apiSuccess {Number} data.rate_per_annum Rent Per Annum
 * @apiSuccess {Number} data.market_regulation Unique ID of Market Regulation
 * @apiSuccess {Number} data.regulation_type 
 * @apiSuccess {Number} data.periodicity Unique ID of Periodicity
 * @apiSuccess {Number} data.working_days Number of working days
 * @apiSuccess {Number} data.sale_start_time Sale Start Time
 * @apiSuccess {Number} data.sale_end_time Sale End Time
 * @apiSuccess {Number} data.staff_size Staff size
 * @apiSuccess {Number} data.created_by Created By
 * @apiSuccess {Number} data.updated_by Updated By
 * @apiSuccess {String} data.linkage Json Object 
 * @apiSuccess {String} data.other_haat_bazaar Json Array

 * @apiSuccessExample Success-Response:
    HTTP/1.1 200 OK
    {
        "status": 1,
        "data": {
            "id": 9,
            "rpm_name": "Test",
            "rpm_location": "Test Location",
            "address": "Test Address",
            "state": "1",
            "state_name": "Test State",
            "district": "1",
            "district_name": "Test District",
            "block": "1",
            "block_name": "Test Block",
            "gram_panchayat": "Gram Panchayat Name",
            "village": "1",
            "village_name": "Test Village",
            "pin_code": "201301",
            "rpm_ownership": "1",
            "operating_rpm": "Lorem Ipsum",
            "premises_rpm": "1",
            "is_on_rent": "1",
            "rate_per_annum": "20",
            "market_regulation": "1",
            "regulation_type": "1",
            "periodicity": "1",
            "working_days": "18",
            "sale_start_time": "10",
            "sale_end_time": "10",
            "staff_size": "20",
            "created_by": 0,
            "updated_by": 0,
            "linkage": {
            "id": 28,
            "form_id": 30,
            "nearest_railway_station": "tt",
            "railway_distance": "11.00",
            "nearest_highway": "gg",
            "highway_distance": "20.00",
            "nearest_apmc_market": "ff",
            "apmc_distance": "10.00",
            "nearest_bus_stand": "ASA",
            "agmarknet_node": 8,
            "created_by": 0,
            "created_at": "2019-11-04 12:47:04",
            "updated_at": "2019-11-04 12:47:04",
            "deleted_at": null
        },
        "other_haat_bazaar": {"haat_data" :[
            {
                "id": 91,
                "entity_id": 0,
                "form_type": 0,
                "form_id": 30,
                "haat_bazaar_name": "ohb1",
                "haat_bazaar_distance": 10,
                "premises_warehouse_id": 0,
                "created_by": 0,
                "updated_by": 0,
                "created_at": "2019-11-04 12:47:04",
                "updated_at": "2019-11-04 12:47:04",
                "deleted_at": null
            },
            {
                "id": 92,
                "entity_id": 0,
                "form_type": 0,
                "form_id": 30,
                "haat_bazaar_name": "ohb2",
                "haat_bazaar_distance": 11,
                "premises_warehouse_id": 0,
                "created_by": 0,
                "updated_by": 0,
                "created_at": "2019-11-04 12:47:04",
                "updated_at": "2019-11-04 12:47:04",
                "deleted_at": null
            }
        ] }
        }
    }
 * 
 */

/**
 * @api {PUT} haat-market/part-one/:id Update
 * @apiName HaatMarketPartOneUpdate
 * @apiGroup Haat Market Part One
 * @apiParam (Parameters) {Number} id Resource ID
 * 
 * @apiParam (Payload) {String{..100}} rpm_name RPM Name
 * @apiParam (Payload) {String{..11}} rpm_location RPM Location
 * @apiParam (Payload) {String{..11}} address Address
 * @apiParam (Payload) {Int{..11}} state Unique ID of State
 * @apiParam (Payload) {Int{..11}} district Unique ID of District
 * @apiParam (Payload) {Int{..11}} block Unique ID of Block
 * @apiParam (Payload) {String{..25}} gram_panchayat Gram Panchayat
 * @apiParam (Payload) {Int{..11}} village Unique ID of Village
 * @apiParam (Payload) {Int{..11}} pin_code PIN Code
 * @apiParam (Payload) {Int{..1}} rpm_ownership RPM Ownership
 * @apiParam (Payload) {String{..11}} operating_rpm Operating RPM
 * @apiParam (Payload) {Int{..11}} premises_rpm Unique ID of Premises RPM
 * @apiParam (Payload) {Int{..11}} is_on_rent 0=No,1=Yes
 * @apiParam (Payload) {Number{..20}} rate_per_annum Rent Per Annum
 * @apiParam (Payload) {Int{..11}} market_regulation Unique ID of Market Regulation
 * @apiParam (Payload) {Int{..1}} regulation_type
 * @apiParam (Payload) {Int{..11}} periodicity Unique ID of Periodicity
 * @apiParam (Payload) {Int{..11}} working_days Number of working days
 * @apiParam (Payload) {Int{..11}} sale_start_time Sale Start Time
 * @apiParam (Payload) {Int{..11}} sale_end_time Sale End Time
 * @apiParam (Payload) {Int{..11}} staff_size Staff size
 * @apiParam (Payload) {AlphaNumeric{..20}} nearest_railway_station Nearest Railway Station
 * @apiParam (Payload) {Numeric{..20}} railway_distance Railway Distance
 * @apiParam (Payload) {AlphaNumeric{..20}} nearest_highway Nearest Highway
 * @apiParam (Payload) {Numeric{..20}} highway_distance Highway Distance
 * @apiParam (Payload) {AlphaNumeric{..20}} nearest_apmc_market Nearest Apmc Market
 * @apiParam (Payload) {Numeric{..20}} apmc_distance Apmc Distance
 * @apiParam (Payload) {AlphaNumeric{..20}} nearest_bus_stand Nearest Bus Stand
 * @apiParam (Payload) {Numeric{..20}} apmc_distance Apmc Distance
 * @apiParam (Payload) {JSON} other_haat_bazaar
 * @apiParamExample {json} Payload
 * {
        "rpm_name": "Test",
        "rpm_location": "Test Location",
        "address": "Test Address",
        "state": "1",
        "district": "1",
        "block": "1",
        "gram_panchayat": "Gram Panchayat Name",
        "village": "1",
        "pin_code": "201301",
        "rpm_ownership": "1",
        "operating_rpm": "Lorem Ipsum",
        "premises_rpm": "1",
        "is_on_rent": "1",
        "rate_per_annum": "20",
        "market_regulation": "1",
        "regulation_type": "1",
        "periodicity": "1",
        "working_days": "18",
        "sale_start_time": "10",
        "sale_end_time": "10",
        "staff_size": "20",
        "nearest_railway_station": "Test
        "railway_distance": "18",
        "nearest_highway": "Test",
        "highway_distance": "18",
        "nearest_apmc_market": "Test",
        "apmc_distance": "18",
        "agmarknet_node": "8",
        "nearest_bus_stand": "Test",
        "other_haat_bazaar": {"haat_data" : [{"name":"ohb1","distance":"10"},{"name":"ohb2","distance":"11"}]}
 * }

 * @apiSuccess {Number} status Response Status
 * @apiSuccess {Object} data  JSON object for specified master resource.
 * @apiSuccess {Number} data.id Unique ID of Record
 * @apiSuccess {String} data.rpm_name RPM Name
 * @apiSuccess {String} data.rpm_location RPM Location
 * @apiSuccess {String} data.address Address
 * @apiSuccess {Number} data.state Unique ID of State
 * @apiSuccess {String} data.state_name Name of State
 * @apiSuccess {Number} data.district Unique ID of District
 * @apiSuccess {String} data.district_name Name of District
 * @apiSuccess {Number} data.block Unique ID of Block
 * @apiSuccess {String} data.block Name of Block
 * @apiSuccess {String} data.gram_panchayat Gram Panchayat
 * @apiSuccess {Number} data.village Unique ID of Village
 * @apiSuccess {String} data.village_name Name of Village
 * @apiSuccess {Number} data.pin_code PIN Code
 * @apiSuccess {Number} data.rpm_ownership RPM Ownership
 * @apiSuccess {String} data.operating_rpm Operating RPM
 * @apiSuccess {Number} data.premises_rpm Unique ID of Premises RPM
 * @apiSuccess {Number} data.is_on_rent 0=No,1=Yes
 * @apiSuccess {Number} data.rate_per_annum Rent Per Annum
 * @apiSuccess {Number} data.market_regulation Unique ID of Market Regulation
 * @apiSuccess {Number} data.regulation_type 
 * @apiSuccess {Number} data.periodicity Unique ID of Periodicity
 * @apiSuccess {Number} data.working_days Number of working days
 * @apiSuccess {Number} data.sale_start_time Sale Start Time
 * @apiSuccess {Number} data.sale_end_time Sale End Time
 * @apiSuccess {Number} data.staff_size Staff size
 * @apiSuccess {String} data.nearest_railway_station
 * @apiSuccess {Number} data.railway_distance
 * @apiSuccess {String} data.nearest_highway
 * @apiSuccess {Number} data.highway_distance
 * @apiSuccess {String} data.nearest_apmc_market
 * @apiSuccess {Number} data.apmc_distance
 * @apiSuccess {String} data.nearest_bus_stand
 * @apiSuccess {Number} data.agmarknet_node
 * @apiSuccess {Number} data.created_by Created By
 * @apiSuccess {Number} data.updated_by Updated By
 * @apiSuccess {String} data.other_haat_bazaar Json Array

 * @apiSuccessExample Success-Response:
    HTTP/1.1 200 OK
    {
        "status": 1,
        "data": {
            "id": 9,
            "rpm_name": "Test",
            "rpm_location": "Test Location",
            "address": "Test Address",
            "state": "1",
            "state_name": "Test State",
            "district": "1",
            "district_name": "Test District",
            "block": "1",
            "block_name": "Test Block",
            "gram_panchayat": "Gram Panchayat Name",
            "village": "1",
            "village_name": "Test Village",
            "pin_code": "201301",
            "rpm_ownership": "1",
            "operating_rpm": "Lorem Ipsum",
            "premises_rpm": "1",
            "is_on_rent": "1",
            "rate_per_annum": "20",
            "market_regulation": "1",
            "regulation_type": "1",
            "periodicity": "1",
            "working_days": "18",
            "sale_start_time": "10",
            "sale_end_time": "10",
            "staff_size": "20",
            "created_by": 0,
            "updated_by": 0,
            "nearest_railway_station": "tt",
            "railway_distance": "11",
            "nearest_highway": "gg",
            "highway_distance": "20",
            "nearest_apmc_market": "ff",
            "apmc_distance": "10",
            "nearest_bus_stand": "ASA",
            "agmarknet_node": 8,
        "other_haat_bazaar": {"haat_data":[
            {
                "id": 91,
                "entity_id": 0,
                "form_type": 0,
                "form_id": 30,
                "name": "ohb1",
                "distance": 10,
                "premises_warehouse_id": 0,
                "created_by": 0,
                "updated_by": 0,
                "created_at": "2019-11-04 12:47:04",
                "updated_at": "2019-11-04 12:47:04",
                "deleted_at": null
            },
            {
                "id": 92,
                "entity_id": 0,
                "form_type": 0,
                "form_id": 30,
                "name": "ohb2",
                "distance": 11,
                "premises_warehouse_id": 0,
                "created_by": 0,
                "updated_by": 0,
                "created_at": "2019-11-04 12:47:04",
                "updated_at": "2019-11-04 12:47:04",
                "deleted_at": null
            }
        ] }
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
 * @api {GET} haat-market/part-one View All
 * @apiName HaatMarketPartOneViewAll
 * @apiGroup Haat Market Part One
 * 
 
 * @apiSuccess {Number} status Response Status
 * @apiSuccess {Object} data  JSON object for specified master resource.
 * @apiSuccess {Number} data.id Unique ID of Record
 * @apiSuccess {String} data.rpm_name RPM Name
 * @apiSuccess {String} data.rpm_location RPM Location
 * @apiSuccess {String} data.address Address
 * @apiSuccess {Number} data.state Unique ID of State
 * @apiSuccess {String} data.state_name Name of State
 * @apiSuccess {Number} data.district Unique ID of District
 * @apiSuccess {String} data.district_name Name of District
 * @apiSuccess {Number} data.block Unique ID of Block
 * @apiSuccess {String} data.block_name Name of Block
 * @apiSuccess {String} data.gram_panchayat Gram Panchayat
 * @apiSuccess {Number} data.village Unique ID of Village
 * @apiSuccess {String} data.village_name Name of Village
 * @apiSuccess {Number} data.pin_code PIN Code
 * @apiSuccess {Number} data.rpm_ownership RPM Ownership
 * @apiSuccess {String} data.operating_rpm Operating RPM
 * @apiSuccess {Number} data.premises_rpm Unique ID of Premises RPM
 * @apiSuccess {Number} data.is_on_rent 0=No,1=Yes
 * @apiSuccess {Number} data.rate_per_annum Rent Per Annum
 * @apiSuccess {Number} data.market_regulation Unique ID of Market Regulation
 * @apiSuccess {Number} data.regulation_type 
 * @apiSuccess {Number} data.periodicity Unique ID of Periodicity
 * @apiSuccess {Number} data.working_days Number of working days
 * @apiSuccess {Number} data.sale_start_time Sale Start Time
 * @apiSuccess {Number} data.sale_end_time Sale End Time
 * @apiSuccess {Number} data.staff_size Staff size
 * @apiSuccess {AlphaNumeric{..20}} nearest_railway_station Nearest Railway Station
 * @apiSuccess {Numeric{..20}} railway_distance Railway Distance
 * @apiSuccess {AlphaNumeric{..20}} nearest_highway Nearest Highway
 * @apiSuccess {Numeric{..20}} highway_distance Highway Distance
 * @apiSuccess {AlphaNumeric{..20}} nearest_apmc_market Nearest Apmc Market
 * @apiSuccess {Numeric{..20}} apmc_distance Apmc Distance
 * @apiSuccess {AlphaNumeric{..20}} nearest_bus_stand Nearest Bus Stand
 * @apiSuccess {Numeric{..20}} apmc_distance Apmc Distance
 * @apiSuccess {Number} data.created_by Created By
 * @apiSuccess {Number} data.updated_by Updated By
 * @apiSuccess {String} data.other_haat_bazaar Json Array

 * @apiSuccessExample Success-Response:
    HTTP/1.1 200 OK
    {
        "status": 1,
        "data": {
            "id": 9,
            "rpm_name": "Test",
            "rpm_location": "Test Location",
            "address": "Test Address",
            "state": "1",
            "state_name": "Test State",
            "district": "1",
            "district_name": "Test District",
            "block": "1",
            "block_name": "Test Block",
            "gram_panchayat": "Gram Panchayat Name",
            "village": "1",
            "village_name": "Test Village",
            "pin_code": "201301",
            "rpm_ownership": "1",
            "operating_rpm": "Lorem Ipsum",
            "premises_rpm": "1",
            "is_on_rent": "1",
            "rate_per_annum": "20",
            "market_regulation": "1",
            "regulation_type": "1",
            "periodicity": "1",
            "working_days": "18",
            "sale_start_time": "10",
            "sale_end_time": "10",
            "staff_size": "20",
            "created_by": 0,
            "updated_by": 0,
            "nearest_railway_station": "tt",
            "railway_distance": "11.00",
            "nearest_highway": "gg",
            "highway_distance": "20.00",
            "nearest_apmc_market": "ff",
            "apmc_distance": "10.00",
            "nearest_bus_stand": "ASA",
            "agmarknet_node": 8,
        "other_haat_bazaar": {
            "haat_data":[
                            {
                                "id": 91,
                                "entity_id": 0,
                                "form_type": 0,
                                "form_id": 30,
                                "name": "ohb1",
                                "distance": 10,
                                "premises_warehouse_id": 0,
                                "created_by": 0,
                                "updated_by": 0,
                                "created_at": "2019-11-04 12:47:04",
                                "updated_at": "2019-11-04 12:47:04",
                                "deleted_at": null
                            },
                            {
                                "id": 92,
                                "entity_id": 0,
                                "form_type": 0,
                                "form_id": 30,
                                "name": "ohb2",
                                "distance": 11,
                                "premises_warehouse_id": 0,
                                "created_by": 0,
                                "updated_by": 0,
                                "created_at": "2019-11-04 12:47:04",
                                "updated_at": "2019-11-04 12:47:04",
                                "deleted_at": null
                            }
                        ] 
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
 * @api {GET} haat-market/part-one/:id View One
 * @apiName HaatMarketPartOneViewOne
 * @apiGroup Haat Market Part One
 * @apiParam (Parameters) {Number} id Resource ID
 *
 * @apiSuccess {Number} status Response Status
 * @apiSuccess {Object} data  JSON object for specified master resource.
 * @apiSuccess {Number} data.id Unique ID of Record
 * @apiSuccess {String} data.rpm_name RPM Name
 * @apiSuccess {String} data.rpm_location RPM Location
 * @apiSuccess {String} data.address Address
 * @apiSuccess {Number} data.state Unique ID of State
 * @apiSuccess {String} data.state_name Name of State
 * @apiSuccess {Number} data.district Unique ID of District
 * @apiSuccess {String} data.district_name Name of District
 * @apiSuccess {Number} data.block Unique ID of Block
 * @apiSuccess {String} data.block_name Name ID of Block
 * @apiSuccess {String} data.gram_panchayat Gram Panchayat
 * @apiSuccess {Number} data.village Unique ID of Village
 * @apiSuccess {String} data.village_Name Name of Village
 * @apiSuccess {Number} data.pin_code PIN Code
 * @apiSuccess {Number} data.rpm_ownership RPM Ownership
 * @apiSuccess {String} data.operating_rpm Operating RPM
 * @apiSuccess {Number} data.premises_rpm Unique ID of Premises RPM
 * @apiSuccess {Number} data.is_on_rent 0=No,1=Yes
 * @apiSuccess {Number} data.rate_per_annum Rent Per Annum
 * @apiSuccess {Number} data.market_regulation Unique ID of Market Regulation
 * @apiSuccess {Number} data.regulation_type 
 * @apiSuccess {Number} data.periodicity Unique ID of Periodicity
 * @apiSuccess {Number} data.working_days Number of working days
 * @apiSuccess {Number} data.sale_start_time Sale Start Time
 * @apiSuccess {Number} data.sale_end_time Sale End Time
 * @apiSuccess {Number} data.staff_size Staff size
 * @apiSuccess {AlphaNumeric{..20}} nearest_railway_station Nearest Railway Station
 * @apiSuccess {Numeric{..20}} railway_distance Railway Distance
 * @apiSuccess {AlphaNumeric{..20}} nearest_highway Nearest Highway
 * @apiSuccess {Numeric{..20}} highway_distance Highway Distance
 * @apiSuccess {AlphaNumeric{..20}} nearest_apmc_market Nearest Apmc Market
 * @apiSuccess {Numeric{..20}} apmc_distance Apmc Distance
 * @apiSuccess {AlphaNumeric{..20}} nearest_bus_stand Nearest Bus Stand
 * @apiSuccess {Numeric{..20}} apmc_distance Apmc Distance
 * @apiSuccess {Number} data.created_by Created By
 * @apiSuccess {Number} data.updated_by Updated By
 * @apiSuccess {String} data.other_haat_bazaar Json Array

 * @apiSuccessExample Success-Response:
    HTTP/1.1 200 OK
    {
        "status": 1,
        "data": {
            "id": 9,
            "rpm_name": "Test",
            "rpm_location": "Test Location",
            "address": "Test Address",
            "state": "1",
            "state_name": "Test State",
            "district": "1",
            "district_name": "Test District",
            "block": "1",
            "block_name": "Test Block",
            "gram_panchayat": "Gram Panchayat Name",
            "village": "1",
            "village_name": "Test Village",
            "pin_code": "201301",
            "rpm_ownership": "1",
            "operating_rpm": "Lorem Ipsum",
            "premises_rpm": "1",
            "is_on_rent": "1",
            "rate_per_annum": "20",
            "market_regulation": "1",
            "regulation_type": "1",
            "periodicity": "1",
            "working_days": "18",
            "sale_start_time": "10",
            "sale_end_time": "10",
            "staff_size": "20",
            "created_by": 0,
            "updated_by": 0,
            "linkage": {
            "id": 28,
            "form_id": 30,
            "nearest_railway_station": "tt",
            "railway_distance": "11.00",
            "nearest_highway": "gg",
            "highway_distance": "20.00",
            "nearest_apmc_market": "ff",
            "apmc_distance": "10.00",
            "nearest_bus_stand": "ASA",
            "agmarknet_node": 8,
            "created_by": 0,
            "created_at": "2019-11-04 12:47:04",
            "updated_at": "2019-11-04 12:47:04",
            "deleted_at": null
        },
        "other_haat_bazaar": {"haat_data" :[
            {
                "id": 91,
                "entity_id": 0,
                "form_type": 0,
                "form_id": 30,
                "haat_bazaar_name": "ohb1",
                "haat_bazaar_distance": 10,
                "premises_warehouse_id": 0,
                "created_by": 0,
                "updated_by": 0,
                "created_at": "2019-11-04 12:47:04",
                "updated_at": "2019-11-04 12:47:04",
                "deleted_at": null
            },
            {
                "id": 92,
                "entity_id": 0,
                "form_type": 0,
                "form_id": 30,
                "haat_bazaar_name": "ohb2",
                "haat_bazaar_distance": 11,
                "premises_warehouse_id": 0,
                "created_by": 0,
                "updated_by": 0,
                "created_at": "2019-11-04 12:47:04",
                "updated_at": "2019-11-04 12:47:04",
                "deleted_at": null
            }
        ]}
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

