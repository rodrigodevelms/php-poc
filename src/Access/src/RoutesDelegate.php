<?php


namespace Access;


use Access\Handler\AccessHandler;
use Psr\Container\ContainerInterface;

class RoutesDelegate
{
  public function __invoke(ContainerInterface $container, $serviceName, callable $callback)
  {
    $app = $callback();
    $app->get('/api/access', AccessHandler::class, 'access');
    return $app;
  }

}