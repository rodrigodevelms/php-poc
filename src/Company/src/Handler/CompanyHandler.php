<?php

declare(strict_types=1);

namespace Company\Handler;

use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class CompanyHandler implements RequestHandlerInterface
{
  public function handle(ServerRequestInterface $request): ResponseInterface
  {
    $result['company'] = [1 => 'company'];
    return new JsonResponse($result);
  }
}
