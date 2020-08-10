<?php

namespace Patterns\Validation;

use Exception;
use Patterns\Error\Codes;
use Patterns\Locale\LanguageEnum;
use Patterns\Messages\Validations\EnumValidationMessage;
use Psr\Http\Message\ServerRequestInterface;

class HeaderValidation
{
  protected EnumValidation $enumValidation;
  protected Codes $codes;

  public function __construct(EnumValidation $enumValidation, Codes $codes)
  {
    $this->enumValidation = $enumValidation;
    $this->codes = $codes;
  }

  public function validate(ServerRequestInterface $request)
  {
    $languageValidate = $this->languageValidate($request, new LanguageEnum());
    $schemaValidate = $this->schemaValidate($request);

    return [$languageValidate, $schemaValidate];
  }

  private function languageValidate(ServerRequestInterface $request, LanguageEnum $languageEnum): ?string
  {
    $header = $request->getHeader('Language')[0];
    if (!empty($this->enumValidation->validate(LanguageEnum::BR, $header, $languageEnum->values()))) {
      $message = new EnumValidationMessage();
      $enums = new  LanguageEnum();
      $result = $message->validate(
        LanguageEnum::BR,
        $header,
        $enums->values()
      );
      throw new Exception(
        $result,
        $this->codes->wrongHeaderParameter()
      );
    }
    return $header;
  }

  private function schemaValidate(ServerRequestInterface $request): ?string
  {
    return $request->getHeader('Schema')[0];
  }
}