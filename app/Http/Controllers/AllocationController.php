<?php

namespace App\Http\Controllers;

use App\Exceptions\NotFoundException;
use Illuminate\Http\Request;
use App\Models\Allocation;
use App\Models\Sprint;

class AllocationController extends Controller
{
	private $modelAllocations;
	private $modelSprints;

	public function __construct(Allocation $allocation, Sprint $sprint)
	{
		$this->modelAllocations = $allocation;
		$this->modelSprints = $sprint;
	}

	public function addAllocation(Request $request, $sprint_ID){
		$rules = 
		[
			'time' => 'required|gt:0',
			'effort' => 'required|gt:0'
		];
		$validator = \Validator::make($request->all(), $rules);
		if ($validator->fails()) {
			$success = false;
			return response()->json([
				'success' => $success,
				'error' => 'INVALID_INPUT_VALUE_ERROR'
			]);
		}
		$data =
		[
			'sprint_ID' => $sprint_ID,
			'time' => $request->get('time'),
			'effort' => $request->get('effort')
		];
		$allocation = $this->modelAllocations->fill($data)->save();
		if($allocation)
		{
			$success = true;
			return response()->json([
				'success' => $success,
				'data' => $data
			]);
		}
	}

	public function updateAllocation(Request $request, $id){
		$allocation = $this->modelAllocations->find($id);
		if (!$allocation) {
			return response()->json(['error' => 'NOT_FOUND_ERROR']);
		}    
		$data = $request->all();
		$da = $allocation->update($data);
		if($da){
			$success = true;
			return response()->json([
				'success' => $success,
				'data' => $data
			]);
		}    
	}

	public function deleteAllocation($id)
	{
		$allocation = $this->modelAllocations->find($id);
		if (!$allocation) {
			return response()->json(['error' => 'NOT_FOUND_ERROR']);
		}
		$data = $allocation->delete();
		if($data){
			$success = true;
			return response()->json([
				'success' => $success
			]);
		}
	}

	public function getAllAllocation(){
		$allocations = $this->modelAllocations->all();
		if($allocations){
			$success = true;
			return response()->json([
				'success' => $success,
				'data' => $allocations
			]);
		}
		return response()->json(['error' => 'NOT_FOUND_ERROR']);
	}

	public function getallocation($id){
		$allocation = $this->modelAllocations->find($id);
		if (!$allocation) {
			return response()->json(['error' => 'NOT_FOUND_ERROR']);
		}
		$success = true;
		return response()->json([
			'success' => $success,
			'data' => $allocation
		]);
	}

	public function getSprintAllocation($id){
		$allocation = $this->modelAllocations->getsprintAllocation($id);
		if (!$allocation) {
			return response()->json(['error' => 'NOT_FOUND_ERROR']);
		}
		$success = true;
		return response()->json([
			'success' => $success,
			'data' => $allocation
		]);
	}

	public function getProjectAllocation($id){
		$ids = $this->modelSprints->getSprintID($id);
		$data = array();
		foreach ($ids as $sprint_ID) {
			$s_id = $sprint_ID->id;
			$allocations = $this->modelAllocations->getSprintAllocation($s_id);
			if($allocations){
				foreach ($allocations as $allocation) {
					array_push($data, $allocation);
				}
			}	
		}
		if (!$data) {
			return response()->json(['error' => 'NOT_FOUND_ERROR']);
		}
		$success = true;
		return response()->json([
			'success' => $success,
			'data' => $data
		]);
	}
}
