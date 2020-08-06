<?php


namespace Patterns\Messages\Validations;

use Patterns\Locale\LanguageEnum;

class EnumValidationMessage
{
  public function validate(
    string $language,
    string $fieldName,
    array $enums
  ): string
  {
    $enums = implode(", ", $enums);
    switch ($language) {
      case LanguageEnum::USA :
        return "The $fieldName value in Header Language does not correspond to any of the following possible options: { $enums }";
      default :
        return " O valor $fieldName no Header Language, não corresponde a nenhuma das seguintes possíveis opções: { $enums }";
    }
  }
}