<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Support\Facades\Auth;


use Illuminate\Support\Facades\Mail;
use App\Mail\GenericMail;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\V1\ApiController;
use App\Http\Resources\Api\UserResource as ApiResource;
use App\Http\Resources\Api\UserDetailResource;
use App\Http\Resources\Api\UserDetailWithHaatResource;
use App\Http\Resources\Api\MoSupervisorResource;
use App\Http\Resources\Api\Masters\HaatMasterResource;
use App\Models\UserRole;
use App\Services\UserService;

use App\Exports\UsersExport;
use App\Exports\UsersReportExport;
use Illuminate\Support\Facades\Storage;
use App\Imports\UserManagementImport;
use App\Exports\AreaMasterExport;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends ApiController
{

    protected $service;

    public function __construct(UserService $userService)
    {
        $this->service = $userService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->checkPermission('user_management_view');
        $request = $request->all();
       
        $items = $this->service->getAll($request);


        $items = ApiResource::collection($items);
       
        $return=array(
            'count' => $items->count(),
            'total' => $items->total(),
            'current_page' => $items->currentPage(),
            'next' => $items->nextPageUrl(),
            'previous' => $items->previousPageUrl(),
            'per_page' => $items->perPage(),
            'url' => $items->url(null),
            'data'=>$items
        );
        $json_data = array(
                    "draw"            => intval($request['draw']),  
                    "recordsTotal"    => $items->total(),  
                    "recordsFiltered" => $items->total(), 
                    "data"            => $items,
                    'current_page' => $items->currentPage(),
                    'next' => $items->nextPageUrl(),
                    'previous' => $items->previousPageUrl(),
                    'per_page' => $items->perPage(),   
                    );
            
        /*echo json_encode($json_data);die;*/
        return $this->respondWithSuccess($json_data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->checkPermission('user_management_add');
        $valid = $this->service->validateCreate($request->all());


        if ($valid->fails()) {
            return $this->respondWithValidationError($valid);
        }

        $data = $valid->validated();

        $authUser = Auth::user();
        

        $data['status'] = 1; // By default status is 1.
        $data['created_by'] = $authUser->id;
        $data['updated_by'] = $authUser->id;

        $item = $this->service->createItem($data);

        $item = ApiResource::make($item);
        
        return $this->respondWithSuccess($item);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->checkPermission('user_management_view');
        //try {

            $item = $this->service->getOne($id);

            $item = UserDetailResource::make($item);

            return $this->respondWithSuccess($item);
        //} catch (\Exception $th) {
            return $this->respondNotFound();
        //}
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->checkPermission('user_management_edit');
        $valid = $this->service->validateUpdate($id, $request->all());

        if ($valid->fails()) {
            return $this->respondWithValidationError($valid);
        }

        $data = $valid->validated();

        //try {
            $data['updated_by'] = Auth::user()->id;
            $item = $this->service->updateItem($id, $data);

            $item = UserDetailResource::make($item);

            return $this->respondWithSuccess($item);
        //} catch (\Throwable $th) {
            return $this->respondNotFound();
        //}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->checkPermission('user_management_status');
        // TODO: Actual Implementation of showing one resource.
        return $this->respondNotFound();
        try {
            $res = $this->service->deleteItem($id);

            if ($res) {
                /** If item is deleted successfully */
                return $this->respondWithSuccess('Item Deleted');
            }

            /** If failed to delete item from db */
            return $this->respondWithError('Could not delete item');
        } catch (\Throwable $th) {
            return $this->respondNotFound();
        }
    }

    public function updateStatus($id)
    {
        $this->checkPermission('user_management_status');
        try {
            $res = $this->service->switchStatus($id);
            return $this->respondWithSuccess([
                'message' => ($res == 1) ? 'Account Activated' : 'Account Deactivated',
                'status' => (int) $res
            ]);
        } catch (\Throwable $th) {
            return $this->respondNotFound();
        }
    }

    public function export()
    {
        $this->checkPermission('user_management_view');
        Excel::store(new UsersExport, 'public/export-users.xlsx');
        $data = [
            "file" => "user/downloadExportedExcel"
        ];
        return $this->respondWithSuccess($data);
    }

    public function downloadExportedExcel()
    {
        return Storage::download('public/export-users.xlsx');
    }

    public function importExcel(Request $request)
    {
        $this->checkPermission('user_management_add');
        $fileName = $request->import_file->getClientOriginalName();
        $path = Storage::disk('local')->putFileAs('temp', $request->import_file, $fileName);

        try{
            $data=Excel::import(new UserManagementImport, storage_path('app') . '/' . $path);
        }catch (\Throwable $e) {

            return $this->respondWithError($e);
        }
        
        Storage::disk('local')->delete($path);
        return $this->respondWithSuccess('Excel Imported Successfully');
        try {
        } catch (\Throwable $th) {
            return $this->respondNotFound();
        }
    }

    public function downloadExcel()
    {
        return Storage::download('user/user.xlsx');
    }

    public function moSupervisorListing()
    {
        $this->checkPermission('user_management_view');
        try {
            $item = $this->service->getMo();
            $i = 0;
            foreach ($item as $supervisor) {
                $item[$i]['supervisor'] = $this->service->getSupervisor($supervisor['id']);
                $i++;
            }
            return $this->respondWithSuccess($item);
        } catch (\Exception $th) {
            return $this->respondNotFound();
        }
    }

    public function surveyorSupervisorListing()
    {
        $this->checkPermission('user_management_view');
        try {
            $item = $this->service->getMo();
            $i = 0;
            foreach ($item as $supervisor) {
                $item[$i]['supervisor'] = $this->service->getSupervisor($supervisor['id']);
                $i++;
            }
            return $this->respondWithSuccess($item);
        } catch (\Exception $th) {
            return $this->respondNotFound();
        }
    }

     public function SearchSurveyor(Request $request)    {
        $filters = $request->all();
        if(isset($filters['keyword'])){
        $item = $this->service->SearchSurveyor($filters);
        $item = ApiResource::collection($item);    
        return $this->respondWithSuccess($item);
        }
    }

    public function getEvaluationUser()
    {
        $this->checkPermission('user_management_view');
        try {
            $item = $this->service->getEvaluation(); // Fetch Evaluation user
            return $this->respondWithSuccess($item);
        } catch (\Exception $th) {
            return $this->respondNotFound();
        }
    }
    /**
     * Display the specified resource By RoleId.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getInspectionUser()
    {
        $this->checkPermission('user_management_view');
        try {

            $item = $this->service->getInspectionUser();

            //$item = UserDetailResource::make($item);

            return $this->respondWithSuccess($item);
        } catch (\Exception $th) {
            return $this->respondNotFound();
        }
    }

    public function masterExport()
    {
        Excel::store(new AreaMasterExport, 'public/area-master.xlsx');
        $data = [
            "file" => "area/downloadMasterExcel"
        ];
        return $this->respondWithSuccess($data);
    }

    public function downloadMasterExcel()
    {
        return Storage::download('public/area-master.xlsx');
    }

     public function getUserActivityLog()
    {
        $items = $this->service->getUserActivityLog();
        //echo '<pre>';print_r($items);die;
        $items_array=$items->toArray();
        $return = [
            'count' => $items->count(),
            'total' => $items->total(),
            'current_page' => $items->currentPage(),
            'next' => $items->nextPageUrl(),
            'previous' => $items->previousPageUrl(),
            'pages' => $items->getUrlRange(0, 10),
            'per_page' => $items->perPage(),
            'url' => $items->url(null),
            'data' => $items_array['data'],
            
        ]; 

        //$items = ApiResource::collection($items);
        return $this->respondWithSuccess($return);
    }
    public function getSndSio()
    {
        $data['sio']=array();
        $data['snd']=array();
        $data['mo']=array();
        $items = $this->service->getSndSio();
        $items = $items->groupBy('role');
        if(isset($items['7']))//sio
        {
            $data['sio'] = ApiResource::collection($items['7']);    
        }
        if(isset($items['4']))//snd user
        {
            $data['snd'] = ApiResource::collection($items['4']);    
        }
        if(isset($items['8']))//mo users added
        {
            $data['mo'] = ApiResource::collection($items['8']);    
        }
        
        
        return $this->respondWithSuccess($data);
    }

    public function userManagementlistWiseState(Request $request)
    {
        $items = $this->service->getUserslistWiseState($request->all());

        //$items = ApiResource::collection($items);

        return $this->respondWithSuccess($items);
    }

    public function user_report_export()
    {
        Excel::store(new UsersReportExport, 'public/daily_report/users_report.xlsx');
        $data = [
            "file" => "report/downloadUserReportExcel"
        ];
        return $this->respondWithSuccess($data);
    }
    public function downloadUserReportExcel()
    {
        return Storage::download('public/daily_report/users_report.xlsx');
    }
    public function addUserPermissions(Request $request)
    {
        $this->checkPermission('user_management_set_user_wise_permission');
        $valid = $this->service->validateUserPermissionCreate($request->all());

        if ($valid->fails()) {
            return $this->respondWithValidationError($valid);
        }

        $data = $valid->validated();
        try {
            $res = $this->service->addUserPermissions($data);

            return $this->respondWithSuccess($res);
        }catch (\Throwable $th) {
            return $this->respondWithError('Error Creating Resource');
        }
    }
    public function getUserPermissions($user_id)
    {

        $items = $this->service->getUserPermissions($user_id);

        //$items = ApiResource::collection($items);

        return $this->respondWithSuccess($items);
    }

      public function getUserPermissionsRoleBasis($user_id)
    {
        $items = $this->service->getUserPermissionsRoleBasis($user_id); 
        return $this->respondWithSuccess($items);
    }

    public function getCurrentUserHaatInfo()
    {

        try {

            $item = $this->service->getCurrentUserHaatInfo();
                
            $item = HaatMasterResource::collection($item);

            return $this->respondWithSuccess($item);
        } catch (\Exception $th) {
            return $this->respondNotFound();
        }
    }
}
