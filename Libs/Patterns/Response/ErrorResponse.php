<?php

namespace Patterns\Response;

use Ramsey\Uuid\Uuid;

class ErrorResponse
{
  public static function errorMessages(
    int $code,
    array $messages
  ): array
  {
    $errorList = [];
    foreach ($messages as $message) {
      $errorList[] = $message;
    }
    return [
      'id' => Uuid::uuid4(),
      'date' => date("Y/m/d"),
      'code' => $code,
      'errors' => $errorList
    ];
  }
}