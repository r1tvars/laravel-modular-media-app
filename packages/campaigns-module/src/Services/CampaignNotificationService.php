<?php

namespace Module2\CampaignsModule\Services;

use Illuminate\Database\Eloquent\Collection;
use Module2\CampaignsModule\Jobs\ProcessCampaignNotificationJob;
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
        $query = CampaignNotification::query()->latest();

        if (app()->bound(\SupportModule\Contracts\CatalogItemLookupInterface::class)) {
            $query->with('catalogItem');
        }

        return $query->get();
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

        $campaign = CampaignNotification::query()->create($data);

        dispatch(new ProcessCampaignNotificationJob($campaign->id));

        return $campaign;
    }

    /**
     * Update an existing campaign notification.
     *
     * If the title changes, the slug is regenerated.
     *
     * @param array $data
     */
    public function update(CampaignNotification $campaignNotification, array $data): CampaignNotification
    {
        if (
            array_key_exists('title', $data) &&
            is_string($data['title']) &&
            $data['title'] !== $campaignNotification->title
        ) {
            $data['slug'] = $this->slugGenerator->generateUnique(
                $data['title'],
                fn (string $slug): bool => CampaignNotification::query()
                    ->where('slug', $slug)
                    ->where('id', '!=', $campaignNotification->id)
                    ->exists()
            );
        }

        $campaignNotification->update($data);

        return $campaignNotification->refresh();
    }

    /**
     * Delete a campaign notification.
     */
    public function delete(CampaignNotification $campaignNotification): void
    {
        $campaignNotification->delete();
    }
}
