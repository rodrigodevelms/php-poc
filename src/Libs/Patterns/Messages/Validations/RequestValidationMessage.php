<?php


namespace Libs\Patterns\Messages\Validations;


use Libs\Patterns\Locale\LanguageEnum;

class RequestValidationMessage
{

  public function validate(string $language): string
  {
    switch ($language) {
      case LanguageEnum::USA :
        return "Error! The request cannot be null.";
      default :
        return "Erro! A requisição não pode ser nula";
    }
  }
}