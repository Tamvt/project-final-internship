<?php
declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Contracts\responseStructure;
use App\Exceptions\NotFoundException;
use App\Http\Controllers\Requests\ApiAddProjectRequest;
use Illuminate\Http\Request;
use App\Models\Project;
use validator;

class ProjectController extends Controller
{
	private $modelProjects;

	public function __construct(Project $project)
	{
		$this->modelProjects = $project;
	}

	public function addProject(Request $request){
		$rules = 
		[
			'project_name' => 'required|unique:projects'
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
		$project = $this->modelProjects->fill($data)->save();
		if($project)
		{
			$success = true;
			return response()->json([
				'success' => $success,
				'data' => $data
			]);
			//return $this->responseSuccess($data);
		}
		//throw new NotFoundException(trans('messages.project.create_fail'));
	}

	public function updateProject(Request $request, $id){
		$project = $this->modelProjects->find($id);
		if (!$project) {
			return response()->json(['error' => 'NOT_FOUND_ERROR']);
		}    
		$rules = 
		[
			'project_name' => 'required|unique:projects'
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
		$da = $project->update($data);
		if($da){
			$success = true;
			return response()->json([
				'success' => $success,
				'data' => $data
			]);
		}    
		//throw new NotFoundException(trans('messages.project.create_fail'));
	}

	public function deleteProject($id)
	{
		$project = $this->modelProjects->find($id);
		if (!$project) {
			return response()->json(['error' => 'NOT_FOUND_ERROR']);
		}
		$data = $project->delete();
		if($data){
			$success = true;
			return response()->json([
				'success' => $success
			]);
		}
	}

	public function getAllProject(){
		$projects = $this->modelProjects->all();
		if($projects){
			$success = true;
			return response()->json([
				'success' => $success,
				'data' => $projects
			]);
		}
		return response()->json(['error' => 'NOT_FOUND_ERROR']);
	}
	public function getProject($id){
		$project = $this->modelProjects->find($id);
		if (!$project) {
			return response()->json(['error' => 'NOT_FOUND_ERROR']);
		}
		$success = true;
		return response()->json([
			'success' => $success,
			'data' => $project
		]);
	}
}
