<?php

namespace Validation;

use Patterns\Locale\LanguageEnum;
use Patterns\Messages\Validations\DocumentValidationMessage;
use Patterns\Validation\DocumentValidation;
use PHPUnit\Framework\TestCase;

class DocumentValidationTest extends TestCase
{
  public function testValidateCPFShouldBeValid(): void
  {
    $result = DocumentValidation::validate(LanguageEnum::BR, "304.619.670-90");
    $this->assertEquals(null, $result);
  }

  /**
   * @dataProvider invalidCPFMessages
   * @param string $value
   * @param string $language
   * @param string $expectedResult
   */
  public function testValidateCPFShouldBeInvalidWithAllLanguages(
    string $value,
    string $language,
    string $expectedResult
  ): void
  {
    $result = DocumentValidation::validate($language, $value);
    $this->assertEquals($expectedResult, $result);
  }

  public function testValidateCNPJShouldBeValid(): void
  {
    $result = DocumentValidation::validate(LanguageEnum::BR, "21.734.629/0001-35");
    $this->assertEquals(null, $result);
  }

  /**
   * @dataProvider invalidCNPJMessages
   * @param string $value
   * @param string $language
   * @param string $expectedResult
   */
  public function testValidateCNPJShouldBeInvalidWithAllLanguages(
    string $value,
    string $language,
    string $expectedResult
  ): void
  {
    $result = DocumentValidation::validate($language, $value);
    $this->assertEquals($expectedResult, $result);
  }

  /**
   * @dataProvider invalidDocumentMessages
   * @param string $value
   * @param string $language
   * @param string $expectedResult
   */
  public function testInvalidDocumentNumber(
    string $value,
    string $language,
    string $expectedResult
  ): void
  {
    $result = DocumentValidation::validate($language, $value);
    $this->assertEquals($expectedResult, $result);

  }

  /* DATA PROVIDERS */

  public function invalidCPFMessages(): array
  {
    $invalidCPF = '111.111.222-33';
    return [
      'ValidateCPFShouldBeInvalidWithUSALanguage' => [
        'value' => $invalidCPF, 'language' => 'USA', 'expectedResult' => DocumentValidationMessage::validate('USA', 'CPF')
      ],
      'ValidateCPFShouldBeInvalidWithBRLanguage' => [
        'value' => $invalidCPF, 'language' => 'BR', 'expectedResult' => DocumentValidationMessage::validate('BR', 'CPF')
      ]
    ];
  }

  public function invalidCNPJMessages(): array
  {
    $invalidCNPJ = '21.734.629/0001-32';
    return [
      'ValidateCNPJShouldBeInvalidWithUSALanguage' => [
        'value' => $invalidCNPJ, 'language' => 'USA', 'expectedResult' => DocumentValidationMessage::validate('USA', 'CNPJ')
      ],
      'ValidateCNPJShouldBeInvalidWithBRLanguage' => [
        'value' => $invalidCNPJ, 'language' => 'BR', 'expectedResult' => DocumentValidationMessage::validate('BR', 'CNPJ')
      ]
    ];
  }

  public function invalidDocumentMessages(): array
  {
    $invalidDocument = '111.123123.50495-dsfśdiu112123131233';
    return [
      'ValidateDocumentShouldBeInvalidWithUSALanguage' => [
        'value' => $invalidDocument, 'language' => 'USA', 'expectedResult' => DocumentValidationMessage::validate('USA', 'Document')
      ],
      'ValidateCNPJShouldBeInvalidWithBRLanguage' => [
        'value' => $invalidDocument, 'language' => 'BR', 'expectedResult' => DocumentValidationMessage::validate('BR', 'Document')
      ]
    ];
  }
}
