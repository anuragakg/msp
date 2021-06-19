/**
 * @api {get} mentoring-organisation View All
 * @apiName MentoringOrganisationViewAll
 * @apiGroup Mentoring Organisation
 *
 * 
 * @apiSuccess {Number} status Response Status
 * @apiSuccess {Number} data.id Unique ID of Record
 * @apiSuccess {String} data.name Name of Mentoring Organisation
 * @apiSuccess {String} data.user_name User Name of Mentoring Organisation
 * @apiSuccess {String} data.middle_name Middle Name of Mentoring Organisation
 * @apiSuccess {String} data.last_name Last Name of Mentoring Organisation
 * @apiSuccess {Number} data.mobile Mobile Phone of Mentoring Organisation
 * @apiSuccess {String} data.email Email of Mentoring Organisation
 * @apiSuccess {String} data.state State of Mentoring Organisation
 * @apiSuccess {String} data.district District of Mentoring Organisation
 * @apiSuccess {String} data.block Block of Mentoring Organisation
 * @apiSuccess {String} data.user_type User Type of Mentoring Organisation
 * 
 * @apiSuccess {Number} data.user_details.state Primary key of the state.
 * @apiSuccess {Number} data.user_details.district Primary key of the district.
 * @apiSuccess {Number} data.user_details.block Primary key of the block.
 * 
 * @apiSuccess {Object} data.additional_details Additional Details object of Mentoring Organisation
 * @apiSuccess {Number} data.additional_details.org_type Type of the Org.
 * @apiSuccess {String} data.additional_details.registration_no Field specifying the registration no.
 * @apiSuccess {Date}   data.additional_details.registration_date Field specifying the registration date.
 * @apiSuccess {Date}   data.additional_details.registration_expiry Field specifying the registration expriy date.
 * @apiSuccess {String} data.additional_details.registration_certificate Certificate Path.
 * @apiSuccess {String} data.additional_details.chairman_name Field specifying the chairman name.
 * @apiSuccess {String} data.additional_details.chairman_mobile Field specifying the chairman mobile.
 * @apiSuccess {String} data.additional_details.chairman_email Field specifying the chairman email.
 * @apiSuccess {String} data.additional_details.secretary_name Field specifying the secretary_name.
 * @apiSuccess {String} data.additional_details.secretary_mobile Field specifying the secretary_mobile.
 * @apiSuccess {String} data.additional_details.secretary_email Field specifying the secretary email.
 * @apiSuccess {String} data.additional_details.gst_or_tan Field specifying the gst or tan.
 *
 * @apiSuccessExample Success-Response:
    HTTP/1.1 200 OK
   {
        "status": 1,
        "data": [
            {
                "id": 5,
                "name": "Mentoring",
                "user_name": "mo.user",
                "middle_name": "",
                "last_name": "Organisation",
                "mobile": 9910785273,
                "email": "mo@localhost.com",
                "state": 1,
                "district": 1,
                "block": null,
                "user_type": "Mentoring Organisation",
                "user_details": {
                    "state": 1,
                    "district": 1,
                    "block": 1
                },
                "additional_details": {
                    "org_type": 1,
                    "registration_no": "MO0099912",
                    "registration_date": "2019-11-10",
                    "registration_expiry": "2019-11-11",
                    "registration_certificate": "image path",
                    "chairman_name": "test",
                    "chairman_mobile": 983282333,
                    "chairman_email": "test12@gmail.com",
                    "secretary_name": "test2",
                    "secretary_mobile": 0,
                    "secretary_email": "test3@gmail.com",
                    "gst_or_tan": "56761272"
                }
            }
       ] 
    }
 * 
 */
