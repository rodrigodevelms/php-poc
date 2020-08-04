<?php

namespace Patterns\Error;

class Codes
{
    public function nullRequestCode() : int {
//      log();
      return 1001;
    }

    public function nullHeaderCode() : int {
//      log();
      return 1002;
    }
}