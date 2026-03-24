<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Module1\CatalogModule\Models\CatalogItem;
use Tests\TestCase;

class CatalogModuleTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_view_catalog_index(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get('/catalog')
            ->assertOk()
            ->assertSee('Catalog');
    }

    public function test_authenticated_user_can_create_catalog_item_and_slug_is_generated(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/catalog', [
            'title' => 'Project Hail Mary',
            'description' => 'A science fiction story.',
            'release_date' => '2026-03-24',
            'genre' => 'Sci-Fi',
            'publication_status' => 'published',
            'availability_status' => 'coming_soon',
            'poster_path' => 'https://example.com/poster.jpg',
            'notification_label' => 'Coming soon',
        ]);

        $response
            ->assertRedirect(route('catalog.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('catalog_items', [
            'title' => 'Project Hail Mary',
            'slug' => 'project-hail-mary',
        ]);
    }

    public function test_authenticated_user_can_update_catalog_item(): void
    {
        $user = User::factory()->create();

        $item = CatalogItem::query()->create([
            'title' => 'Old Title',
            'slug' => 'old-title',
            'description' => 'Old description',
            'release_date' => '2026-03-24',
            'genre' => 'Sci-Fi',
            'publication_status' => 'draft',
            'availability_status' => 'inactive',
            'poster_path' => null,
            'notification_label' => null,
        ]);

        $response = $this->actingAs($user)->put("/catalog/{$item->slug}", [
            'title' => 'New Title',
            'description' => 'Updated description',
            'release_date' => '2026-03-25',
            'genre' => 'Drama',
            'publication_status' => 'published',
            'availability_status' => 'active',
            'poster_path' => 'https://example.com/new-poster.jpg',
            'notification_label' => 'Now available',
        ]);

        $response->assertRedirect(route('catalog.index'))->assertSessionHas('success');

        $item->refresh();

        $this->assertSame('New Title', $item->title);
        $this->assertSame('new-title', $item->slug);
    }
}