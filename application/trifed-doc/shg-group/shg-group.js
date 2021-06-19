/**
 * @api {GET} shg/shg-group List
 * @apiName ShgGroupList
 * @apiGroup Shg Group
 * 
 * @apiSuccess {Number} status Response Status
 * @apiSuccess {Object} data  JSON object for specified master resource.
 * @apiSuccess {Number} data.title title of Shg Group
 * @apiSuccess {Number} data.bank_ac_no bank account no
 * @apiSuccess {Number} data.ifsc_code ifsc code
 * @apiSuccess {Number} data.total_corpus total corpus
 * @apiSuccess {Number} data.coordinating_agency coordinating agency
 * @apiSuccess {Number} data.st_members  number of st members 
 * @apiSuccess {Number} data.contact_person contact person name
 * @apiSuccess {Number} data.contact_person_mobile contact person mobile no
 * @apiSuccess {Number} data.is_ajeevika is ajeevika value 0 or 1
 * @apiSuccess {Number} data.ajeevika_value Ajeevika value
 * @apiSuccess {Number} data.shg_group_no No of Shg Groups
 * @apiSuccess {String} data.shgGatherers Json Array
 *
 * @apiSuccessExample Success-Response:
    HTTP/1.1 200 OK
   {
    "status": 1,
    "data": [
        {
            "title": "test",
            "bank_ac_no": 1681276312,
            "ifsc_code": "punb009923",
            "total_corpus": 1,
            "coordinating_agency": 1,
            "st_members": 1,
            "corpus_to_invest": 1,
            "contact_person": "shubhangi",
            "contact_person_mobile": 850485,
            "is_ajeevika": 1,
            "ajeevika_value": "1",
            "shg_group_no": "1",
            "shgGatherers": [
                {
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
                    "state": 1,
                    "district": 1,
                    "block": 1,
                    "gram_panchayat": "Panchayat A",
                    "village": 1,
                    "pin_code": 123345,
                    "education": 1,
                    "occupation": 1,
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
                    "created_by": 0,
                    "updated_by": 0,
                    "created_at": "2019-11-07 11:16:54",
                    "updated_at": "2019-11-07 11:16:54",
                    "deleted_at": null,
                    "pivot": {
                        "group_id": 1,
                        "shg_id": 1
                    }
                },
                {
                    "id": 2,
                    "name_of_tribal": "Shubhangi",
                    "gender": "M",
                    "dob": "1995-12-10",
                    "birth_year": 1,
                    "age": 24,
                    "id_type": "4",
                    "id_value": "231231232",
                    "father": "Rajesh Father",
                    "mother": "Rajesh Mother",
                    "address": "Noida sector 62",
                    "state": 1,
                    "district": 1,
                    "block": 1,
                    "gram_panchayat": "Panchayat A",
                    "village": 1,
                    "pin_code": 123345,
                    "education": 1,
                    "occupation": 1,
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
                    "created_by": 0,
                    "updated_by": 0,
                    "created_at": "2019-11-08 06:14:16",
                    "updated_at": "2019-11-08 06:14:16",
                    "deleted_at": null,
                    "pivot": {
                        "group_id": 1,
                        "shg_id": 2
                    }
                }
            ]
        }
    ]
}
 * 
*/
/**
 * @api {POST} shg/shg-group Create
 * @apiName ShgGroupCreate
 * @apiGroup Shg Group
 * 
 * @apiParam (Payload) {String{..100}} title Title
 * @apiParam (Payload) {String{..11}} bank_ac_no Bank_Account No
 * @apiParam (Payload) {String{..20}} ifsc_code Ifsc Code
 * @apiParam (Payload) {Int{..11}} total_corpus total corpus
 * @apiParam (Payload) {Int{..11}} coordinating_agency Unique ID of coordinating agency
 * @apiParam (Payload) {Int{..11}} st_members No of st members
 * @apiParam (Payload) {Int{..11}} corpus_to_invest corpus-invest
 * @apiParam (Payload) {Int{..11}} contact_person contact person
 * @apiParam (Payload) {Int{..1}} contact_person_mobile contact person mobile
 * @apiParam (Payload) {Int{..11}} is_ajeevika 0=No,1=Yes
 * @apiParam (Payload) {String{..15}} ajeevika_value ajeevika value
 * @apiParam (Payload) {String{..20}} shg_group_no No. of shg groups
 * @apiParam (Payload) {Array} shgIds Array of shgIds
 *
 * @apiParamExample {json} Payload
 * {
        "title":"test"
        "bank_ac_no":"1681276312"
        "ifsc_code":"punb009923"
        "total_corpus":1
        "coordinating_agency":1
        "st_members":1
        "corpus_to_invest":1
        "contact_person":"shubhangi"
        "contact_person_mobile":"8504852548"
        "is_ajeevika":1
        "ajeevika_value":1
        "shg_group_no":1
        "shgIds[]":1
        "shgIds[]":2
 * }
 *
 * @apiSuccess {Number} status Response Status
 * @apiSuccess {Object} data  JSON object for specified master resource.
 * @apiSuccess {Number} data.title title of Shg Group
 * @apiSuccess {Number} data.bank_ac_no bank account no
 * @apiSuccess {Number} data.ifsc_code ifsc code
 * @apiSuccess {Number} data.total_corpus total corpus
 * @apiSuccess {Number} data.coordinating_agency coordinating agency
 * @apiSuccess {Number} data.st_members  number of st members 
 * @apiSuccess {Number} data.contact_person contact person name
 * @apiSuccess {Number} data.contact_person_mobile contact person mobile no
 * @apiSuccess {Number} data.is_ajeevika is ajeevika value 0 or 1
 * @apiSuccess {Number} data.ajeevika_value Ajeevika value
 * @apiSuccess {Number} data.shg_group_no No of Shg Groups
 * @apiSuccess {String} data.shgGatherers Json Array
 *
 * @apiSuccessExample Success-Response:
    HTTP/1.1 200 OK
    {
    "status": 1,
    "data": {
        "title": "test",
        "bank_ac_no": "1681276312",
        "ifsc_code": "punb009923",
        "total_corpus": "1",
        "coordinating_agency": "1",
        "st_members": "1",
        "corpus_to_invest": "1",
        "contact_person": "shubhangi",
        "contact_person_mobile": "850485",
        "is_ajeevika": "1",
        "ajeevika_value": "1",
        "shg_group_no": "1",
        "shgGatherers": [
            {
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
                "state": 1,
                "district": 1,
                "block": 1,
                "gram_panchayat": "Panchayat A",
                "village": 1,
                "pin_code": 123345,
                "education": 1,
                "occupation": 1,
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
                "created_by": 0,
                "updated_by": 0,
                "created_at": "2019-11-07 11:16:54",
                "updated_at": "2019-11-07 11:16:54",
                "deleted_at": null,
                "pivot": {
                    "group_id": 24,
                    "shg_id": 1
                }
            },
            {
                "id": 2,
                "name_of_tribal": "Shubhangi",
                "gender": "M",
                "dob": "1995-12-10",
                "birth_year": 1,
                "age": 24,
                "id_type": "4",
                "id_value": "231231232",
                "father": "Rajesh Father",
                "mother": "Rajesh Mother",
                "address": "Noida sector 62",
                "state": 1,
                "district": 1,
                "block": 1,
                "gram_panchayat": "Panchayat A",
                "village": 1,
                "pin_code": 123345,
                "education": 1,
                "occupation": 1,
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
                "created_by": 0,
                "updated_by": 0,
                "created_at": "2019-11-08 06:14:16",
                "updated_at": "2019-11-08 06:14:16",
                "deleted_at": null,
                "pivot": {
                    "group_id": 24,
                    "shg_id": 2
                }
            }
        ]
    }
}
* 
*/
