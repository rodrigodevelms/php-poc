<?php

declare(strict_types=1);

namespace Company\Handler;

use Company\Entity\Company;
use Laminas\Db\Adapter\AdapterInterface;
use Psr\Container\ContainerInterface;

class CompanyUpdateHandlerFactory
{
  public function __invoke(ContainerInterface $container): CompanyUpdateHandler
  {
    $adapter = $container->get(AdapterInterface::class);
    return new CompanyUpdateHandler(
      $adapter,
      new Company()
    );
  }
}
