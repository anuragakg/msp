/**
 * @api {POST} haat-market/part-three Create
 * @apiName HaatMarketPartThreeCreate
 * @apiGroup Haat Market Part Three
 * 
 * @apiParam (Payload) {Integer{..1}} office Office radio 0=No,1=Yes
 * @apiParam (Payload) {Integer{..1}} drinking_water Drinking Water  radio 0=No,1=Yes
 * @apiParam (Payload) {Integer{..1}} notice_board Notice Board  radio 0=No,1=Yes
 * @apiParam (Payload) {Integer{..1}} urinal_toilet Urinal Toilet  radio 0=No,1=Yes
 * @apiParam (Payload) {Integer{..1}} electricity Electricity  radio 0=No,1=Yes
 * @apiParam (Payload) {Integer{..1}} garbage_system Garbage System radio 0=No,1=Yes
 * @apiParam (Payload) {Integer{..1}} parking Parking  radio 0=No,1=Yes
 * @apiParam (Payload) {Integer{..1}} input_sundry Input sundry  radio 0=No,1=Yes
 * @apiParam (Payload) {Integer{..1}} hygienic Hygenic radio 0=No,1=Yes
 * @apiParam (Payload) {Integer{..1}} bank Bank radio 0=No,1=Yes

 * @apiParam (Payload) {String{..20}} bank_name Bank Name 
 * @apiParam (Payload) {Integer{..1}} post_office Post Office 0=No,1=Yes
 * @apiParam (Payload) {String{..20}} post_office_name Post Office Name
 * @apiParam (Payload) {Integer{..1}} assaying_lab Assaying Lab 0=No,1=Yes
 * @apiParam (Payload) {String{..20}} assaying_lab_remarks Assaying Lab Remarks
 * @apiParam (Payload) {Integer{..1}} packaging Packaging 0=No,1=Yes
 * @apiParam (Payload) {String{..20}} packaging_remarks Packaging Remarks
 * @apiParam (Payload) {Integer{..1}} drying_yards Drying Yards 0=No,1=Yes
 * @apiParam (Payload) {String{..20}} drying_yards_remarks Drying Yards Remarks
 * @apiParam (Payload) {Integer{..1}} bagging Bagging 0=No,1=Yes
 * @apiParam (Payload) {String{..20}} bagging_remarks Bagging Remarks
 * @apiParam (Payload) {Integer{..1}} loading Loading 0=No,1=Yes
 * @apiParam (Payload) {String{..20}} loading_remarks Loading Remarks
 * @apiParam (Payload) {Integer{..1}} conditioning Conditioning 0=No,1=Yes
 * @apiParam (Payload) {String{..20}} conditioning_remarks Conditioning Remarks
 * @apiParam (Payload) {Integer{..1}} pack_house Pack House 0=No,1=Yes
 * @apiParam (Payload) {String{..20}} pack_house_remarks Pack House Remarks
 * @apiParam (Payload) {Integer{..1}} storage_capacity Storage Capacity 0=No,1=Yes
 * @apiParam (Payload) {String{..20}} storage_capacity_remarks Storage Capacity Remarks
 * @apiParam (Payload) {Integer{..1}} standardisation Standardisation 0=No,1=Yes
 * @apiParam (Payload) {Integer{..1}} primary_processing Primary Processing 0=No,1=Yes
 * @apiParam (Payload) {String{..20}} primary_processing_remarks Primary Processing Remarks
 * @apiParam (Payload) {Integer{..1}} info_display Info Display 0=No,1=Yes
 * @apiParam (Payload) {String{..20}} info_display_remarks Info Display Remarks
 * @apiParam (Payload) {Integer{..1}} it_infra It Infra 0=No,1=Yes
 * @apiParam (Payload) {String{..20}} it_infra_remarks IT Infra Remarks
 * @apiParam (Payload) {Integer{..1}} storage Storage 0=No,1=Yes
 * @apiParam (Payload) {String{..20}} storage_remarks Storage Remarks
 * @apiParam (Payload) {Integer{..1}} public_address Public Address 0=No,1=Yes
 * @apiParam (Payload) {String{..20}} public_address_remarks Public Address Remarks
 * @apiParam (Payload) {Integer{..1}} extension Extension 0=No,1=Yes
 * @apiParam (Payload) {String{..20}} extension_remarks Extension Remarks
 * @apiParam (Payload) {Integer{..1}} boarding_lodging Boarding Lodging 0=No,1=Yes
 * @apiParam (Payload) {Integer{..11}} part_one_id Part One Form Id


 * @apiParamExample {json} Payload
 * {
        "id": 2,
        "office": "1",
        "drinking_water": "1",
        "notice_board": "1",
        "urinal_toilet": "1",
        "electricity": "1",
        "garbage_system": "1",
        "parking": "1",
        "input_sundry": "1",
        "hygienic": "1",
        "bank": "1",
        "bank_name": "Test",
        "post_office": "1",
        "post_office_name": "Test",
        "assaying_lab": "1",
        "assaying_lab_remarks": "Test",
        "packaging": "1",
        "packaging_remarks": "Test",
        "drying_yards": "1",
        "drying_yards_remarks": "Test",
        "bagging": "1",
        "bagging_remarks": "Test",
        "loading": "1",
        "loading_remarks": "Test",
        "conditioning": "1",
        "conditioning_remarks": "Test",
        "pack_house": "1",
        "pack_house_remarks": "Test",
        "storage_capacity": "1",
        "storage_capacity_remarks": "Test",
        "standardisation": "1",
        "primary_processing": "1",
        "primary_processing_remarks": "Test",
        "info_display": "1",
        "info_display_remarks": "Test",
        "it_infra": "0",
        "it_infra_remarks": "Test",
        "storage": "1",
        "storage_remarks": "Test",
        "public_address": "1",
        "public_address_remarks": "Test",
        "extension": "1",
        "extension_remarks": "Test",
        "boarding_lodging": "1",
        "part_one_id": "1"
 *   }

 * @apiSuccess {Number} status Response Status
 * @apiSuccess {Object} data  JSON object for specified master resource.
 * @apiSuccess {Number} data.id Unique ID of Record
 * @apiSuccess {Number} data.office office
 * @apiSuccess {Number} data.drinking_water Drinking Water
 * @apiSuccess {Number} data.notice_board Notice Board
 * @apiSuccess {Number} data.urinal_toilet Urinal Toilet
 * @apiSuccess {Number} data.electricity Electricity
 * @apiSuccess {Number} data.garbage_system Garbage System
 * @apiSuccess {Number} data.parking Parking
 * @apiSuccess {Number} data.input_sundry Input Sundry
 * @apiSuccess {Number} data.hygienic Hygienic
 * @apiSuccess {Number} data.bank Bank
 * @apiSuccess {String} data.bank_name Bank Name
 * @apiSuccess {Number} data.post_office Post Office
 * @apiSuccess {String} data.post_office_name Post Office Name
 * @apiSuccess {Number} data.assaying_lab Assaying Lab
 * @apiSuccess {String} data.assaying_lab_remarks Assaying Lab Remarks
 * @apiSuccess {Number} data.packaging Packaging
 * @apiSuccess {String} data.packaging_remarks Packaging Remarks 
 * @apiSuccess {Number} data.drying_yards Drying Yards
 * @apiSuccess {String} data.drying_yards_remarks Drying Yards Remarks
 * @apiSuccess {Number} data.bagging Bagging
 * @apiSuccess {String} data.bagging_remarks Bagging Remarks
 * @apiSuccess {Number} data.loading Loading
 * @apiSuccess {String} data.loading_remarks Loading Remarks
 * @apiSuccess {Number} data.conditioning Conditioning
 * @apiSuccess {String} data.conditioning_remarks Conditioning Remarks
 * @apiSuccess {Number} data.pack_house Pack House
 * @apiSuccess {String} data.pack_house_remarks Pack House Remarks
 * @apiSuccess {Number} data.storage_capacity Storage Capacity
 * @apiSuccess {String} data.storage_capacity_remarks Storage Capacity Remarks
 * @apiSuccess {Number} data.standardisation Standardisation
 * @apiSuccess {Number} data.primary_processing Primary Processing
 * @apiSuccess {String} data.primary_processing_remarks Primary Processing Remarks
 * @apiSuccess {Number} data.info_display Info Display
 * @apiSuccess {String} data.info_display_remarks Info Display Remarks
 * @apiSuccess {Number} data.it_infra IT Infra 
 * @apiSuccess {String} data.it_infra_remarks IT Infra Remarks
 * @apiSuccess {Number} data.storage Storage
 * @apiSuccess {String} data.storage_remarks Storage Remarks
 * @apiSuccess {Number} data.public_address Public Address
 * @apiSuccess {String} data.public_address_remarks Public Address Remarks
 * @apiSuccess {Number} data.extension Extension
 * @apiSuccess {String} data.extension_remarks Extension Remarks
 * @apiSuccess {Number} data.boarding_lodging Boarding Lodging 
 * @apiSuccess {String} data.created_by Created By
 * @apiSuccess {String} data.updated_by Updated By
 * @apiSuccessExample Success-Response:
    HTTP/1.1 200 OK
    {
    "status": 1,
    "data": {
        "id": 2,
        "office": "1",
        "drinking_water": "1",
        "notice_board": "1",
        "urinal_toilet": "1",
        "electricity": "1",
        "garbage_system": "1",
        "parking": "1",
        "input_sundry": "1",
        "hygienic": "1",
        "bank": "1",
        "bank_name": "Test",
        "post_office": "1",
        "post_office_name": "Test",
        "assaying_lab": "1",
        "assaying_lab_remarks": "Test",
        "packaging": "1",
        "packaging_remarks": "Test",
        "drying_yards": "1",
        "drying_yards_remarks": "Test",
        "bagging": "1",
        "bagging_remarks": "Test",
        "loading": "1",
        "loading_remarks": "Test",
        "conditioning": "1",
        "conditioning_remarks": "Test",
        "pack_house": "1",
        "pack_house_remarks": "Test",
        "storage_capacity": "1",
        "storage_capacity_remarks": "Test",
        "standardisation": "1",
        "primary_processing": "1",
        "primary_processing_remarks": "Test",
        "info_display": "1",
        "info_display_remarks": "Test",
        "it_infra": "0",
        "it_infra_remarks": "Test",
        "storage": "1",
        "storage_remarks": "Test",
        "public_address": "1",
        "public_address_remarks": "Test",
        "extension": "1",
        "extension_remarks": "Test",
        "boarding_lodging": "1",
        "created_by": 0,
        "updated_by": 0
    }
}
 * 
 */

