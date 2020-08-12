<?php

namespace Libs\Patterns\Messages\Validations;

use Libs\Patterns\Locale\LanguageEnum;

class NotNullValidationMessage
{
  public static function validate(
    string $language,
    string $fieldName
  ): string
  {
    switch ($language) {
      case LanguageEnum::USA :
        return ucfirst("$fieldName is required.");
      default:
        return ucfirst("$fieldName é obrigatório.");
    }
  }
}