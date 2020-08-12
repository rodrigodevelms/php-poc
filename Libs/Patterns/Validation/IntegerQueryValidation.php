<?php

namespace Libs\Patterns\Validation;

use Exception;
use Libs\Patterns\Error\Codes;
use Libs\Patterns\Messages\Validations\QueryValidationMessages;

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