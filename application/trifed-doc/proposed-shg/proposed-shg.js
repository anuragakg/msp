/**
 * @api {post} proposed/proposed-shg Create
 * @apiName Proposed-Shg-Create
 * @apiGroup Proposed Shg
 * @apiParam (Parameters) user_id User ID
   {
        "status": 1,
        "data": [
            {
                "shg_id": 1,
                "total_corpus": 1,
                "coordinating_agency_type": 1,
                "st_no": 1,
                "corpus_agreed": 1,
                "contact_name": "shubhangi",
                "contact_details": "891238972",
                "status": 1
            },
            {
                "shg_id": 2,
                "total_corpus": 1,
                "coordinating_agency_type": 1,
                "st_no": 1,
                "corpus_agreed": 1,
                "contact_name": "shubhangi",
                "contact_details": "891238972",
                "status": 1
            }
        ]
    }
 * @apiSuccess {Number} status Response Status
 * @apiSuccess {Number} data.shg_id shg id of Shg Group
 * @apiSuccess {Number} data.total_corpus Total Corpus of Proposed Shg
 * @apiSuccess {Number} data.coordinating_agency_type coordinating agency type of Proposed Shg
 * @apiSuccess {Number} data.st_no St Number of Proposed Shg
 * @apiSuccess {Number} data.corpus_agreed corpus agreed of Proposed Shg
 * @apiSuccess {String} data.contact_name State of Proposed Shg
 * @apiSuccess {Number} data.contact_details District of Proposed Shg
 * @apiSuccess {Number} data.status Status of Proposed Shg
 *
 * @apiSuccessExample Success-Response:
    HTTP/1.1 200 OK
   {
    "status": 1,
    "data": [
        {
            "shg_id": 1,
            "total_corpus": 1,
            "coordinating_agency_type": 1,
            "st_no": 1,
            "corpus_agreed": 1,
            "contact_name": "shubhangi",
            "contact_details": "891238972",
            "status": 1
        },
        {
            "shg_id": 2,
            "total_corpus": 1,
            "coordinating_agency_type": 1,
            "st_no": 1,
            "corpus_agreed": 1,
            "contact_name": "shubhangi",
            "contact_details": "891238972",
            "status": 1
        }
     ]
    }
 * 
 */ 
/**
 * @api {put} proposed/proposed-shg/:id Upate
 * @apiName Proposed-Shg-Update
 * @apiGroup Proposed Shg
 * @apiParam (Parameters) user_id User ID
   {
        "status": 1,
        "data": [
            {
                "shg_id": 1,
                "total_corpus": 1,
                "coordinating_agency_type": 1,
                "st_no": 1,
                "corpus_agreed": 1,
                "contact_name": "shubhangi",
                "contact_details": "891238972",
                "status": 1
            },
            {
                "shg_id": 2,
                "total_corpus": 1,
                "coordinating_agency_type": 1,
                "st_no": 1,
                "corpus_agreed": 1,
                "contact_name": "shubhangi",
                "contact_details": "891238972",
                "status": 1
            }
        ]
    }
 * @apiSuccess {Number} status Response Status
 * @apiSuccess {Number} data.shg_id shg id of Shg Group
 * @apiSuccess {Number} data.total_corpus Total Corpus of Proposed Shg
 * @apiSuccess {Number} data.coordinating_agency_type coordinating agency type of Proposed Shg
 * @apiSuccess {Number} data.st_no St Number of Proposed Shg
 * @apiSuccess {Number} data.corpus_agreed corpus agreed of Proposed Shg
 * @apiSuccess {String} data.contact_name State of Proposed Shg
 * @apiSuccess {Number} data.contact_details District of Proposed Shg
 * @apiSuccess {Number} data.status Status of Proposed Shg
 *
 * @apiSuccessExample Success-Response:
    HTTP/1.1 200 OK
   {
    "status": 1,
    "data": [
        {
            "shg_id": 1,
            "total_corpus": 1,
            "coordinating_agency_type": 1,
            "st_no": 1,
            "corpus_agreed": 1,
            "contact_name": "shubhangi",
            "contact_details": "891238972",
            "status": 1
        },
        {
            "shg_id": 2,
            "total_corpus": 1,
            "coordinating_agency_type": 1,
            "st_no": 1,
            "corpus_agreed": 1,
            "contact_name": "shubhangi",
            "contact_details": "891238972",
            "status": 1
        }
     ]
    }
 * 
 */  