<?php


namespace Company\Entity;


use Patterns\Messages\LanguageEnum;
use Ramsey\Uuid\Uuid;
use Validation\DocumentValidation;
use Validation\EnumValidation;
use Validation\StringFieldValidation;

class Company
{
  protected Uuid $id;
  protected int $internalId;
  protected bool $active;
  protected string $companyName;
  protected string $fancyName;
  protected string $document;
  protected string $openingDate;
  protected string $legalNature; // LegalNatureEnum
  protected string $lineOfBusiness;

  protected StringFieldValidation $stringFieldValidation;
  protected DocumentValidation $documentValidation;
  protected EnumValidation $enumValidation;

  public function __construct(
    StringFieldValidation $stringFieldValidation,
    DocumentValidation $documentValidation,
    EnumValidation $enumValidation
  )
  {
    $this->stringFieldValidation = $stringFieldValidation;
    $this->documentValidation = $documentValidation;
    $this->enumValidation = $enumValidation;
  }

  public function buildCompany(array $requestBody): array
  {
    $this->active = $requestBody['active'];
    $this->companyName = $requestBody['companyName'];
    $this->fancyName = $requestBody['fancyName'];
    $this->document = $requestBody['document'];
    $this->openingDate = $requestBody['openingDate'];
    $this->legalNature = $requestBody['legalNature'];
    $this->lineOfBusiness = $requestBody['lineOfBusiness'];
  }

  public function validation(LanguageEnum $language): array
  {
    $result = [];
    array_push($result,
      $this->stringFieldValidation->validate($language, "company name", $this->companyName, 5, 120),
      $this->stringFieldValidation->validate($language, "fancy name", $this->fancyName, 5, 120),
      $this->documentValidation->validate($language, $this->document),
      $this->enumValidation->validate($language, $this->legalNature, new LegalNatureEnum()),
      $this->stringFieldValidation->validate($language, "line of business", $this->lineOfBusiness, 5, 120),
    );
    return $result;
  }
}