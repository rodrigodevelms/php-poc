<?php

declare(strict_types=1);

namespace Company\Handler;

use Laminas\Db\Adapter\AdapterInterface;
use Psr\Container\ContainerInterface;

class CompanyReadAllHandlerFactory
{
  public function __invoke(ContainerInterface $container): CompanyReadAllHandler
  {
    $adapter = $container->get(AdapterInterface::class);
    return new CompanyReadAllHandler(
      $adapter
    );
  }
}
