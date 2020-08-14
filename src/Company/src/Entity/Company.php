<?php

namespace Company\Entity;

use Patterns\Validation\DocumentValidation;
use Patterns\Validation\EnumValidation;
use Patterns\Validation\StringFieldValidation;
use Ramsey\Uuid\UuidInterface;

class Company
{
  protected ?UuidInterface $id = null;
  protected ?int $internalId = null;
  protected bool $active;
  protected string $companyName;
  protected string $fancyName;
  protected string $document;
  protected string $openingDate;
  protected string $legalNature; // LegalNatureEnum
  protected string $lineOfBusiness;
  protected string $companyType; //CompanyTypeEnum

  public function buildCompanyFromJson(
    UuidInterface $id,
    array $requestBody
  ): Company
  {
    $this->id = $id;
    $this->active = $requestBody['active'];
    $this->companyName = $requestBody['companyName'];
    $this->fancyName = $requestBody['fancyName'];
    $this->document = $requestBody['document'];
    $this->openingDate = $requestBody['openingDate'];
    $this->legalNature = $requestBody['legalNature'];
    $this->lineOfBusiness = $requestBody['lineOfBusiness'];
    $this->companyType = $requestBody['companyType'];
    return $this;
  }

  public function getCompanyAsArray(): array
  {
    return [
      'id' => $this->id->toString(),
      'active' => $this->active,
      'company_name' => $this->companyName,
      'fancy_name' => $this->fancyName,
      'document' => $this->document,
      'opening_date' => $this->openingDate,
      'legal_nature' => $this->legalNature,
      'line_of_business' => $this->lineOfBusiness,
      'company_type' => $this->companyType
    ];
  }

  public function copyCompany(
    self $company,
    array $attributes
  ): self
  {
    $nc = new Company();
    (array_key_exists('id', $attributes)) ? $nc->id = $attributes['id'] : $nc->id = $company->id;
    (array_key_exists('active', $attributes)) ? $nc->active = $attributes['active'] : $nc->active = $company->active;
    (array_key_exists('company_name', $attributes)) ? $nc->companyName = $attributes['company_name'] : $nc->companyName = $company->companyName;
    (array_key_exists('fancy_name', $attributes)) ? $nc->fancyName = $attributes['fancy_name'] : $nc->fancyName = $company->fancyName;
    (array_key_exists('document', $attributes)) ? $nc->document = $attributes['document'] : $nc->document = $company->document;
    (array_key_exists('opening_date', $attributes)) ? $nc->openingDate = $attributes['opening_date'] : $nc->openingDate = $company->openingDate;
    (array_key_exists('legal_nature', $attributes)) ? $nc->legalNature = $attributes['legal_nature'] : $nc->legalNature = $company->legalNature;
    (array_key_exists('line_of_business', $attributes)) ? $nc->lineOfBusiness = $attributes['line_of_business'] : $nc->lineOfBusiness = $company->lineOfBusiness;
    (array_key_exists('company_type', $attributes)) ? $nc->companyType = $attributes['company_type'] : $nc->companyType = $company->companyType;
    return $nc;
  }

  public function validation(
    string $language,
    LegalNatureEnum $legalNatureEnum,
    CompanyTypeEnum $companyTypeEnum
  ): array
  {
    $result = [];
    array_push($result,
      StringFieldValidation::validate($language, 'company name', $this->companyName, 5, 120),
      StringFieldValidation::validate($language, 'fancy name', $this->fancyName, 5, 120),
      DocumentValidation::validate($language, $this->document),
      EnumValidation::validate($language, $this->legalNature, $legalNatureEnum->values()),
      StringFieldValidation::validate($language, 'line of business', $this->lineOfBusiness, 5, 120),
      EnumValidation::validate($language, $this->companyType, $companyTypeEnum->values())
    );
    return array_filter($result);
  }
}