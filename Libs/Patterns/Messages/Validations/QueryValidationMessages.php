<?php

namespace Libs\Patterns\Messages\Validations;

use Libs\Patterns\Locale\LanguageEnum;

class QueryValidationMessages
{
  public static function selectNotFound(
    string $language,
    string $field
  ) : string
  {
    switch ($language) {
      case LanguageEnum::USA :
        return "Error, $field not found.";
      default:
        return "Erro, $field não encontrado.";
    }
  }

  public static function updateNotFound(string $language): string
  {
    switch ($language) {
      case LanguageEnum::USA :
        return "Error, Id not found.";
      default:
        return "Erro, Id não encontrado.";
    }
  }
}