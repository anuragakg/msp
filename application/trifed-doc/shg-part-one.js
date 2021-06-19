/**
 * @api {get} shg/part-one View All
 * @apiName ShgPartOneViewAll
 * @apiGroup SHG Part One
 *
 * @apiSuccess {Number} status Response
 * @apiSuccess {Array} data Data Response
 * @apiSuccess {Number} data.id Unique ID of the resource.
 * @apiSuccess {String} data.name_of_tribal Name of the Tribal
 * @apiSuccess {String} data.gender Gender with type possible values of 0 or 1.
 * @apiSuccess {String} data.id_value ID Value.
 * @apiSuccess {String} data.state State Title coming from master table.
 * @apiSuccess {String} data.district District Name coming from master table.
 * @apiSuccess {String} data.block Block Name coming from master table.
 * @apiSuccess {String} data.village Village Name coming from master table.
 * @apiSuccess {String} data.mobile Mobile number of the SHG User.
 *
 * @apiSuccessExample Success-Response:
    HTTP/1.1 200 OK
    {
        "status": 1,
        "data": [{
            "id": 1,
            "name_of_tribal": "Rajesh",
            "gender": "M",
            "id_value": "231231232",
            "state": "Haryana",
            "district": "Faridabad",
            "block": "D-Block",
            "village": "Village 1",
            "mobile": "7837873878"
        }]
    }
 * 
 */

