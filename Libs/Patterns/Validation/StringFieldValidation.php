<?php

namespace Libs\Patterns\Validation;

use Libs\Patterns\Messages\Validations\NotNullValidationMessage;
use Libs\Patterns\Messages\Validations\StringLengthValidationMessage;

class StringFieldValidation
{
  public static function validate(
    string $language,
    string $fieldName,
    string $value,
    int $minimumValue,
    int $maximumValue
  ): ?string
  {
    switch (strlen(trim($value))) {
      case (0) :
        return NotNullValidationMessage::validate($language, $fieldName);
      case (strlen(trim($value)) < $minimumValue || strlen(trim($value)) > $maximumValue) :
        return StringLengthValidationMessage::validate($language, $fieldName, $minimumValue, $maximumValue);
      default:
        return null;
    }
  }
}
