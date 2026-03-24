<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('catalog_items')
            ->whereNotIn('publication_status', ['draft', 'published', 'archived'])
            ->update(['publication_status' => 'draft']);

        DB::table('catalog_items')
            ->whereNotIn('availability_status', ['inactive', 'active', 'coming_soon', 'leaving_soon'])
            ->update(['availability_status' => 'inactive']);

        DB::statement("
            ALTER TABLE catalog_items
            MODIFY publication_status ENUM('draft', 'published', 'archived')
            NOT NULL DEFAULT 'draft'
        ");

        DB::statement("
            ALTER TABLE catalog_items
            MODIFY availability_status ENUM('inactive', 'active', 'coming_soon', 'leaving_soon')
            NOT NULL DEFAULT 'inactive'
        ");
    }

    public function down(): void
    {
        DB::statement("
            ALTER TABLE catalog_items
            MODIFY publication_status VARCHAR(255)
            NOT NULL DEFAULT 'draft'
        ");

        DB::statement("
            ALTER TABLE catalog_items
            MODIFY availability_status VARCHAR(255)
            NOT NULL DEFAULT 'inactive'
        ");
    }
};