<?php

declare(strict_types=1);

namespace Company;

use Company\Handler\CompanyHandlerCreate;
use Company\Handler\CompanyHandlerFactoryCreate;
use Company\Handler\CompanyHandlerRead;
use Company\Handler\CompanyHandlerFactoryRead;
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
        CompanyHandlerCreate::class => CompanyHandlerFactoryCreate::class,
        CompanyHandlerRead::class => CompanyHandlerFactoryRead::class
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
