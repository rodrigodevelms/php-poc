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
use Patterns\Validation\ObjectQueryValidation;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class CompanyReadHandler implements RequestHandlerInterface
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
      $id = $request->getAttribute('company_id');
      $language = $header[0];
      $schema = $header[1];
      $tableGateway = new TableGateway(new TableIdentifier('company', $schema), $this->adapter);
      $result = $tableGateway->select(['id' => $id]);
      ObjectQueryValidation::validate($result, $language, "Id");

      return new JsonResponse($result->toArray(), 200);

    } catch (Exception $exception) {
      $errorResult = ErrorResponse::errorMessages($exception->getCode(), explode(". ", $exception->getMessage()));
      $code = $exception->getCode() == 0 ? 400 : $exception->getCode();
      return new JsonResponse($errorResult, $code);
    }
  }
}
