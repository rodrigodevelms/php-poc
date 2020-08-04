<?php

declare(strict_types=1);

namespace Company\Handler;

use Exception;
use Laminas\Diactoros\Response\JsonResponse;
use Patterns\Error\Codes;
use Patterns\Messages\ExceptionsMessages;
use Patterns\Response\ErrorResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Validation\HeaderValidation;
use Validation\RequestValidation;

class CreateCompanyHandler implements RequestHandlerInterface
{
  public function handle(ServerRequestInterface $request): ResponseInterface
  {
    try {
      $result = [];
      $requestBody = json_decode($request->getBody()->getContents(), true);
      $language =$request->getHeader('Language')[0];
      $requestValidate = new RequestValidation(new ExceptionsMessages(), new Codes());
      $requestValidate->validate($language, $requestBody['Company']);
    } catch (Exception $ex) {
      $errorResult = new ErrorResponse($ex->getCode(), [$ex->getMessage()]);
      return new JsonResponse($errorResult->errorMessages());
    }
    return new JsonResponse("OK", 200);
  }
}
