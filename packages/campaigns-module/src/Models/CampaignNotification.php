<?php

declare(strict_types=1);

namespace Module2\CampaignsModule\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Module1\CatalogModule\Models\CatalogItem;
use Module2\CampaignsModule\Enums\AudienceType;
use Module2\CampaignsModule\Enums\CampaignStatus;
use Module2\CampaignsModule\Enums\CampaignType;

/**
 * Represents a notification campaign that can be linked to a catalog item
 * or sent as a general campaign.
 */
class CampaignNotification extends Model
{
    protected $table = 'campaign_notifications';

    protected $fillable = [
        'title',
        'slug',
        'message',
        'campaign_type',
        'catalog_item_id',
        'audience_type',
        'status',
        'send_at',
    ];

    protected function casts(): array
    {
        return [
            'campaign_type' => CampaignType::class,
            'audience_type' => AudienceType::class,
            'status' => CampaignStatus::class,
            'send_at' => 'datetime',
        ];
    }

    public function catalogItem(): BelongsTo
    {
        return $this->belongsTo(CatalogItem::class);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}