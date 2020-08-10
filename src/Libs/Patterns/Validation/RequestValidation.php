<?php

namespace Libs\Patterns\Validation;

use Exception;
use Libs\Patterns\Error\Codes;
use Libs\Patterns\Messages\Validations\RequestValidationMessage;
use Psr\Http\Message\ServerRequestInterface;

class RequestValidation
{
  protected Codes $codes;

  public function __construct(Codes $codes)
  {
    $this->codes = $codes;
  }

  public function validate(ServerRequestInterface $request): ?array
  {
    $requestBody = json_decode($request->getBody()->getContents(), true);
    $language = $request->getHeader('Language')[0];
    if (empty($requestBody['Request'])) {
      $message = new RequestValidationMessage();
      throw new Exception(
        $message->validate($language),
        $this->codes->nullRequestCode()
      );
    }
    return $requestBody;
  }
}
