<?php


namespace Patterns\Response;


use Patterns\Messages\Success\Success;
use Ramsey\Uuid\Uuid;

class SuccessResponse
{
  protected string $language;

  public function __construct(string $language)
  {
    $this->language = $language;
  }

  public function messages(): array
  {
    $message = new Success();
    return [
      'id' => Uuid::uuid4(),
      'date' => date("Y/m/d"),
      'success' => $message->validate($this->language)
    ];
  }
}