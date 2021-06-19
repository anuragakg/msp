/**
 * @api {get} surveyor View All
 * @apiName SurveyorViewAll
 * @apiGroup Surveyor
 *
 * @apiSuccess {Number} status Response Status
 * @apiSuccess {Array} data  Array containing all the records of Surveyors.
 * @apiSuccess {Number} data.id Unique ID of Record
 * @apiSuccess {String} data.name Name of Surveyor
 * @apiSuccess {Number} data.mobile Mobile Phone of Surveyor
 * @apiSuccess {String} data.email Email of Surveyor
 * @apiSuccess {String} data.state State of Surveyor
 * @apiSuccess {String} data.district District of Surveyor
 * @apiSuccess {String} data.block Block of Surveyor
 * @apiSuccess {String} data.user_type User Type
 *
 * @apiSuccessExample Success-Response:
    HTTP/1.1 200 OK
    {
        "status": 1,
        "data": [{
            "id": 1,
            "name": "Rajesh",
            "mobile": 9898989898,
            "email": "rajesh@localhost.com",
            "state": "UP",
            "district": "District A",
            "block": "Block B",
            "user_type": "Surveyor"
        }]
    }
 * 
 */


/**
 * @api {POST} surveyor Create
 * @apiName SurveyorCreate
 * @apiGroup Surveyor
 * @apiParam (Payload) {String{..100}} username Username of the Surveyor
 * @apiParam (Payload) {String{..100}} name Name of the Surveyor
 * @apiParam (Payload) {String{..100}} middle_name Middle Name of the Surveyor
 * @apiParam (Payload) {String{..100}} last_name Last Name of the Surveyor
 * @apiParam (Payload) {String{..100}} email Email of the Surveyor
 * @apiParam (Payload) {Number{..100}} id_proof_type ID proof selected.
 * @apiParam (Payload) {String{..100}} id_proof_value Value of ID Proof selected
 * @apiParam (Payload) {Number{..4}} state State of the Surveyor
 * @apiParam (Payload) {Number{..4}} district District of the Surveyor
 * @apiParam (Payload) {Number{..4}} block Block of the Surveyor
 * @apiParam (Payload) {Number{..11}} mobile_no Mobile no. of the Surveyor
 * @apiParam (Payload) {Number{..11}} alternate_no Alternate Number of the Surveyor
 * @apiParam (Payload) {Number{..1}} user_type Type of user Surveyor=1 or Supervisor=2
 * @apiParam (Payload) {String{..255}} supervising_for Required If user_type=2. This will be null in this form type.
 * @apiParam (Payload) {String{..255}} survey_for If user type=1. Multiple ID's can be provided as comma seperated values.
 * @apiParam (Payload) {Number{..20}} map_surveyor Required If user_type=1. Specifies the supervisor to which the surveyor will be mapped to.
 * @apiParam (Payload) {String{..25}} bank_name Name of the bank.
 * @apiParam (Payload) {String{..25}} branch_name Branch Name
 * @apiParam (Payload) {String{..11}} ifsc_code IFSC Code
 * @apiParam (Payload) {String{..15}} bank_mobile_no Mobile No. associated with Bank.
 * @apiParam (Payload) {Number{..20}} bank_ac_no Bank AC Number
 * @apiParam (Payload) {Number{..1}} phone_type Phone Type
 * @apiParam (Payload) {Number{..1}} is_phone_self_owned Is Phone Self owned.
 * @apiParamExample {json} Payload
 * {
        "user_name": "sampleuser_011",
        "name": "John",
        "middle_name": "",
        "last_name": "Doe",
        "email": "johndoe@localhost.com",
        "id_proof_type": 2,
        "id_proof_value": "123456789012",
        "state": 1,
        "district": 24,
        "block": 56,
        "mobile_no": 9898989754,
        "alternate_no": 2627897861,
        "supervising_for": "",
        "survey_for": "2,3",
        "user_type": 1,
        "bank_name": "HDFC",
        "branch_name": "Noida",
        "ifsc_code": "IFSC00621",
        "bank_mobile_no": "1234567890",
        "bank_ac_no": "1234567654654",
        "phone_type": 1,
        "is_phone_self_owned": 1,
        "map_surveyor" : 5
    }
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
            "name": "John",
            "mobile": 9898989754,
            "email": "johndoe@localhost.com",
            "state": "UP",
            "district": "District A",
            "block": "Block B",
            "user_type": "Surveyor"
        }
    }

    @apiError (Duplicate Username) {Number} status Response Status
    @apiError (Duplicate Username) {String} message Error Response Message specifiying the reason for failure.
    @apiErrorExample {JSON} Duplicate Username
    HTTP/1.1 422 Unprocessable Entity
    {
        "status": 0,
        "message": "The username has already been taken."
    }

    @apiError (Invalid Username) {Number} status Response Status
    @apiError (Invalid Username) {String} message Error Response Message specifiying the reason for failure.
    @apiErrorExample {JSON} Invalid Username
    HTTP/1.1 422 Unprocessable Entity
    {
        "status": 0,
        "message": "The user name should only contain alpha numeric and dashes."
    }

    @apiError (Duplicate Mobile) {Number} status Response Status
    @apiError (Duplicate Mobile) {String} message Error Response Message specifiying the reason for failure.
    @apiErrorExample {JSON} Duplicate Mobile
    HTTP/1.1 422 Unprocessable Entity
    {
        "status": 0,
        "message": "The Mobile has already been taken."
    }

    @apiError (Duplicate Bank Account) {Number} status Response Status
    @apiError (Duplicate Bank Account) {String} message Error Response Message specifiying the reason for failure.
    @apiErrorExample {JSON} Duplicate Bank Account
    HTTP/1.1 422 Unprocessable Entity
    {
        "status": 0,
        "message": "The Bank Account has already been taken."
    }
 * 
 */

