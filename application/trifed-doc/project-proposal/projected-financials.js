/**
 * @api {get} project-proposal/financial/:id View One
 * @apiName ProjectProposalFinancialViewOne
 * @apiGroup Project Proposal Financial
 *
 * @apiParam (Parameter) {Number} id Resource ID
 *
 * @apiSuccess {Number} status Response Status
 * @apiSuccess {Object} data  JSON object for specified master resource.
 * @apiSuccess {Number} data.id Unique ID of Record
 * @apiSuccess {String} data.cashflow Cashflow file link
 * @apiSuccess {String} data.p_and_l P&L file link
 * @apiSuccess {String} data.balance_sheet Balance Sheet file link
 *
 * @apiSuccessExample Success-Response:
    HTTP/1.1 200 OK
    {
        "status": 1,
        "data": {
            "id": 1,
            "cashflow": "Projected-Financials/Cashflow/prem.pdf",
            "p_and_l": "Projected-Financials/PL/prem2.pdf",
            "balance_sheet": "Projected-Financials/Balance-Sheet/TRIFED_SRSDocument_V_1.1.pdf"
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
 * @api {POST} project-proposal/financial Create
 * @apiName ProjectProposalFinancialCreate
 * @apiGroup Project Proposal Financial
 * @apiParam (Payload) {File} cashflow
 * @apiParam (Payload) {File} p_and_l
 * @apiParam (Payload) {File} balance_sheet
 * @apiParamExample {json} Payload
 * {
 *     cashflow : 'File',
 *     p_and_l : 'File',
 *     balance_sheet : 'File'
 * }
 * 
 * @apiSuccess {Number} status Response Status
 * @apiSuccess {Object} data  JSON object for specified master resource.
 * @apiSuccess {String} data.cashflow Cashflow file link
 * @apiSuccess {String} data.p_and_l P&L file link
 * @apiSuccess {String} data.balance_sheet Balance Sheet file link
 * @apiSuccessExample Success-Response:
    HTTP/1.1 200 OK
    {
        "status": 1,
        "data": {
            "id": 1,
            "cashflow": "Projected-Financials/Cashflow/prem.pdf",
            "p_and_l": "Projected-Financials/PL/prem2.pdf",
            "balance_sheet": "Projected-Financials/Balance-Sheet/TRIFED_SRSDocument_V_1.1.pdf"
        }
    }

 * 
 */

/**
* @api {PUT} project-proposal/financial/:id Update
* @apiName ProjectProposalFinancialUpdate
* @apiGroup Project Proposal Financial
*  
* @apiParam (Parameter) {Number} id Resource ID
 * @apiParam (Payload) {File} cashflow
 * @apiParam (Payload) {File} p_and_l
 * @apiParam (Payload) {File} balance_sheet
* @apiParamExample {json} Payload
 * {
 *     cashflow : 'File',
 *     p_and_l : 'File',
 *     balance_sheet : 'File'
 * }
* 
* @apiSuccess {Number} status Response Status
* @apiSuccess {Object} data  JSON object for specified master resource.
* @apiSuccess {String} data.cashflow Cashflow file link
* @apiSuccess {String} data.p_and_l P&L file link
* @apiSuccess {String} data.balance_sheet Balance Sheet file link
* @apiSuccessExample Success-Response:
   HTTP/1.1 200 OK
   {
        "status": 1,
        "data": {
            "id": 1,
            "cashflow": "Projected-Financials/Cashflow/prem.pdf",
            "p_and_l": "Projected-Financials/PL/prem2.pdf",
            "balance_sheet": "Projected-Financials/Balance-Sheet/TRIFED_SRSDocument_V_1.1.pdf"
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

