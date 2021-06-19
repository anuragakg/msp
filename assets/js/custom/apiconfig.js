const endpoint = 'http://127.0.0.1:8000/api/v1/';  

var conf = {

    'generatePassword': {
        'url': endpoint + 'generate-password',
        'method': 'POST',
    },

    'forgotPassword': {
        'url': endpoint + 'forgot-password',
        'method': 'POST',
    },

    'resetPassword': {
        'url': endpoint + 'reset-password',
        'method': 'POST',
    },
    'getLocCategories':{
        'url': endpoint + 'masters/location-category',
        'method': 'GET',
    },

    
    'login': {
        'url': endpoint + 'login',
        'method': 'POST',
    },

    'logout': {
        'url': endpoint + 'logout',
        'method': 'GET',
    },

    'changePassword': {
        'url': endpoint + 'change-password',
        'method': 'POST',
    },

    'getData': {
        'url': endpoint + 'getdata',
        'method': 'GET',
    },

    /* Get all masters */ 

    'getMasterData':{
        'url':endpoint + 'masters/data/',
        'method':'GET',
    },

    /* ID Proof */ 

    'addIdProof': {
        'url': endpoint + 'masters/id-proof',
        'method': 'POST',
    },

    'getIdProofList': {
        'url': endpoint + 'masters/id-proof',
        'method': 'GET',
    },
    'getIdProofData':{
        'url':endpoint + 'masters/id-proof/',
        'method':'GET',
    },

    'updateIdProofData':{
        'url':endpoint + 'masters/id-proof/',
        'method':'PUT',
    },
    'toggleIdProofStatus' : {
        url : function (id) {
            return endpoint + 'masters/id-proof/' + id + '/status';
        },
        'method' : 'POST'
    },
    'getTribalDetailFromIdProof': {
        'url': endpoint + 'proposal/getTribalDetailFromIdProof',
        'method': 'POST',
    },
    'getTribalDetailFromName': {
        'url': endpoint + 'proposal/getTribalDetailFromName',
        'method': 'POST',
    },
    
    'getProcurementAgentProposals' : {
        url : function (id) {
            return endpoint + 'proposal/getProcurementAgentProposals/' + id ;
        },
        'method' : 'POST'
    },
    'getProcurementAgentProposalsMfp': {
        url : function (id) {
            return endpoint + 'proposal/getProcurementAgentProposalsMfp/' + id;
        },
        'method' : 'GET'
    },
    'addMfpProcurementActualDetail': {
        'url': endpoint + 'proposal/mfp-procurement-actual-detail',
        'method' : 'POST'
    },
    'getMfpProcurementActualDetail': {
        'url': endpoint + 'proposal/mfp-procurement-actual-detail',
        'method' : 'GET'
    },
    'getMfpProcurementActualDetailView': {
        url : function (id) {
            return endpoint + 'proposal/mfp-procurement-actual-detail/' + id;
        },
        'method' : 'GET'
    },
    /* Year */ 

    'addYear': {
        'url': endpoint + 'masters/year',
        'method': 'POST',
    },
    
    'getYearList':{
        'url':endpoint + 'masters/year',
        'method':'GET',
    },

    'getYearData':{
        'url':endpoint + 'masters/year/',
        'method':'GET',
    },

    'updateYearData':{
        'url':endpoint + 'masters/year',
        'method':'PUT',
    },
    'toggleYearStatus' : {
        url : function (id) {
            return endpoint + 'masters/year/' + id + '/status';
        },
        'method' : 'POST'
    },

    /* Financial Year */ 

    'addFinancialYear': {
        'url': endpoint + 'masters/financial-year',
        'method': 'POST',
    },
    
    'getFinancialYearList':{
        'url':endpoint + 'masters/financial-year',
        'method':'GET',
    },

    'getFinancialYearData':{
        'url':endpoint + 'masters/financial-year/',
        'method':'GET',
    },

    'updateFinancialYearData':{
        'url':endpoint + 'masters/financial-year',
        'method':'PUT',
    },
    'toggleFinancialYearStatus' : {
        url : function (id) {
            return endpoint + 'masters/financial-year/' + id + '/status';
        },
        'method' : 'POST'
    },

    /* Designation */ 

    'addDesignation': {
        'url': endpoint + 'masters/designation',
        'method': 'POST',
    },

    'getDesignationList':{
        'url':endpoint + 'masters/designation',
        'method':'GET',
    },

    'getDesignationData':{
        'url':endpoint + 'masters/designation/',
        'method':'GET',
    },
    'updateDesignationData':{
        'url':endpoint + 'masters/designation/',
        'method':'PUT',
    },
    'toggleDesignationStatus' : {
        url : function (id) {
            return endpoint + 'masters/designation/' + id + '/status';
        },
        'method' : 'POST'
    },




    /* Department */ 

    'addDepartment': {
        'url': endpoint + 'masters/department',
        'method': 'POST',
    },

    'getDepartmentList':{
        'url':endpoint+'masters/department',
        'method':'GET',
    },

    'getDepartmentData': {
        'url': endpoint + 'masters/department/',
        'method': 'GET',
    },

    'updateDepartmentData': {
        'url': endpoint + 'masters/department/',
        'method': 'PUT',
    },

    'toggleDepartmentStatus' : {
        url : function (id) {
            return endpoint + 'masters/department/' + id + '/status';
        },
        'method' : 'POST'
    },

    

    /* Category */ 

    'addCategory': {
        'url': endpoint + 'masters/category',
        'method': 'POST',
    },

    'getCategoryList':{
        'url':endpoint + 'masters/category',
        'method':'GET'
    },

    'getCategoryData':{
        'url':endpoint + 'masters/category/',
        'method':'GET',
    },

    'updateCategoryData':{
        'url':endpoint + 'masters/category/',
        'method':'PUT'
    },

    'toggleCategoryStatus' : {
        url : function (id) {
            return endpoint + 'masters/category/' + id + '/status';
        },
        'method' : 'POST'
    },

    /* MFP Use */ 

    'addMfpUse': {
        'url': endpoint + 'masters/mfp-use',
        'method': 'POST',
    },

    'getMfpUse':{
        'url':endpoint + 'masters/mfp-use',
        'method':'GET'
    },

    'getMfpUse':{
        'url':endpoint + 'masters/mfp-use/',
        'method':'GET',
    },

    'updateMfpUse':{
        'url':endpoint + 'masters/mfp-use/',
        'method':'PUT'
    },

    'toggleMfpUseStatus' : {
        url : function (id) {
            return endpoint + 'masters/mfp-use/' + id + '/status';
        },
        'method' : 'POST'
    },

    

    'getUserStateWiseList':{
        'url':endpoint + 'user/userManagementlist',
        'method':'GET'
    },

    

    'getCommodityData':{
        'url':endpoint + 'masters/commodity/',
        'method':'GET',
    },

    'updateCommodityData':{
        'url':endpoint + 'masters/commodity/',
        'method':'PUT'
    },

    'toggleCommodityStatus' : {
        url : function (id) {
            return endpoint + 'masters/commodity/' + id + '/status';
        },
        'method' : 'POST'
    },
    'getCommodityStateWiseList':{
        'url':endpoint + 'masters/commoditystate',
        'method':'GET'
    },
    
    


   




    /* States*/ 

    'getStates': {
        'url': endpoint + 'masters/state',
        'method': 'GET',
    },

    /* Districts */ 

    'getDistricts': {
        'url': endpoint + 'masters/district',
        'method': 'GET',
    },
    /*Haats*/
    'getHaats': {
        'url': endpoint + 'masters/',
        'method': 'GET',
    },

    /* Blocks */ 

    'getBlocks': {
        'url': endpoint + 'masters/block',
        'method': 'GET',
    },
    'getBlockByDistrict': {
        url : function (id) {
            return endpoint + 'masters/block_by_district/'+id;
        },
        'method': 'GET',
    },
    
    'addRole': {
        'url': endpoint + 'masters/role',
        'method': 'POST',
    }, 
    'getRole': {
        'url': endpoint + 'masters/user-role',
        'method': 'GET',
    },
    'getRolesListing': {
        'url': endpoint + 'masters/role-listing',
        'method': 'GET',
    },
    'toggleRoleStatus' : {
        url : function (id) {
            return endpoint + 'masters/role/' + id + '/status';
        },
        'method' : 'POST'
    },
    'viewRole': {
        url : function (id) {
            return endpoint + 'masters/role/' + id ;
        },
        'method' : 'GET'

    },
    'updateRole': {
        url : function (id) {
            return endpoint + 'masters/role/' + id ;
        },
        'method' : 'PUT'

    },
   
    'getUserManagementRole': {
        'url': endpoint + 'masters/user-management-role',
        'method': 'GET',
    },

    'getUser': {
        'url': endpoint + 'user',
        'method': 'GET',
    },

    'getCurrentUserHaatInfo': {
        'url': endpoint + 'getCurrentUserHaatInfo',
        'method': 'GET',
    },

    

    'addUser': {
        'url': endpoint + 'user',
        'method': 'POST',
    }, 
    'changeUserStatus': {
        'url': function (user_id) {
            return endpoint + 'user/status/' + user_id; 
        },
        'method': 'PUT',
    },  
    /** User Bank Details */ 

    'getUserBankDetails': {
        'url': function (user_id) {
            return endpoint + 'bank-details/' + user_id; 
        },
        'method': 'GET',
    },
   
    'updateUser': {
        'url': endpoint + 'user',
        'method': 'PUT',
    },

    

     /* Village */ 

     'addVillage': {
        'url': endpoint + 'masters/village',
        'method': 'POST',
    },

    'getVillageList':{
        'url':endpoint + 'masters/village',
        'method':'GET',
    },
  
    'exportVillageData':{
        'url':endpoint + 'masters/villageExport/export',
        'method':'GET',
    },

    'importExcelVillage':{
        'url':endpoint + 'masters/village/importExcel',
        'method':'POST',
    },

    'getVillageData':{
        'url':endpoint + 'masters/village/',
        'method':'GET',
    },

    'updateVillageData':{
        'url':endpoint + 'masters/village/',
        'method':'PUT'
    },
    'toggleVillageStatus' : {
        url : function (id) {
            return endpoint + 'masters/village/' + id + '/status';
        },
        'method' : 'POST'
    },
    
    
    

    /* States */ 

    'addState': {
        'url': endpoint + 'masters/state',
        'method': 'POST',
    },
 
    'getStateList':{
        'url':endpoint + 'masters/state',
        'method':'GET',
    },
 
    'getStateData':{
        'url':endpoint + 'masters/state/',
        'method':'GET',
    },
 
    'updateStateData':{
        'url':endpoint + 'masters/state/',
        'method':'PUT'
    },
    'toggleStateStatus' : {
        url : function (id) {
            return endpoint + 'masters/state/' + id + '/status';
        },
        'method' : 'POST'
    },

    /* District */ 

    'addDistrict': {
        'url': endpoint + 'masters/district',
        'method': 'POST',
    },
 
    'getDistrictList':{
        'url':endpoint + 'masters/location',
        'method':'GET',
    },
 
    'getDistrictData':{
        'url':endpoint + 'masters/district/',
        'method':'GET',
    },
 
    'updateDistrictData':{
        'url':endpoint + 'masters/district/',
        'method':'PUT'
    },
    'toggleDistrictStatus' : {
        url : function (id) {
            return endpoint + 'masters/district/' + id + '/status';
        },
        'method' : 'POST'
    },
 
    // 'getStateList':{
    //     'url':endpoint + 'masters/state/',
    //     'method':'PUT'
    // },
    'getStateListing':{
        'url':endpoint + 'masters/state/',
        'method':'PUT'
    },

    /* Block */ 

    'getBlockMaster':{
        'url':endpoint + 'masters/block-location/',
        'method':'GET'
    },
    'addBlock': {
        'url': endpoint + 'masters/block',
        'method': 'POST',
    },
    'getBlockData':{
        'url':endpoint + 'masters/block/',
        'method':'GET',
    },
    'getBlockWithStateData':{
        'url':endpoint + 'masters/block-location/',
        'method':'GET',
    },
    'updateBlockData':{
        'url':endpoint + 'masters/block/',
        'method':'PUT'
    },
    'toggleBlockStatus' : {
        url : function (id) {
            return endpoint + 'masters/block/' + id + '/status';
        },
        'method' : 'POST'
    },

    


    /* Level */ 

    'addLevel': {
        'url': endpoint + 'masters/level',
        'method': 'POST',
    },
 
    'getLevelList':{
        'url':endpoint + 'masters/level',
        'method':'GET',
    },
 
    'getLevelData':{
        'url':endpoint + 'masters/level/',
        'method':'GET',
    },
 
    'updateLevelData':{
        'url':endpoint + 'masters/level/',
        'method':'PUT'
    },
    'getLevel':{
        'url': function (level_id) {
            return endpoint + 'masters/level/' + level_id; 
        },
        'method': 'GET',
    },
    'getHaatMarket' : {
        url : function (id) {
            return endpoint + 'haat-market/get-all/'+id;
        },
       'method': 'GET',
   },
    'getBankList':{
        'url':endpoint + 'masters/bank',
        'method':'GET',
    },

    'importUserExcel':{
        'url':endpoint + 'user/importExcel',
        'method':'POST'
    },

     'getPermissionList':{
        'url':endpoint + 'masters/permission',
        'method':'GET',
    },
    'getRolesList': {
        'url': endpoint + 'masters/role',
        'method': 'GET',
    },

    /**** Packing Master **/
    'getPackingList': {
        'url': endpoint + 'masters/packing-listing',
        'method': 'GET',
    },
    'addPackingMaster': {
        'url': endpoint + 'masters/packing',
        'method': 'POST',
    }, 
    'viewPackingMaster': {
        url : function (id) {
            return endpoint + 'masters/packing/' + id ;
        },
        'method' : 'GET'

    },
    'updatePackingMaster': {
        url : function (id) {
            return endpoint + 'masters/packing/' + id ;
        },
        'method' : 'PUT'
    },
    'togglePackingStatus' : {
        url : function (id) {
            return endpoint + 'masters/packing/' + id + '/status';
        },
        'method' : 'POST'
    },
   
    /**Haat Details Master  */
    'addHaatBazaarMaster':{
        'url': endpoint + 'masters/haat-bazaar-details',
        'method': 'POST',
    },
    'getHaatMasterList':{
        'url': endpoint + 'masters/haat-bazaar-details',
        'method': 'GET',
    },
     /* Item Master */
    'addHaatItem': {
        'url': endpoint + 'masters/haat-bazaar-items',
        'method': 'POST',
    },
    'updateHaatItem': { 
         url : function (id) {
            return endpoint + 'masters/haat-bazaar-items/' + id ;
        },
        'method' : 'PUT'
    },

    'viewHaatItem': {
        url : function (id) {
            return endpoint + 'masters/haat-bazaar-items/' + id ;
        },
        'method' : 'GET'
    },
    'viewHaatMaster': {
        url : function (id) {
            return endpoint + 'masters/haat-bazaar-details/' + id ;
        },
        'method' : 'GET'

    }, 
    'getHaatBazaarItem': {
        'url': endpoint + 'masters/haat-bazaar-items-list',
        'method': 'GET',
    },
    'getHaatBazaarItemList': {
        'url': endpoint + 'masters/haat-bazaar-items',
        'method': 'GET',
    },
    'deleteHaatItemData':{
        'url':endpoint + 'masters/haat-bazaar-items/',
        'method':'DELETE'
    },
   'addWarehouseItem': {
        'url': endpoint + 'masters/warehouse-items',
        'method': 'POST',
    },
    'updateWarehouseItem': { 
         url : function (id) {
            return endpoint + 'masters/warehouse-items/' + id ;
        },
        'method' : 'PUT'
    },
    'viewWarehouseItem': {
        url : function (id) {
            return endpoint + 'masters/warehouse-items/' + id ;
        },
        'method' : 'GET'

    },
    'getWarehouseItem': {
        'url': endpoint + 'masters/warehouse-items-list',
        'method': 'GET',
    },
    'getWarehouseItemList': {
        'url': endpoint + 'masters/warehouse-items',
        'method': 'GET',
    },
    'deleteWarehouseItemData':{
        'url':endpoint + 'masters/warehouse-items/',
        'method':'DELETE'
    },
    'addMultipurposeProcurementItem': {
        'url': endpoint + 'masters/multipurpose-procurement-items',
        'method': 'POST',
    },
    'deleteMultipurposeItemData':{
        'url':endpoint + 'masters/multipurpose-procurement-items/',
        'method':'DELETE'
    },
    'updateMultipurposeProcurementItem': { 
         url : function (id) {
            return endpoint + 'masters/multipurpose-procurement-items/' + id ;
        },
        'method' : 'PUT'
    },
    'viewMultipurposeProcurementItem': {
        url : function (id) {
            return endpoint + 'masters/multipurpose-procurement-items/' + id ;
        },
        'method' : 'GET'

    },
    'getMultipurposeProcurementItem': {
        'url': endpoint + 'masters/multipurpose-procurement-items-list',
        'method': 'GET',
    }, 
    'updateHaatBazaarMaster': {
        url : function (id) {
            return endpoint + 'masters/haat-bazaar-details/' + id ;
        },
        'method' : 'PUT'
    },
    'toggleHaatMasterStatus' : {
        url : function (id) {
            return endpoint + 'masters/haat-bazaar-details/' + id + '/status';
        },
        'method' : 'POST'
    },
    
     
    /**** Role Mapping routes**/
    'getRolesMapping': {
        'url': function (id) {
            return endpoint + 'masters/permission-mapping/' + id; 
        },
        'method': 'GET',
    },
    'addRolesMapping' : {
        'url': endpoint + 'masters/permission-mapping',
        'method': 'POST'
    },
    'addUsersPermissionMapping' : {
        'url': endpoint + 'users/add-permission-mapping',
        'method': 'POST'
    },
    'getUserPermissionMapping': {
        'url': function (id) {
            return endpoint + 'users/permission-mapping/' + id; 
        },
        'method': 'GET',
    },
    
    /*User Profile*/
    'getUserProfile':{
        'url': endpoint + 'get-profile',
        'method': 'GET'
    },
    'updateUserProfile' : {
        'url': endpoint + 'update-profile',
        'method': 'PUT'
    },
    

    'getNotification':{
        'url':endpoint + 'notification/',
        'method':'GET',
    },

    'markNotificationRead':{
        url : function (id) {
            return (
              endpoint + "notification/" + id
            );
        },
        'method':'PUT',
    },

    'MarkAllNotificationRead':{
        'url':endpoint + 'notification/mark-all-read/',
        'method':'GET',
    },

    'getNotificationCount':{
        'url':endpoint + 'notification/count/',
        'method':'GET',
    },
    
    'getUserActivityLog': {
        'url': endpoint + 'users/user-activity-log',
        'method': 'GET',
    },
	/*
		*Add MFP Master
	*/
    'addMfp': {
        'url': endpoint + 'masters/mfp',
        'method': 'POST',
    },
    'updateMfp': {
        url : function (id) {
            return endpoint + 'masters/mfp/' + id ;
        },
        'method': 'PUT',
    },
    'getMfp': {
        'url': endpoint + 'masters/mfp',
        'method': 'GET',
    },
    'getMfpLogs': {
        'url': endpoint + 'masters/mfp_logs',
        'method': 'GET',
    },
    'getMfpFormDetail': {
        url : function (id) {
            return endpoint + 'masters/mfp/' + id ;
        },
        'method': 'GET',
    },
    'changeMfpMasterStatus' : {
        url : function (id) {
            return endpoint + 'masters/mfp/' + id + '/status';
        },
        'method' : 'POST'
    },

    /*
		*Add Warehouse Master
	*/
	'getWarehouseHaatmarket': {
        'url': endpoint + 'masters/warehouse-haatbazaar',
        'method': 'GET',
    },
	'addWarehouseMaster':{
		'url': endpoint + 'masters/warehouse-master',
        'method': 'POST',
	},
	'getWarehouse':{
		'url': endpoint + 'masters/warehouse-master',
        'method': 'GET',
	},
	'getWarehouseFormDetail': {
        url : function (id) {
            return endpoint + 'masters/warehouse-master/' + id ;
        },
        'method': 'GET',
    },
	'changeWarehouseMasterStatus' : {
        url : function (id) {
            return endpoint + 'masters/warehouse-master/' + id + '/status';
        },
        'method' : 'POST'
    },
	/*Warehouse Master End*/
	'toggleHaatItemStatus' : {
        url : function (id) {
            return endpoint + 'masters/haat-bazaar-items/' + id + '/status';
        },
        'method' : 'POST'
    },
    'toggleWarehouseItemStatus' : {
        url : function (id) {
            return endpoint + 'masters/warehouse-items/' + id + '/status';
        },
        'method' : 'POST'
    },
    'toggleMultipurposeItemStatus' : {
        url : function (id) {
            return endpoint + 'masters/multipurpose-procurement-items/' + id + '/status';
        },
        'method' : 'POST'
    },
    'checkBagName': {
        'url': endpoint + 'masters/packing/check_name',
        'method': 'POST',
    }, 
    
    /*******Commission Master */

    'commissionRoleList': {
        'url': endpoint + 'masters/get-commission-master-role',
        'method': 'GET',
    }, 
    'addCommissionMaster':{
        'url': endpoint + 'masters/commission-master',
        'method': 'POST',
    },
    'getCommissionMasterList':{
        'url': endpoint + 'masters/commission-master',
        'method': 'GET',
    },
     
    'viewCommissionMaster': {
        url : function (id) {
            return endpoint + 'masters/commission-master/' + id ;
        },
        'method' : 'GET'

    }, 
    'updateCommissionMaster': {
        url : function (id) {
            return endpoint + 'masters/commission-master/' + id ;
        },
        'method' : 'PUT'
    },
    'toggleCommissionMasterStatus' : {
        url : function (id) {
            return endpoint + 'masters/commission-master/' + id + '/status';
        },
        'method' : 'POST'
    },
    'checkUniqueCommission':{
      
        'url':endpoint + 'masters/check-unique-commission-master',
        'method' : 'POST'
    },
    /** Scrutiny Level Management */
    'getScrutinyManagementList':{
        'url':endpoint + 'masters/scrutiny-management',
        'method':'GET',
    },
    // 'getScrutinyRole': {
    //     'url': endpoint + 'masters/scrutiny-role',
    //     'method': 'GET',
    // },
    'addScrutiny': {
        'url': endpoint + 'masters/scrutiny-management',
        'method': 'POST',
    },
    'updateScrutiny': {
        url : function (id) {
            return endpoint + 'masters/scrutiny-management/' + id ;
        },
       
        'method': 'PUT',
    },
    'editViewScrutiny':{
        'url': function (state_id) {
            return endpoint + 'masters/scrutiny-management/' + state_id; 
        },
        'method': 'GET',
    },

    'commissionListStatewise':{
        url : function (id) {
            return endpoint + 'masters/commission-list-state-wise/'+id; 
        },
        'method' : 'GET'
    },
  
    /*Add Mfp Procurement Form*/        
    'mfpProcurementListing':{
        'url': endpoint + 'proposal/mfp-procurement',
        'method': 'GET',
    },
    'addMfpProcurementPartOne':{
        'url': endpoint + 'proposal/mfp-procurement',
        'method': 'POST',
    },
    'getProcurementPartOne':{
        url : function (id) {
            return endpoint + 'proposal/mfp-procurement/'+id; 
        },
        'method': 'GET',
    }, 
    'getProcurementDetail':{
        url : function (id) {
            return endpoint + 'proposal/mfp-procurement-detail/'+id; 
        },
        'method': 'GET',
    }, 
    'deleteMfpCoverageBlockHaat':{
        'url':endpoint + 'proposal/delete-mfp-coverage-block-haat', 
        'method': 'POST',
    },
    'deleteCommodityHaat':{
        'url':endpoint + 'proposal/delete-commodity-haat', 
        'method': 'POST',
    },
    'deleteMfpCoverage':{
        'url':endpoint + 'proposal/delete-mfp-coverage', 
        'method': 'POST',
    },
    'deleteSeasonality':{
        'url':endpoint + 'proposal/delete-seasonality', 
        'method': 'POST',
    },
    'addMfpProcurementPartTwo':{
        'url': endpoint + 'proposal/mfp-procurement-plan',
        'method': 'POST',
    },
    'getMfpProcurementPartTwo':{ 
        url : function (id) {
            return endpoint + 'proposal/mfp-procurement-plan/'+id; 
        },
        'method': 'GET',
    }, 
    'getSeasionalityQuarterWise':{
        url : function (id) {
            return endpoint + 'proposal/mfp-seasonalibity-quarterwise/'+id; 
        },
        'method': 'GET',
    }, 

    'getMfpStep1':{
        url : function (id) {
            return endpoint + 'proposal/get-mfp-step1/'+id; 
        },
        'method': 'GET',
    },
    'addMfpProcurementPartThree':{
        'url': endpoint + 'proposal/mfp-procurement-disposal',
        'method': 'POST',
    }, 
    'addMfpProcurementPartFour':{
        'url': endpoint + 'proposal/mfp-procurement-summary',
        'method': 'POST',
    }, 
    'addDiaReleaseFundToProcurementAgent':{
        'url': endpoint + 'proposal/add-mfpprocurement-releasefund-procurementagent',
        'method': 'POST',
    }, 
    'fundReceivedProcurementAgent': {
        'url': endpoint + 'proposal/mfp-procurement-procurementagent-fundreceived-list',
        'method': 'GET',
    },
    'fundReceivedProcurementAgentDetail':{ 
        'url': endpoint + 'proposal/mfp-procurement-procurementagent-fundreceived-details',
        'method': 'GET',
    },
    'getMfpProcurementAgentReleasedetail':{ 
        url : function (id) {
            return endpoint + 'proposal/get-mfp-procurement-agent-release-detail/'+id; 
        },
        'method': 'GET',
    },
    'getProcurementAgentMfpList':{ 
        url : function (id) {
            return endpoint + 'proposal/get-mfp-procurement-agent-mfp-list/'+id; 
        },
        'method': 'GET',
    },
    'getPackingMaterial': {
        'url': endpoint + 'masters/packing',
        'method': 'GET',
    },

    'getMfpProcurementCommodity':{ 
        url : function (id) {
            return endpoint + 'proposal/get-seasonality-commodity/'+id; 
        },
        'method': 'GET',
    },
    'getMfpProcurementSeasonalityDetails':{ 
        url : function (id) {
            return endpoint + 'proposal/get-seasonality-commodity-details/'+id; 
        },
        'method': 'GET',
    },
    'getProcurementAgentList':{
        'url': endpoint + 'proposal/get-procurement-agent-list',
        'method': 'GET',
    },
    'approveMfpProcurement':{
        'url': endpoint + 'proposal/approve-mfp-procurement',
        'method': 'POST',
    }, 
    'revertMfpProcurement':{
        'url': endpoint + 'proposal/revert-mfp-procurement',
        'method': 'POST',
    }, 
    'rejectMfpProcurement':{
        'url': endpoint + 'proposal/reject-mfp-procurement',
        'method': 'POST',
    }, 
    'send_mfpprocurement_to_nextlevel':{
        'url': endpoint + 'proposal/send_mfpprocurement_to_nextlevel',
        'method': 'POST',
    }, 
    'consolidate_mfpprocurement':{
        'url': endpoint + 'proposal/consolidate_mfpprocurement',
        'method': 'POST',
    }, 
    'getConsolidatedProposals':{
        'url': endpoint + 'proposal/getConsolidatedProposals',
        'method': 'get',
    }, 
    'consolidate_references':{
        'url': endpoint + 'proposal/consolidate_references',
        'method': 'POST',
    },
    'send_consolidated_to_next_level':{
        'url': endpoint + 'proposal/send_consolidated_to_next_level',
        'method': 'POST',
    }, 

    /*========================*/    	
    'getMfpProcurementPlanDetail':{
        url : function (id) {
            return endpoint + 'proposal/mfp-procurement-plan-detail/'+id; 
        },
        'method': 'GET',
    }, 
    'getCostOfPackagingMaterial':{ 
        url : function (id) {
            return endpoint + 'proposal/get-cost-of-packaging-material/'+id; 
        },
        'method': 'GET',
    },
   
    'getEstimatedValueOfProcurement':{
        url : function (id,mfp_id) {
            return endpoint + 'proposal/get-estimated-value-of-procurement/'+id+'/'+mfp_id; 
        },
        'method': 'GET',    
    },
    'getProcurementQtyValue':{
        url : function (id,mfp_id) {
            return endpoint + 'proposal/get-procurement-qty-value/'+id+'/'+mfp_id; 
        },
        'method': 'GET',    
    },


    'addInfrastructurePartOne':{
        'url': endpoint + 'infrastructure/infrastructure-development',
        'method': 'POST',
    },
    'addInfrastructurePartTwo':{
        'url': endpoint + 'infrastructure/infrastructure-development-two',
        'method': 'POST',
    },
     'getInfrastructurePartOne':{
        url : function (id) {
            return endpoint + 'infrastructure/infrastructure-development/'+id; 
        },
        'method': 'GET',
    },  
    'getEstimatedProcurementOfMFP':{
        url : function (id) {
            return endpoint + 'proposal/get-estimated-procurement/'+id; 
        },
        'method': 'GET',    
    },
    'getEstimatedQuarterlyRequirement':{
        url : function (id) {
            return endpoint + 'proposal/get-estimated-quarterly-requirement-for-summary/'+id; 
        },
        'method': 'GET',

    },
    'mfpProcurementProposalListing':{
        'url': endpoint + 'proposal/mfp-procurement-listing',
        'method': 'GET',
    },
    'mfpProcurementRecommendedListing':{
        'url': endpoint + 'proposal/mfp-procurement-recommended-listing',
        'method': 'GET',
    },
    'mfpProcurementApprovedListing':{
        'url': endpoint + 'proposal/mfp-procurement-approved-listing',
        'method': 'GET',
    },
    'InfrastructuredevelopmentListing':{
        'url': endpoint + 'infrastructure/infrastructure-development',
        'method': 'GET',
    },
    'getInfrastructureDetail':{
        url : function (id) {
            return endpoint + 'infrastructure/infrastructure-development-detail/'+id; 
        },
        'method': 'GET',
    },
    'addInfrastructureSummary':{
        'url': endpoint + 'infrastructure/infrastructure-summary',
        'method': 'POST',
    },
    'getAllProposalIds':{
        'url' : endpoint + 'proposal/get-all-proposal',
        'method': 'GET',
    },
    'getConsolidatedDetail':{
        url : function (id) {
            return endpoint + 'proposal/get-consolidated-proposal-detail/'+id; 
        },
        'method': 'GET',
    },
  

    'InfrastructuredevelopmentProposalListing':{
        'url': endpoint + 'infrastructure/infrastructure-development-listing',
        'method': 'GET', 
    },

    'approveInfrastructure':{
        'url': endpoint + 'infrastructure/approve-infrastructure',
        'method': 'POST',
    }, 
    'revertInfrastructure':{
        'url': endpoint + 'infrastructure/revert-infrastructure',
        'method': 'POST',
    }, 
    'rejectInfrastructure':{
        'url': endpoint + 'infrastructure/reject-infrastructure',
        'method': 'POST',
    },  
    'send_infrastructure_to_nextlevel':{
        'url': endpoint + 'infrastructure/send_infrastructure_to_nextlevel',
        'method': 'POST',
    }, 
    'consolidate_infrastructure':{
        'url': endpoint + 'infrastructure/consolidate_infrastructure',
        'method': 'POST',
    }, 


    'approveConsolidatedMfpProcurement':{
        'url': endpoint + 'proposal/approve-consolidated-mfp-procurement',
        'method': 'POST',
    }, 
    'revertConsolidatedMfpProcurement':{
        'url': endpoint + 'proposal/revert-consolidated-mfp-procurement',
        'method': 'POST',
    }, 
    'rejectConsolidatedMfpProcurement':{
        'url': endpoint + 'proposal/reject-consolidated-mfp-procurement',
        'method': 'POST',
    }, 
    'ProcurementMfpListing':{
        url : function (id) {
            return endpoint + 'proposal/get-procurement-mfp-listing/'+id; 
        },
      
        'method': 'GET',
    },
    'procurementStatusLogs':{
        url : function (id) {
            return endpoint + 'proposal/mfp-procurement-status-logs/'+id; 
        },
      
        'method': 'GET',
    },
    'mfpProcurementRevertedListing':{
        'url': endpoint + 'proposal/mfp-procurement-reverted',
        'method': 'GET',
    },
    'mfpProcurementRejectedListing':{
        'url': endpoint + 'proposal/mfp-procurement-rejected',
        'method': 'GET',
    },
    'getProcurementCountsStatusWise':{
        'url': endpoint + 'proposal/mfp-procurement-counts-status-wise',
        'method': 'GET',
    },


    'getUserPermissionMappingRole': {
        'url': function (id) {
            return endpoint + 'users/permission-mapping-role/' + id; 
        },
        'method': 'GET',
    },
    'InfrastructureProposalSubmittedListing':{
        'url': endpoint + 'infrastructure/infrastructure-development-submitted',
        'method': 'GET',
    },
    'addMfpProcurement':{
        'url': endpoint + 'proposal/add-mfp-for-procurement',
        'method': 'POST',
    },

    'getInfraConsolidatedProposals':{
        'url': endpoint + 'infrastructure/getConsolidatedProposals',
        'method': 'get',
    }, 

     'Infraconsolidate_references':{
        'url': endpoint + 'infrastructure/consolidate_references',
        'method': 'POST',
    },
    'InfrastructureRecommendedListing':{
        'url': endpoint + 'infrastructure/infrastructure-recommended-listing',
        'method': 'GET',
    },
    'InfrastructureRevertedListing':{
        'url': endpoint + 'infrastructure/infrastructure-reverted',
        'method': 'GET',
    },
    'InfrastructureRejectedListing':{
        'url': endpoint + 'infrastructure/infrastructure-rejected',
        'method': 'GET',
    },
    'InfrastructureStatusLogs':{
        url : function (id) {
            return endpoint + 'infrastructure/infrastructure-status-logs/'+id; 
        },      
        'method': 'GET',
    },
    'getInfraConsolidatedDetail':{
        url : function (id) {
            return endpoint + 'infrastructure/get-consolidated-proposal-detail/'+id; 
        },
        'method': 'GET',
    },

    'approveConsolidatedInfrastructure':{
        'url': endpoint + 'infrastructure/approve-consolidated-infrastructure',
        'method': 'POST',
    }, 
    'revertConsolidatedInfrastructure':{
        'url': endpoint + 'infrastructure/revert-consolidated-infrastructure',
        'method': 'POST',
    }, 
    'rejectConsolidatedInfrastructure':{
        'url': endpoint + 'infrastructure/reject-consolidated-infrastructure',
        'method': 'POST',
    }, 

     'sendInfra_consolidated_to_next_level':{
        'url': endpoint + 'infrastructure/send_consolidated_to_next_level',
        'method': 'POST',
    }, 
    'getProcurementCenter':{
        'url': endpoint + 'masters/procurement-center',
        'method': 'GET',   
    },
    'mfpDetails':{
        'url': endpoint + 'proposal/get-last-5years-mfp-details',
        'method': 'GET',
    },
    'getApprovedConsolidatedProposals':{
        'url': endpoint + 'proposal/getApprovedConsolidatedProposals',
        'method': 'GET',
    },
    'getSanctionDetails':{
        url : function (id) {
            return endpoint + 'proposal/getSanctionDetails/'+id; 
        },
        'method': 'GET',
    },
    'addSanctionLetter':{
        'url' :  endpoint + 'proposal/sanctionLetter',
        'method': 'POST',
    },
    'addSanctionLetterState':{
        'url' :  endpoint + 'proposal/sanctionLetterstate',
        'method': 'POST',
    },
    'getSanctionedList':{
        'url' :  endpoint + 'proposal/sanctionLetter',
        'method': 'GET',
    },
     'getInfraApprovedConsolidatedProposals':{
        'url': endpoint + 'infrastructure/getInfraApprovedConsolidatedProposals',
        'method': 'GET',
    },
    'getInfraSanctionDetails':{
        url : function (id) {
            return endpoint + 'infrastructure/getInfraSanctionDetails/'+id; 
        },
        'method': 'GET',
    },
    'addInfraSanctionLetter':{
        'url' :  endpoint + 'infrastructure/sanctionInfraLetter',
        'method': 'POST',
    },
     'addInfraSanctionLetterState':{
        'url' :  endpoint + 'infrastructure/infrasanctionLetterstate',
        'method': 'POST',
    },
    'getInfraSanctionedList':{
        'url' :  endpoint + 'infrastructure/sanctionInfraLetter',
        'method': 'GET',
    },
    'getPrimaryLevelAgency':{
        'url' :  endpoint + 'masters/primary-level-agency',
        'method': 'GET',
    },
    'viewMfpProcurementSanctionHistory':{
        url : function (id) {
            return endpoint + 'proposal/viewMfpProcurementSanctionHistory/'+id; 
        },
        'method': 'GET',
    },
    'getMfpProcurementReleaseList':{
        'url' :  endpoint + 'proposal/release-fund',
        'method': 'GET',
    },
    'getReleaseDetails':{
        url : function (id) {
            return endpoint + 'proposal/release-fund/'+id; 
        },
        'method': 'GET',
    },
    'getReleasedFundDetails':{
        url : function (id) {
            return endpoint + 'proposal/released-fund-details/'+id; 
        },
        'method': 'GET',
    },
    'getMfpProcurementReceivedFundLogs':{
        url : function (id) {
            return endpoint + 'proposal/mfp-procurement-received-fund-details/'+id; 
        },
        'method': 'GET',
    },
    'getMfpProcurementReceivedCommission':{
        url : function (id) {
            return endpoint + 'proposal/mfp-procurement-received-commission/'+id; 
        },
        'method': 'GET',
    },
    'getMfpProcurementDiaCommissionReceivedList':{
        'url' : endpoint + 'proposal/get-mfp-procurement-dia-commission',
        'method': 'GET',
    },
    'getMfpProcurementSiaCommissionReceivedList':{
        'url' : endpoint + 'proposal/get-mfp-procurement-sia-commission',
        'method': 'GET',
    },
    'getMfpProcurementFundReceivedList':{
        'url' :  endpoint + 'proposal/mfp-procurement-received-fund',
        'method': 'GET',
    },
    'getProcurementReceivedFundData':{
        url : function (id) {
            return endpoint + 'proposal/mfp-procurement-received-fund-data/'+id; 
        },
        'method': 'GET',
    },
    'addReleaseFund':{
        'url' :  endpoint + 'proposal/release-fund',
        'method': 'POST',
    },
    'viewInfrastructureSanctionHistory':{
        url : function (id) {
            return endpoint + 'infrastructure/viewInfrastructureSanctionHistory/'+id; 
        },
        'method': 'GET',
    },
    'getInfrastructureReleaseList':{
        'url' :  endpoint + 'infrastructure/release-fund',
        'method': 'GET',
    },
    'getInfrastructureReleaseDetails':{
        url : function (id) {
            return endpoint + 'infrastructure/release-fund/'+id; 
        },
        'method': 'GET',
    },
    'addInfrastructureReleaseFund':{
        'url' :  endpoint + 'infrastructure/release-fund',
        'method': 'POST',
    },
    'getInfrastructureReleasedFundDetails':{
        url : function (id) {
            return endpoint + 'infrastructure/released-fund-details/'+id; 
        },
        'method': 'GET',
    },
    'getAllSelectedMfps':{
        url : function (id) {
            return endpoint + 'infrastructure/get-all-selected-mfps/'+id; 
        },
        'method': 'GET',
    },
    'getUserSanctionedList':{
        url : function (id) {
            return endpoint + 'proposal/getUserSanctionedList/'+id; 
        },
        'method': 'GET',
    },
    'getUserInfraSanctionedList':{
        url : function (id) {
            return endpoint + 'infrastructure/getUserInfraSanctionedList/'+id; 
        },
        'method': 'GET',
    },
    'proposalMfpDetails':{
        //url : function () {
            'url' : endpoint + 'proposal/get-last-5years-mfp-details',
        //},
        'method': 'GET',
    },
    'getMfpProcurementPaFundReceivedList':{
        'url' :  endpoint + 'proposal/mfp-procurement-pa-received-fund',
        'method': 'GET',
    },
    'getInfrastructureFundReceivedList':{
        'url' :  endpoint + 'infrastructure/infrastructure-received-fund',
        'method': 'GET',
    },
  
    'getReceivedFundLogs':{
        url : function (id) {
            return endpoint + 'infrastructure/received-fund-details/'+id; 
        },
        'method': 'GET',
    },
    'getMfpValue':{
        url : function (mfp_id) {
            return endpoint + 'proposal/get-mfp-value/'+mfp_id; 
        },
        'method': 'GET',
    },
    'getStatelevel':{
        'url' :  endpoint + 'proposal/get-state-level',
        'method': 'GET',
       
    },
    'getProcurementReceivedFund':{
        url : function (id) {
            return endpoint + 'proposal/procurement-received-fund-data/'+id; 
        },
        'method': 'GET',
    },
    'addMfpStorageDetails':{
        'url' :  endpoint + 'proposal/addMfpStorage',
        'method': 'POST',
    },
    'getMfpStorageDetails':{
        url : function (id) {
            return endpoint + 'proposal/viewMfpStorage/'+id; 
        },
        'method': 'GET',
    },
    'MfpProcurementCheckLastLevelUser':{
      url : function (id) {
            return endpoint + 'proposal/mfp-procurement-check-last-level-user/'+id; 
        },
        'method': 'GET',  
    },
    'MfpProcurementCheckConsolidatedLastLevelUser':{
      url : function (id) {
            return endpoint + 'proposal/mfp-procurement-check-consolidated-last-level-user/'+id; 
        },
        'method': 'GET',  
    },
    'getWarehouseTransactionlist':{
        'url' :  endpoint + 'proposal/get-warehouse-transaction-list',
        'method': 'GET',
    },
    /** SHG Form */
    'getShg':{
        'url': function (id) {
            return endpoint + 'shg/get-all/' + id; 
        },
        'method': 'GET',
    },

    'addShgPartOne' : {
        'url': endpoint + 'shg/part-one',
        'method': 'POST'
    },
    'addShgPartTwo' : {
        'url': endpoint + 'shg/part-two',
        'method': 'POST'
    },

    'addMfpProcurementGenerateReceipt' : {
        'url': endpoint + 'proposal/mfp-procurement-generate-receipt',
        'method': 'POST'
    },
    'getVillage':{
        'url':endpoint + 'masters/village-list/',
        'method':'GET',

    },
    'InfrastructureCheckLastLevelUser':{
      url : function (id) {
            return endpoint + 'infrastructure/infrastructure-check-last-level-user/'+id; 
        },
        'method': 'GET',  
    },
    'InfrastructureCheckConsolidatedLastLevelUser':{
      url : function (id) {
            return endpoint + 'infrastructure/infrastructure-check-consolidated-last-level-user/'+id; 
        },
        'method': 'GET',  
    },
    'addOverheadDetails':{
        'url': endpoint + 'proposal/add-actual-overhead-details',
        'method': 'POST'
    },
    'getActualOverheadDetail':{
        url : function (id) {
            return endpoint + 'proposal/actual-overhead-detail/'+id; 
        },
        'method': 'GET',
    }, 
    'getActualOverheadSpentDetail':{
        url : function (id) {
            return endpoint + 'proposal/actual-overhead-spent-detail/'+id; 
        },
        'method': 'GET',
    }, 
    'getOverheadCostOfPackagingMaterial':{ 
        url : function (id) {
            return endpoint + 'proposal/get-overhead-cost-of-packaging-material/'+id; 
        },
        'method': 'GET',
    },
    'getOverheadActualDetail':{
        'url':endpoint + 'proposal/actual-overhead-list',
        'method':'GET',
    },

    'addInfraActulaDetails':{
        'url' :  endpoint + 'infrastructure/add-infra-actualdetails',
        'method': 'POST',
    },
    'getActualDetailInfrastructure':{
          url : function (id) {
            return endpoint + 'infrastructure/get-infra-actualdetails/'+id; 
        },
        'method': 'GET',  
    },
    'getInfrastructureProgressList':{
        'url' :  endpoint + 'infrastructure/infrastructure-progress-list',
        'method': 'GET',
    },
    'toggleOverheadStatus' : {
        url : function (id) {
            return endpoint + 'proposal/actual-overhead/' + id + '/status';
        },
        'method' : 'POST'
    },
    'getMfpProcurementTransactionDetails':{
        'url' :  endpoint + 'proposal/mfp-procurement-transaction-details',
        'method': 'GET',
    },
    'getProcurementActualDetailReceipt':{
        'url' :  endpoint + 'proposal/mfp-procurement-generate-receipt',
        'method': 'GET',
    },
    'getMfpProcurementReceiptDetailView':{
          url : function (id) {
            return endpoint + 'proposal/mfp-procurement-generate-receipt/'+id; 
        },
        'method': 'GET',  
    },
    'consolidate_mfpprocurement_transaction':{
        'url': endpoint + 'proposal/consolidate_mfpprocurement_transaction',
        'method': 'POST',
    },
    'getProcurementConsolidatedTransaction':{
        'url' :  endpoint + 'proposal/get-procurement-consolidated-transaction',
        'method': 'GET',
    },
    'getConsolidatedProposalsList': {
        'url': endpoint + 'proposal/getConsolidatedProposalsList',
        'method' : 'GET'
    },
    'getConsolidatedProposalsListRecommended': {
        'url': endpoint + 'proposal/getConsolidatedProposalsListRecommended',
        'method' : 'GET'
    },
    'consolidateInfrastructureTransaction':{
        'url': endpoint + 'infrastructure/consolidate_infrastructure_transaction',
        'method': 'POST',
    }, 
    'getConsolidatedInfraProposalsList': {
        'url': endpoint + 'infrastructure/getConsolidatedProposalsList',
        'method' : 'GET'
    },
    'getConsolidatedInfraProposalsListRecommended': {
        'url': endpoint + 'infrastructure/getConsolidatedProposalsListRecommended',
        'method' : 'GET'
    },
    'approveRevertRejectTransaction':{
        'url': endpoint + 'proposal/approve_revert_reject_transaction',
        'method' : 'POST'
    },


    'getCommitteMember': {
        'url': endpoint + 'auction/get-committe-members',
        'method' : 'GET'
    },
    'addAuctionCommitte': {
        'url': endpoint + 'auction/auction-committe',
        'method' : 'POST'
    },
    'getAuctionCommitteList': {
        'url': endpoint + 'auction/auction-committe',
        'method' : 'GET'
    },
    'getAuctionCommitteDetail':{
          url : function (id) {
            return endpoint + 'auction/auction-committe/'+id; 
        },
        'method': 'GET',  
    },
    'getInfrastructureTransactionList':{
        'url' :  endpoint + 'infrastructure/infrastructure-transaction-list',
        'method': 'GET',
    },
    'getReceivedConsolidatedProposal':{
        'url' :  endpoint + 'infrastructure/infrastructure-received-consolidated-list',
        'method': 'GET',
    },
    'approveInfrastructureProgress':{
        'url': endpoint + 'infrastructure/approve-infrastructure-progress',
        'method': 'POST',
    }, 
    'revertInfrastructureProgress':{
        'url': endpoint + 'infrastructure/revert-infrastructure-progress',
        'method': 'POST',
    }, 
    'rejectInfrastructureProgress':{
        'url': endpoint + 'infrastructure/reject-infrastructure-progress',
        'method': 'POST',
    }, 
    'getUserDistrict': {
        'url': endpoint + 'auction/getUserDistrict',
        'method': 'GET',
    },
    'getDistrictWarehouse': {
        'url': endpoint + 'auction/getDistrictWarehouse',
        'method': 'GET',
    },
    'getStateMfp': {
        'url': endpoint + 'auction/getStateMfp',
        'method': 'GET',
    },
    'addAuctionTransaction': {
        'url': endpoint + 'auction/auction-transaction',
        'method' : 'POST'
    },
    'getAuctionTransactionDetail':{
          url : function (id) {
            return endpoint + 'auction/auction-transaction/'+id; 
        },
        'method': 'GET',  
    },
    'getAuctionTransactionList': {
        'url': endpoint + 'auction/auction-transaction',
        'method' : 'GET'
    },
    'TransactionStatusLogs':{
        url : function (id) {
            return endpoint + 'infrastructure/transaction-status-logs/'+id; 
        },      
        'method': 'GET',
    },
    'getScheduledTribesList':{
        'url':endpoint + 'masters/scheduled-tribes',
        'method':'GET',
    },
    'getSanctionedListAmountLog':{
        'url':endpoint + 'proposal/getSanctionedListAmountLog',
        'method':'GET',
    },
    'getConsolidatedTransactionList':{
        'url' :  endpoint + 'infrastructure/consolidated-transaction-list',
        'method': 'GET',
    },
    'editMfpStorageDetails':{
        'url' :  endpoint + 'proposal/editMfpStorage',
        'method': 'POST',
    },
    'deleteMfpStorage':{
        'url':endpoint + 'proposal/delete-mfp-storage', 
        'method': 'POST',
    },
    'getActualProposalList':{
        'url' :  endpoint + 'infrastructure/get-actual-proposals',
        'method': 'GET',
    },

    'getValueAddedProducts':{
        'url' :  endpoint + 'auction/get-value-added-products',
        'method': 'GET',
    },
    'getAuctionCommitteMfp':{
        'url' :  endpoint + 'auction/get-auction-committee-mfp',
        'method': 'GET',
    },
    'editInfraActulaDetails':{
        'url' :  endpoint + 'infrastructure/edit-infra-actualdetails',
        'method': 'POST',

    },
    'consolidate_tribal_transaction':{
        'url' :  endpoint + 'proposal/consolidate-tribal-transaction',
        'method': 'POST',
    },
    'getSeasonalityDetails':{ 
        url : function (id) {
            return endpoint + 'proposal/get-seasonality-details/'+id; 
        },
        'method': 'GET',
    },    
    'addMspMarketPrice':{
        'url' :  endpoint + 'msp_price/msp-market-price',
        'method': 'POST',
    },
    'getPendingMspMarketPriceList':{
        'url' :  endpoint + 'msp_price/pending-msp-market-price',
        'method': 'GET',
    },
    'getApprovedMspMarketPriceList':{
        'url' :  endpoint + 'msp_price/approved-msp-market-price',
        'method': 'GET',
    },
    'getPendingForApprovalMspMarketPriceList':{
        'url' :  endpoint + 'msp_price/pending-for-approval-msp-market-price',
        'method': 'GET',
    },
    'getMspMarketPriceetails':{
        url : function (id) {
            return endpoint + 'msp_price/msp-market-price/'+id; 
        },      
        'method': 'GET',
    },
    'mspMarketPriceUpdateStatus':{
        'url' :  endpoint + 'msp_price/msp-market-price-update-status',
        'method': 'POST',
    },
    'uploadWarehouseReceipt':{
        'url' :  endpoint + 'proposal/upload-warehouse-receipt',
        'method': 'POST',    
    },
    'getMfpDetails':{ 
        url : function (id) {
            return endpoint + 'proposal/get-mfp-details/'+id; 
        },
        'method': 'GET',
    },   
    'viewInfrastructureSanctionHistory':{
        url : function (id) {
            return endpoint + 'infrastructure/viewInfrastructureSanctionHistory/'+id; 
        },
        'method': 'GET',
    }, 
    'getShgGatherers': {
        'url': endpoint + 'shg/manage-all',
        'method': 'GET',
    },
     'SearchVillage':{
        'url':endpoint + 'masters/SearchVillage',
        'method':'GET',
    },
    'SearchSurveyor':{
        'url':endpoint + 'user/SearchSurveyor',
        'method':'GET',
    }, 
    'SearchPincode':{
        'url':endpoint + 'masters/SearchPincode',
        'method':'GET',
    },
    'getInfrastructureCountsStatusWise':{
        'url': endpoint + 'infrastructure/infrastructure-counts-status-wise',
        'method': 'GET',
    },
    'getFundAvailable':{
        'url': endpoint + 'proposal/getFundAvailable',
        'method': 'GET',
    },
    'getShgData':{
        'url': endpoint + 'shg/get-all/', 
        'method': 'GET',
    },
    'getSecondLastRoleAppovedDetails':{
        url : function (id) {
            return endpoint + 'proposal/get-second-last-role-approved-details/'+id;
        },
        'method': 'GET',
    },

    'CheckLastLevelUser':{
        'url': endpoint + 'infrastructure/check-last-level-user/', 
        'method': 'GET',
    },
    'getDiaRealeasedDetailsToProcurementAgent':{
        url : function (id) {
            return endpoint + 'proposal/get-dia-realeased-details-to-procurement-agent/'+id;
        },
        'method': 'GET',
    },
    'getInfraSecondLastRoleAppovedDetails':{
        url : function (id) {
            return endpoint + 'infrastructure/get-infra-second-last-role-approved-details/'+id;
        },
        'method': 'GET',
    },
    'infrastructureApprovedListing':{
        'url': endpoint + 'infrastructure/infra-approved-listing',
        'method': 'GET',
    },
     'getInfrastructureReceivedCommission':{
        url : function (id) {
            return endpoint + 'infrastructure/infrastructure-received-commission/'+id; 
        },
        'method': 'GET',
    },
    'getInfrastructureDiaCommissionReceivedList':{
        'url' : endpoint + 'infrastructure/get-infrastructure-dia-commission',
        'method': 'GET',
    },
    'getInfrastructureSiaCommissionReceivedList':{
        'url' : endpoint + 'infrastructure/get-infrastructure-sia-commission',
        'method': 'GET',
    },
}
