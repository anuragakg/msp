/**
 * @api {POST} masters/permission-mapping Create
 * @apiName RolePermissionMapping
 * @apiGroup PermissionMapping Master
 *
 * @apiParam (Payload) {Int{..11}} role_id
 * @apiParam (Payload) {Int{..11}} permission_id
 *
 * @apiParamExample {json} Payload
 * {
 *     role_id : '1',
 *     permission_id : '5,6',
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
            "message": "Permission updated successfully"
        }
    }

    
 * 
 */

