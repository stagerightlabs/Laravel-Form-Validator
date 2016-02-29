<?php

namespace SRLabs\Validator\Exceptions;

use Exception;

class FormValidationFailedException extends Exception
{

    protected $errors;

    /**
     * @param string $message
     * @param array    $errors
     */
    public function __construct($message, $errors)
    {
        $this->message = $message . '. ';
        $this->errors = $errors;

        if ($this->errors) {
            foreach ($this->errors->all() as $message) {
                $this->message .= ' ' . $message;
            }
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
