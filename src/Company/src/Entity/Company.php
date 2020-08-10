<?php

namespace Company\Entity;

use Patterns\Validation\DocumentValidation;
use Patterns\Validation\EnumValidation;
use Patterns\Validation\StringFieldValidation;
use Ramsey\Uuid\Uuid;

class Company
{
  protected ?Uuid $id = null;
  protected ?int $internalId = null;
  protected bool $active;
  protected string $companyName;
  protected string $fancyName;
  protected string $document;
  protected string $openingDate;
  protected string $legalNature; // LegalNatureEnum
  protected string $lineOfBusiness;
  protected string $companyType; //CompanyTypeEnum

  protected EnumValidation $enumValidation;
  protected DocumentValidation $documentValidation;
  protected StringFieldValidation $stringFieldValidation;

  public function __construct(
    EnumValidation $enumValidation,
    DocumentValidation $documentValidation,
    StringFieldValidation $stringFieldValidation
  )
  {
    $this->enumValidation = $enumValidation;
    $this->documentValidation = $documentValidation;
    $this->stringFieldValidation = $stringFieldValidation;
  }

  public function buildCompanyFromJson(
    array $requestBody
  )
  {
    $this->active = $requestBody['active'];
    $this->companyName = $requestBody['companyName'];
    $this->fancyName = $requestBody['fancyName'];
    $this->document = $requestBody['document'];
    $this->openingDate = $requestBody['openingDate'];
    $this->legalNature = $requestBody['legalNature'];
    $this->lineOfBusiness = $requestBody['lineOfBusiness'];
    $this->companyType = $requestBody['companyType'];
  }

  public function validation(
    string $language,
    LegalNatureEnum $legalNatureEnum,
    CompanyTypeEnum $companyTypeEnum
  ): array
  {
    $result = [];
    array_push($result,
      $this->stringFieldValidation->validate($language, 'company name', $this->companyName, 5, 120),
      $this->stringFieldValidation->validate($language, 'fancy name', $this->fancyName, 5, 120),
      $this->documentValidation->validate($language, $this->document),
      $this->enumValidation->validate($language, $this->legalNature, $legalNatureEnum->values()),
      $this->stringFieldValidation->validate($language, 'line of business', $this->lineOfBusiness, 5, 120),
      $this->enumValidation->validate($language, $this->companyType, $companyTypeEnum->values())
    );
    return array_filter($result);
  }
}