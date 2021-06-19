<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use App\Lib\RouteActions;
use App\Models\UsersActivity;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

/**
 * Api Controller
 */
class ApiController extends Controller
{
    protected $statusCode = 200;

    protected $thresholdTime = 18000;

    /**
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }


    /**
     * @param mixed $statusCode
     *
     * @return self
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode =  $statusCode;

        return $this;
    }


    /**
     * @param string $message
     *
     * @return mixed
     */
    public function respondNotFound($message = "Not found!")
    {
        if ($message instanceof \Exception) {
            if (config('app.env') == 'production') {
                Log::error($message->getMessage(), ['stack' => $message->getTraceAsString()]);
                return $this->respondInternalError('Server Error Occurred!');
            }
            throw $message;
        }
        return $this->setStatusCode(404)->respondWithError($message);
    }

    /**
     * @param string $message
     *
     * @return mixed
     */
    public function respondWithUnauthorized($message = "Unauthorized")
    {
        return $this->setStatusCode(401)->respondWithError($message);
    }

    public function respondWithPermissionDenied($message = "You are not allowed to perform this action")
    {
        return $this->setStatusCode(403)->respondWithError($message);
    }


    /**
     * @param string $message
     *
     * @return mixed
     */
    public function respondInternalError($message = "Internal Error!")
    {
        return $this->setStatusCode(500)->respondWithError($message);
    }


    /**
     * @param string $message
     *
     * @return mixed
     */
    public function respondWithError($message)
    {
        if ($message instanceof \Exception) {
            if (config('app.env') == 'production') {
                Log::error($message->getMessage(), ['stack' => $message->getTraceAsString()]);
                return $this->respondInternalError('Server Error Occurred!');
            }
            throw $message;
        }
        return $this->respond([
            'status' => 0,
            'message' => $message
        ]);
    }


    /**
     * @param string $message
     *
     * @return mixed
     */
    public function respondWithSuccess($data)
    {
        return $this->respond([
            'status' => 1,
            'data' => $data
        ]);
    }


    /**
     * @param $data
     *
     * @param array $headers
     *
     * @return mixed
     */
    public function respond($data, $headers = [])
    {
        return response()->json($data, $this->getStatusCode(), $headers);
    }

    public function respondWithValidationError($validator)
    {
        if (gettype($validator) == 'string') {
            return $this->setStatusCode(422)->respondWithError($validator);
        }

        return $this->setStatusCode(422)->respondWithError($validator->errors()->first());
    }

    /**
     * Checks whether the user is allowed to perform action or not.
     * 
     * This method needs to be called in every controller action for protection against 
     * unwanted users.
     * 
     * @param string $name Permission alias
     * @return void
     */
    public function checkPermission($permissionName = null)
    {
        $getUser = Auth::user();
       
        /**
         * If user object is empty or un-authenticated 
         * Throw permission denied error
         */
        if (!$getUser) {
            abort(
                $this->respondWithPermissionDenied()
            );
        }

        $this->checkActivity($getUser);

        /**
         * If super admin allow access to all resources
         */
        if ($getUser->role == 1) {
            $this->addActivity();
            return;
        }
        
        if (in_array($permissionName,['master_management_view','role_view'])) {
            $this->addActivity();
            return;
        }
        $userPermissions=$getUser->getUserPermissions;
      
        if(empty($userPermissions->toArray()))
        {
            $userPermissions = $getUser->getPermissions;
        }

        $mapped = $userPermissions->map(function ($v) {
            return $v->alias;
        });

        $mappedPermissions = $mapped->toArray();

        /** Gets the current route name finally resolving to */
        $routeName = Route::currentRouteName();

        /**
         * In case of mulitple permission.
         */
        if (is_array($permissionName)) {
            $notAllowed = true;
            foreach ($permissionName as $permission) {
                if (in_array($permission, $mappedPermissions)) {
                    $notAllowed = false;
                }
            }
            if ($notAllowed) {
                abort(
                    $this->respondWithPermissionDenied()
                );
            }
            $this->addActivity();
            return;
        }

        if (!in_array($permissionName, $mappedPermissions)) {
            /**
             * Response will be aborted if the specified route name is not
             * mapped to any permission or the permission is not assigned to 
             * specified user.
             */
            abort(
                $this->respondWithPermissionDenied()
            );
        }

        $this->addActivity();
    }

    /**
     * Checks whether a particular route can be accessed by a collection of roles.
     *
     * @param int|array $roles
     * @return boolean
     */
    public function checkRole($roles)
    {

        $getUser = Auth::user();

        if (!$getUser) {
            abort(
                $this->respondWithPermissionDenied()
            );
        }

        if ($getUser->role == 1) {
            return;
        }

        if (is_array($roles)) {
            if (!in_array($getUser->role, $roles)) {
                return abort(
                    $this->respondWithPermissionDenied()
                );
            }
            return;
        }

        if ($getUser->role != $roles) {
            return abort(
                $this->respondWithPermissionDenied()
            );
        }
    }

    /**
     * Add user activity
     * 
     * Used for adding log entries of user what type of action they are performing. 
     * 
     * @return void 
     */
    public function addActivity()
    {

        $auth = Auth::user();

        $routeName = Route::getCurrentRoute()->getName();

        if (!$routeName) {
            return;
        }

        $mapping = new RouteActions();

        $activity = $mapping->get($routeName);

        if (!$activity) {
            return;
        }

        $users_activity = array(
            'user_id' => $auth->id,
            'ip_address' => $_SERVER['REMOTE_ADDR'],
            'activity' => $activity,
        );
        $user_activity = new UsersActivity($users_activity);
        $user_activity->save();
    }

    public function checkActivity($auth)
    {
        $activity = $auth->getActivity()->orderBy('created_at', 'desc')->first();

        $diff_in_minutes = now()->diffInSeconds($activity->created_at);

        if ($diff_in_minutes > $this->thresholdTime) {
            $auth->token()->revoke();
            return abort($this->respondWithUnauthorized());
        }
    }

    public function getResourceData($item)
    {
        $item=json_encode($item);
        $array=  collect(json_decode($item,true));
        return $array->toArray(); 
    }
}
