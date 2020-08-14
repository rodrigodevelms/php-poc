<?php

namespace Patterns\Validation;

use Exception;
use Patterns\Messages\Validations\RequestValidationMessage;
use Patterns\Error\Codes;
use Psr\Http\Message\ServerRequestInterface;

class RequestValidation
{
  public static function validate(ServerRequestInterface $request): ?array
  {
    $requestBody = json_decode($request->getBody()->getContents(), true);
    $language = $request->getHeader('Language')[0];
    if (empty($requestBody['Request'])) {
      $message = new RequestValidationMessage();
      throw new Exception(
        $message->validate($language),
        Codes::nullRequestCode()
      );
    }
    return $requestBody;
  }
}
