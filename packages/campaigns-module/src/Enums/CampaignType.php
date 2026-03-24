<?php

namespace Module2\CampaignsModule\Enums;

/**
 * Defines whether a campaign is linked to a catalog item or is general.
 */
enum CampaignType: string
{
    case CatalogItem = 'catalog_item';
    case General = 'general';

    /**
     * @return array
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public function label(): string
    {
        return match ($this) {
            self::CatalogItem => 'Catalog item',
            self::General => 'General',
        };
    }
}