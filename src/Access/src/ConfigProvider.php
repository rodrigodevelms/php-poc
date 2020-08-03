<?php

declare(strict_types=1);

namespace Access;

use Access\Handler\AccessHandler;
use Access\Handler\AccessHandlerFactory;
use Mezzio\Application;

class ConfigProvider
{
  public function __invoke(): array
  {
    return [
      'dependencies' => $this->getDependencies(),
      'templates' => $this->getTemplates(),
    ];
  }

  public function getDependencies(): array
  {
    return [
      'delegators' => [
        Application::class => [
          RoutesDelegate::class,
        ]
      ],
      'invokables' => [
      ],
      'factories' => [
        AccessHandler::class => AccessHandlerFactory::class,
      ],
    ];
  }

  public function getTemplates(): array
  {
    return [
      'paths' => [
        'access' => [__DIR__ . '/../templates/'],
      ],
    ];
  }
}
