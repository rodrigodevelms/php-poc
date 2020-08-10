<?php

namespace Libs\Patterns\Messages\Validations;

use Libs\Patterns\Locale\LanguageEnum;

class DocumentValidationMessage
{
  public function validate(
    string $language,
    string $fieldName
  ): string
  {
    switch ($language) {
      case LanguageEnum::USA :
        return "Invalid $fieldName, please insert a valid one.";
      default :
        return ucfirst("$fieldName inválido, por favor insira um $fieldName válido.");
    }
  }
}