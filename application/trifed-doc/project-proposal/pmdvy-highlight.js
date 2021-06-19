/**
 * @api {get} project-proposal/highlight/:id View One
 * @apiName ProjectProposalHighlightViewOne
 * @apiGroup Project Proposal Highlight
 *
 * @apiParam (Parameter) {Number} id Resource ID
 *
 * @apiSuccess {Number} status Response Status
 * @apiSuccess {Object} data  JSON object for specified master resource.
 * @apiSuccess {Number} data.id Unique ID of Record
 * @apiSuccess {String} data.activities Activities file link
 * @apiSuccess {String} data.office_bearer Office Bearer file link
 * @apiSuccess {String} data.establishment Establishment file link
 * @apiSuccess {String} data.equipment Equipment file link
 * @apiSuccess {String} data.training Training file link
 * @apiSuccess {String} data.inventory Inventory file link
 * @apiSuccess {String} data.operational_breakeven Operational Breakeven file link
 * @apiSuccess {String} data.business_plan Business Plan file link
 * @apiSuccess {Integer} data.retail_plan Retail Plan //0 or 1
 * @apiSuccess {String} data.retail_plan_file Retail Plan File file link
 * @apiSuccess {Integer} data.transport_plan Transport Plan //0 or 1
 * @apiSuccess {String} data.transport_plan_file Transport Plan file link
 *
 * @apiSuccessExample Success-Response:
    HTTP/1.1 200 OK
    {
        "status": 1,
        "data": {
        "id": 1,
        "activities": "PMDVY-Higlights/activities/prem.pdf",
        "office_bearer": "PMDVY-Higlights/office_bearer/prem.pdf",
        "establishment": "PMDVY-Higlights/establishment/prem.pdf",
        "equipment": "PMDVY-Higlights/equipment/prem.pdf",
        "training": "PMDVY-Higlights/training/prem.pdf",
        "inventory": "PMDVY-Higlights/inventory/prem.pdf",
        "operational_breakeven": "PMDVY-Higlights/operational_breakeven/prem.pdf",
        "business_plan": "PMDVY-Higlights/business_plan/prem.pdf",
        "retail_plan": "1",
        "retail_plan_file": "PMDVY-Higlights/retail_plan_file/prem.pdf",
        "transport_plan": "0",
        "transport_plan_file": "PMDVY-Higlights/transport_plan_file/prem.pdf"
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
 * @api {POST} project-proposal/highlight Create
 * @apiName ProjectProposalHighlightCreate
 * @apiGroup Project Proposal Highlight
 * @apiParam (Payload) {File} activities Activities
 * @apiParam (Payload) {File} office_bearer Office Bearer
 * @apiParam (Payload) {File} establishment Establishment
 * @apiParam (Payload) {File} equipment Equipment
 * @apiParam (Payload) {File} training Training
 * @apiParam (Payload) {File} inventory Inventory
 * @apiParam (Payload) {File} operational_breakeven Operational Breakeven
 * @apiParam (Payload) {File} business_plan Business Plan
 * @apiParam (Payload) {Integer{..11}} retail_plan Retail Plan //0 or 1
 * @apiParam (Payload) {File} retail_plan_file Retail Plan File
 * @apiParam (Payload) {Integer{..11}} transport_plan Transport Plan //0 or 1
 * @apiParam (Payload) {File} transport_plan_file Transport Plan File
 * @apiParamExample {json} Payload
 * {
 *     activities : 'File',
 *     office_bearer : 'File',
 *     establishment : 'File',
 *     equipment : 'File',
 *     training : 'File',
 *     inventory : 'File',
 *     operational_breakeven : 'File',
 *     business_plan : 'File',
 *     retail_plan : 0,
 *     retail_plan_file : 'File',
 *     transport_plan : 1,
 *     transport_plan_file : 'File'
 * }
 * 
* @apiSuccess {Number} status Response Status
 * @apiSuccess {Object} data  JSON object for specified master resource.
 * @apiSuccess {Number} data.id Unique ID of Record
 * @apiSuccess {String} data.activities Activities file link
 * @apiSuccess {String} data.office_bearer Office Bearer file link
 * @apiSuccess {String} data.establishment Establishment file link
 * @apiSuccess {String} data.equipment Equipment file link
 * @apiSuccess {String} data.training Training file link
 * @apiSuccess {String} data.inventory Inventory file link
 * @apiSuccess {String} data.operational_breakeven Operational Breakeven file link
 * @apiSuccess {String} data.business_plan Business Plan file link
 * @apiSuccess {Integer} data.retail_plan Retail Plan //0 or 1
 * @apiSuccess {String} data.retail_plan_file Retail Plan File file link
 * @apiSuccess {Integer} data.transport_plan Transport Plan //0 or 1
 * @apiSuccess {String} data.transport_plan_file Transport Plan file link
 * @apiSuccessExample Success-Response:
    HTTP/1.1 200 OK
    {
        "status": 1,
        "data": {
            "id": 1,
            "activities": "PMDVY-Higlights/activities/prem.pdf",
            "office_bearer": "PMDVY-Higlights/office_bearer/prem.pdf",
            "establishment": "PMDVY-Higlights/establishment/prem.pdf",
            "equipment": "PMDVY-Higlights/equipment/prem.pdf",
            "training": "PMDVY-Higlights/training/prem.pdf",
            "inventory": "PMDVY-Higlights/inventory/prem.pdf",
            "operational_breakeven": "PMDVY-Higlights/operational_breakeven/prem.pdf",
            "business_plan": "PMDVY-Higlights/business_plan/prem.pdf",
            "retail_plan": "1",
            "retail_plan_file": "PMDVY-Higlights/retail_plan_file/prem.pdf",
            "transport_plan": "0",
            "transport_plan_file": "PMDVY-Higlights/transport_plan_file/prem.pdf"
        }
    }

 * 
 */

