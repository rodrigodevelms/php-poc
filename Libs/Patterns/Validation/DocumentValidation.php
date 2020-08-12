<?php

namespace Libs\Patterns\Validation;

use Libs\Patterns\Messages\Validations\DocumentValidationMessage;
use Libs\Patterns\Utils\StringUtils;

class DocumentValidation
{
  public static function validate(
    string $language,
    string $value
  ): ?string
  {
    $numbers = StringUtils::onlyNumbers($value);
    switch (strlen($numbers)) {
      case 11 :
        return self::validateCPF($numbers) ? null : DocumentValidationMessage::validate($language, "CPF");
      case 14:
        return self::validateCNPJ($numbers) ? null : DocumentValidationMessage::validate($language, "CNPJ");
      default :
        return DocumentValidationMessage::validate($language, "Document");
    }
  }

  private static function validateCPF(string $cpf): bool
  {
    if (preg_match('/(\d)\1{10}/', $cpf)) return false;

    for ($t = 9; $t < 11; $t++) {

      for ($d = 0, $c = 0; $c < $t; $c++) {
        $d += $cpf[$c] * (($t + 1) - $c);
      }

      $d = ((10 * $d) % 11) % 10;

      if ($cpf[$c] != $d) return false;
    }
    return true;
  }

  private static function validateCNPJ(string $cnpj): bool
  {
    if (preg_match('/(\d)\1{13}/', $cnpj)) return false;

    for ($i = 0, $j = 5, $sum = 0; $i < 12; $i++) {
      $sum += $cnpj[$i] * $j;
      $j = ($j == 2) ? 9 : $j - 1;
    }

    $rest = $sum % 11;

    if ($cnpj[12] != ($rest < 2 ? 0 : 11 - $rest)) return false;

    for ($i = 0, $j = 6, $sum = 0; $i < 13; $i++) {
      $sum += $cnpj[$i] * $j;
      $j = ($j == 2) ? 9 : $j - 1;
    }

    $rest = $sum % 11;

    return $cnpj[13] == ($rest < 2 ? 0 : 11 - $rest);
  }
}