<?php

namespace Module1\CatalogModule\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Routing\Controller;
use Module1\CatalogModule\Services\CatalogService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

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
}