<?php

namespace Patterns\Messages\Exceptions;

use Patterns\Locale\LanguageEnum;

class ExceptionRequest
{
  public static function validate(
    string $language
  ): string
  {
    switch ($language) {
      case LanguageEnum::USA :
        return "Error! The request cannot be null.";
      default :
        return "Erro! A requisição não pode ser nula";
    }
  }
}