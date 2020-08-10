<?php

namespace Libs\Patterns\Response;

use Ramsey\Uuid\Uuid;

class ErrorResponse
{
  private int $code;
  private array $messages;

  public function __construct(
    int $code,
    array $messages
  )
  {
    $this->code = $code;
    $this->messages = $messages;
  }

  public function errorMessages(): array
  {
    $errorList = [];
    foreach ($this->messages as $message) {
      $errorList[] = $message;
    }
    return [
      'id' => Uuid::uuid4(),
      'date' => date("Y/m/d"),
      'code' => $this->code,
      'errors' => $errorList
    ];
  }
}