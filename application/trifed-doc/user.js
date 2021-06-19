/**
 * @api {get} user View All
 * @apiName UserManagementViewAll
 * @apiGroup User Management
 *
 * @apiSuccess {Number} status Response Status
 * @apiSuccess {Array} data  Array containing all the records of User.
 * @apiSuccess {Number} data.id Unique ID of Record
 * @apiSuccess {String} data.name Name of User
 * @apiSuccess {Number} data.mobile Mobile Phone of User
 * @apiSuccess {String} data.email Email of User
 * @apiSuccess {String} data.email Email of User
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
            "state": 1,
            "district": 24,
            "block": 56,
            "user_type": "Surveyor"
        }]
    }
 * 
 */

 /**
 * @api {get} user/:id View One
 * @apiName UserManagementViewOne
 * @apiGroup User Management
 *
 * @apiParam (Parameter) {Number} id Resource ID

 * @apiSuccess {Number} status Response Status
 * @apiSuccess {Array} data  Array containing all the records of User.
 * @apiSuccess {Number} data.id Unique ID of Record
 * @apiSuccess {String} data.name Name of User
 * @apiSuccess {Number} data.mobile Mobile Phone of User
 * @apiSuccess {String} data.email Email of User
 * @apiSuccess {String} data.email Email of User
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
            "state": 1,
            "district": 24,
            "block": 56,
            "user_type": "Surveyor"
        }]
    }
 * 
 */


/**
 * @api {POST} user Create
 * @apiName UserCreate
 * @apiGroup User Management
 * @apiParam (Payload) {String{..100}} username Username of the User
 * @apiParam (Payload) {String{..100}} name Name of the User
 * @apiParam (Payload) {String{..100}} middle_name Middle Name of the User
 * @apiParam (Payload) {String{..100}} last_name Last Name of the User
 * @apiParam (Payload) {String{..100}} email Email of the User
 * @apiParam (Payload) {Number{..100}} id_proof_type ID proof selected.
 * @apiParam (Payload) {String{..100}} id_proof_value Value of ID Proof selected
 * @apiParam (Payload) {Number{..4}} state State of the User
 * @apiParam (Payload) {Number{..4}} district District of the User
 * @apiParam (Payload) {Number{..4}} block Block of the User
 * @apiParam (Payload) {Number{..11}} mobile_no Mobile no. of the User
 * @apiParam (Payload) {Number{..11}} alternate_no Alternate Number of the User
 * @apiParam (Payload) {Number{..1}} user_type Type of user
 * @apiParam (Payload) {String{..25}} bank_name Name of the bank.
 * @apiParam (Payload) {String{..25}} branch_name Branch Name
 * @apiParam (Payload) {String{..11}} ifsc_code IFSC Code
 * @apiParam (Payload) {Number{..20}} bank_ac_no Bank AC Number
 * @apiParam (Payload) {Number{..1}} phone_type Phone Type
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
        "survey_for": 1,
        "user_type": 1,
        "bank_name": "HDFC",
        "branch_name": "Noida",
        "ifsc_code": "IFSC00621",
        "bank_ac_no": "1234567654654",
        "phone_type": 1
    }
 * 
 * @apiSuccess {Number} status Response Status
 * @apiSuccess {Object} data  JSON object for specified master resource.
 *
 * @apiSuccessExample Success-Response:
    HTTP/1.1 200 OK
    {
        "status": 1,
        "data": [{
            "id": 1,
            "name": "John",
            "mobile": 9898989754,
            "email": "johndoe@localhost.com",
            "state": 1,
            "district": 24,
            "block": 56,
            "user_type": "Surveyor"
        }]
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
 * @api {PUT} user/:id Update
 * @apiName UserUpdate
 * @apiGroup User Management

 * @apiParam (Parameter) {Number} id Resource ID
 
 * @apiParam (Payload) {String{..100}} username Username of the User
 * @apiParam (Payload) {String{..100}} name Name of the User
 * @apiParam (Payload) {String{..100}} middle_name Middle Name of the User
 * @apiParam (Payload) {String{..100}} last_name Last Name of the User
 * @apiParam (Payload) {String{..100}} email Email of the User
 * @apiParam (Payload) {Number{..100}} id_proof_type ID proof selected.
 * @apiParam (Payload) {String{..100}} id_proof_value Value of ID Proof selected
 * @apiParam (Payload) {Number{..4}} state State of the User
 * @apiParam (Payload) {Number{..4}} district District of the User
 * @apiParam (Payload) {Number{..4}} block Block of the User
 * @apiParam (Payload) {Number{..11}} mobile_no Mobile no. of the User
 * @apiParam (Payload) {Number{..11}} alternate_no Alternate Number of the User
 * @apiParam (Payload) {Number{..1}} user_type Type of user
 * @apiParam (Payload) {String{..25}} bank_name Name of the bank.
 * @apiParam (Payload) {String{..25}} branch_name Branch Name
 * @apiParam (Payload) {String{..11}} ifsc_code IFSC Code
 * @apiParam (Payload) {Number{..20}} bank_ac_no Bank AC Number
 * @apiParam (Payload) {Number{..1}} phone_type Phone Type
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
        "survey_for": 1,
        "user_type": 1,
        "bank_name": "HDFC",
        "branch_name": "Noida",
        "ifsc_code": "IFSC00621",
        "bank_ac_no": "1234567654654",
        "phone_type": 1
    }
 * 
 * @apiSuccess {Number} status Response Status
 * @apiSuccess {Object} data  JSON object for specified master resource.
 *
 * @apiSuccessExample Success-Response:
    HTTP/1.1 200 OK
    {
        "status": 1,
        "data": [{
            "id": 1,
            "name": "John",
            "mobile": 9898989754,
            "email": "johndoe@localhost.com",
            "state": 1,
            "district": 24,
            "block": 56,
            "user_type": "Surveyor"
        }]
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