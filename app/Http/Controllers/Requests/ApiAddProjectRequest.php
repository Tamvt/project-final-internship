<?php
declare(strict_types = 1);

namespace App\Http\Controllers\Requests;

use App\Exceptions\NotFoundException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

/**
 * Class ApiRegisterUserRequest
 * @package App\Http\Requests\Api
 */
class ApiAddProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     * @param Request $request
     * @return array
     * @throws NotFoundException
     */
    public function rules(Request $request)
    {
        $rules = 
        [
         'project_name' => 'required|unique:projects'
     ];
    $validator = \Validator::make($request->all(), $rules);

        /**
         * Check response errors
         * @var object $validator
         */
        if ($validator->fails()) {
            'error' => "INVALID_INPUT_VALUE_ERROR";
        }

        return $rules;
    }
}