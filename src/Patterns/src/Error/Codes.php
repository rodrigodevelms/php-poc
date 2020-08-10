<?php

namespace Patterns\Error;

class Codes
{
    public function nullRequestCode() : int {
//      log();
      return 1001;
    }

    public function wrongHeaderParameter() : int {
//      log();
      return 1002;
    }

    public function validationCodeError() : int {
      return 2000;
    }
}