/**
 * @api {post} mentoring-organisation Create
 * @apiName MentoringOrganisationCreate
 * @apiGroup Mentoring Organisation
 *
 * @apiParam (Parameters) user_id User ID
 *
 { 
    "user_name"
    "org_type"
    "registration_no"
    "name"
    "official_address"
    "district"
    "pin_code"
    "chairman_name"
    "chairman_mobile"
    "chairman_email"
    "secretary_name"
    "secretary_mobile"
    "secretary_email"
    "registration_date"
    "registration_expiry"
    "gst_or_tan"
 } 
 * 
 * @apiSuccess {Number} status Response Status
 * @apiSuccess {Number} data.id Unique ID of Record
 * @apiSuccess {String} data.name Name of Mentoring Organisation
 * @apiSuccess {String} data.user_name User Name of Mentoring Organisation
 * @apiSuccess {String} data.middle_name Middle Name of Mentoring Organisation
 * @apiSuccess {String} data.last_name Last Name of Mentoring Organisation
 * @apiSuccess {Number} data.mobile Mobile Phone of Mentoring Organisation
 * @apiSuccess {String} data.email Email of Mentoring Organisation
 * @apiSuccess {String} data.state State of Mentoring Organisation
 * @apiSuccess {String} data.district District of Mentoring Organisation
 * @apiSuccess {String} data.block Block of Mentoring Organisation
 * @apiSuccess {String} data.user_type User Type of Mentoring Organisation
 * 
 * @apiSuccess {Number} data.user_details.state Primary key of the state.
 * @apiSuccess {Number} data.user_details.district Primary key of the district.
 * @apiSuccess {Number} data.user_details.block Primary key of the block.
 * 
 * @apiSuccess {Object} data.additional_details Additional Details object of Mentoring Organisation
 * @apiSuccess {Number} data.additional_details.org_type Type of the Org.
 * @apiSuccess {String} data.additional_details.registration_no Field specifying the registration no.
 * @apiSuccess {Date}   data.additional_details.registration_date Field specifying the registration date.
 * @apiSuccess {Date}   data.additional_details.registration_expiry Field specifying the registration expriy date.
 * @apiSuccess {String} data.additional_details.registration_certificate Certificate Path.
 * @apiSuccess {String} data.additional_details.chairman_name Field specifying the chairman name.
 * @apiSuccess {String} data.additional_details.chairman_mobile Field specifying the chairman mobile.
 * @apiSuccess {String} data.additional_details.chairman_email Field specifying the chairman email.
 * @apiSuccess {String} data.additional_details.secretary_name Field specifying the secretary_name.
 * @apiSuccess {String} data.additional_details.secretary_mobile Field specifying the secretary_mobile.
 * @apiSuccess {String} data.additional_details.secretary_email Field specifying the secretary email.
 * @apiSuccess {String} data.additional_details.gst_or_tan Field specifying the gst or tan.
 *
 * @apiSuccessExample Success-Response:
    HTTP/1.1 200 OK
   {
        "status": 1,
        "data": {
            "id": 5,
            "name": "Mentoring",
            "user_name": "mo.user",
            "middle_name": "",
            "last_name": "Organisation",
            "mobile": 9910785273,
            "email": "mo@localhost.com",
            "state": 1,
            "district": 1,
            "block": null,
            "user_type": "Mentoring Organisation",
            "user_details": {
                "state": 1,
                "district": 1,
                "block": 1
            },
            "additional_details": {
                "org_type": 1,
                "registration_no": "MO0099912",
                "registration_date": "2019-11-10",
                "registration_expiry": "2019-11-11",
                "registration_certificate": "image path",
                "chairman_name": "test",
                "chairman_mobile": 983282333,
                "chairman_email": "test12@gmail.com",
                "secretary_name": "test2",
                "secretary_mobile": 0,
                "secretary_email": "test3@gmail.com",
                "gst_or_tan": "56761272"
            }
        }
    }
 * 
 */
