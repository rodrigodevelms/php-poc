<?php

namespace Libs\Patterns\Locale;

class LanguageEnum
{
  const BR = 'BR';
  const USA = 'USA';

  public function values(): array
  {
    return [self::BR, self::USA];
  }
}