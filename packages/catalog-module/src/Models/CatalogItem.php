<?php

namespace Module1\CatalogModule\Models;

use Illuminate\Database\Eloquent\Model;
use Module1\CatalogModule\Enums\AvailabilityStatus;
use Module1\CatalogModule\Enums\PublicationStatus;

/**
 * Represents a media/content item managed by the Catalog module.
 */
class CatalogItem extends Model
{
    protected $table = 'catalog_items';

    protected $fillable = [
        'title',
        'slug',
        'description',
        'release_date',
        'genre',
        'publication_status',
        'availability_status',
        'poster_path',
        'notification_label',
    ];

    protected function casts(): array
    {
        return [
            'release_date' => 'date',
            'publication_status' => PublicationStatus::class,
            'availability_status' => AvailabilityStatus::class,
        ];
    }

    /**
     * Use slug-based route model binding for catalog URLs.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}