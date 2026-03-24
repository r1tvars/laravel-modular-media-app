<?php

namespace Module1\CatalogModule\Services;

use Module1\CatalogModule\Models\CatalogItem;
use SupportModule\Contracts\CatalogItemLookupInterface;
use SupportModule\Data\CatalogItemOptionData;

/**
 * Exposes catalog item lookup data for cross-module consumers.
 */
class CatalogItemLookupService implements CatalogItemLookupInterface
{
    /**
     * @return array
     */
    public function getCampaignSelectableItems(): array
    {
        return CatalogItem::query()
            ->orderBy('title')
            ->get()
            ->map(
                fn (CatalogItem $item): CatalogItemOptionData => new CatalogItemOptionData(
                    id: $item->id,
                    title: $item->title,
                    slug: $item->slug,
                )
            )->all();
    }
}