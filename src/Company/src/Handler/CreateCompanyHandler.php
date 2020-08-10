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
use Patterns\Validation\HeaderValidation;
use Patterns\Validation\RequestValidation;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class CreateCompanyHandler implements RequestHandlerInterface
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
      $company = $requestValidate['Request']['Company'];
      $this->company->buildCompanyFromJson($company);
      $validate = $this->company->validation($language, new LegalNatureEnum(), new CompanyTypeEnum());
      if (!empty($validate)) {
        throw new Exception(implode(" ", $validate), $this->codes->validationCodeError());
      }
      $tableGateway = new TableGateway(new TableIdentifier('company', $schema), $this->adapter);
      $content = $tableGateway->select();
      $contentArray = [];
      foreach ($content as $value) {
        $contentArray[] = $value;
      }
      return new JsonResponse($contentArray, 200);
    } catch (Exception $ex) {
      $errorResult = new ErrorResponse($ex->getCode(), explode(". ", $ex->getMessage()));
      return new JsonResponse($errorResult, 400);
    }
  }
}
