<?php

namespace Libs\Patterns\Messages\Validations;

use Libs\Patterns\Locale\LanguageEnum;

class StringLengthValidationMessage
{
  public static function validate(
    string $language,
    string $fieldName = null,
    int $minimumValue = null,
    int $maximumValue = null
  ): string
  {
    switch ($language) {
      case LanguageEnum::USA :
        return ucfirst("$fieldName must have between $minimumValue and $maximumValue characters.");
      default :
        return ucfirst("$fieldName deve conter entre $minimumValue e $maximumValue caracteres.");
    }
  }
}