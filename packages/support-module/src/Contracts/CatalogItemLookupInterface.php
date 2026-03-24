<?php

namespace SupportModule\Contracts;

use SupportModule\Data\CatalogItemOptionData;

/**
 * Provides catalog item lookup operations for other modules.
 */
interface CatalogItemLookupInterface
{
    /**
     * Return catalog items that can be selected by other modules,
     * such as Campaign Notifications.
     *
     * @return array
     */
    public function getCampaignSelectableItems(): array;
}