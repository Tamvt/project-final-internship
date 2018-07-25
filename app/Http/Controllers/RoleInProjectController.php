<?php

namespace App\Http\Controllers;

use App\Exceptions\NotFoundException;
use Illuminate\Http\Request;
use App\Models\RoleInProject;

class RoleInProjectController extends Controller
{
	private $modelRoleInProjects;

	public function __construct(RoleInProject $roleInProject)
	{
		$this->modelRoleInProjects = $roleInProject;
	}

	public function addRoleInProject(Request $request){
		$data = $request->all();
		$roleInProject = $this->modelRoleInProjects->fill($data)->save();
		if($roleInProject)
		{
			$success = true;
			return response()->json([
				'success' => $success,
				'data' => $data
			]);
		}
	}

	public function updateRoleInProject(Request $request, $id){
		$roleInProject = $this->modelRoleInProjects->find($id);
		if (!$roleInProject) {
			return response()->json(['error' => 'NOT_FOUND_ERROR']);
		}    
		$data = $request->all();
		$da = $roleInProject->update($data);
		if($da){
			$success = true;
			return response()->json([
				'success' => $success,
				'data' => $data
			]);
		}    
	}

	public function deleteRoleInProject($id)
	{
		$roleInProject = $this->modelRoleInProjects->find($id);
		if (!$roleInProject) {
			return response()->json(['error' => 'NOT_FOUND_ERROR']);
		}
		$data = $roleInProject->delete();
		if($data){
			$success = true;
			return response()->json([
				'success' => $success
			]);
		}
	}

	public function getAllRoleInProject(){
		$roleInProjects = $this->modelRoleInProjects->all();
		if($roleInProjects){
			$success = true;
			return response()->json([
				'success' => $success,
				'data' => $roleInProjects
			]);
		}
		return response()->json(['error' => 'NOT_FOUND_ERROR']);
	}

	public function getRoleInProject($id){
		$roleInProject = $this->modelRoleInProjects->find($id);
		if (!$roleInProject) {
			return response()->json(['error' => 'NOT_FOUND_ERROR']);
		}
		$success = true;
		return response()->json([
			'success' => $success,
			'data' => $roleInProject
		]);
	}

}
