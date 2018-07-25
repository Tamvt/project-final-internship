<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Request;
use Illuminate\Support\Facades\DB;

class Allocation extends Model
{

    protected $table = 'allocations';

    protected $fillable = [
        'time',
        'effort',
        'effort',
        'sprint_ID',
    ];

    public function getsprintAllocation($id)
    {
    	$allocations = DB::select('select * from allocations where sprint_ID = ?', [$id]);
    	return $allocations;
    }

    public function getProjectAllocation($id)
    {
        $allocations = DB::select('select * from allocations where sprint_ID = ?', [$id]);
        return $allocations;
    }
}
