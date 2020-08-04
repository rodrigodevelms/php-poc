<?php

declare(strict_types=1);

namespace Company\Handler;

use Psr\Container\ContainerInterface;

class CreateCompanyHandlerFactory
{
    public function __invoke(ContainerInterface $container) : CreateCompanyHandler
    {
        return new CreateCompanyHandler();

    }
}