/**
 * @api {get} surveyor/:user_id View One
 * @apiName SurveyorViewOne
 * @apiGroup Surveyor
 *
 * @apiParam (Parameters) user_id User ID
 * 
 * @apiSuccess {Number} status Response Status
 * @apiSuccess {Number} data.id Unique ID of Record
 * @apiSuccess {String} data.name Name of Surveyor
 * @apiSuccess {String} data.user_name User Name of Surveyor
 * @apiSuccess {String} data.middle_name Middle Name of Surveyor
 * @apiSuccess {String} data.last_name Last Name of Surveyor
 * @apiSuccess {Number} data.mobile Mobile Phone of Surveyor
 * @apiSuccess {String} data.email Email of Surveyor
 * @apiSuccess {String} data.state State of Surveyor
 * @apiSuccess {String} data.district District of Surveyor
 * @apiSuccess {String} data.block Block of Surveyor
 * @apiSuccess {String} data.user_type User Type of Surveyor
 * 
 * @apiSuccess {Object} data.bank_details Bank Details object of Surveyor
 * @apiSuccess {String} data.bank_details.branch_name Branch name
 * @apiSuccess {String} data.bank_details.bank_name Name of the bank
 * @apiSuccess {String} data.bank_details.bank_ac_no Account number of Surveyor.
 * @apiSuccess {String} data.bank_details.bank_mobile_no Mobile no. registered with bank.
 * 
 * @apiSuccess {Object} data.bank_details User Details object of Surveyor
 * @apiSuccess {Number} data.user_details.state Primary key of the state.
 * @apiSuccess {Number} data.user_details.district Primary key of the district.
 * @apiSuccess {Number} data.user_details.block Primary key of the block.
 * @apiSuccess {Number} data.user_details.id_proof_type ID proof Type.
 * @apiSuccess {String} data.user_details.id_proof_value ID proof value.
 * 
 * @apiSuccess {Object} data.additional_details Additional Details object of Surveyor
 * @apiSuccess {Number} data.additional_details.user_type Type of the User 1=Surveyor, 2=Supervisor.
 * @apiSuccess {Array} data.additional_details.survey_for Array of types specifying the surveyor will survey for 1=SHG, 2 = Haat Bazaar, 3 = Warehouse.
 * @apiSuccess {Null} data.additional_details.supervising_for This will be null when the user_type is 1
 * @apiSuccess {Array} data.additional_details.map_surveyor Array Containing the ID's of user the the surveyor is assigned to.
 * @apiSuccess {Number} data.additional_details.alternate_no Alternate Number.
 * @apiSuccess {Number} data.additional_details.phone_type Phone Type with reference to master table.
 * @apiSuccess {Number} data.additional_details.is_phone_self_owned Field specifying the phone is self owned or other.
 *
 * @apiSuccessExample Success-Response:
    HTTP/1.1 200 OK
    {
        "status": 1,
        "data": {
            "id": 6,
            "name": "John",
            "user_name": "john_789",
            "middle_name": null,
            "last_name": "Doe",
            "mobile": 9898989754,
            "email": "john@localhost.com",
            "state": "Haryana",
            "district": "Faridabad",
            "block": "D-Block",
            "user_type": "Surveyor",
            "bank_details": {
                "branch_name": "Noida",
                "bank_name": "ICICI",
                "bank_ac_no": 1234567654654,
                "ifsc_code": "IFSC00621",
                "bank_mobile_no": "7878778911"
            },
            "user_details": {
                "state": 1,
                "district": 1,
                "block": 1,
                "id_proof_type": 1,
                "id_proof_value": "123456789012"
            },
            "additional_details": {
                "user_type": 1,
                "survey_for": [1],
                "supervising_for": null,
                "map_surveyor" : [5]
                "alternate_no": "2627897861",
                "phone_type": 4,
                "is_phone_self_owned": 0
            }
        }
    }
 * 
 */


