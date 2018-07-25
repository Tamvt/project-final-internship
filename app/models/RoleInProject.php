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
	];

	// public function getPO()
	// {
	// 	$POs = DB::select('select * from roleinprojects where project_role_ID = ?', [4]);
	// 	return $POs;
	// }
}
