<?php

namespace Patterns\Validation;

use Exception;
use Laminas\Db\ResultSet\ResultSetInterface;
use Patterns\Messages\Validations\QueryValidationMessages;
use Patterns\Error\Codes;

class ObjectQueryValidation
{
  public static function validate(
    ResultSetInterface $query,
    string $language,
    string $field
  ): ?string
  {
    if ($query->count() < 1) throw new Exception(QueryValidationMessages::selectNotFound($language, $field), Codes::querySelectNotFound());
    return null;
  }
}