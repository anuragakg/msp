<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Http\Controllers\Api\V1\ApiController;
use App\Services\MisReportService;
use App\Exports\HaatExportMis;
use App\Exports\WarehouseExportMis;
use App\Exports\HaatMarketCommodityExportMis;
use App\Exports\WarehouseCommodityExportMis;
use App\Exports\CommodityExportMis;
use App\Exports\VdvkExportMis;
use App\Exports\ApprovedVdvkExportMis;
use App\Exports\VdvkSanctionedExportMis;
use App\Exports\VdvkFundbalaceExportMis;
use App\Exports\ShgExportMis;
use App\Exports\MoExportMis;
use App\Exports\ShgCommodityExportMis;
use App\Exports\StateProposalExportMis;
use App\Http\Resources\Api\MisReport\ShgMisReportResource;
use App\Http\Resources\Api\MisReport\MentoringOrganisationMisReportResource;
use App\Http\Resources\Api\MisReport\VdvkMisReportResource;
use App\Http\Resources\Api\MisReport\VdvkFundBalanceListingResource;
use App\Http\Resources\Api\MisReport\HaatMarketMisReportResource;
use App\Http\Resources\Api\MisReport\WarehouseMisReportResource;

use App\Http\Resources\Api\MisReport\ShgCommodityResource;
use App\Http\Resources\Api\MisReport\HaatMarketCommodityResource;
use App\Http\Resources\Api\MisReport\StateWiseVdvkProposalResource;
use App\Http\Resources\Api\MisReport\WarehouseCommodityResource;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class MisReportController extends ApiController
{


    private $service;

    public function __construct(MisReportService $misReportService)
    {
        $this->service = $misReportService;
    }

    /*
    return List of Shg Mis Report
    */
    public function getAllShgMisReport(Request $request)
    {
        $this->checkPermission('mis_reports_shg');
        try {
            $items = $this->service->getAllShgMisReport($request->all());
           $items = ShgMisReportResource::collection($items);
             $return = [
            'records' => $items
        ];
            $return = array_merge($return, [
                'count' => $items->count(),
                'total' => $items->total(),
                'current_page' => $items->currentPage(),
                'next' => $items->nextPageUrl(),
                'previous' => $items->previousPageUrl(),
                'per_page' => $items->perPage(),
                'url' => $items->url(null),]
            );
            return $this->respondWithSuccess($return);
        } catch (\Exception $th) {
            return $this->respondNotFound($th);
        }
    }

    public function ExportShgMisReport(Request $request)
    { 
        $this->checkPermission('mis_reports_shg');
       Excel::store(new ShgExportMis, 'public/export-shg-mis.xlsx');
        $data = [
            "file" => "shg/downloadShgExportedExcel"
        ];
        return $this->respondWithSuccess($data);
    }

    public function downloadShgExportedExcel()
    {
        return Storage::download('public/export-shg-mis.xlsx');
    }
    /*
    return List of Mo Mis Report
    */
    public function getMoMisReport(Request $request)
    {
        $this->checkPermission('mis_reports_mo');
        try {
            $item = $this->service->getMoMisReport($request->all());
            $item = MentoringOrganisationMisReportResource::collection($item);
            return $this->respondWithSuccess($item);
        } catch (\Exception $th) {
            return $this->respondNotFound($th);
        }
    }

 public function ExportMoMisReport(Request $request)
    { 
        $this->checkPermission('mis_reports_mo');
       Excel::store(new MoExportMis, 'public/export-mo-mis.xlsx');
        $data = [
            "file" => "user/downloadMoExportedExcel"
        ];
        return $this->respondWithSuccess($data);
    }

    public function downloadMoExportedExcel()
    {
        return Storage::download('public/export-mo-mis.xlsx');
    }
    /*
    return List of VDY Mis Report
    */
    public function getVdvkMisReport(Request $request)
    {
        $this->checkPermission('mis_reports_pmvdy');
        try {
            $item = $this->service->getVdvkMisReport($request->all());
            $item = VdvkMisReportResource::collection($item);
            //print_r($item);
            return $this->respondWithSuccess($item);
        } catch (\Exception $th) {
            return $this->respondNotFound($th);
        }
    }

    public function ExportVdvkMisReport(Request $request)
    { 
        $this->checkPermission('mis_reports_pmvdy');
       Excel::store(new VdvkExportMis, 'public/export-vdvk-mis.xlsx');
        $data = [
            "file" => "haat/downloadVdvkExportedExcel"
        ];
        return $this->respondWithSuccess($data);
    }

    public function downloadVdvkExportedExcel()
    {
        return Storage::download('public/export-vdvk-mis.xlsx');
    }

    public function ExportApprovedVdvkMisReport(Request $request)
    { 
        $this->checkPermission('mis_reports_pmvdy');
       Excel::store(new ApprovedVdvkExportMis, 'public/export-approved-vdvk-mis.xlsx');
        $data = [
            "file" => "haat/downloadApprovedVdvkExportedExcel"
        ];
        return $this->respondWithSuccess($data);
    }

    public function downloadApprovedVdvkExportedExcel()
    {
        return Storage::download('public/export-approved-vdvk-mis.xlsx');
    }

    /*
    return List of Haat Market Mis Report
    */
    public function getHaatMarketMisReport(Request $request)
    {
        $this->checkPermission('mis_reports_haat_bazaar');
        try {
            $item = $this->service->getHaatMarketMisReport($request->all());
            $item = HaatMarketMisReportResource::collection($item);
            return $this->respondWithSuccess($item);
        } catch (\Exception $th) {
            return $this->respondNotFound($th);
        }
    }
    public function ExportHaatMarketMisReport(Request $request)
    {
        $this->checkPermission('mis_reports_haat_bazaar');
       Excel::store(new HaatExportMis, 'public/export-haat-mis.xlsx');
        $data = [
            "file" => "Haat/downloadHaatExportedExcel"
        ];
        return $this->respondWithSuccess($data);
    }

    public function downloadHaatExportedExcel()
    {
        return Storage::download('public/export-haat-mis.xlsx');
    }
    /*
    return List of Warehouse Mis Report
    */
    public function getWarehouseMisReport(Request $request)
    {
        $this->checkPermission('mis_reports_warehouse');
        try {
            $item = $this->service->getWarehouseMisReport($request->all());
            $item = WarehouseMisReportResource::collection($item);
            return $this->respondWithSuccess($item);
        } catch (\Exception $th) {
            return $this->respondNotFound($th);
        }
    }

    public function ExportWarehouseMisReport(Request $request)
    { 
        $this->checkPermission('mis_reports_warehouse');
       Excel::store(new WarehouseExportMis, 'public/export-warehouse-mis.xlsx');
        $data = [
            "file" => "WareHouse/downloadWarehouseExportedExcel"
        ];
        return $this->respondWithSuccess($data);
    }

    public function downloadWarehouseExportedExcel()
    {
        return Storage::download('public/export-warehouse-mis.xlsx');
    }

    public function ExportHaatMarketCommodityMisReport(Request $request)
    {  
        $this->checkPermission('mis_reports_haat_bazaar_commodity');
       Excel::store(new HaatMarketCommodityExportMis, 'public/export-haatmarket-commodity-mis.xlsx');
        $data = [
            "file" => "Haat/downloadHaatMarketCommodityExportedExcel"
        ];
        return $this->respondWithSuccess($data);
    }

    public function downloadHaatMarketCommodityExportedExcel()
    {
        return Storage::download('public/export-haatmarket-commodity-mis.xlsx');
    }

    public function ExportWarehouseCommodityMisReport(Request $request)
    {  
       $this->checkPermission('mis_reports_warehouse_commodity');
       Excel::store(new WarehouseCommodityExportMis, 'public/export-warehouse-commodity-mis.xlsx');
        $data = [
            "file" => "Warehouse/downloadWarehouseCommodityExportedExcel"
        ];
        return $this->respondWithSuccess($data);
    }

    public function downloadWarehouseCommodityExportedExcel()
    {
        return Storage::download('public/export-warehouse-commodity-mis.xlsx');
    }

    public function ExportCommodityMisReport(Request $request)
    {  
        $this->checkPermission('commodity_report');
       Excel::store(new CommodityExportMis, 'public/export-commodity-mis.xlsx');
        $data = [
            "file" => "Commodity/downloadCommodityExportedExcel"
        ];
        return $this->respondWithSuccess($data);
    }

    public function downloadCommodityExportedExcel()
    {
        return Storage::download('public/export-commodity-mis.xlsx');
    }

    /*
    return List of Shg Commodities Mis Report
    */
    public function getAllShgCommodity(Request $request)
    {
        $this->checkPermission('mis_reports_shg_commodity');
        try {
            $items = $this->service->getAllShgMisReport($request->all());
            $items = ShgCommodityResource::collection($items);

             $return = [
            'records' => $items
        ];
            $return = array_merge($return, [
                'count' => $items->count(),
                'total' => $items->total(),
                'current_page' => $items->currentPage(),
                'next' => $items->nextPageUrl(),
                'previous' => $items->previousPageUrl(),
                'per_page' => $items->perPage(),
                'url' => $items->url(null),]
            );
            return $this->respondWithSuccess($return);
        } catch (\Exception $th) {
            return $this->respondNotFound($th);
        }
    }

    public function ExportShgCommodityMisReport(Request $request)
    {
        $this->checkPermission('mis_reports_shg_commodity');
       Excel::store(new ShgCommodityExportMis, 'public/export-shg-commodity-mis.xlsx');
        $data = [
            "file" => "shg/downloadShgCommodityExportedExcel"
        ];
        return $this->respondWithSuccess($data);
    }

    public function downloadShgCommodityExportedExcel()
    {
        return Storage::download('public/export-shg-commodity-mis.xlsx');
    }
    /*
    return List of Haat Market Commodities Mis Report
    */
    public function getAllHaatMarketCommodity(Request $request)
    {
        $this->checkPermission('mis_reports_haat_bazaar_commodity');
        try {
            $item = $this->service->getHaatMarketMisReport($request->all());
            $item = HaatMarketCommodityResource::collection($item);
            return $this->respondWithSuccess($item);
        } catch (\Exception $th) {
            return $this->respondNotFound($th);
        }
    }

    /*
    return List of Warehouse Commodities Mis Report
    */
    public function getWarehouseCommodity(Request $request)
    {
        $this->checkPermission('mis_reports_warehouse_commodity');
        try {
            $item = $this->service->getWarehouseMisReport($request->all());
            $item = WarehouseCommodityResource::collection($item);
            return $this->respondWithSuccess($item);
        } catch (\Exception $th) {
            return $this->respondNotFound($th);
        }
    }

    /*
    return List of VDVK Sanctioned Mis Report
    */
    public function getVdvkSanctionedMisReport(Request $request)
    {
        $this->checkPermission('mis_reports_pmvdy_sanctioned');
        try {
            $item = $this->service->getVdvkSanctionedMisReport($request->all());
            //$item = VdvkMisReportResource::collection($item);
            return $this->respondWithSuccess($item);
        } catch (\Exception $th) {
            return $this->respondNotFound($th);
        }
    }

public function ExportVdvkSanctionedMisReport(Request $request)
    {  
        $this->checkPermission('mis_reports_pmvdy_sanctioned');
       Excel::store(new VdvkSanctionedExportMis, 'public/export-vdvk-sanctioned-mis.xlsx');
        $data = [
            "file" => "vdvk/downloadVdvkSanctionedExportedExcel"
        ];
        return $this->respondWithSuccess($data);
    }

    public function downloadVdvkSanctionedExportedExcel()
    {
        return Storage::download('public/export-vdvk-sanctioned-mis.xlsx');
    }
    /**
     * 3. Number of VDY Project Proposals Sanction Order released with Sanctioned Amount (State wise)
     *
     */
    public function stateWisePmvdyProposal(Request $request)
    {
        $this->checkPermission('mis_reports_state_proposals_sanctioned');
        try {
            $items = $this->service->stateWiseProposals($request->all());
            //$item = VdvkMisReportResource::collection($item);
            //return $this->respondWithSuccess($item);

                    $return = [
            'records' => $items
        ];
            $return = array_merge($return, [
                'count' => $items->count(),
                'total' => $items->total(),
                'current_page' => $items->currentPage(),
                'next' => $items->nextPageUrl(),
                'previous' => $items->previousPageUrl(),
                'per_page' => $items->perPage(),
                'url' => $items->url(null),]
            );
            return $this->respondWithSuccess($return);
        } catch (\Exception $th) {
            return $this->respondNotFound($th);
        }

    }

public function ExportStateProposalMisReport(Request $request)
    {
        $this->checkPermission('mis_reports_state_proposals_sanctioned');
       Excel::store(new StateProposalExportMis, 'public/export-state-proposal-mis.xlsx');
        $data = [
            "file" => "state/downloadStateProposalExportedExcel"
        ];
        return $this->respondWithSuccess($data);
    }

    public function downloadStateProposalExportedExcel()
    {
        return Storage::download('public/export-state-proposal-mis.xlsx');
    }

    /*
    return List of VDVK Sanctioned Mis Report
    */
    public function getAllVdvkFundBalance(Request $request)
    {
        $this->checkPermission('mis_reports_pmvdy_fund_balance');
        try {
            $item = $this->service->getVdvkFundBalance($request->all());
            $item = VdvkFundBalanceListingResource::collection($item);
            return $this->respondWithSuccess($item);
        } catch (\Exception $th) {
            return $this->respondNotFound($th);
        }
    }

    public function ExportVdvkFundbalaceMisReport(Request $request)
    {  
        $this->checkPermission('mis_reports_pmvdy_fund_balance');
       Excel::store(new VdvkFundbalaceExportMis, 'public/export-vdvk-fundbalace-mis.xlsx');
        $data = [
            "file" => "vdvk/downloadVdvkFundbalaceExportedExcel"
        ];
        return $this->respondWithSuccess($data);
    }

    public function downloadVdvkFundbalaceExportedExcel()
    {
        return Storage::download('public/export-vdvk-fundbalace-mis.xlsx');
    }
    /*
    return List of VDY Demo Unit Mis Report
    */
    public function getVdvkDemoUnitMisReport(Request $request)
    {
        $this->checkPermission('mis_reports_view');
        try {
            $item = $this->service->getVdvkDemoUnitMisReport($request->all());
            $item = VdvkMisReportResource::collection($item);
            return $this->respondWithSuccess($item);
        } catch (\Exception $th) {
            return $this->respondNotFound($th);
        }
    }

    /*
     * Return list of approved vdvks
     */
    public function getApprovedVdvkList(Request $request)
    {
        $this->checkPermission('mis_reports_approved_pmvdy');
        try {
            $item = $this->service->getApprovedVdvk($request->all());
            $item = VdvkMisReportResource::collection($item);
            return $this->respondWithSuccess($item);
        } catch (\Exception $th) {
            return $this->respondNotFound($th);
        }
    }

    /*
    return List of Commodities Report
    */
    public function getCommodityReport(Request $request)
    {
        $this->checkPermission('commodity_report');
        try {
            $item = $this->service->getCommodityReport($request->all());
            //print_r($item);
            $item = WarehouseCommodityResource::collection($item);
            return $this->respondWithSuccess($item);
        } catch (\Exception $th) {
            return $this->respondNotFound($th);
        }
    }
}
