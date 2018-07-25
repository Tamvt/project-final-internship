<?php
declare(strict_types = 1);

namespace App\Exceptions;

/**
 * Class NotFoundException
 * @package App\Exceptions
 */
class NotFoundException extends AbstractException
{
    /**
     * NotFoundException constructor.
     * @param int $status
     * @param string $message
     * @param $data
     */
    public function __construct($error = '')
    {
        if (!$error)
            $error = 'NOT_FOUND_ERROR';

        parent::__construct($error);
    }
}