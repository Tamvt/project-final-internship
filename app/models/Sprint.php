<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Request;
use Illuminate\Support\Facades\DB;

class Sprint extends Model
{

    protected $table = 'sprints';

    protected $fillable = [
        'sprint_name',
        'project_ID',
    ];

    public function getSprint($id)
    {
    	$sprints = DB::select('select * from sprints where project_ID = ?', [$id]);
    	return $sprints;
    }

        public function getSprintID($id)
    {
        $ids = DB::select('select id from sprints where project_ID = ?', [$id]);
        return $ids;
    }
}
