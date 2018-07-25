<?php
declare(strict_types = 1);

namespace App\Contracts;

use Illuminate\Http\Response;

/**
 * Trait response
 * @package App\Contracts
 */
trait responseStructure
{
    /**
     * @param array $data
     * @return array
     */
    public function responseSuccess($data = null)
    {
        $response = true;
        return [
            'success' => $response, 
            'data'      => $data
        ];
    }

    /**
     *
     * @param array $options
     * @return array
     */
    public function responseError($options = []) {
        $response = false;
        return [
            'success' => $response, 
             'error'     => 'INVALID_INPUT_VALUE_ERROR'
        ];

    }
}