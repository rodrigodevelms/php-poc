<?php


namespace Patterns\Messages\Success;


use Patterns\Locale\LanguageEnum;

class Success
{
  public function validate(string $language): string
  {
    switch ($language) {
      case LanguageEnum::USA :
        return "Successful event! Awaiting return.";
      default :
        return "Evento realizado com sucesso! Aguardando retorno.";
    }
  }
}