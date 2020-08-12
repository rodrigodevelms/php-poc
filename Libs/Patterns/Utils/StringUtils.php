<?php

namespace Libs\Patterns\Utils;

class StringUtils
{
  public static function onlyNumbers(string $value): string
  {
    return preg_replace('/\D/', '', $value);
  }
}