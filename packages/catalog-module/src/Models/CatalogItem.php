<?php

namespace Module1\CatalogModule\Models;

use Illuminate\Database\Eloquent\Model;

class CatalogItem extends Model
{
    protected $table = 'catalog_items';

    protected $fillable = [
        'title',
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
        ];
    }
}