/**
 * @api {get} mentoring-organisation/:user_id View One
 * @apiName MentoringOrganisationViewOne
 * @apiGroup Mentoring Organisation
 *
 * @apiParam (Parameters) user_id User ID
 * 
 * @apiSuccess {Number} status Response Status
 * @apiSuccess {Number} data.id Unique ID of Record
 * @apiSuccess {String} data.name Name of Mentoring Organisation
 * @apiSuccess {String} data.user_name User Name of Mentoring Organisation
 * @apiSuccess {String} data.middle_name Middle Name of Mentoring Organisation
 * @apiSuccess {String} data.last_name Last Name of Mentoring Organisation
 * @apiSuccess {Number} data.mobile Mobile Phone of Mentoring Organisation
 * @apiSuccess {String} data.email Email of Mentoring Organisation
 * @apiSuccess {String} data.state State of Mentoring Organisation
 * @apiSuccess {String} data.district District of Mentoring Organisation
 * @apiSuccess {String} data.block Block of Mentoring Organisation
 * @apiSuccess {String} data.user_type User Type of Mentoring Organisation
 * 
 * @apiSuccess {Number} data.user_details.state Primary key of the state.
 * @apiSuccess {Number} data.user_details.district Primary key of the district.
 * @apiSuccess {Number} data.user_details.block Primary key of the block.
 * 
 * @apiSuccess {Object} data.additional_details Additional Details object of Mentoring Organisation
 * @apiSuccess {Number} data.additional_details.org_type Type of the Org.
 * @apiSuccess {String} data.additional_details.registration_no Field specifying the registration no.
 * @apiSuccess {Date}   data.additional_details.registration_date Field specifying the registration date.
 * @apiSuccess {Date}   data.additional_details.registration_expiry Field specifying the registration expriy date.
 * @apiSuccess {String} data.additional_details.registration_certificate Certificate Path.
 * @apiSuccess {String} data.additional_details.chairman_name Field specifying the chairman name.
 * @apiSuccess {String} data.additional_details.chairman_mobile Field specifying the chairman mobile.
 * @apiSuccess {String} data.additional_details.chairman_email Field specifying the chairman email.
 * @apiSuccess {String} data.additional_details.secretary_name Field specifying the secretary_name.
 * @apiSuccess {String} data.additional_details.secretary_mobile Field specifying the secretary_mobile.
 * @apiSuccess {String} data.additional_details.secretary_email Field specifying the secretary email.
 * @apiSuccess {String} data.additional_details.gst_or_tan Field specifying the gst or tan.
 *
 * @apiSuccessExample Success-Response:
    HTTP/1.1 200 OK
   {
        "status": 1,
        "data": {
            "id": 5,
            "name": "Mentoring",
            "user_name": "mo.user",
            "middle_name": "",
            "last_name": "Organisation",
            "mobile": 9910785273,
            "email": "mo@localhost.com",
            "state": 1,
            "district": 1,
            "block": null,
            "user_type": "Mentoring Organisation",
            "user_details": {
                "state": 1,
                "district": 1,
                "block": 1
            },
            "additional_details": {
                "org_type": 1,
                "registration_no": "MO0099912",
                "registration_date": "2019-11-10",
                "registration_expiry": "2019-11-11",
                "registration_certificate": "image path",
                "chairman_name": "test",
                "chairman_mobile": 983282333,
                "chairman_email": "test12@gmail.com",
                "secretary_name": "test2",
                "secretary_mobile": 0,
                "secretary_email": "test3@gmail.com",
                "gst_or_tan": "56761272"
            }
        }
    }
 * 
 */
/**
 * @api {get} mentoring-organisation/member-details/:user_id View One
 * @apiName MentoringOrganisationMemberDetails
 * @apiGroup Mentoring Organisation
 *
 * @apiParam (Parameters) user_id User ID
 * 
 * @apiSuccess {Number} status Response Status
 * @apiSuccess {String} data.additional_details.chairman_name Field specifying the chairman name.
 * @apiSuccess {Number} data.additional_details.chairman_mobile Field specifying the chairman mobile.
 * @apiSuccess {String} data.additional_details.chairman_email Field specifying the chairman email.
 * @apiSuccess {String} data.additional_details.secretary_name Field specifying the secretary_name.
 * @apiSuccess {Number} data.additional_details.secretary_mobile Field specifying the secretary_mobile.
 * @apiSuccess {String} data.additional_details.secretary_email Field specifying the secretary email.
 *
 * @apiSuccessExample Success-Response:
    HTTP/1.1 200 OK
   {
        "status": 1,
        "data": {
                "chairman_name": "test",
                "chairman_mobile": 983282333,
                "chairman_email": "test12@gmail.com",
                "secretary_name": "test2",
                "secretary_mobile": "8920782654",
                "secretary_email": "test3@gmail.com"
        }
    }
 * 
 */ 
