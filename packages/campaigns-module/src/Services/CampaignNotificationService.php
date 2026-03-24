<?php

namespace Module2\CampaignsModule\Services;

use Illuminate\Database\Eloquent\Collection;
use Module2\CampaignsModule\Models\CampaignNotification;
use SupportModule\Services\SlugGenerator;

/**
 * Handles campaign notification business operations.
 */
class CampaignNotificationService
{
    public function __construct(
        private readonly SlugGenerator $slugGenerator
    ) {

    }

    /**
     * Retrieve all campaigns ordered by newest first.
     */
    public function getAll(): Collection
    {
        return CampaignNotification::query()
            ->with('catalogItem')
            ->latest()
            ->get();
    }

    /**
     * Create a new campaign notification from validated input data.
     *
     * @param array $data
     */
    public function create(array $data): CampaignNotification
    {
        $data['slug'] = $this->slugGenerator->generateUnique(
            (string) $data['title'],
            fn (string $slug): bool => CampaignNotification::query()
                ->where('slug', $slug)
                ->exists()
        );

        return CampaignNotification::query()->create($data);
    }
}