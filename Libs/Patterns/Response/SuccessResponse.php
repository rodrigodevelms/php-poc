<?php

namespace Patterns\Response;

use Patterns\Messages\Success\Success;
use Ramsey\Uuid\Uuid;

class SuccessResponse
{
  public static function messages(string $language): array
  {
    return [
      'id' => Uuid::uuid4(),
      'date' => date("Y/m/d"),
      'success' => Success::validate($language)
    ];
  }
}