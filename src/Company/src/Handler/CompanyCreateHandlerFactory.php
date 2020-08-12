<?php

declare(strict_types=1);

namespace Company\Handler;

use Company\Entity\Company;
use Laminas\Db\Adapter\AdapterInterface;
use Psr\Container\ContainerInterface;

class CompanyCreateHandlerFactory
{
  public function __invoke(ContainerInterface $container): CompanyCreateHandler
  {
    $adapter = $container->get(AdapterInterface::class);
    return new CompanyCreateHandler(
      $adapter,
      new Company()
    );

  }
}