/**
 * @api {PUT} surveyor/:user_id Update
 * @apiName SurveyorUpdate
 * @apiGroup Surveyor
 * 
 * @apiParam (Parameters) id User ID
 * 
 * @apiParam (Payload) {String{..100}} username Username of the Surveyor
 * @apiParam (Payload) {String{..100}} name Name of the Surveyor
 * @apiParam (Payload) {String{..100}} middle_name Middle Name of the Surveyor
 * @apiParam (Payload) {String{..100}} last_name Last Name of the Surveyor
 * @apiParam (Payload) {String{..100}} email Email of the Surveyor
 * @apiParam (Payload) {Number{..100}} id_proof_type ID proof selected.
 * @apiParam (Payload) {String{..100}} id_proof_value Value of ID Proof selected
 * @apiParam (Payload) {Number{..4}} state State of the Surveyor
 * @apiParam (Payload) {Number{..4}} district District of the Surveyor
 * @apiParam (Payload) {Number{..4}} block Block of the Surveyor
 * @apiParam (Payload) {Number{..11}} mobile_no Mobile no. of the Surveyor
 * @apiParam (Payload) {Number{..11}} alternate_no Alternate Number of the Surveyor
 * @apiParam (Payload) {Number{..1}} user_type Type of user Surveyor=1 or Supervisor=2
 * @apiParam (Payload) {String{..255}} survey_for If user type=1. Multiple ID's can be provided as comma seperated values.
 * @apiParam (Payload) {String{..255}} supervising_for Required If user_type=2. This will be null in this form type.
 * @apiParam (Payload) {Number{..20}} map_surveyor Required If user_type=1. Specifies the supervisor to which the surveyor will be mapped to.
 * @apiParam (Payload) {String{..25}} bank_name Name of the bank.
 * @apiParam (Payload) {String{..25}} branch_name Branch Name
 * @apiParam (Payload) {String{..11}} ifsc_code IFSC Code
 * @apiParam (Payload) {String{..15}} bank_mobile_no Mobile No. associated with Bank.
 * @apiParam (Payload) {Number{..20}} bank_ac_no Bank AC Number
 * @apiParam (Payload) {Number{..1}} phone_type Phone Type
 * @apiParam (Payload) {Number{..1}} is_phone_self_owned Is Phone Self owned.
 * @apiParamExample {json} Payload
 * {
        "user_name": "sampleuser_011",
        "name": "John",
        "middle_name": "",
        "last_name": "Doe",
        "email": "johndoe@localhost.com",
        "id_proof_type": 2,
        "id_proof_value": "123456789012",
        "state": 1,
        "district": 24,
        "block": 56,
        "mobile_no": 9898989754,
        "alternate_no": 2627897861,
        "supervising_for": "",
        "survey_for": "1",
        "user_type": 1,
        "bank_name": "HDFC",
        "branch_name": "Noida",
        "ifsc_code": "IFSC00621",
        "bank_mobile_no": "1234567890",
        "bank_ac_no": "1234567654654",
        "phone_type": 1,
        "is_phone_self_owned": 1,
        "map_surveyor": 5
    }
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
            "name": "John",
            "mobile": 9898989754,
            "email": "johndoe@localhost.com",
            "state": "UP",
            "district": "District A",
            "block": "Block B",
            "user_type": "Surveyor"
        }
    }

    @apiError (Duplicate Username) {Number} status Response Status
    @apiError (Duplicate Username) {String} message Error Response Message specifiying the reason for failure.
    @apiErrorExample {JSON} Duplicate Username
    HTTP/1.1 422 Unprocessable Entity
    {
        "status": 0,
        "message": "The username has already been taken."
    }

    @apiError (Invalid Username) {Number} status Response Status
    @apiError (Invalid Username) {String} message Error Response Message specifiying the reason for failure.
    @apiErrorExample {JSON} Invalid Username
    HTTP/1.1 422 Unprocessable Entity
    {
        "status": 0,
        "message": "The user name should only contain alpha numeric and dashes."
    }

    @apiError (Duplicate Mobile) {Number} status Response Status
    @apiError (Duplicate Mobile) {String} message Error Response Message specifiying the reason for failure.
    @apiErrorExample {JSON} Duplicate Mobile
    HTTP/1.1 422 Unprocessable Entity
    {
        "status": 0,
        "message": "The Mobile has already been taken."
    }

    @apiError (Duplicate Bank Account) {Number} status Response Status
    @apiError (Duplicate Bank Account) {String} message Error Response Message specifiying the reason for failure.
    @apiErrorExample {JSON} Duplicate Bank Account
    HTTP/1.1 422 Unprocessable Entity
    {
        "status": 0,
        "message": "The Bank Account has already been taken."
    }
 * 
 */

