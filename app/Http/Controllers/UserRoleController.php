<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserRole;
use App\Models\Sprint;
use validator;

class UserRoleController extends Controller
{
	private $modelUserRoles;

	public function __construct(UserRole $userRole)
	{
		$this->modelUserRoles = $userRole;
	}

	public function addUserRole(Request $request){
		$data = $request->all();
		$userRole = $this->modelUserRoles->fill($data)->save();
		if($userRole)
		{
			$success = true;
			return response()->json([
				'success' => $success,
				'data' => $data
			]);
		}
	}

	public function updateUserRole(Request $request, $id){
		$userRole = $this->modelUserRoles->find($id);
		if (!$userRole) {
			return response()->json(['error' => 'NOT_FOUND_ERROR']);
		}
		$data = $request->all();
		$da = $userRole->update($data);
		if($da){
			$success = true;
			return response()->json([
				'success' => $success,
				'data' => $data
			]);
		}    
	}

	public function deleteUserRole($id){
		$userRole = $this->modelUserRoles->find($id);
		if (!$userRole) {
			return response()->json(['error' => 'NOT_FOUND_ERROR']);
		}
		$data = $userRole->delete();
		if($data){
			$success = true;
			return response()->json([
				'success' => $success
			]);
		}
	}

	public function getAllUserRole(){
		$userRoles = $this->modelUserRoles->all();
		if($userRoles){
			$success = true;
			return response()->json([
				'success' => $success,
				'data' => $userRoles
			]);
		}
		return response()->json(['error' => 'NOT_FOUND_ERROR']);
	}

	public function getUserRole($id){
		$userRole = $this->modelUserRoles->find($id);
		if (!$userRole) {
			return response()->json(['error' => 'NOT_FOUND_ERROR']);
		}
		$success = true;
		return response()->json([
			'success' => $success,
			'data' => $userRole
		]);
	}

}
