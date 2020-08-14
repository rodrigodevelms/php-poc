<?php

namespace Validation;

use Patterns\Locale\LanguageEnum;
use Patterns\Messages\Validations\EnumValidationMessage;
use Patterns\Validation\EnumValidation;
use PHPUnit\Framework\TestCase;

class EnumValidationTest extends TestCase
{
  /**
   * @dataProvider validValuesForEnum
   * @param array $values
   * @param string $value
   * @param string $language
   */
  public function testValidateValidEnums(
    array $values,
    string $value,
    string $language
  ): void
  {
    $result = EnumValidation::validate($language, $value, $values);
    $this->assertEquals(null, $result);
  }

  /**
   * @dataProvider invalidValuesForEnum
   * @param array $values
   * @param string $value
   * @param string $language
   * @param string $validate
   */
  public function testValidateInvalidEnums(
    array $values,
    string $value,
    string $language,
    string $validate
  ): void
  {
    $result = EnumValidation::validate($language, $value, $values);
    $this->assertEquals($validate, $result);
  }


  /* DATA PROVIDERS */

  public function validValuesForEnum(): array
  {
    $languageEnum = new LanguageEnum();
    return [
      'validateLanguageEnumUSA' => [
        'values' => $languageEnum->values(), 'value' => 'USA', 'language' => 'USA'
      ],
      'validateLanguageEnumBR' => [
        'values' => $languageEnum->values(), 'value' => 'BR', 'language' => 'BR'
      ]
    ];
  }

  public function invalidValuesForEnum(): array
  {
    $le = new LanguageEnum();
    return [
      'validateLanguageEnumUSA' => [
        'values' => $le->values(), 'value' => 'USASA', 'language' => 'USA', 'validate' => EnumValidationMessage::validate('USA', 'USASA', $le->values())
      ],
      'validateLanguageEnumBR' => [
        'values' => $le->values(), 'value' => 'BRSA', 'language' => 'BR', 'validate' => EnumValidationMessage::validate('BR', 'BRSA', $le->values())
      ]
    ];
  }
}