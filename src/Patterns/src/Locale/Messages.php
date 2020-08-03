<?php


namespace Patterns\Locale;


function notNull(
  LanguageEnum $language,
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
  LanguageEnum $language,
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

function invalidDocument(LanguageEnum $language, string $fieldName): string
{
  switch ($language) {
    case LanguageEnum::USA :
      return "Invalid $fieldName. Please insert a valid one.";
    default :
      return ucfirst("$fieldName inválido. Por favor insira um $fieldName válido.");
  }
}

function invalidEnum(LanguageEnum $language, string $fieldName, array $enums): string
{
  switch ($language) {
    case LanguageEnum::USA :
      return "The word: $fieldName, does not correspond to any of the options: $enums";
    default :
      return " A palavra: $fieldName, não corresponde a nenhuma das opções: $enums";
  }
}