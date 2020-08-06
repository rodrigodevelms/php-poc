<?php


namespace Validation;


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
    $headerValidate = $this->headerValidate($request, new LanguageEnum());

    if (!empty($headerValidate)) {
      throw new Exception(
        $headerValidate,
        $this->codes->wrongHeaderParameter()
      );
    }
  }

  private function headerValidate(ServerRequestInterface $request, LanguageEnum $languageEnum): ?string
  {
    $language = $request->getHeader('Language')[0];
    if (!empty($this->enumValidation->validate(LanguageEnum::BR, $language, $languageEnum->values()))) {
      $message = new EnumValidationMessage();
      $enums = new  LanguageEnum();
      return $message->validate(
        LanguageEnum::BR,
        $language,
        $enums->values()
      );
    }
    return null;
  }
}