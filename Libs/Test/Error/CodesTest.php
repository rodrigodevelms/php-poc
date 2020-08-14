<?php

declare(strict_types=1);

namespace Error;

use Patterns\Error\Codes;
use PHPUnit\Framework\TestCase;

class CodesTest extends TestCase
{
  public function testNullRequestCodeShouldReturn400(): void
  {
    $this->assertEquals(400, Codes::nullRequestCode());
  }

  public function testWrongHeaderParameterShouldReturn400(): void
  {
    $this->assertEquals(400, Codes::wrongHeaderParameter());
  }

  public function testValidationCodeErrorShouldReturn400(): void
  {
    $this->assertEquals(400, Codes::validationCodeError());
  }

  public function testQuerySelectNotFoundShouldReturn404(): void
  {
    $this->assertEquals(404, Codes::querySelectNotFound());
  }

  public function testQueryUpdateNotFoundShouldReturn404(): void
  {
    $this->assertEquals(404, Codes::queryUpdateNotFound());
  }
}