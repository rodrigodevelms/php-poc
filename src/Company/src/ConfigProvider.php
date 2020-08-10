<?php

declare(strict_types=1);

namespace Company;

use Company\Handler\CreateCompanyHandler;
use Company\Handler\CreateCompanyHandlerFactory;
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
        CreateCompanyHandler::class => CreateCompanyHandlerFactory::class
      ],
    ];
  }

  public function getTemplates(): array
  {
    return [
      'paths' => [
        'company' => [__DIR__ . '/../templates/'],
      ],
    ];
  }
}
