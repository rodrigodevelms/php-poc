<?php

declare(strict_types=1);

namespace Access;

use Access\Handler\AccessHandler;
use Access\Handler\AccessHandlerFactory;
use Mezzio\Application;

/**
 * The configuration provider for the Access module
 *
 * @see https://docs.laminas.dev/laminas-component-installer/
 */
class ConfigProvider
{
  /**
   * Returns the configuration array
   *
   * To add a bit of a structure, each section is defined in a separate
   * method which returns an array with its configuration.
   */
  public function __invoke(): array
  {
    return [
      'dependencies' => $this->getDependencies(),
      'templates' => $this->getTemplates(),
    ];
  }

  /**
   * Returns the container dependencies
   */
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

  /**
   * Returns the templates configuration
   */
  public function getTemplates(): array
  {
    return [
      'paths' => [
        'access' => [__DIR__ . '/../templates/'],
      ],
    ];
  }
}
