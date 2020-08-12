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
use Libs\Patterns\Validation\IntegerQueryValidation;
use Libs\Patterns\Validation\RequestValidation;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Ramsey\Uuid\Uuid;

class CompanyUpdateHandler implements RequestHandlerInterface
{
  protected Codes $codes;
  protected Adapter $adapter;
  protected Company $company;

  public function __construct(
    Codes $codes,
    Adapter $adapter,
    Company $company
  )
  {
    $this->codes = $codes;
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
      $id = $request->getAttribute('company_id');
      $this->company->buildCompanyFromJson(
        Uuid::fromString($id),
        $requestValidate['Request']['Company']
      );
      $validate = $this->company->validation(
        $language,
        new LegalNatureEnum(),
        new CompanyTypeEnum()
      );

      if (!empty($validate)) throw new Exception(implode(' ', $validate), $this->codes->validationCodeError());

      $tableGateway = new TableGateway(new TableIdentifier('company', $schema), $this->adapter);
      $query = $tableGateway->update($this->company->getCompanyAsArray(), ['id' => $id]);
      IntegerQueryValidation::validate($query, $language);

      return new JsonResponse(SuccessResponse::messages($language), 204);

    } catch (Exception $exception) {
      $errorResult = ErrorResponse::errorMessages($exception->getCode(), explode(". ", $exception->getMessage()));
      $code = $exception->getCode() == 0 ? 400 : $exception->getCode();
      return new JsonResponse($errorResult, $code);
    }
  }
}
