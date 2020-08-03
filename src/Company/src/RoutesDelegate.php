<?php


namespace Company;


use Company\Handler\CompanyHandler;
use Psr\Container\ContainerInterface;

class RoutesDelegate
{
  public function __invoke(ContainerInterface $container, $serviceName, callable $callback)
  {
    $app = $callback();
    $app->get('/api/company', CompanyHandler::class, 'company');
    return $app;
  }
}