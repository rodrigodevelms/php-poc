<?php

declare(strict_types=1);

namespace Access\Handler;

use Psr\Container\ContainerInterface;

class AccessHandlerFactory
{
  public function __invoke(ContainerInterface $container): AccessHandler
  {
    return new AccessHandler();
  }
}
