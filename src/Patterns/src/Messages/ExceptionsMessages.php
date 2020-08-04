<?php

namespace Patterns\Messages;

use Patterns\Locale\LanguageEnum;

class ExceptionsMessages
{
  function exceptionRequest(string $language): string
  {
    switch ($language) {
      case LanguageEnum::USA :
        return "Error. The request cannot be null.";
      default :
        return "Erro. A requisição não pode ser nula";
    }
  }
}