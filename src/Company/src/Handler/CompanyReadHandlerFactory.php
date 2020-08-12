<?php

declare(strict_types=1);

namespace Company\Handler;

use Laminas\Db\Adapter\AdapterInterface;
use Psr\Container\ContainerInterface;

class CompanyReadHandlerFactory
{
  public function __invoke(ContainerInterface $container): CompanyReadHandler
  {
    $adapter = $container->get(AdapterInterface::class);
    return new CompanyReadHandler(
      $adapter
    );
  }
}
