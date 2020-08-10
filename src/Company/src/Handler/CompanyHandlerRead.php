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

class CompanyHandlerRead implements RequestHandlerInterface
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
      $id = $request->getAttribute('id_company');
      $schema = $header[1];
      $tableGateway = new TableGateway(new TableIdentifier('company', $schema), $this->adapter);
      $result = $tableGateway->select(['id' => $id]);
      return new JsonResponse($result->toArray(), 200);
    } catch (Exception $exception) {
      $errorResult = new ErrorResponse($exception->getCode(), explode(". ", $exception->getMessage()));
      return new JsonResponse($errorResult->errorMessages(), 400);
    }
  }
}
