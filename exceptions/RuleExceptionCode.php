<?php

namespace App\Rules;

abstract class RuleExceptionCode {
  const INVALID_USERNAME = 600;
  const INVALID_PASSWORD = 601;
  const INVALID_TIMESTAMP = 602;
  const INVALID_USER_CODE = 603;
  const UNAUTHORIZED = 604;
  const IS_REQUIRED = 605;
  const US_NOT_EMAIL = 606;
}
