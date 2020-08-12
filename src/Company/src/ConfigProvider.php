<?php

declare(strict_types=1);

namespace Company;

use Company\Handler\CompanyCreateHandler;
use Company\Handler\CompanyCreateHandlerFactory;
use Company\Handler\CompanyReadHandler;
use Company\Handler\CompanyReadHandlerFactory;
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
        CompanyCreateHandler::class => CompanyCreateHandlerFactory::class,
        CompanyReadHandler::class => CompanyReadHandlerFactory::class
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
