<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Module2\CampaignsModule\Enums\CampaignStatus;
use Module2\CampaignsModule\Models\CampaignNotification;

class ProcessCampaignNotificationJob implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public int $campaignId
    ) {
    }

    public function handle(): void
    {
        $campaign = CampaignNotification::query()
            ->with('catalogItem')
            ->find($this->campaignId);

        if (! $campaign) {
            return;
        }

        Log::info('Processing campaign notification job.', [
            'campaign_id' => $campaign->id,
            'title' => $campaign->title,
            'campaign_type' => $campaign->campaign_type?->value,
            'audience_type' => $campaign->audience_type?->value,
        ]);

        // Change the status of the notification for dramatic effect
        $campaign->update([
            'status' => CampaignStatus::Sent,
        ]);
    }
}