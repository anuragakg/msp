<?php

namespace App\Http\Middleware;

use Closure;
/**
 * This middleware restricts surveyor and supervisor based on their specified
 * action they have opted for
 * 1 = SHG Gatherer
 * 2 = HaatBazaar
 * 3 = Warehouse
 * 
 * The request will be terminated if the user does not have specified action.
 * 
 * Further access create or update will be handled by permissions.
 */
class SurveyorSupervisorAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param string $action Action enum of 1,2,3
     * @return mixed
     */
    public function handle($request, Closure $next, $action)
    {

        $user = $request->user();   

        if (in_array($user->role, [11,12])) {

            $details = $user->getSurveyorSupervisorDetails;

            if (!$details) {
                $this->abortRequest();
            }

            /** Surveyor */
            if ($user->role == 11) {
                if (!in_array($action, $details->survey_for)) {
                    $this->abortRequest();
                }
            }

            /** Supervisor */
            if ($user->role == 12) {
                if (!in_array($action, $details->supervising_for)) {
                    $this->abortRequest();
                }
            }
        }

        return $next($request);
    }

    private function abortRequest()
    {
        $res = response([
            'status' => 0,
            'message' => 'You are not allowed to perform this action'
        ], 403);

        abort($res);
    }
}
