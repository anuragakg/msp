/**
 * @api {POST} shg/part-two Create
 * @apiName ShgPartTwoCreate
 * @apiGroup SHG Part Two
 * @apiParam (Payload) {String} shg_id SHG Gatherer ID
 * @apiParam (Payload) {String} no_of_members No of Members
 * @apiParam (Payload) {String} latitude Latitude
 * @apiParam (Payload) {String} longitude Longitude
 * @apiParam (Payload) {Array} members Members object containing list of all household memebers.
 * @apiParam (Payload) {String} members.name Member Name.
 * @apiParam (Payload) {String} members.gender Member Gender.
 * @apiParam (Payload) {String} members.dob Member date of birth.
 * @apiParam (Payload) {String} members.age Member age.
 * @apiParam (Payload) {String} members.occupation Member Occupation.
 * @apiParam (Payload) {String} members.education Education of member.
 * @apiParam (Payload) {String} members.relationship_with_member Member Relation with the tribal name.
 * @apiParam (Payload) {String} members.is_gathering_mfp Is Member Gathering MFP.
 * @apiParam (Payload) {Array} members.yearly_usage Yearly Gathering of the tribal.
 * @apiParam (Payload) {String} members.commodity Commodity gathered by the tribal.
 * @apiParam (Payload) {String} members.quantity Quantity gathered by the tribal.
 * @apiParam (Payload) {Array} members.mfp_use MFP Use of the commodity.
 * @apiParamExample {json} Payload
 * 
 *{
     "shg_id": "1",
     "no_of_members": "2",
     "latitude": "11",
     "longitude": "33",
     "members": [{
             "name": "Son",
             "gender": "M",
             "dob": "2019/12/10",
             "age": "22",
             "occupation": "2",
             "education": "5",
             "relationship_with_member": "3",
             "is_gathering_mfp": "0"
         },
         {
             "name": "Mother",
             "gender": "F",
             "dob": "1966/01/01",
             "age": "53",
             "occupation": "4",
             "education": "4",
             "relationship_with_member": "4",
             "is_gathering_mfp": "0"
         }
     ],
     "yearly_usage": [{
             "commodity": "3",
             "quantity": "232",
             "mfp_use": ["1", "2"]
         },
         {
             "commodity": "1",
             "quantity": "87",
             "mfp_use": ["2", "3"]
         }
     ]
 }
 * @apiSuccess {Number} status Specifying the status response 
 * @apiSuccess {Object} data Data object containing the record/resource details.
 * @apiSuccess {Number} data.shg_id SHG Gatherer ID.
 * @apiSuccess {Number} data.no_of_members No of members
 * @apiSuccess {Number} data.latitude Latitude
 * @apiSuccess {Number} data.longitude Longitude
 * @apiSuccess {Array} data.members Array containing the records of all members.
 * @apiSuccess {Number} data.members.id Record Primary ID
 * @apiSuccess {String} data.members.name Name of the member.
 * @apiSuccess {String} data.members.gender Gender of the member.
 * @apiSuccess {Date} data.members.dob Date of birth of the member.
 * @apiSuccess {Number} data.members.age Age of the member.
 * @apiSuccess {Number} data.members.occupation Occupation of the member.
 * @apiSuccess {Number} data.members.education Education of the member.
 * @apiSuccess {Number} data.members.relationship_with_member Relationship with the member.
 * @apiSuccess {Number} data.members.is_gathering_mfp Is member gathering MFP.
 * @apiSuccess {Array} data.yearly_usage Array containing the records of Yearly Usage.
 * @apiSuccess {Number} data.yearly_usage.id Primary record id.
 * @apiSuccess {Number} data.yearly_usage.commodity Primary id coming from the master table.
 * @apiSuccess {Number} data.yearly_usage.quantity Quantity Gathered.
 * @apiSuccess {Array} data.yearly_usage.mfp_use Primary ids of the MFP use.
 * @apiSuccessExample Success-Response:
 * HTTP / 1.1 200 OK
 *{
     "status": 1,
     "data": {
         "shg_id": 1,
         "no_of_members": 2,
         "latitude": "11",
         "longitude": "33",
         "members": [{
                 "id": 5,
                 "name": "Son",
                 "gender": "M",
                 "dob": "2019-12-10",
                 "age": 22,
                 "occupation": 2,
                 "education": 5,
                 "relationship_with_member": 3,
                 "is_gathering_mfp": 0
             },
             {
                 "id": 6,
                 "name": "Mother",
                 "gender": "F",
                 "dob": "1966-01-01",
                 "age": 53,
                 "occupation": 4,
                 "education": 4,
                 "relationship_with_member": 4,
                 "is_gathering_mfp": 0
             }
         ],
         "yearly_usage": [{
                 "id": 5,
                 "commodity": 3,
                 "quantity": 232,
                 "mfp_use": ["1", "2"]
             },
             {
                 "id": 6,
                 "commodity": 1,
                 "quantity": 87,
                 "mfp_use": ["2", "3"]
             }
         ]
     }
 }
 * 
 */


