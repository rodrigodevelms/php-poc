<?php

namespace Libs\Patterns\Validation;

use Libs\Patterns\Messages\Validations\EnumValidationMessage;

class EnumValidation
{
  public static function validate(
    string $language,
    string $fieldValue,
    array $enumValues
  ): ?string
  {
    $result = in_array($fieldValue, $enumValues);
    if (!$result) return EnumValidationMessage::validate($language, $fieldValue, $enumValues);
    return null;
  }
}