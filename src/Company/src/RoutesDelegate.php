<?php

namespace Company;

use Company\Handler\CompanyHandlerCreate;
use Company\Handler\CompanyHandlerRead;
use Company\Handler\CompanyHandlerReadAll;
use Psr\Container\ContainerInterface;

class RoutesDelegate
{
  public function __invoke(ContainerInterface $container, $serviceName, callable $callback)
  {
    $app = $callback();
    $app->post('/api/company', CompanyHandlerCreate::class, 'company_create');
    $app->get('/api/company', CompanyHandlerReadAll::class, 'company_read_all');
    $app->get('/api/company/:id_company', CompanyHandlerRead::class, 'company_read');
    return $app;
  }
}