/**
 * @api {GET} shg/part-two/:id View One
 * @apiName ShgPartTwoViewOne
 * @apiGroup SHG Part Two
 * 
 * @apiParam (Parameter) {String} id SHG Gatherer ID
 * 
 * @apiSuccess {Number} status Specifying the status response 
 * @apiSuccess {Object} data Data object containing the record/resource details.
 * @apiSuccess {Number} data.shg_id SHG Gatherer ID.
 * @apiSuccess {Number} data.no_of_members No of members
 * @apiSuccess {Number} data.latitude Latitude
 * @apiSuccess {Number} data.longitude Longitude
 * @apiSuccess {Array} data.members Array containing the records of all members.
 * @apiSuccess {Number} data.members.id Record Primary ID
 * @apiSuccess {String} data.members.name Name of the member.
 * @apiSuccess {String} data.members.gender Gender of the member.
 * @apiSuccess {Date} data.members.dob Date of birth of the member.
 * @apiSuccess {Number} data.members.age Age of the member.
 * @apiSuccess {Number} data.members.occupation Occupation of the member.
 * @apiSuccess {Number} data.members.education Education of the member.
 * @apiSuccess {Number} data.members.relationship_with_member Relationship with the member.
 * @apiSuccess {Number} data.members.is_gathering_mfp Is member gathering MFP.
 * @apiSuccess {Array} data.yearly_usage Array containing the records of Yearly Usage.
 * @apiSuccess {Number} data.yearly_usage.id Primary record id.
 * @apiSuccess {Number} data.yearly_usage.commodity Primary id coming from the master table.
 * @apiSuccess {Number} data.yearly_usage.quantity Quantity Gathered.
 * @apiSuccess {Number} data.yearly_usage.mfp_use Primary id coming from the master table.
 * @apiSuccessExample Success-Response:
 * HTTP / 1.1 200 OK
 *{
     "status": 1,
     "data": {
         "shg_id": 1,
         "no_of_members": 2,
         "latitude": "11",
         "longitude": "33",
         "members": [{
                 "id": 5,
                 "name": "Son",
                 "gender": "M",
                 "dob": "2019-12-10",
                 "age": 22,
                 "occupation": 2,
                 "education": 5,
                 "relationship_with_member": 3,
                 "is_gathering_mfp": 0
             },
             {
                 "id": 6,
                 "name": "Mother",
                 "gender": "F",
                 "dob": "1966-01-01",
                 "age": 53,
                 "occupation": 4,
                 "education": 4,
                 "relationship_with_member": 4,
                 "is_gathering_mfp": 0
             }
         ],
         "yearly_usage": [{
                 "id": 5,
                 "commodity": 3,
                 "quantity": 232,
                 "mfp_use": ["1", "2"]
             },
             {
                 "id": 6,
                 "commodity": 1,
                 "quantity": 87,
                 "mfp_use": ["2", "3"]
             }
         ]
     }
 }
 * 
 */