<?php


namespace Settings\Validation;

use Patterns\Locale\LanguageEnum;
use function Patterns\Locale\invalidStringLength;
use function Patterns\Locale\notNull;
use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

function validateStringField(
  LanguageEnum $language,
  string $fieldName,
  string $value,
  int $minimumValue,
  int $maximumValue): ?string
{
  switch ($value) {
    case (isNull($value) || isEmpty(trim($value))) :
      return notNull($language, $fieldName);
    case (strlen($value) < $minimumValue || strlen($value) > $maximumValue) :
      return invalidStringLength($language, $fieldName, $minimumValue, $maximumValue);
    default:
      return null;
  }
}