<?php

declare(strict_types=1);

namespace Company\Handler;

use Psr\Container\ContainerInterface;

class CompanyHandlerFactory
{
    public function __invoke(ContainerInterface $container) : CompanyHandler
    {
        return new CompanyHandler();
    }
}