/**
 * @api {get} shg/part-one/:id View One
 * @apiName ShgPartOneViewOne
 * @apiGroup SHG Part One
 *
 * @apiParam (Parameter) {Number} id Resource ID
 * 
 * @apiSuccess {Number} status Response
 * @apiSuccess {Object} data Data Response
 * @apiSuccess {Number} data.id Unique ID of the resource.
 * @apiSuccess {String} data.name_of_tribal Name of the Tribal
 * @apiSuccess {String} data.gender Gender with type possible values of 0 or 1.
 * @apiSuccess {Date} data.dob Date of Birth in YYYY/MM/DD format.
 * @apiSuccess {Number} data.birth_year Primary key coming from master table.
 * @apiSuccess {Number} data.age Age to be autocalculated and sent in data.
 * @apiSuccess {String} data.id_type Type of ID.
 * @apiSuccess {String} data.id_value Value of the selected ID.
 * @apiSuccess {String} data.father Father
 * @apiSuccess {String} data.mother Mother
 * @apiSuccess {String} data.address Address
 * @apiSuccess {Number} data.state State Primary key coming from master table.
 * @apiSuccess {String} data.state_name State Title coming from master table.
 * @apiSuccess {Number} data.district District Primary key coming from master table.
 * @apiSuccess {String} data.district_name District Name coming from master table.
 * @apiSuccess {Number} data.block Block Primary key coming from master table.
 * @apiSuccess {String} data.block_name Block Name coming from master table.
 * @apiSuccess {Number} data.village Village Primary key coming from master table.
 * @apiSuccess {String} data.village_name Village Name coming from master table.
 * @apiSuccess {Number} data.pin_code Pin Code
 * @apiSuccess {String} data.gram_panchayat Gram Panchayat
 * @apiSuccess {Number} data.occupation  Occupation coming from master table.
 * @apiSuccess {Number} data.education Education coming from master table.
 * @apiSuccess {Number} data.existing_membership Existing Membership type enum 1 or 0
 * @apiSuccess {String} data.shg_name SHG Name, Required if existing_membership is 1.
 * @apiSuccess {String} data.shg_nrlm_id SHG NRLM ID, Required if existing_membership is 1.
 * @apiSuccess {String} data.shg_other_id SHG Other ID, Required if existing_membership is 1.
 * @apiSuccess {Number} data.is_office_bearer Is Office bearer, type enum 1 or 0
 * @apiSuccess {Number} data.bearer_role Office bearer role coming from master, required if is_office_bearer is 1
 * @apiSuccess {Number} data.category Category primary key coming from master.
 * @apiSuccess {Number} data.is_ews Is economically backward class, type enum 1 or 0.
 * @apiSuccess {String} data.st_name Schedule Tribe Name required if user selects ST in category
 * @apiSuccess {Number} data.is_gathering_mfp Is gathering MFP, type enum with 0 or 1
 * @apiSuccess {String} data.no_of_members No of household members.
 * @apiSuccess {Number} data.is_married Is Married, with enum 1,0
 * @apiSuccess {Number} data.vehicle_type Vehicle type coming from master.
 * @apiSuccess {String} data.bank_name Name of the bank.
 * @apiSuccess {String} data.branch_name Branch of the bank.
 * @apiSuccess {String} data.bank_ifsc IFSC Code of the bank.
 * @apiSuccess {String} data.bank_account_no Account Number of the user.
 * @apiSuccess {String} data.bank_mobile_no Mobile no registered in bank.
 * @apiSuccess {Number} data.is_self Is phone self owned 1=Own, 2=Other
 * @apiSuccess {String} data.specify_other Specify other, required if is_self = 2.
 * @apiSuccess {Number} data.phone_type Phone type of the user.
 *
 * @apiSuccessExample Success-Response:
    HTTP/1.1 200 OK
    {
        "status": 1,
        "data": {
            "id": 1,
            "name_of_tribal": "Rajesh",
            "gender": "M",
            "dob": "1995-12-10",
            "birth_year": 1,
            "age": 24,
            "id_type": "4",
            "id_value": "231231232",
            "father": "Rajesh Father",
            "mother": "Rajesh Mother",
            "address": "Noida sector 62",
            "state_name": "Haryana",
            "state": 1,
            "district_name": "Faridabad",
            "district": 1,
            "block_name": "D-Block",
            "block": 1,
            "village_name": "Village 1",
            "village": 1,
            "pin_code": 123345,
            "gram_panchayat": "Panchayat A",
            "occupation": 1,
            "education": 1,
            "existing_membership": "1",
            "shg_name": "test1",
            "shg_nrlm_id": "test2",
            "shg_other_id": "231723617",
            "is_office_bearer": "0",
            "bearer_role": 0,
            "category": 1,
            "is_ews": "0",
            "st_name": "ST NAME A",
            "is_gathering_mfp": "1",
            "no_of_members": null,
            "is_married": "1",
            "vehicle_type": 2,
            "bank_name": "HDFC",
            "branch_name": "noida",
            "bank_ifsc": "ifsc91881",
            "bank_account_no": "28736263887",
            "bank_mobile_no": "7837873878",
            "is_self": "1",
            "specify_other": null,
            "phone_type": 2
        }
    }
 *
 * @apiError (Not Found) {Number} status Response Status
 * @apiError (Not Found) {String} message Error Response Message specifiying the reason for failure.
 * @apiErrorExample Resource Not Found
    HTTP / 1.1 404 Not Found
    {
        "status": 0,
        "message": "Not found"
    }
 */


