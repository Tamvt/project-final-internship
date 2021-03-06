<?php
declare(strict_types = 1);

namespace App\Http\Middleware;
use App\Models\RoleInProject;
use Closure;

class checkIsPM
{
	private const IS_LEADER = 1;
	private $modelRoleInProjects;

	public function __construct(RoleInProject $roleInProject)
	{
		$this->modelRoleInProjects = $roleInProject;
	}

	public function handle($request, \Closure $next)
	{
		$user_ID = auth()->user()->id;
		$roles = $this->modelRoleInProjects->checkRoleInProject($user_ID);
		foreach ($roles as $role) {
			$u_role = $role->project_role_ID;
			if($u_role == self::IS_LEADER)
				return $next($request);
		}
		return response()->json([ 'status'=> 'PERMISSION_DENIED']);
	}
}
