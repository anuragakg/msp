/**
 * @api {POST} email-verify Verification
 * @apiName EmailVerification
 * @apiGroup Authentication
 *
 * @apiParam (Payload) {String{..100}} email_verify_token
 *
 * @apiParamExample {json} Payload
 * {
 *     email_verify_token : 'testemailtoken',
 * }
 * 
 * @apiSuccess {Number} status Response Status
 * @apiSuccess {Object} data  JSON object for specified master resource.
 *
 * @apiSuccessExample Success-Response:
    HTTP/1.1 200 OK
    {
        "status": 1,
        "data": {
            "message": "Email Verified."
        }
    }

    @apiError (Invalid Token) {Number} status Response Status
    @apiError (Invalid Token) {String} message Error Response Message specifiying the reason for failure.
    @apiErrorExample {JSON} Invalid Token
    HTTP/1.1 422 Unprocessable Entity
    {
        "status": 0,
        "message": "Not found."
    }
 * 
 */

 /**
 * @api {POST} generate-password Generate Passwrord
 * @apiName Set Password
 * @apiGroup Authentication
 *
 * @apiParam (Payload) {String{..100}} email_verify_token
 * @apiParam (Payload) {String{..100}} password
 *
 * @apiParamExample {json} Payload
 * {
 *     email_verify_token : 'testemailtoken',
 *     password           : 'XXXXXXX',
 * }
 * 
 * @apiSuccess {Number} status Response Status
 * @apiSuccess {Object} data  JSON object for specified master resource.
 *
 * @apiSuccessExample Success-Response:
    HTTP/1.1 200 OK
    {
        "status": 1,
        "data": {
            "message": "Password Created Successfully."
        }
    }

    @apiError (Invalid Token) {Number} status Response Status
    @apiError (Invalid Token) {String} message Error Response Message specifiying the reason for failure.
    @apiErrorExample {JSON} Invalid Token
    HTTP/1.1 422 Unprocessable Entity
    {
        "status": 0,
        "message": "Not found."
    }
 * 
 */

 /**
 * @api {POST} login Login
 * @apiName Login
 * @apiGroup Authentication
 *
 * @apiParam (Payload) {String{..100}} username
 * @apiParam (Payload) {String{..100}} password
 *
 * @apiParamExample {json} Payload
 * {
 *     username           : 'Username 1',
 *     password           : 'XXXXXXX',
 * }
 * 
 * @apiSuccess {Number} status Response Status
 * @apiSuccess {Object} data  JSON object for specified master resource.
 *
 * @apiSuccessExample Success-Response:
    HTTP/1.1 200 OK
    {
        "status": 1,
        "data": {
            "token": "YmVmNDcyYjJmYTNkYzI2YjQzZDc0ZQ5MmIyM2M3N2YjJhZjQzYmQwZTYwNTBkNmViZWY0NzJiMmZhM2RjMjZiNDNkNzRlMGU5YTVlY2E2YzlkY2FjNDhlMGI3MTljZjA5MDY2NDkyYjIzYzc3YjUiLCJpYXQiOjE1NzE0NjcxNzcsIm5iZiI6MTU3MTQ2NzE3NywiZXhwIjoxNjAzMDg5NTc3LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.ebz1w6f2_39oz5BO6fcOw56b0KXKsT4AobILN5gNHmxk7j1DpXw-xK3Oijadg9H0gugx16oljSqZZjeK6hmbeQ"
        }
    }

    @apiError (Unauthenticated) {Number} status Response Status
    @apiError (Unauthenticated) {String} message Error Response Message specifiying the reason for failure.
    @apiErrorExample {JSON} Invalid Token
    HTTP/1.1 422 Unprocessable Entity
    {
        "status": 0,
        "message": "Unauthorized."
    }
 * 
 */ 

/**
 * @api {get} logout logout
 * @apiName   Logout
 * @apiGroup  Authentication
 *
 * @apiHeader Authorization Bearer Access Authentication token.
 * @apiHeader Content-Type (application/x-www-form-urlencoded, application/json).
 *
 * @apiSuccess {Number} status Response Status
 * @apiSuccess {Object} data  JSON object for specified master resource.
 *
 * @apiSuccessExample Success-Response:
    HTTP/1.1 200 OK
    {
        "status": 1,
        "data": {
            "message": "User logged out.""
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
 * @api {POST} change-password Change Password 
 * @apiName Change Password
 * @apiGroup Authentication
 *
 * @apiHeader Authorization Bearer Access Authentication token.
 * @apiHeader Content-Type (application/x-www-form-urlencoded, application/json).
 *
 * @apiParam (Payload) {String{..100}} old_password
 * @apiParam (Payload) {String{..100}} password
 * @apiParam (Payload) {String{..100}} confirm_password
 *
 * @apiParamExample {json} Payload
 * {
 *     old_password       : 'XXXXXXXX',
 *     password           : 'XXXXXXX',
 *     confirm_password   : 'XXXXXXX'
 * }
 * 
 * @apiSuccess {Number} status Response Status
 * @apiSuccess {Object} data  JSON object for specified master resource.
 *
 * @apiSuccessExample Success-Response:
    HTTP/1.1 200 OK
    {
        "status": 1,
        "data": {
            "message": "Password Changed Successfully"
        }
    }

    @apiError (Unauthenticated) {Number} status Response Status
    @apiError (Unauthenticated) {String} message Error Response Message specifiying the reason for failure.
    @apiErrorExample {JSON} Invalid Token
    HTTP/1.1 422 Unprocessable Entity
    {
        "status": 0,
        "message": "Unauthorized."
    }
    @apiError (Unauthenticated) {Number} status Response Status
    @apiError (Unauthenticated) {String} message Error Response Message specifiying the reason for failure.
    @apiErrorExample {JSON} Wrong Old Password
    HTTP/1.1 422 Unprocessable Entity
    {
        "status": 0,
        "message": "Old Password doesn't match."
    }
    @apiError (Unauthenticated) {Number} status Response Status
    @apiError (Unauthenticated) {String} message Error Response Message specifiying the reason for failure.
    @apiErrorExample {JSON} New Password Generation Error
    HTTP/1.1 422 Unprocessable Entity
    {
        "status": 0,
        "message": "The New Password can'be same as last three passwords."
    }
 * 
 */ 

