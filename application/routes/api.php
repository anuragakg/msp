<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::fallback(function () {
    return response()->json([
        'status'  => 0,
        'message' => 'Requested endpoint not found.'
    ], 404);
});

/**
 * Grouping v1 Routes
 */
Route::group([
    'namespace' => 'Api\V1',
    'prefix' => 'v1'
], function () {

    /**
     * Masters Management Routes
     * 1. Built Up Area Master CRUD.
     */
    Route::group([
        'middleware' => 'throttle:3,1'
    ], function () {
        Route::post('email-verify', 'AuthController@emailVerify')->name('emailVerify');
        Route::post('generate-password', 'AuthController@generatePassword')->name('generatePassword');
        Route::post('forgot-password', 'AuthController@forgotPassword')->name('forgotPassword');
        Route::post('reset-password', 'AuthController@resetPassword')->name('resetPassword');
        Route::post('login', 'AuthController@login')->name('login');
        Route::post('mobile-login', 'AuthController@mobile_login')->name('mobile-login');
        Route::post('refresh-token', 'AuthController@refreshToken')->name('refresh-token');
    });

    Route::group([
        'middleware' => 'auth:api'
    ], function () {
        Route::get('logout', 'AuthController@logout')->name('logout')->middleware('throttle:3,1');
        Route::post('change-password', 'AuthController@changePassword')->name('changePassword');

        /*All Users Profile Edit Api's*/
        Route::get('get-profile', 'AuthController@profile')->name('profile');
        Route::put('update-profile', 'AuthController@updateProfile')->name('update-profile');
        Route::post('update-mo-cetificate', 'AuthController@updateMoProfileCertificate')->name('update-mo-cetificate');

        Route::apiResource('capture-location', 'CaptureLocationController')->names('capture-location')->middleware('surveyor_supervisor:4');
        /**/
        Route::post('update-capture-location', 'CaptureLocationController@update')->name('update-capture-location');

        Route::get('notification/mark-all-read', 'NotificationController@markAllRead')->name('notification-read');
        Route::get('notification/count', 'NotificationController@getNotificationCount')->name('notification-count');
        Route::apiResource('notification', 'NotificationController')->names('notification');
    });

    Route::group([
        'namespace' => 'Masters',
        'prefix' => 'masters',
        'middleware' => 'auth:api'
    ], function () {
        Route::apiResource('data', 'MasterDataController')->names('all-masters');
        Route::apiResource('all-data', 'MasterController');

        Route::apiResource('village', 'VillageController');

        Route::post('village/{id}/status', 'VillageController@updateStatus')->name('village.status');
        Route::post('village/importExcel', 'VillageController@importExcel')->name('import.excel');

        Route::get('village-list/{pincode}', 'VillageController@villageList')->name('villageList');
        Route::get('SearchPincode', 'VillageController@SearchPincode')->name('SearchPincode');
        Route::get('SearchVillage', 'VillageController@SearchVillage')->name('SearchVillage');



        Route::get('villageExport/export', 'VillageController@export')->name('village.export');

        Route::apiResource('state', 'StateController');
        Route::post('state/{id}/status', 'StateController@updateStatus')->name('state.status');

        Route::apiResource('district', 'DistrictController');
        Route::post('district/{id}/status', 'DistrictController@updateStatus')->name('district.status');

        Route::apiResource('block', 'BlockController');
        Route::get('block_by_district/{id}', 'BlockController@getBlockByDistrict')->name('block.status');
        Route::post('block/{id}/status', 'BlockController@updateStatus')->name('block.status');

        Route::apiResource('location', 'LocationController');
        Route::post('location/{id}/status', 'LocationController@updateStatus')->name('location.status');

        Route::apiResource('block-location', 'BlockLocationController');
        Route::post('block-location/{id}/status', 'BlockLocationController@updateStatus')->name('block-location.status');

        Route::apiResource('scheduled-tribes', 'ScheduledTribesController')->names('scheduled-tribes');
        Route::apiResource('bank', 'BankController');
        Route::post('bank/{id}/status', 'BankController@updateStatus')->name('bank.status');



        Route::apiResource('procurement-agent', 'ProcurementAgentController');

        Route::post('procurement-agent/{id}/status', 'ProcurementAgentController@updateStatus')->name('procurement-agent.status');

        Route::apiResource('category', 'CategoryController');
        Route::post('category/{id}/status', 'CategoryController@updateStatus')->name('category.status');



        Route::apiResource('role', 'RoleController');
        Route::post('role/{id}/status', 'RoleController@updateStatus')->name('role.status');


        Route::apiResource('permission', 'PermissionController')->names('permission');
        Route::post('permission/{id}/status', 'PermissionController@updateStatus')->name('permission.change-status');

        Route::apiResource('permission-mapping', 'PermissionMappingController');
        Route::post('permission-mapping/{id}/status', 'PermissionMappingController@updateStatus')->name('permission-mapping.status');


        Route::get('user-role', 'RoleController@getRoleMappingRoles')->name('user.role');
        Route::get('role-listing', 'RoleController@getRolesListing')->name('user.role');
        Route::get('user-management-role', 'RoleController@getUserManagementRoles')->name('user.management-role');   //Not Applied Status Route 
        Route::get('get-commission-master-role', 'RoleController@getCommissionMasterList');


        Route::apiResource('packing', 'PackingMasterController');
        Route::post('packing/{id}/status', 'PackingMasterController@updateStatus')->name('packing.status');
        Route::post('packing/check_name', 'PackingMasterController@checkBagName')->name('packing.check_name');
        Route::get('packing-listing', 'PackingMasterController@getPackingListing');

        Route::apiResource('haat-bazaar-details', 'HaatBazaarMasterController');
        Route::post('haat-bazaar-details/{id}/status', 'HaatBazaarMasterController@updateStatus')->name('haat-details.status');

        Route::apiResource('commission-master', 'CommissionMasterController');
        Route::get('commission-list-state-wise/{id}', 'CommissionMasterController@getCommissionStatewise');
        Route::post('commission-master/{id}/status', 'CommissionMasterController@updateStatus');
        Route::post('check-unique-commission-master', 'CommissionMasterController@checkUniqueRecord');

        Route::apiResource('commission-limit', 'MaxCommissionLimitController');
        Route::post('commission-limit/{id}/status', 'MaxCommissionLimitController@updateStatus');


        Route::apiResource('haat-bazaar-items', 'HaatItemController');
        Route::get('haat-bazaar-items-list', 'HaatItemController@getHaatitemListing');
        Route::post('haat-bazaar-items/{id}/status', 'HaatItemController@updateStatus')->name('haat-bazaar-items.status');

        Route::apiResource('warehouse-items', 'WarehouseItemController');
        Route::get('warehouse-items-list', 'WarehouseItemController@getWarehouseitemListing');
        Route::post('warehouse-items/{id}/status', 'WarehouseItemController@updateStatus')->name('warehouse-items.status');

        Route::apiResource('multipurpose-procurement-items', 'MultipurposeProcurementItemController');
        Route::get('multipurpose-procurement-items-list', 'MultipurposeProcurementItemController@getitemListing');
        Route::post('multipurpose-procurement-items/{id}/status', 'MultipurposeProcurementItemController@updateStatus')->name('multipurpose-procurement-items.status');

        Route::apiResource('equipments', 'EquipmentController');
        Route::post('equipments/{id}/status', 'EquipmentController@updateStatus')->name('equipments.status');

        Route::apiResource('designation', 'DesignationController');
        Route::post('designation/{id}/status', 'DesignationController@updateStatus')->name('designation.status');

        Route::apiResource('department', 'DepartmentController');
        Route::post('department/{id}/status', 'DepartmentController@updateStatus')->name('department.status');

        Route::apiResource('level', 'LevelController');
        Route::post('level/{id}/status', 'LevelController@updateStatus')->name('level.status');

        Route::apiResource('year', 'YearController');
        Route::post('year/{id}/status', 'YearController@updateStatus')->name('year.status');

        Route::apiResource('financial-year', 'FinancialYearController');
        Route::post('financial-year/{id}/status', 'FinancialYearController@updateStatus')->name('financial-year.status');

        Route::apiResource('commodity', 'CommodityController');
        Route::post('commodity/{id}/status', 'CommodityController@updateStatus')->name('commodity.status');

        Route::apiResource('id-proof', 'IdProofController');
        Route::post('id-proof/{id}/status', 'IdProofController@updateStatus')->name('id-proof.status');



        Route::apiResource('state-level-role', 'StateLevelRoleController');
        Route::post('state-level-role/{id}/status', 'StateLevelRoleController@updateStatus')->name('state-level-role.status');


        Route::get('commoditystate', 'CommodityController@getCommoditiesWiseState');
        Route::apiResource('mfp', 'MfpController');
        Route::get('mfp_logs', 'MfpController@mfp_logs');
        Route::post('mfp/{id}/status', 'MfpController@updateStatus')->name('mfp.status');

        Route::apiResource('warehouse-master', 'WarehouseController');
        Route::get('warehouse-haatbazaar', 'WarehouseController@getWarehouseHaatmarket');
        Route::post('warehouse-master/{id}/status', 'WarehouseController@updateStatus')->name('warehouse.status');


        Route::apiResource('scrutiny-management', 'StateLevelRoleController');
        //Route::get('scrutiny-role','StateLevelRoleController@getScrutinyRoles');
        Route::post('scrutiny-management/{id}/status', 'StateLevelRoleController@updateStatus')->name('state-level-role.status');
        Route::apiResource('procurement-center', 'ProcurementCenterController');
        Route::apiResource('primary-level-agency', 'PrimaryLevelAgencyController');

    });


    /**
     * Download bulk upload formats
     */

    Route::get('user/SearchSurveyor', 'UserController@SearchSurveyor')->name('users.search-surveyor');
    Route::get('villageExcel/downloadExcel', 'Masters\VillageController@downloadExcel')->name('village.excel.download.excel');




    /**
     * Auth api middleware
     */
    Route::middleware('auth:api')->group(function () {

        Route::apiResource('user', 'UserController')->names('user');
        Route::put('user/status/{id}', 'UserController@updateStatus')->name('user.status');
        Route::apiResource('bank-details', 'UserBankDetailsController')->names('user.bank-details');
        Route::get('users/user-activity-log', 'UserController@getUserActivityLog')->name('user.activity-log');
        Route::get('users/permission-mapping/{id}', 'UserController@getUserPermissions')->name('users/permission-mapping');
        Route::post('users/add-permission-mapping', 'UserController@addUserPermissions')->name('users/add-permission-mapping');

        Route::get('users/permission-mapping-role/{id}', 'UserController@getUserPermissionsRoleBasis')->name('users/permission-mapping-role');

        Route::get('getCurrentUserHaatInfo', 'UserController@getCurrentUserHaatInfo');
    });


    Route::group([
        'namespace' => 'HaatMarket',
        'prefix' => 'haat-market',
        'middleware' => 'auth:api,surveyor_supervisor:2'
    ], function () {
        Route::apiResource('manage', 'HaatBazaarController')->names('haat-market.manage-all');
        Route::get('get-all/{id}', 'HaatBazaarController@getAllHaatMarket')->name('haat-market.get-all');
    });

    Route::group([
        'namespace' => 'Proposals',
        'prefix' => 'proposal',
        'middleware' => 'auth:api'
    ], function () {
        Route::apiResource('mfp-procurement', 'MfpProcurementController')->names('mfp-procurement');
        Route::apiResource('mfp-procurement-disposal', 'MfpProcurementDisposalController');
        Route::get('getConsolidatedProposalsList', 'MfpProcurementController@getConsolidatedProposalsList');
        Route::get('getConsolidatedProposalsListRecommended', 'MfpProcurementController@getConsolidatedProposalsListRecommended');
        Route::get('mfp-procurement-detail/{id}', 'MfpProcurementController@mfpProcurementDetail');
        Route::get('mfp-procurement-listing', 'MfpProcurementController@proposalListing');
        Route::get('mfp-procurement-recommended-listing', 'MfpProcurementController@proposalRecommendedListing');
        Route::get('mfp-procurement-approved-listing', 'MfpProcurementController@proposalApprovedListing');
        Route::get('mfp-procurement-status-logs/{id}', 'MfpProcurementController@proposal_status_logs');

        Route::get('mfp-seasonalibity-quarterwise/{id}', 'MfpProcurementController@getSeasionalityQuarterWise');
        Route::post('delete-mfp-coverage-block-haat', 'MfpProcurementController@deleteMfpCoverageBlockHaat');
        Route::post('delete-commodity-haat', 'MfpProcurementController@deleteCommodityHaat');
        Route::post('delete-mfp-coverage', 'MfpProcurementController@deleteMfpCoverage');
        Route::post('delete-seasonality', 'MfpProcurementController@deleteSeasonality');
        Route::apiResource('mfp-procurement-plan', 'MfpProcurementPlanController')->names('mfp-procurement-plan');
        Route::get('get-seasonality-commodity/{id}', 'MfpProcurementPlanController@getAllCommodity')->name('get-seasonality.commodity');
        Route::get('get-seasonality-commodity-details/{id}', 'MfpProcurementController@getSeasonalityCommodityDetails')->name('get-seasonality.commodity');

        Route::get('mfp-procurement-plan-detail/{id}', 'MfpProcurementPlanController@mfpProcurementPlanDetail');

        Route::get('get-cost-of-packaging-material/{id}', 'MfpProcurementPlanController@getCostOfPackagingMaterial');

        Route::get('get-estimated-value-of-procurement/{id}/{mfp_id}', 'MfpProcurementDisposalController@getEstimatedValueOfProcurement');
        Route::get('get-procurement-qty-value/{id}/{mfp_id}', 'MfpProcurementDisposalController@getProcurementQtyValue');

        Route::apiResource('mfp-procurement-summary', 'MfpProcurementSummaryController');
        Route::get('get-estimated-procurement/{id}', 'MfpProcurementPlanController@getEstimatedProcurement');

        Route::get('get-estimated-quarterly-requirement-for-summary/{id}', 'MfpProcurementController@getMfpQuarterWiseForSummary');

        Route::get('get-all-proposal', 'MfpProcurementController@getAllProposal');
        Route::get('mfp-procurement-reverted', 'MfpProcurementController@getProposalReverted');
        Route::get('mfp-procurement-rejected', 'MfpProcurementController@getProposalRejected');
        Route::get('mfp-procurement-counts-status-wise', 'MfpProcurementController@getProcurementCountsStatusWise');

        Route::post('approve-mfp-procurement', 'MfpProcurementController@approveMfpProcurement');
        Route::post('revert-mfp-procurement', 'MfpProcurementController@revertMfpProcurement');
        Route::post('reject-mfp-procurement', 'MfpProcurementController@rejectMfpProcurement');
        Route::post('send_mfpprocurement_to_nextlevel', 'MfpProcurementController@send_mfpprocurement_to_nextlevel');
        Route::post('consolidate_mfpprocurement', 'MfpProcurementController@consolidate_mfpprocurement');
        Route::post('send_consolidated_to_next_level', 'MfpProcurementController@send_consolidated_to_next_level');
        Route::post('consolidate_references', 'MfpProcurementController@consolidate_references');
        Route::get('getConsolidatedProposals', 'MfpProcurementController@getConsolidatedProposals');
        Route::get('get-consolidated-proposal-detail/{id}', 'MfpProcurementController@getConsolidatedProposal');
        Route::post('approve-consolidated-mfp-procurement', 'MfpProcurementController@approveConsolidatedMfpProcurement');
        Route::post('revert-consolidated-mfp-procurement', 'MfpProcurementController@revertConsolidatedMfpProcurement');
        Route::post('reject-consolidated-mfp-procurement', 'MfpProcurementController@rejectConsolidatedMfpProcurement');

        Route::get('get-procurement-mfp-listing/{id}', 'MfpProcurementController@getProposalMfpList');
        Route::post('add-mfp-for-procurement', 'MfpProcurementController@addMfpForProcurement');
        Route::get('get-last-5years-mfp-details', 'MfpProcurementController@get_mfp_details');
        Route::get('getApprovedConsolidatedProposals', 'MfpProcurementController@getApprovedConsolidatedProposals');

        Route::get('getSanctionDetails/{id}', 'MfpProcurementSanctionController@getSanctionDetails');
        Route::apiResource('sanctionLetter', 'MfpProcurementSanctionController');
        Route::post('sanctionLetterstate', 'MfpProcurementSanctionController@addStateSanctionLetter');
        Route::get('viewMfpProcurementSanctionHistory/{id}', 'MfpProcurementSanctionController@viewMfpProcurementSanctionHistory');
        Route::get('getMfpProcurementReleaseList', 'MfpProcurementSanctionController@getMfpProcurementReleaseList');
        Route::get('getReleaseDetails/{id}', 'MfpProcurementSanctionController@getReleaseDetails');
        Route::apiResource('release-fund', 'MfpProcurementReleaseController');
        Route::get('released-fund-details/{id}', 'MfpProcurementReleaseController@getReleasedFundDetails');
        Route::get('mfp-procurement-received-fund', 'MfpProcurementReleaseController@getMfpProcurementFundReceivedList');
        Route::get('mfp-procurement-pa-received-fund', 'MfpProcurementReleaseController@getMfpProcurementPAFundReceivedList');
        Route::get('mfp-procurement-received-fund-details/{id}', 'MfpProcurementReleaseController@getMfpProcurementReceivedFundLogs');

        Route::get('mfp-procurement-received-commission/{id}', 'MfpProcurementReleaseController@getMfpProcurementReceivedCommission');
        Route::get('get-mfp-procurement-dia-commission', 'MfpProcurementReleaseController@getAllMfpProcurementCommission');

        Route::get('get-mfp-procurement-sia-commission', 'MfpProcurementReleaseController@getSiaMfpProcurementCommission');

        Route::get('getUserSanctionedList/{id}', 'MfpProcurementSanctionController@getUserSanctionedList');
        Route::get('getSanctionedListAmountLog', 'MfpProcurementSanctionController@getSanctionedListAmountLog');
        Route::get('mfp-procurement-received-fund-data/{id}', 'MfpProcurementReleaseController@getMfpProcurementReceivedFundData');
        Route::get('get-procurement-agent-list', 'MfpProcurementReleaseController@getProcurementAgentList');
        Route::post('add-mfpprocurement-releasefund-procurementagent', 'MfpProcurementReleaseController@addDiaReleaseFundToProcurementAgent');
        Route::get('mfp-procurement-procurementagent-fundreceived-list', 'MfpProcurementReleaseController@fundReceivedProcurementAgent');
        Route::get('mfp-procurement-procurementagent-fundreceived-details', 'MfpProcurementReleaseController@fundReceivedProcurementAgentDetail');
        Route::get('get-mfp-procurement-agent-release-detail/{id}', 'MfpProcurementReleaseController@getMfpProcurementAgentReleasedetail');

        Route::get('get-mfp-procurement-agent-mfp-list/{id}', 'MfpProcurementReleaseController@getMfpProcurementAgentMfpList');

        Route::get('get-mfp-value/{mfp_id}', 'MfpProcurementController@getMfpValue');
        Route::post('getTribalDetailFromIdProof', 'MfpProcurementActualDetailController@getTribalDetailFromIdProof');

        Route::get('getTribalDetailFromName', 'MfpProcurementActualDetailController@getTribalDetailFromName');

        Route::post('addMfpStorage', 'MfpProcurementActualDetailController@addMfpStorageDetails');
        Route::post('editMfpStorage', 'MfpProcurementActualDetailController@editMfpStorageDetails');
        Route::post('delete-mfp-storage', 'MfpProcurementActualDetailController@deleteMfpStorageDetails');
        Route::get('viewMfpStorage/{id}', 'MfpProcurementActualDetailController@viewMfpStorageDetails');
        Route::get('getProcurementAgentProposals/{id}', 'MfpProcurementActualDetailController@getProcurementAgentProposals');
        Route::get('getFundAvailable', 'MfpProcurementActualDetailController@getFundAvailable');
        Route::get('getProcurementAgentProposalsMfp/{id}', 'MfpProcurementActualDetailController@getProcurementAgentProposalsMfp');
        Route::apiResource('mfp-procurement-actual-detail', 'MfpProcurementActualDetailController');
        Route::get('get-state-level', 'MfpProcurementController@getMinScrutinyLevel');
        Route::get('procurement-received-fund-data/{id}', 'MfpProcurementReleaseController@getMfpProcurementReceivedFund');
        Route::get('mfp-procurement-check-last-level-user/{id}', 'MfpProcurementController@mfpProcurementCheckLastLevelUser');
        Route::get('mfp-procurement-check-consolidated-last-level-user/{id}', 'MfpProcurementController@mfpProcurementCheckConsolidatedLastLevelUser');
        Route::get('get-warehouse-transaction-list', 'MfpProcurementReleaseController@getWarehouseTransactionList');
        Route::apiResource('mfp-procurement-generate-receipt', 'MfpProcurementGenerateReceiptController');
        Route::apiResource('add-actual-overhead-details', 'ActualOverheadController');
        Route::get('actual-overhead-detail/{id}', 'ActualOverheadController@overheadDetail');
        Route::get('actual-overhead-spent-detail/{id}', 'ActualOverheadController@overheadAmountSpentDetail');
        Route::get('get-overhead-cost-of-packaging-material/{id}', 'ActualOverheadController@getCostOfPackagingMaterial');
        Route::get('actual-overhead-list', 'ActualOverheadController@list');
        Route::post('actual-overhead/{id}/status', 'ActualOverheadController@updateStatus')->name('overhead.status');
        Route::get('mfp-procurement-transaction-details
        ', 'MfpProcurementActualDetailController@transactionDetailsList');
        Route::post('consolidate_mfpprocurement_transaction','MfpProcurementActualDetailController@consolidateTransaction');
        Route::get('get-procurement-consolidated-transaction
        ', 'MfpProcurementActualDetailController@getConsolidatedTransactionList');
        Route::post('approve_revert_reject_transaction
        ', 'MfpProcurementActualDetailController@approveRevertRejectTransaction');
        Route::post('consolidate-tribal-transaction
        ', 'MfpProcurementActualDetailController@consolidateTribalTransaction');
        Route::get('get-seasonality-details/{id}', 'MfpProcurementController@getSeasonalityDetails');
        Route::post('upload-warehouse-receipt','MfpProcurementActualDetailController@uploadWarehouseReceipt');
       
        Route::get('get-mfp-details/{id}', 'MfpProcurementController@getMfpDetails');
        Route::get('get-second-last-role-approved-details/{id}','MfpProcurementController@getSecondLastRoleApprovedDetails');
        Route::get('get-dia-realeased-details-to-procurement-agent/{id}','MfpProcurementReleaseController@getReleasedDetailsToProcurementagent');
                
   }); 
    
    Route::group([
        'namespace' => 'Auction',
        'prefix' => 'auction',
        'middleware' => 'auth:api'
    ], function () {
        Route::apiResource('auction-committe', 'AuctionCommitteController');
        Route::get('get-committe-members', 'AuctionCommitteController@getCommitteMember');
        Route::get('getUserDistrict', 'AuctionTransactionController@getUserDistrict');
        Route::get('getDistrictWarehouse', 'AuctionTransactionController@getDistrictWarehouse');
        Route::get('getStateMfp', 'AuctionTransactionController@getStateMfp');
        Route::apiResource('auction-transaction', 'AuctionTransactionController');
        Route::get('get-value-added-products', 'AuctionTransactionController@getValueAddedProducts');
        Route::get('get-auction-committee-mfp', 'AuctionTransactionController@getAuctionCommitteMfp');
    });

    Route::group([
        'namespace' => 'Infrastructures',
        'prefix' => 'infrastructure',
        'middleware' => 'auth:api'
    ], function () {
        Route::apiResource('infrastructure-development', 'InfrastructureController')->names('infrastructure-development');

        Route::get('infrastructure-development-detail/{id}', 'InfrastructureController@getinfrastructureDetail');
        Route::get('infrastructure-development-listing', 'InfrastructureController@proposalListing');        
        Route::get('getConsolidatedProposalsList', 'InfrastructureController@getConsolidatedProposalsList');
        Route::get('getConsolidatedProposalsListRecommended', 'InfrastructureController@getConsolidatedProposalsListRecommended');
        Route::get('getConsolidatedProposals', 'InfrastructureController@getConsolidatedProposals');
        Route::get('infrastructure-development-submitted', 'InfrastructureController@submittedproposalListing');
        Route::post('approve-infrastructure', 'InfrastructureController@approveInfrastructure');
        Route::get('infrastructure-status-logs/{id}', 'InfrastructureController@proposal_status_logs');
        Route::get('infrastructure-recommended-listing', 'InfrastructureController@proposalRecommendedListing');
        Route::get('get-consolidated-proposal-detail/{id}', 'InfrastructureController@getConsolidatedProposal');
        Route::get('infrastructure-counts-status-wise', 'InfrastructureController@getInfrastructureCountsStatusWise');
        Route::get('infrastructure-check-last-level-user/{id}', 'InfrastructureController@infrastructureCheckLastLevelUser');
        Route::get('infrastructure-check-consolidated-last-level-user/{id}', 'InfrastructureController@infrastructureCheckConsolidatedLastLevelUser'); 
        Route::get('infrastructure-reverted', 'InfrastructureController@getProposalReverted');
        
        Route::get('infrastructure-rejected', 'InfrastructureController@getProposalRejected');
        Route::post('consolidate_references', 'InfrastructureController@consolidate_references');
         Route::get('infra-approved-listing', 'InfrastructureController@proposalApprovedListing');
        Route::get('infrastructure-development-detail/{id}', 'InfrastructureController@getinfrastructureDetail');
        Route::get('infrastructure-development-listing', 'InfrastructureController@proposalListing');
        Route::get('getInfraApprovedConsolidatedProposals', 'InfrastructureController@getApprovedConsolidatedProposals');

        Route::post('approve-infrastructure', 'InfrastructureController@approveInfrastructure');
        Route::post('revert-infrastructure', 'InfrastructureController@revertInfrastructure');
        Route::post('reject-infrastructure', 'InfrastructureController@rejectInfrastructure');

        Route::post('approve-consolidated-infrastructure', 'InfrastructureController@approveConsolidated');
        Route::post('revert-consolidated-infrastructure', 'InfrastructureController@revertConsolidated');
        Route::post('reject-consolidated-infrastructure', 'InfrastructureController@rejectConsolidate');

        Route::get('transaction-status-logs/{id}', 'InfrastructureController@transaction_status_logs');
        
        Route::post('approve-infrastructure-progress', 'InfrastructureController@approveInfrastructureProgress');
        Route::post('revert-infrastructure-progress', 'InfrastructureController@revertInfrastructureProgress');
        Route::post('reject-infrastructure-progress', 'InfrastructureController@rejectInfrastructureProgress');
        
        Route::post('send_infrastructure_to_nextlevel', 'InfrastructureController@send_infrastructure_to_nextlevel');

        Route::post('send_consolidated_to_next_level', 'InfrastructureController@send_consolidated_to_next_level');

        Route::post('consolidate_infrastructure', 'InfrastructureController@consolidate_infrastructure');
        Route::post('consolidate_infrastructure_transaction', 'InfrastructureController@consolidate_infrastructure_transaction'); 
        Route::apiResource('infrastructure-development-two', 'InfrastructurePartTwoController')->names('infrastructure-development-two');
        Route::apiResource('infrastructure-summary', 'InfrastructureSummaryController')->names('infrastructure-summary');

        Route::apiResource('sanctionInfraLetter', 'InfrastructureSanctionController');
        Route::get('getInfraSanctionDetails/{id}', 'InfrastructureSanctionController@getSanctionDetails');
        Route::get('viewInfrastructureSanctionHistory/{id}', 'InfrastructureSanctionController@viewInfrastructureSanctionHistory');
        Route::get('getInfrastructureReleaseList', 'InfrastructureSanctionController@getInfrastructureReleaseList');
        Route::get('getInfrastructureReleaseDetails/{id}', 'InfrastructureSanctionController@getReleaseDetails');

        Route::post('infrasanctionLetterstate', 'InfrastructureSanctionController@addStateSanctionLetter');
        Route::apiResource('release-fund', 'InfrastructureReleaseController');
        Route::get('released-fund-details/{id}', 'InfrastructureReleaseController@getReleasedFundDetails');
        Route::get('get-all-selected-mfps/{id}', 'InfrastructureController@getAllSelectedMfps');
        Route::get('getUserInfraSanctionedList/{id}', 'InfrastructureSanctionController@getUserSanctionedList');
        Route::get('infrastructure-received-fund', 'InfrastructureReleaseController@getFundReceivedList');
        Route::get('received-fund-details/{id}', 'InfrastructureReleaseController@getReceivedFundLogs');
         Route::get('infrastructure-received-commission/{id}', 'InfrastructureReleaseController@getInfrastructureReceivedCommission');
         Route::get('get-infrastructure-dia-commission', 'InfrastructureReleaseController@getAllInfrastructureCommission');
        
        Route::get('get-infrastructure-sia-commission', 'InfrastructureReleaseController@getSiaInfrastructureCommission');


        Route::post('add-infra-actualdetails', 'InfrastructureReleaseController@addInfraActualDetails');        
        Route::get('get-infra-actualdetails/{id}', 'InfrastructureReleaseController@getInfraActualDetails');
        Route::get('infrastructure-progress-list', 'InfrastructureReleaseController@getInfraProgressList');        
        Route::get('infrastructure-transaction-list', 'InfrastructureReleaseController@getInfraTransactionList');   
        Route::get('get-actual-proposals', 'InfrastructureReleaseController@getActualProposalList');      
        Route::post('edit-infra-actualdetails', 'InfrastructureReleaseController@editInfraActualDetails');   

        Route::get('consolidated-transaction-list', 'InfrastructureReleaseController@getConsolidatedTransactionList');        
        Route::get('infrastructure-received-consolidated-list', 'InfrastructureReleaseController@getInfraConsolidatedProposalList');  
        Route::get('get-infra-second-last-role-approved-details/{id}','InfrastructureController@getSecondLastRoleApprovedDetails');
        
    });

 /** SHG Gatherer Form */
    Route::group([
        'namespace' => 'Shg',
        'prefix' => 'shg',
        'middleware' => 'auth:api'
    ], function () {
         
            Route::apiResource('part-one', 'ShgPartOne')->names('shg.part-one');
            Route::apiResource('part-two', 'ShgPartTwo')->names('shg.part-two');
            Route::get('get-all/{id}', 'ShgController@getAllShg')->name('shg.get-all'); 
            Route::get('manage-all', 'ShgController@getAll')->name('shg.manage-all');
 
    });

    /** Traders MSP Form */
    Route::group([
        'namespace' => 'MspMarketPrice',
        'prefix' => 'msp_price',
        'middleware' => 'auth:api'
    ], function () {
        
        Route::apiResource('msp-market-price', 'MfpMarketPriceController')->middleware('trader_access');
        Route::post('msp-market-price-update-status', 'MfpMarketPriceController@updateStatus');
        Route::get('msp-market-price-logs', 'MfpMarketPriceController@getLogs');
        Route::get('pending-msp-market-price', 'MfpMarketPriceController@getPendingMspMarketPriceList');
        Route::get('approved-msp-market-price', 'MfpMarketPriceController@getApprovedMspMarketPriceList');
        Route::get('pending-for-msp-market-price', 'MfpMarketPriceController@getPendingMspMarketPriceList');
        Route::get('pending-for-approval-msp-market-price', 'MfpMarketPriceController@getPendingForApprovalMspMarketPriceList');
        
    });

});
