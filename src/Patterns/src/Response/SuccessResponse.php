<?php


namespace Patterns\Response;


use Ramsey\Uuid\Uuid;

class SuccessResponse
{
  public function errorMessages(): array
  {
    return [
      'id' => Uuid::uuid4(),
      'date' => date("Y/m/d"),
      'errors' => $errorList
    ];
  }
}