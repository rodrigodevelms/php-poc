<?php


namespace Company;


use Company\Handler\CreateCompanyHandler;
use Psr\Container\ContainerInterface;

class RoutesDelegate
{
  public function __invoke(ContainerInterface $container, $serviceName, callable $callback)
  {
    $app = $callback();
    $app->post('/api/company', CreateCompanyHandler::class, 'company_post');
    return $app;
  }
}