<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Module1\CatalogModule\Models\CatalogItem;
use Tests\TestCase;

class CampaignNotificationsModuleTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_view_campaign_index(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get('/campaigns')
            ->assertOk()
            ->assertSee('Campaign Notifications');
    }

    public function test_authenticated_user_can_create_general_campaign(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/campaigns', [
            'title' => 'General Campaign',
            'message' => 'A general campaign message.',
            'campaign_type' => 'general',
            'catalog_item_id' => null,
            'audience_type' => 'all_users',
            'status' => 'draft',
            'send_at' => null,
        ]);

        $response
            ->assertRedirect(route('campaigns.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('campaign_notifications', [
            'title' => 'General Campaign',
            'slug' => 'general-campaign',
            'campaign_type' => 'general',
        ]);
    }

    public function test_authenticated_user_can_create_catalog_linked_campaign(): void
    {
        $user = User::factory()->create();

        $catalogItem = CatalogItem::query()->create([
            'title' => 'Interstellar',
            'slug' => 'interstellar',
            'description' => 'Space epic',
            'release_date' => '2026-03-24',
            'genre' => 'Sci-Fi',
            'publication_status' => 'published',
            'availability_status' => 'active',
            'poster_path' => null,
            'notification_label' => null,
        ]);

        $response = $this->actingAs($user)->post('/campaigns', [
            'title' => 'Interstellar Push',
            'message' => 'Watch Interstellar now.',
            'campaign_type' => 'catalog_item',
            'catalog_item_id' => $catalogItem->id,
            'audience_type' => 'all_users',
            'status' => 'draft',
            'send_at' => null,
        ]);

        $response->assertRedirect(route('campaigns.index'))->assertSessionHas('success');

        $this->assertDatabaseHas('campaign_notifications', [
            'title' => 'Interstellar Push',
            'slug' => 'interstellar-push',
            'campaign_type' => 'catalog_item',
            'catalog_item_id' => $catalogItem->id,
        ]);
    }
}