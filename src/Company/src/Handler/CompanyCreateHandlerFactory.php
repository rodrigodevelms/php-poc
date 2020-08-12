<?php

declare(strict_types=1);

namespace Company\Handler;

use Company\Entity\Company;
use Laminas\Db\Adapter\AdapterInterface;
use Libs\Patterns\Error\Codes;
use Psr\Container\ContainerInterface;

class CompanyCreateHandlerFactory
{
  public function __invoke(ContainerInterface $container): CompanyCreateHandler
  {
    $adapter = $container->get(AdapterInterface::class);
    $codes = new Codes();
    return new CompanyCreateHandler(
      $codes,
      $adapter,
      new Company()
    );

  }
}
