<?php

declare(strict_types=1);

namespace Company\Handler;

use Company\Entity\Company;
use Patterns\Messages\Validations\EnumValidationMessage;
use Patterns\Messages\Validations\NotNullValidationMessage;
use Patterns\Messages\Validations\StringLengthValidationMessage;
use Psr\Container\ContainerInterface;
use Validation\EnumValidation;
use Validation\RequestValidation;
use Validation\StringFieldValidation;

class CreateCompanyHandlerFactory
{
  public function __invoke(ContainerInterface $container): CreateCompanyHandler
  {
    return new CreateCompanyHandler(
      new Company(
        new StringFieldValidation(
          new NotNullValidationMessage(),
          new StringLengthValidationMessage()
        ),
        new EnumValidation(
         new EnumValidationMessage()
        )
      ),
      new RequestValidation()
    );
  }
}
