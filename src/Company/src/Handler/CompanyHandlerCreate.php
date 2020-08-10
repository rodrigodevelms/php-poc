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
use Libs\Patterns\Error\Codes;
use Libs\Patterns\Response\ErrorResponse;
use Libs\Patterns\Response\SuccessResponse;
use Libs\Patterns\Validation\HeaderValidation;
use Libs\Patterns\Validation\RequestValidation;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Ramsey\Uuid\Uuid;

class CompanyHandlerCreate implements RequestHandlerInterface
{
  protected Codes $codes;
  protected Adapter $adapter;
  protected Company $company;
  protected HeaderValidation $headerValidation;
  protected RequestValidation $requestValidation;

  public function __construct(
    Codes $codes,
    Adapter $adapter,
    Company $company,
    HeaderValidation $headerValidation,
    RequestValidation $requestValidation
  )
  {
    $this->codes = $codes;
    $this->adapter = $adapter;
    $this->company = $company;
    $this->headerValidation = $headerValidation;
    $this->requestValidation = $requestValidation;
  }

  public function handle(ServerRequestInterface $request): ResponseInterface
  {
    try {
      $requestValidate = $this->requestValidation->validate($request);
      $header = $this->headerValidation->validate($request);
      $language = $header[0];
      $schema = $header[1];
      $id = Uuid::uuid4();
      $request = $requestValidate['Request']['Company'];
      $this->company->buildCompanyFromJson($id, $request);
      $validate = $this->company->validation($language, new LegalNatureEnum(), new CompanyTypeEnum());
      if (!empty($validate)) {
        throw new Exception(implode(" ", $validate), $this->codes->validationCodeError());
      }
      $tableGateway = new TableGateway(new TableIdentifier('company', $schema), $this->adapter);
      $tableGateway->insert($this->company->getCompanyAsArray());
      $result = new SuccessResponse($language);
      return new JsonResponse($result, 202);
    } catch (Exception $exception) {
      $errorResult = new ErrorResponse($exception->getCode(), explode(". ", $exception->getMessage()));
      return new JsonResponse($errorResult->errorMessages(), 400);
    }
  }
}
