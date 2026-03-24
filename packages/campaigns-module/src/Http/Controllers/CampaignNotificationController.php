<?php

namespace Module2\CampaignsModule\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Validation\Rule;
use Module2\CampaignsModule\Enums\AudienceType;
use Module2\CampaignsModule\Enums\CampaignStatus;
use Module2\CampaignsModule\Enums\CampaignType;
use Module2\CampaignsModule\Models\CampaignNotification;
use Module2\CampaignsModule\Services\CampaignNotificationService;
use SupportModule\Contracts\CatalogItemLookupInterface;

/**
 * Handles HTTP endpoints for campaign notification management.
 */
final class CampaignNotificationController extends Controller
{
    public function __construct(
        private readonly CampaignNotificationService $campaignNotificationService
    ) {

    }

    /**
     * Display the campaign listing page.
     */
    public function index(): View
    {
        return view('campaigns::index', [
            'campaigns' => $this->campaignNotificationService->getAll(),
            'catalogModuleInstalled' => $this->hasCatalogModule(),
        ]);
    }

    /**
     * Display a single campaign details page.
     */
    public function show(CampaignNotification $campaignNotification): View
    {
        return view('campaigns::show', [
            'campaign' => $this->hasCatalogModule()
                ? $campaignNotification->load('catalogItem')
                : $campaignNotification,
            'catalogModuleInstalled' => $this->hasCatalogModule(),
        ]);
    }

    /**
     * Show the campaign creation form.
     */
    public function create(): View
    {
        return view('campaigns::create', [
            'catalogItems' => $this->getCatalogItems(),
            'catalogModuleInstalled' => $this->hasCatalogModule(),
        ]);
    }

    /**
     * Store a newly created campaign notification.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateCampaign($request);

        // General campaigns are not linked to a specific catalog item.
        if ($validated['campaign_type'] === CampaignType::General->value) {
            $validated['catalog_item_id'] = null;
        }

        $this->campaignNotificationService->create($validated);

        return redirect()
            ->route('campaigns.index')
            ->with('success', 'Campaign notification created successfully.');
    }

    /**
     * Show the campaign edit form.
     */
    public function edit(CampaignNotification $campaignNotification): View
    {
        return view('campaigns::edit', [
            'campaign' => $campaignNotification,
            'catalogItems' => $this->getCatalogItems(),
            'catalogModuleInstalled' => $this->hasCatalogModule(),
        ]);
    }

    /**
     * Show the campaign edit form.
     */
    public function update(Request $request, CampaignNotification $campaignNotification): RedirectResponse
    {
        $validated = $this->validateCampaign($request);

        // General campaigns are not linked to a specific catalog item.
        if ($validated['campaign_type'] === CampaignType::General->value) {
            $validated['catalog_item_id'] = null;
        }

        $this->campaignNotificationService->update($campaignNotification, $validated);

        return redirect()
            ->route('campaigns.index')
            ->with('success', 'Campaign notification updated successfully.');
    }

    /**
     * Delete a campaign notification.
     */
    public function destroy(CampaignNotification $campaignNotification): RedirectResponse
    {
        $this->campaignNotificationService->delete($campaignNotification);

        return redirect()
            ->route('campaigns.index')
            ->with('success', 'Campaign notification deleted successfully.');
    }

    /**
     * Retrieve catalog items for campaign selection when the Catalog module is available.
     *
     * Allows the Campaigns module to run independently on a environemt where
     * the Catalog module is not installed.
     *
     */
    private function getCatalogItems(): array
    {
        if (! $this->hasCatalogModule()) {
            return [];
        }

        /** @var CatalogItemLookupInterface $lookup */
        $lookup = app(CatalogItemLookupInterface::class);

        return $lookup->getCampaignSelectableItems();
    }

    private function hasCatalogModule(): bool
    {
        return app()->bound(CatalogItemLookupInterface::class);
    }

    /**
     * Validate campaign form input.
     *
     * Catalog-linked campaigns must reference an existing catalog item,
     * while general campaigns may leave that relation empty.
     *
     * @return array
     */
    private function validateCampaign(Request $request): array
    {
        $allowedCampaignTypes = $this->hasCatalogModule()
            ? CampaignType::values()
            : [CampaignType::General->value];

        $catalogItemRules = [
            Rule::requiredIf(
                $request->input('campaign_type') === CampaignType::CatalogItem->value
                && $this->hasCatalogModule()
            ),
            'nullable',
            'integer',
        ];

        if ($this->hasCatalogModule()) {
            $catalogItemRules[] = 'exists:catalog_items,id';
        }

        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string'],
            'campaign_type' => ['required', 'string', Rule::in($allowedCampaignTypes)],
            'catalog_item_id' => $catalogItemRules,
            'audience_type' => ['required', 'string', Rule::in(AudienceType::values())],
            'status' => ['required', 'string', Rule::in(CampaignStatus::values())],
            'send_at' => ['nullable', 'date'],
        ], [
            'campaign_type.in' => 'Catalog-linked campaigns require the Catalog module to be installed.',
            'catalog_item_id.required' => 'Please select a catalog item when the campaign type is Catalog item.',
            'catalog_item_id.exists' => 'The selected catalog item does not exist.',
        ]);
    }
}