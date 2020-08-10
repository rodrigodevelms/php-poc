<?php

declare(strict_types=1);

namespace Company\Handler;

use Company\Entity\Company;
use Laminas\Db\Adapter\Adapter;
use Laminas\Db\Adapter\AdapterInterface;
use Patterns\Error\Codes;
use Patterns\Messages\Validations\DocumentValidationMessage;
use Patterns\Messages\Validations\EnumValidationMessage;
use Patterns\Messages\Validations\NotNullValidationMessage;
use Patterns\Messages\Validations\StringLengthValidationMessage;
use Patterns\Validation\DocumentValidation;
use Patterns\Validation\EnumValidation;
use Patterns\Validation\HeaderValidation;
use Patterns\Validation\RequestValidation;
use Patterns\Validation\StringFieldValidation;
use Patterns\Validation\Utils;
use Psr\Container\ContainerInterface;

class CreateCompanyHandlerFactory
{
  public function __invoke(ContainerInterface $container): CreateCompanyHandler
  {
    $adapter = $container->get(AdapterInterface::class);
    $codes = new Codes();
    $enumValidation = new EnumValidation(new EnumValidationMessage());
    return new CreateCompanyHandler(
      $codes,
      $adapter,
      new Company(
        $enumValidation,
        new DocumentValidation(
          new Utils(),
          new DocumentValidationMessage()
        ),
        new StringFieldValidation(
          new NotNullValidationMessage(),
          new StringLengthValidationMessage()
        )
      ),
      new HeaderValidation(
        $enumValidation,
        $codes
      ),
      new RequestValidation($codes)
    );

  }
}
