<?php

declare(strict_types=1);

namespace Company\Handler;

use Company\Entity\Company;
use Laminas\Db\Adapter\AdapterInterface;
use Libs\Patterns\Error\Codes;
use Libs\Patterns\Messages\Validations\DocumentValidationMessage;
use Libs\Patterns\Messages\Validations\EnumValidationMessage;
use Libs\Patterns\Messages\Validations\NotNullValidationMessage;
use Libs\Patterns\Messages\Validations\StringLengthValidationMessage;
use Libs\Patterns\Validation\DocumentValidation;
use Libs\Patterns\Validation\EnumValidation;
use Libs\Patterns\Validation\HeaderValidation;
use Libs\Patterns\Validation\RequestValidation;
use Libs\Patterns\Validation\StringFieldValidation;
use Libs\Patterns\Validation\Utils;
use Psr\Container\ContainerInterface;

class CompanyHandlerFactoryCreate
{
  public function __invoke(ContainerInterface $container): CompanyHandlerCreate
  {
    $adapter = $container->get(AdapterInterface::class);
    $codes = new Codes();
    $enumValidation = new EnumValidation(new EnumValidationMessage());
    return new CompanyHandlerCreate(
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