/**
 * @api {PUT} mentoring-organisation/status/:user_id Activate or Deactivate
 * @apiName MentoringOrganisationActivateDeactivate
 * @apiGroup Mentoring Organisation
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
 * @api {put} mentoring-organisation/:user_id Update Mentoring Organisation
 * @apiName MentoringOrganisationUpdate
 * @apiGroup Mentoring Organisation
 *
 * @apiParam (Parameters) user_id User ID
 *
 { 
    user_name:mo_51408
    org_type:1
    registration_no:12397
    name:MO
    official_address:B-163
    state:1
    district:1
    pin_code:201302
    chairman_name:Test2
    chairman_mobile:2384923791
    chairman_email:test4@de.com
    secretary_name:IDhwas
    secretary_mobile:3724623730
    secretary_email:cuwdnw@de.com
    registration_date:12/02/2019
    registration_expiry:12/03/2019
    gst_or_tan:3224233
    registration_certificate:
 } 
 * 
 * @apiSuccess {Number} status Response Status
 * @apiSuccess {Number} data.id Unique ID of Record
 * @apiSuccess {String} data.name Name of Mentoring Organisation
 * @apiSuccess {String} data.user_name User Name of Mentoring Organisation
 * @apiSuccess {String} data.middle_name Middle Name of Mentoring Organisation
 * @apiSuccess {String} data.last_name Last Name of Mentoring Organisation
 * @apiSuccess {Number} data.mobile Mobile Phone of Mentoring Organisation
 * @apiSuccess {String} data.email Email of Mentoring Organisation
 * @apiSuccess {String} data.state State of Mentoring Organisation
 * @apiSuccess {String} data.district District of Mentoring Organisation
 * @apiSuccess {String} data.block Block of Mentoring Organisation
 * @apiSuccess {String} data.user_type User Type of Mentoring Organisation
 * 
 * @apiSuccess {Number} data.user_details.state Primary key of the state.
 * @apiSuccess {Number} data.user_details.district Primary key of the district.
 * @apiSuccess {Number} data.user_details.block Primary key of the block.
 * 
 * @apiSuccess {Object} data.additional_details Additional Details object of Mentoring Organisation
 * @apiSuccess {Number} data.additional_details.org_type Type of the Org.
 * @apiSuccess {String} data.additional_details.registration_no Field specifying the registration no.
 * @apiSuccess {Date}   data.additional_details.registration_date Field specifying the registration date.
 * @apiSuccess {Date}   data.additional_details.registration_expiry Field specifying the registration expriy date.
 * @apiSuccess {String} data.additional_details.registration_certificate Certificate Path.
 * @apiSuccess {String} data.additional_details.chairman_name Field specifying the chairman name.
 * @apiSuccess {String} data.additional_details.chairman_mobile Field specifying the chairman mobile.
 * @apiSuccess {String} data.additional_details.chairman_email Field specifying the chairman email.
 * @apiSuccess {String} data.additional_details.secretary_name Field specifying the secretary_name.
 * @apiSuccess {String} data.additional_details.secretary_mobile Field specifying the secretary_mobile.
 * @apiSuccess {String} data.additional_details.secretary_email Field specifying the secretary email.
 * @apiSuccess {String} data.additional_details.gst_or_tan Field specifying the gst or tan.
 *
 * @apiSuccessExample Success-Response:
    HTTP/1.1 200 OK
   {
        "status": 1,
        "data": {
            "id": 5,
            "name": "Mentoring",
            "user_name": "mo.user",
            "middle_name": "",
            "last_name": "Organisation",
            "mobile": 9910785273,
            "email": "mo@localhost.com",
            "state": 1,
            "district": 1,
            "block": null,
            "user_type": "Mentoring Organisation",
            "user_details": {
                "state": 1,
                "district": 1,
                "block": 1
            },
            "additional_details": {
                "org_type": 1,
                "registration_no": "MO0099912",
                "registration_date": "2019-11-10",
                "registration_expiry": "2019-11-11",
                "registration_certificate": "image path",
                "chairman_name": "test",
                "chairman_mobile": 983282333,
                "chairman_email": "test12@gmail.com",
                "secretary_name": "test2",
                "secretary_mobile": 0,
                "secretary_email": "test3@gmail.com",
                "gst_or_tan": "56761272"
            }
        }
    }
 * 
 */ 