/**
 * @api {POST} shg/part-one Create
 * @apiName ShgPartOneCreate
 * @apiGroup SHG Part One
 * @apiParam (Payload) {String{0.20}} name_of_tribal Name of the Tribal
 * @apiParam (Payload) {String{0.1}} gender Gender with type possible values of 0 or 1.
 * @apiParam (Payload) {Date} dob Date of Birth in YYYY/MM/DD format.
 * @apiParam (Payload) {Number} birth_year Primary key coming from master table.
 * @apiParam (Payload) {Number{0.4}} age Age to be autocalculated and sent in data.
 * @apiParam (Payload) {String{0.50}} id_type Type of ID.
 * @apiParam (Payload) {String{0.20}} id_value Value of the selected ID.
 * @apiParam (Payload) {String{0.20}} father Father
 * @apiParam (Payload) {String{0.20}} mother Mother
 * @apiParam (Payload) {String{..250}} address Address
 * @apiParam (Payload) {Number{0.11}} state State Primary key coming from master table.
 * @apiParam (Payload) {Number{0.11}} district District Primary key coming from master table.
 * @apiParam (Payload) {Number{0.11}} block Block Primary key coming from master table.
 * @apiParam (Payload) {Number{0.11}} village Village Primary key coming from master table.
 * @apiParam (Payload) {Number{6.11}} pin_code Pin Code
 * @apiParam (Payload) {String{0.25}} gram_panchayat Gram Panchayat
 * @apiParam (Payload) {Number{0.11}} occupation  Occupation coming from master table.
 * @apiParam (Payload) {Number{0.11}} education Education coming from master table.
 * @apiParam (Payload) {Number{0.1}} existing_membership Existing Membership type enum 1 or 0
 * @apiParam (Payload) {String{0.20}} shg_name SHG Name, Required if existing_membership is 1.
 * @apiParam (Payload) {String{0.20}} shg_nrlm_id SHG NRLM ID, Required if existing_membership is 1.
 * @apiParam (Payload) {String{0.20}} shg_other_id SHG Other ID, Required if existing_membership is 1.
 * @apiParam (Payload) {Number{0.1}} is_office_bearer Is Office bearer, type enum 1 or 0
 * @apiParam (Payload) {Number{0.11}} bearer_role Office bearer role coming from master, required if is_office_bearer is 1
 * @apiParam (Payload) {Number{0.11}} category Category primary key coming from master.
 * @apiParam (Payload) {Number{0.1}} is_ews Is economically backward class, type enum 1 or 0.
 * @apiParam (Payload) {String{0.25}} st_name Schedule Tribe Name required if user selects ST in category
 * @apiParam (Payload) {Number{0.1}} is_gathering_mfp Is gathering MFP, type enum with 0 or 1
 * @apiParam (Payload) {String{1.2}} no_of_members No of household members.
 * @apiParam (Payload) {Number{0.1}} is_married Is Married, with enum 1,0
 * @apiParam (Payload) {Number{0.11}} vehicle_type Vehicle type coming from master.
 * @apiParam (Payload) {String{0.20}} bank_name Name of the bank.
 * @apiParam (Payload) {String{0.20}} branch_name Branch of the bank.
 * @apiParam (Payload) {String{0.11}} bank_ifsc IFSC Code of the bank.
 * @apiParam (Payload) {String{0.18}} bank_account_no Account Number of the user.
 * @apiParam (Payload) {String{0.11}} bank_mobile_no Mobile no registered in bank.
 * @apiParam (Payload) {Number{0.1}} is_self Is phone self owned 1=Own, 2=Other
 * @apiParam (Payload) {String{0.100}} specify_other Specify other, required if is_self = 2.
 * @apiParam (Payload) {Number{0.1}} phone_type Phone type of the user.
 * @apiParamExample {json} Payload
 * {
        "name_of_tribal": "Rajesh"
        "gender": "M"
        "dob": "1995/12/10"
        "birth_year": "1"
        "age": "24"
        "id_type": "4"
        "id_value": "231231232"
        "father": "Rajesh Father"
        "mother": "Rajesh Mother"
        "address": "Noida sector 62"
        "state": "1"
        "district": "1"
        "block": "1"
        "village": "1"
        "pin_code": "123345"
        "gram_panchayat": "Panchayat A"
        "occupation": "1"
        "education": "1"
        "existing_membership": "1"
        "shg_name": "test1"
        "shg_nrlm_id": "test2"
        "shg_other_id": "231723617"
        "is_office_bearer": "0"
        "bearer_role": ""
        "category": "1"
        "is_ews": "0"
        "st_name": "ST NAME A"
        "is_gathering_mfp": "1"
        "no_of_members": "4"
        "is_married": "1"
        "vehicle_type": "2"
        "bank_name": "HDFC"
        "branch_name": "noida"
        "bank_ifsc": "ifsc91881"
        "bank_account_no": "28736263887"
        "bank_mobile_no": "7837873878"
        "is_self": "1"
        "specify_other": ""
        "phone_type": "2"
    }
 * 
 * @apiSuccess {Number} status Response
 * @apiSuccess {Object} data Data Response
 * @apiSuccess {Number} data.id Unique ID of the resource.
 * @apiSuccess {String} data.name_of_tribal Name of the Tribal
 * @apiSuccess {String} data.gender Gender with type possible values of 0 or 1.
 * @apiSuccess {Date} data.dob Date of Birth in YYYY/MM/DD format.
 * @apiSuccess {Number} data.birth_year Primary key coming from master table.
 * @apiSuccess {Number} data.age Age to be autocalculated and sent in data.
 * @apiSuccess {String} data.id_type Type of ID.
 * @apiSuccess {String} data.id_value Value of the selected ID.
 * @apiSuccess {String} data.father Father
 * @apiSuccess {String} data.mother Mother
 * @apiSuccess {String} data.address Address
 * @apiSuccess {Number} data.state State Primary key coming from master table.
 * @apiSuccess {String} data.state_name State Title coming from master table.
 * @apiSuccess {Number} data.district District Primary key coming from master table.
 * @apiSuccess {String} data.district_name District Name coming from master table.
 * @apiSuccess {Number} data.block Block Primary key coming from master table.
 * @apiSuccess {String} data.block_name Block Name coming from master table.
 * @apiSuccess {Number} data.village Village Primary key coming from master table.
 * @apiSuccess {String} data.village_name Village Name coming from master table.
 * @apiSuccess {Number} data.pin_code Pin Code
 * @apiSuccess {String} data.gram_panchayat Gram Panchayat
 * @apiSuccess {Number} data.occupation  Occupation coming from master table.
 * @apiSuccess {Number} data.education Education coming from master table.
 * @apiSuccess {Number} data.existing_membership Existing Membership type enum 1 or 0
 * @apiSuccess {String} data.shg_name SHG Name, Required if existing_membership is 1.
 * @apiSuccess {String} data.shg_nrlm_id SHG NRLM ID, Required if existing_membership is 1.
 * @apiSuccess {String} data.shg_other_id SHG Other ID, Required if existing_membership is 1.
 * @apiSuccess {Number} data.is_office_bearer Is Office bearer, type enum 1 or 0
 * @apiSuccess {Number} data.bearer_role Office bearer role coming from master, required if is_office_bearer is 1
 * @apiSuccess {Number} data.category Category primary key coming from master.
 * @apiSuccess {Number} data.is_ews Is economically backward class, type enum 1 or 0.
 * @apiSuccess {String} data.st_name Schedule Tribe Name required if user selects ST in category
 * @apiSuccess {Number} data.is_gathering_mfp Is gathering MFP, type enum with 0 or 1
 * @apiSuccess {String} data.no_of_members No of household members.
 * @apiSuccess {Number} data.is_married Is Married, with enum 1,0
 * @apiSuccess {Number} data.vehicle_type Vehicle type coming from master.
 * @apiSuccess {String} data.bank_name Name of the bank.
 * @apiSuccess {String} data.branch_name Branch of the bank.
 * @apiSuccess {String} data.bank_ifsc IFSC Code of the bank.
 * @apiSuccess {String} data.bank_account_no Account Number of the user.
 * @apiSuccess {String} data.bank_mobile_no Mobile no registered in bank.
 * @apiSuccess {Number} data.is_self Is phone self owned 1=Own, 2=Other
 * @apiSuccess {String} data.specify_other Specify other, required if is_self = 2.
 * @apiSuccess {Number} data.phone_type Phone type of the user.
 *
 * @apiSuccessExample Success-Response:
    HTTP/1.1 200 OK
    {
        "status": 1,
        "data": {
            "id": 1,
            "name_of_tribal": "Rajesh",
            "gender": "M",
            "dob": "1995-12-10",
            "birth_year": 1,
            "age": 24,
            "id_type": "4",
            "id_value": "231231232",
            "father": "Rajesh Father",
            "mother": "Rajesh Mother",
            "address": "Noida sector 62",
            "state_name": "Haryana",
            "state": 1,
            "district_name": "Faridabad",
            "district": 1,
            "block_name": "D-Block",
            "block": 1,
            "village_name": "Village 1",
            "village": 1,
            "pin_code": 123345,
            "gram_panchayat": "Panchayat A",
            "occupation": 1,
            "education": 1,
            "existing_membership": "1",
            "shg_name": "test1",
            "shg_nrlm_id": "test2",
            "shg_other_id": "231723617",
            "is_office_bearer": "0",
            "bearer_role": 0,
            "category": 1,
            "is_ews": "0",
            "st_name": "ST NAME A",
            "is_gathering_mfp": "1",
            "no_of_members": null,
            "is_married": "1",
            "vehicle_type": 2,
            "bank_name": "HDFC",
            "branch_name": "noida",
            "bank_ifsc": "ifsc91881",
            "bank_account_no": "28736263887",
            "bank_mobile_no": "7837873878",
            "is_self": "1",
            "specify_other": null,
            "phone_type": 2
        }
    }
 * 
 */

