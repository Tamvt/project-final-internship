<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Request;
use Illuminate\Support\Facades\DB;

class RoleInProject extends Model
{

	protected $table = 'roleinprojects';

	protected $fillable = [
		'project_ID',
		'project_role_ID',
		'user_ID',
	];

	public function getsProjectID($id)
	{
		$ids = DB::select('select project_ID from roleinprojects where user_ID = ?', [$id]);
		return $ids;
	}

	public function checkRoleInProject($id)
	{
		$role = DB::select('select project_role_ID from roleinprojects where user_ID = ?', [$id]);
		return $role;
	}
}
