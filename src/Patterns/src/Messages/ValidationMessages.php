<?php

namespace Patterns\Messages;


use Patterns\Locale\LanguageEnum;

class ValidationMessages
{
  function notNull(
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

  function invalidStringLength(
    string $language,
    string $fieldName,
    int $minimumValue,
    int $maximumValue
  ): string
  {
    switch ($language) {
      case LanguageEnum::USA :
        return ucfirst("$fieldName must have between $minimumValue and $maximumValue characters.");
      default :
        return ucfirst("$fieldName deve conter entre $minimumValue e $maximumValue caracteres.");
    }
  }

  function invalidDocument(
    string $language,
    string $fieldName
  ): string
  {
    switch ($language) {
      case LanguageEnum::USA :
        return "Invalid $fieldName. Please insert a valid one.";
      default :
        return ucfirst("$fieldName inválido. Por favor insira um $fieldName válido.");
    }
  }

  function invalidEnum(
    string $language,
    string $fieldName,
    array $enums
  ): string
  {
    switch ($language) {
      case LanguageEnum::USA :
        return "The word: $fieldName, does not correspond to any of the options: $enums";
      default :
        return " A palavra: $fieldName, não corresponde a nenhuma das opções: $enums";
    }
  }

  function invalidRequest(string $language): string
  {
    switch ($language) {
      case LanguageEnum::USA :
        return "Error. The request cannot be null.";
      default :
        return "Erro. A requisição não pode ser nula";
    }
  }
}

