<?php

namespace App\Http\Middleware;

use Closure;

class TradersAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = $request->user();   
            switch ($request->method()) {
                case 'POST':
                    if (!in_array($user->role, [11])) {
                        $this->abortRequest();
                    }
                    break;
                case 'PUT':
                    if (!in_array($user->role, [11])) {
                        $this->abortRequest();
                    }
                break;

                

                default:
                // invalid request
                break;
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
