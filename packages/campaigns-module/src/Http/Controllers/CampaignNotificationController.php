<?php

namespace Module2\CampaignsModule\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Validation\Rule;
use Module1\CatalogModule\Models\CatalogItem;
use Module2\CampaignsModule\Enums\AudienceType;
use Module2\CampaignsModule\Enums\CampaignStatus;
use Module2\CampaignsModule\Enums\CampaignType;
use Module2\CampaignsModule\Services\CampaignNotificationService;

/**
 * Handles HTTP endpoints for campaign notification management.
 */
final class CampaignNotificationController extends Controller
{
    public function __construct(
        private readonly CampaignNotificationService $campaignNotificationService
    ) {
    }

    public function index(): View
    {
        return view('campaigns::index', [
            'campaigns' => $this->campaignNotificationService->getAll(),
        ]);
    }

    public function create(): View
    {
        return view('campaigns::create', [
            'catalogItems' => CatalogItem::query()
                ->orderBy('title')
                ->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateCampaign($request);

        if ($validated['campaign_type'] === CampaignType::General->value) {
            $validated['catalog_item_id'] = null;
        }

        $this->campaignNotificationService->create($validated);

        return redirect()
            ->route('campaigns.index')
            ->with('success', 'Campaign notification created successfully.');
    }

    /**
     * @return array
     */
    private function validateCampaign(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string'],
            'campaign_type' => ['required', 'string', Rule::in(CampaignType::values())],
            'catalog_item_id' => ['nullable', 'integer', 'exists:catalog_items,id'],
            'audience_type' => ['required', 'string', Rule::in(AudienceType::values())],
            'status' => ['required', 'string', Rule::in(CampaignStatus::values())],
            'send_at' => ['nullable', 'date'],
        ]);
    }
}