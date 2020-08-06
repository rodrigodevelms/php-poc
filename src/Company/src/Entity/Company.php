<?php


namespace Company\Entity;


use Ramsey\Uuid\Uuid;
use Validation\EnumValidation;
use Validation\StringFieldValidation;

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

  protected StringFieldValidation $stringFieldValidation;
  protected EnumValidation $enumValidation;

  public function __construct(
    StringFieldValidation $stringFieldValidation,
    EnumValidation $enumValidation
  )
  {
    $this->stringFieldValidation = $stringFieldValidation;
    $this->enumValidation = $enumValidation;
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
  }

  public function validation(string $language, LegalNatureEnum $legalNatureEnum): array
  {
    $result = [];
    array_push($result,
      $this->stringFieldValidation->validate($language, 'company name', $this->companyName, 5, 120),
      $this->stringFieldValidation->validate($language, 'fancy name', $this->fancyName, 5, 120),
//      $documentValidation->validate($language, 'document'),
      $this->enumValidation->validate($language, $this->legalNature, $legalNatureEnum->values()),
      $this->stringFieldValidation->validate($language, 'line of business', $this->lineOfBusiness, 5, 120)
    );
    return $result;
  }
}