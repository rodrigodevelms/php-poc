<?php

declare(strict_types=1);

namespace Company\Handler;

use Company\Entity\Company;
use Company\Entity\LegalNatureEnum;
use Exception;
use Laminas\Diactoros\Response\JsonResponse;
use Patterns\Locale\LanguageEnum;
use Patterns\Response\ErrorResponse;
use Patterns\Response\SuccessResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Validation\RequestValidation;

class CreateCompanyHandler implements RequestHandlerInterface
{
  protected Company $company;
  protected RequestValidation $requestValidation;

  public function __construct(
    Company $company,
    RequestValidation $requestValidation
  )
  {
    $this->company = $company;
    $this->requestValidation = $requestValidation;
  }

  public function handle(ServerRequestInterface $request): ResponseInterface
  {
    try {
      $request = $this->requestValidation->validate($request);
      $laguage = $request[0];
      $body = $request[1]['Request']['Company'];
      $this->company->buildCompanyFromJson($body);;
      $validate = $this->company->validation($laguage, new LegalNatureEnum());
      if (!empty($validate)) {
        throw new Exception(implode(" ", $validate));
      }
    } catch (Exception $ex) {
      $errorResult = new ErrorResponse($ex->getCode(), explode(". ", $ex->getMessage()));
      return new JsonResponse($errorResult->errorMessages(), 400);
    }
    $successResult = new SuccessResponse('BR');
    return new JsonResponse($successResult->messages(), 200);
  }
}
