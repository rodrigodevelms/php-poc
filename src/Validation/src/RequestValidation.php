<?php

namespace Validation;

use Exception;
use Patterns\Error\Codes;
use Patterns\Messages\ExceptionsMessages;

class RequestValidation
{
  protected ExceptionsMessages $exceptionsMessages;
  protected Codes $code;

  public function __construct(
    ExceptionsMessages $exceptionsMessages,
    Codes $code
  )
  {
    $this->exceptionsMessages = $exceptionsMessages;
    $this->code = $code;
  }

  function validate(
    string $language,
    array $request
  )
  {
    if (empty($request)) {
      throw new Exception(
        $this->exceptionsMessages->exceptionRequest($language),
        $this->code->nullRequestCode());
    }
    return null;
  }
}
