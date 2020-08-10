<?php

namespace Company\Entity;

class LegalNatureEnum
{
  const BusinessEntity = "Business Entity";
  const NonProfitEntities = "NonProfit Entities";
  const PublicAdministration = "Public Administration";
  const ExtraterritorialInstitutions = "Extraterritorial Institutions";

  public function values(): array
  {
    return [
      self::BusinessEntity,
      self::NonProfitEntities,
      self::PublicAdministration,
      self::ExtraterritorialInstitutions];
  }
}