/**
 * @api {PUT} shg/part-one/:id Update
 * @apiName ShgPartOneUpdateOne
 * @apiGroup SHG Part One
 * 
 * @apiParam (Parameter) {Number} id Resource ID.
 * 
 * @apiParam (Payload) {String{0.20}} name_of_tribal Name of the Tribal
 * @apiParam (Payload) {String{0.1}} gender Gender with type possible values of 0 or 1.
 * @apiParam (Payload) {Date} dob Date of Birth in YYYY/MM/DD format.
 * @apiParam (Payload) {Number} birth_year Primary key coming from master table.
 * @apiParam (Payload) {Number{0.4}} age Age to be autocalculated and sent in data.
 * @apiParam (Payload) {String{0.50}} id_type Type of ID.
 * @apiParam (Payload) {String{0.20}} id_value Value of the selected ID.
 * @apiParam (Payload) {String{0.20}} father Father
 * @apiParam (Payload) {String{0.20}} mother Mother
 * @apiParam (Payload) {String{..250}} address Address
 * @apiParam (Payload) {Number{0.11}} state State Primary key coming from master table.
 * @apiParam (Payload) {Number{0.11}} district District Primary key coming from master table.
 * @apiParam (Payload) {Number{0.11}} block Block Primary key coming from master table.
 * @apiParam (Payload) {Number{0.11}} village Village Primary key coming from master table.
 * @apiParam (Payload) {Number{6.11}} pin_code Pin Code
 * @apiParam (Payload) {String{0.25}} gram_panchayat Gram Panchayat
 * @apiParam (Payload) {Number{0.11}} occupation  Occupation coming from master table.
 * @apiParam (Payload) {Number{0.11}} education Education coming from master table.
 * @apiParam (Payload) {Number{0.1}} existing_membership Existing Membership type enum 1 or 0
 * @apiParam (Payload) {String{0.20}} shg_name SHG Name, Required if existing_membership is 1.
 * @apiParam (Payload) {String{0.20}} shg_nrlm_id SHG NRLM ID, Required if existing_membership is 1.
 * @apiParam (Payload) {String{0.20}} shg_other_id SHG Other ID, Required if existing_membership is 1.
 * @apiParam (Payload) {Number{0.1}} is_office_bearer Is Office bearer, type enum 1 or 0
 * @apiParam (Payload) {Number{0.11}} bearer_role Office bearer role coming from master, required if is_office_bearer is 1
 * @apiParam (Payload) {Number{0.11}} category Category primary key coming from master.
 * @apiParam (Payload) {Number{0.1}} is_ews Is economically backward class, type enum 1 or 0.
 * @apiParam (Payload) {String{0.25}} st_name Schedule Tribe Name required if user selects ST in category
 * @apiParam (Payload) {Number{0.1}} is_gathering_mfp Is gathering MFP, type enum with 0 or 1
 * @apiParam (Payload) {String{1.2}} no_of_members No of household members.
 * @apiParam (Payload) {Number{0.1}} is_married Is Married, with enum 1,0
 * @apiParam (Payload) {Number{0.11}} vehicle_type Vehicle type coming from master.
 * @apiParam (Payload) {String{0.20}} bank_name Name of the bank.
 * @apiParam (Payload) {String{0.20}} branch_name Branch of the bank.
 * @apiParam (Payload) {String{0.11}} bank_ifsc IFSC Code of the bank.
 * @apiParam (Payload) {String{0.18}} bank_account_no Account Number of the user.
 * @apiParam (Payload) {String{0.11}} bank_mobile_no Mobile no registered in bank.
 * @apiParam (Payload) {Number{0.1}} is_self Is phone self owned 1=Own, 2=Other
 * @apiParam (Payload) {String{0.100}} specify_other Specify other, required if is_self = 2.
 * @apiParam (Payload) {Number{0.1}} phone_type Phone type of the user.
 * @apiParamExample {json} Payload
 * {
        "name_of_tribal": "Rajesh"
        "gender": "M"
        "dob": "1995/12/10"
        "birth_year": "1"
        "age": "24"
        "id_type": "4"
        "id_value": "231231232"
        "father": "Rajesh Father"
        "mother": "Rajesh Mother"
        "address": "Noida sector 62"
        "state": "1"
        "district": "1"
        "block": "1"
        "village": "1"
        "pin_code": "123345"
        "gram_panchayat": "Panchayat A"
        "occupation": "1"
        "education": "1"
        "existing_membership": "1"
        "shg_name": "test1"
        "shg_nrlm_id": "test2"
        "shg_other_id": "231723617"
        "is_office_bearer": "0"
        "bearer_role": ""
        "category": "1"
        "is_ews": "0"
        "st_name": "ST NAME A"
        "is_gathering_mfp": "1"
        "no_of_members": "4"
        "is_married": "1"
        "vehicle_type": "2"
        "bank_name": "HDFC"
        "branch_name": "noida"
        "bank_ifsc": "ifsc91881"
        "bank_account_no": "28736263887"
        "bank_mobile_no": "7837873878"
        "is_self": "1"
        "specify_other": ""
        "phone_type": "2"
    }
 * 
 * @apiSuccess {Number} status Response
 * @apiSuccess {Object} data Data Response
 * @apiSuccess {Number} data.id Unique ID of the resource.
 * @apiSuccess {String} data.name_of_tribal Name of the Tribal
 * @apiSuccess {String} data.gender Gender with type possible values of 0 or 1.
 * @apiSuccess {Date} data.dob Date of Birth in YYYY/MM/DD format.
 * @apiSuccess {Number} data.birth_year Primary key coming from master table.
 * @apiSuccess {Number} data.age Age to be autocalculated and sent in data.
 * @apiSuccess {String} data.id_type Type of ID.
 * @apiSuccess {String} data.id_value Value of the selected ID.
 * @apiSuccess {String} data.father Father
 * @apiSuccess {String} data.mother Mother
 * @apiSuccess {String} data.address Address
 * @apiSuccess {Number} data.state State Primary key coming from master table.
 * @apiSuccess {String} data.state_name State Title coming from master table.
 * @apiSuccess {Number} data.district District Primary key coming from master table.
 * @apiSuccess {String} data.district_name District Name coming from master table.
 * @apiSuccess {Number} data.block Block Primary key coming from master table.
 * @apiSuccess {String} data.block_name Block Name coming from master table.
 * @apiSuccess {Number} data.village Village Primary key coming from master table.
 * @apiSuccess {String} data.village_name Village Name coming from master table.
 * @apiSuccess {Number} data.pin_code Pin Code
 * @apiSuccess {String} data.gram_panchayat Gram Panchayat
 * @apiSuccess {Number} data.occupation  Occupation coming from master table.
 * @apiSuccess {Number} data.education Education coming from master table.
 * @apiSuccess {Number} data.existing_membership Existing Membership type enum 1 or 0
 * @apiSuccess {String} data.shg_name SHG Name, Required if existing_membership is 1.
 * @apiSuccess {String} data.shg_nrlm_id SHG NRLM ID, Required if existing_membership is 1.
 * @apiSuccess {String} data.shg_other_id SHG Other ID, Required if existing_membership is 1.
 * @apiSuccess {Number} data.is_office_bearer Is Office bearer, type enum 1 or 0
 * @apiSuccess {Number} data.bearer_role Office bearer role coming from master, required if is_office_bearer is 1
 * @apiSuccess {Number} data.category Category primary key coming from master.
 * @apiSuccess {Number} data.is_ews Is economically backward class, type enum 1 or 0.
 * @apiSuccess {String} data.st_name Schedule Tribe Name required if user selects ST in category
 * @apiSuccess {Number} data.is_gathering_mfp Is gathering MFP, type enum with 0 or 1
 * @apiSuccess {String} data.no_of_members No of household members.
 * @apiSuccess {Number} data.is_married Is Married, with enum 1,0
 * @apiSuccess {Number} data.vehicle_type Vehicle type coming from master.
 * @apiSuccess {String} data.bank_name Name of the bank.
 * @apiSuccess {String} data.branch_name Branch of the bank.
 * @apiSuccess {String} data.bank_ifsc IFSC Code of the bank.
 * @apiSuccess {String} data.bank_account_no Account Number of the user.
 * @apiSuccess {String} data.bank_mobile_no Mobile no registered in bank.
 * @apiSuccess {Number} data.is_self Is phone self owned 1=Own, 2=Other
 * @apiSuccess {String} data.specify_other Specify other, required if is_self = 2.
 * @apiSuccess {Number} data.phone_type Phone type of the user.
 *
 * @apiSuccessExample Success-Response:
    HTTP/1.1 200 OK
    {
        "status": 1,
        "data": {
            "id": 1,
            "name_of_tribal": "Rajesh",
            "gender": "M",
            "dob": "1995-12-10",
            "birth_year": 1,
            "age": 24,
            "id_type": "4",
            "id_value": "231231232",
            "father": "Rajesh Father",
            "mother": "Rajesh Mother",
            "address": "Noida sector 62",
            "state": {
                "id": 1,
                "title": "Haryana"
            },
            "district": {
                "id": 1,
                "title": "Faridabad"
            },
            "block": {
                "id": 1,
                "title": "D-Block"
            },
            "village": {
                "id": 1,
                "title": "Village 1"
            },
            "pin_code": 123345,
            "gram_panchayat": "Panchayat A",
            "occupation": 1,
            "education": 1,
            "existing_membership": "1",
            "shg_name": "test1",
            "shg_nrlm_id": "test2",
            "shg_other_id": "231723617",
            "is_office_bearer": "0",
            "bearer_role": 0,
            "category": 1,
            "is_ews": "0",
            "st_name": "ST NAME A",
            "is_gathering_mfp": "1",
            "no_of_members": null,
            "is_married": "1",
            "vehicle_type": 2,
            "bank_name": "HDFC",
            "branch_name": "noida",
            "bank_ifsc": "ifsc91881",
            "bank_account_no": "28736263887",
            "bank_mobile_no": "7837873878",
            "is_self": "1",
            "specify_other": null,
            "phone_type": 2
        }
    }
 * @apiError (Not Found) {Number} status Response Status
 * @apiError (Not Found) {String} message Error Response Message specifiying the reason for failure.
 * @apiErrorExample Resource Not Found
    HTTP / 1.1 404 Not Found
    {
        "status": 0,
        "message": "Not found"
    }
 */