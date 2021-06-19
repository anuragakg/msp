/**
 * @api {get} bank-details/:user_id View Bank Details
 * @apiName ViewUserBankDetails
 * @apiGroup User Bank Details
 * 
 * @apiParam user_id User ID Unique user id of the user.
 *
 * @apiSuccess {Number} status Response Status
 * @apiSuccess {Array} data  Array containing all the records of Surveyors.
 * @apiSuccess {Number} data.id Unique ID of Record
 * @apiSuccess {String} data.ac_holder_name Account Holder Name
 * @apiSuccess {String} data.branch_name Branch Name of the Bank.
 * @apiSuccess {Number} data.bank_ac_no Branch Name of the Bank.
 * @apiSuccess {String} data.bank_name Name of the Bank.
 * @apiSuccess {String} data.ifsc_code IFSC Code of the bank.
 *
 * @apiSuccessExample Success-Response:
    HTTP/1.1 200 OK
    {
        "status": 1,
        "data": {
            "id": 5,
            "ac_holder_name": 'John Doe',
            "branch_name": "Noida",
            "bank_name": "ICICI",
            "bank_ac_no": 1234567654374,
            "ifsc_code": "IFSC00622"
        }
    }

    @apiError (Not Found) {Number} status Response Status
    @apiError (Not Found) {String} message Error Response Message specifiying the reason for failure.
    @apiErrorExample Resource Not Found
    HTTP / 1.1 404 Not Found
    {
        "status": 0,
        "message": "Not found"
    }
 * 
 */