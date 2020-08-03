<?php


namespace Patterns\Response;


use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class ResponseError
{
  private UuidInterface $id;
  private string $date;
  private array $errors;

  public function __construct(UuidInterface $id, string $date, array $errors)
  {
    $this->id = $id;
    $this->date = $date;
    $this->errors = $errors;
  }


  public function errorMessages(array $messages): ResponseError
  {
    $errorList = [];
    foreach ($messages as $message) {
      $errorList = [$message];
    }
    return new ResponseError(
      Uuid::uuid4(),
      date_default_timezone_get(),
      $errorList
    );
  }
}