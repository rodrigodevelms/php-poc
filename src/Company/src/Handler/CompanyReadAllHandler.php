<?php

declare(strict_types=1);

namespace Company\Handler;

use Exception;
use Laminas\Db\Adapter\Adapter;
use Laminas\Db\Sql\TableIdentifier;
use Laminas\Db\TableGateway\TableGateway;
use Laminas\Diactoros\Response\JsonResponse;
use Patterns\Response\ErrorResponse;
use Patterns\Validation\HeaderValidation;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class CompanyReadAllHandler implements RequestHandlerInterface
{
  protected Adapter $adapter;

  public function __construct(
    Adapter $adapter
  )
  {
    $this->adapter = $adapter;
  }

  public function handle(ServerRequestInterface $request): ResponseInterface
  {
    try {
      $header = HeaderValidation::validate($request);
      $schema = $header[1];
      $tableGateway = new TableGateway(new TableIdentifier('company', $schema), $this->adapter);
      $result = $tableGateway->select();

      return new JsonResponse($result->toArray(), 200);

    } catch (Exception $exception) {
      $errorResult = ErrorResponse::errorMessages($exception->getCode(), explode(". ", $exception->getMessage()));
      return new JsonResponse($errorResult, 400);
    }
  }
}
