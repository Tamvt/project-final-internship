<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Request;
use Illuminate\Support\Facades\DB;

class Task extends Model
{

    protected $table = 'tasks';

    protected $fillable = [
        'task_name',
        'sprint_ID',
    ];

    public function getProjectTask($id)
    {
    	$tasks = DB::select('select * from tasks where project_ID = ?', [$id]);
    	return $tasks;
    }

        public function getsprintTask($id)
    {
    	$tasks = DB::select('select * from tasks where sprint_ID = ?', [$id]);
    	return $tasks;
    }
}
