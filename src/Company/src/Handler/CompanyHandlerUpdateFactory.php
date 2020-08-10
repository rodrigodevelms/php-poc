<?php

declare(strict_types=1);

namespace Company\Handler;

use Psr\Container\ContainerInterface;

class CompanyHandlerUpdateFactory
{
    public function __invoke(ContainerInterface $container) : CompanyHandlerUpdate
    {
        return new CompanyHandlerUpdate();
    }
}
