<?php

namespace Validation;

use Laminas\Diactoros\ServerRequest;
use Patterns\Validation\HeaderValidation;
use PHPUnit\Framework\TestCase;

class HeaderValidationTest extends TestCase
{
  public function testHeaderValidationShouldBeInvalidWithNullError(): void
  {
    $request = new ServerRequest(
      [],
      [],
      [],
      'POST',
      [],
      ['Language' => 'USA'],
      null,
      [],
      null
    );
    $result = HeaderValidation::validate($request);
    $this->assertEquals("must be of the type string, null given", $result);
  }
}