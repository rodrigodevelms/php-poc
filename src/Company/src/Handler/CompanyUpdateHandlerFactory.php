<?php

declare(strict_types=1);

namespace Company\Handler;

use Company\Entity\Company;
use Laminas\Db\Adapter\AdapterInterface;
use Libs\Patterns\Error\Codes;
use Psr\Container\ContainerInterface;

class CompanyUpdateHandlerFactory
{
  public function __invoke(ContainerInterface $container): CompanyUpdateHandler
  {
    $adapter = $container->get(AdapterInterface::class);
    $codes = new Codes();
    return new CompanyUpdateHandler(
      $codes,
      $adapter,
      new Company()
    );
  }
}
