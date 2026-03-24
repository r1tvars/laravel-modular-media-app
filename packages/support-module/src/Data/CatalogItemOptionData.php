<?php

namespace SupportModule\Data;

/**
 * Lightweight catalog item data exposed for cross-module selection use cases.
 */
final class CatalogItemOptionData
{
    public function __construct(
        public readonly int $id,
        public readonly string $title,
        public readonly string $slug,
    ) {
    }
}