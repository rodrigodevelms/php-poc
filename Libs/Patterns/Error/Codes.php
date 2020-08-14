<?php

namespace Patterns\Error;

class Codes
{
  public static function nullRequestCode(): int
  {
//      log();
    return 400;
  }

  public static function wrongHeaderParameter(): int
  {
//      log();
    return 400;
  }

  public static function validationCodeError(): int
  {
    return 400;
  }

  public static function querySelectNotFound(): int
  {
    return 404;
  }

  public static function queryUpdateNotFound(): int
  {
    return 404;
  }
}