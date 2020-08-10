<?php

declare(strict_types=1);

namespace Company\Handler;

use Exception;
use Laminas\Db\Adapter\Adapter;
use Laminas\Db\Sql\TableIdentifier;
use Laminas\Db\TableGateway\TableGateway;
use Laminas\Diactoros\Response\JsonResponse;
use Libs\Patterns\Response\ErrorResponse;
use Libs\Patterns\Validation\HeaderValidation;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class CompanyHandlerReadAll implements RequestHandlerInterface
{
  protected Adapter $adapter;
  protected HeaderValidation $headerValidation;

  public function __construct(
    Adapter $adapter,
    HeaderValidation $headerValidation
  )
  {
    $this->adapter = $adapter;
    $this->headerValidation = $headerValidation;
  }

  public function handle(ServerRequestInterface $request): ResponseInterface
  {
    try {
      $header = $this->headerValidation->validate($request);
      $schema = $header[1];
      $tableGateway = new TableGateway(new TableIdentifier('company', $schema), $this->adapter);
      $result = $tableGateway->select();
      return new JsonResponse($result->toArray(), 200);
    } catch (Exception $exception) {
      $errorResult = new ErrorResponse($exception->getCode(), explode(". ", $exception->getMessage()));
      return new JsonResponse($errorResult->errorMessages(), 400);
    }
  }
}
