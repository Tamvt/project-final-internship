<?php

namespace App\Http\Controllers;

use App\Exceptions\NotFoundException;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Sprint;
use validator;

class TaskController extends Controller
{
	private $modelTasks;
	private $modelSprints;

	public function __construct(Task $task, Sprint $sprint)
	{
		$this->modelTasks = $task;
		$this->modelSprints = $sprint;
	}

	public function addTask(Request $request, $sprint_ID){
		$rules = 
		[
			'task_name' => 'required|unique:tasks'
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
			'task_name' => $request->get('task_name')
		];
		$task = $this->modelTasks->fill($data)->save();
		if($task)
		{
			$success = true;
			return response()->json([
				'success' => $success,
				'data' => $data
			]);
		}
	}

	public function updateTask(Request $request, $id){
		$task = $this->modelTasks->find($id);
		if (!$task) {
			return response()->json(['error' => 'NOT_FOUND_ERROR']);
		}
		$rules = 
		[
			'task_name' => 'required|unique:tasks'
		];
		$validator = \Validator::make($request->all(), $rules);
		if ($validator->fails()) {
			$success = false;
			return response()->json([
				'success' => $success,
				'error' => 'INVALID_INPUT_VALUE_ERROR'
			]);
		}
		$data = $request->all();
		$da = $task->update($data);
		if($da){
			$success = true;
			return response()->json([
				'success' => $success,
				'data' => $data
			]);
		}    
	}

	public function deleteTask($id)
	{
		$task = $this->modelTasks->find($id);
		if (!$task) {
			return response()->json(['error' => 'NOT_FOUND_ERROR']);
		}
		$data = $task->delete();
		if($data){
			$success = true;
			return response()->json([
				'success' => $success
			]);
		}
	}

	public function getAllTask(){
		$tasks = $this->modelTasks->all();
		if($tasks){
			$success = true;
			return response()->json([
				'success' => $success,
				'data' => $tasks
			]);
		}
		return response()->json(['error' => 'NOT_FOUND_ERROR']);
	}

	public function getTask($id){
		$task = $this->modelTasks->find($id);
		if (!$task) {
			return response()->json(['error' => 'NOT_FOUND_ERROR']);
		}
		$success = true;
		return response()->json([
			'success' => $success,
			'data' => $task
		]);
	}

	public function getSprintTask($id){
		$task = $this->modelTasks->getSprintTask($id);
		if (!$task) {
			return response()->json(['error' => 'NOT_FOUND_ERROR']);
		}
		$success = true;
		return response()->json([
			'success' => $success,
			'data' => $task
		]);
	}

	public function getProjectTask($id){
		$ids = $this->modelSprints->getSprintID($id);
		$data = array();
		foreach ($ids as $sprint_ID) {
			$s_id = $sprint_ID->id;
			$tasks = $this->modelTasks->getSprintTask($s_id);
			if($tasks){
				foreach ($tasks as $task) {
					array_push($data, $task);
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
