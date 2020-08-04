<?php

namespace Validation;

use Patterns\Messages\ValidationMessages;

class EnumValidation
{
  protected ValidationMessages $validationMessages;

  public function __construct(ValidationMessages $validationMessages)
  {
    $this->validationMessages = $validationMessages;

  }

  function validate(
    string $language,
    string $fieldValue,
    object $classEnum
  ): ?string
  {
    $values = [];
    foreach ($classEnum as $key => $value) {
      $values[] = $value;
      dir(var_dump($value));
    }
    return (in_array($fieldValue, $values)) ? null : $this->validationMessages->invalidEnum($language, $fieldValue, $values);
  }
}