/**
 * @api {PUT} surveyor/status/:user_id Activate or Deactivate
 * @apiName SurveyorActivateDeactivate
 * @apiGroup Surveyor
 *
 * @apiParam user_id User ID
 * 
 * @apiSuccess (Account Activated or Deactivated) {Number} status Specifying the status of response.
 * @apiSuccess (Account Activated or Deactivated) {Object} data Object containing the 
 * @apiSuccess (Account Activated or Deactivated) {String} data.message Specifying the message of response whether activated or deactivated.
 * @apiSuccess (Account Activated or Deactivated) {Number} data.status Integer representing the final staus of user.
 *
 * @apiSuccessExample Success-Response:
    HTTP/1.1 200 OK
    {
        "status": 1,
        "data": {
            "message": "Account Activated",
            "status": 1
        }
    }
 * 
 */

/**
 * @api {PUT} surveyor/mapping/:id Mapping Surveyors with Mentoring Organisation
 * @apiName SurveyorMoMapping
 * @apiGroup Surveyor
 * 
 * @apiParam (Parameter) {Number} id Resource ID of the Mentoring Organisation of which the mapping needs to be done.
 * 
 * @apiParam (Payload) {Number{..20}} surveyor_ids[] ID of the surveyor, multiple fields can be provided for mapping additional users.
 * 
 * @apiParamExample {json} Payload
 * {
        surveyor_ids: [2,3]
   }
 * 
 * @apiSuccess {Number} status Response Status
 * @apiSuccess {Object} data  JSON object for specified master resource.
 * @apiSuccess {Number} data.id Resource id of the mentoring organisation.
 * @apiSuccess {String} data.name Name of the mentoring organisation.
 * @apiSuccess {Array} data.surveyors List containing of the surveyors mapped with the mentoring organisation.
 * @apiSuccess {Number} data.surveyors.id Resource id of the surveyor.
 * @apiSuccess {String} data.surveyors.name name of the surveyor.
 * @apiSuccess {String} data.surveyors.email email of the surveyor.
 *
 * @apiSuccessExample Success-Response:
    HTTP/1.1 200 OK
    {
        "status": 1,
        "data": {
            "id": 4,
            "name": "Mentoring Organisation",
            "surveyors": [{
                    "id": 2,
                    "name": "User 1",
                    "email": "admi111@localhost.com"
                },
                {
                    "id": 3,
                    "name": "User 2",
                    "email": "admi1111@localhost.com"
                }
            ]
        }
    }
 * 
 */


/**
 * @api {GET} surveyor/mapping/:id Mapping Surveyors with Mentoring Organisation Listing
 * @apiName SurveyorMoMappingListing
 * @apiGroup Surveyor
 * 
 * @apiParam (Parameter) {Number} id Resource ID of the Mentoring Organisation of which the mapping needs to be done.
 * 
 * @apiSuccess {Number} status Response Status
 * @apiSuccess {Object} data  JSON object for specified master resource.
 * @apiSuccess {Number} data.id Resource id of the mentoring organisation.
 * @apiSuccess {String} data.name Name of the mentoring organisation.
 * @apiSuccess {Array} data.surveyors List containing of the surveyors mapped with the mentoring organisation.
 * @apiSuccess {Number} data.surveyors.id Resource id of the surveyor.
 * @apiSuccess {String} data.surveyors.name name of the surveyor.
 * @apiSuccess {String} data.surveyors.email email of the surveyor.
 *
 * @apiSuccessExample Success-Response:
    HTTP/1.1 200 OK
    {
        "status": 1,
        "data": {
            "id": 4,
            "name": "Mentoring Organisation",
            "surveyors": [{
                    "id": 2,
                    "name": "User 1",
                    "email": "admi111@localhost.com"
                },
                {
                    "id": 3,
                    "name": "User 2",
                    "email": "admi1111@localhost.com"
                }
            ]
        }
    }
 * 
 */