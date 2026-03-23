<?php

namespace Module1\CatalogModule\Services;

use Illuminate\Database\Eloquent\Collection;
use Module1\CatalogModule\Models\CatalogItem;

class CatalogService
{
    public function getAll(): Collection
    {
        return CatalogItem::query()
            ->orderBy('title')
            ->get();
    }
}