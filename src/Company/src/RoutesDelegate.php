<?php

namespace Company;

use Company\Handler\CompanyCreateHandler;
use Company\Handler\CompanyReadAllHandler;
use Company\Handler\CompanyReadHandler;
use Company\Handler\CompanyUpdateHandler;
use Psr\Container\ContainerInterface;

class RoutesDelegate
{
  public function __invoke(ContainerInterface $container, $serviceName, callable $callback)
  {
    $app = $callback();
    $app->post('/api/company', CompanyCreateHandler::class, 'company_create');
    $app->get('/api/company', CompanyReadAllHandler::class, 'company_read_all');
    $app->get('/api/company/:company_id', CompanyReadHandler::class, 'company_read');
    $app->put('/api/company/:company_id', CompanyUpdateHandler::class, 'company_update');
    return $app;
  }
}