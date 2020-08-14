<?php

declare(strict_types=1);

namespace Company\Handler;

use Company\Entity\Company;
use Company\Entity\CompanyTypeEnum;
use Company\Entity\LegalNatureEnum;
use Exception;
use Laminas\Db\Adapter\Adapter;
use Laminas\Db\Sql\TableIdentifier;
use Laminas\Db\TableGateway\TableGateway;
use Laminas\Diactoros\Response\JsonResponse;
use Patterns\Error\Codes;
use Patterns\Response\ErrorResponse;
use Patterns\Response\SuccessResponse;
use Patterns\Validation\HeaderValidation;
use Patterns\Validation\RequestValidation;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Ramsey\Uuid\Uuid;

class CompanyCreateHandler implements RequestHandlerInterface
{
  protected Adapter $adapter;
  protected Company $company;

  public function __construct(
    Adapter $adapter,
    Company $company
  )
  {
    $this->adapter = $adapter;
    $this->company = $company;
  }

  public function handle(ServerRequestInterface $request): ResponseInterface
  {
    try {
      $requestValidate = RequestValidation::validate($request);
      $header = HeaderValidation::validate($request);
      $language = $header[0];
      $schema = $header[1];
      $id = Uuid::uuid4();
      $this->company->buildCompanyFromJson($id, $requestValidate['Request']['Company']);
      $validate = $this->company->validation(
        $language,
        new LegalNatureEnum(),
        new CompanyTypeEnum()
      );

      if (!empty($validate)) throw new Exception(implode(" ", $validate), Codes::validationCodeError());

      $tableGateway = new TableGateway(new TableIdentifier('company', $schema), $this->adapter);
      $tableGateway->insert($this->company->getCompanyAsArray());

      return new JsonResponse(SuccessResponse::messages($language), 201);

    } catch (Exception $exception) {
      $errorResult = ErrorResponse::errorMessages($exception->getCode(), explode(". ", $exception->getMessage()));
      $code = $exception->getCode() == 0 ? 400 : $exception->getCode();
      return new JsonResponse($errorResult, $code);
    }
  }
}
