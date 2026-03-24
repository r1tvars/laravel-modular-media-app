<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use SupportModule\Services\SlugGenerator;

class SlugGeneratorTest extends TestCase
{
    public function test_it_generates_a_normalized_slug(): void
    {
        $generator = new SlugGenerator();

        $this->assertSame('project-hail-mary', $generator->generate('Project Hail Mary'));
    }

    public function test_it_generates_a_unique_slug_when_base_slug_exists(): void
    {
        $generator = new SlugGenerator();

        $existing = ['project-hail-mary', 'project-hail-mary-2'];

        $slug = $generator->generateUnique(
            'Project Hail Mary',
            fn (string $candidate): bool => in_array($candidate, $existing, true)
        );

        $this->assertSame('project-hail-mary-3', $slug);
    }
}