<?php
declare(strict_types = 1);

namespace App\Http\Middleware;
use App\Models\UserRole;
use Closure;

class checkIsPM
{
	private const IS_ADMIN = 1;
	private $modelUserRoles;

	public function __construct(UserRole $userRole)
	{
		$this->modelUserRoles = $userRole;
	}

	public function handle($request, \Closure $next)
	{
		$user_ID = auth()->user()->id;
		$roles = $this->modelUserRoles->checkUserRole($user_ID);
		foreach ($roles as $role) {
			$u_role = $role->role_ID;
			if($u_role == self::IS_PM)
				return $next($request);
		}
		return response()->json([ 'status'=> 'PERMISSION_DENIED']);
	}
}
