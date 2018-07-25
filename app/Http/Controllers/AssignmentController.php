<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assignment;

class AssignmentController extends Controller
{
    private $modelAssignments;

	public function __construct(Assignment $assignment)
	{
		$this->modelAssignments = $assignment;
	}

	public function addAssignment(Request $request){
		$data = $request->all();
		$assignment = $this->modelAssignments->fill($data)->save();
		if($assignment)
		{
			$success = true;
			return response()->json([
				'success' => $success,
				'data' => $data
			]);
		}
	}

	public function updateAssignment(Request $request, $id){
		$assignment = $this->modelAssignments->find($id);
		if (!$assignment) {
			return response()->json(['error' => 'NOT_FOUND_ERROR']);
		}
		$data = $request->all();
		$da = $assignment->update($data);
		if($da){
			$success = true;
			return response()->json([
				'success' => $success,
				'data' => $data
			]);
		}    
	}

	public function deleteAssignment($id){
		$assignment = $this->modelAssignments->find($id);
		if (!$assignment) {
			return response()->json(['error' => 'NOT_FOUND_ERROR']);
		}
		$data = $assignment->delete();
		if($data){
			$success = true;
			return response()->json([
				'success' => $success
			]);
		}
	}

	public function getAllAssignment(){
		$assignments = $this->modelAssignments->all();
		if($assignments){
			$success = true;
			return response()->json([
				'success' => $success,
				'data' => $assignments
			]);
		}
		return response()->json(['error' => 'NOT_FOUND_ERROR']);
	}

	public function getAssignment($id){
		$assignment = $this->modelAssignments->find($id);
		if (!$assignment) {
			return response()->json(['error' => 'NOT_FOUND_ERROR']);
		}
		$success = true;
		return response()->json([
			'success' => $success,
			'data' => $assignment
		]);
	}
}
