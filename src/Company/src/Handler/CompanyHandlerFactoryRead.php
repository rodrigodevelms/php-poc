<?php

declare(strict_types=1);

namespace Company\Handler;

use Laminas\Db\Adapter\AdapterInterface;
use Libs\Patterns\Error\Codes;
use Libs\Patterns\Messages\Validations\EnumValidationMessage;
use Libs\Patterns\Validation\EnumValidation;
use Libs\Patterns\Validation\HeaderValidation;
use Psr\Container\ContainerInterface;

class CompanyHandlerFactoryRead
{
  public function __invoke(ContainerInterface $container): CompanyHandlerRead
  {
    $adapter = $container->get(AdapterInterface::class);
    return new CompanyHandlerRead(
      $adapter,
      new HeaderValidation(
        new EnumValidation(
          new EnumValidationMessage()
        ),
        new Codes()
      )
    );
  }
}
