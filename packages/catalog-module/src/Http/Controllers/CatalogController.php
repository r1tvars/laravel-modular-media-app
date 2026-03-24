<?php

namespace Module1\CatalogModule\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Routing\Controller;
use Module1\CatalogModule\Services\CatalogService;
use Module1\CatalogModule\Models\CatalogItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Module1\CatalogModule\Enums\AvailabilityStatus;
use Module1\CatalogModule\Enums\PublicationStatus;

class CatalogController extends Controller
{
    public function __construct(
        private readonly CatalogService $catalogService
    ) {
        
    }

    /**
     * Display the catalog item listing page.
     */
    public function index(): View
    {
        return view('catalog::index', [
            'items' => $this->catalogService->getAll(),
        ]);
    }

    /**
     * Display a single catalog item details page.
     */
    public function show(CatalogItem $catalogItem): View
    {
        return view('catalog::show', [
            'item' => $catalogItem,
        ]);
    }


    /**
     * Show the catalog item creation form.
     */
    public function create(): View
    {
        return view('catalog::create');
    }

    /**
     * Store a newly created catalog item.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'release_date' => ['nullable', 'date'],
            'genre' => ['nullable', 'string', 'max:255'],
            'publication_status' => ['required', 'string', 'in:draft,published,archived'],
            'availability_status' => ['required', 'string', 'in:inactive,active,coming_soon,leaving_soon'],
            'poster_path' => ['nullable', 'string', 'max:255'],
            'notification_label' => ['nullable', 'string', 'max:255'],
        ]);

        $this->catalogService->create($validated);

        return redirect()
            ->route('catalog.index')
            ->with('success', 'Catalog item created successfully.');
    }

    /**
     * Show the catalog item edit form.
     */
    public function edit(CatalogItem $catalogItem): View
    {
        return view('catalog::edit', [
            'item' => $catalogItem,
        ]);
    }

    /**
     * Update an existing catalog item.
     */
    public function update(Request $request, CatalogItem $catalogItem): RedirectResponse
    {
        $validated = $this->validateCatalogItem($request);

        $this->catalogService->update($catalogItem, $validated);

        return redirect()
            ->route('catalog.index')
            ->with('success', 'Catalog item updated successfully.');
    }

    /**
     * Delete a catalog item.
     */
    public function destroy(CatalogItem $catalogItem): RedirectResponse
    {
        $this->catalogService->delete($catalogItem);

        return redirect()
            ->route('catalog.index')
            ->with('success', 'Catalog item deleted successfully.');
    }

    /**
     * Validate catalog item form input.
     *
     * @return array
     */
    private function validateCatalogItem(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'release_date' => ['nullable', 'date'],
            'genre' => ['nullable', 'string', 'max:255'],
            'publication_status' => ['required', 'string', Rule::in(PublicationStatus::values())],
            'availability_status' => ['required', 'string', Rule::in(AvailabilityStatus::values())],
            'poster_path' => ['nullable', 'string', 'max:255'],
            'notification_label' => ['nullable', 'string', 'max:255'],
        ]);
    }
}