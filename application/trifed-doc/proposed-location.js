/**
 * @api {get} proposed/proposed-location View All
 * @apiName ProposedLocationControllerViewAll
 * @apiGroup Proposed Location
 *
 * 
 * @apiSuccess {Number} status Response Status
 * @apiSuccess {Number} data.id Unique ID of Record
 * @apiSuccess {String} data.kendra_name Name of Kendra
 * @apiSuccess {String} data.permanent_address Permanent Address of Proposer Location 
 * @apiSuccess {String} data.temporary_address Temporary Address of Proposer Location 
 * @apiSuccess {Number} data.pin_code Last Name of Proposed Location
 * @apiSuccess {Number} data.state State of Proposed Location
 * @apiSuccess {Number} data.district District of Proposed Location
 * @apiSuccess {Number} data.block Block of Proposed Location
 * @apiSuccess {Number} data.leader Leader of Proposed Location
 * @apiSuccess {Number} data.leader_mobile Leader Mobile No of Proposed Location
 * @apiSuccess {String} data.leader_email Leader Email of Proposed Location
 * @apiSuccess {Number} data.deputy_leader Deputy Leader of Proposed Location
 * @apiSuccess {Number} data.deputy_leader_mobile Deputy Leader Mobile No of Proposed Location
 * @apiSuccess {String} data.deputy_leader_email Deputy Leader Email of Proposed Location
 * @apiSuccess {String} data.accounts Accounts of Managing Committee
 * @apiSuccess {String} data.procurement Procurement of Managing Committee
 * @apiSuccess {String} data.training Training of Managing Committee
 * @apiSuccess {String} data.value_addition Value addition of Managing Committee
 * @apiSuccess {String} data.marketing Marketing of Managing Committee
 * @apiSuccess {String} data.it It of Managing Committee
 * @apiSuccess {Number} data.bank_account_no bank_account_no of Proposed Location
 * @apiSuccess {String} data.ifsc_code ifsc_code of Proposed Location
 * @apiSuccess {String} data.additional_info additional_info of Proposed Location
 * @apiSuccess {Number} data.status Status of Proposed Location
 *
 * @apiSuccessExample Success-Response:
    HTTP/1.1 200 OK
   {
        "status": 1,
        "data": [
            {
                "id": 1,
                "kendra_name": "Kendra name",
                "permanent_address": "Permanent address",
                "temporary_address": "Temp Address",
                "pin_code": 232343,
                "state": 1,
                "district": 1,
                "block": 1,
                "leader": "1",
                "leader_mobile": 3456789012,
                "leader_email": "xnwi@gmail.com",
                "deputy_leader": "1",
                "deputy_leader_mobile": 3327764532,
                "deputy_leader_email": "cbwu@gmail.com",
                "accounts": "euhu1312111",
                "procurement": "dcdcd433",
                "training": "cdew4343",
                "value_addition": "dwefwe4434",
                "marketing": "deef4434",
                "it": "sdfefe454",
                "bank_account_no": 34234343432,
                "ifsc_code": "ICICI0000012",
                "additional_info": "ced343sdsa232432",
                "status": "1"
            }
        ]
    }
 * 
 */
