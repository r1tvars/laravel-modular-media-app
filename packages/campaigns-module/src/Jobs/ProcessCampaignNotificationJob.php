<?php

namespace Module2\CampaignsModule\Jobs;

use BackedEnum;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Module2\CampaignsModule\Enums\CampaignStatus;
use Module2\CampaignsModule\Models\CampaignNotification;

class ProcessCampaignNotificationJob implements ShouldQueue
{
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public function __construct(
        public int $campaignId
    ) {
    }

    public function handle(): void
    {
        $query = CampaignNotification::query();

        if (app()->bound(\SupportModule\Contracts\CatalogItemLookupInterface::class)) {
            $query->with('catalogItem');
        }

        $campaign = $query->find($this->campaignId);

        if (! $campaign) {
            return;
        }

        // Change the status of the notification for dramatic effect
        $campaign->update([
            'status' => CampaignStatus::Sent,
        ]);
    }

    private function enumValue(BackedEnum|string|null $value): string|null
    {
        return $value instanceof BackedEnum ? $value->value : $value;
    }
}
