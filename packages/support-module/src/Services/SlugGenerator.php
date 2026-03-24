<?php

namespace SupportModule\Services;

use Illuminate\Support\Str;

/**
 * Generates normalized and unique slugs for reusable module use.
 */
class SlugGenerator
{
    /**
     * Generate a normalized slug from an arbitrary string.
     */
    public function generate(string $value): string
    {
        $slug = Str::slug($value);

        return $slug !== '' ? $slug : 'item';
    }

    /**
     * Generate a unique slug using a caller-provided existence check.
     *
     * @param callable(string): bool $exists
     */
    public function generateUnique(string $value, callable $exists): string
    {
        $baseSlug = $this->generate($value);
        $slug = $baseSlug;
        $counter = 2;

        while ($exists($slug)) {
            $slug = "{$baseSlug}-{$counter}";
            $counter++;
        }

        return $slug;
    }
}