/**
* @api {PUT} project-proposal/highlight/:id Update
* @apiName ProjectProposalHighlightUpdate
* @apiGroup Project Proposal Highlight
*  
* @apiParam (Parameter) {Number} id Resource ID
 * @apiParam (Payload) {File} activities Activities
 * @apiParam (Payload) {File} office_bearer Office Bearer
 * @apiParam (Payload) {File} establishment Establishment
 * @apiParam (Payload) {File} equipment Equipment
 * @apiParam (Payload) {File} training Training
 * @apiParam (Payload) {File} inventory Inventory
 * @apiParam (Payload) {File} operational_breakeven Operational Breakeven
 * @apiParam (Payload) {File} business_plan Business Plan
 * @apiParam (Payload) {Integer{..11}} retail_plan Retail Plan //0 or 1
 * @apiParam (Payload) {File} retail_plan_file Retail Plan File
 * @apiParam (Payload) {Integer{..11}} transport_plan Transport Plan //0 or 1
 * @apiParam (Payload) {File} transport_plan_file Transport Plan File
* @apiParamExample {json} Payload
* {
 *     activities : 'File',
 *     office_bearer : 'File',
 *     establishment : 'File',
 *     equipment : 'File',
 *     training : 'File',
 *     inventory : 'File',
 *     operational_breakeven : 'File',
 *     business_plan : 'File',
 *     retail_plan : 0,
 *     retail_plan_file : 'File',
 *     transport_plan : 1,
 *     transport_plan_file : 'File'
 * }
* 
* @apiSuccess {Number} status Response Status
 * @apiSuccess {Object} data  JSON object for specified master resource.
 * @apiSuccess {Number} data.id Unique ID of Record
 * @apiSuccess {String} data.activities Activities file link
 * @apiSuccess {String} data.office_bearer Office Bearer file link
 * @apiSuccess {String} data.establishment Establishment file link
 * @apiSuccess {String} data.equipment Equipment file link
 * @apiSuccess {String} data.training Training file link
 * @apiSuccess {String} data.inventory Inventory file link
 * @apiSuccess {String} data.operational_breakeven Operational Breakeven file link
 * @apiSuccess {String} data.business_plan Business Plan file link
 * @apiSuccess {Integer} data.retail_plan Retail Plan //0 or 1
 * @apiSuccess {String} data.retail_plan_file Retail Plan File file link
 * @apiSuccess {Integer} data.transport_plan Transport Plan //0 or 1
 * @apiSuccess {String} data.transport_plan_file Transport Plan file link
* @apiSuccessExample Success-Response:
   HTTP/1.1 200 OK
   {
        "status": 1,
        "data": {
            "id": 1,
            "activities": "PMDVY-Higlights/activities/prem.pdf",
            "office_bearer": "PMDVY-Higlights/office_bearer/prem.pdf",
            "establishment": "PMDVY-Higlights/establishment/prem.pdf",
            "equipment": "PMDVY-Higlights/equipment/prem.pdf",
            "training": "PMDVY-Higlights/training/prem.pdf",
            "inventory": "PMDVY-Higlights/inventory/prem.pdf",
            "operational_breakeven": "PMDVY-Higlights/operational_breakeven/prem.pdf",
            "business_plan": "PMDVY-Higlights/business_plan/prem.pdf",
            "retail_plan": "1",
            "retail_plan_file": "PMDVY-Higlights/retail_plan_file/prem.pdf",
            "transport_plan": "0",
            "transport_plan_file": "PMDVY-Higlights/transport_plan_file/prem.pdf"
        }
    }

   @apiError {Number} status Response Status
   @apiError {String} message Error Response Message specifiying the reason for failure.
   

   @apiErrorExample {JSON} Not Found
   HTTP/1.1 404 Not Found
   {
       "status": 0,
       "message": "Not found!"
   }
* 
*/

