<?php


namespace Validation;


use Patterns\Locale\LanguageEnum;
use function Patterns\Locale\invalidEnum;

function validateEnum(LanguageEnum $language, string $value, object $classEnum): ?string
{
  $values = [];
  foreach ($classEnum as $k => $v) {
    $values = $v;
  }
  return (in_array($value, $values)) ? null : invalidEnum($language, $value, $values);
}