<?php

namespace Validation;

use Patterns\Messages\ValidationMessages;
use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

class StringFieldValidation
{
  protected ValidationMessages $validationMessages;
  protected string $language;
  protected string $fieldName;
  protected string $value;
  protected int $minimumValue;
  protected int $maximumValue;

  public function __construct(ValidationMessages $validationMessages)
  {
    $this->validationMessages = $validationMessages;
  }

  function validate(
    string $language,
    string $fieldName,
    string $value,
    int $minimumValue,
    int $maximumValue): ?string
  {
    switch ($value) {
      case (isNull($value) || isEmpty(trim($value))) :
        return $this->validationMessages->notNull($language, $fieldName);
      case (strlen($value) < $minimumValue || strlen($value) > $maximumValue) :
        return $this->validationMessages->invalidStringLength($language, $fieldName, $minimumValue, $maximumValue);
      default:
        return null;
    }
  }
}
