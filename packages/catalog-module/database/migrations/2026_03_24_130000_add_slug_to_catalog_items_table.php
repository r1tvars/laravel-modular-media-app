<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use SupportModule\Services\SlugGenerator;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('catalog_items', function (Blueprint $table): void {
            $table->string('slug')->nullable()->after('title');
        });

        /** @var SlugGenerator $slugGenerator */
        $slugGenerator = app(SlugGenerator::class);

        $items = DB::table('catalog_items')
            ->select('id', 'title')
            ->orderBy('id')
            ->get();

        foreach ($items as $item) {
            $slug = $slugGenerator->generateUnique(
                (string) $item->title,
                fn (string $slug): bool => DB::table('catalog_items')
                    ->where('slug', $slug)
                    ->where('id', '!=', $item->id)
                    ->exists()
            );

            DB::table('catalog_items')
                ->where('id', $item->id)
                ->update(['slug' => $slug]);
        }

        Schema::table('catalog_items', function (Blueprint $table): void {
            $table->string('slug')->nullable(false)->unique()->change();
        });
    }

    public function down(): void
    {
        Schema::table('catalog_items', function (Blueprint $table): void {
            $table->dropUnique(['slug']);
            $table->dropColumn('slug');
        });
    }
};