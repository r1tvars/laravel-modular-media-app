<?php

namespace Module1\CatalogModule\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Routing\Controller;
use Module1\CatalogModule\Services\CatalogService;

class CatalogController extends Controller
{
    public function __construct(
        private readonly CatalogService $catalogService
    ) {
    }

    public function index(): View
    {
        return view('catalog::index', [
            'items' => $this->catalogService->getAll(),
        ]);
    }
}