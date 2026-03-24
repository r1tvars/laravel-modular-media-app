<?php

namespace Module1\CatalogModule\Services;

use Illuminate\Database\Eloquent\Collection;
use Module1\CatalogModule\Models\CatalogItem;
use SupportModule\Services\SlugGenerator;

/**
 * Handles catalog item business operations for the Catalog module.
 */
class CatalogService
{
    public function __construct(
        private readonly SlugGenerator $slugGenerator
    ) {

    }

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
     * Slugs are generated once on creation.
     *
     * @param array $data
     */
    public function create(array $data): CatalogItem
    {
        $data['slug'] = $this->slugGenerator->generateUnique(
            (string) $data['title'],
            fn (string $slug): bool => CatalogItem::query()
                ->where('slug', $slug)
                ->exists()
        );

        return CatalogItem::query()->create($data);
    }

    /**
     * Update an existing catalog item using validated input data.
     *
     * If the title changes, the slug is regenerated to match it.
     *
     * @param array $data
     */
    public function update(CatalogItem $catalogItem, array $data): CatalogItem
    {
        if (
            array_key_exists('title', $data) &&
            is_string($data['title']) &&
            $data['title'] !== $catalogItem->title
        ) {
            $data['slug'] = $this->slugGenerator->generateUnique(
                $data['title'],
                fn (string $slug): bool => CatalogItem::query()
                    ->where('slug', $slug)
                    ->where('id', '!=', $catalogItem->id)
                    ->exists()
            );
        }

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