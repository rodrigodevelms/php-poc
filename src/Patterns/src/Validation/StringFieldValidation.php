<?php

namespace Patterns\Validation;

use Patterns\Messages\Validations\NotNullValidationMessage;
use Patterns\Messages\Validations\StringLengthValidationMessage;

class StringFieldValidation
{
  protected NotNullValidationMessage $notNullMessage;
  protected StringLengthValidationMessage $stringFieldMessage;

  public function __construct(
    NotNullValidationMessage $notNullMessage,
    StringLengthValidationMessage $stringFieldMessage
  )
  {
    $this->notNullMessage = $notNullMessage;
    $this->stringFieldMessage = $stringFieldMessage;
  }

  function validate(
    string $language,
    string $fieldName,
    string $value,
    int $minimumValue,
    int $maximumValue
  ): ?string
  {
    switch (strlen(trim($value))) {
      case (0) :
        return $this->notNullMessage->validate($language, $fieldName);
      case (strlen(trim($value)) < $minimumValue || strlen(trim($value)) > $maximumValue) :
        return $this->stringFieldMessage->validate($language, $fieldName, $minimumValue, $maximumValue);
      default:
        return null;
    }
  }
}
