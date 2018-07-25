<?php
declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Contracts\responseStructure;
use App\Exceptions\NotFoundException;
use App\Http\Controllers\Requests\ApiAddProjectRequest;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\RoleInProject;
use validator;

class ProjectController extends Controller
{
	private $modelProjects;
	private $modelRoleInProjects;

	public function __construct(Project $project, RoleInProject $roleInProject)
	{
		$this->modelProjects = $project;
		$this->modelRoleInProjects = $roleInProject;
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

	public function getUserProject($id){
		$project_ID = $this->modelRoleInProjects->getsProjectID($id);
		$data = array();
		foreach ($project_ID as $id) {
			$p_id = $id->project_ID;
			$projects = $this->modelProjects->getsProjects($p_id);
			if($projects){
				foreach ($projects as $project) {
					array_push($data, $project);
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
