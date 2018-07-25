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
Route::post('project', 'ProjectController@addProject');
Route::post('/project/{id}', 'ProjectController@updateProject');
Route::delete('/project/{id}', 'ProjectController@deleteProject');
Route::get('projects', 'ProjectController@getAllProject');
Route::get('project/{id}', 'ProjectController@getProject');

//sprint
Route::group(['middleware' => 'checkIsLeader'], function (){
	Route::post('add-sprint/{project_ID}', 'SprintController@addSprint');
	Route::post('/update-sprint/{id}', 'SprintController@updateSprint');
	Route::delete('/sprint/{id}', 'SprintController@deleteSprint');
});
Route::get('sprints', 'SprintController@getAllSprint');
Route::get('sprint/{id}', 'SprintController@getSprint');
Route::get('project-sprint/{project_ID}', 'SprintController@getProjectSprint');

//task
Route::group(['middleware' => 'checkIsLeader'], function (){
	Route::post('add-task/{sprint_ID}', 'TaskController@addTask');
	Route::post('/update-task/{id}', 'TaskController@updateTask');
	Route::delete('/task/{id}', 'TaskController@deleteTask');
});
Route::get('tasks', 'TaskController@getAllTask');
Route::get('task/{id}', 'TaskController@getTask');
Route::get('project-task/{project_ID}', 'TaskController@getProjectTask');
Route::get('sprint-task/{sprint_ID}', 'TaskController@getSprintTask');


//allocation
Route::post('add-allocation/{sprint_ID}', 'AllocationController@addAllocation');
Route::post('/update-allocation/{id}', 'AllocationController@updateAllocation');
Route::delete('/allocation/{id}', 'AllocationController@deleteAllocation');
Route::get('allocations', 'AllocationController@getAllAllocation');
Route::get('allocation/{id}', 'AllocationController@getAllocation');
Route::get('project-allocation/{project_ID}', 'AllocationController@getProjectAllocation');
Route::get('sprint-allocation/{sprint_ID}', 'AllocationController@getSprintAllocation');

//roleInProject
Route::post('roleinproject', 'RoleInProjectController@addRoleInProject');
Route::post('/roleinproject/{id}', 'RoleInProjectController@updateRoleInProject');
Route::delete('/roleinproject/{id}', 'RoleInProjectController@deleteRoleInProject');
Route::get('roleinprojects', 'RoleInProjectController@getAllRoleInProject');
Route::get('roleinproject/{id}', 'RoleInProjectController@getRoleInProject');


