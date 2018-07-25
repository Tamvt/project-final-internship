<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Request;
use Illuminate\Support\Facades\DB;

class UserRole extends Model
{

	protected $table = 'userroles';

	protected $fillable = [
		'user_ID',
		'role_ID',
	];

	public function checkUserRole($id)
	{
		$role = DB::select('select role_ID from userroles where user_ID = ?', [$id]);
		return $role;
	}
}
