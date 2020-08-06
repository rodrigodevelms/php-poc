<?php

namespace Validation;

use Exception;
use Patterns\Error\Codes;
use Patterns\Messages\Validations\EnumValidationMessage;
use Patterns\Messages\Validations\RequestValidationMessage;
use Psr\Http\Message\ServerRequestInterface;

class RequestValidation
{
  public function validate(
    ServerRequestInterface $request
  ): ?array
  {
    $codes = new Codes();
    $headerValidation = new HeaderValidation(
      new EnumValidation(
        new EnumValidationMessage()
      ),
      $codes
    );
    $requestBody = json_decode($request->getBody()->getContents(), true);
    $language = $request->getHeader('Language')[0];
    $headerValidation->validate($request);
    if (empty($requestBody['Request'])) {
      $message = new RequestValidationMessage();
      throw new Exception(
        $message->validate($language),
        $codes->nullRequestCode()
      );
    }
    return [$language, $requestBody];
  }
}
