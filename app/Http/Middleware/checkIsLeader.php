<?php
declare(strict_types = 1);

namespace App\Http\Middleware;

use Closure;

class checkIsLeader
{
    private const IS_LEADER = 1;

    public function handle($request, \Closure $next)
    {
        $getRoleIsUserLogin = auth()->user()->project_role_ID;
        if($getRoleIsUserLogin == self::IS_LEADER)
            return $next($request);
        return response()->json([ 'status'=> 'PERMISSION_DENIED']);
    }
}
