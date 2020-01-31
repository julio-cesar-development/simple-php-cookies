<?php

namespace App\Rules;

class RuleException extends \Exception {
  protected $validation_error_array = [
    'title' => 'Unauthorized',
    'status' => 403,
    'details' => [],
  ];
  public function __construct($message, $code = null, array $validation_errors = [], \Exception $previous = null) {
    parent::__construct($message, 403, $previous);

    $this->validation_error_array['details'] = $validation_errors;
  }

  public function get_errors() {
    return $this->validation_error_array;
  }
}
