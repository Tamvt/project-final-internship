<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Request;
use Illuminate\Support\Facades\DB;

class Project extends Model
{

	protected $table = 'projects';

	protected $fillable = [
		'project_name',
		'description',
	];

	public function getsProjects($id)
	{
		$projects = DB::select('select * from projects where id = ?', [$id]);
		return $projects;
	}
}
