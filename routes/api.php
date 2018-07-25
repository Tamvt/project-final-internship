<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
	return $request->user();
});
//project
Route::group(['middleware' => 'checkIsPM'], function (){
	Route::post('project', 'ProjectController@addProject');
	Route::post('/project/{id}', 'ProjectController@updateProject');
	Route::delete('/project/{id}', 'ProjectController@deleteProject');
});
Route::group(['middleware' => 'checkIsAdmin'], function (){
	Route::get('projects', 'ProjectController@getAllProject');
	Route::get('project/{id}', 'ProjectController@getProject');
});
Route::get('user-project/{user_id}', 'ProjectController@getUserProject');

//sprint
Route::group(['middleware' => 'checkIsLeader'], function (){
	Route::post('add-sprint/{project_ID}', 'SprintController@addSprint');
	Route::post('/update-sprint/{id}', 'SprintController@updateSprint');
	Route::delete('/sprint/{id}', 'SprintController@deleteSprint');
});
Route::group(['middleware' => 'checkIsAdmin'], function (){
	Route::get('sprints', 'SprintController@getAllSprint');
	Route::get('sprint/{id}', 'SprintController@getSprint');
});
Route::get('project-sprint/{project_ID}', 'SprintController@getProjectSprint');

//task
Route::group(['middleware' => 'checkOwnedSprint'], function (){
	Route::post('add-task/{sprint_ID}', 'TaskController@addTask');
	Route::post('/update-task/{id}', 'TaskController@updateTask');
	Route::delete('/task/{id}', 'TaskController@deleteTask');
});
Route::group(['middleware' => 'checkIsAdmin'], function (){
	Route::get('tasks', 'TaskController@getAllTask');
	Route::get('task/{id}', 'TaskController@getTask');
});
Route::get('project-task/{project_ID}', 'TaskController@getProjectTask');
Route::get('sprint-task/{sprint_ID}', 'TaskController@getSprintTask');


//allocation
Route::group(['middleware' => 'checkIsPM'], function (){
	Route::post('add-allocation/{sprint_ID}', 'AllocationController@addAllocation');
	Route::post('/update-allocation/{id}', 'AllocationController@updateAllocation');
	Route::delete('/allocation/{id}', 'AllocationController@deleteAllocation');
});
Route::group(['middleware' => 'checkIsAdmin'], function (){
	Route::get('allocations', 'AllocationController@getAllAllocation');
	Route::get('allocation/{id}', 'AllocationController@getAllocation');
});
Route::get('project-allocation/{project_ID}', 'AllocationController@getProjectAllocation');
Route::get('sprint-allocation/{sprint_ID}', 'AllocationController@getSprintAllocation');

//roleInProject
Route::group(['middleware' => 'checkIsLeader'], function (){
	Route::post('roleinproject', 'RoleInProjectController@addRoleInProject');
	Route::post('/roleinproject/{id}', 'RoleInProjectController@updateRoleInProject');
	Route::delete('/roleinproject/{id}', 'RoleInProjectController@deleteRoleInProject');
});
Route::get('roleinprojects', 'RoleInProjectController@getAllRoleInProject');
Route::get('roleinproject/{id}', 'RoleInProjectController@getRoleInProject');

//userRole
Route::group(['middleware' => 'checkIsAdmin'], function (){
	Route::post('userrole', 'UserRoleController@addUserRole');
	Route::post('/userrole/{id}', 'UserRoleController@updateUserRole');
	Route::delete('/userrole/{id}', 'UserRoleController@deleteUserRole');
});
Route::get('userroles', 'UserRoleController@getAllUserRole');
Route::get('userrole/{id}', 'UserRoleController@getUserRole');

//assignment
Route::post('assignment', 'AssignmentController@addAssignment');
Route::post('/assignment/{id}', 'AssignmentController@updateUserAssignment');
Route::delete('/assignment/{id}', 'AssignmentController@deleteAssignment');
Route::get('assignments', 'AssignmentController@getAllAssignment');
Route::get('assignment/{id}', 'AssignmentController@getAssignment');


