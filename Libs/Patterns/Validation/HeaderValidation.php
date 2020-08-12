<?php

namespace Libs\Patterns\Validation;

use Exception;
use Libs\Patterns\Error\Codes;
use Libs\Patterns\Locale\LanguageEnum;
use Libs\Patterns\Messages\Validations\EnumValidationMessage;
use Psr\Http\Message\ServerRequestInterface;

class HeaderValidation
{
  public static function validate(ServerRequestInterface $request)
  {
    $languageValidate = self::languageValidate($request, new LanguageEnum());
    $schemaValidate = self::schemaValidate($request);

    return [$languageValidate, $schemaValidate];
  }

  private static function languageValidate(
    ServerRequestInterface $request,
    LanguageEnum $languageEnum
  ): ?string
  {
    $header = $request->getHeader('Language')[0];
    if (!empty(EnumValidation::validate(LanguageEnum::BR, $header, $languageEnum->values()))) {
      $message = new EnumValidationMessage();
      $enums = new  LanguageEnum();
      $result = $message->validate(
        LanguageEnum::BR,
        $header,
        $enums->values()
      );
      throw new Exception(
        $result,
        Codes::wrongHeaderParameter()
      );
    }
    return $header;
  }

  private static function schemaValidate(ServerRequestInterface $request): ?string
  {
    return $request->getHeader('Schema')[0];
  }
}