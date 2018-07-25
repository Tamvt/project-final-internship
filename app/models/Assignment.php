<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Request;
use Illuminate\Support\Facades\DB;

class Assignment extends Model
{

	protected $table = 'assignments';

	protected $fillable = [
		'user_ID',
		'task_ID',
	];

}
