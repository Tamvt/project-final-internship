<?php

namespace App\Http\Controllers;

use App\Exceptions\NotFoundException;
use Illuminate\Http\Request;
use App\Models\Sprint;

class SprintController extends Controller
{
	private $modelSprints;

	public function __construct(Sprint $sprint)
	{
		$this->modelSprints = $sprint;
	}

	public function addSprint(Request $request, $project_ID){
		$rules = 
		[
			'sprint_name' => 'required|unique:sprints'
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
			'project_ID' => $project_ID,
			'sprint_name' => $request->get('sprint_name')
		];
		$sprint = $this->modelSprints->fill($data)->save();
		if($sprint)
		{
			$success = true;
			return response()->json([
				'success' => $success,
				'data' => $data
			]);
		}
	}

	public function updateSprint(Request $request, $id){
		$sprint = $this->modelSprints->find($id);
		if (!$sprint) {
			return response()->json(['error' => 'NOT_FOUND_ERROR']);
		}    
		$rules = 
		[
			'sprint_name' => 'required|unique:sprints'
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
			'project_ID' => $project_ID,
			'sprint_name' => $request->get('sprint_name')
		];
		$data = $request->all();
		$da = $sprint->update($data);
		if($da){
			$success = true;
			return response()->json([
				'success' => $success,
				'data' => $data
			]);
		}    
	}

	public function deleteSprint($id)
	{
		$sprint = $this->modelSprints->find($id);
		if (!$sprint) {
			return response()->json(['error' => 'NOT_FOUND_ERROR']);
		}
		$data = $sprint->delete();
		if($data){
			$success = true;
			return response()->json([
				'success' => $success
			]);
		}
	}

	public function getAllSprint(){
		$sprints = $this->modelSprints->all();
		if($sprints){
			$success = true;
			return response()->json([
				'success' => $success,
				'data' => $sprints
			]);
		}
		return response()->json(['error' => 'NOT_FOUND_ERROR']);
	}

	public function getSprint($id){
		$sprint = $this->modelSprints->find($id);
		if (!$sprint) {
			return response()->json(['error' => 'NOT_FOUND_ERROR']);
		}
		$success = true;
		return response()->json([
			'success' => $success,
			'data' => $sprint
		]);
	}

	public function getProjectSprint($id){
		$sprint = $this->modelSprints->getSprint($id);
		if (!$sprint) {
			return response()->json(['error' => 'NOT_FOUND_ERROR']);
		}
		$success = true;
		return response()->json([
			'success' => $success,
			'data' => $sprint
		]);
	}
}