/**
 * @api {post} proposed/proposed-location Create
 * @apiName ProposedLocationControllerCreate
 * @apiGroup Proposed Location
 *
 * 
 * @apiSuccess {Number} status Response Status
 * @apiSuccess {Number} data.id Unique ID of Record
 * @apiSuccess {String} data.kendra_name Name of Kendra
 * @apiSuccess {String} data.permanent_address Permanent Address of Proposer Location 
 * @apiSuccess {String} data.temporary_address Temporary Address of Proposer Location 
 * @apiSuccess {Number} data.pin_code Last Name of Proposed Location
 * @apiSuccess {Number} data.state State of Proposed Location
 * @apiSuccess {Number} data.district District of Proposed Location
 * @apiSuccess {Number} data.block Block of Proposed Location
 * @apiSuccess {Number} data.leader Leader of Proposed Location
 * @apiSuccess {Number} data.leader_mobile Leader Mobile No of Proposed Location
 * @apiSuccess {String} data.leader_email Leader Email of Proposed Location
 * @apiSuccess {Number} data.deputy_leader Deputy Leader of Proposed Location
 * @apiSuccess {Number} data.deputy_leader_mobile Deputy Leader Mobile No of Proposed Location
 * @apiSuccess {String} data.deputy_leader_email Deputy Leader Email of Proposed Location
 * @apiSuccess {String} data.accounts Accounts of Managing Committee
 * @apiSuccess {String} data.procurement Procurement of Managing Committee
 * @apiSuccess {String} data.training Training of Managing Committee
 * @apiSuccess {String} data.value_addition Value addition of Managing Committee
 * @apiSuccess {String} data.marketing Marketing of Managing Committee
 * @apiSuccess {String} data.it It of Managing Committee
 * @apiSuccess {Number} data.bank_account_no bank_account_no of Proposed Location
 * @apiSuccess {String} data.ifsc_code ifsc_code of Proposed Location
 * @apiSuccess {String} data.additional_info additional_info of Proposed Location
 * @apiSuccess {Number} data.status Status of Proposed Location
 *
 * @apiSuccessExample Success-Response:
    HTTP/1.1 200 OK
   {
        "status": 1,
        "data": {
            "id": 2,
            "kendra_name": "Kendra name",
            "permanent_address": "Permanent address",
            "temporary_address": "Temp Address",
            "pin_code": "232343",
            "state": "1",
            "district": "1",
            "block": "1",
            "leader": "1",
            "leader_mobile": "3456789012",
            "leader_email": "xnwi@gmail.com",
            "deputy_leader": "1",
            "deputy_leader_mobile": "3327764532",
            "deputy_leader_email": "cbwu@gmail.com",
            "accounts": "euhu1312111",
            "procurement": "dcdcd433",
            "training": "cdew4343",
            "value_addition": "dwefwe4434",
            "marketing": "deef4434",
            "it": "sdfefe454",
            "bank_account_no": "34234343432",
            "ifsc_code": "ICICI0000012",
            "additional_info": "ced343sdsa232432",
            "status": 1
        }
    }
 * 
 */
/**
 * @api {get} proposed/proposed-location/:id View One
 * @apiName ProposedLocationControllerViewOne
 * @apiGroup Proposed Location
 *
 * @apiParam (Parameters) {Number} id
 * 
 * @apiSuccess {Number} status Response Status
 * @apiSuccess {Number} data.id Unique ID of Record
 * @apiSuccess {String} data.kendra_name Name of Kendra
 * @apiSuccess {String} data.permanent_address Permanent Address of Proposer Location 
 * @apiSuccess {String} data.temporary_address Temporary Address of Proposer Location 
 * @apiSuccess {Number} data.pin_code Last Name of Proposed Location
 * @apiSuccess {Number} data.state State of Proposed Location
 * @apiSuccess {Number} data.district District of Proposed Location
 * @apiSuccess {Number} data.block Block of Proposed Location
 * @apiSuccess {Number} data.leader Leader of Proposed Location
 * @apiSuccess {Number} data.leader_mobile Leader Mobile No of Proposed Location
 * @apiSuccess {String} data.leader_email Leader Email of Proposed Location
 * @apiSuccess {Number} data.deputy_leader Deputy Leader of Proposed Location
 * @apiSuccess {Number} data.deputy_leader_mobile Deputy Leader Mobile No of Proposed Location
 * @apiSuccess {String} data.deputy_leader_email Deputy Leader Email of Proposed Location
 * @apiSuccess {String} data.accounts Accounts of Managing Committee
 * @apiSuccess {String} data.procurement Procurement of Managing Committee
 * @apiSuccess {String} data.training Training of Managing Committee
 * @apiSuccess {String} data.value_addition Value addition of Managing Committee
 * @apiSuccess {String} data.marketing Marketing of Managing Committee
 * @apiSuccess {String} data.it It of Managing Committee
 * @apiSuccess {Number} data.bank_account_no bank_account_no of Proposed Location
 * @apiSuccess {String} data.ifsc_code ifsc_code of Proposed Location
 * @apiSuccess {String} data.additional_info additional_info of Proposed Location
 * @apiSuccess {Number} data.status Status of Proposed Location
 *
 * @apiSuccessExample Success-Response:
    HTTP/1.1 200 OK
   {
        "status": 1,
        "data": {
            "id": 2,
            "kendra_name": "Kendra name",
            "permanent_address": "Permanent address",
            "temporary_address": "Temp Address",
            "pin_code": "232343",
            "state": "1",
            "district": "1",
            "block": "1",
            "leader": "1",
            "leader_mobile": "3456789012",
            "leader_email": "xnwi@gmail.com",
            "deputy_leader": "1",
            "deputy_leader_mobile": "3327764532",
            "deputy_leader_email": "cbwu@gmail.com",
            "accounts": "euhu1312111",
            "procurement": "dcdcd433",
            "training": "cdew4343",
            "value_addition": "dwefwe4434",
            "marketing": "deef4434",
            "it": "sdfefe454",
            "bank_account_no": "34234343432",
            "ifsc_code": "ICICI0000012",
            "additional_info": "ced343sdsa232432",
            "status": 1
        }
    }
 * 
 */ 