/**
 * @api {PUT} haat-market/part-three/:id Update
 * @apiName HaatMarketPartthreeUpdate
 * @apiGroup Haat Market Part Three
 * @apiParam (Parameters) {Number} id Resource ID
 * 
 * @apiParam (Payload) {Integer{..1}} office Office radio 0=No,1=Yes
 * @apiParam (Payload) {Integer{..1}} drinking_water Drinking Water  radio 0=No,1=Yes
 * @apiParam (Payload) {Integer{..1}} notice_board Notice Board  radio 0=No,1=Yes
 * @apiParam (Payload) {Integer{..1}} urinal_toilet Urinal Toilet  radio 0=No,1=Yes
 * @apiParam (Payload) {Integer{..1}} electricity Electricity  radio 0=No,1=Yes
 * @apiParam (Payload) {Integer{..1}} garbage_system Garbage System radio 0=No,1=Yes
 * @apiParam (Payload) {Integer{..1}} parking Parking  radio 0=No,1=Yes
 * @apiParam (Payload) {Integer{..1}} input_sundry Input sundry  radio 0=No,1=Yes
 * @apiParam (Payload) {Integer{..1}} hygienic Hygenic radio 0=No,1=Yes
 * @apiParam (Payload) {Integer{..1}} bank Bank radio 0=No,1=Yes

 * @apiParam (Payload) {String{..20}} bank_name Bank Name 
 * @apiParam (Payload) {Integer{..1}} post_office Post Office 0=No,1=Yes
 * @apiParam (Payload) {String{..20}} post_office_name Post Office Name
 * @apiParam (Payload) {Integer{..1}} assaying_lab Assaying Lab 0=No,1=Yes
 * @apiParam (Payload) {String{..20}} assaying_lab_remarks Assaying Lab Remarks
 * @apiParam (Payload) {Integer{..1}} packaging Packaging 0=No,1=Yes
 * @apiParam (Payload) {String{..20}} packaging_remarks Packaging Remarks
 * @apiParam (Payload) {Integer{..1}} drying_yards Drying Yards 0=No,1=Yes
 * @apiParam (Payload) {String{..20}} drying_yards_remarks Drying Yards Remarks
 * @apiParam (Payload) {Integer{..1}} bagging Bagging 0=No,1=Yes
 * @apiParam (Payload) {String{..20}} bagging_remarks Bagging Remarks
 * @apiParam (Payload) {Integer{..1}} loading Loading 0=No,1=Yes
 * @apiParam (Payload) {String{..20}} loading_remarks Loading Remarks
 * @apiParam (Payload) {Integer{..1}} conditioning Conditioning 0=No,1=Yes
 * @apiParam (Payload) {String{..20}} conditioning_remarks Conditioning Remarks
 * @apiParam (Payload) {Integer{..1}} pack_house Pack House 0=No,1=Yes
 * @apiParam (Payload) {String{..20}} pack_house_remarks Pack House Remarks
 * @apiParam (Payload) {Integer{..1}} storage_capacity Storage Capacity 0=No,1=Yes
 * @apiParam (Payload) {String{..20}} storage_capacity_remarks Storage Capacity Remarks
 * @apiParam (Payload) {Integer{..1}} standardisation Standardisation 0=No,1=Yes
 * @apiParam (Payload) {Integer{..1}} primary_processing Primary Processing 0=No,1=Yes
 * @apiParam (Payload) {String{..20}} primary_processing_remarks Primary Processing Remarks
 * @apiParam (Payload) {Integer{..1}} info_display Info Display 0=No,1=Yes
 * @apiParam (Payload) {String{..20}} info_display_remarks Info Display Remarks
 * @apiParam (Payload) {Integer{..1}} it_infra It Infra 0=No,1=Yes
 * @apiParam (Payload) {String{..20}} it_infra_remarks IT Infra Remarks
 * @apiParam (Payload) {Integer{..1}} storage Storage 0=No,1=Yes
 * @apiParam (Payload) {String{..20}} storage_remarks Storage Remarks
 * @apiParam (Payload) {Integer{..1}} public_address Public Address 0=No,1=Yes
 * @apiParam (Payload) {String{..20}} public_address_remarks Public Address Remarks
 * @apiParam (Payload) {Integer{..1}} extension Extension 0=No,1=Yes
 * @apiParam (Payload) {String{..20}} extension_remarks Extension Remarks
 * @apiParam (Payload) {Integer{..1}} boarding_lodging Boarding Lodging 0=No,1=Yes
 * @apiParamExample {json} Payload
  * {
        "office": "1",
        "drinking_water": "1",
        "notice_board": "1",
        "urinal_toilet": "1",
        "electricity": "1",
        "garbage_system": "1",
        "parking": "1",
        "input_sundry": "1",
        "hygienic": "1",
        "bank": "1",
        "bank_name": "Test",
        "post_office": "1",
        "post_office_name": "Test",
        "assaying_lab": "1",
        "assaying_lab_remarks": "Test",
        "packaging": "1",
        "packaging_remarks": "Test",
        "drying_yards": "1",
        "drying_yards_remarks": "Test",
        "bagging": "1",
        "bagging_remarks": "Test",
        "loading": "1",
        "loading_remarks": "Test",
        "conditioning": "1",
        "conditioning_remarks": "Test",
        "pack_house": "1",
        "pack_house_remarks": "Test",
        "storage_capacity": "1",
        "storage_capacity_remarks": "Test",
        "standardisation": "1",
        "primary_processing": "1",
        "primary_processing_remarks": "Test",
        "info_display": "1",
        "info_display_remarks": "Test",
        "it_infra": "0",
        "it_infra_remarks": "Test",
        "storage": "1",
        "storage_remarks": "Test",
        "public_address": "1",
        "public_address_remarks": "Test",
        "extension": "1",
        "extension_remarks": "Test",
        "boarding_lodging": "1"
 *   }

 * @apiSuccess {Number} status Response Status
 * @apiSuccess {Object} data  JSON object for specified master resource.
 * @apiSuccess {Number} data.id Unique ID of Record
 * @apiSuccess {Number} data.office office
 * @apiSuccess {Number} data.drinking_water Drinking Water
 * @apiSuccess {Number} data.notice_board Notice Board
 * @apiSuccess {Number} data.urinal_toilet Urinal Toilet
 * @apiSuccess {Number} data.electricity Electricity
 * @apiSuccess {Number} data.garbage_system Garbage System
 * @apiSuccess {Number} data.parking Parking
 * @apiSuccess {Number} data.input_sundry Input Sundry
 * @apiSuccess {Number} data.hygienic Hygienic
 * @apiSuccess {Number} data.bank Bank
 * @apiSuccess {String} data.bank_name Bank Name
 * @apiSuccess {Number} data.post_office Post Office
 * @apiSuccess {String} data.post_office_name Post Office Name
 * @apiSuccess {Number} data.assaying_lab Assaying Lab
 * @apiSuccess {String} data.assaying_lab_remarks Assaying Lab Remarks
 * @apiSuccess {Number} data.packaging Packaging
 * @apiSuccess {String} data.packaging_remarks Packaging Remarks 
 * @apiSuccess {Number} data.drying_yards Drying Yards
 * @apiSuccess {String} data.drying_yards_remarks Drying Yards Remarks
 * @apiSuccess {Number} data.bagging Bagging
 * @apiSuccess {String} data.bagging_remarks Bagging Remarks
 * @apiSuccess {Number} data.loading Loading
 * @apiSuccess {String} data.loading_remarks Loading Remarks
 * @apiSuccess {Number} data.conditioning Conditioning
 * @apiSuccess {String} data.conditioning_remarks Conditioning Remarks
 * @apiSuccess {Number} data.pack_house Pack House
 * @apiSuccess {String} data.pack_house_remarks Pack House Remarks
 * @apiSuccess {Number} data.storage_capacity Storage Capacity
 * @apiSuccess {String} data.storage_capacity_remarks Storage Capacity Remarks
 * @apiSuccess {Number} data.standardisation Standardisation
 * @apiSuccess {Number} data.primary_processing Primary Processing
 * @apiSuccess {String} data.primary_processing_remarks Primary Processing Remarks
 * @apiSuccess {Number} data.info_display Info Display
 * @apiSuccess {String} data.info_display_remarks Info Display Remarks
 * @apiSuccess {Number} data.it_infra IT Infra 
 * @apiSuccess {String} data.it_infra_remarks IT Infra Remarks
 * @apiSuccess {Number} data.storage Storage
 * @apiSuccess {String} data.storage_remarks Storage Remarks
 * @apiSuccess {Number} data.public_address Public Address
 * @apiSuccess {String} data.public_address_remarks Public Address Remarks
 * @apiSuccess {Number} data.extension Extension
 * @apiSuccess {String} data.extension_remarks Extension Remarks
 * @apiSuccess {Number} data.boarding_lodging Boarding Lodging 
 * @apiSuccess {String} data.created_by Created By
 * @apiSuccess {String} data.updated_by Updated By
 * @apiSuccessExample Success-Response:
    HTTP/1.1 200 OK
      {
    "status": 1,
    "data": {
        "id": 2,
        "office": "1",
        "drinking_water": "1",
        "notice_board": "1",
        "urinal_toilet": "1",
        "electricity": "1",
        "garbage_system": "1",
        "parking": "1",
        "input_sundry": "1",
        "hygienic": "1",
        "bank": "1",
        "bank_name": "Test",
        "post_office": "1",
        "post_office_name": "Test",
        "assaying_lab": "1",
        "assaying_lab_remarks": "Test",
        "packaging": "1",
        "packaging_remarks": "Test",
        "drying_yards": "1",
        "drying_yards_remarks": "Test",
        "bagging": "1",
        "bagging_remarks": "Test",
        "loading": "1",
        "loading_remarks": "Test",
        "conditioning": "1",
        "conditioning_remarks": "Test",
        "pack_house": "1",
        "pack_house_remarks": "Test",
        "storage_capacity": "1",
        "storage_capacity_remarks": "Test",
        "standardisation": "1",
        "primary_processing": "1",
        "primary_processing_remarks": "Test",
        "info_display": "1",
        "info_display_remarks": "Test",
        "it_infra": "0",
        "it_infra_remarks": "Test",
        "storage": "1",
        "storage_remarks": "Test",
        "public_address": "1",
        "public_address_remarks": "Test",
        "extension": "1",
        "extension_remarks": "Test",
        "boarding_lodging": "1",
        "created_by": 0,
        "updated_by": 0
    }
}

    @apiError (ERROR 4xx) {Number} status Response Status
    @apiError (Invalid Resource Id) {Number} message Error Response Message specifiying the reason for failure.
    @apiErrorExample {JSON} Invalid Resource Id
    HTTP/1.1 404 Not Found
    {
        "status": 0,
        "message": "Not found!"
    }


    }
 * 
 */

 