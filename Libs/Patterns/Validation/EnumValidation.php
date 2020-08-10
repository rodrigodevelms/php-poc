<?php

namespace Libs\Patterns\Validation;

use Libs\Patterns\Messages\Validations\EnumValidationMessage;

class EnumValidation
{
  protected EnumValidationMessage $message;

  public function __construct(EnumValidationMessage $message)
  {
    $this->message = $message;
  }

  function validate(
    string $language,
    string $fieldValue,
    array $enumValues
  ): ?string
  {
    $result = in_array($fieldValue, $enumValues);
    if (!$result) {
      return $this->message->validate($language, $fieldValue, $enumValues);
    }
    return null;
  }
}