<?php

namespace Libs\Patterns\Validation;

class Utils
{
  public function onlyNumbers(string $value): string
  {
    return preg_replace('/\D/', '', $value);
  }
}