<?php

declare(strict_types=1);

use Laminas\ConfigAggregator\ArrayProvider;
use Laminas\ConfigAggregator\ConfigAggregator;
use Laminas\ConfigAggregator\PhpFileProvider;
use Laminas\Diactoros\ConfigProvider;

$cacheConfig = [
  'config_cache_path' => 'data/cache/config-cache.php',
];

$aggregator = new ConfigAggregator([
  \Laminas\Db\ConfigProvider::class,
  \Company\ConfigProvider::class,
  \Access\ConfigProvider::class,
  \Laminas\HttpHandlerRunner\ConfigProvider::class,
  \Mezzio\Router\LaminasRouter\ConfigProvider::class,
  \Laminas\Router\ConfigProvider::class,
  \Laminas\Validator\ConfigProvider::class,
  // Include cache configuration
  new ArrayProvider($cacheConfig),
  \Mezzio\Helper\ConfigProvider::class,
  \Mezzio\ConfigProvider::class,
  \Mezzio\Router\ConfigProvider::class,
  ConfigProvider::class,
  // Swoole config to overwrite some services (if installed)
  class_exists(ConfigProvider::class)
    ? ConfigProvider::class
    : function () {
    return [];
  },

  new PhpFileProvider(realpath(__DIR__) . '/autoload/{{,*.}global,{,*.}local}.php'),
  // Load development config if it exists
  new PhpFileProvider(realpath(__DIR__) . '/development.config.php'),
], $cacheConfig['config_cache_path']);

return $aggregator->getMergedConfig();
