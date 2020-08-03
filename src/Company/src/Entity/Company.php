<?php


namespace Company\Entity;


use Patterns\Locale\LanguageEnum;
use Ramsey\Uuid\Uuid;
use function Settings\Validation\validateStringField;
use function Validation\documentValidation;
use function Validation\validateEnum;

class Company
{
  private Uuid $id;
  private int $internalId;
  private bool $active;
  private string $companyName;
  private string $fancyName;
  private string $document;
  private string $openingDate;
  private string $legalNature; // LegalNatureEnum
  private string $lineOfBusiness;

  public function __construct(
    bool $active,
    string $companyName,
    string $fancyName,
    string $document,
    string $legalNature,  // LegalNatureEnum
    string $lineOfBusiness
  )
  {
    $this->active = $active;
    $this->companyName = $companyName;
    $this->fancyName = $fancyName;
    $this->document = $document;
    $this->legalNature = $legalNature;
    $this->lineOfBusiness = $lineOfBusiness;
  }


  public function validation(LanguageEnum $language): array
  {
    $result = [];
    array_push($result,
      validateStringField($language, "company name", $this->companyName, 5, 120),
      validateStringField($language, "fancy name", $this->fancyName, 5, 120),
      documentValidation($language, $this->document),
      validateEnum($language, $this->legalNature, new LegalNatureEnum()),
      validateStringField($language, "line of business", $this->lineOfBusiness, 5, 120),
    );
    return $result;
  }
}