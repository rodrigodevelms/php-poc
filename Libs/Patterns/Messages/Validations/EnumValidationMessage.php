<?php

namespace Libs\Patterns\Messages\Validations;

use Libs\Patterns\Locale\LanguageEnum;

class EnumValidationMessage
{
  public static function validate(
    string $language,
    string $fieldName,
    array $enums
  ): string
  {
    $enums = implode(", ", $enums);
    switch ($language) {
      case LanguageEnum::USA :
        return "The $fieldName value, does not correspond to any of the following possible options: { $enums }";
      default :
        return "O valor $fieldName, não corresponde a nenhuma das seguintes possíveis opções: { $enums }";
    }
  }
}