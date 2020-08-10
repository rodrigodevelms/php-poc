<?php

namespace Company\Entity;

class CompanyTypeEnum
{
  const Parent = 'Parent';
  const Subsidiary = "Subsidiary";

  public function values(): array
  {
    return [
      self::Parent,
      self::Subsidiary
    ];
  }
}