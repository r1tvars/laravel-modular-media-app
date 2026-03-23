<?php

namespace Module1\CatalogModule\Services;

use Illuminate\Database\Eloquent\Collection;
use Module1\CatalogModule\Models\CatalogItem;

class CatalogService
{
    /**
     * Retrieve all catalog items ordered alphabetically by title.
     */
    public function getAll(): Collection
    {
        return CatalogItem::query()
            ->orderBy('title')
            ->get();
    }

    /**
     * Create a new catalog item from validated input data.
     *
     * @param array $data
     */
    public function create(array $data): CatalogItem
    {
        return CatalogItem::query()->create($data);
    }

    /**
     * Update an existing catalog item using validated input data.
     *
     * @param array $data
     */
    public function update(CatalogItem $catalogItem, array $data): CatalogItem
    {
        $catalogItem->update($data);

        return $catalogItem->refresh();
    }

    /**
     * Delete a catalog item from the catalog.
     */
    public function delete(CatalogItem $catalogItem): void
    {
        $catalogItem->delete();
    }
}