/**
 * @api {put} proposed/proposed-location/:id Update
 * @apiName ProposedLocationControllerUpdate
 * @apiGroup Proposed Location
 *
 * @apiParam (Parameters) id
 *
 { 
    kendra_name:Kendra name 2
    permanent_address:Permanent address
    temporary_address:Temp Address
    pin_code:232343
    state:1
    district:1
    block:1
    leader:1
    leader_mobile:3456789012
    leader_email:xnwi@gmail.com
    deputy_leader:1
    deputy_leader_mobile:3327764532
    deputy_leader_email:cbwu@gmail.com
    accounts:euhu1312111
    procurement:dcdcd433
    training:cdew4343
    value_addition:dwefwe4434
    marketing:deef4434
    it:sdfefe454
    bank_account_no:34234343432
    ifsc_code:ICICI0000012
    additional_info:ced343sdsa232432
    status:1
 } 
 * 
 * @apiSuccess {Number} status Response Status
 * @apiSuccess {Number} data.id Unique ID of Record
 * @apiSuccess {String} data.kendra_name Name of Kendra
 * @apiSuccess {String} data.permanent_address Permanent Address of Proposer Location 
 * @apiSuccess {String} data.temporary_address Temporary Address of Proposer Location 
 * @apiSuccess {Number} data.pin_code Last Name of Proposed Location
 * @apiSuccess {Number} data.state State of Proposed Location
 * @apiSuccess {Number} data.district District of Proposed Location
 * @apiSuccess {Number} data.block Block of Proposed Location
 * @apiSuccess {Number} data.leader Leader of Proposed Location
 * @apiSuccess {Number} data.leader_mobile Leader Mobile No of Proposed Location
 * @apiSuccess {String} data.leader_email Leader Email of Proposed Location
 * @apiSuccess {Number} data.deputy_leader Deputy Leader of Proposed Location
 * @apiSuccess {Number} data.deputy_leader_mobile Deputy Leader Mobile No of Proposed Location
 * @apiSuccess {String} data.deputy_leader_email Deputy Leader Email of Proposed Location
 * @apiSuccess {String} data.accounts Accounts of Managing Committee
 * @apiSuccess {String} data.procurement Procurement of Managing Committee
 * @apiSuccess {String} data.training Training of Managing Committee
 * @apiSuccess {String} data.value_addition Value addition of Managing Committee
 * @apiSuccess {String} data.marketing Marketing of Managing Committee
 * @apiSuccess {String} data.it It of Managing Committee
 * @apiSuccess {Number} data.bank_account_no bank_account_no of Proposed Location
 * @apiSuccess {String} data.ifsc_code ifsc_code of Proposed Location
 * @apiSuccess {String} data.additional_info additional_info of Proposed Location
 * @apiSuccess {Number} data.status Status of Proposed Location
 *
 * @apiSuccessExample Success-Response:
    HTTP/1.1 200 OK
   {
        "status": 1,
        "data": {
            "id": 2,
            "kendra_name": "Kendra name",
            "permanent_address": "Permanent address",
            "temporary_address": "Temp Address",
            "pin_code": "232343",
            "state": "1",
            "district": "1",
            "block": "1",
            "leader": "1",
            "leader_mobile": "3456789012",
            "leader_email": "xnwi@gmail.com",
            "deputy_leader": "1",
            "deputy_leader_mobile": "3327764532",
            "deputy_leader_email": "cbwu@gmail.com",
            "accounts": "euhu1312111",
            "procurement": "dcdcd433",
            "training": "cdew4343",
            "value_addition": "dwefwe4434",
            "marketing": "deef4434",
            "it": "sdfefe454",
            "bank_account_no": "34234343432",
            "ifsc_code": "ICICI0000012",
            "additional_info": "ced343sdsa232432",
            "status": 1
        }
    }
 * 
 */ 