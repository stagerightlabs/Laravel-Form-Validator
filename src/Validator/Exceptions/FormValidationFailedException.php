<?php

namespace SRLabs\Validator\Exceptions;

use Exception;

class FormValidationFailedException extends Exception
{

    protected $errors;

    /**
     * @param string $message
     * @param int    $errors
     */
    public function __construct($message, $errors)
    {
        $this->message = $message . '. ';
        $this->errors = $errors;

        foreach ($this->errors->all() as $message) {
            $this->message .= ' ' . $message;
        }
    }

    /**
     * @return int
     */
    public function getErrors()
    {
        return $this->errors;
    }
}
