<?php

namespace Patterns\Validation;

use Exception;
use Patterns\Messages\Validations\QueryValidationMessages;
use Patterns\Error\Codes;

class IntegerQueryValidation
{
  public static function validate(
    int $query,
    string $language
  ): ?string
  {
    if ($query < 1) throw new Exception(QueryValidationMessages::updateNotFound($language), Codes::queryUpdateNotFound());
    return null;
  }
}